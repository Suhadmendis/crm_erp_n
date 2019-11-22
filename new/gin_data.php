<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

/////////////////////////////////////// GetValue //////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Registration /////////////////////////////////////////////////////////////////////////

if ($_GET["Command"] == "new_inv") {

    $invno = getno();

    $sql = "Select GIN from tmpinvpara_acc";
    $result = $conn->query($sql);
    $row = $result->fetch();

    $tono = $row['GIN'];
    $_SESSION["gin_tmpno"] = $tono;

    $sql = "delete from tmp_stock_adjust_data where str_invno ='" . $tono . "'";
    $result = $conn->query($sql);

    $sql = "update tmpinvpara_acc set GIN=GIN+1";
    $result = $conn->query($sql);


    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $ResponseXML .= "<invno><![CDATA[" . $invno . "]]></invno>";
    $ResponseXML .= "<tmpno><![CDATA[" . $tono . "]]></tmpno>";
    $ResponseXML .= "<dt><![CDATA[" . date('Y-m-d') . "]]></dt>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

function getno() {
    include './connection_sql.php';
    $sql = "select GIN from invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $tmpinvno = "000000" . $row["GIN"];
    $lenth = strlen($tmpinvno);
    return $invno = trim("MIN/") . substr($tmpinvno, $lenth - 7);
}

if ($_GET["Command"] == "setitem") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    $sql = "delete from tmp_stock_adjust_data where str_code='" . $_GET['itemCode'] . "' and str_invno='" . $_GET['tmpno'] . "' ";
    $result = $conn->query($sql);
    if ($_GET["Command1"] == "add_tmp") {
        $rate = str_replace(",", "", $_GET["itemPrice"]);
        $qty = str_replace(",", "", $_GET["qty"]);

        $discount = 0;
        $subtotal = $rate * $qty;
//         str_code, str_description, cur_qty, str_invno
        $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno)values 
			('" . $_GET['itemCode'] . "', '" . $_GET['itemDesc'] . "', " . $_GET['qty'] . ",'" . $_GET['tmpno'] . "') ";
        $result = $conn->query($sql);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Description</td>
						<td style=\"width: 60px;\">Qty</td>
						<td style=\"width: 10px;\"></td>
					</tr>";

    $i = 1;
    $mtot = 0;
    $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $_GET['tmpno'] . "'";
    foreach ($conn->query($sql) as $row) {

        $ResponseXML .= "<tr>                              
                             <td>" . $row['str_code'] . "</td>
							 <td>" . $row['str_description'] . "</td>
							 <td>" . number_format($row['cur_qty'], 2, ".", ",") . "</td>
							 <td><a class=\"btn btn-danger btn-xs\" onClick=\"del_item('" . $row['str_code'] . "')\"> <span class='fa fa-remove'></span></a></td>
							 </tr>";

        $i = $i + 1;
    }


    $ResponseXML .= "   </table>]]></sales_table>";

    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "select REF_NO,cancel from s_ginmas where tmp_no ='" . $_GET['tmpno'] . "'";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {

            /*
              if ($row['cancel'] != "0") {
              echo "Already Cancelled";
              exit();
              }

              $invno = $row['REF_NO'];
              $sql = "delete from s_ginmas where REF_NO = '" . $invno . "'";
              $conn->exec($sql);
              $sql = "delete from s_trn where REFNO = '" . $invno . "'";
              $conn->exec($sql);
              $sql = "delete from ledger where L_REFNO = '" . $invno . "'";
              $conn->exec($sql);
             */
            if ($row['cancel'] != "0") {
                echo "Already Cancelled";
                exit();
            } else {
                exit("Already Entered");
            }
        } else {
            $invno = getno();
            $sql = "update invpara set GIN=GIN+1";
            $conn->exec($sql);
        }


        $sql = "select * from tmp_stock_adjust_data where str_invno='" . $_GET["tmpno"] . "'";

        $cost = 0;
        $totCost = 0;

        foreach ($conn->query($sql) as $row) {
            $cur_qty = str_replace(",", "", $row["cur_qty"]);
            $sqlsub = "Select * from s_submas where STK_NO='" . $row["str_code"] . "' and STO_CODE='" . $_GET["to_dep"] . "'";

            $resultsub = $conn->query($sqlsub);
            if ($rowsub = $resultsub->fetch()) {
                $sql1 = "update s_submas set QTYINHAND=QTYINHAND+" . $cur_qty . " where STK_NO='" . $row["str_code"] . "' and STO_CODE = '" . $_GET["to_dep"] . "'";
                $conn->exec($sql1);
            } else {
                $sqlNew = "insert into s_submas(STO_CODE, STK_NO, DESCRIPt, OPEN_STK, QTYINHAND) values ('" . $_GET["to_dep"] . "',  '" . $row["str_code"] . "', '" . $row["str_description"] . "', 0, " . $cur_qty . ")";
                $conn->exec($sqlNew);
            }

            $sql1 = "update s_submas set QTYINHAND=QTYINHAND-" . $cur_qty . " where STK_NO='" . $row["str_code"] . "' and STO_CODE='" . $_GET["from_dep"] . "'";
            $conn->exec($sql1);

            $sql1 = "update s_rawmas set QTYINHAND=QTYINHAND-" . $cur_qty . " where STK_NO='" . $row["str_code"] . "'";
            $conn->exec($sql1);

            $sql = "select cost from s_rawmas where STK_NO='" . $row["str_code"] . "'";
            $rowItem = $conn->query($sql)->fetch();
            $cost = $rowItem["cost"] * $cur_qty;
            $totCost += $cost;

            $sql5 = "Insert into s_trn (STK_NO, SDATE, REFNO, QTY, LEDINDI, DEPARTMENT, DESCRIPt, cost,JOB_REF) values('" . $row["str_code"] . "', '" . $_GET["invdate"] . "', '" . trim($invno) . "', " . $cur_qty . ", 'GINMI','" . $_GET["from_dep"] . "', '" . $row["str_description"] . "', " . $rowItem["cost"] . ", '" . $_GET["job_ref"] . "')";
            $conn->exec($sql5);
            $sql5 = "Insert into s_trn (STK_NO, SDATE, REFNO, QTY, LEDINDI, DEPARTMENT, DESCRIPt, cost,JOB_REF) values('" . $row["str_code"] . "', '" . $_GET["invdate"] . "', '" . trim($invno) . "', " . $cur_qty . ", 'GINMR','" . $_GET["to_dep"] . "', '" . $row["str_description"] . "', " . $rowItem["cost"] . ", '" . $_GET["job_ref"] . "')";
            $conn->exec($sql5);
        }

        require_once './gl_posting.php';
        $ldate = $_GET["invdate"];
        $ayear = ac_year($ldate);

        // $sqlGlPost = "select * from gl_posting where docname = 'ISSUE NOTE'";
        $ledgerRem = "Issue note";

        if ($_GET["Command1"] == "getGl") {
            $bal = 0;
            $msg = "<div class='col-sm-12'>
		<table class='table table-striped'>
		<tr class='success'>
			<th style='width: 100px;'>Account No</th>
            <th style='width: 300px;'>Account Name</th>
			<th style='width: 10px;'>DEB</th>
			<th style='width: 10px;'>CRE</th>
			
		</tr>";
        }

            //GL posting

        $tot_cost = 0;
        $sqltempraw = "select * from tmp_stock_adjust_data where str_invno='" . $_GET["tmpno"] . "'";
        foreach ($conn->query($sqltempraw) as $rowtempraw) {
            
            if ($rowtempraw["cur_qty"]!=0) {

                        $sqlraw = "select cost,MaterialIssueWIPMIN from s_rawmas where STK_NO='" . $rowtempraw["str_code"] . "'";
                        $rowraw = $conn->query($sqlraw)->fetch();
                        $costraw = $rowraw["cost"] * $rowtempraw["cur_qty"];

                        $sqlacc = "select C_CODE,C_NAME from lcodes where C_CODE='" . $rowraw["MaterialIssueWIPMIN"] . "'";
                        $rowacc = $conn->query($sqlacc)->fetch();
                        $accname = $rowacc["C_NAME"];


                        

                $sqlLedger = "Insert into ledger(l_refno, l_date, L_LMEM, l_code, l_amount, l_flag, l_flag1, acyear, ComCode, c_remarks) Values ('" . trim($invno) . "', '" . $ldate . "', '$ledgerRem', '" . $rowraw["MaterialIssueWIPMIN"] . "', " . $costraw . ", 'ISN', 'DEB', '$ayear', '" . $_SESSION['company'] . "', '" . $_GET["txt_jobno"] . "')";
                    $conn->exec($sqlLedger);
            
                if ($_GET["Command1"] == "getGl") {

                    //DEB
                    $msg .= "<tr>";
                    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowraw["MaterialIssueWIPMIN"] . "</td>";
                    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $accname . "</td>";
                    $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($costraw, 2, ".", ",") . "</td>";
                    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
                    $msg .= "</tr>";


                }
                $tot_cost = $tot_cost + $costraw;

            }    


        }

                $tot_cost = 0;
        $sqltempraw = "select * from tmp_stock_adjust_data where str_invno='" . $_GET["tmpno"] . "'";
        foreach ($conn->query($sqltempraw) as $rowtempraw) {
            
            if ($rowtempraw["cur_qty"]!=0) {

                        $sqlraw = "select cost,StockInHandAccoun from s_rawmas where STK_NO='" . $rowtempraw["str_code"] . "'";
                        $rowraw = $conn->query($sqlraw)->fetch();
                        $costraw = $rowraw["cost"] * $rowtempraw["cur_qty"];

                        $sqlacc = "select C_CODE,C_NAME from lcodes where C_CODE='" . $rowraw["StockInHandAccoun"] . "'";
                        $rowacc = $conn->query($sqlacc)->fetch();
                        $accname = $rowacc["C_NAME"];


                        

                $sqlLedger = "Insert into ledger(l_refno, l_date, L_LMEM, l_code, l_amount, l_flag, l_flag1, acyear, ComCode, c_remarks) Values ('" . trim($invno) . "', '" . $ldate . "', '$ledgerRem', '" . $rowraw["StockInHandAccoun"] . "', " . $costraw . ", 'ISN', 'CRE', '$ayear', '" . $_SESSION['company'] . "', '" . $_GET["txt_jobno"] . "')";
                    $conn->exec($sqlLedger);
            
                if ($_GET["Command1"] == "getGl") {

                    //DEB
                    $msg .= "<tr>";
                    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowraw["StockInHandAccoun"] . "</td>";
                    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $accname . "</td>";
                    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
                    $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($costraw, 2, ".", ",") . "</td>";
                    $msg .= "</tr>";


                }
                $tot_cost = $tot_cost + $costraw;

            }    


        }
              


        if ($_GET["Command1"] == "getGl") {
            $msg .= "</table></div>";
            $conn->rollBack();
            exit($msg);
        }

        $sql2 = "select * from s_stomas where CODE='" . $_GET["from_dep"] . "' ";

        $result = $conn->query($sql2);
        $row2 = $result->fetch();
        $DESCRIPTION_from = $row2["DESCRIPTION"];

        $sql2 = "select * from s_stomas where CODE='" . $_GET["to_dep"] . "' ";

        $result = $conn->query($sql2);
        $row2 = $result->fetch();
        $DESCRIPTION_to = $row2["DESCRIPTION"];

        $sql1 = "insert into s_ginmas(SDATE, REF_NO, DEP_FROM, DEP_F_NAME, DEP_TO, DEP_T_NAME, tmp_no, JOB_NO, remark, TYPE,JOB_REF) values ('" . $_GET["invdate"] . "', '" . $invno . "', '" . $_GET["from_dep"] . "', '" . $DESCRIPTION_from . "', '" . $_GET["to_dep"] . "', '" . $DESCRIPTION_to . "', '" . $_GET["tmpno"] . "', '" . $_GET["txt_jobno"] . "', '" . $_GET["txt_remarks"] . "', 'MIN', '" . $_GET["job_ref"] . "')";

        $conn->exec($sql1);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}




