<?php
// 파일 경로 설정 $root = "/Users/baggyeonghwan/dbproject/DB/user/data_select_user.php"; 
// azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
// 윈도우용 
$root = "C:\\Users\\pc\\Documents\\dbproject\\DB\\user\\data_select_user.php";

include_once $root;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['pw'])) {
        $id = $_POST['id'];
        $password = $_POST['pw'];

        // 데이터베이스에서 사용자 정보 조회
        $sql = "SELECT user_userid, user_name, user_pw FROM user_table WHERE user_userid = :id";
        
        $stmt = oci_parse($conn, $sql);

        if ($stmt === false) {
            $e = oci_error($conn);
            error_log('쿼리 준비에 실패했습니다: ' . htmlspecialchars($e['message']));
            $_SESSION['error'] = '쿼리 준비에 실패했습니다.';
            echo "<script>alert('쿼리 준비에 실패했습니다.'); window.location.href = '/login/login.php';</script>";
            exit();
        }

        // 바인드 변수 할당
        oci_bind_by_name($stmt, ':id', $id);

        // 쿼리 실행
        $result = oci_execute($stmt);

        if ($result === false) {
            $e = oci_error($stmt);
            error_log('쿼리 실행에 실패했습니다: ' . htmlspecialchars($e['message']));
            echo "<script>alert('쿼리 실행에 실패했습니다.'); window.location.href = '/login/login.php';</script>";
            header("Location: /login/login.php");
            exit();
        }

        // 결과 가져오기
        $row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);

        if ($row != false) {
            $db_userid = $user_userid;
            $name = $user_name;
            $db_password = "$user_pw";

            $db_password = password_hash($db_password, PASSWORD_BCRYPT);

            // 비밀번호 검증
            if (password_verify($password, $db_password)) {
                $_SESSION['userid'] = $db_userid;
                $_SESSION['name'] = $name;
                $test1 = $_SESSION['userid'];
                $test2 = $_SESSION['name'];
                echo "<script>alert('$test1 $test2')</script>";
                echo "<script>alert('$name 님 안녕하세요?'); window.location.href = '/index.php';</script>";
                exit();
            } else {
                error_log('잘못된 비밀번호입니다.');
                $_SESSION['error'] = '잘못된 비밀번호입니다.';
                echo "<script>alert('잘못된 비밀번호입니다.'); window.location.href = '/login/login.php';</script>";
                exit();
            }
        } else {
            error_log('존재하지 않는 아이디입니다.');
            $_SESSION['error'] = '존재하지 않는 아이디입니다.';
            echo "<script>alert('존재하지 않는 아이디입니다.'); window.location.href = '/login/login.php';</script>";
            exit();
        }
        
        // 리소스 해제
        oci_free_statement($stmt);
    } else {
        error_log('아이디와 비밀번호를 입력해주세요.');
        $_SESSION['error'] = '아이디와 비밀번호를 입력해주세요.';
        echo "<script>alert('아이디와 비밀번호를 입력해주세요.'); window.location.href = '/login/login.php';</script>";
        exit();
    }
} else {
    error_log('잘못된 요청입니다.');
    $_SESSION['error'] = '잘못된 요청입니다.';
    echo "<script>alert('잘못된 요청입니다.'); window.location.href = '/login/login.php';</script>";
    exit();
}

// 데이터베이스 연결 종료
oci_close($conn);
?>