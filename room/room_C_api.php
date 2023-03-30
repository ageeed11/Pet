<?php
if (isset($_POST["Rname"]) && isset($_FILES['file']["name"]) && isset($_POST["Rprice"])) {

    if ($_POST["Rname"] != "" && $_FILES['file']["name"] !== "" && $_POST["Rprice"] != "") {

        $p_Rname = $_POST["Rname"];
        $p_Rprice = $_POST["Rprice"];

        $filemname = date("YmdHis") . "." . substr($_FILES['file']["name"], -3, 3);
        $location = "../upload/" . $filemname; //檔案儲存的路徑
        if (move_uploaded_file($_FILES['file']["tmp_name"], $location)) {

            require_once("dbtools.php");
            $conn = create_connect();

            $sql = "INSERT INTO room(Rname, Rimg, Rprice) VALUES('$p_Rname', '$location', '$p_Rprice')";
            $result = execute_sql($conn, "id19929557_localhost", $sql);

            if ($result ) {
                echo '{"state": true, "message":"新增成功!"}';
            } else {
                echo '{"state": false, "message":"新增失敗!' . $sql . mysqli_error($conn) . '"}';
            }
        } else {
            //檔案傳輸失敗
            echo '{"state": false, "message":"檔案上傳失敗!錯誤訊息"}';
        }
    } else {
        echo '{"state": false, "message":"欄位不可為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
?>

