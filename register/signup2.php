<?php
// 맥용 
$root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php";
// azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
// 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";
// 기타 OS $root = "여기에 절대 경로 입력";

session_start();

// 오류처리 코드
if(!include_once $root){
    $_SESSION['error'] = '필요한 파일을 불러오지 못했습니다.';
    echo "<script>alert('필요한 파일을 불러오지 못했습니다.'); window.location.href = '/login/login.php';</script>";
} else {
    include_once $root;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['error'] = '비밀번호가 일치하지 않습니다.';
            header("Location: signup2.php");
            exit();
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // 사용자 아이디와 비밀번호를 세션에 저장
        $_SESSION['user_pw'] = $password;

        // 비밀번호가 일치할 때 다음 단계로 이동
        header("Location: signup3.php");
        exit();
    } else {
        $_SESSION['error'] = '모든 필드를 입력해주세요.';
        header("Location: signup2.php");
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
