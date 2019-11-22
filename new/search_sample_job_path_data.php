<?php

session_start();



include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $stname = $_GET["stname"];
    $ResponseXML = "";
    $ResponseXML .= "<new>";

    if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from samplejobreqnote where reference_no ='" . $cuscode . "'";
        $sql = $conn->query($sql);




        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['jobreqdate'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer_ref'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['mkex'] . "]]></str_customername3>";

            $code = $row['customer_ref'];
            $sqll = "select * from vendor where CODE = '" . $code . "'";
            $result = $conn->query($sqll);
            $row = $result->fetch();
            $no = $row['NAME'];

            $ResponseXML .= "<customer_name><![CDATA[$no]]></customer_name>";
        }
    } else if ($stname == "SAMPLE_JOB_ORDER") {


        $cuscode = $_GET["custno"];
        $sql = "Select * from samplejoborder where reference_no ='" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['sjbref'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['jodate'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['mkex'] . "]]></str_customername4>";
            $ResponseXML .= "<stnme><![CDATA[" . $_GET['stnme'] . "]]></stnme>";
        }
    } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from samplejobmatirealissue where reference_no ='" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {

            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['mrnref'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['issueddate'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['minref'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['manualref'] . "]]></str_customername4>";
            $ResponseXML .= "<str_customername5><![CDATA[" . $row['remarks'] . "]]></str_customername5>";
        }
    } else if ($stname == "SAMPLE_JOB_TRANSFER") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from samplejobtransfer where reference_no ='" . $cuscode . "'";
        $sql = $conn->query($sql);

        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['sjtdate'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
        }
    } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from sampledeliverynote where reference_no ='" . $cuscode . "'";

        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['aod'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['deliverydate'] . "]]></str_customername3>";
        }
    } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {


        $cuscode = $_GET["custno"];
        $sql = "Select * from samplejobmatreq where reference_no ='" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['sjbdate'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['sjbmrnref'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['manualref'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['remark'] . "]]></str_customername4>";
        }
    }

    $ResponseXML .= "<stname><![CDATA[$stname]]></stname>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "updateTable") {


    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $stname = $_GET["stname"];
    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $rows = "";

    if ($stname == "SAMPLE_JOB_TRANSFER") {

        $sql = "SELECT * FROM samplejobtransfer_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>SJB No</th>
                                    <th style='width: 10%;'>SJB Qty</th>
                                    <th style='width: 10%;'>Transfer Qty</th>
                                    <th style='width: 10%;'>Balance</th>
                                    <th style='width: 10%;'>Customer</th>
                                    <th style='width: 10%;'>Tick</th>
                                    <th style='width: 10%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       <td>
                                        <input type='text' placeholder='SJB No' id='sjbno' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='SJB Qty'  id='sjbqty' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Transfer Qty'  id='transferqty' class='form-control input-sm'>
                                    </td>
                                    
                                    <td>
                                        <input type='text' placeholder='Balance' id='balance' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Customer'  id='customer' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Tick'  id='tick' class='form-control input-sm'>
                                    </td>
                                       
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";

        $sql1 = "SELECT * FROM samplejobtransfer_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['sjbqty'] . "</td><td>" . $row2['transferqty'] . "</td><td>" . $row2['balance'] . "</td><td>" . $row2['customer'] . "</td><td>" . $row2['tick'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "SAMPLE_JOB_ORDER") {

        $sql = "SELECT * FROM samplejoborder_table WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>Item No</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample QTY</th>
                                    <th style='width: 15%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                      <td>
                                            <input type='text' placeholder='Item No.' id='Item_No' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='Sample_Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Sample QTY'  id='Sample_Qty' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";

        $sql1 = "SELECT * FROM samplejoborder_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['Item_No'] . "</td><td>" . $row2['Sample_Description'] . "</td><td>" . $row2['Sample_Qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }
        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

        $sql = "SELECT * FROM sjobmissue_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>Item Code</th>
                                    <th style='width: 10%;'>Material Name</th>
                                    <th style='width: 10%;'>Required Qty</th>
                                    <th style='width: 10%;'>Ex. Stock</th>
                                    <th style='width: 10%;'>Issue Qty</th>
                                    <th style='width: 10%;'>Balance to be issued</th>
                                    <th style='width: 10%;'>UOM</th>
                                    <th style='width: 10%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       <td>
                                        <input type='text' placeholder='Item Code' id='itemcode' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Material Name'  id='materialname' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Required Qty'  id='requiredqty' class='form-control input-sm'>
                                    </td>
                                    
                                    <td>
                                        <input type='text' placeholder='Ex. Stock' id='exstock' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Issue Qty'  id='issueqty' class='form-control input-sm'>
                                    </td>
                                                                        
                                    <td>
                                        <input type='text' placeholder='Balance to be issued' id='balance_issued' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                    </td>

                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";

        $sql1 = "SELECT * FROM sjobmissue_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['exstock'] . "</td><td>" . $row2['issueqty'] . "</td><td>" . $row2['balance_issued'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

        $sql = "SELECT * FROM samplejobreqnote_table WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>Item No</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <td>
                                            <input type='text' placeholder='Item No.' id='Item_No' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='Sample_Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Sample QTY'  id='Sample_Qty' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM samplejobreqnote_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['Item_No'] . "</td><td>" . $row2['Sample_Description'] . "</td><td>" . $row2['Sample_Qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") {

        $sql = "SELECT * FROM sampledeliverynote_table WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>SJB No.</th>
                                    <th style='width: 10%;'>Item Name</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Remarks</th>
                                    <th style='width: 10%;'>Add/Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <td>
                                            <input type='text' placeholder='SJB No.' id='sjbno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Item Name'  id='itemname' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='QTY'  id='qty' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks' class='form-control input-sm'>
                                        </td>                                      
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM sampledeliverynote_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['itemname'] . "</td><td>" . $row2['qty'] . "</td><td>" . $row2['remarks'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

        $sql = "SELECT * FROM sjobmatreq_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";

        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                     <th style='width: 15%;'>Item Code</th>
                                     <th style='width: 15%;'>Material Name</th>
                                     <th style='width: 15%;'>Required Qty</th>
                                     <th style='width: 15%;'>UOM</th>
                                     <th style='width: 15%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                     <td>
                                    <input type='text' placeholder='Item Code' id='itemcode' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input type='text' placeholder='Material Name'  id='materialname' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='Required Qty'  id='requiredqty' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                </td>
                                <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";

        $sql1 = "SELECT * FROM sjobmatreq_tbl WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }
        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    }
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}



if ($_GET["Command"] == "search_custom") {

    $stname = $_GET["stname"];
    $ResponseXML = "";

    if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>SJ Request Ref</th>
                    <th>SJ Request Date</th>
                    <th>Customer Ref</th>
                </tr>";
        $sql = "Select * from samplejobreqnote where reference_no<> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and jobreqdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and customer_ref like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['jrid'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobreqdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer_ref'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "SAMPLE_JOB_ORDER") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                 <th>SJ Request No</th>
                    <th>SJB Ref</th>
                    <th>Customer</th> 
                </tr>";

        $sql = "Select * from samplejoborder where reference_no <> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and  sjbref like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and customer like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= "ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                              
                            </tr>";
        }
    } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                 <th>SJB NO.</th>
                    <th>SJB MRN Ref</th>
                    <th>Date</th>
                </tr>";

        $sql = "Select * from samplejobmatirealissue where reference_no <> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and  mrnref like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and issueddate like '%" . $_GET['customername2'] . "%'";
        }

        $sql .= "ORDER BY reference_no limit 50 ";

        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['inkref'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['mrnref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['issueddate'] . "</a></td>
                              
                            </tr>";
        }
    } else if ($stname == "SAMPLE_JOB_TRANSFER") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>Sample Job Transfer no.</th>
                    <th>Date</th>
                    <th>Customer</th>
                </tr>";
        $sql = "Select * from samplejobtransfer where reference_no<> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and sjtdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and customer like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjtdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "SAMPLE_JOB_TRANSFER") {

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
    } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>SJB NO.</th>
                    <th>SJB MRN Ref</th>
                    <th>Date</th>
                </tr>";

        $sql = "Select * from samplejobmatreq where reference_no <> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and  sjbdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and sjbmrnref like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= "ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbmrnref'] . "</a></td>
                              
                            </tr>";
        }
    }
    $ResponseXML .= "   </table>";
    echo $ResponseXML;
}
?>
