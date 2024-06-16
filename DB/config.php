<?php
    $host = "azza.gwangju.ac.kr/orcl";
    $user = 'dbuser201692';
    $pw = 'ce1234';

    // 데이터베이스 연결 체크
    $conn = oci_connect($user, $pw, $host);
    if (!$conn) {
        $e = oci_error();
        die("데이터베이스 연결에 실패하였습니다: " . $e['message']);
    }
?>
