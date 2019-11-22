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
    $sql = "SELECT prod_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['prod_code'];
    $uniq = uniqid();
    $tmpinvno = "000000" . $row["prod_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("PRO/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_content") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "delete from s_mas where STK_NO = '" . $_GET['prod_ref'] . "'";
        $result = $conn->query($sql);



       


//         $saveContentSql = "Insert into pproduct_master(prod_ref,uniq,status,prod_name,prod_uom,group,grp_type,prod_length,prod_width,prod_height,w_inches,sqf)values
//                 ('" .  $_GET['prod_ref'] . "','" .  $_GET['uniq'] . "','" .  $_GET['status'] . "','" .  $_GET['prod_name'] . "','" .  $_GET['prod_uom'] . "','" .  $_GET['group'] . "','" .  $_GET['grp_type'] . "','" .  $_GET['prod_length'] . "','" .  $_GET['prod_width'] . "','" .  $_GET['prod_height'] . "','" .  $_GET['w_inches'] . "','" .  $_GET['sqf'] . "') ";
//     
    
        $sql = "Insert into s_mas(STK_NO,DESCRIPT,UOM,GROUP2,LC_1,LC_2,LC_3,LC_4)values 
                   ('" . $_GET['prod_ref'] . "','" . $_GET['prod_name'] . "','" . $_GET['prod_uom'] . "','FG','" . $_GET['LC_1'] . "','" . $_GET['LC_2'] . "','" . $_GET['LC_3'] . "','" . $_GET['LC_4'] . "')";

        $result = $conn->query($sql);



        if ($_GET['up_flag']=="new") {
            
            $sql = "SELECT prod_code FROM invpara";
            $result = $conn->query($sql);
            $row = $result->fetch();
            $no = $row['prod_code'];

            
            $no2 = $no + 1;
            
            
            $sql = "update invpara set prod_code = $no2 where prod_code = $no";
            $result = $conn->query($sql);

        }
         
       
        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from pproduct_master where prod_ref = '" . $_GET['prod_ref'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}










