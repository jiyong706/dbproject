<?php
session_start();
include_once "../DB/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pannel_name = $_POST['pannel_name'];
    $pannel_standard = $_POST['pannel_standard'];
    $pannel_info = $_POST['pannel_info'];
    $project_id = $_POST['project_id']; // 해당 패널이 속하는 프로젝트 ID
    $user_id = $_SESSION['user_id']; // 현재 로그인한 사용자 ID

    // Prepare statement
    $sql = "INSERT INTO pannel_table (pannel_id, pannel_name, pannel_standard, pannel_info, project_id, user_id) 
            VALUES (pannel_seq.NEXTVAL, :pannel_name, :pannel_standard, :pannel_info, :project_id, 
            (SELECT user_id FROM user_table WHERE user_userid = :user_id))";
    $stmt = oci_parse($conn, $sql);

    // Bind parameters
    oci_bind_by_name($stmt, ':pannel_name', $pannel_name);
    oci_bind_by_name($stmt, ':pannel_standard', $pannel_standard);
    oci_bind_by_name($stmt, ':pannel_info', $pannel_info);
    oci_bind_by_name($stmt, ':project_id', $project_id);
    oci_bind_by_name($stmt, ':user_id', $user_id);

    // Execute statement
    $result = oci_execute($stmt);

    if ($result) {
        echo "<script>alert('패널이 성공적으로 생성되었습니다.');</script>";
        header("Location: /project/pannel_list.php?project_id=" . $project_id);
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
    <title>패널 생성</title>
</head>
<body>
    <h2>패널 생성</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="pannel_name">패널 이름:</label>
        <input type="text" id="pannel_name" name="pannel_name" required><br><br>
        
        <label for="pannel_standard">패널 표준:</label>
        <input type="text" id="pannel_standard" name="pannel_standard" required><br><br>
        
        <label for="pannel_info">패널 정보:</label><br>
        <textarea id="pannel_info" name="pannel_info" rows="4" cols="50"></textarea><br><br>
        
        <input type="hidden" name="project_id" value="<?php echo $_GET['project_id']; ?>">
        <input type="submit" value="생성">
    </form>
    
    <br>
    <a href="/project/pannel_list.php?project_id=<?php echo $_GET['project_id']; ?>">돌아가기</a>
</body>
</html>

