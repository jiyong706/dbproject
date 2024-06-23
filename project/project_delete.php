<?php
session_start();

// 세션이 없으면 로그인 페이지로 리다이렉트
if (!isset($_SESSION['user_nickname'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../login/login.php');</script>";
    exit();
}

include_once '../user/config.php';

// 데이터베이스 연결 확인
if (!$conn) {
    echo "<script>alert('데이터베이스 연결 오류입니다.'); location.replace('project_list.php');</script>";
    exit();
}

// GET 매개변수에서 프로젝트 ID 가져오기
if (isset($_GET['project_id']) && is_numeric($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $user_nickname = $_SESSION['user_nickname']; // assuming user_nickname is the user ID

    // 삭제 쿼리 작성
    $sql = "DELETE FROM project_table 
            WHERE project_id = :project_id 
            AND user_id = (SELECT user_id FROM user_table WHERE id = :user_nickname)";
    
    // OCI 문장 준비
    $stid = oci_parse($conn, $sql);
    
    // OCI 문장 준비 오류 처리
    if (!$stid) {
        $e = oci_error($conn);
        echo "<script>alert('SQL 준비 오류: " . htmlspecialchars($e['message'], ENT_QUOTES) . "'); location.replace('project_list.php');</script>";
        exit();
    }

    // 바인딩
    oci_bind_by_name($stid, ':project_id', $project_id);
    oci_bind_by_name($stid, ':user_nickname', $user_nickname);

    // OCI 실행
    if (oci_execute($stid)) {
        echo "<script>alert('프로젝트가 삭제되었습니다.'); location.replace('project_list.php');</script>";
    } else {
        $e = oci_error($stid);
        echo "<script>alert('프로젝트 삭제 오류: " . htmlspecialchars($e['message'], ENT_QUOTES) . "'); location.replace('project_list.php');</script>";
    }

    // OCI 문장 해제 및 연결 닫기
    oci_free_statement($stid);
    oci_close($conn);
} else {
    echo "<script>alert('유효하지 않은 요청입니다.'); location.replace('project_list.php');</script>";
    exit();
}
?>
