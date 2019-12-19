<?php
ini_set('session.gc_maxlifetime', 30 * 60 * 60 * 60);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Unsold Report</title>
        <style>
            table
            {
                border-collapse:collapse;
            }
            table, td, th
            {

                font-family:Arial, Helvetica, sans-serif;
                padding:5px;
            }
            th
            {
                font-weight:bold;
                font-size:14px;


            }
            td
            {
                font-size:14px;
                border-bottom:none;
                border-top:none;        
            }
        </style>
    </head>

    <body>
        <!-- Progress bar holder -->
        <!-- Progress information -->
        <div id="information" style="width"></div>

        <?php
        require_once("config.inc.php");
        require_once("DBConnector.php");
        $db = new DBConnector();

        $daysover = $_GET["over"];
        $daysbel = $_GET["between"];

        $sql = "delete from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "'";
        $result = $db->RunQuery($sql);


        if ($_GET["cmbbrand"] == "All") {
            $sql_smas = "select * from s_mas where QTYINHAND> 0 ";
        }
        if ($_GET["cmbbrand"] != "All") {
            $sql_smas = "select * from s_mas where QTYINHAND> 0 and BRAND_NAME='" . $_GET["cmbbrand"] . "'";
        }
        //$sql_smas = "select * from s_mas where QTYINHAND> 0 and STK_NO='06398'";
        $result_smas = $db->RunQuery($sql_smas);
        while ($row_smas = mysql_fetch_array($result_smas)) {
            $balqty = $row_smas["QTYINHAND"];
            $sql_artrn = "select * from s_purtrn where STK_NO='" . $row_smas["STK_NO"] . "' and CANCEL='0' order by SDATE desc ";
            //$sql_artrn = "select * from s_purtrn where STK_NO='06398' and CANCEL='0' order by SDATE desc ";
            $result_artrn = $db->RunQuery($sql_artrn);
            $row_artrn = mysql_fetch_array($result_artrn);
            //echo "sp1".$row_artrn["REFNO"]."</br>";

            $result_artrn = $db->RunQuery($sql_artrn);
            //$last = mysql_num_rows($result_artrn);
            //$rownum = 0;
            //echo $balqty."---";
            while ($balqty != 0) {
                // if ($last >= $rownum) {

                if ($row_artrn = mysql_fetch_array($result_artrn)) {
                    //echo "1-".$row_artrn["REFNO"]."</br>";

                    $update = 0;

                    $SUP_NAME = "";
                    $LCNO = "";
                    $ARVALUE = 0;
                    $period = 0;
                    $monsales = 0;
                    $UN_QTY = 0;
                    $sold = 0;

                    $sql_armas = "select * from s_purmas where REFNO='" . $row_artrn["REFNO"] . "' ";
                    $result_armas = $db->RunQuery($sql_armas);
                    if ($row_armas = mysql_fetch_array($result_armas)) {
                        $SUP_NAME = trim($row_armas["SUP_NAME"]);
                        $LCNO = trim($row_armas["LCNO"]);
                    }

                    if ($_SESSION['dev'] == '1') {
                        $ARVALUE = $row_artrn["COST"] * $row_artrn["REC_QTY"];
                    } else if ($_SESSION['dev'] == '0') {
                        $ARVALUE = $row_artrn["acc_cost"] * $row_artrn["REC_QTY"];
                    }

                    $period = (strtotime(date("Y-m-d")) - strtotime($row_artrn["SDATE"]) ) / (60 * 60 * 24);


                    //if ($row_smas["STK_NO"]=="06398"){
                    //	echo $row_artrn["REFNO"]."===".date("Y-m-d")." / ".$row_artrn["SDATE"]." - ".$period."</br>";
                    //}

                    if ($balqty > $row_artrn["REC_QTY"]) {
                        $monsales = 0;
                        $UN_QTY = $row_artrn["REC_QTY"];

                        if ($_SESSION['dev'] == '1') {
                            $sold = $row_artrn["COST"];
                        } else if ($_SESSION['dev'] == '0') {
                            $sold = $row_artrn["acc_cost"];
                        }

                        $balqty = $balqty - $row_artrn["REC_QTY"];

                        $update = 1;
                    } else {
                        $salqty = 0;

                        $date = $row_armas["SDATE"];
                        $date = strtotime(date("Y-m-d", strtotime($date)) . " +30 days");
                        $caldate = date("Y-m-d", $date);

                        $sql_saltr = "select qty from s_invo where STK_NO='" . $row_smas["STK_NO"] . "' and CANCELL='0' and (SDATE>'" . $row_artrn["SDATE"] . "' or SDATE='" . $row_artrn["SDATE"] . "') and SDATE<'" . $caldate . "'";
                        $result_saltr = $db->RunQuery($sql_saltr);
                        while ($row_saltr = mysql_fetch_array($result_saltr)) {
                            $salqty = $salqty + $row_saltr["qty"];
                        }
                        $UN_QTY = $balqty;

                        if ($_SESSION['dev'] == '1') {
                            $monsales = $row_artrn["COST"] * ($salqty - $row_artrn["QTYINHAND"]);
                            $sold = $row_artrn["COST"];
                        } else if ($_SESSION['dev'] == '0') {
                            $monsales = $row_artrn["acc_cost"] * ($salqty - $row_artrn["QTYINHAND"]);
                            $sold = $row_artrn["acc_cost"];
                        }
                        $balqty = 0;
                        $update = 0;
                    }

                    if ($i != 0) {
                        $insert = $insert . ", ";
                    }

                    $insert = $insert . "('" . $row_artrn["SDATE"] . "', '" . $row_artrn["REFNO"] . "', '" . $row_smas["STK_NO"] . "', '" . $row_smas["DESCRIPT"] . "', '" . $row_smas["PART_NO"] . "', " . $row_smas["QTYINHAND"] . ", " . $row_artrn["REC_QTY"] . ", '" . trim($row_smas["BRAND_NAME"]) . "', '" . $SUP_NAME . "', '" . $LCNO . "', " . $ARVALUE . ", " . $period . ", " . $monsales . ", " . $UN_QTY . ", " . $sold . ", '" . $_SESSION["CURRENT_USER"] . "')";

                    $i = 1;


                    //$sqltmp = "insert into tmparmove(ardate, AR_NO, STK_NO, des, PART_NO, qty_hnd, AR_QTY, brand, SUPPLIER, LC_NO, ARVALUE, period, monsales, UN_QTY, sold) values ('" . $row_artrn["SDATE"] . "', '" . $row_artrn["REFNO"] . "', '" . $row_smas["STK_NO"] . "', '" . $row_smas["DESCRIPT"] . "', '" . $row_smas["PART_NO"] . "', " . $row_smas["QTYINHAND"] . ", " . $row_artrn["REC_QTY"] . ", '" . $row_smas["BRAND_NAME"] . "', '" . $SUP_NAME . "', '" . $LCNO . "', " . $ARVALUE . ", " . $period . ", " . $monsales . ", " . $UN_QTY . ", " . $sold . ") ";
                    //echo $sqltmp."</br>";
                    //$resulttmp = $db->RunQuery($sqltmp);
                    //$row_artrn = mysql_fetch_assoc($result_artrn);
                    /*
                      if ($update==1){
                      $row_artrn = mysql_fetch_assoc($result_artrn);
                      } */
                    $update = 0;
                } else {
                    //exit();
                    $balqty = 0;
                }
                //} else {
                //	exit();
                // }		
            }
        }

        $sql_RSMONSALES = "insert into tmparmove(ardate, AR_NO, STK_NO, des, PART_NO, qty_hnd, AR_QTY, brand, SUPPLIER, LC_NO, ARVALUE, period, monsales, UN_QTY, sold, user_id) values " . $insert;
        //echo $sql_RSMONSALES;
        $result_RSMONSALES = $db->RunQuery($sql_RSMONSALES);

        if ($_GET["cmbtype"] == "All") {
            $sql_rst = "select * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "'";
        }
        if ($_GET["cmbtype"] == "Over") {
            $sql_rst = "select * from tmparmove where period>" . $daysover . " and user_id='" . $_SESSION["CURRENT_USER"] . "'";
        }
        if ($_GET["cmbtype"] == "Between") {
            $sql_rst = "select * from tmparmove where period>" . $daysover . " and period<" . $daysbel . " and user_id='" . $_SESSION["CURRENT_USER"] . "'";
        }

        $result_rst = $db->RunQuery($sql_rst);
        while ($row_rst = mysql_fetch_array($result_rst)) {

            if ($row_rst["period"] < 31) {
                $b30 = $b30 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 30) and ( $row_rst["period"] < 46)) {
                $o36b45 = $o36b45 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 45) and ( $row_rst["period"] < 61)) {
                $o46b60 = $o46b60 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 60) and ( $row_rst["period"] < 76)) {
                $o61b75 = $o61b75 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 75) and ( $row_rst["period"] < 91)) {
                $o76b91 = $o76b91 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 90) and ( $row_rst["period"] < 160)) {
                $o91 = $o91 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if (($row_rst["period"] > 160)) {
                $o160 = $o160 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
            if ((is_null($row_rst["sold"]) == false) and ( is_null($row_rst["UN_QTY"]) == false)) {
                $total = $total + ($row_rst["UN_QTY"] * $row_rst["sold"]);
            }
        }


//==================PrinT SUMMERY REP+++++++++++++++++
        if ($_GET["unsold"] == "summery") {
            printSummery();
            exit();
        }
        if ($_GET["unsold"] == "stock") {
            stock_repo();
            exit();
        }
//===================================================

        $sql_head = "select * from invpara";
        $result_head = $db->RunQuery($sql_head);
        $row_head = mysql_fetch_array($result_head);

        $txtrepono = $_SESSION["CURRENT_USER"] . " " . date("Y-m-d") . "  " . date("H:i:s");

        if ($_GET["cmbtype"] == "All") {
            $sql = "SELECT * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "' order by STK_NO,brand,ardate";
            $txtdays = " All Stock";
        }
        if ($_GET["cmbtype"] == "Over") {
            $sql = "SELECT * from tmparmove where period>" . $daysover . " and user_id='" . $_SESSION["CURRENT_USER"] . "' order by STK_NO,brand,ardate";
            $txtdays = " Over  " . $daysover . "  days Stock";
        }
        if ($_GET["cmbtype"] == "Between") {
            $sql = "SELECT * from tmparmove where period>" . $daysover . " and period<" . $daysbel . " and user_id='" . $_SESSION["CURRENT_USER"] . "' order by STK_NO,brand,ardate";
            $txtdays = " Over  " . $daysover . "  Bellow   " . $daysbel . "  days Stock";
        }
        ?>

        <center><table width="1400" >
                <tr>
                    <th colspan="13" scope="col"><?php echo $row_head["COMPANY"]; ?></th>
                </tr>
                <tr>
                    <th colspan="13" scope="col"><?php echo $row_head["ADD1"] . " , " . $row_head["ADD2"]; ?></th>
                </tr>
                <tr>
                    <td colspan="3">AR Moving Report</td>
                    <td colspan="7" align="center"><?php echo $txtdays; ?></td>
                    <td colspan="3" align="right"><?php echo date("Y-m-d"); ?></td>
                </tr>
            </table>
            <table width="1400" border="1">
                <tr>
                    <th> Stock No</th>
                    <th >Description</th>
                    <th >Part No</th>
                    <th>Qty In Hand</th>
                    <th>No of Days</th>
                    <th>Un Sold Stock</th>
                    <th>L/C No</th>
                    <th>AR Date</th>
                    <th>AR No</th>
                    <th>AR Qty</th>
                    <th>Total Value</th>
                    <th>Cost Value</th>
                    <th>Unsold Value</th></tr>
                <?php
                $brand = "";
                $STK_NO = "";

//mysql_data_seek($result, 0);	
//echo $sql;
                $result = $db->RunQuery($sql);
                while ($rows = mysql_fetch_array($result)) {

                    if (trim($brand) != trim($rows["brand"])) {

                        if ($brand != "") {
                            echo "<tr>";
                            echo "<td>&nbsp;</td>";
                            echo "<td >&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td colspan=9>&nbsp;</td>";
                            echo "<td align=\"right\"><b>" . number_format($ltot, 2, ".", ",") . "</b></td>";
                            $ltot = 0;
                            echo "</tr>";
                        }
                        echo "<tr>
		<td align=\"left\" colspan=13><b>" . $rows["brand"] . "</b></td></tr>";
                        $brand = trim($rows["brand"]);
                    }
                    if ($STK_NO != $rows["STK_NO"]) {

                        echo "<tr>";
                        echo "<td>" . $rows["STK_NO"] . "</td>";
                        echo "<td>" . $rows["des"] . "</td>";
                        echo "<td>" . $rows["PART_NO"] . "</td>";
                        echo "<td align=\"right\">" . $rows["qty_hnd"] . "</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td align=\"right\">&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td align=\"right\">&nbsp;</td>";
                        echo "<td align=\"right\">&nbsp;</td>";
                        echo "<td align=\"right\">&nbsp;</td>";
                        echo "<td align=\"right\">&nbsp;</td>";
                        echo "</tr>";
                        $STK_NO = $rows["STK_NO"];
                    }
                    echo "<tr>";
                    echo "<td>&nbsp;</td>";
                    echo "<td >&nbsp;</td>";
                    echo "<td >&nbsp;</td>";
                    echo "<td align=\"right\">&nbsp;</td>";
                    echo "<td>" . $rows["period"] . "</td>";
                    echo "<td align=\"right\">" . $rows["UN_QTY"] . "</td>";
                    echo "<td>" . $rows["LC_NO"] . "</td>";
                    echo "<td>" . $rows["ardate"] . "</td>";
                    echo "<td>" . $rows["AR_NO"] . "</td>";
                    echo "<td align=\"right\">" . $rows["AR_QTY"] . "</td>";
                    echo "<td align=\"right\">" . number_format($rows["ARVALUE"], 2, ".", ",") . "</td>";
                    echo "<td align=\"right\">" . $rows["sold"] . "</td>";
                    echo "<td align=\"right\">" . number_format($rows["sold"] * $rows["UN_QTY"], 2, ".", ",") . "</td>";
                    echo "</tr>";
                    $tot = $tot + ($rows["sold"] * $rows["UN_QTY"]);
                    $ltot = $ltot + ($rows["sold"] * $rows["UN_QTY"]);
                }

                echo "<tr>";
                echo "<td>&nbsp;</td>";
                echo "<td >&nbsp;</td>";
                echo "<td >&nbsp;</td>";
                echo "<td colspan=9>&nbsp;</td>";

                echo "<td align=\"right\"><b>" . number_format($ltot, 2, ".", ",") . "</b></td>";
                $ltot = 0;
                echo "</tr>";


                echo "<td>&nbsp;</td>";
                echo "<td >&nbsp;</td>";
                echo "<td >&nbsp;</td>";
                echo "<td colspan=9>&nbsp;</td>";

                echo "<td align=\"right\"><b>" . number_format($tot, 2, ".", ",") . "</b></td>";
                echo "</tr>";
                ?>
            </table>

            <table width='1200'>
                <tr>

                    <td width='400'><b>Total Value Rs.</b></td>
                    <td align="right" width='200'><b><?php echo number_format($total, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'> <b>Below 30 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($b30, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'><b>Over 31 and Below 45 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o36b45, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'><b>Over 46 and Below 60 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o46b60, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'><b>Over 61 and Below 75 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o61b75, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'><b>Over 76  and Below 90 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o76b91, 2, ".", ","); ?></b></td>
                    <td width='600'></td>

                </tr>
                <tr>
                    <td width='400'><b>Over 90 and Below 160 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o91, 2, ".", ","); ?></b></td>
                    <td width='600'></td>
                </tr>
                <tr>
                    <td width='400'><b>Over 160 Days Stock Rs.</b></td>
                    <td align="right"><b><?php echo number_format($o160, 2, ".", ","); ?></b></td>
                    <td width='600'></td>
                </tr>

            </table>

            <?php

            function printSummery() {

                require_once("config.inc.php");
                require_once("DBConnector.php");
                $db = new DBConnector();

                $sql_head = "select * from invpara";
                $result_head = $db->RunQuery($sql_head);
                $row_head = mysql_fetch_array($result_head);

                echo "<center><span class=\"style1\">" . $row_head["COMPANY"] . "</span></center><br>";

                echo "<center>" . date("Y-m-d") . "<center>Un Sold Stock Report</center><br>";

                echo "<center><table width=1000 border=1 cellpadding=\"5\" cellspacing=\"0\"><tr>
		<th>Brand</th><th>Bellow 60</th><th>60 to 90</th><th>90 to 120</th><th>Over 120</th><th>Total Stock</th>
		<th>Total Over 90</th><th>%</th></tr>";

                $bellow60_tot = 0;
                $bet60_90_tot = 0;
                $bet90_120_tot = 0;
                $over120_tot = 0;
                $totstk_tot = 0;
                $totover90_tot = 0;

                if ($_GET["cmbtype"] == "All") {
                    $sql = "select distinct brand from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "' order by brand";
                }
                if ($_GET["cmbtype"] == "Over") {
                    $sql = "select distinct brand from tmparmove where period>" . $_GET["over"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "'  order by brand";
                }
                if ($_GET["cmbtype"] == "Between") {
                    $sql = "select distinct brand from tmparmove where period>" . $_GET["over"] . " and period<" . $_GET["between"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "' order by brand";
                }
                $result = $db->RunQuery($sql);
                while ($rows = mysql_fetch_array($result)) {

                    if ($_GET["cmbtype"] == "All") {
                        $sql = "select sum(UN_QTY * sold) as bellow60 from tmparmove where  brand='" . $rows["brand"] . "' and period < 61 and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    if ($_GET["cmbtype"] == "Over") {
                        $sql = "select sum(UN_QTY * sold) as bellow60 from tmparmove where  brand='" . $rows["brand"] . "' and period < 61  and period>" . $_GET["over"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "' ";
                    }
                    if ($_GET["cmbtype"] == "Between") {
                        $sql = "select sum(UN_QTY * sold) as bellow60 from tmparmove where  brand='" . $rows["brand"] . "' and period < 61 and (period>" . $_GET["over"] . " and period<" . $_GET["between"] . ") and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }

                    $result1 = $db->RunQuery($sql);
                    $rows1 = mysql_fetch_array($result1);
                    $bellow60 = $rows1["bellow60"];
                    if (is_null($bellow60)) {
                        $bellow60 = 0;
                    }

                    if ($_GET["cmbtype"] == "All") {
                        $sql = "select sum(UN_QTY * sold) as bet60_90 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 60 and period < 91) and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    if ($_GET["cmbtype"] == "Over") {
                        $sql = "select sum(UN_QTY * sold) as bet60_90 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 60 and period < 91)  and period>" . $_GET["over"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "' ";
                    }
                    if ($_GET["cmbtype"] == "Between") {
                        $sql = "select sum(UN_QTY * sold) as bet60_90 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 60 and period < 91) and (period>" . $_GET["over"] . " and period<" . $_GET["between"] . ") and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    $result1 = $db->RunQuery($sql);
                    $rows1 = mysql_fetch_array($result1);
                    $bet60_90 = $rows1["bet60_90"];
                    if (is_null($bet60_90)) {
                        $bet60_90 = 0;
                    }

                    if ($_GET["cmbtype"] == "All") {
                        $sql = "select sum(UN_QTY * sold) as bet90_120 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 90 and period < 121) and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    if ($_GET["cmbtype"] == "Over") {
                        $sql = "select sum(UN_QTY * sold) as bet90_120 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 90 and period < 121)  and period>" . $_GET["over"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "' ";
                    }
                    if ($_GET["cmbtype"] == "Between") {
                        $sql = "select sum(UN_QTY * sold) as bet90_120 from tmparmove where  brand='" . $rows["brand"] . "' and (period > 90 and period < 121) and (period>" . $_GET["over"] . " and period<" . $_GET["between"] . ") and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    $result1 = $db->RunQuery($sql);
                    $rows1 = mysql_fetch_array($result1);
                    $bet90_120 = $rows1["bet90_120"];
                    if (is_null($bet90_120)) {
                        $bet90_120 = 0;
                    }

                    if ($_GET["cmbtype"] == "All") {
                        $sql = "select sum(UN_QTY * sold) as over120 from tmparmove where  brand='" . $rows["brand"] . "' and period > 120 and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    if ($_GET["cmbtype"] == "Over") {
                        $sql = "select sum(UN_QTY * sold) as over120 from tmparmove where  brand='" . $rows["brand"] . "' and period > 120  and period>" . $_GET["over"] . " and user_id='" . $_SESSION["CURRENT_USER"] . "' ";
                    }
                    if ($_GET["cmbtype"] == "Between") {
                        $sql = "select sum(UN_QTY * sold) as over120 from tmparmove where  brand='" . $rows["brand"] . "' and period > 120 and (period>" . $_GET["over"] . " and period<" . $_GET["between"] . ") and user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    $result1 = $db->RunQuery($sql);
                    $rows1 = mysql_fetch_array($result1);
                    $over120 = $rows1["over120"];
                    if (is_null($over120)) {
                        $over120 = 0;
                    }

                    $totstk = $bellow60 + $bet60_90 + $bet90_120 + $over120;
                    $totover90 = $bet90_120 + $over120;

                    $bellow60_tot = $bellow60_tot + $bellow60;
                    $bet60_90_tot = $bet60_90_tot + $bet60_90;
                    $bet90_120_tot = $bet90_120_tot + $bet90_120;
                    $over120_tot = $over120_tot + $over120;
                    $totstk_tot = $totstk_tot + $totstk;
                    $totover90_tot = $totover90_tot + $totover90;

                    echo "<tr><td  width=150>" . $rows["brand"] . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($bellow60, 2, ".", ",") . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($bet60_90, 2, ".", ",") . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($bet90_120, 2, ".", ",") . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($over120, 2, ".", ",") . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($totstk, 2, ".", ",") . "</td>"
                    . "<td width=100 align=\"right\">" . number_format($totover90, 2, ".", ",") . "</td>";
                    if ($totstk <> 0) {
                        $pers = $totover90 / $totstk * 100;
                    } else {
                        $pers = 0;
                    }
                    echo "<td align=\"right\">" . number_format($pers, 2, ".", ",") . "</td></tr>";
                }

                echo "<tr><td align=\"right\">$nbsp</td><td align=\"right\"><b>" . number_format($bellow60_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>" . number_format($bet60_90_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>" . number_format($bet90_120_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>" . number_format($over120_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>" . number_format($totstk_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>" . number_format($totover90_tot, 2, ".", ",") . "</b></td><td align=\"right\"><b>100.00</b></td></tr>";
            }

            function stock_repo() {
                require_once("config.inc.php");
                require_once("DBConnector.php");
                $db = new DBConnector();
                $sql_head = "select * from invpara";


                $daysover = $_GET["over"];
                $daysbel = $_GET["between"];


                $result_head = $db->RunQuery($sql_head);
                $row_head = mysql_fetch_array($result_head);

                $txtrepono = $_SESSION["CURRENT_USER"] . " " . date("Y-m-d") . "  " . date("H:i:s");

                if ($_GET["cmbtype"] == "All") {
                    $sql = "SELECT * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "'  order by brand ";
                    $txtdays = " All Stock";
                }
                if ($_GET["cmbtype"] == "Over") {
                    $sql = "SELECT * from tmparmove where period>" . $daysover . " and user_id='" . $_SESSION["CURRENT_USER"] . "' order by brand";
                    $txtdays = " Over  " . $daysover . "  days Stock";
                }
                if ($_GET["cmbtype"] == "Between") {
                    $sql = "SELECT * from tmparmove where period>" . $daysover . " and period<" . $daysbel . " and user_id='" . $_SESSION["CURRENT_USER"] . "' order by brand";
                    $txtdays = " Over  " . $daysover . "  Bellow   " . $daysbel . "  days Stock";
                }
                ?>

                <center><table width="900" >
                        <tr>
                            <th colspan="13" scope="col"><?php echo $row_head["COMPANY"]; ?></th>
                        </tr>
                        <tr>
                            <th colspan="13" scope="col"><?php echo $row_head["ADD1"] . " , " . $row_head["ADD2"]; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3">AR Moving Report</td>
                            <td colspan="7" align="center"><?php echo $txtdays; ?></td>
                            <td colspan="3" align="right"><?php echo date("Y-m-d"); ?></td>
                        </tr>
                    </table>
                    <table width="900" border="1">
                        <tr>
                            <th> Stock No</th>
                            <th >Description</th>
                            <th >Part No</th>
                            <th>Qty In Hand</th>
                            <th>No of Days</th>
                            <th>Un Sold Stock</th>

                            <th>AR Date</th>

                            <th>AR Qty</th>

                            <th>Unsold Value</th></tr>
                        <?php
                        $brand = "";
                        $STK_NO = "";

//mysql_data_seek($result, 0);	
//echo $sql;
                        $result = $db->RunQuery($sql);
                        while ($rows = mysql_fetch_array($result)) {

                            if ($brand != $rows["brand"]) {

                                if ($brand != "") {
                                    echo "<tr>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td >&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td colspan=5>&nbsp;</td>";
                                    echo "<td align=\"right\"><b>" . number_format($ltot, 2, ".", ",") . "</b></td>";
                                    $ltot = 0;
                                    echo "</tr>";
                                }
                                echo "<tr>
		<td align=\"left\" colspan=13><b>" . $rows["brand"] . "</b></td></tr>";
                                $brand = $rows["brand"];
                            }
                            if ($STK_NO != $rows["STK_NO"]) {

                                echo "<tr>";
                                echo "<td>" . $rows["STK_NO"] . "</td>";
                                echo "<td>" . $rows["des"] . "</td>";
                                echo "<td>" . $rows["PART_NO"] . "</td>";
                                echo "<td align=\"right\">" . $rows["qty_hnd"] . "</td>";
                                echo "<td>&nbsp;</td>";
                                echo "<td align=\"right\">&nbsp;</td>";

                                echo "<td>&nbsp;</td>";
                                echo "<td>&nbsp;</td>";
                                echo "<td align=\"right\">&nbsp;</td>";

                                echo "</tr>";
                                $STK_NO = $rows["STK_NO"];
                            }
                            echo "<tr>";
                            echo "<td>&nbsp;</td>";
                            echo "<td >&nbsp;</td>";
                            echo "<td >&nbsp;</td>";
                            echo "<td align=\"right\">&nbsp;</td>";
                            echo "<td>" . $rows["period"] . "</td>";
                            echo "<td align=\"right\">" . $rows["UN_QTY"] . "</td>";

                            echo "<td>" . $rows["ardate"] . "</td>";

                            echo "<td align=\"right\">" . $rows["AR_QTY"] . "</td>";


                            echo "<td align=\"right\">" . number_format($rows["sold"] * $rows["UN_QTY"], 2, ".", ",") . "</td>";
                            echo "</tr>";
                            $tot = $tot + ($rows["sold"] * $rows["UN_QTY"]);
                            $ltot = $ltot + ($rows["sold"] * $rows["UN_QTY"]);
                        }

                        echo "<tr>";
                        echo "<th>&nbsp;</th>";
                        echo "<th >&nbsp;</th>";
                        echo "<th >&nbsp;</th>";
                        echo "<th colspan=5>&nbsp;</th>";

                        echo "<th align=\"right\"><b>" . number_format($ltot, 2, ".", ",") . "</b></th>";
                        $ltot = 0;
                        echo "</tr>";


                        echo "<th>&nbsp;</th>";
                        echo "<th >&nbsp;</th>";
                        echo "<th >&nbsp;</th>";
                        echo "<th colspan=5>&nbsp;</th>";

                        echo "<th align=\"right\"><b>" . number_format($tot, 2, ".", ",") . "</b></th>";
                        echo "</tr>";
                        ?>
                    </table>

                    <?php
                    if ($_GET["cmbtype"] == "All") {
                        $sql_rst = "select * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "'";
                    }
                    if ($_GET["cmbtype"] == "Over") {
                        $sql_rst = "select * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "' and period>" . $daysover;
                    }
                    if ($_GET["cmbtype"] == "Between") {
                        $sql_rst = "select * from tmparmove where user_id='" . $_SESSION["CURRENT_USER"] . "' and period>" . $daysover . " and period<" . $daysbel;
                    }

                    $result_rst = $db->RunQuery($sql_rst);
                    while ($row_rst = mysql_fetch_array($result_rst)) {

                        if ($row_rst["period"] < 31) {
                            $b30 = $b30 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        if (($row_rst["period"] > 30) and ( $row_rst["period"] < 46)) {
                            $o36b45 = $o36b45 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        if (($row_rst["period"] > 45) and ( $row_rst["period"] < 61)) {
                            $o46b60 = $o46b60 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        if (($row_rst["period"] > 60) and ( $row_rst["period"] < 76)) {
                            $o61b75 = $o61b75 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        if (($row_rst["period"] > 75) and ( $row_rst["period"] < 91)) {
                            $o76b91 = $o76b91 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        if ($row_rst["period"] > 90) {
                            $o91 = $o91 + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                        
                        if ((is_null($row_rst["sold"]) == false) and ( is_null($row_rst["UN_QTY"]) == false)) {
                            $total = $total + ($row_rst["UN_QTY"] * $row_rst["sold"]);
                        }
                    }
                    ?>

                    <table width='900'>
                        <tr>
                            <td width='400'><b>Total Value Rs.</b></td>
                            <td align="right" width='200'><b><?php echo number_format($total, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'> <b>Below 30 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($b30, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'><b>Over 31 and Below 45 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($o36b45, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'><b>Over 46 and Below 60 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($o46b60, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'><b>Over 61 and Below 75 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($o61b75, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'><b>Over 76  and Below 90 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($o76b91, 2, ".", ","); ?></b></td>
                            <td width='600'></td>

                        </tr>
                        <tr>
                            <td width='400'><b>Over 90 Days Stock Rs.</b></td>
                            <td align="right"><b><?php echo number_format($o91, 2, ".", ","); ?></b></td>
                            <td width='600'></td>
                        </tr>
                    </table>

                <?php }
                ?>
                </body>
                </html>
