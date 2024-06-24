<?php
session_start();
include_once "../DB/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pannel_id'])) {
    $pannel_id = $_GET['pannel_id'];

    // Retrieve panel information
    $sql = "SELECT * FROM pannel_table WHERE pannel_id = :pannel_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':pannel_id', $pannel_id);
    oci_execute($stmt);

    $row = oci_fetch_assoc($stmt);
    $pannel_name = $row['PANNEL_NAME'];
    $pannel_standard = $row['PANNEL_STANDARD'];
    $pannel_info = $row['PANNEL_INFO'];
} else {
    echo "패널 ID가 제공되지 않았습니다.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pannel_id = $_POST['pannel_id'];
    $pannel_name = $_POST['pannel_name'];
    $pannel_standard = $_POST['pannel_standard'];
    $pannel_info = $_POST['pannel_info'];

    // Update panel information
    $sql = "UPDATE pannel_table 
            SET pannel_name = :pannel_name, 
                pannel_standard = :pannel_standard, 
                pannel_info = :pannel_info, 
                pannel_updatedate = sysdate 
            WHERE pannel_id = :pannel_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':pannel_name', $pannel_name);
    oci_bind_by_name($stmt, ':pannel_standard', $pannel_standard);
    oci_bind_by_name($stmt, ':pannel_info', $pannel_info);
    oci_bind_by_name($stmt, ':pannel_id', $pannel_id);
    $result = oci_execute($stmt);

    if ($result) {
        echo "<script>alert('패널 정보가 성공적으로 수정되었습니다.');</script>";
        header("Location: /project/pannel_list.php?project_id=" . $row['PROJECT_ID']);
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error: " . htmlentities($e['message']);
    }

    oci_free_statement($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>패널 수정</title>
</head>
<body>
    <h2>패널 수정</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="pannel_id" value="<?php echo $pannel_id; ?>">
        
        <label for="pannel_name">패널 이름:</label>
        <input type="text" id="pannel_name" name="pannel_name" value="<?php echo $pannel_name; ?>" required><br><br>
        
        <label for="pannel_standard">패널 표준:</label>
        <input type="text" id="pannel_standard" name="pannel_standard" value="<?php echo $pannel_standard; ?>" required><br><br>
        
        <label for="pannel_info">패널 정보:</label><br>
        <textarea id="pannel_info" name="pannel_info" rows="4" cols="50"><?php echo $pannel_info; ?></textarea><br><br>
        
        <input type="submit" value="수정">
    </form>
    
    <br>
    <a href="/project/pannel_list.php?project_id=<?php echo $row['PROJECT_ID']; ?>">돌아가기</a>
</body>
</html>
