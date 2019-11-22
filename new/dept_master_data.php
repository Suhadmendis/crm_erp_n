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
    $sql = "SELECT dptcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['dptcode'];
    $uniq = uniqid();
    $tmpinvno = "000000" . $row["dptcode"];
    $lenth = strlen($tmpinvno);
    $no = trim("DPT/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "Insert into deptinfo(dpt_no,dpt_name,uniq)values
                 ('" . $_GET['dpt_no'] . "','" . $_GET['dpt_name'] . "','" . $_GET['uniq'] . "') ";
        $result = $conn->query($sql);


        $sql = "SELECT dptcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['dptcode'];

        
        $no2 = $no + 1;


        $sql = "update invpara set dptcode = $no2 where dptcode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}









