<?php
include_once '/Users/baggyeonghwan/dbproject/DB/config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('먼저 로그인을 해주세요!')</script>";
    header("Location: /login/login.php");
    exit();
}

$e = oci_error();

if (!$conn){
    die("Connection failed: ". $e);
    $_SESSION['error'] = "데이터베이스 오류입니다 :" + oci_error(); 
    echo "<script>alert('데이터베이스 오류입니다! : ')</script>";
} else if ($e !== null){
    $_SESSION['error'] = "데이터베이스 오류입니다 :" + oci_error(); 
    echo "<script>alert('데이터베이스 오류입니다! : ')</script>";
}

$username = $_SESSION['USER_NAME'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT username FROM users WHERE username = ':s'";
    oci_bind_by_name($conn, "s", $username);
    
    $result = oci_execute($conn, $sql);
    $user = oci_fetch_assoc($result[]);
    
    oci_free_statement($stid);
    oci_close($conn);
    echo json_encode($user);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <link rel="stylesheet" href="mypage.css">
    <script>
    </script>
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>환영합니다, <span id="user_nickname"></span></h1>
            <a href="../login/logout.php" class="logout">Logout</a>
        </header>
        <div class="main-content">
            <div class="card">
                <h2>Project Management</h2>
                <a href="../project/pannel/project.html">프로젝트 관리</a>
            </div>
            <div class="card">
                <h2>Panel Management</h2>
                <a href="../pannel/pannel_main.php">패널 관리</a>
            </div>
        </div>
    </div>
    <script>
        // 사용자 이름을 페이지 로드 시 미리 채워넣기 위한 스크립트
        // document.addEventListener("DOMContentLoaded", function() {
           // fetch("mypage.php")
               // .then(response => response.json())
              //  .then(data => {
            //        document.getElementById("user_name").textContent = data.username;
          //      });
        //});
    </script>
</body>
</html>