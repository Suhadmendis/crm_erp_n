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

        $temp = substr("000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}


if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT factrycode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['factrycode'];
    
     $post = generateId($row['factrycode'], "FTY/", "post");
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
        
        $sql = "delete from factrymaster where factryref = '" . $_GET['factry_ref_txt'] . "'";
        
        $result = $conn->query($sql);
        
        $sql = "Insert into factrymaster(factryref,factryname,factrydiscription)values 
           ('" . $_GET['factry_ref_txt'] . "','" . $_GET['factry_name_txt'] . "','" . $_GET['factry_desc_txt'] . "')";


        $result = $conn->query($sql);
        $sql = "SELECT factrycode FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['factrycode'];
        $no2 = $no + 1;
        $sql = "update invpara set factrycode = $no2 where factrycode = $no";
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
        $sql = "update factrymaster set factryref = '" . $_GET['factry_ref_txt'] . "',factryname = '" . $_GET['factry_name_txt'] . "',factrydiscription = '" . $_GET['factry_desc_txt'] . "'  where factryref = '" . $_GET['factry_ref_txt'] . "'";
        $result = $conn->query($sql);
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {
   
        $sql = "delete from factrymaster where factryref = '" . $_GET['factry_ref_txt'] . "'";
        $result = $conn->query($sql);
        echo "delete";
   
}

?>