<?php

session_start();

////////////////////////////////////////////// Database Connector /////////////////////////////////////////////////////////////
require_once ("connection_sql.php");

////////////////////////////////////////////// Write XML ////////////////////////////////////////////////////////////////////
header('Content-Type: text/xml');
date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $sql = "SELECT arfcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['arfcode'];
    $uniq = uniqid();
    $tmpinvno = "000000" . $row["arfcode"];
    $lenth = strlen($tmpinvno);
    $no = trim("ARF/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "Insert into advancedreq_fuel(arf_no,uniq,reqdate,dep,reqby,amount_w,ex_settle,t_amount,c_favor,customer_code,customer_name,jobnos)values 
                 ('" . $_GET['arf_no'] . "','" . $_GET['uniq'] . "','" . $_GET['reqdate'] . "','" . $_GET['dep'] . "','" . $_GET['reqby'] . "','" . $_GET['amount_w'] . "','" . $_GET['ex_settle'] . "','" . $_GET['t_amount'] . "','" . $_GET['c_favor'] . "','" . $_GET['customer_code'] . "','" . $_GET['customer_name'] . "','" . $_GET['jobnos'] . "') ";
        $result = $conn->query($sql);


        $sql = "SELECT arfcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['arfcode'];

        $sql2 = "select * from advancedreq_fuel_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into advancedreq_fuel_table(arftid,vnumber,jb,rate_arf,ltrs,amount_arf,totalkms,avg_fe,remarks_arf)values 
             ('" . $row['arftid'] . "','" . $row['vnumber'] . "','" . $row['jb'] . "','" . $row['rate_arf'] . "','" . $row['ltrs'] . "','" . $row['amount_arf'] . "','" . $row['totalkms'] . "','" . $row['avg_fe'] . "','" . $row['remarks_arf'] . "')";

            $result = $conn->query($sql);
            //echo $sql;
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM advancedreq_fuel_table_temp where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }
        $no2 = $no + 1;


        $sql = "update invpara set arfcode = $no2 where arfcode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



        $mid = $_GET["arf_no"];

        $pieces = explode("/", $mid);
        $mid = (int) $pieces[1];
        // echo $mid;

        $sql = "Insert into advancedreq_fuel_table_temp(arftid,uniq,vnumber,jb,rate_arf,ltrs,amount_arf,totalkms,avg_fe,remarks_arf)values 
     ('" . $mid . "','" . $_GET['uniq'] . "','" . $_GET['vnumber'] . "','" . $_GET['jb'] . "','" . $_GET['rate_arf'] . "','" . $_GET['ltrs'] . "','" . $_GET['amount_arf'] . "','" . $_GET['totalkms'] . "','" . $_GET['avg_fe'] . "','" . $_GET['remarks_arf'] . "')";

        $result = $conn->query($sql);
        //echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
                                <tr>
                                <th style='width: 10%;'>Vehicle Number</th>
                                <th style='width: 10%;'>JB</th>
                                <th style='width: 5%;'>Rate</th>
                                <th style='width: 10%;'>Ltrs</th>
                                <th style='width: 10%;'>Amount</th>
                                <th style='width: 10%;'>Total KMs</th>
                                <th style='width: 10%;'>Avg. Fuel Efficiency</th>
                                <th style='width: 10%;'>Remark</th>
                                <th style='width: 5%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <<td>
                            <input type='text' placeholder='Vehicle Number' id='vnumber' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder='JB'  id='jb' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder='Rate'  id='rate_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Ltrs' id='ltrs' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Amount'  id='amount_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Total KMs'  id='totalkms' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Avg. Fuel Efficiency'  id='avg_fe' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Remark'  id='remarks_arf' class='form-control input-sm'>
                        </td>
                                        
                                <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";




    $sql1 = "SELECT * FROM advancedreq_fuel_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['vnumber'] . "</td><td>" . $row2['jb'] . "</td><td>" . $row2['rate_arf'] . "</td><td>" . $row2['ltrs'] . "</td><td>" . $row2['amount_arf'] . "</td><td>" . $row2['totalkms'] . "</td><td>" . $row2['avg_fe'] . "</td><td>" . $row2['remarks_arf'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from advancedreq_fuel_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                <th style='width: 10%;'>Vehicle Number</th>
                                <th style='width: 10%;'>JB</th>
                                <th style='width: 5%;'>Rate</th>
                                <th style='width: 10%;'>Ltrs</th>
                                <th style='width: 10%;'>Amount</th>
                                <th style='width: 10%;'>Total KMs</th>
                                <th style='width: 10%;'>Avg. Fuel Efficiency</th>
                                <th style='width: 10%;'>Remark</th>
                                <th style='width: 5%;'>Add/Remove</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                            <input type='text' placeholder='Vehicle Number' id='vnumber' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder='JB'  id='jb' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder='Rate'  id='rate_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Ltrs' id='ltrs' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Amount'  id='amount_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Total KMs'  id='totalkms' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Avg. Fuel Efficiency'  id='avg_fe' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Remark'  id='remarks_arf' class='form-control input-sm'>
                        </td>
                                        
                                <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";


    $sql1 = "SELECT * FROM advancedreq_fuel_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['vnumber'] . "</td><td>" . $row2['jb'] . "</td><td>" . $row2['rate_arf'] . "</td><td>" . $row2['ltrs'] . "</td><td>" . $row2['amount_arf'] . "</td><td>" . $row2['totalkms'] . "</td><td>" . $row2['avg_fe'] . "</td><td>" . $row2['remarks_arf'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}








