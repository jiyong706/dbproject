<?php
include_once "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['pw'])) {
        $id = $_POST['id'];
        $password = $_POST['pw'];

        // 데이터베이스에서 사용자 정보 조회
        $sql = "SELECT 아이디, 이름, 비밀번호 FROM 사용자 WHERE 아이디 = :id";
        $stmt = oci_parse($conn, $sql);

        if ($stmt === false) {
            $e = oci_error($conn);
            error_log('쿼리 준비에 실패했습니다: ' . htmlspecialchars($e['message']));
            $_SESSION['error'] = '쿼리 준비에 실패했습니다.';
            header("Location: login.php");
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
            header("Location: login.php");
            exit();
        }

        // 결과 가져오기
        $row = oci_fetch_assoc($stmt);

        if ($row !== false) {
            $db_id = $row['아이디'];
            $fname = $row['이름'];
            $db_password = $row['비밀번호'];

            // 비밀번호 검증
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $db_id;
                $_SESSION['fname'] = $fname;
                header("Location: index.php");
                exit();
            } else {
                error_log('잘못된 비밀번호입니다.');
                $_SESSION['error'] = '잘못된 비밀번호입니다.';
                header("Location: login.php");
                exit();
            }
        } else {
            error_log('존재하지 않는 아이디입니다.');
            $_SESSION['error'] = '존재하지 않는 아이디입니다.';
            header("Location: login.php");
            exit();
        }

        // 리소스 해제
        oci_free_statement($stmt);
    } else {
        error_log('아이디와 비밀번호를 입력해주세요.');
        $_SESSION['error'] = '아이디와 비밀번호를 입력해주세요.';
        header("Location: login.php");
        exit();
    }
} else {
    error_log('잘못된 요청입니다.');
    $_SESSION['error'] = '잘못된 요청입니다.';
    header("Location: login.php");
    exit();
}

// 데이터베이스 연결 종료
oci_close($conn);
?>
