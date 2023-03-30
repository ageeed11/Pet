<?php
    require_once("dbtools.php");
    $data = file_get_contents("php://input", "r");
        //  echo $data;
    $dataJSON = array();
    $dataJSON = json_decode($data, true);

    if(isset($dataJSON["oid"])){
        if($dataJSON["oid"] !=""){
            $p_Oid = $dataJSON["oid"];
            
            $conn = create_connect();
            
            $sql = "DELETE FROM order01 WHERE Oid = '$p_Oid'";
            $result = execute_sql($conn, "id19929557_localhost", $sql);

            if($result && mysqli_affected_rows($conn) == 1 ){

                echo '{"state": true, "message":"刪除資料成功!"}';
            }else{
                    
                echo '{"state": false, "message":"刪除資料失敗!'.$sqli.mysqli_error($conn).'}';
            }
            
            }else{
                echo '{"state": false, "message":"欄位不得為空白!"}';
            }
            mysqli_close($conn);
    }else{
        echo'{"state": false, "message":"缺少規定欄位!"}';
    }
    
?>