<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

function generateId($id, $ref, $switch) {

    if ($switch == "pre") {
        $temp = substr($id, strlen($ref));
        $id = (int) $temp;

        return $id;
    } else if ($switch == "post") {

        $temp = substr("0000000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT imcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();


    $no = generateId($row['imcode'], "PREINK/", "post");
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from s_mas where STK_NO = '" . $_GET['inkref_txt'] . "'";
        $result = $conn->query($sql);

        $sql = "Insert into s_mas(STK_NO,GROUP1,COST,GROUP2,GROUP3,DESCRIPT)values 
           ('" . $_GET['inkref_txt'] . "','PRE_INK','" . $_GET['avgcostpl_txt'] . "','" . $_GET['avgcostpl_txt'] . "','" . $_GET['sqft_txt'] . "','" . $_GET['des'] . "')";
        $result = $conn->query($sql);

        $sql = "SELECT imcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['imcode'];
        $no2 = $no + 1;
        $sql = "update invpara set imcode = $no2 where imcode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {

    $sql = "update inkmaster set avgcost = '" . $_GET['avgcostpl_txt'] . "',sqft = '" . $_GET['sqft_txt'] . "'  where inkref = '" . $_GET['inkref_txt'] . "'";
    $result = $conn->query($sql);
    echo "update";
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from s_mas WHERE GROUP1 = 'PRE_INK' AND STK_NO = '" . $_GET['inkref_txt'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}
?>