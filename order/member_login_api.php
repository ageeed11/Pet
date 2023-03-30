<?php
require_once("dbtools.php");

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["mail"]) && isset($mydata["mpassword"])) {
    if ($mydata["mail"] != "" && $mydata["mpassword"] != "") {
        $p_mail = $mydata["mail"];
        $p_mpassword = $mydata["mpassword"];

        $conn = create_connect();

        $sql = "SELECT Mail, Mpassword FROM member WHERE Mail = '$p_mail'";

        $result = execute_sql($conn, "id19929557_localhost", $sql);

        if (mysqli_num_rows($result) == 1) {
            //該帳號存在, 使用password_verify()確認密碼是否正確
            //password_verify('123456aaa', $hash)
            $row = mysqli_fetch_assoc($result);
            $password_hash = $row["Mpassword"];
            if (password_verify($p_mpassword, $password_hash)) {
                //密碼驗證成功
                //產生UID並更新於資料庫
                $uid = substr(md5(hash('sha256', rand())), 0, 6,);
                $uid01 = substr(md5(hash('sha256', uniqid())), 0, 6,);
                $sql = "UPDATE member SET MUID01 = '$uid',MUID02 = '$uid01'  WHERE Mail = '$p_mail'";
                execute_sql($conn, "id19929557_localhost", $sql);

                //密碼驗證成功後,撈取密碼以外的資料並用data顯示相關資訊
                $sql = "SELECT ID,Mname,UserState,Map,Mail,Mphone,Mquestion,MUID01,MUID02 FROM member WHERE Mail = '$p_mail'";
                $result = execute_sql($conn, "id19929557_localhost", $sql);
                $row = mysqli_fetch_assoc($result);
                $userData = array();
                $userData[] = $row;

                echo '{"state": true, "message":"登入會員成功!","data":'.json_encode($userData).'}';
            } else {
                //密碼驗證失敗
                echo '{"state": false, "message":"密碼驗證失敗!' . mysqli_error($conn) . '"}';
            }
        } else {
            //該帳號不存在
            echo '{"state": false, "message":"登入會員失敗!' . mysqli_error($conn) . '"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state": false, "message": "欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message": "缺少規定欄位!"}';
}
?>
