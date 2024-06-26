<?php
    $conn = oci_connect('c##test', '00000000', 'dsapoi881.duckdns.org:1522/xe', "AL32UTF8");
    $stid = oci_parse($conn, "SELECT user_userid, user_name, user_pw FROM user_table where user_userid = 'test'");
    oci_execute($stid);
    echo "<table>\n";
    // while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    //     echo "<tr>\n";
    //     foreach ($row as $item) {
    //         echo " <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
    //     }
    //     echo "</tr>\n\n";
    // }
    echo "</table>\n";
    while(oci_fetch($stid)){
        $user_userid = oci_result($stid, 'USER_USERID');
        $test = oci_result($stid, 'USER_PW');
    }
    
    oci_close($conn);
?>