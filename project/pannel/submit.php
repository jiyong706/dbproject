<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionTitle = $_POST['question_title'];
    $questionType = $_POST['question_type'];
    $optionTexts = $_POST['option_text'];

    // 여기서 받은 데이터를 처리합니다. 예를 들어, 데이터베이스에 저장할 수 있습니다.

    echo "질문 제목: " . htmlspecialchars($questionTitle) . "<br>";
    echo "질문 유형: " . htmlspecialchars($questionType) . "<br>";
    echo "옵션들:<br>";
    foreach ($optionTexts as $option) {
        echo htmlspecialchars($option) . "<br>";
    }
}
?>