<?php
if (isset($_FILES['file']["name"]) && $_FILES['file']["name"] !== "") {
    if ($_FILES['file']["type"] == "image/jpeg" || $_FILES['file']["type"] == "image/png") {

        // echo $_FILES['file']["name"];
        // echo ("<br/>");
        // echo $_FILES['file']["type"];
        // echo ("<br/>");
        // echo $_FILES['file']["size"];
        // echo ("<br/>");
        // echo $_FILES['file']["tmp_name"];
        // echo ("<br/>");
        // echo $_FILES['file']["error"];


        //日期為依據 產生上傳檔案的檔名
        //將$_FILES['file']["name"]副檔名取出 檔案格式 ../upload/20230204110759.jpg
        $filemname = date("YmdHis") . "." . substr($_FILES['file']["name"], -3, 3);
        // echo  $filemname;

        $location = "../upload/" . $filemname; //檔案儲存的路徑
         echo  $location;

        if (move_uploaded_file($_FILES['file']["tmp_name"], $location)) {
            //檔案傳輸成功,收集相關訊息
            //'{"state": false, "message":"檔案上傳成功","data":json相關訊息}'

            //將檔案路徑存入
            require_once("dbtools.php");
            $conn = create_connect();
            $sql = "INSERT INTO room(Rimg) VALUES('$location')";
            $result = execute_sql($conn, "id19929557_localhost", $sql);

            $datainfo = array();
            $datainfo["name"] = $_FILES['file']["name"]; //原始檔名
            $datainfo["type"] = $_FILES['file']["type"];
            $datainfo["size"] = $_FILES['file']["size"];
            $datainfo["tmp_name"] = $_FILES['file']["tmp_name"]; //暫存名稱
            $datainfo["error"] = $_FILES['file']["error"];
            echo '{"state": true, "message":"檔案上傳成功","data":' . json_encode($datainfo) . '}';
        } else {
            //檔案傳輸失敗
            echo '{"state": false, "message":"檔案上傳失敗!錯誤訊息"}';
        }
    } else {
        echo '{"state": false, "message":"檔案格式錯誤"}';
    }
} else {
    echo '{"state": false, "message":"尚未選取檔案 或 檔案名稱不得為空白"}';
}
?>
