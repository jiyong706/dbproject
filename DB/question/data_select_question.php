<?php
    include_once "../DB/config.php";
    $stid = oci_parse($conn, "SELECT * FROM user_table where user_userid = :d");

    oci_bind_by_name($stid, ":d", $_POST['id']);
    oci_execute($stid);
    // while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    //     echo "<tr>\n";
    //     foreach ($row as $item) {
    //         echo " <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
    //     }
    //     echo "</tr>\n\n";
    // }
    
    while(oci_fetch($stid)){
        $user_email = oci_result($stid, 'USER_EMAIL');
        $user_old = oci_result($stid, 'USER_OLD');
        $user_name = oci_result($stid, 'USER_NAME');
        $user_userid = oci_result($stid, 'USER_USERID');
        $user_pw = oci_result($stid, 'USER_PW');
    }
    
    oci_close($conn);
?>