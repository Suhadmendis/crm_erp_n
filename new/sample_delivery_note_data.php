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

    $sql = "SELECT jobdelcodeDilver FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['jobdelcode'];

    $post = generateId($row['jobdelcodeDilver'], "SD/", "post");
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

        $sql = "SELECT jobdelcodeDilver FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobdelcodeDilver'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["jobdelcodeDilver"];
        $lenth = strlen($tmpinvno);
        $no = trim("SD/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into sampledeliverynote(reference_no,aod,customer,deliverydate)values 
           ('" . $no . "','" . $_GET['aod_txt'] . "','" . $_GET['customer_txt'] . "','" . $_GET['date_txt'] . "')";
        $result = $conn->query($sql);
        $sql2 = "select * from sampledeliverynote_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {
            $sql = "Insert into sampledeliverynote_table(sjbno,itemname,qty,remarks,reference_no)values 
             ('" . $row['sjbno'] .  "','" . $row['itemname'] . "','" . $row['qty'] . "','" . $row['remarks'] . "','" . $no . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {
            $sql = "DELETE FROM sampledeliverynote_table_temp where uniq= '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }

        $sql = "SELECT jobdelcodeDilver FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobdelcodeDilver'];
        $no2 = $no + 1;
        $sql = "update invpara set jobdelcodeDilver = $no2 where jobdelcodeDilver = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

//if ($_GET["Command"] == "update") {
//
//    $sql = "update sampledeliverynote set aod = '" . $_GET['aod_txt'] . "',customer = '" . $_GET['customer_txt'] . "',deliverydate = '" . $_GET['date_txt'] . "' where sampletransnote = '" . $_GET['sampletransnote_txt'] . "'";
//    $result = $conn->query($sql);
//    echo "update";
//}

if ($_GET["Command"] == "delete") {

    $sql = "delete from sampledeliverynote where sampletransnote = '" . $_GET['sampletransnote_txt'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into sampledeliverynote_table_temp(reference_no,uniq,sjbno,itemname,qty,remarks)values 
     ('" . $_GET['sampletransnote_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['sjbno'] . "','" . $_GET['itemname'] . "','" . $_GET['qty'] . "','" . $_GET['remarks'] . "')";

        $result = $conn->query($sql);
        //echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>SJB No.</th>
                                    <th style='width: 10%;'>Item Name</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Remarks</th>
                                    <th style='width: 10%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                       <td>
                                            <input type='text' placeholder='SJB No.' id='sjbno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Item Name'  id='itemname' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='QTY'  id='qty' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks' class='form-control input-sm'>
                                        </td>                                      
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";
    $sql1 = "SELECT * FROM sampledeliverynote_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['itemname'] . "</td><td>" . $row2['qty'] . "</td><td>" . $row2['remarks'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from sampledeliverynote_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>SJB No.</th>
                                    <th style='width: 10%;'>Item Name</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Remarks</th>
                                    <th style='width: 10%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='SJB No.' id='sjbno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Item Name'  id='itemname' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='QTY'  id='qty' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";
    $sql1 = "SELECT * FROM sampledeliverynote_table_temp where uniq = '" . $_GET['uniq'] . "'";

    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['itemname'] . "</td><td>" . $row2['qty'] . "</td><td>" . $row2['remarks'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }
    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>