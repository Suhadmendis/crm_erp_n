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

        $ResponseXML .= "<str_customername1><![CDATA[" . $row['jid'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['jobdate'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['QuotationRef'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['CostingRef'] . "]]></str_customername4>";
                
                $sqlcosting_pro = "Select product_one from costing_details where ref_no = '" . $row['CostingRef'] . "'";
                $resultcosting_pro = $conn->query($sqlcosting_pro);
                $rowcosting_pro = $resultcosting_pro->fetch();

        $ResponseXML .= "<str_customername40><![CDATA[" . $rowcosting_pro['product_one'] . "]]></str_customername40>";

            $sqlcosting_pro_name = "SELECT DESCRIPT from s_rawmas where STK_NO = '" . $rowcosting_pro['product_one'] . "'";
                $resultcosting_pro_name = $conn->query($sqlcosting_pro_name);
                $rowcosting_pro_name = $resultcosting_pro_name->fetch();

        $ResponseXML .= "<str_customername400><![CDATA[" . $rowcosting_pro_name['DESCRIPT'] . "]]></str_customername400>";

        $ResponseXML .= "<str_customername5><![CDATA[" . $row['JobRequestRef'] . "]]></str_customername5>";
        $ResponseXML .= "<str_customername6><![CDATA[" . $row['ManualRef'] . "]]></str_customername6>";
        $ResponseXML .= "<str_customername7><![CDATA[" . $row['Customer'] . "]]></str_customername7>";

                $sqlCusName = "Select * from vendor where CODE = '" . $row['Customer'] . "'";
                $resultCusName = $conn->query($sqlCusName);
                $rowCusName = $resultCusName->fetch();
      
                // $ResponseXML .= "<CusName><![CDATA[" . $rowCusName['CusName'] . "]]></CusName>";

        $ResponseXML .= "<str_customername77><![CDATA[" . $rowCusName['NAME'] . "]]></str_customername77>";

        $ResponseXML .= "<str_customername8><![CDATA[" . $row['jobnew'] . "]]></str_customername8>";
        $ResponseXML .= "<str_customername9><![CDATA[" . $row['jrepeat'] . "]]></str_customername9>";
        $ResponseXML .= "<str_customername10><![CDATA[" . $row['MarketingEx'] . "]]></str_customername10>";
                
                $sqlmarkName = "Select * from sales_exe_master where se_ref = '" . $row['MarketingEx'] . "'";
                $resultmarkName = $conn->query($sqlmarkName);
                $rowmarkName = $resultmarkName->fetch();

        $ResponseXML .= "<str_customername110><![CDATA[" . $rowmarkName['se_name'] . "]]></str_customername110>";

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
        
        $ResponseXML .= "<str_customername150><![CDATA[" . $row['inkCode'] . "]]></str_customername150>";
        $ResponseXML .= "<str_customername151><![CDATA[" . $row['inkDes'] . "]]></str_customername151>";
        $ResponseXML .= "<str_customername152><![CDATA[" . $row['Ink_Was'] . "]]></str_customername152>";
        $ResponseXML .= "<str_customername153><![CDATA[" . $row['all_pro'] . "]]></str_customername153>";
        
        $ResponseXML .= "<str_customername154><![CDATA[" . $row['No_of_sides'] . "]]></str_customername154>";
        $ResponseXML .= "<str_customername155><![CDATA[" . $row['No_of_outs'] . "]]></str_customername155>";




            $sql_cust = "select ADD1 from vendor where CODE='" . $row['Customer'] . "'";
            $row_cust = $conn->query($sql_cust)->fetch();
            $CUST = $row_cust["ADD1"];
            $ResponseXML .= "<str_customername023><![CDATA[" . $CUST . "]]></str_customername023>";


    }



            if ($_GET['stname'] == "mrn_ink") {
                
                $sqlalocated = "Select SUM(QTY) as alocated from s_mrnmas join s_mrntrn ON s_mrnmas.REF_NO = s_mrntrn.REFNO where s_mrnmas.JOB_NO='$cuscode' and s_mrnmas.TYPE = 'MRNG' and s_mrntrn.LEDINDI = 'GINR'";
            
                $resultalocated = $conn->query($sqlalocated);
                $rowalocated = $resultalocated->fetch();
      
                $ResponseXML .= "<alocated><![CDATA[" . $rowalocated['alocated'] . "]]></alocated>";
            }   


    $sqldet = "Select * from costing_details where ref_no ='" . $row['CostingRef'] . "'";

    foreach ($conn->query($sqldet) as $de) {
        $ResponseXML .= "<productname><![CDATA[" . $de['description'] . "]]></productname>";
        $ResponseXML .= "<inkqty><![CDATA[" . $de['inkQty'] . "]]></inkqty>";
    }



    $sql = "Select * from joborder_mat_table_temp where jcode ='" . $row['jid'] . "'";

    $mattable = "<table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Total Allocated Qty without Wastage</th>
                    <th>Wastage Qty</th>
                    <th>Qty Allocation total for Production</th>
                    <th style='display:none;'></th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($conn->query($sql) as $mtable) {
        $mattable .= "<tr>
                <td>" . $mtable['item_code'] . "</td>
                <td>" . $mtable['item_name'] . "</td>
                <td>" . $mtable['tot_qty'] . "</td>
                <td>" . $mtable['was_qty'] . "</td>
                <td>" . $mtable['qty'] . "</td>

            </tr>";
    }




    $mattable .= "</tbody>
            </table>";


    $sql = "Select * from joborder_lab_table_temp where jcode ='" . $row['jid'] . "'";


    $mattable .= "<br>";


    $mattable .= "<table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                    <th>Item Code</th>
                   <th>Item Name</th>
                   <th>Allocated Labour Hours</th>
                    <th>Adjustment</th>
                   <th>Total Allocated Labour Hours</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($conn->query($sql) as $ltable) {
        $mattable .= "<tr>
                    <td>" . $ltable['item_code'] . "</td>
                    <td>" . $ltable['item_name'] . "</td>
                    <td>" . $ltable['lab_h'] . "</td>
                    <td>" . $ltable['adjust'] . "</td>
                    <td>" . $ltable['tot_lab_h'] . "</td>
                  
            </tr>";
    }

    // $mattable = $sql;




    $sqlmm = "Select * from s_mas_details where costing_no ='" . $row['CostingRef'] . "'";

    if ($_GET['stname'] == "mrn_ex") {


        $mat = "<table class='table table-bordered' id='myTable'>
                <thead class='thead-dark'>
                    <tr>
                       <th style='width: 120px;'>Item</th>
                        <th>Description</th>
                           <th style='width: 10px;'></th>
                        <th style='width: 100px;'>Ex. Stock</th>
                        <th style='width: 100px;'>UOM</th>

                        <th style='width: 100px;'>Request Qty</th>
                          <th style='width: 60px;'></th>
                    </tr>
                </thead>
                <tbody>";

        $index = 1;
        foreach ($conn->query($sqlmm) as $mtable) {

            $sql = "SELECT * FROM s_mas where STK_NO = '" . $mtable['s_item'] . "'";
            $result = $conn->query($sql);
            $row = $result->fetch();
            //$no = $row['jobtranscode'];


            $mat .= "<tr onkeyup='myfun(this);'>
                <td>" . $row['STK_NO'] . "</td>
                <td>" . $mtable['s_descrip'] . "</td>
               <td></td>
                <td>" . $row['QTYINHAND'] . "</td>
                <td>" . $row['UOM'] . "</td>

                <td id='user" . $index . "' ></td>



            </tr>";
            $index = $index + 1;
        }

        $mat .= "</tbody>
            </table>";
         

        } else if($_GET['stname'] == "pickJOB") {


        $mat = "<table class='table table-bordered' id='myTable'>
                <thead class='thead-dark'>
                    <tr>
                       <th style='width: 120px;'>Item</th>
                        <th>Description</th>

                        <th style='width: 100px;'>Ex. Stock</th>
                        <th style='width: 100px;'>UOM</th>
                        <th style='width: 100px;'>Allocated Qty</th>
                        <th style='width: 100px;'>Request Qty</th>
                        <th style='width: 160px;'>Balance</th>

                    </tr>
                </thead>
                <tbody>";


  $sqlmattt = "select * from joborder_mat_table_temp where jcode ='" . $cuscode . "'";


        $index = 1;
        foreach ($conn->query($sqlmattt) as $mtable) {

           if ($mtable['item_code'] != "MM0010100") {
           // "MM0010100" this item is a SP item, dont use this item in mrn.

                $sql = "SELECT * FROM s_mas where STK_NO = '" . $mtable['item_code'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch();
                //$no = $row['jobtranscode'];


                $sqlQtyCal = "SELECT SUM(cur_qty) as req from tmp_stock_adjust_data where txt_jobno = '" . $cuscode . "' and str_code = '" . $mtable['item_code'] . "'";
                $resultqty = $conn->query($sqlQtyCal);
                $rowQTY = $resultqty->fetch();

                $tempCal001 = $mtable['qty'] - $rowQTY['req'];

                $mat .= "<tr onkeyup='myfun(this);'>
                    <td>" . $row['STK_NO'] . "</td>
                    <td>" . $mtable['item_name'] . "</td>

                    <td>" . $row['QTYINHAND'] . "</td>
                    <td>" . $row['UOM'] . "</td>
                    <td id='qty" . $index . "'>" . $mtable['qty'] . "</td>
                    <td id='user" . $index . "' tempcal='" . $tempCal001 . "' contenteditable style='background-color: antiquewhite;'></td>
                    <td id='bal" . $index . "' >" . number_format($tempCal001,4) . "</td>



                </tr>";


                $index = $index + 1;

           }

        }




        $mat .= "</tbody>
            </table>";
    
    } else {



        $mat = "<table class='table table-bordered' id='myTable'>
                <thead class='thead-dark'>
                    <tr>
                       <th style='width: 120px;'>Item</th>
                        <th>Description</th>

                        <th style='width: 100px;'>Ex. Stock</th>
                        <th style='width: 100px;'>UOM</th>
                        <th style='width: 100px;'>Allocated Qty</th>
                        <th style='width: 100px;'>Request Qty</th>
                        <th style='width: 160px;'>Balance</th>

                    </tr>
                </thead>
                <tbody>";

        $index = 1;
        foreach ($conn->query($sqlmm) as $mtable) {

            $sql = "SELECT * FROM s_mas where STK_NO = '" . $mtable['s_item'] . "'";
            $result = $conn->query($sql);
            $row = $result->fetch();
            //$no = $row['jobtranscode'];






            $mat .= "<tr onkeyup='myfun(this);'>
                <td>" . $row['STK_NO'] . "</td>
                <td>" . $mtable['s_descrip'] . "</td>

                <td>" . $row['QTYINHAND'] . "</td>
                <td>" . $row['UOM'] . "</td>
                <td id='qty" . $index . "'>" . $mtable['qty'] . "</td>
                <td id='user" . $index . "' contenteditable style='background-color: antiquewhite;'>0</td>
                <td id='bal" . $index . "' >" . $mtable['qty'] . "</td>



            </tr>";
            $index = $index + 1;
        }




        $mat .= "</tbody>
            </table>";
    }



    $sql = "Select * from joborder_table where jcode ='" . $row['jid'] . "'";

    $jobtable = "<table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                    <th style='width: 20%;'>Style</th>
                    <th style='width: 20%;'>Size</th>
                    <th style='width: 10%;'>Qty</th>
                    <th style='width: 50%;'>Remark</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($conn->query($sql) as $jtable) {
        $jobtable .= "<tr>
                <td>" . $jtable['style'] . "</td>
                <td>" . $jtable['size'] . "</td>
                <td>" . $jtable['qty'] . "</td>
                <td>" . $jtable['remark'] . "</td>
            </tr>";
    }


    $ResponseXML .= "<jobtable><![CDATA[" . $jobtable . "]]></jobtable>";
    $ResponseXML .= "<mattable><![CDATA[" . $mattable . "]]></mattable>";
    $ResponseXML .= "<mat><![CDATA[" . $mat . "]]></mat>";
    $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";


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
