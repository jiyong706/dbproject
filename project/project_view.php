<?php
session_start();
if (!isset($_SESSION['username'])) {
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

$sql = "SELECT project_name, project_info, TO_CHAR(project_CreateDate, 'YYYY-MM-DD HH24:MI:SS') AS project_CreateDate FROM project WHERE project_id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    echo "프로젝트를 찾을 수 없습니다.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 상세 보기</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($project['project_name']); ?></h1>
        <p>프로젝트 정보: <?php echo htmlspecialchars($project['project_info']); ?></p>
        <p>생성일: <?php echo htmlspecialchars($project['project_CreateDate']); ?></p>
        <a href="project_list.php">프로젝트 목록으로</a>
    </div>
</body>
</html>
