<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $sql = "SELECT mrcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['mrcode'];
    $uniq = uniqid();
    $tmpinvno = "0000000" . $row["mrcode"];
    $lenth = strlen($tmpinvno);
    $no = trim("MEALR/") . substr($tmpinvno, $lenth - 7);
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "SELECT mrcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['mrcode'];
        $uniq = uniqid();
        $tmpinvno = "0000000" . $row["mrcode"];
        $lenth = strlen($tmpinvno);
        $no = trim("MEALR/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into meal_reimbursement(refno,uniq,reference,mr_date,dept)values
                 ('" . $_GET['refno'] . "','" . $_GET['uniq'] . "','" . $_GET['reference'] . "','" . $_GET['mr_date'] . "','" . $_GET['dept'] . "') ";
        $result = $conn->query($sql);

        $sql2 = "select * from meal_reimbursement_table_temp_a where uniq  = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into meal_reimbursement_table_a(meal_recode,jobnum,mramount,equli,ca_amount,usage_tmp)values 
             ('" . $row['meal_recode'] . "','" . $row['jobnum'] . "','" . $row['mramount'] . "','" . $row['equli'] . "','" . $row['ca_amount'] . "','" . $row['usage_tmp'] . "')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM meal_reimbursement_table_temp_a where uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }
        $sql3 = "select * from meal_reimbursement_table_temp_b where uniq  = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql3) as $row) {

            $sql = "Insert into meal_reimbursement_table_b(emprecid,empno,empname,mreamb_amount,out_td,mr_remarks,uniq)values 
             ('" . $row['emprecid'] . "','" . $row['empno'] . "','" . $row['empname'] . "','" . $row['mreamb_amount'] . "','" . $row['out_td'] . "','" . $row['mr_remarks'] ."','" . $row['uniq'] . "')";
            $result = $conn->query($sql);

        }
        foreach ($conn->query($sql3) as $row) {

            $sql = "DELETE FROM meal_reimbursement_table_temp_b where uniq= '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }

        $sql = "SELECT mrcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['mrcode'];
        $no2 = $no + 1;
        $sql = "update invpara set mrcode = $no2 where mrcode = $no";
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

        if ($_GET["Command1"] == "add_tmp") {

            $sql = "Insert into meal_reimbursement_table_temp_a(meal_recode,uniq,jobnum,mramount,equli,ca_amount,usage_tmp)values 
     ('"  . $_GET['refno'] . "','" . $_GET['uniq'] . "','" . $_GET['jobnum'] . "','" . $_GET['mramount'] . "','" . $_GET['equli'] . "','" . $_GET['ca_amount'] . "','" . $_GET['usage1'] . "')";

            $result = $conn->query($sql);
        }
        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
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
        $sql1 = "SELECT * FROM meal_reimbursement_table_temp_a where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['jobnum'] . "</td><td>" . $row2['mramount'] . "</td><td>" . $row2['equli'] . "</td><td>" . $row2['ca_amount'] . "</td><td>". $row2['usage_tmp'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]></sales_table>";
        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}




if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from meal_reimbursement_table_temp_a where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
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
        $sql1 = "SELECT * FROM meal_reimbursement_table_temp_a where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['jobnum'] . "</td><td>" . $row2['mramount'] . "</td><td>" . $row2['equli'] . "</td><td>" . $row2['ca_amount'] . "</td><td>". $row2['usage_tmp'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }


    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET["Command"] == "setitem2") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp2") {

        if ($_GET["Command1"] == "add_tmp2") {

            $sql = "Insert into meal_reimbursement_table_temp_b(emprecid,empno,empname,mreamb_amount,out_td,mr_remarks,uniq)values 
     ('"  . $_GET['refno'] . "','" . $_GET['empno'] . "','" . $_GET['empname'] . "','" . $_GET['mreamb_amount'] . "','" . $_GET['out_td'] . "','" . $_GET['mr_remarks'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }
        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
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
        
        $sql1 = "SELECT * FROM meal_reimbursement_table_temp_b where uniq = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['empno'] . "</td><td>" . $row2['empname'] . "</td><td>" . $row2['mreamb_amount'] . "</td><td>" . $row2['out_td'] . "</td><td>". $row2['mr_remarks'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]></sales_table>";
        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}




if ($_GET["Command"] == "removerow2") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from meal_reimbursement_table_temp_b where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
     $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
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
        
        $sql1 = "SELECT * FROM meal_reimbursement_table_temp_b where uniq = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['empno'] . "</td><td>" . $row2['empname'] . "</td><td>" . $row2['mreamb_amount'] . "</td><td>" . $row2['out_td'] . "</td><td>". $row2['mr_remarks'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }
    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>