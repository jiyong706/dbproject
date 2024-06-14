<!-- config.php -->
<?php
    $host = 'azza.gwangju.ac.kr/orcl';
    $user = 'dbuser201692';
    $pw = 'ce1234';
    $conn = oci_connect($host, $user, $pw); //db 연결

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
