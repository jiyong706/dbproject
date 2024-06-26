<?php
session_start();
if (isset($_SESSION['USER_NAME'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 조사</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>패널 목록</h1>
        </div>
        <!-- 패널 목록을 출력하는 로직을 추가하세요 -->
        <button onclick="location.href='/project/pannel/create_panel.php'">패널 생성</button>
    </div>
</body>
</html>