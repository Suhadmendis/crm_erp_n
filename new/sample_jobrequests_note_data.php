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

    $sql = "SELECT sjrncode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();


    $post = generateId($row['sjrncode'], "SJR/", "post");

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

        $sql = "SELECT sjrncode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['sjrncode'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["sjrncode"];
        $lenth = strlen($tmpinvno);
        $no = trim("SJR/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into samplejobreqnote(reference_no,jobreqdate,customer_ref,mkex)values 
           ('" . $no . "','" . $_GET['date_in'] . "','" . $_GET['customer_ref'] . "','" . $_GET['mkex'] . "')";
           $result = $conn->query($sql);

//        $sql2 = "select * from samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "'";
        $sql2 = "SELECT * FROM samplejobreqnote_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into samplejobreqnote_table(Item_No,Sample_Description,Sample_Qty,reference_no,uniq)values 
             ('" . $row['Item_No'] . "','" . $row['Sample_Description'] . "','" . $row['Sample_Qty'] . "','" . $no . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM samplejobreqnote_table_temp where uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT sjrncode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['sjrncode'];
        $no2 = $no + 1;
        $sql = "update invpara set sjrncode = $no2 where sjrncode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {

    $sql = "update samplejobreqnote set jobreqdate = '" . $_GET['date_in'] . "',customer = '" . $_GET['customer'] . "',mkex = '" . $_GET['mkex'] . "'  where jrid = '" . $_GET['sjrequestref'] . "'";
    $result = $conn->query($sql);
    echo "update";
}


//if ($_GET["Command"] == "delete") {
//
//    $sql = "delete from samplejobreqnote where jrid = '" . $_GET['sjrequestref'] . "'";
//    $result = $conn->query($sql);
//    echo "Deleted";
//}

//temporary table

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into samplejobreqnote_table_temp(reference_no,uniq,Item_No,Sample_Description,Sample_Qty)values 
     ('" . $_GET['sjrequestref'] .  "','" . $_GET['uniq'] . "','" . $_GET['Item_No'] . "','" . $_GET['Sample_Description'] . "','" . $_GET['Sample_Qty'] . "')";

        $result = $conn->query($sql);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Item No</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Item No.' id='Item_No' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='Sample_Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Sample QTY'  id='Sample_Qty' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * from samplejobreqnote_table_temp where uniq = '" . $_GET['uniq'] . "'";

    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Item_No'] . "</td><td>" . $row2['Sample_Description'] . "</td><td>" . $row2['Sample_Qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from samplejobreqnote_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Item No</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Item No.' id='Item_No' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='Sample_Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Sample QTY'  id='Sample_Qty' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";
    $sql1 = "SELECT * FROM samplejobreqnote_table_temp where uniq = '" . $_GET['uniq'] . "'";
    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Item_No'] . "</td><td>" . $row2['Sample_Description'] . "</td><td>" . $row2['Sample_Qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }
    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>