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


    $sql = "Select * from vehiclemilage where vmref ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['vmref'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['vehicle'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['month'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['opening'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['closing'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['mileage'] . "]]></str_customername5>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>VM Ref</th>
                    <th>Vehicle</th>
                    <th>Month</th>
                </tr>";


    $sql = "Select * from vehiclemilage where vmref<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and vmref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and vehicle like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and month like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY vmref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['vmref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['vmref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['vehicle'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['month'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