if ($_GET["Command"] == "pass_rec") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $stname = "";
    if (isset($_GET["stname"])) {
        $stname = $_GET["stname"];
    }

    if (($stname == "") || ($stname == "isa") || ($stname == "fg")) {

        $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";
            $ResponseXML .= "<C_DATE><![CDATA[" . $row["SDATE"] . "]]></C_DATE>";
            $ResponseXML .= "<txt_remarks><![CDATA[" . $row["remark"] . "]]></txt_remarks>";
            $_SESSION["gin_tmpno"] = $row["tmp_no"];
            $ResponseXML .= "<tmp_no><![CDATA[" . $row["tmp_no"] . "]]></tmp_no>";
            $ResponseXML .= "<department><![CDATA[" . $row["DEP_FROM"] . "]]></department>";
            $ResponseXML .= "<department1><![CDATA[" . $row["DEP_TO"] . "]]></department1>";
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

            $sql = "delete from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            $result = $conn->exec($sql);

            if (($stname == "")) {
                $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'GINMI'";
            } else if ($stname == "isa") {
                $sqlTrn = "Select * from s_gintrn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'GINMI'";
            } else if ($stname == "fg") {
                $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'FGR'";

                $sql = "Select * from joborder where jid='" . $row["JOB_NO"] . "'";
                $result = $conn->query($sql);
                $rowJob = $result->fetch();
                $ResponseXML .= "<jobQty><![CDATA[" . $rowJob["JobQty"] . "]]></jobQty>";
                $ResponseXML .= "<txt_trfd><![CDATA[" . $rowJob["trf_qty"] . "]]></txt_trfd>";
            }


            foreach ($conn->query($sqlTrn) as $row1) {
                $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno) values
                    ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $row['tmp_no'] . "') ";
//                    $ResponseXML .= "<test><![CDATA[" . $sql . "]]></test>";
                $result = $conn->exec($sql);
            }

            $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Description</td>
						<td style=\"width: 60px;\">Qty</td>
						<td style=\"width: 10px;\"></td>
					</tr>";

            $i = 1;
            $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            foreach ($conn->query($sql) as $row1) {

                $ResponseXML .= "<tr>                              
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td>" . number_format($row1['cur_qty'], 2, ".", ",") . "</td>
                            <td></td>
                            </tr>";

                $i = $i + 1;
            }

            $mtot1 = 0;

            $ResponseXML .= "   </table>]]></sales_table>";
            $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
        }
    } else if (($stname == "job") || ($stname == "jobi") || ($stname == "jobg")) {
        $sql = "Select * from s_mrnmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";

            $sql = "delete from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";
            $result = $conn->exec($sql);

            $sqlTrn = "Select * from s_mrntrn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'GINI'";


            foreach ($conn->query($sqlTrn) as $row1) {
                $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno) values
                    ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $_SESSION["gin_tmpno"] . "') ";
//                    $ResponseXML .= "<test><![CDATA[" . $sql . "]]></test>";
                $result = $conn->exec($sql);
            }

            $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Description</td>
						<td style=\"width: 100px;\">Ex. Stock</td>
						<td style=\"width: 100px;\">Allocated Qty</td>
						<td style=\"width: 100px;\">Already Issued Qty</td>
						<td style=\"width: 100px;\">Issue Qty</td>
						<td style=\"width: 100px;\">Balance to be issued</td>
						
					</tr>";

            $i = 1;
            $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";
            foreach ($conn->query($sql) as $row1) {


                $sqlitem = "SELECT * FROM s_rawmas where STK_NO = '" . $row1['str_code'] . "'";
                $result = $conn->query($sqlitem);
                $rowitem = $result->fetch();

                $sqlmrn = "SELECT * FROM s_mrnmas where REF_NO = '" . $_GET['refno'] . "'";
                $result = $conn->query($sqlmrn);
                $rowmrn = $result->fetch();


                $sqltrn = "SELECT * FROM s_mrntrn where REFNO = '" . $_GET['refno'] . "' and STK_NO = '" . $row1['str_code'] . "' and LEDINDI = 'GINI'";

                $result = $conn->query($sqltrn);
                $rowtrn = $result->fetch();

                $sqljob = "SELECT * FROM joborder_mat_table_temp where jcode = '" . $rowmrn['JOB_NO'] . "' and item_code = '" . $row1['str_code'] . "' ";
                $result = $conn->query($sqljob);
                $rowjob = $result->fetch();

              
                $sqlissued = "SELECT joborder.jid, s_mrnmas.REF_NO, s_mrntrn.DESCRIPt,sum(s_mrntrn.QTY) as qty_tot FROM joborder JOIN s_mrnmas ON joborder.jid = s_mrnmas.JOB_NO INNER JOIN s_mrntrn ON s_mrnmas.REF_NO = s_mrntrn.REFNO WHERE s_mrntrn.LEDINDI = 'GINI' AND joborder.jid = '" . $rowmrn['JOB_NO'] . "' AND s_mrntrn.STK_NO = '" . $row1['str_code'] . "'";
               
                $result = $conn->query($sqlissued);
                $rowissued = $result->fetch();
                
// echo $sqlissued;




                // $sqlmats = "select * from view_z_sub_get_mat_qty where REF_NO = '" . $_GET['refno'] . "' and s_item = '" . $row1['str_code'] . "'";
                // $result = $conn->query($sqlmats);
                // $rowm = $result->fetch();
                
                
                $tempnum1 = $rowjob['qty'];  
                $tempnum2 = $rowtrn['QTY'];  

                $ResponseXML .= "<tr>                              
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td>" . $rowitem['QTYINHAND'] . "</td>
                            <td>" . $rowjob['qty'] . "</td>
                         
                             <td>" . number_format($rowissued['qty_tot'], 2, ".", ",") . "</td>
                           
                            <td>" . $rowtrn['QTY'] . "</td>
                            <td>" . number_format($tempnum1 - $tempnum2, 2, ".", ",") . "</td>
                            
                            </tr>";

                $i = $i + 1;
            }

            $mtot1 = 0;

            $ResponseXML .= "   </table>]]></sales_table>";
            $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
            $ResponseXML .= "<msg><![CDATA[]]></msg>";
        }
    } else if (($stname == "mrn") || ($stname == "mrnx") || ($stname == "mrni") || ($stname == "mrng") || ($stname == "dp")) {

        $sql = "Select * from s_mrnmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        $jobno = "";

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";
            $jobno = $row["JOB_NO"];
            $ResponseXML .= "<C_DATE><![CDATA[" . $row["SDATE"] . "]]></C_DATE>";
            $ResponseXML .= "<txt_remarks><![CDATA[" . $row["remark"] . "]]></txt_remarks>";
            $ResponseXML .= "<tmp_no><![CDATA[" . $row["tmp_no"] . "]]></tmp_no>";
            $ResponseXML .= "<department><![CDATA[" . $row["DEP_FROM"] . "]]></department>";
            $ResponseXML .= "<department1><![CDATA[" . $row["DEP_TO"] . "]]></department1>";
            $ResponseXML .= "<issue><![CDATA[" . $row["ISSUE"] . "]]></issue>";


            $ResponseXML .= "<customer_name><![CDATA[" . $row["customer_name"] . "]]></customer_name>";
            $ResponseXML .= "<customer_address><![CDATA[" . $row["customer_address"] . "]]></customer_address>";
            $ResponseXML .= "<customer_po><![CDATA[" . $row["customer_po"] . "]]></customer_po>";
            $ResponseXML .= "<manuel_aod><![CDATA[" . $row["manuel_aod"] . "]]></manuel_aod>";
            $ResponseXML .= "<supplier_vendor_no><![CDATA[" . $row["supplier_vendor_no"] . "]]></supplier_vendor_no>";
            $ResponseXML .= "<vehicle><![CDATA[" . $row["vehicle"] . "]]></vehicle>";

            $sqlv = "SELECT * from vehicles where vref = '" . $row["vehicle"] . "'";
            $result = $conn->query($sqlv);
            $rowv = $result->fetch();
  
            


            $ResponseXML .= "<vehicleno><![CDATA[" . $rowv["vehicleno"] . "]]></vehicleno>";
            $ResponseXML .= "<contact_person><![CDATA[" . $row["contact_person"] . "]]></contact_person>";
            $ResponseXML .= "<job_num><![CDATA[" . $row["job_num"] . "]]></job_num>";

            $ResponseXML .= "<MAN_REF><![CDATA[" . $row["Manuel_NO"] . "]]></MAN_REF>";
            $ResponseXML .= "<PER_DES><![CDATA[" . $row["pro_des"] . "]]></PER_DES>";


             $sqlalocated = "Select SUM(QTY) as alocated from s_mrnmas join s_mrntrn ON s_mrnmas.REF_NO = s_mrntrn.REFNO where s_mrnmas.JOB_NO='" . $row["JOB_NO"] . "' and s_mrnmas.TYPE = 'MRNG' and s_mrntrn.LEDINDI = 'GINR'";
            
                $resultalocated = $conn->query($sqlalocated);
                $rowalocated = $resultalocated->fetch();
      
                $ResponseXML .= "<alocated><![CDATA[" . $rowalocated['alocated'] . "]]></alocated>";


                 $sqlTotalocated = "select * from joborder where jid = '" . $row["JOB_NO"] . "'";
            
                $resultTotalocated = $conn->query($sqlTotalocated);
                $rowTotalocated = $resultTotalocated->fetch();
      
                $ResponseXML .= "<Totalocated><![CDATA[" . $rowTotalocated['all_pro'] . "]]></Totalocated>";
            
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

            $sql = "delete from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            $result = $conn->exec($sql);


            $sqlTrn = "Select * from s_mrntrn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'GINI'";


            foreach ($conn->query($sqlTrn) as $row1) {
                $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno) values
                    ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $row['tmp_no'] . "') ";

                $result = $conn->exec($sql);
            }



            if ($stname == "mrnx") {
                $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
			<th style='width: 120px;'>EX</th>
                        <th></th>
                        <th style='width: 100px;'></th>
                        <th style='width: 100px;'></th>
                        <th style='width: 100px;'></th>
                       
					</tr>";
            } else {
                $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
			
                        <th style='width: 120px;'>Item</th>
                        <th>Description</th>
                       
                        <th style='width: 100px;'>Ex. Stock</th>
                        <th style='width: 100px;'>UOM</th>

                        <th style='width: 100px;'>Request Qty</th>

                        <th style='width: 60px;'></th>
                       
					</tr>";
            }




            $i = 1;
            $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            foreach ($conn->query($sql) as $row1) {

                $sql = "SELECT * FROM s_rawmas where STK_NO = '" . $row1['str_code'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch();




                $ResponseXML .= "<tr>                              
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td>" . $row['QTYINHAND'] . "</td>
                            <td>" . $row['UOM'] . "</td>
                          
                            <td>" . number_format($row1['cur_qty'], 2, ".", ",") . "</td>
                            <td></td>
                            </tr>";

                $i = $i + 1;
            }

            $mtot1 = 0;

            $ResponseXML .= "   </table>]]></sales_table>";



            $sqlpro = "SELECT * from view_z_sub_get_productname WHERE jid = '" . $jobno . "'";
            $result = $conn->query($sqlpro);
            $product = $result->fetch();



            $sqlmm = "Select * from s_mas_details where costing_no ='" . $product['CostingRef'] . "'";

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

                $sql = "SELECT * FROM s_rawmas where STK_NO = '" . $mtable['s_item'] . "'";
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
            
             $ResponseXML .= "<productname><![CDATA[" . $product['description'] . "]]></productname>";
            $ResponseXML .= "<mat><![CDATA[" . $mat . "]]></mat>";
            $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
        }
    } else if (($stname == "ming") || ($stname == "ming_req") || ($stname == "ming_dsr")) {

        $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";

        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            if ($stname != "ming_req") {
                $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";
                $_SESSION["gin_tmpno"] = $row["tmp_no"];
                $ResponseXML .= "<tmp_no><![CDATA[" . $row["tmp_no"] . "]]></tmp_no>";
            } else {
                $_SESSION["ming_req_ref"] = $row["REF_NO"];
                $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["REF_NO"] . "]]></C_JOBNO>";
            }
            $ResponseXML .= "<C_DATE><![CDATA[" . $row["SDATE"] . "]]></C_DATE>";
            $ResponseXML .= "<txt_remarks><![CDATA[" . $row["remark"] . "]]></txt_remarks>";

            $ResponseXML .= "<department><![CDATA[" . $row["DEP_FROM"] . "]]></department>";
            $ResponseXML .= "<TYPE1><![CDATA[" . $row["TYPE1"] . "]]></TYPE1>";
            $ResponseXML .= "<department1><![CDATA[02]]></department1>";
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

            $sql = "delete from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";
            $result = $conn->exec($sql);


            $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "'";
 // echo $sqlTrn;
            $j = 1;
            foreach ($conn->query($sqlTrn) as $row1) {
                // if ($stname != "ming_req") {
                    $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno, val) values
                            ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $_SESSION["gin_tmpno"] . "', " . $row1['cost'] . ") ";
                           
                    //                    $ResponseXML .= "<test><![CDATA[" . $sql . "]]></test>";
                    $result = $conn->exec($sql);
                // }
                $j++;
            }

            $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Description</td>
						<td style=\"width: 60px;\">Qty</td>";
            // if (($stname == "ming_dsr")) {

            // }
            $ResponseXML .= "<td style=\"width: 60px;\">Rate</td>";
            $ResponseXML .= "<td style=\"width: 60px;\">Total</td>";
            $ResponseXML .= "<td style=\"width: 10px;\"></td></tr>";

            $i = 1;
            $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";

            foreach ($conn->query($sql) as $row1) {
                $rate = $i . "rate";
                $qtygen = $i . "qty";
                $totgen = $i . "tot";


                $rowF1 = $_SESSION["gin_tmpno"];
                $rowF2 = $row1['str_code'];
                $ResponseXML .= "<tr>
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td ><input id='$qtygen' value='" . number_format($row1['cur_qty'], 2, ".", ",") . "'></td>";
                if (($stname == "ming_req")) {
                    $ResponseXML .= "<td ><input type='text' id='$rate' onkeyup=setRate(\"$rowF1\",\"$rowF2\",this);></td>";
                    $ResponseXML .= "<td ><input type='text' id='$totgen'></td>";
                }
                 if (($stname == "ming_dsr")) {
                    $ResponseXML .= "<td>" . number_format($row1['val'], 2, ".", ",") . "</td>";
                }

                $ResponseXML .= "<td></td>
                            </tr>";

                $i = $i + 1;
            }

            $mtot1 = 0;

            $ResponseXML .= "   </table>]]></sales_table>";
            if ($stname != "ming_req") {
                $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
            } else {
                $ResponseXML .= "<item_count><![CDATA[" . $j . "]]></item_count>";
            }
        }
    } else if (($stname == "pick_is")) {
        //pickMIN currently not using
        $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";
        }
        $_SESSION["pickRef_is"] = $row["REF_NO"];
    } else if (($stname == "pick_dp")) {

        $sql = "Select JOB_NO from s_mrnmas where REF_NO='" . $_GET['refno'] . "'";
         
        $result = $conn->query($sql);
        $row = $result->fetch();

        $sql = "Select JOB_NO from s_ginmas where JOB_NO='" . $row['JOB_NO'] . "'";
      
        $result = $conn->query($sql);
        $row = $result->fetch();



 $sqlnav = "SELECT s_mrnmas.REF_NO, s_mrnmas.JOB_NO, joborder.jid, joborder.CostingRef,joborder.QuotationRef FROM s_mrnmas INNER JOIN s_ginmas ON s_mrnmas.JOB_NO = s_ginmas.REF_NO INNER JOIN joborder ON s_ginmas.JOB_NO = joborder.jid WHERE s_mrnmas.TYPE = 'DP' and s_mrnmas.REF_NO = '" .  $_GET['refno'] . "'";
        // $sql = "Select * from s_mrntrn where REFNO='" . $_GET['refno'] . "'";
// echo $sqnav;


        // echo $sql;
        $result = $conn->query($sqlnav);
        $rownav = $result->fetch();

        // echo  $rownav[2];

        $ResponseXML .= "<NAV><![CDATA[" . $rownav[3]."&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;".$rownav[2]."&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;".$rownav[1]."&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;".$rownav[0]. "&nbsp;&nbsp;&nbsp; <br>Quotation Ref : &nbsp;&nbsp;".$rownav[4]. "]]></NAV>";


        $ResponseXML .= "<JOB_REF><![CDATA[" . $rownav[2] . "]]></JOB_REF>";
        $ResponseXML .= "<FG_REF><![CDATA[" . $rownav[1] . "]]></FG_REF>";
        $ResponseXML .= "<COSTING_REF><![CDATA[" .  json_encode($rownav) . "]]></COSTING_REF>";

        $sql = "SELECT s_mrntrn.REFNO,s_mrntrn.QTY,s_mrntrn.STK_NO,s_mrntrn.DESCRIPt,s_mrntrn.LEDINDI,s_mrnmas.customer_name,s_mrnmas.customer_address FROM s_mrntrn INNER JOIN s_mrnmas ON s_mrntrn.REFNO = s_mrnmas.REF_NO WHERE s_mrntrn.LEDINDI = 'GINR' AND s_mrntrn.REFNO='" . $_GET['refno'] . "'";
        // $sql = "Select * from s_mrntrn where REFNO='" . $_GET['refno'] . "'";



        // echo $sql;
        $result = $conn->query($sql);
        $rowTrn = $result->fetch();

        $ResponseXML .= "<QTY><![CDATA[" . $rowTrn["QTY"] . "]]></QTY>";
           $ResponseXML .= "<item_no><![CDATA[" . $rowTrn["STK_NO"] . "]]></item_no>";
            $ResponseXML .= "<descript><![CDATA[" . $rowTrn["DESCRIPt"] . "]]></descript>";

        // $sql = "Select * from joborder where jid='" . $row['JOB_NO'] . "'";
        // $result = $conn->query($sql);
       // echo $sql;
      //  if ($row = $result->fetch()) {
         
            $ResponseXML .= "<C_CODE><![CDATA[-----]]></C_CODE>";
            $ResponseXML .= "<CUS_NAME><![CDATA[" . $rowTrn["customer_name"] . "]]></CUS_NAME>";
            $ResponseXML .= "<C_ADD1><![CDATA[" . $rowTrn["customer_address"] . "]]></C_ADD1>";

        $ResponseXML .= "<QTY><![CDATA[" . $rowTrn["QTY"] . "]]></QTY>";
   

   $sqlco = "SELECT SalesPrice FROM joborder WHERE jid ='" . $rownav[2] . "'";
        // $sql = "Select * from s_mrntrn where REFNO='" . $_GET['refno'] . "'";



        // echo $sql;
        $resultco = $conn->query($sqlco);
        $rowco = $resultco->fetch();



            $ResponseXML .= "<rate><![CDATA[" . $rowco['SalesPrice'] . "]]></rate>";


            //  $ResponseXML .= "<CUS_NAME><![CDATA[" . $row["CUS_NAME"] . "]]></CUS_NAME>";
            // $ResponseXML .= "<C_ADD1><![CDATA[" . $row["C_ADD1"] . "]]></C_ADD1>";
            // $ResponseXML .= "<rate><![CDATA[" . $row["rate"] . "]]></rate>";
      //  }
        $ResponseXML .= "<C_REFNO><![CDATA[" . $_GET['refno'] . "]]></C_REFNO>";
        $msg = "";
        if ($row['cancel'] == "1") {
            $msg = "Cancelled";
        }
        $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";
    } else if ($stname == "ginu") {

        $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";
            $ResponseXML .= "<C_DATE><![CDATA[" . $row["SDATE"] . "]]></C_DATE>";
            $ResponseXML .= "<txt_remarks><![CDATA[" . $row["remark"] . "]]></txt_remarks>";
            $_SESSION["gin_tmpno"] = $row["tmp_no"];
            $ResponseXML .= "<tmp_no><![CDATA[" . $row["tmp_no"] . "]]></tmp_no>";
            $ResponseXML .= "<department><![CDATA[" . $row["DEP_FROM"] . "]]></department>";
            $ResponseXML .= "<department1><![CDATA[" . $row["DEP_TO"] . "]]></department1>";
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

            $sql = "delete from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            $result = $conn->exec($sql);

            $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'GINU'";

            foreach ($conn->query($sqlTrn) as $row1) {
                $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno) values
                    ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $row['tmp_no'] . "') ";
//                    $ResponseXML .= "<test><![CDATA[" . $sql . "]]></test>";
                $result = $conn->exec($sql);
            }

            $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Job Number</td>
						<td style=\"width: 60px;\">Qty</td>
						<td style=\"width: 10px;\"></td>
					</tr>";

            $i = 1;
            $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $row["tmp_no"] . "'";
            foreach ($conn->query($sql) as $row1) {

                $ResponseXML .= "<tr>                              
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td>" . number_format($row1['cur_qty'], 2, ".", ",") . "</td>
                            <td></td>
                            </tr>";

                $i = $i + 1;
            }

            $mtot1 = 0;

            $ResponseXML .= "   </table>]]></sales_table>";
            $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
        }
    } else if (($stname == "pick_fg")) {

        $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        if ($row = $result->fetch()) {
            $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
            $ResponseXML .= "<C_JOBNO><![CDATA[" . $row["JOB_NO"] . "]]></C_JOBNO>";


            $sqlJOB = "Select * from joborder where jid = '" . $row["JOB_NO"] . "'";
            // echo $sqlJOB;
            $result = $conn->query($sqlJOB);
            $rowJOB = $result->fetch();

            $ResponseXML .= "<C_PO><![CDATA[" . $rowJOB['CustomerPONo'] . "]]></C_PO>";
            $ResponseXML .= "<Dispatched><![CDATA[" . $rowJOB['dispatched'] . "]]></Dispatched>";
            $ResponseXML .= "<TRF><![CDATA[" . $row['trf_qty'] . "]]></TRF>";

            $sqltemp = "select * from s_mrnmas WHERE JOB_NO = '" . $rowJOB['jid'] . "'";
          

            //echo $sql;

           $calTemp = 0.00;


            foreach ($conn->query($sqltemp) as $rowtemp) {

              
                $sql ="select SUM(QTY) as transfered from s_mrntrn WHERE REFNO = '" . $rowtemp["REF_NO"] . "' and LEDINDI = 'GINI'";
                $result = $conn->query($sql);
                $rowtemp = $result->fetch();
                
                $calTemp = $calTemp + $rowtemp['transfered'];

            }

            $ResponseXML .= "<J_QTY><![CDATA[" . $rowJOB['JobQty'] . "]]></J_QTY>";
            $ResponseXML .= "<TRA_QTY><![CDATA[" . $calTemp . "]]></TRA_QTY>";

            $bal = $rowJOB['JobQty'] - $calTemp;
            $ResponseXML .= "<BAL_TRA><![CDATA[" . $bal . "]]></BAL_TRA>";


            $sqlC = "Select * from vendor where CODE = '" . $rowJOB['Customer'] . "'";
            $result = $conn->query($sqlC);
            $rowC = $result->fetch();      

            $ResponseXML .= "<C_NAME><![CDATA[" . $rowC['NAME'] . "]]></C_NAME>";
            $ResponseXML .= "<C_Address><![CDATA[" . $rowC['ADD1'] . "]]></C_Address>";
     
            $msg = "";
            if ($row['cancel'] == "1") {
                $msg = "Cancelled";
            }
            $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

            $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "' and LEDINDI = 'FGR'";

            $row1 = $conn->query($sqlTrn)->fetch();

            $ResponseXML .= "<STK_NO><![CDATA[" . $row1["STK_NO"] . "]]></STK_NO>";
            $ResponseXML .= "<DESCRIPt><![CDATA[" . $row1["DESCRIPt"] . "]]></DESCRIPt>";
            $ResponseXML .= "<QTY><![CDATA[" . $row1["QTY"] . "]]></QTY>";

            $i = 2;
            $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
        }
    }

    $ResponseXML .= "<stname><![CDATA[" . $stname . "]]></stname>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "pass_rec_qttn") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $stname = "";
    if (isset($_GET["stname"])) {
        $stname = $_GET["stname"];
    }

    $sql = "Select * from s_ginmas where REF_NO='" . $_GET['refno'] . "'";
    $result = $conn->query($sql);

    if ($row = $result->fetch()) {
        $ResponseXML .= "<C_REFNO><![CDATA[" . $row["REF_NO"] . "]]></C_REFNO>";
        $ResponseXML .= "<tmp_no><![CDATA[" . $row["tmp_no"] . "]]></tmp_no>";
        $ResponseXML .= "<C_DATE><![CDATA[" . $row["SDATE"] . "]]></C_DATE>";
        $ResponseXML .= "<txt_remarks><![CDATA[" . $row["remark"] . "]]></txt_remarks>";

        $ResponseXML .= "<department><![CDATA[" . $row["DEP_FROM"] . "]]></department>";
        $ResponseXML .= "<TYPE1><![CDATA[" . $row["TYPE1"] . "]]></TYPE1>";
        $ResponseXML .= "<department1><![CDATA[02]]></department1>";
        $msg = "";
        if ($row['cancel'] == "1") {
            $msg = "Cancelled";
        }
        $ResponseXML .= "<msg><![CDATA[" . $msg . "]]></msg>";

        $sql = "delete from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";
        $result = $conn->exec($sql);


        $sqlTrn = "Select * from s_trn where refno='" . $row["REF_NO"] . "'";

        $j = 1;
        foreach ($conn->query($sqlTrn) as $row1) {
            $sql = "Insert into tmp_stock_adjust_data (str_code, str_description, cur_qty, str_invno, val) values
                            ('" . $row1['STK_NO'] . "', '" . $row1['DESCRIPt'] . "', " . $row1['QTY'] . ", '" . $_SESSION["gin_tmpno"] . "', " . $row1['cost'] . ") ";
            //                    $ResponseXML .= "<test><![CDATA[" . $sql . "]]></test>";
            $result = $conn->exec($sql);
            $j++;
        }

        $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
						<td>Description</td>
						<td style=\"width: 60px;\">Qty</td>";
        $ResponseXML .= "<td style=\"width: 60px;\">Rate</td>";
        $ResponseXML .= "<td style=\"width: 10px;\"></td></tr>";

        $i = 1;
        $sql = "Select * from tmp_stock_adjust_data where str_invno='" . $_SESSION["gin_tmpno"] . "'";
        foreach ($conn->query($sql) as $row1) {

            $ResponseXML .= "<tr>                              
                            <td>" . $row1['str_code'] . "</td>
                            <td>" . $row1['str_description'] . "</td>
                            <td>" . number_format($row1['cur_qty'], 2, ".", ",") . "</td>";
            $ResponseXML .= "<td>" . number_format($row1['val'], 2, ".", ",") . "</td>";

            $ResponseXML .= "<td></td>
                            </tr>";

            $i = $i + 1;
        }

        $mtot1 = 0;

        $ResponseXML .= "   </table>]]></sales_table>";
        $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
    }
    $ResponseXML .= "<stname><![CDATA[" . $stname . "]]></stname>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                        <th width=\"121\">Reference No</th>
                        <th width=\"121\">Date</th>
                        <th width=\"100\">From</th> 
                    </tr>";
    $stname = "";
    if (isset($_GET["stname"])) {
        $stname = $_GET["stname"];
    }

    if (($stname == "") || ($stname == "pickMIN")) {
        $sql = "select * from s_ginmas where TYPE = 'MIN'";
    } else if (($stname == "mrn")) {
        $sql = "select * from s_mrnmas where TYPE = 'MRN'";
    } else if (($stname == "mrnx")) {
        $sql = "select * from s_mrnmas where TYPE = 'MRNX'";
    } else if (($stname == "dp")) {
        $sql = "select * from s_mrnmas where TYPE = 'DP'";
    } else if (($stname == "pick_dp")) {
        $sql = "select * from s_mrnmas where TYPE = 'DP'";
    } else if (($stname == "job")) {
        $sql = "select * from s_mrnmas where TYPE in ('MRN','MRNX')";
    } else if (($stname == "jobi") || ($stname == "mrni")) {
        $sql = "select * from s_mrnmas where TYPE = 'MRNI'";
    } else if (($stname == "jobg") || ($stname == "mrng")) {
        $sql = "select * from s_mrnmas where TYPE = 'MRNG'";
    } else if ($stname == "ming") {
        $sql = "select * from s_ginmas where TYPE = 'MING'";
    } else if ($stname == "ming_req") {
        $sql = "select * from s_ginmas where TYPE = 'MING' and TYPE1 = 'direct'";
    } else if ($stname == "qttn") {
        $sql = "select * from s_ginmas where TYPE = 'QTN'";
    } else if ($stname == "ming_dsr") {
        $sql = "select * from s_ginmas where TYPE = 'DSR'";
    } else if ($stname == "fg") {
        $sql = "select * from s_ginmas where TYPE = 'FG'";
    } else if ($stname == "ginu") {
        $sql = "select * from s_ginmas where TYPE = 'ISU'";
    }

    $sql .= " and cancel = '0' and REF_NO like '%" . $_GET['refno'] . "%' ORDER BY SDATE desc limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["REF_NO"];


        $ResponseXML .= "<tr>               
                              <td onclick=\"crnview('$cuscode', '$stname');\">" . $row['REF_NO'] . "</a></td>
                              <td onclick=\"crnview('$cuscode', '$stname');\">" . $row['SDATE'] . "</a></td>
                              <td onclick=\"crnview('$cuscode', '$stname');\">" . $row['DEP_F_NAME'] . "</a></td>
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}



