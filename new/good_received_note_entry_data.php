<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT good_received_note_entry_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['good_received_note_entry_code'];
//    uniq
    $uniq = uniqid();

    $tmpinvno = "000000" . $row["good_received_note_entry_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("CGT/") . substr($tmpinvno, $lenth - 7);




    $ResponseXML .= "<reference_no><![CDATA[$no]]></reference_no>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "SELECT good_received_note_entry_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['good_received_note_entry_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["good_received_note_entry_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("CGT/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into good_received_note_ent(reference_no,date,purchase_order_no,manual_no,currency_code,exchange_rate,supplier_code,location_code,cost_centre,remarks,tax_combination,transport)values 
                        ('" . $_GET['reference_no'] . "','" . $_GET['date'] . "','" . $_GET['purchase_order_no'] . "','" . $_GET['manual_no'] . "','" . $_GET['currency_code'] . "','" . $_GET['exchange_rate'] . "','" . $_GET['supplier_code'] . "','" . $_GET['location_code'] . "','" . $_GET['cost_centre'] . "','" . $_GET['remarks'] . "','" . $_GET['tax_combination'] . "','" . $_GET['shipping_method'] . "')";
        $result = $conn->query($sql);
        //echo $sql;


        $sql2 = "SELECT * FROM good_received_note_ent_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into good_received_note_ent_table(reference_no,rec_no,product_code,product_description,quantity,purchase_price,local_price,discount,import_exp,grn_value,tax_combination,uniq)values 
             ('" . $row['reference_no'] . "','" . $row['rec_no'] . "','" . $row['product_code'] . "','" . $row['product_description'] . "','" . $row['quantity'] . "','" . $row['purchase_price'] . "','" . $row['local_price'] . "','" . $row['discount'] . "','" . $row['import_exp'] . "','" . $row['grn_value'] . "','" . $row['tax_combination'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM good_received_note_ent_table_temp where uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }


        $sql = "SELECT good_received_note_entry_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['good_received_note_entry_code'];
        $no2 = $no + 1;
        $sql = "update invpara set good_received_note_entry_code = $no2 where good_received_note_entry_code = $no";
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
        $sql = "update good_received_note_ent set date = '" . $_GET['date'] . "' ,purchase_order_no = '" . $_GET['purchase_order_no'] . "' ,manual_no = '" . $_GET['manual_no'] . "' ,currency_code = '" . $_GET['currency_code'] . "' ,exchange_rate = '" . $_GET['exchange_rate'] . "' ,supplier_code = '" . $_GET['supplier_code'] . "' ,location_code = '" . $_GET['location_code'] . "' ,cost_centre = '" . $_GET['cost_centre'] . "' ,remarks = '" . $_GET['remarks'] . "' ,tax_combination = '" . $_GET['tax_combination'] . "'  where reference_no = '" . $_GET['reference_no'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from good_received_note_ent where reference_no = '" . $_GET['reference_no'] . "'";
    $result = $conn->query($sql);
    //  echo $sql;
    echo "delete";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



//        $mid = $_GET["sjrequestref"];
//        $pieces = explode("/", $mid);
//        $mid = (int) $pieces[1];




        if ($_GET["Command1"] == "add_tmp") {

            $sql = "Insert into good_received_note_ent_table_temp(reference_no,rec_no,product_code,product_description,quantity,purchase_price,local_price,discount,import_exp,grn_value,tax_combination,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['product_description'] . "','" . $_GET['quantity'] . "','" . $_GET['purchase_price'] . "','" . $_GET['local_price'] . "','" . $_GET['discount'] . "','" . $_GET['import_exp'] . "','" . $_GET['grn_value'] . "','" . $_GET['tax_combination'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 5%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Local Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>import Exp</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Combination</th>
                                    <th style='width: 5%;'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Local Price'  id='local_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Import EXP'  id='import_exp' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='value'  id='grn_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_txt' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




        $sql1 = "SELECT * FROM good_received_note_ent_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['local_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['import_exp'] . "</td><td>" . $row2['grn_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]></sales_table>";
        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}

//delete


if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from good_received_note_ent_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                   <th style='width: 5%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Local Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>import Exp</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Combination</th>
                                    <th style='width: 5%;'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                       <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Local Price'  id='local_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Import EXP'  id='import_exp' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='value'  id='grn_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_txt' class='form-control input-sm'>
                                        </td>
                                        
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";





    $sql1 = "SELECT * FROM good_received_note_ent_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['local_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['import_exp'] . "</td><td>" . $row2['grn_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        // $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['local_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['import_exp'] . "</td><td>" . $row2['grn_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp;
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>