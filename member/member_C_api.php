<?php
    require_once("dbtools.php");

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["mname"]) && isset($mydata["mphone"]) && isset($mydata["map"]) && isset($mydata["mail"]) && isset($mydata["mpassword"])  && isset($mydata["mquestion"])){
        if($mydata["mname"] != "" && $mydata["mphone"] != "" && $mydata["map"] != "" && $mydata["mail"] != "" && $mydata["mpassword"] != "" && $mydata["mquestion"] != ""){        
            $p_mname = $mydata["mname"];
            $p_mphone = $mydata["mphone"];
            $p_map = $mydata["map"];
            $p_mail = $mydata["mail"];
            $p_mpassword = $mydata["mpassword"];
            //password_hash 雜湊函數加密處理
            $p_mpassword = password_hash($p_mpassword, PASSWORD_DEFAULT);
            $p_mquestion = $mydata["mquestion"];

            

            $conn = create_connect();

            $sql = "INSERT INTO member(Mname, Mphone, Map, Mail, Mpassword, Mquestion) VALUES ('$p_mname', '$p_mphone', '$p_map', '$p_mail', '$p_mpassword', '$p_mquestion')";

            $result = execute_sql($conn, "id19929557_localhost", $sql);


            if($result){
                echo '{"state": true, "message": "註冊成功!"}';
            }else{
                echo '{"state": false, "message": "註冊失敗"}';
            }
            mysqli_close($conn);

        }else{
            echo '{"state": false, "message": "欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message": "缺少規定欄位!"}';
    }   
?>