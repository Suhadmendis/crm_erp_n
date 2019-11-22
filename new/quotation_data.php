<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');

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





        $attn = str_replace("'", "\'", $_GET['ATTN']);



        $no1 = 0;
        if ($_GET['version'] == 1) {

            if (strpos($_GET['Quotation_NO'], '-')) {
                $tempID = explode("-", $_GET['Quotation_NO']);
                $sql = "SELECT Quotation_NO from quotation where Quotation_NO LIKE '%" . $tempID[0] . "%' ORDER BY Quotation_NO DESC LIMIT 1";
            } else {
                $sql = "SELECT Quotation_NO from quotation where Quotation_NO LIKE '%" . $_GET['Quotation_NO'] . "%' ORDER BY Quotation_NO DESC LIMIT 1";
            }


            $resul = $conn->query($sql);
            $row = $resul->fetch();

            $id = $row['Quotation_NO'];
//    Q/0000029

            if (strpos($id, '-')) {
                $exID = explode("-", $id);
                $no1 = $exID[1];
                ++$no1;
            } else {
                $no1 = "1";
            }

            $exID = explode("-", $id);



            $id = $exID[0] . "-" . $no1;
        } else {


            $sql = "delete from quotation where Quotation_NO = '" . $_GET['Quotation_NO'] . "'";
            $result = $conn->query($sql);



            $id = $_GET['Quotation_NO'];
        }

        if ($_GET['update'] == 1) {

            if ($_GET['version'] == 1) {
                
            } else {
                $sql2 = "select * from quotation_table where Quotation_NO = '" . $_GET['Quotation_NO'] . "'";

                foreach ($conn->query($sql2) as $row) {

                    $sql = "DELETE FROM quotation_table WHERE Quotation_NO = '" . $row['Quotation_NO'] . "'";
                    $result = $conn->query($sql);
                }
            }




            // main save
            $sql = "Insert into quotation(Quotation_NO,manual_ref,ATTN,CC,TOOO,FROMMM,DATE,SUBJECT,All_payment,Validity_of_quotation,Payment,Delivery,Remark,Text_0,Text_1,Text_2,version)values 
        ('" . $id . "','" . $_GET['manual_ref'] . "','" . $attn . "','" . $_GET['CC'] . "','" . $_GET['TO'] . "','" . $_GET['FROM'] . "','" . $_GET['DATE'] . "','" . $_GET['SUBJECT'] . "','" . $_GET['All_payment'] . "','" . $_GET['Validity_of_quotation'] . "','" . $_GET['Payment'] . "','" . $_GET['Delivery'] . "','" . $_GET['Remark'] . "','" . $_GET['Text_0'] . "','" . $_GET['Text_1'] . "','" . $_GET['Text_2'] . "','" . $no1 . "')";
            $result = $conn->query($sql);


            // temp table transfer
            $sql2 = "select * from quotation_table_temp where Quotation_NO = '" . $_GET['Quotation_NO'] . "' and uniq = '" . $_GET['uniq'] . "'";
            foreach ($conn->query($sql2) as $row) {

                $sql = "Insert into quotation_table(Quotation_NO,Location,Item_Name,Description,Qty,Unit_Price,tbl_remark)values 
             ('" . $id . "','" . $row['Location'] . "','" . $row['Item_Name'] . "','" . $row['Description'] . "','" . $row['Qty'] . "','" . $row['Unit_Price'] ."','" . $row['tbl_remark'] . "')";

                $result = $conn->query($sql);
            }




            foreach ($conn->query($sql2) as $row) {

                $sql = "DELETE FROM quotation_table_temp WHERE Quotation_NO = '" . $row['Quotation_NO'] . "'";
                $result = $conn->query($sql);
            }
        } else {

            // main save
            $sql = "Insert into quotation(Quotation_NO,manual_ref,ATTN,CC,TOOO,FROMMM,DATE,SUBJECT,All_payment,Validity_of_quotation,Payment,Delivery,Remark,Text_0,Text_1,Text_2,version,prepare)values 
        ('" . $id . "','" . $_GET['manual_ref'] . "','" . $attn . "','" . $_GET['CC'] . "','" . $_GET['TO'] . "','" . $_GET['FROM'] . "','" . $_GET['DATE'] . "','" . $_GET['SUBJECT'] . "','" . $_GET['All_payment'] . "','" . $_GET['Validity_of_quotation'] . "','" . $_GET['Payment'] . "','" . $_GET['Delivery'] . "','" . $_GET['Remark'] . "','" . $_GET['Text_0'] . "','" . $_GET['Text_1'] . "','" . $_GET['Text_2'] . "','" . $no1 . "','" . $_SESSION['UserName'] . "')";
            $result = $conn->query($sql);



//        // temp table transfer
//        $sql2 = "select * from quotation_table where Quotation_NO = '" . $_GET['Quotation_NO'] . "'";
//        foreach ($conn->query($sql2) as $row) {
//
//            $sql = "Insert into quotation_table_temp(Quotation_NO,Location,Item_Name,Description,Qty,Unit_Price,uniq)values 
//             ('" . $id . "','" . $row['Location'] . "','" . $row['Item_Name'] . "','" . $row['Description'] . "','" . $row['Qty'] . "','" . $row['Unit_Price'] . "','" . $_GET['uniq'] . "')";
//
//            $result = $conn->query($sql);
//        }
//
            // temp table transfer
            $sql2 = "select * from quotation_table_temp where Quotation_NO = '" . $_GET['Quotation_NO'] . "' and uniq = '" . $_GET['uniq'] . "'";
            foreach ($conn->query($sql2) as $row) {

                $sql = "Insert into quotation_table(Quotation_NO,Location,Item_Name,Description,Qty,Unit_Price,tbl_remark)values 
             ('" . $id . "','" . $row['Location'] . "','" . $row['Item_Name'] . "','" . $row['Description'] . "','" . $row['Qty'] . "','" . $row['Unit_Price'] ."','" . $row['tbl_remark'] . "')";

                $result = $conn->query($sql);
            }


            if ($_GET['version'] == 1) {
                // temp table transfer
                $sql2 = "select * from quotation_table_temp where Quotation_NO = '" . $id . "' and uniq = '" . $_GET['uniq'] . "'";
                foreach ($conn->query($sql2) as $row) {

                    $sql = "Insert into quotation_table(Quotation_NO,Location,Item_Name,Description,Qty,Unit_Price,tbl_remark)values 
             ('" . $id . "','" . $row['Location'] . "','" . $row['Item_Name'] . "','" . $row['Description'] . "','" . $row['Qty'] . "','" . $row['Unit_Price'] . "','" . $row['tbl_remark'] . "')";

                    $result = $conn->query($sql);
                }
            }




            foreach ($conn->query($sql2) as $row) {

                $sql = "DELETE FROM quotation_table_temp WHERE Quotation_NO = '" . $row['Quotation_NO'] . "'";
                $result = $conn->query($sql);
            }



            $sql = "SELECT quotation_code FROM inv_data";
            $resul = $conn->query($sql);
            $row = $resul->fetch();
            $no = $row['quotation_code'];
            $no2 = $no + 1;
            $sql = "update inv_data set quotation_code = $no2 where quotation_code = $no";
            $result = $conn->query($sql);
        }




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

    $sql = "SELECT quotation_code FROM inv_data";
    $result = $conn->query($sql);
    $row = $result->fetch();


    $post = generateId($row['quotation_code'], "CCSQ/", "post");
    $uniq = uniqid();

    $tb .= "<div id='getTable'>
                            <table id='myTable' class='table table-bordered'>
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
                                            <input  type='text' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                    </tr>
                                </tbody>

                            </table>

                        </div>";



    $ResponseXML .= "<id2><![CDATA[$post]]></id2>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

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
        $des = str_replace("7k7f7d8j8u8", "#", $des);
        $des = str_replace("7k7f788j8u8", "&", $des);
        $des = str_replace("7k7g788j8u8", "+", $des);




        $sql = "Insert into quotation_table_temp(Quotation_NO,Location,Item_Name,Description,Qty,Unit_Price,uniq,tbl_remark)values 
     ('" . $_GET['Quotation_NO'] . "','" . $_GET['Location'] . "','" . $_GET['Item_Name'] . "','" . $des . "','" . $_GET['QTY'] . "','" . $_GET['Unit_Price'] . "','" . $_GET['uniq'] . "','" . $_GET['tbl_remark'] . "')";

        $result = $conn->query($sql);
    }
    $uniq = $_GET['uniq'];

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>Heading 1</th>
                                        <th style='width: 15%;'>Heading 2</th>
                                        <th style='width: 30%;'>Heading 3</th>
                                        <th style='width: 15%;'>Remark</th>
                                        <th style='width: 10%;'>Qty</th>
                                        <th style='width: 15%;'>Unit Price</th>
                                        <th style='width: 5%;'>Add or Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>          
                                             <textarea rows='3'  cols='25' placeholder='Location' id='Location' class='form-control input-sm'>" . $_GET['Location'] . "</textarea>
                                        </td>
                                         <td>
                                            <textarea rows='3' cols='25' id='Item_Name'  class='form-control input-sm'>" . $_GET['Item_Name'] . "</textarea>
                                        </td>
                                         <td> 
                                            <textarea rows='3' cols='55' placeholder='Description' id='Description'  class='form-control input-sm'>" . $des . "</textarea>
                                        </td>
                                         <td> 
                                            <textarea rows='3' cols='55' placeholder='remark' id='tbl_remark'  class='form-control input-sm'>" . $_GET['tbl_remark'] . "</textarea>
                                            
                                        </td>
                                         <td>
                                            <input type='text' placeholder='Qty' id='Qty' class='form-control input-sm'>
                                        </td>
                                         <td>
                                            <input type='text'  onkeyup='taxCal(event);' placeholder='Unit Price' id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'><span class='fa fa-plus'></span> &nbsp; </a></td>
                                    </tr>";



    $sql1 = "SELECT * FROM quotation_table_temp WHERE Quotation_NO = '" . $_GET['Quotation_NO'] . "' and uniq = '" . $_GET['uniq'] . "'";

    $tot = 0;

    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Location'] . "</td><td>" . $row2['Item_Name'] . "</td><td>" . $row2['Description'] . "</td><td>" . $row2['tbl_remark'] . "</td><td>" . $row2['Qty'] . "</td><td>" . $row2['Unit_Price'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";

        $temp1 = $row2['Qty'] * $row2['Unit_Price'];

        $tot = $temp1 + $tot;
    }

