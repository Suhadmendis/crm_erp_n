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


    $sql = "Select * from advancedreq_fuel where arf_no ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['arf_no'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['reqdate'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['dep'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['reqby'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['amount_w'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['ex_settle'] . "]]></str_customername5>";
        $ResponseXML .= "<str_customername6><![CDATA[" . $row['t_amount'] . "]]></str_customername6>";
        $ResponseXML .= "<str_customername7><![CDATA[" . $row['c_favor'] . "]]></str_customername7>";
        $ResponseXML .= "<str_customername8><![CDATA[" . $row['customer_code'] . "]]></str_customername8>";
        $ResponseXML .= "<str_customername9><![CDATA[" . $row['customer_name'] . "]]></str_customername9>";
        $ResponseXML .= "<str_customername10><![CDATA[" . $row['jobnos'] . "]]></str_customername10>";

        if (stname === arftemp) {
            $ResponseXML .= "<str_customername_i><![CDATA[" . $row['reqdate'] . "]]></str_customername_i>";
            $ResponseXML .= "<str_customername_ii><![CDATA[" . $row['dep'] . "]]></str_customername_ii>";
            $ResponseXML .= "<str_customername_iii><![CDATA[" . $row['reqby'] . "]]></str_customername_iii>";
            $ResponseXML .= "<str_customername_iv><![CDATA[" . $row['amount_w'] . "]]></str_customername_iv>";
            $ResponseXML .= "<str_customername_v><![CDATA[" . $row['ex_settle'] . "]]></str_customername_v>";
            $ResponseXML .= "<str_customername_vi><![CDATA[" . $row['t_amount'] . "]]></str_customername_vi>";
            $ResponseXML .= "<str_customername_vii><![CDATA[" . $row['c_favor'] . "]]></str_customername_vii>";
            $ResponseXML .= "<str_customername_viii><![CDATA[" . $row['customer_code'] . "]]></str_customername_viii>";
        }
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                     <th>ARF No.</th>
                    <th>Requested Date</th>
                    <th>Department</th>
 
                </tr>";


    $sql = "Select * from advancedreq_fuel where arf_no<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and arf_no like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and reqdate like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and dep like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY arf_no limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['arf_no'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['arf_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reqdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['dep'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
