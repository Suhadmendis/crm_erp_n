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


    $sql = "Select * from s_mas where STK_NO ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['STK_NO'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['DESCRIPT'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['UOM'] . "]]></str_customername2>";
        $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";
        // $ResponseXML .= "<str_customername3><![CDATA[" . $row['group1'] . "]]></str_customername3>";
        // $ResponseXML .= "<str_customername4><![CDATA[" . $row['grp_type'] . "]]></str_customername4>";
        // $ResponseXML .= "<str_customername5><![CDATA[" . $row['prod_length'] . "]]></str_customername5>";
        // $ResponseXML .= "<str_customername6><![CDATA[" . $row['prod_width'] . "]]></str_customername6>";
        // $ResponseXML .= "<str_customername7><![CDATA[" . $row['prod_height'] . "]]></str_customername7>";
        // $ResponseXML .= "<str_customername8><![CDATA[" . $row['w_inches'] . "]]></str_customername8>";
        // $ResponseXML .= "<str_customername9><![CDATA[" . $row['sqf'] . "]]></str_customername9>";
        // $ResponseXML .= "<str_customername10><![CDATA[" . $row['status'] . "]]></str_customername10>";

        $ResponseXML .= "<LC_1><![CDATA[" . $row['LC_1'] . "]]></LC_1>";
        $ResponseXML .= "<LC_2><![CDATA[" . $row['LC_2'] . "]]></LC_2>";
        $ResponseXML .= "<LC_3><![CDATA[" . $row['LC_3'] . "]]></LC_3>";
        $ResponseXML .= "<LC_4><![CDATA[" . $row['LC_4'] . "]]></LC_4>";


        $sqlcode = "SELECT C_NAME FROM lcodes where C_CODE = '" . $row['LC_1'] . "'";
        $resultcode = $conn->query($sqlcode);
        $rowcode = $resultcode->fetch();
        $ResponseXML .= "<LN_1><![CDATA[" . $rowcode['C_NAME'] . "]]></LN_1>";

        $sqlcode = "SELECT C_NAME FROM lcodes where C_CODE = '" . $row['LC_2'] . "'";
        $resultcode = $conn->query($sqlcode);
        $rowcode = $resultcode->fetch();
        $ResponseXML .= "<LN_2><![CDATA[" . $rowcode['C_NAME'] . "]]></LN_2>";

         $sqlcode = "SELECT C_NAME FROM lcodes where C_CODE = '" . $row['LC_3'] . "'";
        $resultcode = $conn->query($sqlcode);
        $rowcode = $resultcode->fetch();
        $ResponseXML .= "<LN_3><![CDATA[" . $rowcode['C_NAME'] . "]]></LN_3>";

         $sqlcode = "SELECT C_NAME FROM lcodes where C_CODE = '" . $row['LC_4'] . "'";
        $resultcode = $conn->query($sqlcode);
        $rowcode = $resultcode->fetch();
        $ResponseXML .= "<LN_4><![CDATA[" . $rowcode['C_NAME'] . "]]></LN_4>";
       
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>Ref No.</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>";


    $sql = "Select * from pproduct_master where prod_ref<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and prod_ref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and prod_name like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and prod_uom like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY prod_ref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['prod_ref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode');\">" . $row['prod_ref'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['prod_name'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['prod_uom'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
