<!-- config.php -->
<?php
    $host = 'dsapoi881.duckdns.org/xe';
    $user = 'c##test';
    $pw = '00000000';
    $conn = oci_connect($user, $pw, $host); //db 연결

    // Check connection
    //
    if ($conn==null) {
        die("데이터베이스에 연결이 실패하였습니다.");
        return false;
    }
?>