<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="header">
        <a href="/index.php" class="logo">패널</a>
        <a href="/index.php">홈</a>
        <a href="/project/project.php" class="active">프로젝트</a>
        <a href="/service.php">서비스</a>
        <a href="/contact.php">연락처</a>
        <a href="/login/login.php">로그인</a>
    </div>
    <div class="main">
        <h1>프로젝트</h1>
        <p>다양한 프로젝트와 새로운 기회를 발견하세요.</p>
        <a href="/project/create_project.php" class="btn">프로젝트 생성</a>
    </div>
    <div class="project_list">
        <?php
            // 파일 경로 설정
            $root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php"; 
            // azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
            // 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";

            include_once $root;

            session_start();
            if (!isset($_SESSION['id'])) {
                echo "<script>alert('로그인 해주세요');</script>";
                header("Location: /login/login.php");
                exit;
            }

            $id = $_SESSION['id'];
            if ($conn) {
                $sql = "SELECT project_id, project_name, project_info, project_createdate, project_update FROM project WHERE user_id = (SELECT user_id FROM user WHERE id = :id)";
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
