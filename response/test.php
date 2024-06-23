<?php
session_start();
include_once "../user/config.php";

$user_id = $_SESSION['user_id'];

$question_id = $_POST['question_id'];

$conn = oci_connect(DB_USERNAME, DB_PASSWORD, DB_CONNECTION_STRING);
if (!$conn) {
    $error_message = oci_error();
    die("데이터베이스 연결 실패: " . $error_message['message']);
}

$sql_user_response = "SELECT resp_text
                     FROM response_table
                     WHERE user_id = :user_id AND question_id = :question_id";

$stid_user_response = oci_parse($conn, $sql_user_response);
oci_bind_by_name($stid_user_response, ":user_id", $user_id);
oci_bind_by_name($stid_user_response, ":question_id", $question_id);

$result_user_response = oci_execute($stid_user_response);
if (!$result_user_response) {
    $error_message = oci_error($stid_user_response);
    die("사용자 응답 조회 실패: " . $error_message['message']);
}

$user_response = "";

if ($row_user_response = oci_fetch_assoc($stid_user_response)) {
    $user_response = $row_user_response['RESP_TEXT'];
}

oci_free_statement($stid_user_response);

$sql_responses = "SELECT resp_text, COUNT(*) AS num_responses
                 FROM response_table
                 WHERE question_id = :question_id
                 GROUP BY resp_text";

$stid_responses = oci_parse($conn, $sql_responses);
oci_bind_by_name($stid_responses, ":question_id", $question_id);

$result_responses = oci_execute($stid_responses);
if (!$result_responses) {
    $error_message = oci_error($stid_responses);
    die("응답 선택 비율 조회 실패: " . $error_message['message']);
}

echo "<h2>질문 ID: $question_id</h2>";

echo "<h3>나의 응답:</h3>";
if (!empty($user_response)) {
    echo "<p>$user_response</p>";
} else {
    echo "<p>아직 해당 질문에 대한 응답이 없습니다.</p>";
}

echo "<h3>참여자의 응답 선택 비율:</h3>";
$total_responses = 0;

while ($row_responses = oci_fetch_assoc($stid_responses)) {
    $resp_text = $row_responses['RESP_TEXT'];
    $num_responses = $row_responses['NUM_RESPONSES'];

    $total_responses += $num_responses;

    $selection_ratio = ($num_responses / $total_responses) * 100;

  
    echo "<p>$resp_text: $num_responses 개 ($selection_ratio%)</p>";
}


oci_free_statement($stid_responses);
oci_close($conn);
?>

// OCI statement 해제
oci_free_statement($stid_responses);
// 데이터베이스 연결 닫기
oci_close($conn);
?>
