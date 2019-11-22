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
    $sql = "SELECT ccustomer_code,ssupplier_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();


    $uniq = uniqid();
    $CAT = "";

    if ($_GET['CAT'] == 'C') {
        $no = $row['ccustomer_code'];
    } else if ($_GET['CAT'] == 'S') {
        $no = $row['ssupplier_code'];
    }

    $tmpinvno = "000000" . $no;
    $lenth = strlen($tmpinvno);

     if ($_GET['CAT'] == 'C') {
        $no = trim("CUST/") . substr($tmpinvno, $lenth - 7);
    } else if ($_GET['CAT'] == 'S') {
        $no = trim("SUP/") . substr($tmpinvno, $lenth - 7);
    }


    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_content") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from vendor_mas where ref_id = '" . $_GET['ref_id'] . "'";
        $result = $conn->query($sql);

        $saveContentSql = "Insert into vendor_mas(ref_id,uniq,name,tel,website,addr,mobile,email,idno,faxno,dob,ac_code,g_l_ac,adv_ac_code,con_person,con_tel,con_addr,con_mobile,con_fax,VEN_CAT)values
                 ('" . $_GET['ref_id'] . "','" . $_GET['uniq'] . "','" . $_GET['name'] . "','" . $_GET['tel'] . "','" . $_GET['website'] . "','" . $_GET['addr'] . "','" . $_GET['mobile'] . "','" . $_GET['email'] . "','" . $_GET['idno'] . "','" . $_GET['faxno'] . "','" . $_GET['dob'] . "','" . $_GET['ac_code'] . "','" . $_GET['g_l_ac'] . "','" . $_GET['adv_ac_code'] . "','" . $_GET['con_person'] . "','" . $_GET['con_tel'] . "','" . $_GET['con_addr'] . "','" . $_GET['con_mobile'] . "','" . $_GET['con_fax'] . "','" . $_GET['vendor'] . "') ";
        $result = $conn->query($saveContentSql);


        $sql = "SELECT ccustomer_code,ssupplier_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();

        if ($_GET['vendor']=="C") {
          $no = $row['ccustomer_code'];
          $no2 = $no + 1;
          $sql = "update invpara set ccustomer_code = $no2 where ccustomer_code = $no";
        }else{
          $no = $row['ssupplier_code'];
          $no2 = $no + 1;
          $sql = "update invpara set ssupplier_code = $no2 where ssupplier_code = $no";
        }


        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from vendor_mas where ref_id = '" . $_GET['ref_id'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}
