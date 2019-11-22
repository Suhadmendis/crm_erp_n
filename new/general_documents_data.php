<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT general_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['general_code'];
//    uniq
    $uniq = uniqid();

    $tmpinvno = "000000" . $row["general_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("GD/") . substr($tmpinvno, $lenth - 7);
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from general where doc_ref = '" . $_POST['docref'] . "'";
        $result = $conn->query($sql);

        $sql1 = "Insert into general(doc_ref,uniq,manual_no,g_flag,remarks,notes)values 
                        ('" . $_POST['docref'] . "','" . $_POST['uniq'] . "','" . $_POST['manno'] . "','" . $_POST['gflag'] . "','" . $_POST['remarks'] . "','" . $_POST['notes'] . "')";
        $result = $conn->query($sql1);

        $sql = "SELECT general_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['general_code'];
        $no2 = $no + 1;
        $sql = "update invpara set general_code = $no2 where general_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {
    try {
        $sql = "update customer set name = '" . $_GET['name'] . "' ,address = '" . $_GET['address'] . "' ,dob = '" . $_GET['dob'] . "'  where cid = '" . $_GET['cid'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from general where doc_ref = '" . $_GET['docref'] . "'";
    $result = $conn->query($sql);
    //  echo $sql;
    echo "delete";
}
?>