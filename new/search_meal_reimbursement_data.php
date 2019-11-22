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


    $sql = "Select * from meal_reimbursement where refno ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $dpt_no = $row['dept'];

        $ResponseXML .= "<id><![CDATA[" . $row['refno'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['reference'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['mr_date'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['dept'] . "]]></str_customername3>";


        $sql2 = "Select * from deptinfo where dpt_no ='" . $dpt_no . "'";
        $result = $conn->query($sql2);
        $row2 = $result->fetch();

        $dpt_name = $row2['dpt_name'];

        $ResponseXML .= "<dpt_name><![CDATA[$dpt_name]]></dpt_name>";
    }
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "updateTable") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $rows = "";



    $sql = "SELECT * FROM meal_reimbursement_table_a WHERE meal_recode = '" . $_GET['reference_no'] . "'";
    $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                            <th style='width: 20%;'>Job No.</th>
                            <th style='width: 20%;'>Amount</th>
                            <th style='width: 20%;'>Equally</th>
                            <th style='width: 20%;'>C.A. Amount</th>
                            <th style='width: 12%;'>Usage</th>
                            <th style='width: 8%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                         <td>
                        <input type='text' placeholder='Job No.' id='jobnum' class='form-control input-sm'>
                    </td>

                    <td>
                        <input  type='text' placeholder='Amount'  id='mramount' class='form-control input-sm'>
                    </td>
                    <td>
                        <input  type='text' placeholder='Equally'  id='equli' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='text' placeholder='C.A. Amount' id='ca_amount' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='text' placeholder='Usage'  id='usage1' class='form-control input-sm'>
                    </td>
                   
                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM meal_reimbursement_table_a WHERE meal_recode = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

//        $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        $rows .= "<tr><td>" . $row2['jobnum'] . "</td><td>" . $row2['mramount'] . "</td><td>" . $row2['equli'] . "</td><td>" . $row2['ca_amount'] . "</td><td>" . $row2['usage_tmp'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows .= "   </table>";




    //----------------------------------------------------------------------------
    $rows2 = "";

    $sql = "SELECT * FROM meal_reimbursement_table_b WHERE emprecid = '" . $_GET['reference_no'] . "'";
    $rows2 .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                            <th style='width: 20%;'>Emp No.</th>
                            <th style='width: 20%;'>Emp Name</th>
                            <th style='width: 20%;'>Amount</th>
                            <th style='width: 20%;'>Out Time & Date</th>
                            <th style='width: 12%;'>Remark</th>
                            <th style='width: 8%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                   <td>
                        <input type='text' placeholder='Emp No.' id='empno' class='form-control input-sm'>
                    </td>

                    <td>
                        <input  type='text' placeholder='Emp Name'  id='empname' class='form-control input-sm'>
                    </td>
                    <td>
                        <input  type='text' placeholder='Amount'  id='mreamb_amount' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='datetime' placeholder='Out Time & Date' id='out_td' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='text' placeholder='Remark'  id='mr_remarks' class='form-control input-sm'>
                    </td>
                   
                    <td><a onclick='add_tmp2();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM meal_reimbursement_table_b WHERE emprecid = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

//        $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        $rows2 .= "<tr><td>" . $row2['empno'] . "</td><td>" . $row2['empname'] . "</td><td>" . $row2['mreamb_amount'] . "</td><td>" . $row2['out_td'] . "</td><td>" . $row2['mr_remarks'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows2 .= "   </table>";
    $ResponseXML .= "<rows2><![CDATA[" . $rows2 . "]]></rows2>";

    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
//    $ResponseXML .= "<rows2><![CDATA[" . $rows2 . "]]></rows2>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET["Command"] == "updateTable2") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $rows2 = "";

    $sql = "SELECT * FROM meal_reimbursement_table_b WHERE emprecid = '" . $_GET['reference_no'] . "'";
    $rows2 .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                            <th style='width: 20%;'>Emp No.</th>
                            <th style='width: 20%;'>Emp Name</th>
                            <th style='width: 20%;'>Amount</th>
                            <th style='width: 20%;'>Out Time & Date</th>
                            <th style='width: 12%;'>Remark</th>
                            <th style='width: 8%;'>Add/Remove</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                   <td>
                        <input type='text' placeholder='Emp No.' id='empno' class='form-control input-sm'>
                    </td>

                    <td>
                        <input  type='text' placeholder='Emp Name'  id='empname' class='form-control input-sm'>
                    </td>
                    <td>
                        <input  type='text' placeholder='Amount'  id='mreamb_amount' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='datetime' placeholder='Out Time & Date' id='out_td' class='form-control input-sm'>
                    </td>
                    <td>
                        <input type='text' placeholder='Remark'  id='mr_remarks' class='form-control input-sm'>
                    </td>
                   
                    <td><a onclick='add_tmp2();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM meal_reimbursement_table_b WHERE emprecid = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

//        $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        $rows2 .= "<tr><td>" . $row2['empno'] . "</td><td>" . $row2['empname'] . "</td><td>" . $row2['mreamb_amount'] . "</td><td>" . $row2['out_td'] . "</td><td>" . $row2['mr_remarks'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows2 .= "   </table>";
    $ResponseXML .= "<rows2><![CDATA[" . $rows2 . "]]></rows2>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}





if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>Ref No.</th>
                    <th>Reference</th>
                    <th>Date</th>
                </tr>";


    $sql = "Select * from meal_reimbursement where refno<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and refno like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and reference like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and mr_date like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY refno limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['refno'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['refno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['mr_date'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
