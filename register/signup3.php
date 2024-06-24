<?php
// 맥용 
$root = "C:/Users/313/Documents/GitHub/dbproject/DB/user/config.php";
// azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
// 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";
// 기타 OS $root = "여기에 절대 경로 입력";

// 오류처리 코드
if(!include_once $root){
    $_SESSION['error'] = '필요한 파일을 불러오지 못했습니다.';
    echo "<script>alert('필요한 파일을 불러오지 못했습니다.'); window.location.href = '/login/login.php';</script>";
} else {
    include_once $root;
}
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['user_name']) && !empty($_POST['user_old']) && !empty($_POST['user_email']) && !empty($_POST['user_gender'])) {
        $id = $_SESSION['user_id'];
        $password = $_SESSION['user_pw'];
        $user_name = $_POST['user_name'];
        $user_old = $_POST['user_old'];
        $user_email = $_POST['user_email'];
        $user_sex = $_POST['user_gender'];

        $sql = "INSERT INTO user_table (user_id, user_userid, user_name, user_pw, user_email, user_sex, user_old, user_registerdate, user_lastlogin) 
                VALUES (user_seq.NEXTVAL, :user_userid, :user_name, :user_pw, :user_email, :user_sex, :user_old, sysdate, sysdate)";
        $stmt = oci_parse($conn, $sql);
        
        oci_bind_by_name($stmt, ':user_userid', $id);
        oci_bind_by_name($stmt, ':user_name', $user_name);
        oci_bind_by_name($stmt, ':user_pw', $password);
        oci_bind_by_name($stmt, ':user_email', $user_email);
        oci_bind_by_name($stmt, ':user_sex', $user_sex);
        oci_bind_by_name($stmt, ':user_old', $user_old);

        if (oci_execute($stmt)) {
            // 성공적으로 삽입된 경우
            oci_commit($conn);
            oci_free_statement($stmt);
            oci_close($conn);

            // 세션 변수 삭제
            unset($_SESSION['id']);
            unset($_SESSION['password']);

            header("Location: signup_success.php");
            exit();
        } else {
            // 삽입 실패한 경우
            oci_free_statement($stmt);
            oci_close($conn);

            $_SESSION['error'] = '회원가입에 실패했습니다. 다시 시도해주세요.';
            header("Location: signup3.php");
            exit();
        }
    } else {
        $_SESSION['error'] = '모든 필드를 입력해주세요.';
        header("Location: signup3.php");
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
                    <input type="number" name="user_old" placeholder="나이" required>
                </div>
                <div class='field'>
                    성별
                    <select name="user_gender" required>
                        <option value="M">남자</option>
                        <option value="F">여자</option>
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
