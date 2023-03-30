<?php
require_once("dbtools.php");

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["mail"]) && isset($mydata["mquestion"])) {
    if ($mydata["mail"] != "" && $mydata["mquestion"] != "") {
        $p_mail = $mydata["mail"];
        $p_mquestion = $mydata["mquestion"];

        $conn = create_connect();

        $sql = "SELECT Mail, Mquestion FROM member WHERE Mquestion = '$p_mquestion' AND Mail = '$p_mail'";

        $result = execute_sql($conn, "id19929557_localhost", $sql);

        if (mysqli_num_rows($result) == 1) {
            $mydata = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            echo '{"state": true, "message":"帳號驗證成功!" ,"data":'.json_encode($mydata).' }';
        } else {
            //該帳號不存在
            echo '{"state": false, "message":"帳號驗證失敗!' . mysqli_error($conn) . '"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state": false, "message": "欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message": "缺少規定欄位!"}';
}
?>