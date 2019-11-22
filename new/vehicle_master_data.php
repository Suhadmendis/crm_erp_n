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

    $sql = "SELECT vncode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vncode'];
    $post = generateId($row['vncode'], "VE/", "post");
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
        
        $sql = "delete from vehicles where vref = '" . $_GET['vref_txt'] . "'";
        
        $result = $conn->query($sql);
        
        $sql = "Insert into vehicles(vref,vehicleno,vehicletype,nameofuser,fuellimit_ltrs,fuellimit_rupees,remarks)values 
           ('" . $_GET['vref_txt'] . "','" . $_GET['vehicle_no_txt'] . "','" . $_GET['vehicle_type_txt'] . "','" . $_GET['name_of_user_txt'] . "','" . $_GET['fuel_limit_ltr_txt'] . "','" . $_GET['fuel_limit_rupees_txt'] . "','" . $_GET['remarks_txt'] . "')";


        $result = $conn->query($sql);
        $sql = "SELECT vncode FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['vncode'];
        $no2 = $no + 1;
        $sql = "update invpara set vncode = $no2 where vncode = $no";
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
        $sql = "update vehicles set vehicleno = '" . $_GET['vehicle_no_txt'] . "',vehicletype = '" . $_GET['vehicle_type_txt'] . "' ,nameofuser = '" . $_GET['name_of_user_txt'] . "' ,fuellimit_ltrs = '" . $_GET['fuel_limit_ltr_txt'] . "' ,fuellimit_rupees = '" . $_GET['fuel_limit_rupees_txt'] . "',remarks = '" . $_GET['remarks_txt'] . "'  where vref = '" . $_GET['vref_txt'] . "'";
        $result = $conn->query($sql);
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {
   
        $sql = "delete from vehicles where vref = '" . $_GET['vref_txt'] . "'";
        $result = $conn->query($sql);
        echo "delete";
   
}

?>