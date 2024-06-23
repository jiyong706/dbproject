<?php
// 세션 시작 전에 설정
ini_set('session.gc_maxlifetime', 3600); // 1시간 (3600초)
session_set_cookie_params(3600); // 쿠키도 1시간 (3600초)

session_start();

include_once 'C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] === null) {
    echo "<script>alert('먼저 로그인을 해주세요!')</script>";
    header("Location: /login/login.php");
    exit();
}

$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>나의 대시보드</title>
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>어서오세요, <span id="user_name"><?php echo htmlspecialchars($username); ?> 님</span></h1>
            <a href="/login/logout.php" class="logout">Logout</a>
        </header>
        <div class="main-content">
            <div class="card">
                <h2>프로젝트 관리페이지 이동</h2>
                <a href="/project/project.php">프로젝트 관리</a>
            </div>
            <div class="card">
                <h2>패널 관리페이지 이동</h2>
                <a href="/project/pannel/pannel_list.php">패널 관리</a>
            </div>
        </div>
    </div>
</body>
</html>
