<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {

    $tb = "";
    $tb .= "<table class='table table-hover'>";


    $sql = "select * from master_borrower order by b_code";




    $tb .= "<tr>";
    $tb .= "<th class=\"succes;\" style=\"width: 350px;\">Borrower Code</th>";
    $tb .= "<th style=\"width: 500px;\">Borrower Name</th>";
    $tb .= "<th style=\"width: 350px;\">Borrower Address</th>";
    $tb .= "<th style=\"width: 350px;\">Borrower Telephone</th>";


    $tb .= "</tr>";

    foreach ($conn->query($sql) as $row) {
        $tb .= "<tr>";
        $tb .= "<td onclick=\"getcode('" . $row['b_code'] . "','" . $row['b_name'] . "','" . $row['b_add'] . "','" . $row['b_tel'] . "')\">" . $row['b_code'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['b_code'] . "','" . $row['b_name'] . "','" . $row['b_add'] . "','" . $row['b_tel'] . "')\">" . $row['b_name'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['b_code'] . "','" . $row['b_name'] . "','" . $row['b_add'] . "','" . $row['b_tel'] . "')\">" . $row['b_add'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['b_code'] . "','" . $row['b_name'] . "','" . $row['b_add'] . "','" . $row['b_tel'] . "')\">" . $row['b_tel'] . "</td>";
        $tb .= "</tr>";
    }
    $tb .= "</table>";

    echo $tb;
}


if ($_GET["Command"] == "add_table") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command2"] == "add_three") {
        $sql5 = "Insert into tmp_costing_t3(`tmp_no`,`other`,`discription2`,`qty2`,`unit_price2`,`avg_price2`,`value2`)values
			('" . $_GET['tmpno'] . "', '" . $_GET['other'] . "', '" . $_GET['Desc2'] . "', '" . $_GET['qty2'] . "', '" . $_GET['unit2'] . "', '" . $_GET['avg2'] . "', '" . $_GET['value2'] . "') ";
        $result = $conn->query($sql5);
//        echo $sql5;
    }

    $ResponseXML .= "<sales_tablee><![CDATA[<table class=\"table\">
					<tr>
                        <td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
					</tr>";


    $sql1 = "Select * from tmp_costing_t3 where tmp_no='" . $_GET['tmp_no'] . "'";

    foreach ($conn->query($sql1) as $row) {

        $ResponseXML .= "<tr>
                            <td>" . $row['other'] . "</td>
                            <td>" . $row['discription2'] . "</td>
							<td>" . $row['qty2'] . "</td>
							<td>" . $row['unit_price2'] . "</td>
							<td>" . $row['avg_price2'] . "</td>
							<td>" . $row['value2'] . "</td>
							<td><a class=\"btn btn-danger btn-xs\"><span class='fa fa-remove'></span></a></td>
						</tr>";
    }

    $ResponseXML .= "</table>]]></sales_tablee>";

    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}




if ($_GET["Command"] == "add_table1") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command2"] == "add_three1") {
        $sql5 = "Insert into tmp_overHead_t(`tmp_no`,`over_head`,`descritption`,`rate`,`value`)values
			('" . $_GET['tmpno'] . "', '" . $_GET['overHead'] . "', '" . $_GET['Desc3'] . "', '" . $_GET['rate'] . "', '" . $_GET['val'] . "') ";
        $result = $conn->query($sql5);
//        echo $sql5;
    }

    $ResponseXML .= "<sales_tablee><![CDATA[<table class=\"table\">
					<tr>
                        <td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
					</tr>";


    $sql1 = "Select * from tmp_overHead_t where tmp_no='" . $_GET['tmp_no'] . "'";

    foreach ($conn->query($sql1) as $row) {

        $ResponseXML .= "<tr>
                            <td>" . $row['over_head'] . "</td>
                            <td>" . $row['descritption'] . "</td>
							<td>" . $row['rate'] . "</td>
							<td>" . $row['value'] . "</td>
							<td><a class=\"btn btn-danger btn-xs\"><span class='fa fa-remove'></span></a></td>
						</tr>";
    }

    $ResponseXML .= "</table>]]></sales_tablee>";

    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "add_table2") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command2"] == "add_three2") {
        $sql5 = "Insert into tmp_costing_overhead_t2(`tmp_no`,`stage`,`st_desc`,`select`)values
			('" . $_GET['tmpno'] . "', '" . $_GET['stage'] . "', '" . $_GET['stDesc'] . "', '" . $_GET['select'] . "') ";
        $result = $conn->query($sql5);
