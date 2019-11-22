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

 $sqlno = "SELECT manuel_aod_code FROM inv_data";
        $result = $conn->query($sqlno);
        $row = $result->fetch();
        $no = $row['manuel_aod_code'];
        
        
        
       

        $sql = "Insert into manuel_aod(aod_number,Name,Address,ncp,tel,dod,nod,sono,type)values 
        ('" . $no . "','" . $_GET['inputText'] . "','" . $_GET['Address'] . "','" . $_GET['ncp'] . "','" . $_GET['tel'] . "','" . $_GET['Date_of_Despatch'] . "','" . $_GET['nod'] . "','" . $_GET['SO_No'] . "','" . $_GET['type'] . "')";
        $result = $conn->query($sql);

        $sql2 = "select * from manuel_aod_table_temp where aodnumber = '" . $_GET['aodnumber'] . "'  and uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {


            $sql = "Insert into manuel_aod_table(aodnumber,Customer_Order_number,Product_Des,QTY)values 
             ('" . $no . "','" . $row['Customer_Order_number'] . "','" . $row['Product_Des'] . "','" . $row['QTY'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {


            $sql = "DELETE FROM manuel_aod_table_temp WHERE aodnumber = '" . $row['aodnumber'] . "'  and uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }

        $aodn = $no;


        $sql = "SELECT manuel_aod_code FROM inv_data";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['manuel_aod_code'];
        $no2 = $no + 1;
        $sql = "update inv_data set manuel_aod_code = $no2 where manuel_aod_code = $no";
        $result = $conn->query($sql);

        
        $ty = "";
        if ($_GET['type']=="CUSTOMER") {
            $ty = "CUS";
        }else{
            $ty = "SUP";
        }
        
        
        
        $conn->commit();
        echo "Saved:$aodn:$ty";
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

    $sql = "SELECT manuel_aod_code FROM inv_data";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['manuel_aod_code'];
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

        $sql = "Insert into manuel_aod_table_temp(aodnumber,Customer_Order_number,Product_Des,QTY,uniq)values 
     ('" . $_GET['aodnumber'] . "','" . $_GET['Customer_Order_number'] . "','" . $_GET['Product_Des'] . "','" . $_GET['QTY'] . "','" . $_GET['uniq'] . "')";

        $result = $conn->query($sql);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
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
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM manuel_aod_table_temp WHERE aodnumber = '" . $_GET['aodnumber'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Customer_Order_number'] . "</td><td>" . $row2['Product_Des'] . "</td><td>" . $row2['QTY'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $ResponseXML .= "</tbody></table>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "removerow") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from manuel_aod_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);


    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
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
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM manuel_aod_table_temp WHERE aodnumber = '" . $_GET['aodnumber'] . "' and uniq = '" . $_GET['uniq'] . "'";

    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['Customer_Order_number'] . "</td><td>" . $row2['Product_Des'] . "</td><td>" . $row2['QTY'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $ResponseXML .= "</tbody></table>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}
