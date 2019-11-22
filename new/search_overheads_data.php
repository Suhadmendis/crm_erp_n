<?php

session_start();



include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $stname = $_GET["stname"];
    $ResponseXML = "";
    $ResponseXML .= "<new>";

    if ($stname == "lab") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from labour_mas where STK_NO =  '" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['STK_NO'];
        $des = $row['DESCRIPT'];

        $ResponseXML .= "<id><![CDATA[$no]]></id>";
        $ResponseXML .= "<des><![CDATA[$des]]></des>";
    } else if ($stname == "foh") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from foh_mas where STK_NO =  '" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['STK_NO'];
        $des = $row['DESCRIPT'];

        $ResponseXML .= "<id><![CDATA[$no]]></id>";
        $ResponseXML .= "<des><![CDATA[$des]]></des>";
    } else if ($stname == "var_o_h") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from voh_mas where STK_NO =  '" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['STK_NO'];
        $des = $row['DESCRIPT'];

        $ResponseXML .= "<id><![CDATA[$no]]></id>";
        $ResponseXML .= "<des><![CDATA[$des]]></des>";
    }




    $ResponseXML .= "<stname><![CDATA[$stname]]></stname>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "search_custom") {

    $stname = $_GET["stname"];
    $ResponseXML = "";
    if ($stname == "POED") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                  <th>Reference No</th>
                    <th>manual No</th>
                    <th>Job No</th>
                </tr>";
        $sql = "Select * from purchase_order_entry_dummy where reference_no<> ''";
        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['job_no'] != "") {
            $sql .= " and job_no like '%" . $_GET['job_no'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['job_no'] . "</a></td>                           
                            </tr>";
        }
    } else if ($stname == "PORN") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Manual No</th>
                    <th>Remarks</th>
                </tr>";
        $sql = "Select * from po_requisition_note_dummy where reference_no<> ''";
        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['dateText'] != "") {
            $sql .= " and date like '%" . $_GET['dateText'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['remarks'] . "</a></td>                           
                            </tr>";
        }
    } else if ($stname == "SIVE") {


        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Currency Code</th>
                    <th>Manual No</th>
                    <th>Date</th>
                </tr>";

        $sql = "Select * from service_invoice where reference_no<> ''";

        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['currency_code'] != "") {
            $sql .= " and currency_code like '%" . $_GET['currency_code'] . "%'";
        }

        $sql .= " ORDER BY reference_no limit 50 ";

        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['currency_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                            </tr>";
        }
    } else if ($stname == "GRN") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                   <th>Reference No</th>
                    <th>Date</th>
                    <th>Currency Code</th>
                    <th>Manual Ref No</th>
                    <th>Exchange Rate</th>
                </tr>";

        $sql = "Select * from good_received_note_entry where reference_no<> ''";

        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['dateText'] != "") {
            $sql .= " and date like '%" . $_GET['dateText'] . "%'";
        }

        $sql .= " ORDER BY reference_no limit 50 ";

        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_ref_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['currency_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['exchange_rate'] . "</a></td>

                              
                            </tr>";
        }
    } else if ($stname == "PRNTR") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference NO</th>
                    <th>Manual No</th>
                    <th>Remarks</th>    
                </tr>";
        $sql = "Select * from po_requistion_note where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and remarks like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['remarks'] . "</a></td>
                               
                            </tr>";
        }
    } else if ($stname == "POSER") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Manual No</th>
                    <th>po Requisition</th>
                    
                </tr>";
        $sql = "Select * from purchase_order_entry where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and po_requisition like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['po_requisition'] . "</a></td>
                               
                            </tr>";
        }
    } else if ($stname == "SUBCONTRACTOR") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>Reference No.</th>
                    <th>Date.</th>
                    <th>SC PO No.</th>
                </tr>";
        $sql = "Select * from subcontractordtls where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and scdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and scpono like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " and cancel = '0' ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scpono'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "PAYMENTVOUCHER") {
        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                  <th>Ref No.</th>
                  <th>Date.</th>
                  <th>Currency Code</th>
                </tr>";
        $sql = "Select * from paymentvoucher where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and pvdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and currencycode like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['pvdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['currencycode'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "GRNNOTE") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Manual No</th>
                    <th>Date</th>   
                </tr>";
        $sql = "Select * from good_return_note_entry where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and date like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>                             
                            </tr>";
        }
    } else if ($stname == "GRNRECEIVED") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Purchase Order No</th>        
                </tr>";
        $sql = "Select * from good_received_note_entry where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and date like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and purchase_order_no like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['purchase_order_no'] . "</a></td>                              
                            </tr>";
        }
    }
    $ResponseXML .= "   </table>";
    echo $ResponseXML;
}
?>
