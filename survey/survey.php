<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}

include_once 'C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $survey_answers = $_POST['survey_answers'];
    $user_id = $_SESSION['user_id'];
    $pannel_id = $_POST['pannel_id'];

    foreach ($survey_answers as $question_id => $answer) {
        $sql = "INSERT INTO response (resp_ID, user_ID, question_ID, resp_text, resp_date) 
                VALUES (response_seq.NEXTVAL, :user_id, :question_id, :answer, SYSDATE)";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_bind_by_name($stid, ':question_id', $question_id);
        oci_bind_by_name($stid, ':answer', $answer);

        if (!oci_execute($stid)) {
            $e = oci_error($stid);
            echo "설문 저장 오류: " . $e['message'];
            exit();
        }

        oci_free_statement($stid);
    }

    oci_close($conn);
    echo "<script>alert('설문이 저장되었습니다.'); location.replace('survey_list.php');</script>";
    exit();
}

$pannel_id = $_GET['pannel_id'];
$sql = "SELECT question_ID, question_text FROM question WHERE pannel_ID = :pannel_id";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':pannel_id', $pannel_id);
oci_execute($stid);
$questions = [];
while ($row = oci_fetch_assoc($stid)) {
    $questions[] = $row;
}
oci_free_statement($stid);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>설문지</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>설문지</h1>
        </div>
        <form method="post" action="survey.php">
            <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label for="question_<?php echo $question['QUESTION_ID']; ?>"><?php echo htmlspecialchars($question['QUESTION_TEXT'], ENT_QUOTES, 'UTF-8'); ?></label>
                    <textarea id="question_<?php echo $question['QUESTION_ID']; ?>" name="survey_answers[<?php echo $question['QUESTION_ID']; ?>]" required></textarea>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="pannel_id" value="<?php echo $pannel_id; ?>">
            <button type="submit">설문 제출</button>
        </form>
    </div>
</body>
</html>
