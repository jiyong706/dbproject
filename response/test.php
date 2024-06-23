<?php
include_once "../user/config.php";

$user_id = $_POST['user_id'];

$sql = "SELECT * FROM user_table WHERE user_userid = :user_id";

$conn = oci_connect(DB_USERNAME, DB_PASSWORD, DB_CONNECTION_STRING);
if (!$conn) {
    $error_message = oci_error();
    die("데이터베이스 연결 실패: " . $error_message['message']);
}

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":user_id", $user_id);

$result = oci_execute($stid);
if (!$result) {
    $error_message = oci_error($stid);
    die("쿼리 실행 실패: " . $error_message['message']);
}

while ($row = oci_fetch_assoc($stid)) {
    $resp_id = $row['RESP_ID'];
    $user_id = $row['USER_ID'];
    $question_id = $row['QUESTION_ID'];
    $resp_text = $row['RESP_TEXT'];
    $resp_date = $row['RESP_DATE'];

    echo "RESP ID: " . htmlspecialchars($resp_id, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "User ID: " . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Question ID: " . htmlspecialchars($question_id, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Response Text: " . htmlspecialchars($resp_text, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "Response Date: " . htmlspecialchars($resp_date, ENT_QUOTES, 'UTF-8') . "<br>";
}

oci_free_statement($stid);

oci_close($conn);
?>
