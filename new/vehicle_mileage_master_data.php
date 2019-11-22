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

    $sql = "SELECT vmrcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vmrcode'];
    $post = generateId($row['vmrcode'], "VM/", "post");
    $uniq = uniqid();
    
    $ResponseXML .= "<id><![CDATA[$post]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        
        $sql = "delete from vehiclemilage where vmref = '" . $_GET['vmref_txt'] . "'";
        
        $result = $conn->query($sql);
        
        $sql = "Insert into vehiclemilage(vmref,vehicle,month,opening,closing,mileage)values 
           ('" . $_GET['vmref_txt'] . "','" . $_GET['vehicle_txt'] . "','" . $_GET['month_txt'] . "','" . $_GET['opening_txt'] . "','" . $_GET['closing_txt'] . "','" . $_GET['mileage_txt'] . "')";


        $result = $conn->query($sql);
        $sql = "SELECT vmrcode FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['vmrcode'];
        $no2 = $no + 1;
        $sql = "update invpara set vmrcode = $no2 where vmrcode = $no";
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
        $sql = "update vehiclemilage set vehicle = '" . $_GET['vehicle_txt'] . "',month = '" . $_GET['month_txt'] . "',opening = '" . $_GET['opening_txt'] . "',closing = '" . $_GET['closing_txt'] . "',mileage = '" . $_GET['mileage_txt'] . "'  where vmref = '" . $_GET['vmref_txt'] . "'";
        $result = $conn->query($sql);
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {
   
        $sql = "delete from vehiclemilage where vmref = '" . $_GET['vmref_txt'] . "'";
        $result = $conn->query($sql);
        echo "delete";
   
}

?>