<?php
include_once '..DB/config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('먼저 로그인을 해주세요!')</script>";
    header("Location: ../login/login.php");
    exit();
}

$e = oci_error();

if (!$conn){
    die("Connection failed: ". oci_error());
    $_SESSION['error'] = "데이터베이스 오류입니다 :" + oci_error(); 
    echo "<script>alert('데이터베이스 오류입니다! : ')</script>";
} else if ($e !== null){
    $_SESSION['error'] = "데이터베이스 오류입니다 :" + oci_error(); 
    echo "<script>alert('데이터베이스 오류입니다! : ')</script>";
}

$username = $_SESSION['user_name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT username FROM users WHERE username = ':s'";
    oci_bind_by_name($conn, "s", $username);
    
    $result = oci_execute($conn, $sql);
    $user = oci_fetch_assoc($result[]);
    
    oci_close($conn);
    echo json_encode($user);
}
?>

