<?php
require_once("dbtools.php");

$conn = create_connect();

$sql ="SELECT COUNT(*) as total_member FROM member";

$result = execute_sql($conn,"id19929557_localhost", $sql);

if(mysqli_num_rows($result)>0){
    $mydata = array();
    while($row = mysqli_fetch_assoc($result)){
    $mydata[] = $row;//2維陣列
    }
    //json_encode:陣列轉成json格式
    echo '{"state":true,"message":"會員總數讀取成功", "data":'.json_encode($mydata).'}';
}else{
    echo '{"state":false,"message":"讀取資料失敗或查無資料"}';
}

mysqli_close($conn);

?>