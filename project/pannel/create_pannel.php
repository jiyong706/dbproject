<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}

include_once 'C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pannel_name = $_POST['pannel_name'];
    $pannel_info = $_POST['pannel_info'];
    $user_id = $_SESSION['user_nickname']; // assuming user_nickname is the user ID

    $sql = "INSERT INTO pannel_table (pannel_name, pannel_info, user_id, pannel_createdate, pannel_update) 
            VALUES (:pannel_name, :pannel_info, (SELECT user_id FROM user_table WHERE user_userid = :user_id), SYSDATE, SYSDATE)";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':pannel_name', $pannel_name);
    oci_bind_by_name($stid, ':pannel_info', $pannel_info);
    oci_bind_by_name($stid, ':user_id', $user_id);

    if (oci_execute($stid)) {
        echo "<script>alert('패널이 생성되었습니다.'); location.replace('pannel_list.php');</script>";
    } else {
        $e = oci_error($stid);
        echo "패널 생성 오류: " . $e['message'];
    }

    oci_free_statement($stid);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 생성</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>패널 생성</h1>
        </div>
        <form method="post" action="create_pannel.php">
            <div class="form-group">
                <label for="pannel_name">패널 이름:</label>
                <input type="text" id="pannel_name" name="pannel_name" required>
            </div>
            <div class="form-group">
                <label for="pannel_info">패널 설명:</label>
                <textarea id="pannel_info" name="pannel_info" required></textarea>
            </div>
            <button type="submit">패널 생성</button>
        </form>
    </div>
</body>
</html>

</body>
