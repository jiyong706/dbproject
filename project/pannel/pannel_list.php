<?php
session_start();
include_once "../DB/config.php";

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    $sql = "SELECT * FROM pannel_table WHERE project_id = :project_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':project_id', $project_id);

    oci_execute($stmt);
} else {
    echo "프로젝트 ID가 제공되지 않았습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>패널 목록</title>
</head>
<body>
    <h2>패널 목록</h2>
    <table border="1">
        <tr>
            <th>패널 ID</th>
            <th>패널 이름</th>
            <th>패널 표준</th>
            <th>패널 정보</th>
            <th>생성일</th>
            <th>수정일</th>
            <th>작업</th>
        </tr>
        <?php
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . $row['PANNEL_ID'] . "</td>";
            echo "<td>" . $row['PANNEL_NAME'] . "</td>";
            echo "<td>" . $row['PANNEL_STANDARD'] . "</td>";
            echo "<td>" . $row['PANNEL_INFO'] . "</td>";
            echo "<td>" . $row['PANNEL_CREATEDATE'] . "</td>";
            echo "<td>" . $row['PANNEL_UPDATEDATE'] . "</td>";
            echo "<td><a href='/project/edit_pannel.php?pannel_id=" . $row['PANNEL_ID'] . "'>수정</a> | ";
            echo "<a href='/project/delete_pannel.php?pannel_id=" . $row['PANNEL_ID'] . "'>삭제</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <br>
    <a href="/project/project.php">프로젝트 목록으로 돌아가기</a>
</body>
</html>

