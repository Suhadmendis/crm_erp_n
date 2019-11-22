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


    $sql = "Select * from sampledeliverynote where sampletransnote ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['sampletransnote'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['aod'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['deliverydate'] . "]]></str_customername3>";
        
       
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>Sample Job Transfer no.</th>
                    <th>Date</th>
                    <th>Customer</th>
                </tr>";


    $sql = "Select * from sampledeliverynote where sampletransnote<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and sampletransnote like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and aod like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and customer like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY sampletransnote limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['sampletransnote'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sampletransnote'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['aod'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
