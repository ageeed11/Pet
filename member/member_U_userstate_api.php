<?php
    // input: 
    // {"id":"XXX", "userState": "y"}
    // {"id":"XXX", "userState": "n"}
    // output: 
    // {"state": true, "message":"更新會員狀態成功!"}
    // {"state": false, "message":"更新會員狀態失敗!錯誤代碼或相關訊息"}
    // {"state": false, "message":"欄位不得為空白!"}
    // {"state": false, "message":"缺少規定欄位!"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["id"]) && isset($mydata["userstate"])){
        if($mydata["id"] != "" && $mydata["userstate"] != ""){
            $p_id = $mydata["id"];
            $p_userstate = $mydata["userstate"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "UPDATE member SET Muserstate = '$p_userstate' WHERE ID = '$p_id'";
            if(execute_sql($link, "id19929557_localhost", $sql)){
                echo '{"state": true, "message":"更新會員狀態成功!"}';
            }else{
                echo '{"state": false, "message":"更新會員狀態失敗!'.mysqli_error($link).'"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>