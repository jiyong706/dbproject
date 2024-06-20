<?php
    include_once "/Users/baggyeonghwan/dbproject/DB/config.php";
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
        $pannel_id = oci_result($stid, 'PANNEL_ID');
        $project_id = oci_result($stid, 'PROJECT_ID');
        $pannel_name = oci_result($stid, 'PANNEL_NAME');
        $pannel_standard = oci_result($stid, 'PANNEL_STANDARD');
        $pannel_info = oci_result($stid, 'PANNEL_INFO');
        $pannel_createdate = oci_result($stid, 'PANNEL_CREATEDATE');
        // sysdate
        $pannel_updatedate = oci_result($stid, 'PANNEL_UPDATEDATE');
    }
    
    oci_close($conn);
?>