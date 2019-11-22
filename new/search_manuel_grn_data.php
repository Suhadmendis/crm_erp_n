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


    $sql = "Select * from manuel_grn where manuel_grn_ref ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['manuel_grn_ref'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['name'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['date'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['address'] . "]]></str_customername3>";
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



    $sql = "SELECT * FROM manuel_grn_table WHERE manuel_grn_ref = '" . $_GET['reference_no'] . "'";
    $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                         <th style='width: 20%;'>AOD NO.</th>
                                        <th style='width: 20%;'>NO</th>
                                        <th style='width: 50%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty</th>
                                        <th style='width: 10%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                         <td>
                                            <input type='text' placeholder='AOD NO.' id='aod_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='NO'  id='no_text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                        </td>                                                                   
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM manuel_grn_table WHERE manuel_grn_ref = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

             $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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


    $sql = "Select * from manuel_grn where manuel_grn_ref<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and manuel_grn_ref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and name like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and date like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY manuel_grn_ref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['manuel_grn_ref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manuel_grn_ref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['name'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
