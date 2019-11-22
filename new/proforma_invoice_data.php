<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');




if ($_GET["Command"] == "getVendor") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT NAME FROM vendor WHERE NAME LIKE '" . $_GET['input'] . "' AND CAT = '" . $_GET['cus_or_sup'] . "'  LIMIT 15";

    foreach ($conn->query($sql1) as $row2) {

        $code .= "<option value='" . $row2['NAME'] . ' - ' . $row2['NAME'] . "'>";
    }
    $ResponseXML .= "<contentlist><![CDATA[" . $code . "]]></contentlist>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "updateTable") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT * FROM manuel_aod_table_temp WHERE aodnumber = '" . $_GET['aodnumber'] . "'";


    $qty = "QTY";


    $rows .= "<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Customer Purchase Order No.</th>
                                    <th style='width: 70%;'>Product Description</th>
                                    <th style='width: 15%;'>QTY</th>
                                    <th style='width: 5%;'>Item</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='Customer Purchase Order No.' id='Customer_Order_number' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Product Description'  id='Product_Des' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input   type='text' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                    </td>
                                    <td><a onclick='addrow();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";


    foreach ($conn->query($sql1) as $row2) {

        $rows .= "<tr><td>" . $row2['Customer_Order_number'] . "</td><td>" . $row2['Product_Des'] . "</td><td>" . $row2['QTY'] . "</td><td><a onclick='removeRow(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $rows .= "</tbody>

                        </table>";



    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "checkvendor") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT NAME FROM vendor WHERE NAME LIKE '" . $_GET['input'] . "' AND CAT = '" . $_GET['cus_or_sup'] . "'  LIMIT 15";

    foreach ($conn->query($sql1) as $row2) {

        $code .= "<option value='" . $row2['NAME'] . ' - ' . $row2['NAME'] . "'>";
    }



    $ResponseXML .= "<contentlist><![CDATA[" . $code . "]]></contentlist>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}


