<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <?php
        $is_logged_in = isset($_SESSION['user_id']);
    ?>
    <div class="header">
        <a href="/index.php" class="logo">패널</a>
        <a href="/index.php">홈</a>
        <a href="/project/project.php" class="active">프로젝트</a>
        <a href="/project/pannel/pannel_list.php" >패널</a>
        <?php if ($is_logged_in): ?>
            <a href="/login/logout.php">로그아웃</a>
            <a href="/mypage/mypage.php">마이페이지</a>
        <?php else: ?>
            <a href="/login/login.php">로그인</a>
        <?php endif; ?>
    </div>
    <div class="main">
        <h1>프로젝트</h1>
        <p>다양한 프로젝트를 만들어 보고 관리해보세요!</p>
        <a href="/project/create_project.php" class="btn">프로젝트 생성</a>
        <a href="/project/project_list.php" class="btn">프로젝트 목록</a>
    </div>
    <div class="project_list">
        <?php
            // 파일 경로 설정
            $root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php"; 
            // azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
            // 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";

            include_once $root;

            if (!isset($_SESSION['user_id'])) {
                echo "<script>alert('로그인 해주세요');</script>";
                header("Location: /login/login.php");
                exit;
            }

            $id = $_SESSION['user_id'];
            if ($conn) {
                $sql = "SELECT project_id, project_name, project_info, project_createdate, project_update FROM project_table WHERE user_id = (SELECT user_id FROM user_table WHERE user_userid = :id)";
                $stid = oci_parse($conn, $sql);
                oci_bind_by_name($stid, ":id", $id);
                oci_execute($stid);

                while (($row = oci_fetch_assoc($stid)) != false) {
                    echo "<div class='project'>";
                    echo "<h2>" . htmlspecialchars($row['PROJECT_NAME'], ENT_QUOTES, 'UTF-8') . "</h2>";
                    echo "<p>" . htmlspecialchars($row['PROJECT_INFO'], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<p>생성일: " . htmlspecialchars($row['PROJECT_CREATEDATE'], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<p>업데이트: " . htmlspecialchars($row['PROJECT_UPDATE'], ENT_QUOTES, 'UTF-8') . "</p>";
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

