<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../../login/login.php');</script>";
    exit();
}

// Oracle 데이터베이스 연결
$conn = oci_connect('c##test', '00000000', 'dsapoi881.duckdns.org:1522/xe');

if (!$conn) {
    $e = oci_error();
    echo "<script>alert('데이터베이스 연결에 실패했습니다.');</script>";
    exit();
}

$id = intval($_GET['id']);
$username = $_SESSION['username'];

// 유저 아이디 가져오기
$user_sql = "SELECT user_id FROM user WHERE id = :username";
$user_stmt = oci_parse($conn, $user_sql);
oci_bind_by_name($user_stmt, ':username', $username);
oci_execute($user_stmt);

$user = oci_fetch_assoc($user_stmt);
$user_id = $user['USER_ID'];

// 프로젝트 삭제
$sql = "DELETE FROM project WHERE project_id = :id AND user_id = :user_id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':id', $id);
oci_bind_by_name($stmt, ':user_id', $user_id);

if (oci_execute($stmt)) {
    echo "<script>alert('프로젝트가 성공적으로 삭제되었습니다.'); location.replace('project_list.php');</script>";
} else {
    $e = oci_error($stmt);
    echo "<script>alert('프로젝트 삭제에 실패했습니다. 오류: " . htmlspecialchars($e['message']) . "');</script>";
}

// Oracle 연결 종료
oci_free_statement($user_stmt);
oci_free_statement($stmt);
oci_close($conn);
?>