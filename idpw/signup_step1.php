<?php
session_start();
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];

        // 중복된 ID(이메일) 확인
        $check_sql = "SELECT id FROM users WHERE id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $id);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $_SESSION['error'] = '아이디가 중복되었습니다.';
            header("Location: signup_step1.php");
            exit();
        }

        $_SESSION['id'] = $id;
        header("Location: signup_step2.php"); // 중복되지 않은 경우 다음 단계로 진행
        exit();
    } else {
        $_SESSION['error'] = '아이디를 입력해주세요.';
        header("Location: signup_step1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - Step 1</title>
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
            <h1>효율적으로 약관리를 시작해봐요</h1>
            <p>먼저 사용하시는 아이디를 입력해주세요</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="field">
                    <input type="email" name="id" placeholder="아이디(이메일)" required>
                </div>
                <div class="field">
                    <input type="submit" value="계속하기">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
