<?php

session_start();

include_once './connection_sql.php';


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

if ($_GET["Command"] == "pass_quot") {
    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];
    $stname = $_GET["stname"];


    $sql = "Select * from samplejobreqnote where jrid ='" . $cuscode . "'";
    $sql = $conn->query($sql);





    $sql1 = "SELECT * FROM samplejobreqnote_table WHERE jrid = '" . $cuscode . "'";

    $rows = "<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Item No.</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 20%;'>Sample Qty</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               ";


    foreach ($conn->query($sql1) as $row2) {

        $rows .= "<tr><td>" . $row2['itemno'] . "</td><td>" . $row2['des'] . "</td><td>" . $row2['qty'] . "</td></tr>";
    }


    $rows .= "</tbody>

                        </table>";


    $tableRows = $rows;


    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . generateId($row['jrid'], "SJR/", "post") . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['jobreqdate'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['mkex'] . "]]></str_customername3>";
        $ResponseXML .= "<stname><![CDATA[" . $stname . "]]></stname>";
        $ResponseXML .= "<rows><![CDATA[" . $tableRows . "]]></rows>";
    }


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";




    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>SJ Request Ref</th>
                    <th>SJ Request Date</th>
                    <th>Customer</th>
                </tr>";
//SELECT
//samplejobreqnote.jrid,
//samplejobreqnote.jobreqdate,
//samplejobreqnote.customer,
//samplejobreqnote.mkex,
//samplejobreqnote_table.des,
//samplejobreqnote_table.qty,
//samplejobreqnote.username
//FROM
//samplejobreqnote
//INNER JOIN samplejobreqnote_table ON samplejobreqnote.jrid = samplejobreqnote_table.jrid


    $sql = "SELECT samplejobreqnote.jrid,samplejobreqnote.jobreqdate,samplejobreqnote.customer,samplejobreqnote.mkex,samplejobreqnote_table.des,samplejobreqnote_table.qty,samplejobreqnote.username FROM samplejobreqnote INNER JOIN samplejobreqnote_table ON samplejobreqnote.jrid = samplejobreqnote_table.jrid ";

//    if ($_GET['cusno'] != "") {
//        $sql .= " and jrid like '%" . $_GET['cusno'] . "%'";
//    }
//    if ($_GET['customername1'] != "") {
//        $sql .= " and jobreqdate like '%" . $_GET['customername1'] . "%'";
//    }
//    if ($_GET['customername2'] != "") {
//        $sql .= " and customer like '%" . $_GET['customername2'] . "%'";
//    }
//    $sql .= " ORDER BY jrid limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['jrid'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jrid'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobreqdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}


if ($_GET["Command"] == "updateTable") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT * FROM samplejobreqnote_table WHERE jrid = '" . $_GET['jrid'] . "'";


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
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";


    foreach ($conn->query($sql1) as $row2) {

        $rows .= "<tr><td>sdfsdf</td><td>fsdfsf</td><td>fsdf</td><td></td></tr>";
    }


    $rows .= "</tbody>

                        </table>";



    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}
?>