if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sqlno = "SELECT proforma_invoice_code FROM inv_data";
        $result = $conn->query($sqlno);
        $row = $result->fetch();
        $no = $row['proforma_invoice_code'];




        $sql = "Insert into proforma_invoice(Invoice_Number,Invoice_Date,Settlement_Due,Customer_Order_No,ouraodnumber,Currency,Customer_Name,Customer_Address,NBT,VAT,SVAT,svatboo,vatboo,nbtboo,rate,yes,no,Advance)values
        ('" . $no . "','" . $_GET['Invoice_Date'] . "','" . $_GET['Settlement_Due'] . "','" . $_GET['Customer_Order_No'] . "','" . $_GET['ouraodnumber'] . "','" . $_GET['Currency'] . "','" . $_GET['Customer_Name'] . "','" . $_GET['Customer_Address'] . "','" . $_GET['NBT'] . "','" . $_GET['VAT'] . "','" . $_GET['SVAT'] . "','" . $_GET['svatboo'] . "','" . $_GET['vatboo'] . "','" . $_GET['nbtboo'] . "','" . $_GET['rate'] . "','" . $_GET['yes'] . "','" . $_GET['no'] . "','" . $_GET['Advance'] . "')";
        $result = $conn->query($sql);

        $sql2 = "select * from proforma_invoice_table_temp where Invoice_Number = '" . $_GET['Invoice_Number'] . "' and uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {
            $des = str_replace("'", "\'", $row['Description']);
            $des = str_replace("$", "&amp;", $des);
            $sql = "Insert into proforma_invoice_table(Invoice_Number,QTY,Description,Unit_Price,Value,vat,uniq)values
             ('" . $no . "','" . $row['QTY'] . "','" . $des . "','" . $row['Unit_Price'] . "','" . $row['Value'] . "','" . $row['Vat'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM proforma_invoice_table_temp WHERE Invoice_Number = '" . $row['Invoice_Number'] . "' and uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }




        $sql = "SELECT proforma_invoice_code FROM inv_data";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['proforma_invoice_code'];
        $no2 = $no + 1;
        $sql = "update inv_data set proforma_invoice_code = $no2 where proforma_invoice_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT proforma_invoice_code FROM inv_data";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['proforma_invoice_code'];
    $uniq = uniqid();



    $tb .= "<div id='getTable'>
                            <table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>QTY</th>
                                        <th style='width: 65%;'>Description</th>
                                        <th style='width: 10%;'>Unit Price</th>
                                        <th style='width: 10%;'>Value</th>


                                        <th style='width: 5%;'>Add/Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input  type='text' onkeyup='taxCal();' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Description'  id='Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' onkeyup='taxCal(event);' placeholder='Unit Price'  id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Value'  id='Value' class='form-control input-sm'>
                                        </td>


                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>";



    $ResponseXML .= "<id2><![CDATA[$no]]></id2>";
    $ResponseXML .= "<id3><![CDATA[$uniq]]></id3>";

    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "temp_m_AOD") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "Insert into manuel_aod_table_temp(aodnumber,Customer_Order_number,Product_Des,QTY)values
     ('" . $_GET['aodnumber'] . "','" . $_GET['Customer_Order_number'] . "','" . $_GET['Product_Des'] . "','" . $_GET['QTY'] . "')";

        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "remove") {

    $sql = "delete from manuel_aod_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}


if ($_GET["Command"] == "setitem") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    if ($_GET["Command1"] == "add_tmp") {



        $des = str_replace("'", "\'", $_GET['Description']);


        $sql = "Insert into proforma_invoice_table_temp(Invoice_Number,QTY,Description,Unit_Price,Value,uniq)values
     ('" . $_GET['Invoice_Number'] . "','" . $_GET['QTY'] . "','" . $des . "','" . $_GET['Unit_Price'] . "','" . $_GET['Value'] . "','" . $_GET['uniq'] . "')";

        $result = $conn->query($sql);
    }

    $currencyDec = 2;
    if ($_GET['rate'] > 1) {
        $currencyDec = 4;
    }


    $ResponseXML .= "<sales_table><![CDATA[<div id='getTable'><table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>QTY</th>
                                        <th style='width: 65%;'>Description</th>
                                        <th style='width: 10%;'>Unit Price</th>
                                        <th style='width: 10%;'>Value</th>


                                        <th style='width: 5%;'>Add/Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input  type='text' onkeyup='taxCal();' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Description'  id='Description' class='form-control input-sm'>
                                        </td>
                                        <td title='Press Enter Key to Add Row'>
                                            <input type='text' onkeyup='taxCal(event);' placeholder='Unit Price'  id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Value'  id='Value' class='form-control input-sm'>
                                        </td>


                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                    </tr>";


    $sql1 = "SELECT * FROM proforma_invoice_table_temp WHERE Invoice_Number = '" . $_GET['Invoice_Number'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['QTY'] . "</td><td>" . $row2['Description'] . "</td><td>" . cal($row2['Unit_Price']) . "</td><td>" . cal($row2['Value']) . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $sqltot = "SELECT sum(value) from  proforma_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";


    $result = $conn->query($sqltot);
    $row = $result->fetch();
//    $no = $row['proforma_invoice_code'];
//    $uniq = uniqid();
//    $row = "sdf";
//    $rssvat = "";
//    if ($_GET['rate'] != 1) {
//        $rssvat = "<br>(Rs. " . $row[0] * $_GET['rate'] . ")";
//    } else {
//        $rssvat = "";
//    }


    if ($_GET['svatboo'] == 1) {
        if ($_GET['nbtboo'] == 1) {

            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $svat = $nbt + $row[0];
            $svat = $svat / 100;
            $svat = $svat * 15;
            $grand = $row[0] + $nbt;





            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($nbt) . "</td>
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td>"
                    . "" . cal($svat) . "  </td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>


";
        } else {


            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;
//            $totby1 = $totby1 + $row[0];

            $rssvat = "";
            if ($_GET['rate'] != 1) {
                $rssvat = "<br>(Rs. " . cal($_GET['rate'] * $totby1) . ")";
            } else {
                $rssvat = "";
            }

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td> "
                    . "" .
                    cal($totby1) . "" . $rssvat . "
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row[0] - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>

";
        }
    } else {
        if ($_GET['nbtboo'] == 1) {
            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $totby1 = $row[0] + $nbt;
            $totby1 = $totby1 / 100;
            $vat = $totby1 * 15;

            $grand = $row[0] + $vat + $nbt;

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>"
                    . "" . cal($nbt) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($vat) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "
                                        </td>


                                        <td></td>

                                    </tr>
<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>


";
        } else {
            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;

            $grand = $totby1 + $row[0];
            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($totby1) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "

                                        </td>


                                        <td></td>

                                    </tr>

<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>


";
        }
    }







    $ResponseXML .= "</tbody></table></div>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}

if ($_GET["Command1"] == "add_tmpp") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "Insert into proforma_invoice_table_temp(QTY,Description,Unit_Price,Value)values
     ('" . $_GET['QTY'] . "','" . $_GET['Description'] . "','" . $_GET['Unit_Price'] . "','" . $_GET['Value'] . "')";

        $result = $conn->query($sql);
        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "removerow") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from proforma_invoice_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);


    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>QTY</th>
                                        <th style='width: 65%;'>Description</th>
                                        <th style='width: 10%;'>Unit Price</th>
                                        <th style='width: 10%;'>Value</th>


                                        <th style='width: 5%;'>Add/Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input  type='text' onkeyup='taxCal();' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Description'  id='Description' class='form-control input-sm'>
                                        </td>
                                        <td title='Press Enter Key to Add Row'>
                                            <input type='text' onkeyup='taxCal(event);' placeholder='Unit Price'  id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Value'  id='Value' class='form-control input-sm'>
                                        </td>


                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                    </tr>";


    $sql1 = "SELECT * FROM proforma_invoice_table_temp WHERE Invoice_Number = '" . $_GET['Invoice_Number'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['QTY'] . "</td><td>" . $row2['Description'] . "</td><td>" . cal($row2['Unit_Price']) . "</td><td>" . cal($row2['Value']) . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }



    $currencyDec = 2;
    if ($_GET['rate'] > 1) {
        $currencyDec = 4;
    }

    $sqltot = "SELECT sum(value) from  proforma_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";


    $result = $conn->query($sqltot);
    $row = $result->fetch();
