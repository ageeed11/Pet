<?php
//INPUT:{"uid01":"xxx","uid02":"xxx"}
// {"state": true, "message":"登入狀態成功","data":"該筆會員資料相關"}
// {"state": false, "message":"登入狀態失敗!"錯誤代碼或相關訊息}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"} 

$data = file_get_contents("php://input", "r"); //接收字串
$dataJSON = array(); //宣告陣列
$dataJSON = json_decode($data, true); //轉成陣列

require_once("dbtools.php");
$conn = create_connect();

$sql = "SELECT member.ID,member.Mname,member.Mphone,member.Map,member.Mail,order01.ID,order01.ORname,order01.ORprice,order01.Oid,order01.Odate,order01.Onum,order01.Oday,order01.Opick,order01.Ocos,order01.Ototal,order01.Oremark,order01.OUID FROM member INNER JOIN order01 ON member.ID =order01.OUID";
$result = execute_sql($conn, "id19929557_localhost", $sql);

if (mysqli_num_rows($result) > 0) {
    $mydata = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $mydata[] = $row;
    }
    echo '{"state": true, "message": "讀取資料成功!", "data":' . json_encode($mydata) . '}';
} else {
    echo '{"state": false, "message": "讀取資料失敗或查無資料!"}';
}

mysqli_close($conn);

?>