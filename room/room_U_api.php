<?php

if (isset($_POST["ID"]) && isset($_FILES['file']["name"]) && isset($_POST["Rname"]) && isset($_POST["Rprice"])) {
    if ($_POST["ID"] != "" && $_FILES['file']["name"] != "" && $_POST["Rname"] != "" && $_POST["Rprice"]){

        $p_ID = $_POST["ID"];
        $p_Rname = $_POST["Rname"];
        $p_Rprice = $_POST["Rprice"];

        $filemname = date("YmdHis") . "." . substr($_FILES['file']["name"], -3, 3);
        $location = "../upload/" . $filemname; //檔案儲存的路徑

        if (move_uploaded_file($_FILES['file']["tmp_name"], $location)) {
            
            require_once("dbtools.php");
            $conn = create_connect();
            $sql = "UPDATE room SET Rname = '$p_Rname', Rimg = '$location', Rprice = '$p_Rprice' WHERE ID = '$p_ID'";
            $result = execute_sql($conn, "id19929557_localhost", $sql);

            if ($result) {
                echo '{"state": true, "message":"更新成功!"}';
            } else {
                echo '{"state": false, "message":"更新失敗' . $sql . mysqli_error($conn);
                '"}';
            }
        } else {
            //檔案傳輸失敗
            echo '{"state": false, "message":"檔案上傳失敗!錯誤訊息"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state": false, "message":"欄位不可為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
?>