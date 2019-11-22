<?php

session_start();


$servername = '192.168.1.101';
$username = 'suduhava';
$password = '';
$port = 10060;
$dbname = 'crm_erp_db';


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



date_default_timezone_set('Asia/Colombo');



//quotation

if ($_GET["Command"] == "manual_ref") {
    $result = array();

    $sql = "SELECT manual_ref from quotation where  manual_ref like '%". $_GET['term'] . "%' group BY manual_ref limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['manual_ref']));

    }

    echo json_encode($result);
}

if ($_GET["Command"] == "ATTN") {
    $result = array();

    $sql = "SELECT ATTN from quotation where  ATTN like '%". $_GET['term'] . "%' group BY ATTN limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['ATTN']));

    }

    echo json_encode($result);
}


if ($_GET["Command"] == "CC") {
    $result = array();

    $sql = "SELECT CC from quotation where  CC like '%". $_GET['term'] . "%' group BY CC limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['CC']));

    }

    echo json_encode($result);
}

if ($_GET["Command"] == "TO") {
    $result = array();

    $sql = "SELECT TOOO from quotation where  TOOO like '%". $_GET['term'] . "%' group BY TOOO limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['TOOO']));

    }

    echo json_encode($result);
}





//manual_grn

if ($_GET["Command"] == "namegrn") {
    $result = array();

    $sql = "SELECT name from manuel_grn where name like '%". $_GET['term'] . "%' group BY name limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['name']));

    }

    echo json_encode($result);
}





//manual_aod

if ($_GET["Command"] == "inputTextaod") {
    $result = array();

    $sql = "SELECT Name from manuel_aod where Name like '%". $_GET['term'] . "%' group BY Name limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Name']));

    }

    echo json_encode($result);
}


if ($_GET["Command"] == "Addressaod") {
    $result = array();

    $sql = "SELECT Address from manuel_aod where Address like '%". $_GET['term'] . "%' group BY Address limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Address']));

    }

    echo json_encode($result);
}

if ($_GET["Command"] == "ncpaod") {
    $result = array();

    $sql = "SELECT ncp from manuel_aod where ncp like '%". $_GET['term'] . "%' group BY ncp limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['ncp']));

    }

    echo json_encode($result);
}


if ($_GET["Command"] == "telaod") {
    $result = array();

    $sql = "SELECT tel from manuel_aod where tel like '%". $_GET['term'] . "%' group BY tel limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['tel']));

    }

    echo json_encode($result);
}


if ($_GET["Command"] == "Name_of_Driveraod") {
    $result = array();

    $sql = "SELECT nod from manuel_aod where nod like '%". $_GET['term'] . "%' group BY nod limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['nod']));

    }

    echo json_encode($result);
}





//temporary manuel invoice


//Settlement_Due

if ($_GET["Command"] == "SettlementDue_tmi") {
    $result = array();

    $sql = "SELECT Settlement_Due from temporary_manual_invoice where Settlement_Due like '%". $_GET['term'] . "%' group BY Settlement_Due limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Settlement_Due']));

    }

    echo json_encode($result);
}


//Customer_Order_No

if ($_GET["Command"] == "CustomerOrderNo_tmi") {  
    $result = array();

    $sql = "SELECT Customer_Order_No from temporary_manual_invoice where Customer_Order_No like '%". $_GET['term'] . "%' group BY Customer_Order_No limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Order_No']));

    }

    echo json_encode($result);
}



//Customer_Name

if ($_GET["Command"] == "Customer_Name_tmi") {  
    $result = array();

    $sql = "SELECT Customer_Name from temporary_manual_invoice where Customer_Name like '%". $_GET['term'] . "%' group BY Customer_Name limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Name']));

    }

    echo json_encode($result);
}

//Customer_Address

if ($_GET["Command"] == "CustomerAddress_tmi") {  
    $result = array();

    $sql = "SELECT Customer_Address from temporary_manual_invoice where Customer_Address like '%". $_GET['term'] . "%' group BY Customer_Address limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Address']));

    }

    echo json_encode($result);
}

//NBT

if ($_GET["Command"] == "NBT_tmi") {  
    $result = array();

    $sql = "SELECT NBT from temporary_manual_invoice where NBT like '%". $_GET['term'] . "%' group BY NBT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['NBT']));

    }

    echo json_encode($result);
}


//VAT

if ($_GET["Command"] == "VAT_tmi") {  
    $result = array();

    $sql = "SELECT VAT from temporary_manual_invoice where VAT like '%". $_GET['term'] . "%' group BY VAT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['VAT']));

    }

    echo json_encode($result);
}

//SVAT

if ($_GET["Command"] == "SVAT_tmi") {  
    $result = array();

    $sql = "SELECT SVAT from temporary_manual_invoice where SVAT like '%". $_GET['term'] . "%' group BY SVAT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['SVAT']));

    }

    echo json_encode($result);
}


//Performa Invoice



if ($_GET["Command"] == "SettlementDue_pro") {
    $result = array();

    $sql = "SELECT Settlement_Due from proforma_invoice where Settlement_Due like '%". $_GET['term'] . "%' group BY Settlement_Due limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Settlement_Due']));

    }

    echo json_encode($result);
}




if ($_GET["Command"] == "CustomerOrderNo_pro") {  
    $result = array();

    $sql = "SELECT Customer_Order_No from proforma_invoice where Customer_Order_No like '%". $_GET['term'] . "%' group BY Customer_Order_No limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Order_No']));

    }

    echo json_encode($result);
}




if ($_GET["Command"] == "Customer_Name_pro") {  
    $result = array();

    $sql = "SELECT Customer_Name from proforma_invoice where Customer_Name like '%". $_GET['term'] . "%' group BY Customer_Name limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Name']));

    }

    echo json_encode($result);
}



if ($_GET["Command"] == "CustomerAddress_pro") {  
    $result = array();

    $sql = "SELECT Customer_Address from proforma_invoice where Customer_Address like '%". $_GET['term'] . "%' group BY Customer_Address limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['Customer_Address']));

    }

    echo json_encode($result);
}


if ($_GET["Command"] == "NBT_pro") {  
    $result = array();

    $sql = "SELECT NBT from proforma_invoice where NBT like '%". $_GET['term'] . "%' group BY NBT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['NBT']));

    }

    echo json_encode($result);
}



if ($_GET["Command"] == "VAT_pro") {  
    $result = array();

    $sql = "SELECT VAT from proforma_invoice where VAT like '%". $_GET['term'] . "%' group BY VAT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['VAT']));

    }

    echo json_encode($result);
}



if ($_GET["Command"] == "SVAT_pro") {  
    $result = array();

    $sql = "SELECT SVAT from proforma_invoice where SVAT like '%". $_GET['term'] . "%' group BY SVAT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['SVAT']));

    }

    echo json_encode($result);
}


//06.07.2019

if ($_GET["Command"] == "SVAT_pro") {  
    $result = array();

    $sql = "SELECT SVAT from proforma_invoice where SVAT like '%". $_GET['term'] . "%' group BY SVAT limit 10";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("label" => $items['SVAT']));

    }

    echo json_encode($result);
}



?>