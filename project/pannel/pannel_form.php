<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 생성</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <a href="/index.php" class="logo">패널</a>
        <a href="/index.php">홈</a>
        <a href="/project/project.php">프로젝트</a>
        <a href="/login/login.php">로그인</a>
    </div>
    <div class="main">
        <h1>패널 생성</h1>
        <p>새로운 패널을 생성하세요.</p>
        <form action="submit.php" method="post">
            <label for="pannel_name">패널 이름:</label>
            <input type="text" id="pannel_name" name="pannel_name" required>
            <label for="pannel_standard">기준:</label>
            <input type="text" id="pannel_standard" name="pannel_standard" required>
            <label for="pannel_info">정보:</label>
            <textarea id="pannel_info" name="pannel_info" required></textarea>
            <button type="submit" class="btn">패널 생성</button>
        </form>
    </div>
</body>
</html>

