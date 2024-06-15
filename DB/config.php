<!-- config.php -->
<?php
<<<<<<< Updated upstream
    $host = 'azza.gwangju.ac.kr/orcl';
    $user = 'dbuser201692';
    $pw = 'ce1234';
    $conn = oci_connect($host, $user, $pw) ; //db 연결
=======
    $host = 'dsapoi881.duckdns.org:1522/xe';
    $user = 'c##test';
    $pw = '00000000';
    $conn = oci_connect($host, $user, $pw); //db 연결
>>>>>>> Stashed changes

    // Check connection
    if ($conn==null) {
        die("Connection failed");
        return false;
    }
?>
