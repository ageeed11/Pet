<?php
if (isset($dataJSON["uid01"]) && isset($dataJSON["uid02"])) {
    if ($dataJSON["uid01"] != "" && $dataJSON["uid02"] != "") {

        $p_uid01 = $dataJSON["uid01"];
        $p_uid02 = $dataJSON["uid02"];

        require_once("dbtools.php");

        $data = file_get_contents("php://input", "r");
        $mydata = array();
        $mydata = json_decode($data, true);

        $conn = create_connect();

        $sql = "SELECT member.ID,member.Mname,member.Mphone,member.Map,member.Mail,order01.ID,order01.ORname,order01.ORprice,order01.Oid,order01.Odate,order01.Onum,order01.Oday,order01.Opick,order01.Ocos,order01.Ototal,order01.Oremark FROM member INNER JOIN order01 ON member.ID=order01.OUID WHERE member.MUID01 = '$p_uid01' AND member.MUID02 = '$p_uid02'";

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
    }
}
?>
