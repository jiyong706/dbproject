<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../../login/login.php');</script>";
    exit();
}
require '../../DB/config.php';

$username = $_SESSION['username'];

// 유저 아이디 가져오기
$user_sql = "SELECT user_id FROM user WHERE id = :username";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bindParam(':username', $username);
$user_stmt->execute();
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['user_id'];

$sql = "SELECT project_id, project_name, TO_CHAR(project_CreateDate, 'YYYY-MM-DD HH24:MI:SS') AS project_CreateDate FROM project WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 목록</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>프로젝트 목록</h1>
        <table>
            <thead>
                <tr>
                    <th>프로젝트 이름</th>
                    <th>생성일</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($project['project_CreateDate']); ?></td>
                        <td>
                            <a href="view_project.php?id=<?php echo $project['project_id']; ?>">보기</a>
                            <a href="edit_project.php?id=<?php echo $project['project_id']; ?>">수정</a>
                            <a href="delete_project.php?id=<?php echo $project['project_id']; ?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create_project.php">새 프로젝트 만들기</a>
    </div>
</body>
</html>
