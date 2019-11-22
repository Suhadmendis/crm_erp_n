<?php

session_start();

include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {
    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];


    $sql = "Select * from adjustments_addition_deduction where reference_no ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['addition'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['deduction'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['date'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['manual_no'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['remarks'] . "]]></str_customername5>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "updateTable") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $rows = "";



    $sql = "SELECT * FROM adjustments_addition_deduction_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
    $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 10%;'>Product Code</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty On Hand</th>
                                        <th style='width: 10%;'>Quantity</th>
                                        <th style='width: 10%;'>Rate</th>
                                        <th style='width: 10%;'>Reason</th>
                                        <th style='width: 12%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                         <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code' id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty On Hand'  id='qty_on_hand' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Rate'  id='rate' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Reason'  id='reason' class='form-control input-sm'>
                                        </td>                                                      
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM adjustments_addition_deduction_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

               $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_Des'] . "</td><td>" . $row2['qty_on_hand'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['rate'] ."</td><td>" . $row2['reason'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
//             $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows .= "   </table>";
    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}






if ($_GET["Command"] == "search_custom") {

    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>Manuel GRN Ref</th>
                    <th>Name</th>
                    <th>Date</th>
                </tr>";


    $sql = "Select * from adjustments_addition_deduction where reference_no<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and date like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY reference_no limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['reference_no'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>


