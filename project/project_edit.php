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

$sql = "SELECT project_name, project_info FROM project WHERE project_id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    echo "프로젝트를 찾을 수 없습니다.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];
    $project_info = $_POST['project_info'];

    $update_sql = "UPDATE project SET project_name = :project_name, project_info = :project_info, project_update = SYSDATE WHERE project_id = :id AND user_id = :user_id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(':project_name', $project_name);
    $update_stmt->bindParam(':project_info', $project_info);
    $update_stmt->bindParam(':id', $id);
    $update_stmt->bindParam(':user_id', $user_id);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('프로젝트가 성공적으로 수정되었습니다.'); location.replace('view_project.php?id={$id}');</script>";
    } else {
        echo "프로젝트 수정에 실패했습니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 수정</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>프로젝트 수정</h1>
        <form method="post">
            <div class="form-group">
                <label for="project_name">프로젝트 이름:</label>
                <input type="text" id="project_name" name="project_name" value="<?php echo htmlspecialchars($project['project_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="project_info">프로젝트 정보:</label>
                <textarea id="project_info" name="project_info" required><?php echo htmlspecialchars($project['project_info']); ?></textarea>
            </div>
            <button type="submit">프로젝트 수정</button>
        </form>
        <a href="view_project.php?id=<?php echo $id; ?>">취소</a>
    </div>
</body>
</html>
