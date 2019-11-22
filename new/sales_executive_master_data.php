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
    $sql = "SELECT salesexecode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['salesexecode'];
    $uniq = uniqid();
    $tmpinvno = "000000" . $row["salesexecode"];
    $lenth = strlen($tmpinvno);
    $no = trim("SREF/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_content") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $saveContentSql = "Insert into sales_exe_master(se_ref,uniq,nic,se_name,addr,mobile,email)values
                 ('" . $_GET['se_ref'] . "','" . $_GET['uniq'] . "','" . $_GET['nic'] . "','" . $_GET['se_name'] . "','" . $_GET['addr'] . "','" . $_GET['mobile'] . "','" . $_GET['email'] . "') ";
        $result = $conn->query($saveContentSql);


        $sql = "SELECT salesexecode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['salesexecode'];
        $no2 = $no + 1;
        $sql = "update invpara set salesexecode = $no2 where salesexecode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}