//    $no = $row['proforma_invoice_code'];
//    $uniq = uniqid();
//    $row = "sdf";
//    $rssvat = "";
//    if ($_GET['rate'] != 1) {
//        $rssvat = "<br>(Rs. " . $row[0] * $_GET['rate'] . ")";
//    } else {
//        $rssvat = "";
//    }


    if ($_GET['svatboo'] == 1) {
        if ($_GET['nbtboo'] == 1) {

            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $svat = $nbt + $row[0];
            $svat = $svat / 100;
            $svat = $svat * 15;
            $grand = $row[0] + $nbt;





            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($nbt) . "</td>
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td>"
                    . "" . cal($svat) . "  </td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "

                                        </td>


                                        <td></td>

                                    </tr>

                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>


";
        } else {


            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;
//            $totby1 = $totby1 + $row[0];

            $rssvat = "";
            if ($_GET['rate'] != 1) {
                $rssvat = "<br>(Rs. " . cal($_GET['rate'] * $totby1) . ")";
            } else {
                $rssvat = "";
            }

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td> "
                    . "" .
                    cal($totby1) . "" . $rssvat . "
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>


                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row[0] - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>

";
        }
    } else {
        if ($_GET['nbtboo'] == 1) {
            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $totby1 = $row[0] + $nbt;
            $totby1 = $totby1 / 100;
            $vat = $totby1 * 15;

            $grand = $row[0] + $vat + $nbt;

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>"
                    . "" . cal($nbt) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($vat) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "
                                        </td>


                                        <td></td>

                                    </tr>

                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
";
        } else {
            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;

            $grand = $totby1 + $row[0];
            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "
                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($totby1) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "

                                        </td>


                                        <td></td>

                                    </tr>

                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "

                                        </td>


                                        <td></td>

                                    </tr>


";
        }
    }







    $ResponseXML .= "</tbody></table>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from proforma_invoice where Invoice_Number = '" . $_GET['Invoice_Number'] . "'";
    $result = $conn->query($sql);

    $sql = "delete from proforma_invoice_table where Invoice_Number = '" . $_GET['Invoice_Number'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}

function cal($val) {

    $backfront = explode(".", $val);
    if ($backfront[1] == NULL) {
        return $backfront[0] . ".0000";
    } else {
        return $backfront[0] . "." . substr($backfront[1], 0, 4);
    }
}

function replaceText($text) {


    $text = str_replace("'", "\'", $text);
    $text = str_replace("#", "\#", $text);
    $text = str_replace("&", "\&", $text);

//    $text = str_replace("'", "\'",$text);
//    $text = str_replace("'", "\'",$text);
//    $text = str_replace("'", "\'",$text);
//    $text = str_replace("'", "\'",$text);




    return $text;
}
