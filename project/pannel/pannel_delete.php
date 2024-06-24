<?php
session_start();
include_once "../DB/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pannel_id'])) {
    $pannel_id = $_GET['pannel_id'];

    // Delete panel from database
    $sql = "DELETE FROM pannel_table WHERE pannel_id = :pannel_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':pannel_id', $pannel_id);
    $result = oci_execute($stmt);

    if ($result) {
        echo "<script>alert('패널이 성공적으로 삭제되었습니다.');</script>";
    } else {
        $e = oci_error($stmt);
        echo "Error: " . htmlentities($e['message']);
    }

    oci_free_statement($stmt);
    
    // Redirect back to panel list
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo "삭제 완료";
    }
} else {
    echo "패널 ID가 제공되지 않았습니다.";
    exit;
}
?>
