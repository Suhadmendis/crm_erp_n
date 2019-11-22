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

    $sql = "Select * from s_jobreq where REF_NO='" . $cuscode . "' and cancel='0'";



    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<refno><![CDATA[" . $row['REF_NO'] . "]]></refno>";
        $ResponseXML .= "<cuscode><![CDATA[" . $row['cus_code'] . "]]></cuscode>";
        $ResponseXML .= "<cusname><![CDATA[" . $row['cus_name'] . "]]></cusname>";
        $ResponseXML .= "<sdate><![CDATA[" . $row['SDATE'] . "]]></sdate>";
        $ResponseXML .= "<mark_ex><![CDATA[" . $row['mark_ex'] . "]]></mark_ex>";


        $sqlmark = "SELECT * FROM sales_exe_master where se_ref = '" . $row['mark_ex'] . "'";
        $result = $conn->query($sqlmark);
        $ex_name = $result->fetch();



        $ResponseXML .= "<mark_ex_name><![CDATA[" . $ex_name['se_name'] . "]]></mark_ex_name>";
        $ResponseXML .= "<manual_no><![CDATA[" . $row['manual_no'] . "]]></manual_no>";
        $ResponseXML .= "<jr_qty><![CDATA[" . $row['jr_qty'] . "]]></jr_qty>";
        $ResponseXML .= "<remark><![CDATA[" . $row['remark'] . "]]></remark>";
        $ResponseXML .= "<QUO_NO><![CDATA[" . $row['QUO_NO'] . "]]></QUO_NO>";
        $ResponseXML .= "<COST_NO><![CDATA[" . $row['COST_NO'] . "]]></COST_NO>";
        $ResponseXML .= "<tmpno><![CDATA[" . $row['tmp_no'] . "]]></tmpno>";
        $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

        // $capacity = disk_free_space("C:");
        // $capacity = $capacity/1024;
        // $capacity = $capacity/1024;
        // $capacity = $capacity/1024;

        // $ResponseXML .= "<TED><![CDATA[" . $capacity . "]]></TED>";
        
        // $capacity = disk_total_space("C:");
        // $capacity = $capacity/1024;
        // $capacity = $capacity/1024;
        // $capacity = $capacity/1024;
        //  $ResponseXML .= "<TED><![CDATA[" . $capacity . "]]></TED>";

    }
    $i = 1;
    $ResponseXML .= "<sales_table><![CDATA[<<table class=\"table table-striped\">";
    $ResponseXML .= "<tr>
						<td style=\"width: 90px;\"></td>
						<td></td>
						<td style=\"width: 60px;\"></td>
						<td style=\"width: 10px;\"></td>
					</tr>";




    $sql = "Select * from s_jobreq_trn where REFNO='" . $cuscode . "'";
    foreach ($conn->query($sql) as $row) {

        $ResponseXML .= "<tr>               
                        <td>" . $row['STK_NO'] . "</td>
                        <td>" . $row['DESCRIPt'] . "</td>
                        <td>" . $row['QTY'] . "</td>
			</tr>";
        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";




    $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th width=\"201\">Reference No</th>
                        <th width=\"201\">Customer Name</th>
                        <th width=\"201\">Date</th> 
                </tr>";

    if ($_GET["mstatus"] == "cusno") {
        $letters = $_GET['cusno'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select REF_NO,cus_name,SDATE from s_jobreq where  REF_NO like '%$letters%' and cancel='0' ";
    } else if ($_GET["mstatus"] == "customername") {
        $letters = $_GET['customername'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select REF_NO,cus_name,SDATE from s_jobreq where  cus_name like '%$letters%' and cancel='0' ";
    } else {

        $letters = $_GET['customername'];
        //$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
        $sql = "select REF_NO,cus_name,SDATE from s_jobreq where  REF_NO like '%$letters%' and cancel='0' ";
    }
    $sql .= " ORDER BY REF_NO limit 50";


    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['itemCode'];
        $stname = $_GET["stname"];

        $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['REF_NO'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['cus_name'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['SDATE'] . "</a></td>
                             
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
