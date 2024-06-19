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
        <!--여기서부터 php 활용-->
            <?php
             
            ?>
    
            <p>설문지 설명</p>
        </div>
        <form method="post" action="submit.php">
            <div class="question-container">
                <div class="question-header">
                    <input type="text" name="question_title" placeholder="제목없는 질문">
                    <select name="question_type">
                        <option value="multiple_choice">객관식 질문</option>
                        <option value="multiple_choice">주관식 질문</option>
                        <!-- 다른 질문 유형을 추가할 수 있습니다 -->
                    </select>
                </div>
                <div class="options">
                    <div class="option">
                        <input type="radio" name="option" disabled>
                        <input type="text" name="option_text[]" placeholder="옵션 1">
                    </div>
                    <div class="option">
                        <input type="radio" name="option" disabled>
                        <input type="text" name="option_text[]" placeholder="옵션 추가 또는 '기타' 추가">
                    </div>
                </div>
            </div>
            <button type="submit">제출</button>
        </form>
    </div>
</body>
</html>
