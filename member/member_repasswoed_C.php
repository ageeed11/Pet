<?php
    require_once("dbtools.php");

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["mpassword"]) && isset($mydata["mail"])){
        if($mydata["mpassword"] != "" && $mydata["mail"] != ""){   
                 
            $p_mail= $mydata["mail"];
            $p_mpassword = $mydata["mpassword"];
            //password_hash 雜湊函數加密處理
            $p_mpassword = password_hash($p_mpassword, PASSWORD_DEFAULT);
           

            

            $conn = create_connect();

            $sql = "UPDATE member SET Mpassword = '$p_mpassword' WHERE Mail = '$p_mail'";

            $result = execute_sql($conn, "id19929557_localhost", $sql);


            if($result){
                echo '{"state": true, "message": "密碼更新成功!"}';
            }else{
                echo '{"state": false, "message": "密碼更新失敗!錯誤代碼或相關訊息"}';
            }
            mysqli_close($conn);

        }else{
            echo '{"state": false, "message": "欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message": "缺少規定欄位!"}';
    }   
?>