//        echo $sql5;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
                        <td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
					</tr>";


    $sql1 = "Select * from tmp_costing_overhead_t2 where tmp_no='" . $_GET['tmp_no'] . "'";

    foreach ($conn->query($sql1) as $row) {

        $ResponseXML .= "<tr>
                            <td>" . $row['stage'] . "</td>
                            <td>" . $row['st_desc'] . "</td>
							<td>" . $row['select'] . "</td>
							<td><a class=\"btn btn-danger btn-xs\"><span class='fa fa-remove'></span></a></td>
						</tr>";
    }

    $ResponseXML .= "</table>]]></sales_table>";

    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}










if ($_GET["Command"] == "kalifa") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command2"] == "add") {
        $sql5 = "Insert into tmp_costing_t(`tmp_no`,`ink`,`discription1`,`qty1`,`unit_price1`,`avg_price`,`value`)values
			('" . $_GET['tmpno'] . "', '" . $_GET['ink'] . "', '" . $_GET['Desc1'] . "', '" . $_GET['qty1'] . "', '" . $_GET['unit1'] . "', '" . $_GET['avg1'] . "', '" . $_GET['value1'] . "') ";
        $result = $conn->query($sql5);
//        echo $sql5;
    }

    $ResponseXML .= "<sales_tablee><![CDATA[<table class=\"table\">
					<tr>
                        <td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
					</tr>";


    $sql1 = "Select * from tmp_costing_t where tmp_no='" . $_GET['tmp_no'] . "'";

    foreach ($conn->query($sql1) as $row) {

        $ResponseXML .= "<tr>
                            <td>" . $row['ink'] . "</td>
                            <td>" . $row['discription1'] . "</td>
							<td>" . $row['qty1'] . "</td>
							<td>" . $row['unit_price1'] . "</td>
							<td>" . $row['avg_price'] . "</td>
							<td>" . $row['value'] . "</td>
							<td><a class=\"btn btn-danger btn-xs\"><span class='fa fa-remove'></span></a></td>
						</tr>";
    }

    $ResponseXML .= "</table>]]></sales_tablee>";

    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}


if ($_GET["Command"] == "pass_quot") {

    $stname = "";
    if (isset($_GET["stname"])) {
        $stname = $_GET["stname"];
    }

//    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from costing_details where ref_no='" . $cuscode . "'";
    $sql = $conn->query($sql);

    $inkQty = 0.00;
    $inkCost = 0.00;

    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['ref_no'] . "]]></id>";
        $ResponseXML .= "<cod><![CDATA[" . $row['co_date'] . "]]></cod>";
        $ResponseXML .= "<nameref><![CDATA[" . $row['customer'] . "]]></nameref>";


   $sqlC = "Select NAME from vendor where CODE = '" . $row['customer'] . "'";
            $result = $conn->query($sqlC);
            $rowC = $result->fetch();

            $Cust = $rowC['NAME'];
        $ResponseXML .= "<name><![CDATA[" . $Cust . "]]></name>";
        $ResponseXML .= "<bodytable><![CDATA[" . $row['bodytable'] . "]]></bodytable>";
        $ResponseXML .= "<drf><![CDATA[" . $row['drf_no'] . "]]></drf>";
        $ResponseXML .= "<desc><![CDATA[" . $row['description'] . "]]></desc>";
        $ResponseXML .= "<pro1><![CDATA[" . $row['product_one'] . "]]></pro1>";


        $sqlitem = "Select DESCRIPT from s_mas where STK_NO = '" . $row['product_one'] . "'";
            $result = $conn->query($sqlitem);
            $rowitem = $result->fetch();

            $prodes = $rowitem['DESCRIPT'];

        $ResponseXML .= "<proname><![CDATA[" . $prodes . "]]></proname>";

        $ResponseXML .= "<pro2><![CDATA[" . $row['product_two'] . "]]></pro2>";
        $ResponseXML .= "<req><![CDATA[" . $row['req_qty'] . "]]></req>";
        $ResponseXML .= "<order><![CDATA[" . $row['order_qty'] . "]]></order>";
        $ResponseXML .= "<feet><![CDATA[" . $row['tot_sqft'] . "]]></feet>";
        $ResponseXML .= "<noimp><![CDATA[" . $row['no_of_imp'] . "]]></noimp>";
        $ResponseXML .= "<COST><![CDATA[" . $row['COST'] . "]]></COST>";
        $ResponseXML .= "<rawWaste><![CDATA[" . $row['rawWaste'] . "]]></rawWaste>";
        $ResponseXML .= "<jobCost><![CDATA[" . $row['jobCost'] . "]]></jobCost>";
        $ResponseXML .= "<selling><![CDATA[" . $row['selling'] . "]]></selling>";

        $ResponseXML .= "<inkQty><![CDATA[" . $row['inkQty'] . "]]></inkQty>";
        $ResponseXML .= "<inkCost><![CDATA[" . $row['inkCost'] . "]]></inkCost>";

        $inkQty = $row['inkQty'];
        $inkCost = $row['inkCost'];

        $ResponseXML .= "<inkCode><![CDATA[" . $row['inkCode'] . "]]></inkCode>";


        $ary = explode("/",$row['inkCode']);
        $inc_ref = intval($ary[1]);
        
        $sqlink = "Select DESCRIPT from s_mas where STK_NO = '" . $inc_ref . "'";
        $result = $conn->query($sqlink);
        $rowink = $result->fetch();



        $ResponseXML .= "<inkDes><![CDATA[" . $rowink[0] . "]]></inkDes>";

       
        
        $ResponseXML .= "<factory><![CDATA[" . $row['factory'] . "]]></factory>";
        
        $ResponseXML .= "<cusCode><![CDATA[" . $row['customer'] . "]]></cusCode>";
        
        $sql = "select ADD1 from vendor where CODE = '" . $row['customer'] . "'";
        $sql = $conn->query($sql);
        $rowVendor = $sql->fetch();
        $ResponseXML .= "<cusName><![CDATA[" . $row['customerName'] . "]]></cusName>";
        $ResponseXML .= "<cusAdd><![CDATA[" . $rowVendor['ADD1'] . "]]></cusAdd>";


        $ResponseXML .= "<matmeasure><![CDATA[" . $row['MMT'] . "]]></matmeasure>";
        $ResponseXML .= "<Total_Cost_per_Unit><![CDATA[" . $row['Total_Cost_per_Unit'] . "]]></Total_Cost_per_Unit>";
        $ResponseXML .= "<Total_Sales_Value><![CDATA[" . $row['totsv'] . "]]></Total_Sales_Value>";
        $ResponseXML .= "<Total_Job_Cost><![CDATA[" . $row['totjc'] . "]]></Total_Job_Cost>";
        $ResponseXML .= "<sidesText><![CDATA[" . $row['sidesText'] . "]]></sidesText>";
        $ResponseXML .= "<noOfUpsTxt><![CDATA[" . $row['noOfUpsTxt'] . "]]></noOfUpsTxt>";
        $ResponseXML .= "<quono><![CDATA[" . $row['quono'] . "]]></quono>";
        
        $ResponseXML .= "<inkAvg><![CDATA[" . $row['inkAvg'] . "]]></inkAvg>";
        $ResponseXML .= "<inkCap><![CDATA[" . $row['inkCap'] . "]]></inkCap>";

    }

    $sqldown = "select * from costing_cal where Cost_fer = '" . $row['ref_no'] . "'";
    foreach ($conn->query($sqldown) as $down) {

    }

    $msg = "<br><div class='col-sm-12'>
