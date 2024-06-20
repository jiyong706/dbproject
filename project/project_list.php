<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../login/login.php');</script>";
    exit();
}

include_once '../DB/data_select_project.php';

$user_id = $_SESSION['user_id'];
$projects = getProjectList($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 목록</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="create">
        <button onclick="location.href='create_project.php'">프로젝트 생성</button>    
    </div>
    <div class="project_list">
        <h2>프로젝트 목록</h2>
        <ul>
            <?php
            foreach ($projects as $project) {
                echo "<li>";
                echo "프로젝트 이름: " . htmlspecialchars($project['PROJECT_NAME']) . "<br>";
                echo "프로젝트 설명: " . htmlspecialchars($project['PROJECT_INFO']) . "<br>";
                echo "생성일: " . htmlspecialchars($project['PROJECT_CREATEDATE']) . "<br>";
                echo "업데이트일: " . htmlspecialchars($project['PROJECT_UPDATE']) . "<br>";
                echo "<a href='project_view.php?project_id=" . $project['PROJECT_ID'] . "'>보기</a> ";
                echo "<a href='project_edit.php?project_id=" . $project['PROJECT_ID'] . "'>수정</a> ";
                echo "<a href='project_delete.php?project_id=" . $project['PROJECT_ID'] . "' onclick=\"return confirm('정말로 이 프로젝트를 삭제하시겠습니까?');\">삭제</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