//    $sql1 = "SELECT * FROM quotation_table WHERE Quotation_NO = '" . $_GET['Quotation_NO'] . "'";
//
//
//
//    foreach ($conn->query($sql1) as $row2) {
//
//        $ResponseXML .= "<tr><td>" . $row2['Location'] . "</td><td>" . $row2['Item_Name'] . "</td><td>" . $row2['Description'] . "</td><td>" . $row2['Qty'] . "</td><td>" . $row2['Unit_Price'] . "</td><td></td></tr>";
//
//        $temp1 = $row2['Qty'] * $row2['Unit_Price'];
//
//        $tot = $temp1 + $tot;
//    }

    if ($_GET['svat'] == 1) {
        if ($_GET['nbt'] == 1) {
            $totout = cal($tot);


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Total</td><td></td><td>$totout</td><td></td></tr>";

            // cal nbt 
            $nbt = $tot / 100;
            $nbt = $nbt * 2;
            $nbtout = cal($nbt);
            $nbtAndTot = $nbt + $tot;
            $nbtAndTotout = cal($nbtAndTot);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>NBT (2%)</td><td></td><td>$nbtout</td><td></td></tr>";
            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'></td><td></td><td>$nbtAndTotout</td><td></td></tr>";

            $vat = $nbtAndTot / 100;
            $vat = $vat * 15;
            $vatout = cal($vat);

//    $vat = $nbtAndTot + $vat;
            //$vatout = cal();


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>VAT (15%)</td><td></td><td>$vat</td><td></td></tr>";

            $value = $vat + $nbtAndTot;
            $value = cal($value);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Value</td><td></td><td>$value</td><td></td></tr>";
        } else {
            $totout = cal($tot);


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Total</td><td></td><td>$totout</td><td></td></tr>";

            // cal nbt 
            $nbt = $tot / 100;
            $nbt = $nbt * 2;
            $nbtout = cal($nbt);
            $nbtAndTot = $nbt + $tot;
            $nbtAndTotout = cal($nbtAndTot);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>NBT (2%)</td><td></td><td>$nbtout</td><td></td></tr>";
            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'></td><td></td><td>$nbtAndTotout</td><td></td></tr>";

            $vat = $nbtAndTot / 100;
            $vat = $vat * 15;
            $vatout = cal($vat);

//    $vat = $nbtAndTot + $vat;
            //$vatout = cal();


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>VAT (15%)</td><td></td><td>$vat</td><td></td></tr>";

            $value = $vat + $nbtAndTot;
            $value = cal($value);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Value</td><td></td><td>$value</td><td></td></tr>";
        }
    }

    if ($_GET['vat'] == 1) {
        if ($_GET['nbt'] == 1) {
            $totout = cal($tot);


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Total</td><td></td><td>$totout</td><td></td></tr>";

            // cal nbt 
            $nbt = $tot / 100;
            $nbt = $nbt * 2;
            $nbtout = cal($nbt);
            $nbtAndTot = $nbt + $tot;
            $nbtAndTotout = cal($nbtAndTot);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>NBT (2%)</td><td></td><td>$nbtout</td><td></td></tr>";
            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'></td><td></td><td>$nbtAndTotout</td><td></td></tr>";

            $vat = $nbtAndTot / 100;
            $vat = $vat * 15;
            $vatout = cal($vat);

//    $vat = $nbtAndTot + $vat;
            //$vatout = cal();


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>VAT (15%)</td><td></td><td>$vat</td><td></td></tr>";

            $value = $vat + $nbtAndTot;
            $value = cal($value);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Value</td><td></td><td>$value</td><td></td></tr>";
        } else {
            $totout = cal($tot);


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Total</td><td></td><td>$totout</td><td></td></tr>";

            // cal nbt 
            $nbt = $tot / 100;
            $nbt = $nbt * 2;
            $nbtout = cal($nbt);
            $nbtAndTot = $nbt + $tot;
            $nbtAndTotout = cal($nbtAndTot);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>NBT (2%)</td><td></td><td>$nbtout</td><td></td></tr>";
            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'></td><td></td><td>$nbtAndTotout</td><td></td></tr>";

            $vat = $nbtAndTot / 100;
            $vat = $vat * 15;
            $vatout = cal($vat);

//    $vat = $nbtAndTot + $vat;
            //$vatout = cal();


            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>VAT (15%)</td><td></td><td>$vat</td><td></td></tr>";

            $value = $vat + $nbtAndTot;
            $value = cal($value);

            $ResponseXML .= "<tr><td colspan='4' style='text-align: right;'>Value</td><td></td><td>$value</td><td></td></tr>";
        }
    }




    $ResponseXML .= "</tbody></table>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}


