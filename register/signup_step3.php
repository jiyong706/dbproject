<?php
// 맥용 $root = "/Users/baggyeonghwan/Desktop/dbproject/DB/config.php";
// azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
// 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";
// 기타 OS $root = "여기에 절대 경로 입력";

include_once "$root";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['user_name']) && !empty($_POST['user_old'])) {
        $id = $_SESSION['id'];
        $password = $_SESSION['password'];
        $user_name = $_POST['user_name'];
        $user_old = $_POST['user_old'];
        $user_email = $_POST['user_email'];
        $user_sex = $_POST['gender_type'];

        $sql = "INSERT INTO user_table (user_id, user_userid, user_name, user_pw, user_email, user_sex, user_old, user_registerdate, user_lastlogin) VALUES (user_sql.NEXTVAL, 's', 's', 's', 's', 's', 's', 's', sysdate)";
        $stmt = oci_parse($sql);
        oci_bind_by_name("sssssss", $id, $user_name, $password, $user_email, 
        $user_sex, date(Y/M/D));
        oci_execute($stmt);

        // 세션 변수 삭제
        unset($_SESSION['id']);
        unset($_SESSION['password']);

        header("Location: signup_success.php");
        exit();
    } else {
        $_SESSION['error'] = '모든 필드를 입력해주세요.';
        header("Location: signup_step3.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - Step 3</title>
    <link rel="stylesheet" href="signup.css">
    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['error'])) {
                echo 'alert("' . $_SESSION['error'] . '");';
                unset($_SESSION['error']);
            }
            ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>회원 정보 입력</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="field">
                    <input type="text" name="user_name" placeholder="이름" required>
                </div>
                <div class="field">
                    <input type="email" name="user_email" placeholder="이메일" required>
                </div>
                <div class="field">
                    <input type="text" name="birthdate" placeholder="나이" required>
                </div>
                <div class='field'>
                    성별
                    <select name="gender_type">
                        <option value="multiple_choice" value="M">남자</option>
                        <option value="multiple_choice" value="F">여자</option>
                        <!-- 다른 질문 유형을 추가할 수 있습니다 -->
                    </select>
                </div>
                <div class="field">
                    <input type="submit" value="가입 완료">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
