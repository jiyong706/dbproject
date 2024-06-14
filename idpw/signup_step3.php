<?php
include_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['birthdate'])) {
        $id = $_SESSION['id'];
        $password = $_SESSION['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birthdate = $_POST['birthdate'];

        $insert_sql = "INSERT INTO users (id, fname, lname, password) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssss", $id, $first_name, $last_name, $password);
        $insert_stmt->execute();

        // 세션 변수 삭제
        unset($_SESSION['id']);
        unset($_SESSION['password']);

        header("Location: signup_success.php");
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
    <title>회원가입 - Step 3</title>
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
            <h1>회원 정보 입력</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="field">
                    <input type="text" name="first_name" placeholder="성" required>
                </div>
                <div class="field">
                    <input type="text" name="last_name" placeholder="이름" required>
                </div>
                <div class="field">
                    <input type="text" name="birthdate" placeholder="생년월일(6자리)" required>
                </div>
                <div class="field">
                    <input type="submit" value="가입 완료">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