if ($_GET["Command"] == "del_inv") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "select REF_NO,cancel from s_ginmas where tmp_no ='" . $_GET['tmpno'] . "'";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            if ($row['cancel'] != "0") {
                echo "Already Cancelled";
                exit();
            } else {
                $sql = "select * from s_trn where REFNO='" . $row['REF_NO'] . "'";
                foreach ($conn->query($sql) as $row1) {

                    if ($row1["LEDINDI"] == "GINMR") {
                        $sql1 = "update s_submas set QTYINHAND=QTYINHAND-" . $row1['QTY'] . " where STK_NO='" . $row1["STK_NO"] . "' and STO_CODE = '" . $row1["DEPARTMENT"] . "'";
                        $conn->exec($sql1);
                    } else if ($row1["LEDINDI"] == "GINMI") {
                        $sql1 = "update s_submas set QTYINHAND=QTYINHAND+" . $row1['QTY'] . " where STK_NO='" . $row1["STK_NO"] . "' and STO_CODE = '" . $row1["DEPARTMENT"] . "'";
                        $conn->exec($sql1);
                        $sql1 = "update s_rawmas set QTYINHAND=QTYINHAND+" . $row1['QTY'] . " where STK_NO='" . $row1["STK_NO"] . "'";
                        $conn->exec($sql1);
                    }
                }

                $sql = "update s_ginmas set cancel='1' where REF_NO = '" . $row['REF_NO'] . "'";
                $conn->exec($sql);

                $sql = "delete from s_trn where REFNO='" . $row['REF_NO'] . "'";
                $conn->exec($sql);

                $sql = "delete from ledger where L_REFNO = '" . $row['REF_NO'] . "'";
                $conn->exec($sql);

                echo "ok";

                $conn->commit();
            }
        } else {
            echo "Entry Not Found";
        }
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}
?>