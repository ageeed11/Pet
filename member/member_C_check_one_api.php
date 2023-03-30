<?php
    require_once("dbtools.php");

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["mail"])){
        if($mydata["mail"] != ""){        
            $p_mail = $mydata["mail"];
            
            $conn = create_connect();

            $sql = "SELECT Mail FROM member WHERE Mail = '$p_mail'";

            $result = execute_sql($conn, "id19929557_localhost", $sql);

            if(mysqli_num_rows($result) == 1){
                //帳號已經存在
                echo '{"state": false, "message": "該信箱已註冊,不可使用此帳號!!!!!!!!!!!!"}';
            }else{
                //帳號不存在
                echo '{"state": true, "message": "該信箱未註冊,可使用此帳號!"}';
            }
            mysqli_close($conn);

        }else{
            echo '{"state": false, "message": "欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message": "缺少規定欄位!"}';
    }   
?>