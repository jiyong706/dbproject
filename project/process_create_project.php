<?php
session_start();
include 'C:/Users/pc/Documents/dbproject/DB/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = $_POST['project_name'];
    $project_password = $_POST['project_password'];
    $user_id = $_SESSION['user_id']; // 로그인한 사용자 ID

    if ($conn) {
        // Prepare the SQL statement
        $sql = "INSERT INTO project_table (project_id, project_name, project_password, user_id) VALUES (project_seq.NEXTVAL, :project_name, :project_password, (select user_id from user_table where user_userid = :user_id))";
        $stmt = oci_parse($conn, $sql);

        // Bind the variables
        oci_bind_by_name($stmt, ':project_name', $project_name);
        oci_bind_by_name($stmt, ':project_password', $project_password);
        oci_bind_by_name($stmt, ':user_id', $user_id);

        // Execute the statement
        $result = oci_execute($stmt);

        if ($result) {
            echo "<script>alert('프로젝트가 성공적으로 생성되었습니다.');</script>";
            header("Location: /project/project.php");
        } else {
            $e = oci_error($stmt);
            echo "Error: " . $e['message'];
        }

        oci_free_statement($stmt);
        oci_close($conn);
    } else {
        echo "<script>alert('데이터베이스 연결에 실패했습니다.');</script>";
        header("Location: /index.php");
    }
}
?>