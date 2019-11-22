<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT variable_over_head_master_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['variable_over_head_master_code'];
    $uniq = uniqid();
    $tmpinvno = "000000000" . $row["variable_over_head_master_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("VOH/") . substr($tmpinvno, $lenth - 7);
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT variable_over_head_master_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['variable_over_head_master_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["variable_over_head_master_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("VOH/") . substr($tmpinvno, $lenth - 7);
     

        $sql1 = "Insert into voh_mas(STK_NO,DESCRIPT)values 
       ('" . $no . "','" . $_GET['description'] . "') ";

        $result = $conn->query($sql1);

      
        $aodn = $no;
        $sql = "SELECT variable_over_head_master_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['variable_over_head_master_code'];
        $no2 = $no + 1;
        $sql = "update invpara set variable_over_head_master_code = $no2 where variable_over_head_master_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
  }


?>