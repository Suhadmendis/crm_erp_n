<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT purchase_order_entry_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['purchase_order_entry_code'];
//    uniq
    $uniq = uniqid();

    $tmpinvno = "000000" . $row["purchase_order_entry_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("PO/") . substr($tmpinvno, $lenth - 7);




    $ResponseXML .= "<reference_no><![CDATA[$no]]></reference_no>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";


    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "SELECT purchase_order_entry_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['purchase_order_entry_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["purchase_order_entry_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("PO/") . substr($tmpinvno, $lenth - 7);
        
        $sql1 = "Insert into purchase_order_entry(reference_no,manual_no,po_requisition,date,currency_code,exchange_rate,supplier,cost_centre,remarks,tax_combination,transport)values 
                        ('" . $_GET['reference_no'] . "','" . $_GET['manual_no'] . "','" . $_GET['po_requisition'] . "','" . $_GET['date'] . "','" . $_GET['currency_code'] . "','" . $_GET['exchange_rate'] . "','" . $_GET['supplier'] . "','" . $_GET['cost_centre'] . "','" . $_GET['remarks'] . "','" . $_GET['tax_combination'] . "','" . $_GET['shipping_method'] . "')";
        $result = $conn->query($sql1);

//        echo $sql;
        $sql2 = "SELECT * FROM purchase_order_entry_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into purchase_order_entry_table(reference_no,rec_no,product_code,product_description,req_bal,quantity,purchase_price,discount,po_value,tax_combination,uniq)values 
             ('" . $row['reference_no'] . "','" . $row['rec_no'] . "','" . $row['product_code'] . "','" . $row['product_description'] . "','" . $row['req_bal'] . "','" . $row['quantity'] . "','" . $row['purchase_price'] . "','" . $row['discount'] . "','" . $row['po_value'] . "','" . $row['tax_combination'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM purchase_order_entry_table_temp where uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }



        $sql = "SELECT purchase_order_entry_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['purchase_order_entry_code'];
        $no2 = $no + 1;
        $sql = "update invpara set purchase_order_entry_code = $no2 where purchase_order_entry_code = $no";
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
        $sql = "update purchase_order_entry set manual_no = '" . $_GET['manual_no'] . "' ,po_requisition = '" . $_GET['po_requisition'] . "' ,date = '" . $_GET['date'] . "' ,currency_code = '" . $_GET['currency_code'] . "' ,exchange_rate = '" . $_GET['exchange_rate'] . "' ,supplier = '" . $_GET['supplier'] . "' ,cost_centre = '" . $_GET['cost_centre'] . "' ,remarks = '" . $_GET['remarks'] . "' ,tax_combination = '" . $_GET['tax_combination'] . "'  where reference_no = '" . $_GET['reference_no'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from purchase_order_entry where reference_no = '" . $_GET['reference_no'] . "'";
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


        if ($_GET["Command1"] == "add_tmp") {

            $sql = "Insert into purchase_order_entry_table_temp(reference_no,rec_no,product_code,product_description,req_bal,quantity,purchase_price,discount,po_value,tax_combination,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['product_description'] . "','" . $_GET['req_bal'] . "','" . $_GET['quantity'] . "','" . $_GET['purchase_price'] . "','" . $_GET['discount'] . "','" . $_GET['po_value'] . "','" . $_GET['tax_combination'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Req.Bal</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Combination</th>
                                    <th style='width: 10%;'></th>
                                   
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
                                            <input  type='text' placeholder='Req_Bal'  id='req_bal' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                         <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='po_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_Text' class='form-control input-sm'>
                                        </td>
                                        
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

   
                                </tr>";




        $sql1 = "SELECT * FROM purchase_order_entry_table_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql1) as $row2) {
            // $ResponseXML .= "<tr><td>" . $row2['rec_no']. "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['req_bal'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['po_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from purchase_order_entry_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Req.Bal</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Combination</th>
                                    <th style='width: 10%;'></th>
                                    
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
                                            <input  type='text' placeholder='Req_Bal'  id='req_bal' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='po_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_Text' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";





    $sql1 = "SELECT * FROM purchase_order_entry_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['req_bal'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['po_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>