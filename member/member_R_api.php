<?php
    require_once("dbtools.php");

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data, true);

    $conn = create_connect();

    $sql = "SELECT * FROM member WHERE Mail";
    
    $result = execute_sql($conn,"id19929557_localhost", $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state": true, "message": "讀取資料成功!", "data":'.json_encode($mydata).'}';
    }else{
        echo '{"state": false, "message": "讀取資料失敗或查無資料!"}';
    }

    mysqli_close($conn);
?>