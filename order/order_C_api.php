<?php
require_once("dbtools.php");

$data = file_get_contents("php://input", "r");
$dataJSON = array();
$dataJSON = json_decode($data, true);

if (isset($dataJSON["orname"]) && isset($dataJSON["orprice"]) && isset($dataJSON["odate"]) && isset($dataJSON["onum"]) && isset($dataJSON["oday"]) && isset($dataJSON["opick"]) && isset($dataJSON["ocos"])  && isset($dataJSON["ototal"]) && isset($dataJSON["ouid"])){
    if ($dataJSON["orname"] != "" && $dataJSON["orprice"] != "" && $dataJSON["odate"] != "" && $dataJSON["onum"] != ""  && $dataJSON["oday"] != ""  &&    $dataJSON["ototal"] != "" &&  $dataJSON["ouid"] != ""){

        $p_orname = $dataJSON["orname"];
        $p_orprice = $dataJSON["orprice"];
        $p_odate = $dataJSON["odate"];
        $p_onum = $dataJSON["onum"];
        $p_oday = $dataJSON["oday"];
        $p_opick = $dataJSON["opick"];
        $p_ocos = $dataJSON["ocos"];
        $p_oremark = $dataJSON["oremark"];
        $p_ototal = $dataJSON["ototal"];
        $p_ouid = $dataJSON["ouid"];

        $hash = md5(date("Ymdhis"));
        
        $p_oid = date("Ymdhis").substr($hash,6,2);


        $conn = create_connect();

        $sql = "INSERT INTO order01(ORname,ORprice,Odate,Onum,Oday,Opick,Ocos,Oremark,Ototal,Oid,OUID) VALUES ('$p_orname','$p_orprice','$p_odate','$p_onum','$p_oday','$p_opick','$p_ocos','$p_oremark','$p_ototal','$p_oid','$p_ouid') ";
        $result = execute_sql($conn, "id19929557_localhost", $sql);

        if ($result) {

            echo '{"state": true, "message":"新增資料成功!"}';
        } else {

            echo '{"state": false, "message":"新增資料失敗!錯誤代碼或相關訊息"}';
        };
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
    mysqli_close($conn);
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
?>
