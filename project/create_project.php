<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인해주세요'); location.replace('login.php');</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 만들기</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>프로젝트 만들기</h1>
        </div>
        <form method="post" action="create_project.php">
            <div class="form-group">
                <label for="project_name">프로젝트 이름:</label>
                <input type="text" id="project_name" name="project_name" required>
            </div>
            <div class="form-group">
                <label for="project_password">프로젝트 비밀번호:</label>
                <input type="password" id="project_password" name="project_password" required>
            </div>
            <button type="submit">프로젝트 생성</button>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];
    $project_password = $_POST['project_password'];

    // 데이터베이스에 프로젝트를 추가하는 로직을 추가하세요.
    // 예시:
    // addProject($project_name, $project_password, $_SESSION['username']);

    header("Location: project_status.php");
    exit();
}
?>