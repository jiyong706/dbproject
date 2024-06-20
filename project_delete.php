<?php
session_start();
if (!isset($_SESSION['user_nickname'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../../login/login.php');</script>";
    exit();
}
require '../../DB/config.php';

$id = intval($_GET['id']);
$username = $_SESSION['username'];

// 유저 아이디 가져오기
$user_sql = "SELECT user_id FROM user WHERE id = :username";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bindParam(':username', $username);
$user_stmt->execute();
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['user_id'];

$sql = "DELETE FROM project WHERE project_id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':user_id', $user_id);

if ($stmt->execute()) {
    echo "<script>alert('프로젝트가 성공적으로 삭제되었습니다.'); location.replace('project_list.php');</script>";
} else {
    echo "프로젝트 삭제에 실패했습니다.";
}
?>
