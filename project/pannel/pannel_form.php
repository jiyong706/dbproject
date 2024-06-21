<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>설문지</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="survey-container">
        <div class="survey-header">
            <h1>이지패널 설문지</h1>
            <hr>
            <p>설문지 설명</p>
        </div>
        <form method="post" action="submit.php">
            <?php
                if (isset($_POST['add_question'])) {
                    $questions = $_POST['questions'];
                } else {
                    $questions = [];
                }

                // 기존 질문을 표시
                foreach ($questions as $index => $question) {
                    echo '<div class="question-container">';
                    echo '<div class="question-header">';
                    echo '<input type="text" name="questions[' . $index . '][title]" value="' . $question['title'] . '" placeholder="제목없는 질문">';
                    echo '<select name="questions[' . $index . '][type]">';
                    echo '<option value="multiple_choice"'.($question['type'] == 'multiple_choice' ? ' selected' : '').'>객관식 질문</option>';
                    echo '<option value="subjective"'.($question['type'] == 'subjective' ? ' selected' : '').'>주관식 질문</option>';
                    echo '</select>';
                    echo '</div>';

                    if ($question['type'] == 'multiple_choice') {
                        echo '<div class="options">';
                        foreach ($question['options'] as $optIndex => $option) {
                            echo '<div class="option">';
                            echo '<input type="radio" name="questions[' . $index . '][option]" disabled>';
                            echo '<input type="text" name="questions[' . $index . '][options][]" value="' . $option . '" placeholder="옵션">';
                            echo '</div>';
                        }
                        echo '<div class="option">';
                        echo '<input type="radio" name="questions[' . $index . '][option]" disabled>';
                        echo '<input type="text" name="questions[' . $index . '][options][]" placeholder="옵션 추가 또는 \'기타\' 추가">';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            ?>

            <!-- 새로운 질문 폼을 추가하기 위한 부분 -->
            <div class="question-container">
                <div class="question-header">
                    <input type="text" name="questions[new][title]" placeholder="제목없는 질문">
                    <select name="questions[new][type]">
                        <option value="multiple_choice">객관식 질문</option>
                        <option value="subjective">주관식 질문</option>
                    </select>
                </div>
                <div class="options">
                    <div class="option">
                        <input type="radio" name="option" disabled>
                        <input type="text" name="questions[new][options][]" placeholder="옵션 1">
                    </div>
                    <div class="option">
                        <input type="radio" name="option" disabled>
                        <input type="text" name="questions[new][options][]" placeholder="옵션 추가 또는 '기타' 추가">
                    </div>
                </div>
            </div>
            <button type="submit" name="add_question">질문 추가</button>
            <button type="submit" formaction="submit.php">제출</button>
        </form>
    </div>
</body>
</html>