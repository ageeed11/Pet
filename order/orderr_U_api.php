<?php
    require_once("dbtools.php");
    $data = file_get_contents("php://input", "r");
        // echo $data;
    $dataJSON = array();
    $dataJSON = json_decode($data, true);

    if (isset($dataJSON["ID"]) &&isset($dataJSON["orname"]) && isset($dataJSON["orprice"]) && isset($dataJSON["omname"]) && isset($dataJSON["omphone"]) && isset($dataJSON["omap"]) && isset($dataJSON["omail"]) && isset($dataJSON["ompasword"]) && isset($dataJSON["odate"]) && isset($dataJSON["onum"]) && isset($dataJSON["oday"]) && isset($dataJSON["opick"]) && isset($dataJSON["ocos"]) && isset($dataJSON["oremark"]) && isset($dataJSON["ototal"]) && isset($dataJSON["oid"])){
        if ($dataJSON["ID"] != "" && $dataJSON["orname"] != "" && $dataJSON["orprice"] != "" && $dataJSON["omname"] != "" && $dataJSON["omphone"] != "" && $dataJSON["omap"] != "" && $dataJSON["omail"] != "" && $dataJSON["ompasword"] != "" && $dataJSON["odate"] != "" && $dataJSON["onum"] != ""  && $dataJSON["oday"] != "" && $dataJSON["opick"] != "" && $dataJSON["ocos"] != "" && $dataJSON["oremark"] != "" && $dataJSON["ototal"] != "" && $dataJSON["oid"] != ""){
            $p_ID = $dataJSON["ID"];
            $p_orname = $dataJSON["orname"];
            $p_orprice = $dataJSON["orprice"];
            $p_omname = $dataJSON["omname"];
            $p_omphone = $dataJSON["omphone"];
            $p_omap = $dataJSON["omap"];
            $p_omail = $dataJSON["omail"];
            $p_ompasword = $dataJSON["ompasword"];
            $p_odate = $dataJSON["odate"];
            $p_onum = $dataJSON["onum"];
            $p_oday = $dataJSON["oday"];
            $p_opick = $dataJSON["opick"];
            $p_ocos = $dataJSON["ocos"];
            $p_oremark = $dataJSON["oremark"];
            $p_ototal = $dataJSON["ototal"];
            $p_oid = $dataJSON["oid"];

            $conn = create_connect();
              
            $sql = "UPDATE order01 SET ORname='$p_pname', ORprice = '$p_price', OMname ='$p_pnum', OMphone ='$p_pnum', OMap ='$p_pnum', OMail ='$p_pnum', OMpassword ='$p_pnum', Oid ='$p_pnum', Odate ='$p_pnum', Onum ='$p_pnum', Oday ='$p_pnum', Ocos ='$p_pnum', Opick ='$p_pnum', Ototal ='$p_pnum', Oremark ='$p_pnum' WHERE ID ='$p_ID'";

            $result = execute_sql($conn,"id19929557_localhost", $sql);

            if($result){

                echo '{"state": true, "message":"更新資料成功!"}';
            }else{
                    
                echo '{"state": false, "message":"更新資料失敗!'.$sqli.mysqli_error($conn).'}';
            }
             mysqli_close($conn);
            }else{
                echo '{"state": false, "message":"欄位不得為空白!"}';
            }
           
    }else{
        echo'{"state": false, "message":"缺少規定欄位!"}';
    }
    
?>