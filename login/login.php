<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 사용자 로그인</title>
    <link rel="stylesheet" href="/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        <div class="wrapper">
            <div class="form">
                <header>Pannel</header>
                <p>로그인 하여 패널서비스를 이용하세요!</p>
                <form action="login_process.php" method="post">
                    <div class="field">
                        <input type="text" name="id" placeholder="id" required>
                    </div>
                    <div class="field">
                        <input type="password" name="pw" placeholder="pw" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="link">
                        <a href='/register/signup_step1.php'>회원가입</a>
                    </div>
                    <div class="field">
                        <input type="submit" value="로그인">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="pass-show-hide.js"></script>
</body>
</html>