if ($_GET["Command"] == "removerow") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    $sql = "delete from quotation_table_temp where id = '" . $_GET['id'] . "'";

    $result = $conn->query($sql);


    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>Heading 1</th>
                                        <th style='width: 15%;'>Heading 2</th>
                                        <th style='width: 30%;'>Heading 3</th>
                                        <th style='width: 15%;'>Remark</th>
                                        <th style='width: 10%;'>Qty</th>
                                        <th style='width: 15%;'>Unit Price</th>
                                        <th style='width: 5%;'>Add or Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>          
                                             <textarea rows='3'  cols='25' placeholder='Location' id='Location'  class='form-control input-sm'></textarea>
                                        </td>
                                         <td>
                                            <textarea rows='3' cols='25' id='Item_Name'  class='form-control input-sm'></textarea>
                                        </td>
                                         <td> 
                                            <textarea rows='3' cols='55' placeholder='Description' id='Description'  class='form-control input-sm'></textarea>
                                        </td>
                                         <td> 
                                            <textarea rows='3' cols='55' placeholder='remark' id='tbl_remark'  class='form-control input-sm'></textarea>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Qty' id='Qty' class='form-control input-sm'>
                                        </td>
                                         <td>
                                            <input type='text' placeholder='Unit Price' id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'><span class='fa fa-plus'></span> &nbsp; </a></td>
                                    </tr>";




    $sql1 = "SELECT * FROM quotation_table_temp WHERE Quotation_NO = '" . $_GET['Quotation_NO'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Location'] . "</td><td>" . $row2['Item_Name'] . "</td><td>" . $row2['Description'] . "</td><td>" . $row2['tbl_remark'] . "</td><td>" . $row2['Qty'] . "</td><td>" . $row2['Unit_Price'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . "," . $_GET['uniq'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $ResponseXML .= "</tbody></table>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}


if ($_GET["Command"] == "email") {
    date_default_timezone_set('Asia/Colombo');

    require './PHPMailer-master/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'mail.infodatasl.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "autoemail@infodatasl.com";
    $mail->Password = "autoemail@123";

    $sql = "select * from quotation";
//    $result = $conn->query($sql);
    foreach ($conn->query($sql) as $row) {

        $remail = "suhad.a.mendis@gmail.com";

        $mail->setFrom('autoemail@infodatasl.com', 'School');
        $mail->addAddress($remail, 'hhh');
    }

    $table = "";

    $table .= "<table style = 'width: 660px;' class = 'table1'>
                    <tr>
                    <th class = 'bottom head' colspan = '3'><center>Dear Student, Your Final Examinations and Online Examinations has been posephoned to 30th July.</center></th>
                    </tr>

                    <tr>
                    <th class = 'bottom head' colspan = '3'><center>Examination Department</center></th>
                    </tr>
                    </table>";

    $mail->Body = '"' . $table . '"';
    $mail->Subject = 'Student Mail';
    $mail->isHTML(true);

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    echo "Sucess";
}

function cal($val) {
    return number_format($val, 2, ".", ",");
//    $backfront = explode(".", $val);
//    if ($backfront[1] == NULL) {
//        return $backfront[0] . ".00";
//    } else {
//        return $backfront[0] . "." . substr($backfront[1], 0, 4);
//    }
}
