<?php
    include_once "/Users/baggyeonghwan/dbproject/DB/config.php";
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
        $resp_id = oci_result($stid, 'RESP_ID');
        $user_id = oci_result($stid, 'USER_ID');
        $question_id = oci_result($stid, 'QUSTION_ID');
        $resp_text = oci_result($stid, 'RESP_TEXT');
        $resp_date = oci_result($stid, 'RESP_DATE');
    }
    
    oci_close($conn);
?>