<?php
    $host = "dsapoi881.duckdns.org:1522/xe";
    $user = 'c##test';
    $pw = '00000000';

    // 데이터베이스 연결 체크
    $conn = oci_connect($user, $pw, $host, "AL32UTF8");
    if (!$conn) {
        $e = oci_error();
        die("데이터베이스 연결에 실패하였습니다: " . $e['message']);
    }
?>
