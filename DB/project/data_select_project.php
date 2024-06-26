<?php
    include_once "/Users/baggyeonghwan/dbproject/DB/config.php";
    $stid = oci_parse($conn, "SELECT * FROM project_table where project_id = :d");

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
        $project_id = oci_result($stid, 'PROJECT_ID');
        $user_id = oci_result($stid, 'USER_ID');
        $project_name = oci_result($stid, 'PROJECT_NAME');
        $project_info = oci_result($stid, 'PROJECT_INFO');
        $project_createdate = oci_result($stid, 'PROJECT_CREATEDATE');
        $project_updatedate = oci_result($stid, 'PROJECT_UPDATE');
    }
    
    oci_close($conn);
?>