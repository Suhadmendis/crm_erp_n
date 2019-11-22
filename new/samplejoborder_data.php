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

    $sql = "SELECT jordcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
  
    $post = generateId($row['jordcode'], "SJO", "post");

    $ResponseXML .= "<id><![CDATA[$post]]></id>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from samplejoborder where SJRequestNo = '" . $_GET['sjrequestref'] . "'";
        $result = $conn->query($sql);
        $sql = "Insert into samplejoborder(SJRequestNo,sjbref,jodate,customer,mkex)values 
           ('" . $_GET['sjrequestref'] . "','" . $_GET['sjbref'] . "','" . $_GET['date_in'] . "','" . $_GET['customer'] . "','" . $_GET['mkex'] . "')";

        $result = $conn->query($sql);
        $sql = "SELECT jordcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jordcode'];
        
         $sql2 = "select * from samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {
           
                $sql = "Insert into samplejobreqnote_table(itemno,des,qty,jrid)values 
             ('" . $row['itemno'] . "','" . $row['des'] . "','" . $row['qty'] . "','" . $no . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }


        
        
        
        $no2 = $no + 1;
        $sql = "update invpara set jordcode = $no2 where jordcode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {

    $sql = "update sponcer set Sponcer = '" . $_GET['Sponcer'] . "',SpAddress = '" . $_GET['SpAddress'] . "',Email = '" . $_GET['Email'] . "',Phone = '" . $_GET['Phone'] . "',VatReg = '" . $_GET['VatReg'] . "',Cordinator = '" . $_GET['Cordinator'] . "',Designation = '" . $_GET['Designation'] . "'  where SponID = '" . $_GET['SponID'] . "'";
    $result = $conn->query($sql);
    echo "Updated";
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejoborder where SJRequestNo = '" . $_GET['sjrequestref'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}


if ($_GET["Command"] == "cancel") {

    $sql = "update sponcer set Cancel = '1'   where SponID = '" . $_GET['SponID'] . "'";
    $result = $conn->query($sql);


    echo "canceled";
}
?>