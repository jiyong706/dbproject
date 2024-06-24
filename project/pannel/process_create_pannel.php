<?php
session_start();
include 'C:\Users\pc\Documents\dbproject\DB\config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pannel_name = $_POST['pannel_name'];
    $pannel_info = $_POST['pannel_info'];
    $project_id = $_SESSION['user_id']; // 패널을 생성할 때 연관된 프로젝트 ID

    if ($conn) {
        // Prepare the SQL statement
        $sql = "INSERT INTO pannel_table (pannel_name, pannel_info, project_id) VALUES (:pannel_name, :pannel_info, :project_id)";
        $stmt = oci_parse($conn, $sql);

        // Bind the variables
        oci_bind_by_name($stmt, ':pannel_name', $pannel_name);
        oci_bind_by_name($stmt, ':pannel_info', $pannel_info);
        oci_bind_by_name($stmt, ':project_id', $project_id);

        // Execute the statement
        $result = oci_execute($stmt);

        if ($result) {
            echo "<script>alert('패널이 성공적으로 생성되었습니다.');</script>";
            header("Location: /project/pannel/pannel_list.php");
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
