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

    $sql = "SELECT labour_master_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['labour_master_code'];
    $uniq = uniqid();
    $tmpinvno = "000000000" . $row["labour_master_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("LC/") . substr($tmpinvno, $lenth - 7);
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT labour_master_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['labour_master_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["labour_master_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("LC/") . substr($tmpinvno, $lenth - 7);
     

        $sql1 = "Insert into labour_mas(STK_NO,DESCRIPT)values 
       ('" . $no . "','" . $_GET['description'] . "') ";

        $result = $conn->query($sql1);

      
        $aodn = $no;
        $sql = "SELECT labour_master_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['labour_master_code'];
        $no2 = $no + 1;
        $sql = "update invpara set labour_master_code = $no2 where labour_master_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
  }


?>