<?php
// 맥용 
$root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php";
// azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
// 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";
// 기타 OS $root = "여기에 절대 경로 입력";

session_start();
include_once $root;

if (isset($_SERVER["REQUEST_METHOD"]) !== null) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];

        // 중복된 ID(이메일) 확인
        $sql = "SELECT user_userid FROM user_table WHERE user_userid = ':s'";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid,':s', $id);
        $result = oci_execute($conn, $sql);
        $row = oci_fetch_array($stid);

        if ($row != 0) {
            $_SESSION['error'] = '아이디가 중복되었습니다.';
            header("Location: signup_step1.php");
            exit();
        }

        $_SESSION['id'] = $id;
        header("Location: signup_step2.php"); // 중복되지 않은 경우 다음 단계로 진행
        
        oci_commit($conn);
        oci_free_statement($stmt);
        oci_close($conn);

        exit();
    } else {
        $_SESSION['error'] = '아이디를 입력해주세요.';
        header("Location: signup_step1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - Step 1</title>
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
            <h1>패널 관리를 위한 첫걸음 회원가입!</h1>
            <p>먼저 사용할 아이디를 입력해주세요</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="field">
                    <input type="text" name="id" placeholder="아이디" required>
                </div>
                <div class="field">
                    <input type="submit" value="계속하기">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
