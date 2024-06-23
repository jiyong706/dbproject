<?php
session_start();

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 메인페이지</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        $is_logged_in = isset($_SESSION['user_id']);
    ?>
    <header>
        <div class="container">
            <div class="logo">
                <h1>패널</h1>
            </div>
            <nav class="selection">
                <ul>
                    <li><a href="#">홈</a></li>
                    <li><a href="/project/project.php">프로젝트</a></li>
                    <li>
                        <?php if ($is_logged_in): ?>
                            <a href="/login/logout.php">로그아웃</a>
                            <a href="/mypage/mypage.php">마이페이지</a>
                        <?php else: ?>
                            <a href="/login/login.php">로그인</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="hero">
        <div class="hero-text">
            <h1>CONNECT EVERYTHING</h1>
            <p>새로운 연결, 더 나은 세상, 패널</p>
            <p>패널은 다양한 사람들과 조사를 통해 소통하는 플랫폼입니다.</p>
            <button onclick="scrollToContent()">더 알아보기</button>
        </div>
    </div>
    
    <section id="services">
        <div class="container">
            <h2>서비스</h2>
            <p>다양한 서비스를 제공합니다. 자세한 내용은 아래를 참조하세요.</p>
            <ul>
                <li>조사</li>
                <li>프로젝트 관리 및 개설</li>
                <li>패널 관리 및 개설</li>
            </ul>
        </div>
    </section>    

    <footer>
    </footer>

    <script src="script.js"></script>
</body>
</html>