<?php

    $data = file_get_contents("php://input", "r");//外部接收資料
    $roomdata = array();//新增一個陣列
    $roomdata = json_decode($data, true);//用json_decode的方式 接收data

    if(isset($roomdata["ID"])){
        if($roomdata["ID"] != ""){
            
            $p_ID = $roomdata["ID"];

            require_once("dbtools.php");
            $conn = create_connect();
           
            $sql = "DELETE FROM room WHERE ID = '$p_ID'";
            $result = execute_sql($conn,"id19929557_localhost", $sql);

            if($result&& mysqli_affected_rows($conn) == 1){
                echo  '{"state": true, "message":"刪除成功!"}';
            }else{
                echo  '{"state": false, "message":"刪除失敗!'.$sql.mysqli_error($conn).'"}';
            }

        }else{
            echo '{"state": false, "message":"欄位不可為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }

    

?>