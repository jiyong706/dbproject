<?php
session_start();
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['error'] = '비밀번호가 일치하지 않습니다.';
            header("Location: signup_step2.php");
            exit();
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // 사용자 아이디와 비밀번호를 세션에 저장
        $_SESSION['password'] = $password;

        // 비밀번호가 일치할 때 다음 단계로 이동
        header("Location: signup_step3.php");
        exit();
    } else {
        $_SESSION['error'] = '모든 필드를 입력해주세요.';
        header("Location: signup_step2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - Step 2</title>
    <link rel="stylesheet" href="signup.css">
    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['error'])) {
                echo 'alert("' . $_SESSION['error'] . '");';
                unset($_SESSION['error']);
            }
            ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>비밀번호를 입력해주세요</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="field">
                    <input type="password" name="password" placeholder="비밀번호" required>
                </div>
                <div class="field">
                    <input type="password" name="confirm_password" placeholder="비밀번호 확인" required>
                </div>
                <div class="field">
                    <input type="submit" value="계속하기">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
