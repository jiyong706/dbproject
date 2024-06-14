<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 메인페이지</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>패널 메인페이지</h1>
            <nav>
                <ul>
                    <li><a href="#home">홈</a></li>
                    <li><a href="#about">소개</a></li>
                    <li><a href="#services">서비스</a></li>
                    <li><a href="#contact">연락처</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home">
        <div class="container">
            <h2>환영합니다!</h2>
            <p>패널 메인페이지에 오신 것을 환영합니다. 여기서 다양한 정보를 확인하실 수 있습니다.</p>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <h2>소개</h2>
            <p>우리 패널에 대해 더 알고 싶으신가요? 여기에 간단한 소개가 있습니다.</p>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <h2>서비스</h2>
            <p>다양한 서비스를 제공합니다. 자세한 내용은 아래를 참조하세요.</p>
            <ul>
                <?php
                // 서비스 목록을 배열로 정의
                $services = ["서비스 1", "서비스 2", "서비스 3"];
                // 배열을 루프하여 리스트 항목으로 출력
                foreach ($services as $service) {
                    echo "<li>$service</li>";
                }
                ?>
            </ul>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <h2>연락처</h2>
            <p>문의사항이 있으시면 아래 정보를 통해 연락주세요.</p>
            <address>
                <p>Email: example@example.com</p>
                <p>Phone: 010-1234-5678</p>
            </address>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> 패널 메인페이지. 모든 권리 보유.</p>
        </div>
    </footer>
</body>
</html>
