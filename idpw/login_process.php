<?php
include_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['pw'])) {
        $id = $_POST['id'];
        $password = $_POST['pw'];

        // 데이터베이스에서 사용자 정보 조회
        $sql = "SELECT id, fname, lname, password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log('쿼리 준비에 실패했습니다: ' . htmlspecialchars($conn->error));
            $_SESSION['error'] = '쿼리 준비에 실패했습니다.';
            header("Location: login.php");
            exit();
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_id, $fname, $lname, $db_password);
            $stmt->fetch();

            // 비밀번호 검증
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $db_id;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                header("Location: index.php");
                exit();
            } else {
                error_log('잘못된 비밀번호입니다.');
                $_SESSION['error'] = '잘못된 비밀번호입니다.';
                header("Location: login.php");
                exit();
            }
        } else {
            error_log('존재하지 않는 아이디입니다.');
            $_SESSION['error'] = '존재하지 않는 아이디입니다.';
            header("Location: login.php");
            exit();
        }
    } else {
        error_log('아이디와 비밀번호를 입력해주세요.');
        $_SESSION['error'] = '아이디와 비밀번호를 입력해주세요.';
        header("Location: login.php");
        exit();
    }
} else {
    error_log('잘못된 요청입니다.');
    $_SESSION['error'] = '잘못된 요청입니다.';
    header("Location: login.php");
    exit();
}
?>
