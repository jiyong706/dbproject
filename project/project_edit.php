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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $project_name = $_POST['project_name'];
        $project_info = $_POST['project_info'];

        $sql = "UPDATE project SET project_name = :project_name, project_info = :project_info, project_update = SYSDATE WHERE project_id = :project_id";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':project_id', $project_id);
        oci_bind_by_name($stid, ':project_name', $project_name);
        oci_bind_by_name($stid, ':project_info', $project_info);

        if (oci_execute($stid)) {
            echo "<script>alert('프로젝트가 수정되었습니다.'); location.replace('project_list.php');</script>";
        } else {
            $e = oci_error($stid);
            echo "프로젝트 수정 오류: " . $e['message'];
        }

        oci_free_statement($stid);
        oci_close($conn);
    } else {
        $project = getProjectDetails($project_id);
    }
} else {
    echo "<script>alert('유효하지 않은 요청입니다.'); location.replace('project_list.php');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 수정</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>프로젝트 수정</h1>
        </div>
        <form method="post" action="project_edit.php?project_id=<?php echo $project_id; ?>">
            <div class="form-group">
                <label for="project_name">프로젝트 이름:</label>
                <input type="text" id="project_name" name="project_name" value="<?php echo htmlspecialchars($project['PROJECT_NAME']); ?>" required>
            </div>
            <div class="form-group">
                <label for="project_info">프로젝트 설명:</label>
                <textarea id="project_info" name="project_info" required><?php echo htmlspecialchars($project['PROJECT_INFO']); ?></textarea>
            </div>
            <button type="submit">프로젝트 수정</button>
        </form>
    </div>
</body>
</html>
