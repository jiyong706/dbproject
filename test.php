<?php
    $pass = password_hash("00000000", PASSWORD_BCRYPT);
    echo $pass;
    phpinfo();
?>