<table class='table table-striped'>
<tr class='success'>
        <td colspan='9'><b>Material Cost</b></td>

</tr>
<tr class='success'>
        <th style='width: 120px;'>Item Description</th>
        <th style='width: 10px;'>Item Code</th>
        <th style='width: 10px;'>Item Qty Per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>WAC of Item</th>
        <th style='width: 10px;'>Total Item Qty for the Job</th>
        <th style='width: 5px;'>Wastage Qty</th>
        <th style='width: 5px;'>Wastage Value</th>
</tr>";

    $UCost = 0.00;
    $TCost = 0.00;


    $sql = "select * from s_mas_details where costing_no = '" . $row['ref_no'] . "'";
    foreach ($conn->query($sql) as $rowSubItem) {
        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowSubItem['s_descrip'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowSubItem['s_item'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['qty'], 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['value'], 2, ".", ",") . "</td>";
        $sql = "select acc_cost from s_mas where STK_NO = '" . $rowSubItem['s_item'] . "'";
        $rowItem = $conn->query($sql)->fetch();

        $temp1 = $rowSubItem['value'] * $rowSubItem['qty'];

        $TCost = $temp1 + $TCost;

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['value'] * $row['req_qty'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowItem["acc_cost"], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['total_the_job'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['wqty'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowSubItem['wv'], 2, ".", ",") . "</td>";
        $msg .= "</tr>";

        $UCost = $rowSubItem['value'] + $UCost;
    }


    $inkQty = $row['inkQty']/$row['req_qty'];
    $inkCost = $row['inkCost']/$row['req_qty'];

    $msg .= "<tr>";
    $msg .= "<td style = 'width: 120px;text-align: left;'><b>INK Cost</b></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'>" .  number_format($inkCost, 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'>" . $row['inkCost'] . "</td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td style = 'width: 120px;text-align: left;'><b>Wastage</b></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($row['rawWaste'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($row['rawWaste'] * $row['req_qty'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
    $msg .= "</tr>";

    $totuc = $UCost + $row['rawWaste'];

    $msg .= "<tr style='background-color: burlywood;'>";
    $msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['M_UC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['M_TC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";
    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";

    $msg .= "</tr>";











    $msg .= "<tr class='success'>
            <td colspan='9'><b>Labour</b></td>
        </tr>
    <tr class='success'>
        <th style='width: 120px;'>Labour</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Item Qty per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>Hours</th>
        <th style='width: 10px;'>Total Labour Hours For job</th>
        <th style='width: 10px;'></th>
        <th style='width: 10px;'></th>
        </tr>";

    $UCost = 0.00;
    $TCost = 0.00;
    $TOTH = 0;
    $TOTHO = 0;
    $sql = "select * from var_oh_details where costing_no = '" . $row['ref_no'] . "' and type = 'd'";
    foreach ($conn->query($sql) as $rowVarOh) {
        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowVarOh['s_descrip'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowVarOh['s_item'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value'], 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value_1'], 2, ".", ",") . "</td>";

        $UCost1 = $rowVarOh['unitcost'] * $rowVarOh['value'];



        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($UCost1, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowVarOh['value_1'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowVarOh['total_the_job'] . "</td>";
        
        $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
        
        

        $TOTH = $TOTH + $rowVarOh['total_the_job'];
        $TOTHO = $TOTHO + $rowVarOh['value_1'];
        
        $msg .= "</tr>";
    }

    $sql = "select * from costing_cal where Cost_fer = '" . $cuscode . "'";
    foreach ($conn->query($sql) as $rowcal) {
        $ResponseXML .= "<TC><![CDATA[" . $rowcal['TC1'] . "]]></TC>";
//        $ResponseXML .= "<TC><![CDATA[" . $rowcal['factory'] . "]]></TC>";
    }

    $msg .= "<tr style='background-color: burlywood;'>";
    $msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['L_UC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" .$down['L_TC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $TOTHO . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $TOTH . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";






    $msg .= "<tr class='success'>
        <td colspan='9'><b>Variable Over Head Cost</b></td>

</tr>
    <tr class='success'>
        <th style='width: 120px;'>VOH Description</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Item Qty Per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>Total Units for Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>&nbsp;</th>
        </tr>";

    $sql = "select * from var_oh_details where costing_no = '" . $row['ref_no'] . "' and type = 'v'";


    $temp00092 = 0.00;
    $temp00092tot = 0.00;
    $VOHTJ = 0;
    foreach ($conn->query($sql) as $rowVarOh) {

      $temp00092 = $rowVarOh['unitcost'] * $rowVarOh['value'];
      $temp00092tot = $temp00092tot + $temp00092;

        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowVarOh['s_descrip'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowVarOh['s_item'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value'], 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value_1'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['unitcost'] * $rowVarOh['value'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>&nbsp</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $row['req_qty'] * $rowVarOh['value'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
        
        
        $VOHTJ = $VOHTJ + $row['req_qty'] * $rowVarOh['value'];

        $msg .= "</tr>";

    }





    $msg .= "<tr style='background-color: burlywood;'>";
    $msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['V_UC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($temp00092tot, 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $VOHTJ . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";






    $msg .= "<tr class='success'>
        <td colspan='9'><b>Fixed Over Head Cost</b></td>

</tr>
    <tr class='success'>
        <th style='width: 120px;'>FOH Description</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Qty</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>Total Units for Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>&nbsp;</th>
        </tr>";

    $FOHTJ = 0;
    $sql = "select * from var_oh_details where costing_no = '" . $row['ref_no'] . "' and type = 'f'";
    foreach ($conn->query($sql) as $rowVarOh) {
        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowVarOh['s_descrip'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $rowVarOh['s_item'] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value'], 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['value_1'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowVarOh['unitcost'] * $rowVarOh['value'], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>&nbsp</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $row['req_qty'] * $rowVarOh['value'] . "</td>";
       $msg .= "<td style = 'width: 10px;text-align: left;'>&nbsp</td>";
       $msg .= "<td style = 'width: 10px;text-align: left;'>&nbsp</td>";
    $FOHTJ = $FOHTJ + $row['req_qty'] * $rowVarOh['value'];

        $msg .= "</tr>";
    }

   

    $msg .= "<tr style='background-color: burlywood;'>";
    $msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['F_UC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['F_TC'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $FOHTJ . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    
    $msg .= "</tr>";



    $msg .= "<tr class='success'>";
    $msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'><b>For One Unit</b></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'><b>Total Job Qty</b></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";





    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total VC  ( except Material Cost )</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TVC1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TVC2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total MC + VC</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TMCVC1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TMCVC2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TC1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['TC2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";

    $msg .= "</tr>";



    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3'  style = 'width: 120px;text-align: center;'>Approved Margin</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['AM1'], 2, ".", ",") . "%</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";



    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Before Sales Commission</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['SV1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . $down['SV2'] . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Sales Commission</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['SC1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['SC2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";


    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Sales Price After Sales Commission</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['SPAS1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['SPAS2'], 2, ".", ",") . "</td>";

    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";



    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Net Proft / Marign</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['NP1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['NP2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['NP3']*100, 2, ".", ",") . "%</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";

    $msg .= "<tr>";
    $msg .= "<td>&nbsp;</td>";
    $msg .= "</tr>";

    $totmvmcu = $UCtot1 + $UCtot2 + $UCtot3;
    $totmvmc = $totC1 + $totC2 + $totC3;

    $forcal = $sellingPrice * $cell3;

    $contri = $sellingPrice - $totmvmcu;
    $contrii = $contri / $sellingPrice;
    $contrii = $contrii * 100;



    $msg .= "<tr>";
    $msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Contribution / Margin</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['CON1'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['CON2'], 2, ".", ",") . "</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($down['CON3'], 2, ".", ",") . "%</td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "<td style = 'width: 120px;text-align: left;'></td>";
    $msg .= "</tr>";






    $msg .= "</table></div>";
    $ResponseXML .= "<itemList><![CDATA[" . $msg . "]]></itemList>";

    $sql = "Select * from costing_information where ref_no='" . $cuscode . "'";

    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<length><![CDATA[" . $row['length'] . "]]></length>";
        $ResponseXML .= "<tot_sq_inch><![CDATA[" . $row['tot_sq_inch'] . "]]></tot_sq_inch>";
        $ResponseXML .= "<no_of_ups><![CDATA[" . $row['customer'] . "]]></no_of_ups>";
        $ResponseXML .= "<width><![CDATA[" . $row['width'] . "]]></width>";
        $ResponseXML .= "<tot_sqft><![CDATA[" . $row['tot_sqft'] . "]]></tot_sqft>";
        $ResponseXML .= "<foh_margin><![CDATA[" . $row['foh_margin'] . "]]></foh_margin>";
        $ResponseXML .= "<color><![CDATA[" . $row['color'] . "]]></color>";
        $ResponseXML .= "<no_of_imp><![CDATA[" . $row['no_of_imp'] . "]]></no_of_imp>";
        $ResponseXML .= "<sales_margin><![CDATA[" . $row['sales_margin'] . "]]></sales_margin>";
        $ResponseXML .= "<waste><![CDATA[" . $row['waste'] . "]]></waste>";
        $ResponseXML .= "<no_of_outs><![CDATA[" . $row['no_of_outs'] . "]]></no_of_outs>";
        $ResponseXML .= "<commission_per_unit><![CDATA[" . $row['commission_per_unit'] . "]]></commission_per_unit>";
    }

    $prev = "";

    $sql = "select * from docs where refno = '" . $cuscode . "'";
//    $row2 = $result_v->fetch();
//    echo $sql;
//    while ($row2 = mysqli_fetch_array($result_v)) {
    foreach ($conn->query($sql) as $row2) {
        $filetype = pathinfo($row2['loc'], PATHINFO_EXTENSION);
        $filetype = "application/" . $filetype;

        $prev .= "<div data-fileindex='3' width='160px' height='160px' id='" . $row2['id'] . "'  class='col-sm-12 well'>


                    <object width='460px' height='360px' type='" . $filetype . "' data='" . $row2['loc'] . "'>
                        <div  class='file-preview-other '>

                        </div>
                    </object>

                    <div width='160px' class='file-thumbnail-footer '>
                        <div  title='" . $row2['file_name'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['file_name'] . "</div>
                        <div  title='" . $row2['c_date'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['c_date'] . "</div>
                        <div  class='file-actions'>
                            <div class='file-footer-buttons '>

                                <a href='" . $row2['loc'] . "' download='" . $row2['file_name'] . "'><i class='glyphicon glyphicon glyphicon-save-file'></i></a>
                                <a onclick='removefile(" . $row2['id'] . ")'><i class='glyphicon glyphicon glyphicon-trash hidden'></i></a>
                                <div class='col-md-12'>
                                    <label class=\"col-sm-2\">" . $row['c_date'] . "</label>
                                </div>
                            </div>
                            <div class='clearfix'></div>
                        </div>
                    </div>
                </div> ";
    }








    $ResponseXML .= "<filebox><![CDATA[" . $prev . "]]></filebox>";
    $ResponseXML .= "<stname><![CDATA[" . $stname . "]]></stname>";


    $sql = "Select * from s_mas_details where costing_no ='" . $cuscode . "'";

    $mattable = "<table id='matttable' class='table table-bordered'>
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
$index = 1;
    foreach ($conn->query($sql) as $mtable) {

      $qtywithoutWastage = $mtable['total_the_job']-$mtable['wqty'];
        $mattable .= "<tr onkeyup='myfun(this);'>
                <td>" . $mtable['s_item'] . "</td>
                <td>" . $mtable['s_descrip'] . "</td>
                <td id='wow" . $index . "'>" . $qtywithoutWastage . "</td>
                <td id='wqty" . $index . "' style='background-color: antiquewhite;' contenteditable='true'>" . $mtable['wqty'] . "</td>
                <td id='tot" . $index . "' >" . $mtable['total_the_job'] . "</td>
                <td style='display:none;' id='temp" . $index . "' >" . $mtable['wqty'] . "</td>

            </tr>";

              $index = $index + 1;
    }




    $mattable .= "</tbody>
            </table>";


    $sql = "Select * from var_oh_details where costing_no ='" . $cuscode . "' and type ='d'";


    $mattable .= "<br>";


    $mattable .= "<table id='labtable' class='table table-bordered'>
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

$index = 1;

    foreach ($conn->query($sql) as $ltable) {
        $mattable .= "<tr onkeyup='myfun2(this);'>
                <td>" . $ltable['s_item'] . "</td>
                       <td>" . $ltable['s_descrip'] . "</td>
                <td id='num1" . $index . "'>" . $ltable['total_the_job'] . "</td>
                  <td id='num2" . $index . "'style='background-color: antiquewhite;' contenteditable='true'>0</td>

                <td id='num3" . $index . "'>" . $ltable['total_the_job'] . "</td>
            </tr>";

            $index = $index + 1;

    }

    $mattable .= "</tbody>
            </table>";

    $sql = "SELECT SPAS2 FROM costing_cal where Cost_fer = '" . $cuscode . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $SalesVal = $row['SPAS2'];


    $ResponseXML .= "<SalesVal><![CDATA[" . $SalesVal . "]]></SalesVal>";
    $ResponseXML .= "<mattable><![CDATA[" . $mattable . "]]></mattable>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}






if ($_GET["Command"] == "pass_quott") {


    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from vendor where CODE='" . $cuscode . "'";

    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['NAME'] . "]]></id>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";




    $ResponseXML .= "<table   class=\"table table-bordered\">
                            <tr>
                    <th width=\"121\"  >Ref No</th>
                    <th width=\"424\"  >Customer Name</th>
                    <th width=\"300\"  >Description</th>

                </tr>";

    if ($_GET["mstatus"] == "cusno") {
        $letters = $_GET['cusno'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select ref_no,customerName,description from costing_details where  ref_no like '%$letters%' ";
    } else if ($_GET["mstatus"] == "customername") {
        $letters = $_GET['customername'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select ref_no,customerName,description from costing_details where customerName like '%$letters%' ";
    } else {

        $letters = $_GET['customername'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select ref_no,customerName,description from costing_details where  customerName like '%$letters%' ";
    }
    $sql .= " ORDER BY ref_no limit 50";


    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['ref_no'];
        $stname = $_GET["stname"];

        $ResponseXML .= "<tr>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['ref_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customerName'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['description'] . "</a></td>
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}




if ($_GET["Command"] == "pass_quottt") {


    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from s_mas where STK_NO='" . $cuscode . "'";

    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<id><![CDATA[" . $row['STK_NO'] . "]]></id>";
        $ResponseXML .= "<name><![CDATA[" . $row['DESCRIPT'] . "]]></name>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}












if ($_GET["Command"] == "getdt2") {
    header('Content-Type: text/xml');
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $prev = "";

    $sql = "select * from docs where ref_no = ";
    $result_v = mysqli_query($GLOBALS['dbinv'], $sql);
    while ($row2 = mysqli_fetch_array($result_v)) {

        $filetype = pathinfo($row2['loc'], PATHINFO_EXTENSION);
        $filetype = "application/" . $filetype;

        $prev .= "<div data-fileindex='3' width='160px' height='160px' id='" . $row2['id'] . "'  class='col-sm-12 well'>


                    <object width='460px' height='360px' type='" . $filetype . "' data='" . $row2['loc'] . "'>
                        <div  class='file-preview-other '>

                        </div>
                    </object>

                    <div width='160px' class='file-thumbnail-footer '>
                        <div  title='" . $row2['file_name'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['file_name'] . "</div>
                        <div  title='" . $row2['c_date'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['c_date'] . "</div>
                        <div  class='file-actions'>
                            <div class='file-footer-buttons '>

                                <a href='" . $row2['loc'] . "' download='" . $row2['file_name'] . "'><i class='glyphicon glyphicon glyphicon-save-file'></i></a>
                                <a onclick='removefile(" . $row2['id'] . ")'><i class='glyphicon glyphicon glyphicon-trash'></i></a>
                                <div class='col-md-12'>
                                    <label class=\"col-sm-2\">" . $row['c_date'] . "</label>;
                                </div>
                            </div>
                            <div class='clearfix'></div>
                        </div>
                    </div>
                </div> ";
    }


    $ResponseXML .= "<filebox><![CDATA[" . $prev . "]]></filebox>";


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}












if ($_GET["Command"] == "setitem") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    if ($_GET["Command1"] == "add_tmp") {


        $sql1 = "Insert into tmp_costing_tone(`tmp_no`,`board`,`description`,`qty`,`unit_price`,`average`,`balance`)values
			('" . $_GET['tmpno'] . "', '" . $_GET['bord'] . "', '" . $_GET['Desc'] . "', '" . $_GET['qty'] . "', '" . $_GET['unit'] . "', '" . $_GET['avg'] . "', '" . $_GET['balance'] . "') ";
        $result = $conn->query($sql1);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
                        <td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
						<td style=\"width: 100px;\"></td>
					</tr>";


    $sql1 = "Select * from tmp_costing_tone where tmp_no='" . $_GET['tmpno'] . "'";

    foreach ($conn->query($sql1) as $row) {

        $ResponseXML .= "<tr>
                            <td>" . $row['board'] . "</td>
                            <td>" . $row['description'] . "</td>
							<td>" . $row['qty'] . "</td>
							<td>" . $row['unit_price'] . "</td>
							<td>" . $row['average'] . "</td>
							<td>" . $row['balance'] . "</td>
							<td><a class=\"btn btn-danger btn-xs\"><span class='fa fa-remove'></span></a></td>
						</tr>";
    }

    $ResponseXML .= "</table>]]></sales_table>";



    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}


if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                        <th width=\"121\">Supplier Code</th>
                        <th width=\"424\"> Supplier Name </th>
                        <th width=\"424\">Address </th>
                        <th width=\"121\">Telephone</th>
                    </tr>";


    $sql = "SELECT * from s_mas where itcode <> ''";
    if ($_GET['refno'] != "") {
        $sql .= " and itcode like '%" . $_GET['refno'] . "%'";
    }
    if ($_GET['cusname'] != "") {
        $sql .= " and itname like '%" . $_GET['cusname'] . "%'";
    }
    $stname = $_GET['stname'];

    $sql .= " ORDER BY itcode limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["itcode"];


        $ResponseXML .= "<tr>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itcode'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itname'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['price'] . "</a></td>
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}


if ($_POST["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "select fl_job from costing_details where ref_no = '" . $_POST['code'] . "'";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            if ($row['fl_job'] == "1") {
                exit("Job placed, Cannot Edit!");
            }
        } else {
            $sql = "update invpara set CST = CST+1";
            $conn->exec($sql);
        }

        $sql = "delete from costing_details where ref_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from costing_information where ref_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from s_mas_details where costing_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from var_oh_details where costing_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);



        $sql1 = "Insert into costing_details (ref_no,co_date,drf_no,customer,description,product_one,req_qty,COST,rawWaste,jobCost,inkQty,inkCost,factory,selling,customerName,bodytable,quono,inkCode,totsv,totjc,Total_Cost_per_Unit,noOfUpsTxt,sidesText,MMT,inkAvg,inkCap)values
        ('" . $_POST['code'] . "', '" . $_POST['date'] . "', '" . $_POST['drf'] . "', '" . $_POST['cus'] . "', '" . $_POST['desc'] . "', '" . $_POST['productCode'] . "', '" . $_POST['req'] . "', '" . $_POST['unitCostTxt'] . "', '" . $_POST['unitWasteTxt'] . "', '" . $_POST['unitJobCostTxt'] . "', '" . $_POST['inkQty'] . "', '" . $_POST['inkTotCost'] . "', '" . $_POST['txt_factory'] . "', '" . $_POST['sellingText'] . "', '" . $_POST['cusTextName'] . "', '" . $_POST['fulltable'] . "', '" . $_POST['quoTxt'] . "', '" . $_POST['inkCode'] . "', '" . $_POST['Total_Sales_Value'] . "', '" . $_POST['Total_Job_Cost'] . "', '" . $_POST['Total_Cost_per_Unit'] . "', '" . $_POST['noOfUpsTxt'] . "', '" . $_POST['sidesText'] . "', '" . $_POST['MMT'] . "', '" . $_POST['inkAvg'] . "', '" . $_POST['inkCap'] . "') ";

        $result = $conn->query($sql1);





        $sql2 = "Insert into costing_information (ref_no,length,tot_sq_inch,no_of_ups,width,tot_sqft,foh_margin,color,no_of_imp,sales_margin,waste,no_of_outs,commission_per_unit)values
        ('" . $_POST['code'] . "', '" . $_POST['length'] . "', '" . $_POST['totSqInch'] . "', '" . $_POST['noOfUps'] . "', '" . $_POST['width'] . "', '" . $_POST['totSqft'] . "', '" . $_POST['fohMarginT'] . "', '" . $_POST['color'] . "', '" . $_POST['noOfImp'] . "', '" . $_POST['salesMargin'] . "', '" . $_POST['wasteT'] . "', '" . $_POST['noOfOuts'] . "', '" . $_POST['commissionPerUnit'] . "') ";
        $result = $conn->query($sql2);

//costing down

        $sql = "select * from costing_cal_temp where Cost_fer = '" . $_POST['code'] . "'";
        foreach ($conn->query($sql) as $row) {
            $sql = "insert into costing_cal (Cost_fer,M_UC,M_TC,L_UC,L_TC,V_UC,V_TC,F_UC,F_TC,TVC1,TMCVC1,TC1,AM1,SV1,NP1,CON1,TVC2,TMCVC2,TC2,AM2,SV2,NP2,CON2,NP3,CON3,SC1,SC2,SPAS1,SPAS2) values
                   ('" . $row['Cost_fer'] . "','" . $row['M_UC'] . "','" . $row['M_TC'] . "','" . $row['L_UC'] . "','" . $row['L_TC'] . "','" . $row['V_UC'] . "','" . $row['V_TC'] . "','" . $row['F_UC'] . "','" . $row['F_TC'] . "','" . $row['TVC1'] . "','" . $row['TMCVC1'] . "','" . $row['TC1'] . "','" . $row['AM1'] . "','" . $row['SV1'] . "','" . $row['NP1'] . "','" . $row['CON1'] . "','" . $row['TVC2'] . "','" . $row['TMCVC2'] . "','" . $row['TC2'] . "','" . $row['AM2'] . "','" . $row['SV2'] . "','" . $row['NP2'] . "','" . $row['CON2'] . "','" . $row['NP3'] . "','" . $row['CON3'] . "','" . $row['SC1'] . "','" . $row['SC2'] . "','" . $row['SPAS1'] . "','" . $row['SPAS2'] . "')";
            $conn->exec($sql);
        }

        $sql = "delete from costing_cal_temp where Cost_fer = '" . $_POST['code'] . "'";
        $conn->exec($sql);


        $sql = "select * from tmp_subitem where tmpno = '" . $_POST['code'] . "' and type = 'i'";
        foreach ($conn->query($sql) as $row) {
            $bulkInsert[] = "('" . $_POST["productCode"] . "', '" . $row["s_item"] . "','" . $row["s_descrip"] . "','" . $row["qty"] . "','" . $_POST["code"] . "','" . $row["value"] . "','" . $row["unitcost"] . "','" . $row["total_the_job"] . "','" . $row["wqty"] . "','" . $row["wv"] . "')";
        }
        if (count($bulkInsert) > 0) {
            $sql = "insert into s_mas_details (item_no, s_item, s_descrip, qty, costing_no, value,unitcost,total_the_job,wqty,wv) values " . implode(',', $bulkInsert);
            $conn->exec($sql);
        }

        $sql = "select * from tmp_subitem where tmpno = '" . $_POST['code'] . "' and type in ('f','v','d')";
        foreach ($conn->query($sql) as $row) {
            $bulkInsert1[] = "('" . $_POST["productCode"] . "', '" . $row["s_item"] . "','" . $row["s_descrip"] . "','" . $row["qty"] . "','" . $_POST["code"] . "', '" . $row["type"] . "','" . $row["value"] . "','" . $row["unitcost"] . "','" . $row["total_the_job"] . "','" . $row["wqty"] . "','" . $row["wv"] . "')";
        }
        if (count($bulkInsert1) > 0) {
            $sql = "insert into var_oh_details (item_no, s_item, s_descrip, value, costing_no, type, value_1, unitcost,total_the_job,wqty,wv) values " . implode(',', $bulkInsert1);
            $conn->exec($sql);
        }

        $sql = "delete from tmp_subitem where tmpno = '" . $_POST['code'] . "'";
        $conn->exec($sql);


        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_POST["Command"] == "del_inv") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "select fl_job from costing_details where ref_no = '" . $_POST['code'] . "'";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            if ($row['fl_job'] == "1") {
                exit("Job placed, Cannot Cancel!");
            }
        }

        $sql = "delete from costing_details where ref_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from costing_information where ref_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from s_mas_details where costing_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);
        $sql = "delete from var_oh_details where costing_no = '" . $_POST['code'] . "'";
        $conn->exec($sql);

        $sql = "delete from tmp_subitem where tmpno = '" . $_POST['code'] . "'";
        $conn->exec($sql);

        $conn->commit();
        echo "Cancelled";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "new_inv") {

    $sql = "Select CST from invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();

    $tmpinvno = "000000" . $row["CST"];
    $lenth = strlen($tmpinvno);
    $invno = trim("CS/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    $sql = "SELECT * FROM factrymaster";

    foreach ($conn->query($sql) as $row) {





        $myObj->factryref = $row['factryref'];
        $myObj->factryname = $row['factryname'];
        $myObj->factrydiscription = $row['factrydiscription'];

        $myJSON = json_encode($myObj);

        $ResponseXML .= "<id3><![CDATA[" . $myJSON . "]]></id3>";
    }





    $ResponseXML .= "<invno><![CDATA[" . $invno . "]]></invno>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>
