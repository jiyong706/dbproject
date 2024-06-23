<?php
    include_once "/Users/baggyeonghwan/dbproject/DB/config.php";

    $stid = oci_parse($conn, "SELECT * FROM response_table");
    oci_execute($stid);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>응답 페이지</title>
    <link rel="stylesheet" href="styles.css"> <!-- styles.css 파일을 맞춰서 설정 -->
    <style>
        body {
            background: url('이미지') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    
    </style>
</head>
<body>
    <div class="header">
        <a href="/index.php" class="logo">패널</a>
        <a href="/index.php">홈</a>
        <a href="/project/project.php">프로젝트</a>
        <a href="/service.php">서비스</a>
        <a href="/contact.php">연락처</a>
        <a href="/login/login.php">로그인</a>
    </div>

    <div class="main">
        <div class="container">
            <div class="form-header">
                <h1>응답 내역</h1>
            </div>

            <?php
            while (($row = oci_fetch_assoc($stid)) != false) {
                echo "<div class='form-group'>";
                echo "<label>응답 ID: </label>";
                echo "<p>" . htmlspecialchars($row['RESP_ID'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label>사용자 ID: </label>";
                echo "<p>" . htmlspecialchars($row['USER_ID'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label>질문 ID: </label>";
                echo "<p>" . htmlspecialchars($row['QUESTION_ID'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label>응답 내용: </label>";
                echo "<p>" . htmlspecialchars($row['RESP_TEXT'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label>응답 일자: </label>";
                echo "<p>" . htmlspecialchars($row['RESP_DATE'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";

                echo "<hr>";
            }
            ?>

        </div>
    </div>
</body>
</html>

<?php
    oci_close($conn);
?>

