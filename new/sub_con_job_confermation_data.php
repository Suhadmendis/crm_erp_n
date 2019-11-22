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
    $sql = "SELECT subconjobcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['subconjobcode'];
    $uniq = uniqid();
    $tmpinvno = "000000" . $row["subconjobcode"];
    $lenth = strlen($tmpinvno);
    $no = trim("SCJ/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";


    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "Insert into sub_con_jobconfirm(supno,uniq,sname,scon_num,con_add,scon_date,spo_no,jobno,chq_fav,nicno,nic_isu_date,busregno)values
                 ('" . $_GET['supno'] . "','" . $_GET['uniq'] . "','" . $_GET['sname'] . "','" . $_GET['scon_num'] . "','" . $_GET['con_add'] . "','" . $_GET['scon_date'] . "','" . $_GET['spo_no'] . "','" . $_GET['jobno'] . "','" . $_GET['chq_fav'] . "','" . $_GET['nicno'] . "','" . $_GET['nic_isu_date'] . "','" . $_GET['busregno'] . "') ";
        $result = $conn->query($sql);


        $sql = "SELECT subconjobcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['subconjobcode'];

        $sql2 = "select * from sub_con_jobconfirm_table_temp_a where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into sub_con_jobconfirm_table_a(subconid1,des_task,qty1,unit_price,total_value,spec_remarks1)values 
             ('" . $row['subconid1'] . "','" . $row['des_task'] . "','" . $row['qty1'] . "','" . $row['unit_price'] . "','" . $row['total_value'] . "','" . $row['spec_remarks1'] . "')";

            $result = $conn->query($sql);
            //echo $sql;
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM sub_con_jobconfirm_table_temp_a where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql2 = "select * from sub_con_jobconfirm_table_temp_b where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into sub_con_jobconfirm_table_b(subconid2,spono1,cheqno1,qty2,unitprice2,total,spec_remarks2,uniq)values 
             ('" . $row['subconid2'] . "','" . $row['spono1'] . "','" . $row['cheqno1'] . "','" . $row['qty2'] . "','" . $row['unitprice2'] . "','" . $row['total'] . "','" . $row['spec_remarks2'] ."','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
            //echo $sql;
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM sub_con_jobconfirm_table_temp_b where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }
        $no2 = $no + 1;


        $sql = "update invpara set subconjobcode = $no2 where subconjobcode = $no";
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



        $mid = $_GET["supno"];

        $sql = "Insert into sub_con_jobconfirm_table_temp_a(subconid1,uniq,des_task,qty1,unit_price,total_value,spec_remarks1)values 
     ('" . $mid . "','" . $_GET['uniq'] . "','" . $_GET['des_task'] . "','" . $_GET['qty1'] . "','" . $_GET['unit_price'] . "','" . $_GET['total_value'] . "','" . $_GET['spec_remarks1'] . "')";

        $result = $conn->query($sql);
        //echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                             <thead>
                                <tr>
                               <th style='width: 20%;'>Description of Task</th>
                                <th style='width: 20%;'>Qty</th>
                                <th style='width: 20%;'>Unit Price</th>
                                <th style='width: 20%;'>Total Value</th>
                                <th style='width: 12%;'>Special Remark</th>
                                <th style='width: 8%;'>Add/Remove</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                               <td>
                            <input type='text' placeholder='' id='des_task' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='qty1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='unit_price' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='total_value' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='spec_remarks1' class='form-control input-sm'>
                        </td>

                                        
                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                    </tr>";




    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_temp_a where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['des_task'] . "</td><td>" . $row2['qty1'] . "</td><td>" . $row2['unit_price'] . "</td><td>" . $row2['total_value'] . "</td><td>" . $row2['spec_remarks1'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from sub_con_jobconfirm_table_temp_a where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
      $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                             <thead>
                                <tr>
                               <th style='width: 20%;'>Description of Task</th>
                                <th style='width: 20%;'>Qty</th>
                                <th style='width: 20%;'>Unit Price</th>
                                <th style='width: 20%;'>Total Value</th>
                                <th style='width: 12%;'>Special Remark</th>
                                <th style='width: 8%;'>Add/Remove</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                               <td>
                            <input type='text' placeholder='' id='des_task' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='qty1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='unit_price' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='total_value' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='spec_remarks1' class='form-control input-sm'>
                        </td>

                                        
                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                    </tr>";




    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_temp_a where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['des_task'] . "</td><td>" . $row2['qty1'] . "</td><td>" . $row2['unit_price'] . "</td><td>" . $row2['total_value'] . "</td><td>" . $row2['spec_remarks1'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET["Command"] == "setitem2") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails2>";



    if ($_GET["Command1"] == "add_tmp2") {



        $mid = $_GET["supno"];

        $sql = "Insert into sub_con_jobconfirm_table_temp_b(subconid2,uniq,spono1,cheqno1,qty2,unitprice2,total,spec_remarks2)values 
     ('" . $mid . "','" . $_GET['uniq'] . "','" . $_GET['spono1'] . "','" . $_GET['cheqno1'] . "','" . $_GET['qty2'] . "','" . $_GET['unitprice2'] . "','" . $_GET['total'] . "','" . $_GET['spec_remarks2'] . "')";

        $result = $conn->query($sql);
        //echo $sql;
    }

    $ResponseXML .= "<sales_table2><![CDATA[<table id='myTable' class='table table-bordered'>
                             <thead>
                                <tr>
                                 <th style='width: 15%;'>SPO No.</th>
                                <th style='width: 15%;'>Cheque No.</th>
                                <th style='width: 10%;'>Qty</th>
                                <th style='width: 20%;'>Unit Price</th>
                                <th style='width: 15%;'>Total</th>
                                <th style='width: 30%;'>Special Remark</th>
                                <th style='width: 10%;'>Add/Remove</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                 <td>
                            <input type='text' placeholder='' id='spono1' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder=''  id='cheqno1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='qty2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='unitprice2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='total' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='spec_remarks2' class='form-control input-sm'>
                        </td>

                                        
                                <td><a onclick='add_tmp2();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";




    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_temp_b where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['spono1'] . "</td><td>" . $row2['cheqno1'] . "</td><td>" . $row2['qty2'] . "</td><td>" . $row2['unitprice2'] . "</td><td>" . $row2['total'] . "</td><td>" . $row2['spec_remarks2'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table2>";
    $ResponseXML .= "</salesdetails2>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "removerow2") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails2>";

    $sql = "delete from sub_con_jobconfirm_table_temp_b where id = '" . $_GET['id'] . "'";
    
    $result = $conn->query($sql);
    
   $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                             <thead>
                                <tr>
                                 <th style='width: 15%;'>SPO No.</th>
                                <th style='width: 15%;'>Cheque No.</th>
                                <th style='width: 10%;'>Qty</th>
                                <th style='width: 20%;'>Unit Price</th>
                                <th style='width: 15%;'>Total</th>
                                <th style='width: 30%;'>Special Remark</th>
                                <th style='width: 10%;'>Add/Remove</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                 <td>
                            <input type='text' placeholder='' id='spono1' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder=''  id='cheqno1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='qty2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='unitprice2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='total' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='spec_remarks2' class='form-control input-sm'>
                        </td>

                                        
                                <td><a onclick='add_tmp2();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";




    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_temp_b where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['spono1'] . "</td><td>" . $row2['cheqno1'] . "</td><td>" . $row2['qty2'] . "</td><td>" . $row2['unitprice2'] . "</td><td>" . $row2['total'] . "</td><td>" . $row2['spec_remarks2'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails2>";
    echo $ResponseXML;
}









