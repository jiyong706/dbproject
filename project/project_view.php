<?php
session_start();
if (!isset($_SESSION['user_nickname'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../login/login.php');</script>";
    exit();
}

include_once '../user/config.php';
include_once '../DB/data_select_project.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $user_id = $_SESSION['user_nickname']; // assuming user_nickname is the user ID

    $sql = "SELECT project_id, project_name, project_info, project_createdate, project_update 
            FROM project_table 
            WHERE project_id = :project_id AND user_id = (SELECT user_id FROM user_table WHERE user_userid = :user_id)";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':project_id', $project_id);
    oci_bind_by_name($stid, ':user_id', $user_id);
    oci_execute($stid);
    
    $project = oci_fetch_assoc($stid);
    
    if (!$project) {
        echo "<script>alert('프로젝트를 찾을 수 없습니다.'); location.replace('project_list.php');</script>";
        exit();
    }

    oci_free_statement($stid);
    oci_close($conn);
} else {
    echo "<script>alert('유효하지 않은 요청입니다.'); location.replace('project_list.php');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 보기</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="container">
        <h1>프로젝트 정보</h1>
        <p>프로젝트 이름: <?php echo htmlspecialchars($project['PROJECT_NAME']); ?></p>
        <p>프로젝트 설명: <?php echo htmlspecialchars($project['PROJECT_INFO']); ?></p>
        <p>생성일: <?php echo htmlspecialchars($project['PROJECT_CREATEDATE']); ?></p>
        <p>업데이트일: <?php echo htmlspecialchars($project['PROJECT_UPDATE']); ?></p>
        <button onclick="location.href='project_list.php'">목록으로 돌아가기</button>
    </div>
</body>
</html>



