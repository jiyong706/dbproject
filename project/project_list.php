<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}

include_once 'C:\Users\pc\Documents\dbproject\login\login_process.php';

if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . htmlentities($e['message'], ENT_QUOTES));
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT PROJECT_ID, PROJECT_NAME, PROJECT_INFO, PROJECT_CREATEDATE, PROJECT_UPDATE FROM project_table WHERE USER_ID = (select user_id from user_table where user_userid = :user_id)";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":user_id", $user_id);
oci_execute($stmt);

$projects = array();
while ($row = oci_fetch_assoc($stmt)) {
    $projects[] = $row;
}

oci_free_statement($stmt);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="ko">
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
                echo "<a href='project_view.php?project_id=" . htmlspecialchars($project['PROJECT_ID']) . "'>보기</a> ";
                echo "<a href='project_edit.php?project_id=" . htmlspecialchars($project['PROJECT_ID']) . "'>수정</a> ";
                echo "<a href='project_delete.php?project_id=" . htmlspecialchars($project['PROJECT_ID']) . "' onclick=\"return confirm('정말로 이 프로젝트를 삭제하시겠습니까?');\">삭제</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
