<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 생성</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>패널 생성</h1>
        </div>
        <form method="post" action="/project/pannel/create_pannel.php">
            <div class="form-group">
                <label for="panel_name">패널 이름:</label>
                <input type="text" id="panel_name" name="panel_name" required>
            </div>
            <button type="submit">패널 생성</button>
        </form>
        
    </div>
</body>