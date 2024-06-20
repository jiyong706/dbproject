<?php
    include_once "../DB/config.php";
    $stid = oci_parse($conn, "SELECT * FROM pannel_table where project_id = :d");

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
        $pannel_id = oci_result($stid, 'USER_EMAIL');
        $project_id = oci_result($stid, 'USER_OLD');
        $pannel_standard = oci_result($stid, 'USER_NAME');
        $pannel_info = oci_result($stid, 'USER_USERID');
        $pannel_date = oci_result($stid, 'USER_PW');
        $pannel_createdate = oci_result($stid, 'USER_PW');
    }
    
    oci_close($conn);
?>