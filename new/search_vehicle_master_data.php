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


    $sql = "Select * from vehicles where vref ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['vref'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['vehicleno'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['vehicletype'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['nameofuser'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['fuellimit_ltrs'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['fuellimit_rupees'] . "]]></str_customername5>";
        $ResponseXML .= "<str_customername6><![CDATA[" . $row['remarks'] . "]]></str_customername6>";
    }
        $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>V Ref No.</th>
                    <th>Vehicle No.</th>
                    <th>Vehicle Type</th>
                </tr>";


    $sql = "Select * from vehicles where vref<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and vref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and vehicleno like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and vehicletype like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY vref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['vref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['vref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['vehicleno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['vehicletype'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
