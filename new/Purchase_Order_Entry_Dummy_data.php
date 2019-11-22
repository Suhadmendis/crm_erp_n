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

    $sql = "SELECT purchase_order_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['purchase_order_code'];
    $uniq = uniqid();
    $tmpinvno = "000000000" . $row["purchase_order_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("CDPO/") . substr($tmpinvno, $lenth - 7);
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT purchase_order_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['purchase_order_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["purchase_order_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("CDPO/") . substr($tmpinvno, $lenth - 7);
     

        $sql1 = "Insert into purchase_order_entry_dummy(reference_no,manual_no,code1,date,currency_code,exchange_rate,taransport,supplier,parame_components,cost_centre,consoalidate_cost_center,remarks,non,job_no,tax_combination,non_tax,total_discount,total_tax,total_value,uniq)values 
       ('" . $no . "','" . $_GET['manual_no'] . "','" . $_GET['code1'] . "','" . $_GET['date'] . "','" . $_GET['currency_code'] . "','" . $_GET['exchange_rate'] . "','" . $_GET['shipingMethod'] . "','" . $_GET['supplier'] . "','" . $_GET['parame_components'] . "','" . $_GET['cost_centre'] . "','" . $_GET['consoalidate_cost_center'] . "','" . $_GET['remarks'] . "','" . $_GET['non'] . "','" . $_GET['job_no'] . "','" . $_GET['tax_combination'] . "','" . $_GET['non_tax'] . "','" . $_GET['total_discount'] . "','" . $_GET['total_tax'] . "','" . $_GET['total_value'] . "','" . $_GET['uniq'] . "') ";

        $result = $conn->query($sql1);

        $sql2 = "select * from purchase_order_entry_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into purchase_order_entry_dummy_table(reference_no,rec_no,product_de,quantity,parchase_price,discount,value_s,uniq)values 
             ('" . $no . "','" . $row['rec_no'] . "','" . $row['product_de'] . "','" . $row['quantity'] . "','" . $row['parchase_price'] . "','" . $row['discount'] . "','" . $row['value_s'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {
            $sql = "DELETE FROM purchase_order_entry_dummy_table_temp WHERE uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }

        $aodn = $no;
        $sql = "SELECT purchase_order_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['purchase_order_code'];
        $no2 = $no + 1;
        $sql = "update invpara set purchase_order_code = $no2 where purchase_order_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from purchase_order_entry_dummy where reference_no = '" . $_GET['reference_no_Text'] . "'";
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

            $sql = "Insert into purchase_order_entry_dummy_table_temp(reference_no,rec_no,product_de,quantity,parchase_price,discount,value_s,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_de'] . "','" . $_GET['quantity'] . "','" . $_GET['parchase_price'] . "','" . $_GET['discount'] . "','" . $_GET['value_s'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 15%;'>Quantity</th>
                                        <th style='width: 15%;'>parchase Price</th>
                                        <th style='width: 15%;'>Discount %</th>
                                        <th style='width: 15%;'>Value</th>
                                        <th style='width: 12%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='parchase Price'  id='parchase_price_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount %'  id='discount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='value_Text' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM purchase_order_entry_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_de'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['parchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['value_s'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from purchase_order_entry_dummy_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 15%;'>Quantity</th>
                                        <th style='width: 15%;'>parchase Price</th>
                                        <th style='width: 15%;'>Discount %</th>
                                        <th style='width: 15%;'>Value</th>
                                        <th style='width: 12%;'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='parchase Price'  id='parchase_price_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount %'  id='discount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='value_Text' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

    $sql1 = "SELECT * FROM purchase_order_entry_dummy_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_de'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['parchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['value_s'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>