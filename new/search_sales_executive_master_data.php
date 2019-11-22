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


    $sql = "Select * from sales_exe_master where se_ref ='" . $cuscode . "'";
   // echo $sql;


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['se_ref'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['nic'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['se_name'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['addr'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['mobile'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['email'] . "]]></str_customername5>";
        $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";
        
    }
    
  


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>SER No.</th>
                    <th>NIC No.</th>
                    <th>Sales Executive Name</th>
                    </tr>";


    $sql = "Select * from sales_exe_master where se_ref<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and se_ref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and nic like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and se_name like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY se_ref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['se_ref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['se_ref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['nic'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['se_name'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
