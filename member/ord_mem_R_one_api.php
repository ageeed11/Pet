<?php
require_once("dbtools.php");

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);
if (isset($mydata["id"])) {
    if ($mydata["id"] != "") {
        $p_Id = $mydata["id"];

        $conn = create_connect();

        $sql = "SELECT member.ID,member.Mname,member.Mphone,member.Map,member.Mail,order01.ID,order01.ORname,order01.ORprice,order01.Oid,order01.Odate,order01.Onum,order01.Oday,order01.Opick,order01.Ocos,order01.Ototal,order01.Oremark,order01.OUID FROM member INNER JOIN order01 ON member.ID =order01.OUID WHERE member.ID = $p_Id";

        $result = execute_sql($conn, "id19929557_localhost", $sql);
        if (mysqli_num_rows($result) ) {
            $mydata = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            echo '{"state": true, "message": "讀取資料成功!", "data":' . json_encode($mydata) . '}';
        } else {
            echo '{"state": false, "message": "讀取資料失敗或查無資料!"}';
        }

        mysqli_close($conn);
    }
}
