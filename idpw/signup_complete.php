<?php
include_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id']) && isset($_SESSION['password']) && !empty($_POST['last_name']) && !empty($_POST['first_name']) && !empty($_POST['birthdate'])) {
        $id = $_SESSION['id'];
        $password = $_SESSION['password'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $birthdate = $_POST['birthdate'];

        // 사용자를 데이터베이스에 삽입
        $insert_sql = "INSERT INTO users (id, password, last_name, first_name, birthdate) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssss", $id, $password, $last_name, $first_name, $birthdate);

        if ($insert_stmt->execute()) {
            // 성공적으로 삽입된 경우
            header("Location: signup_success.php");
            exit();
        } else {
            // 삽입 실패한 경우
            $_SESSION['error'] = '회원가입에 실패했습니다. 다시 시도해주세요.';
            header("Location: signup_step3.php");
            exit();
        }
    } else {
        $_SESSION['error'] = '모든 필드를 입력해주세요.';
        header("Location: signup_step3.php");
        exit();
    }
}
?>
