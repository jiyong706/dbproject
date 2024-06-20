<?php
include_once "/Users/baggyeonghwan/dbproject/DB/user/data_select_user.php";
session_start();

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['pw'])) {
        $id = $_POST['id'];
        $password = $_POST['pw'];

        // 데이터베이스에서 사용자 정보 조회
        $sql = "SELECT USER_USERID, USER_NAME, USER_PW FROM user_table WHERE user_userid = :id";
        
        $stmt = oci_parse($conn, $sql);

        if ($stmt === false) {
            $e = oci_error();
            error_log('쿼리 준비에 실패했습니다: ' . htmlspecialchars($e['message']));
            $_SESSION['error'] = '쿼리 준비에 실패했습니다.';
            header("Location: /login/login.php");
            exit();
        }

        // 바인드 변수 할당
        oci_bind_by_name($stmt, ':id', $id);

        // 쿼리 실행
        $result = oci_execute($stmt);

        if ($result === false) {
            $e = oci_error($stmt);
            error_log('쿼리 실행에 실패했습니다: ' . htmlspecialchars($e['message']));
            $_SESSION['error'] = '쿼리 실행에 실패했습니다.';
            header("Location: /login/login.php");
            exit();
        }

        // 결과 가져오기
        // while (($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        //     foreach ($row as $item) {
        //         echo ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;");
        //     }
        // }
        

        $row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS) != false;

        if ($row != null) {
            while(oci_fetch($stmt)){
                $db_id = oci_result($stmt, 'USER_USERID');
                $name = oci_result($stmt, 'USER_NAME');
            }

            $db_password = "$user_pw";

            $db_password = password_hash($db_password, PASSWORD_BCRYPT);

            // 비밀번호 검증
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $db_id;
                $_SESSION['name'] = $name;
                header("Location: /index.php");
                exit();
            } else {
                error_log('잘못된 비밀번호입니다.');
                $_SESSION['error'] = '잘못된 비밀번호입니다.';
                header("Location: /login/login.php");
                exit();
            }
        } else {
            error_log('존재하지 않는 아이디입니다.');
            $_SESSION['error'] = '존재하지 않는 아이디입니다.';
            header("Location: /login/login.php");
            exit();
        }

        // 리소스 해제
        oci_free_statement($stmt);
    } else {
        error_log('아이디와 비밀번호를 입력해주세요.');
        $_SESSION['error'] = '아이디와 비밀번호를 입력해주세요.';
        header("Location: /login/login.php");
        exit();
    }
} else {
    error_log('잘못된 요청입니다.');
    $_SESSION['error'] = '잘못된 요청입니다.';
    header("Location: /login/login.php");
    exit();
}

// 데이터베이스 연결 종료
oci_close($conn);
?>