<?php
session_start();

// 세션이 없을 경우 로그인 페이지로 리다이렉트
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인해주세요'); location.replace('/login/login.php');</script>";
    exit();
}

// 데이터베이스 연결 설정 파일 포함
include_once 'C:\\Users\\pc\\Documents\\dbproject\\DB\\config.php';

// POST 요청 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pannel_name = $_POST['pannel_name'];
    $pannel_info = $_POST['pannel_info'];
    $user_id = $_SESSION['user_id']; // 세션에서 사용자 ID 가져오기

    // SQL 쿼리 작성 (파라미터화된 방식으로)
    $sql = "INSERT INTO pannel_table (pannel_ID, project_ID, pannel_name, pannel_standard, pannel_info, pannel_createdate, pannel_updatedate) 
            VALUES (pannel_seq.NEXTVAL, (SELECT project_ID FROM project_table WHERE user_ID = (select user_id from user_table where user_userid = :user_id)), :pannel_name, '기준', :pannel_info, SYSDATE, SYSDATE)";
    
    // OCI 문장 준비
    $stid = oci_parse($conn, $sql);
    
    // 바인딩
    oci_bind_by_name($stid, ':user_id', $user_id);
    oci_bind_by_name($stid, ':pannel_name', $pannel_name);
    oci_bind_by_name($stid, ':pannel_info', $pannel_info);

    // 실행
    if (oci_execute($stid)) {
        echo "<script>alert('패널이 생성되었습니다.'); location.replace('pannel_list.php');</script>";
    } else {
        $e = oci_error($stid);
        $_SESSION['error'] = "패널 생성 오류: " . $e['message'];
        echo "<script>alert('패널 생성 오류! 다시 시도해주세요'); location.replace('create_pannel.php');</script>";
    }

    // OCI 문장 해제 및 연결 닫기
    oci_free_statement($stid);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>패널 생성</title>
    <link rel="stylesheet" href="create_pannel.css">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>패널 생성</h1>
        </div>
        <form method="post" action="create_pannel.php">
            <div class="form-group">
                <label for="pannel_name">패널 이름:</label>
                <input type="text" id="pannel_name" name="pannel_name" required>
            </div>
            <div class="form-group">
                <label for="pannel_info">패널 설명:</label>
                <textarea id="pannel_info" name="pannel_info" required></textarea>
            </div>
            <button type="submit">패널 생성</button>
        </form>
    </div>
</body>
</html>
