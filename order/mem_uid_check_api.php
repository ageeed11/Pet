<?php
//INPUT:{"uid01":"xxx","uid02":"xxx"}
// {"state": true, "message":"登入狀態成功","data":"該筆會員資料相關"}
// {"state": false, "message":"登入狀態失敗!"錯誤代碼或相關訊息}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"} 

$data = file_get_contents("php://input", "r");//接收字串
$dataJSON = array();//宣告陣列
$dataJSON = json_decode($data, true);//轉成陣列

if (isset($dataJSON["uid01"]) && isset($dataJSON["uid02"])) {
    if ($dataJSON["uid01"] != "" && $dataJSON["uid02"] != "") {

        $p_uid01 = $dataJSON["uid01"];
        $p_uid02 = $dataJSON["uid02"];
        
 

        require_once("dbtools.php");
        $conn = create_connect();

        $sql = "SELECT ID,Mname,UserState,Map,Mail,Mphone,Mquestion,MUID01,MUID02 FROM member WHERE MUID01 = '$p_uid01' AND MUID02 = '$p_uid02'";
        $result = execute_sql($conn, "id19929557_localhost", $sql);

        if(mysqli_num_rows($result) == 1){
            //UID合法
            $userData = array();
            $row = mysqli_fetch_assoc($result);
            $userData[] = $row;
            echo '{"state": true, "message":"登入狀態確認成功","data":'.json_encode($userData).'}';
        }else{
            //UID不合法
            echo '{"state": false, "message":"登入狀態確認失敗!'.mysqli_error($conn).'"}';
        }
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
    mysqli_close($conn);
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}

?>