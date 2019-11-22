<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT reference_no FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['reference_no'];

    $uniq = uniqid();


    $tmpinvno = "000000000" . $row["reference_no"];

    $lenth = strlen($tmpinvno);
    $no = trim("SRQ/") . substr($tmpinvno, $lenth - 7);


    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "save_user") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT reference_no FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['reference_no'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["reference_no"];
        $lenth = strlen($tmpinvno);
        $no = trim("SRQ/") . substr($tmpinvno, $lenth - 7);

        $sql1 = "Insert into po_requisition_note_dummy(reference_no,date,manual_no,remarks,uniq)values 
    ('" . $no . "','" . $_GET['date'] . "','" . $_GET['manual_no'] . "','" . $_GET['remarks'] . "','" . $_GET['uniq'] . "') ";

        $result = $conn->query($sql1);

        $sql2 = "select * from po_requisition_note_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into po_requisition_note_dummy_table(reference_no,rec_no,product_code,qty,uniq)values 
             ('" . $no . "','" . $row['rec_no'] . "','" . $row['product_code'] . "','" . $row['qty'] . "','" . $row['uniq'] ."')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {
            $sql = "DELETE FROM po_requisition_note_dummy_table_temp WHERE uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }
        
        $sql = "SELECT reference_no FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['reference_no'];
        $no2 = $no + 1;
        $sql = "update invpara set reference_no = $no2 where reference_no = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from po_requisition_note_dummy where reference_no = '" . $_GET['reference_no_Text'] . "'";
    $result = $conn->query($sql);
    echo "delete";
}
if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command1"] == "add_tmp") {

        if ($_GET["Command1"] == "add_tmp") {

            $sql = "Insert into po_requisition_note_dummy_table_temp(reference_no,rec_no,product_code,qty,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['qty'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 20%;'>Rec No.</th>
                                        <th style='width: 50%;'>Product Code</th>
                                        <th style='width: 20%;'>Qty</th>
                                        <th style='width: 15%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty_Text' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM po_requisition_note_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql1) as $row2) {
            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]></sales_table>";
        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}


if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from po_requisition_note_dummy_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 20%;'>Rec No.</th>
                                        <th style='width: 50%;'>Product Code</th>
                                        <th style='width: 20%;'>Qty</th>
                                        <th style='width: 15%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty_Text' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

    $sql1 = "SELECT * FROM po_requisition_note_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";
    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>