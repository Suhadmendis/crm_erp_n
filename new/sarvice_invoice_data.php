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

    $sql = "SELECT service_invoice_code FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['service_invoice_code'];

    $uniq = uniqid();


    $tmpinvno = "000000000" . $row["service_invoice_code"];

    $lenth = strlen($tmpinvno);
    $no = trim("CRSI/") . substr($tmpinvno, $lenth - 7);


    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT service_invoice_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['service_invoice_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["service_invoice_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("CRSI/") . substr($tmpinvno, $lenth - 7);

        $sql1 = "Insert into service_invoice(reference_no,date,dummy_po_no,currency_code,currency_rate,manual_no,suppler_code,katuwana_pvt,net_amount,tax_combination_code,consoalidate_cost,tax_amount,total_credt_amount,balance_amount_to_be_alocated,remarks,uniq)values 
       ('" . $no . "','" . $_GET['date'] . "','" . $_GET['dummy_po_no'] . "','" . $_GET['currency_code'] . "','" . $_GET['currency_rate'] . "','" . $_GET['manual_no'] . "','" . $_GET['suppler_code'] . "','" . $_GET['katuwana_pvt'] . "','" . $_GET['net_amount'] . "','" . $_GET['tax_combination_code'] . "','" . $_GET['consoalidate_cost'] . "','" . $_GET['tax_amount'] . "','" . $_GET['total_credt_amount'] . "','" . $_GET['balance_amount_to_be_alocated'] . "','" . $_GET['remarks'] . "','" . $_GET['uniq'] . "') ";
        $result = $conn->query($sql1);

        $sql2 = "select * from service_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into service_invoice_table(reference_no,rec_no,account_name,apply_tax,allocated_amount,total_amount,tax_amount,job_no,remark,uniq)values 
             ('" . $no . "','" . $row['rec_no'] . "','" . $row['account_name'] . "','" . $row['apply_tax'] . "','" . $row['allocated_amount'] . "','" . $row['total_amount'] . "','" . $row['tax_amount'] . "','" . $row['job_no'] . "','" . $row['remark'] ."','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {
            $sql = "DELETE FROM service_invoice_table_temp WHERE uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }

        $sql = "SELECT service_invoice_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['service_invoice_code'];
        $no2 = $no + 1;
        $sql = "update invpara set service_invoice_code = $no2 where service_invoice_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from service_invoice where reference_no = '" . $_GET['reference_no_Text'] . "'";
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

            $sql = "Insert into service_invoice_table_temp(reference_no,rec_no,account_name,apply_tax,allocated_amount,total_amount,tax_amount,job_no,remark,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['account_name'] . "','" . $_GET['apply_tax'] . "','" . $_GET['allocated_amount'] . "','" . $_GET['total_amount'] . "','" . $_GET['tax_amount'] . "','" . $_GET['job_no'] . "','" . $_GET['remark'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Account Name</th>
                                        <th style='width: 10%;'>Apply Tax</th>
                                        <th style='width: 10%;'>Allocated Amount</th>
                                        <th style='width: 10%;'>Tax Amount</th>
                                        <th style='width: 10%;'>Total Amount</th>
                                        <th style='width: 10%;'>Job No</th>
                                        <th style='width: 15%;'>Remarks</th>
                                        <th style='width: 12%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Account Name'  id='account_name_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Apply Tax'  id='apply_tax_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Allocated Amount'  id='allocated_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Amount'  id='tax_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Total Amount'  id='total_Amount_Tax' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Job No'  id='job_no_Text' class='form-control input-sm'>
                                        </td> 
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks_Text2' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM service_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['account_name'] . "</td><td>" . $row2['apply_tax'] . "</td><td>" . $row2['allocated_amount'] . "</td><td>" . $row2['tax_amount'] . "</td><td>" . $row2['total_amount'] . "</td><td>" . $row2['job_no'] . "</td><td>" . $row2['remark'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from service_invoice_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Account Name</th>
                                        <th style='width: 10%;'>Apply Tax</th>
                                        <th style='width: 10%;'>Allocated Amount</th>
                                        <th style='width: 10%;'>Tax Amount</th>
                                        <th style='width: 10%;'>Total Amount</th>
                                        <th style='width: 10%;'>Job No</th>
                                        <th style='width: 15%;'>Remarks</th>
                                        <th style='width: 12%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Account Name'  id='account_name_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Apply Tax'  id='apply_tax_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Allocated Amount'  id='allocated_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Amount'  id='tax_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Total Amount'  id='total_Amount_Tax' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Job No'  id='job_no_Text' class='form-control input-sm'>
                                        </td> 
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks_Text2' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

    $sql1 = "SELECT * FROM service_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['account_name'] . "</td><td>" . $row2['apply_tax'] . "</td><td>" . $row2['allocated_amount'] . "</td><td>" . $row2['tax_amount'] . "</td><td>" . $row2['total_amount'] . "</td><td>" . $row2['job_no'] . "</td><td>" . $row2['remark'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>