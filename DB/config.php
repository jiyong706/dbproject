<!-- config.php -->
<?php
    $host = 'azza.gwangju.ac.kr/orcl';
    $user = 'dbuser201692';
    $pw = 'ce1234';
    $conn = oci_connect($host, $user, $pw) ; //db 연결

    // Check connection
    if ($conn==null) {
        die("Connection failed");
        return false;
    }
?>
