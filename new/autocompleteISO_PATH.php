<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');


if ($_GET["Command"] == "get_list") {
    
    
    $result = array();
    $sql = "select c_code,c_name from lcodes where  c_name like '%". $_GET['term'] . "%' ORDER BY c_code limit 10";
    foreach ($conn->query($sql) as $items) {
        array_push($result, array("id" => $items['c_code'], "label" => $items['c_code'] . '-' . $items['c_name'], "name" => $items['c_name']));
//array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
    }

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
    echo json_encode($result);
}



 