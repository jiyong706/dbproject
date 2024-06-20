<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트</title>
    <style src="project.css"></style>
</head>
<body>
    <div class="create">
        <button href="create_project.php">프로젝트 생성</button>    
    </div>
    <div class="project_list">
        <?php
            // 파일 경로 설정
            $root = "/Users/baggyeonghwan/dbproject/DB/pannel/data_select_pannel.php"; 
            // azza 서버용 $root = "/home/2020/ce201692/public_html/project_pannel/DB/config.php";
            // 윈도우용 $root = "C:\\Users\\pc\\Documents\\GitHub\\dbproject\\DB\\config.php";
            
            include_once $root;


            if($conn == true ){
                $sql = "select project_id, project_name, project_info, project_createdate, project_update from project_table where user_id = (select user_id from user_table where user_userid = :id)";
                $stid = oci_parse($conn, $sql);

                // 유저 아이디 기록(세션값전달)
                if($_SESSION['id'] == null){
                    $id = $_SESSION['id'];
                    echo "<script>alert(\"로그인 해주세요\");</script>";
                    header("Location: /login/login.php");

                }


                oci_bind_by_name($stid, ":id", $id);
                
                oci_execute($stid);

                // 행 추출(숫자) 
                $row = oci_fetch_row($stid);

                echo "$row";
                
                oci_commit($conn);
                oci_free_statement($stid);
                oci_close($conn);

            } else {
                if(!$conn){
                    $e = oci_error();
                    $_SESSION['error'] = '데이터베이스 연결이 실패하였습니다.';
                    echo "<script>alert('데이터베이스 연결이 실패하였습니다.')</script>";
                    header("Location : /index.php");
                } else {
                    $_SESSION['error'] = '값이 존재하지 않습니다.';
                    echo "<script>alert('값이 존재하지 않습니다.')</script>";
                    header("Location : /index.php");
                }
            }

        ?>

    </div>
    
</body>
</html>