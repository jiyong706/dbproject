<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PillEat 로그인</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        window.onload = function() {
            <?php
            session_start();
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
                <header>PillEat</header>
                <p>로그인 하여 PillEat!</p>
                <form action="login_process.php" method="POST">
                    <div class="field">
                        <input type="text" name="id" placeholder="id" required>
                    </div>
                    <div class="field">
                        <input type="password" name="pw" placeholder="pw" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="link">
                        <a href="find_info.php">회원정보 찾기</a>
                        <a href="signup_step1.php">회원가입</a>
                    </div>
                    <div class="field">
                        <input type="submit" value="로그인">
                    </div>
                </form>
                <footer>
                    <p>Team_debug</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    <a href="admin_login.php">관리자 로그인</a>
                </footer>
            </div>
        </div>
    </div>
    <script src="pass-show-hide.js"></script>
</body>
</html>
