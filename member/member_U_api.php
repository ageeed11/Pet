<?php
    require_once("dbtools.php");
    
    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["ID"]) && isset($mydata["mname"]) && isset($mydata["mphone"]) && isset($mydata["map"]) && isset($mydata["mail"]) ){
        if($mydata["ID"] != "" && $mydata["mname"] != "" && $mydata["mphone"] != "" && $mydata["map"] != "" && $mydata["mail"] != "" ){        
            $p_ID = $mydata["ID"];
            $p_mname = $mydata["mname"];
            $p_mphone = $mydata["mphone"];
            $p_map = $mydata["map"];
            $p_mail = $mydata["mail"];
           
              
            $conn = create_connect();

            $sql = "UPDATE member SET Mname = '$p_mname', Mphone = '$p_mphone', Map = '$p_map', Mail = '$p_mail'WHERE ID = '$p_ID'";
            
            $result = execute_sql($conn, "id19929557_localhost", $sql);
            
            if($result){
                echo '{"state": true, "message": "更新成功!"}';
            }else{
                echo '{"state": false, "message": "更新失敗!"}';
            }
            mysqli_close($conn);

        }else{
            echo '{"state": false, "message": "欄位不得為空白!"}';
        }
    }else{
    echo '{"state": false, "message": "缺少規定欄位!"}';
    }
?>