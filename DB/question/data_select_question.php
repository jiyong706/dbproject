<?php
    include_once "/Users/baggyeonghwan/dbproject/DB/config.php";
    $stid = oci_parse($conn, "SELECT * FROM question_table where question_id = :d");

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
        $question_id = oci_result($stid, 'QUESTION_ID');
        $pannel_id = oci_result($stid, 'PANNEL_ID');
        $question_text = oci_result($stid, 'QUESTION_TEXT');
        $question_type = oci_result($stid, 'QUESTION_TYPE');
        $question_createdate = oci_result($stid, 'QUESTION_CREATEDATE');
        $question_updatedate = oci_result($stid, 'QUESTION_UPDATEDATE');
    }
    
    oci_close($conn);
?>