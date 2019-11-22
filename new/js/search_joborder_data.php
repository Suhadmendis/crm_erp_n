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

    $sql = "Select * from joborder where jid ='" . $cuscode . "' and Cancel='0'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['jid'] . "]]></id>";

        $ResponseXML .= "<str_customername1><![CDATA[" . $row['joborderref'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['jobdate'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['QuotationRef'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['CostingRef'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['JobRequestRef'] . "]]></str_customername5>";
        $ResponseXML .= "<str_customername6><![CDATA[" . $row['ManualRef'] . "]]></str_customername6>";
        $ResponseXML .= "<str_customername7><![CDATA[" . $row['Customer'] . "]]></str_customername7>";
        $ResponseXML .= "<str_customername8><![CDATA[" . $row['jobnew'] . "]]></str_customername8>";
        $ResponseXML .= "<str_customername9><![CDATA[" . $row['jrepeat'] . "]]></str_customername9>";
        $ResponseXML .= "<str_customername10><![CDATA[" . $row['MarketingEx'] . "]]></str_customername10>";
        $ResponseXML .= "<str_customername11><![CDATA[" . $row['RepeatPreviousJBNRef'] . "]]></str_customername11>";
        $ResponseXML .= "<str_customername12><![CDATA[" . $row['ProductDescription'] . "]]></str_customername12>";
        $ResponseXML .= "<str_customername13><![CDATA[" . $row['Instructions'] . "]]></str_customername13>";
        $ResponseXML .= "<str_customername14><![CDATA[" . $row['CustomerPONo'] . "]]></str_customername14>";
        $ResponseXML .= "<str_customername15><![CDATA[" . $row['JobQty'] . "]]></str_customername15>";
        $ResponseXML .= "<str_customername16><![CDATA[" . $row['Location'] . "]]></str_customername16>";
        $ResponseXML .= "<str_customername17><![CDATA[" . $row['SalesPrice'] . "]]></str_customername17>";
        $ResponseXML .= "<str_customername18><![CDATA[" . $row['TotalValue'] . "]]></str_customername18>";
        $ResponseXML .= "<str_customername19><![CDATA[" . $row['joblength'] . "]]></str_customername19>";
        $ResponseXML .= "<str_customername20><![CDATA[" . $row['jobwidth'] . "]]></str_customername20>";
        $ResponseXML .= "<str_customername21><![CDATA[" . $row['NoofColors'] . "]]></str_customername21>";
        $ResponseXML .= "<str_customername22><![CDATA[" . $row['NoofImp'] . "]]></str_customername22>";
       
    }



       




    $sql = "Select * from s_mas_details where costing_no ='" . $row['CostingRef'] . "'";

    $mattable = "<table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($conn->query($sql) as $mtable) {
        $mattable .= "<tr>
                <td>" . $mtable['item_no'] . "</td>
                <td>" . $mtable['s_descrip'] . "</td>
                <td>" . $mtable['qty'] . "</td>
            </tr>";
    }




    $mattable .= "</tbody>
            </table>";


    $sql = "Select * from var_oh_details where costing_no ='" . $row['CostingRef'] . "' and type ='d'";


    $mattable .= "<br>";


    $mattable .= "<table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Labour</th>
                        <th>No. of Hours</th>
                        
                    </tr>
                </thead>
                <tbody>";

    foreach ($conn->query($sql) as $ltable) {
        $mattable .= "<tr>
                <td>" . $ltable['s_descrip'] . "</td>
                <td>" . $ltable['value_1'] . "</td>
            </tr>";
    }

    $mattable .= "</tbody>
            </table>";

    $ResponseXML .= "<mattable><![CDATA[" . $mattable . "]]></mattable>";
    

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";




    $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                <th>Job Code</th>
                <th>Job Order Ref</th>
                <th>Date</th>
                </tr>";

    $sql = "Select * from joborder where jid <> ''";


    if ($_GET['cusno'] != "") {
        $sql .= " and jid like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and joborderref like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and jobdate like '%" . $_GET['customername2'] . "%'";
    }


    $sql .= " and Cancel = '0' ORDER BY jid limit 50 ";
    //$sql .= " ORDER BY CourseCode limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['jid'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr>    
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jid'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['joborderref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobdate'] . "</a></td>
                           
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
