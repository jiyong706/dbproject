<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 리스트</title>
    <link rel="stylesheet" href="pannel_list.css">
</head>
<body>
    <?php
        $is_logged_in = isset($_SESSION['user_id']);
    ?>
    <div class="header">
        <a href="/index.php" class="logo">패널</a>
        <a href="/index.php">홈</a>
        <a href="/project/project.php">프로젝트</a>
        <a href="/project/pannel/pannel_list.php" class="active">패널</a>
        <?php if ($is_logged_in): ?>
            <a href="/login/logout.php">로그아웃</a>
            <a href="/mypage/mypage.php">마이페이지</a>
        <?php else: ?>
            <a href="/login/login.php">로그인</a>
        <?php endif; ?>
    </div>
    <div class="main">
        <h1>패널</h1>
        <p>패널 정보를 관리하세요!</p>
        <a href="/project/pannel/create_pannel.php" class="btn">패널 생성하기</a>
    </div>
    <div class="panel_list">
        <?php
            // 파일 경로 설정
            $root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php"; 

            include_once $root;

            if (!isset($_SESSION['user_id'])) {
                echo "<script>alert('로그인 해주세요');</script>";
                header("Location: /login/login.php");
                exit;
            }

            $id = $_SESSION['user_id'];
            if ($conn) {
                $sql = "SELECT pannel_id, pannel_name, pannel_info FROM pannel_table WHERE project_id = :id";
                $stid = oci_parse($conn, $sql);
                oci_bind_by_name($stid, ":id", $id);
                oci_execute($stid);

                while (($row = oci_fetch_assoc($stid)) != false) {
                    echo "<div class='panel'>";
                    echo "<h2>" . htmlspecialchars($row['PANNEL_NAME'], ENT_QUOTES, 'UTF-8') . "</h2>";
                    echo "<p>" . htmlspecialchars($row['PANNEL_INFO'], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "</div>";
                }

                oci_free_statement($stid);
                oci_close($conn);
            } else {
                $_SESSION['error'] = '데이터베이스 연결에 실패했습니다.';
                echo "<script>alert('데이터베이스 연결에 실패했습니다.')</script>";
                header("Location: /index.php");
            }
        ?>
    </div>
</body>
</html>
