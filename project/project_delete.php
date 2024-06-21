<?php
session_start();
if (!isset($_SESSION['user_nickname'])) {
    echo "<script>alert('로그인해주세요'); location.replace('../login/login.php');</script>";
    exit();
}

include_once '../user/config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $user_id = $_SESSION['user_nickname']; // assuming user_nickname is the user ID

    $sql = "DELETE FROM project_table 
            WHERE project_id = :project_id 
            AND user_id = (SELECT user_id FROM user_table WHERE user_userid = :user_id)";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':project_id', $project_id);
    oci_bind_by_name($stid, ':user_id', $user_id);

    if (oci_execute($stid)) {
        echo "<script>alert('프로젝트가 삭제되었습니다.'); location.replace('project_list.php');</script>";
    } else {
        $e = oci_error($stid);
        echo "프로젝트 삭제 오류: " . $e['message'];
    }

    oci_free_statement($stid);
    oci_close($conn);
} else {
    echo "<script>alert('유효하지 않은 요청입니다.'); location.replace('project_list.php');</script>";
    exit();
}
?>
