<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');
date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";
//    $sql = "SELECT rate_master_code FROM invpara";
//    $result = $conn->query($sql);
//    $row = $result->fetch();
//    $no = $row['rate_master_code'];
//    $uniq = uniqid();
//    $tmpinvno = "000000" . $row["rate_master_code"];
//    $lenth = strlen($tmpinvno);
//    $no = trim("RM/") . substr($tmpinvno, $lenth - 7);


    $sql2 = "SELECT * from ledger ORDER BY ID ";
    foreach ($conn->query($sql2) as $row) {

            $sql = "SELECT C_NAME FROM lcodes where C_CODE = '" . $row['L_CODE'] . "'";
            $result = $conn->query($sql);
            $rowtemp = $result->fetch();


        $myArr = array($row['L_REFNO'],$row['L_CODE'],$rowtemp['C_NAME'],$row['L_DATE'],$row['L_LMEM'],$row['L_AMOUNT'],$row['L_FLAG1'],$row['L_AMOUNT1'],$row['L_AMOUNT']);

        $myJSON = json_encode($myArr);


        $ResponseXML .= "<json><![CDATA[$myJSON]]></json>";
//        $result = $conn->query($sql);
    }






    $ResponseXML .= "</new>";


    echo $ResponseXML;
}









