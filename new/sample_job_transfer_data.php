<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

function generateId($id, $ref, $switch) {

    if ($switch == "pre") {
        $temp = substr($id, strlen($ref));
        $id = (int) $temp;

        return $id;
    } else if ($switch == "post") {

        $temp = substr("0000000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT jobtranscode  FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vmrcode'];
    $post = generateId($row['jobtranscode'], "ST/", "post");
    $uniq = uniqid();

    $ResponseXML .= "<id><![CDATA[$post]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "SELECT jobtranscode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobtranscode'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["jobtranscode"];
        $lenth = strlen($tmpinvno);
        $no = trim("ST/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into samplejobtransfer(reference_no,sjtdate,customer)values 
           ('" . $no . "','" . $_GET['date_txt'] . "','" . $_GET['customer_txt'] . "')";

        $result = $conn->query($sql);
     
        $sql2 = "select * from samplejobtransfer_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into samplejobtransfer_tbl(reference_no,sjbno,sjbqty,transferqty,balance,customer,tick)values 
             ('" . $no . "','" . $row['sjbno'] . "','" . $row['sjbqty'] . "','" . $row['transferqty'] . "','" . $row['balance'] . "','" . $row['customer'] . "','" . $row['tick'] . "')";

            $result = $conn->query($sql);
            // echo $sql;
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM samplejobtransfer_tbl_temp where  uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT jobtranscode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobtranscode'];
        $no2 = $no + 1;
        $sql = "update invpara set jobtranscode = $no2 where jobtranscode = $no";
        $result = $conn->query($sql);
        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

//if ($_GET["Command"] == "update") {
//
//    $sql = "update samplejobtransfer set sjtdate = '" . $_GET['date_txt'] . "',customer = '" . $_GET['customer_txt'] . "'  where sjtno = '" . $_GET['samplejobtransno_txt'] . "'";
//    $result = $conn->query($sql);
//    echo "update";
//}



if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejobtransfer where sjtno = '" . $_GET['samplejobtransno_txt'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into samplejobtransfer_tbl_temp(reference_no,uniq,sjbno,sjbqty,transferqty,balance,customer,tick)values 
     ('" . $_GET['samplejobtransno_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['sjbno'] . "','" . $_GET['sjbqty'] . "','" . $_GET['transferqty'] . "','" . $_GET['balance'] . "','" . $_GET['customer'] . "','" . $_GET['tick'] . "')";

        $result = $conn->query($sql);
        // echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
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

    $sql1 = "SELECT * FROM samplejobtransfer_tbl_temp  where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['sjbqty'] . "</td><td>" . $row2['transferqty'] . "</td><td>" . $row2['balance'] . "</td><td>" . $row2['customer'] . "</td><td>" . $row2['tick'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from samplejobtransfer_tbl_temp  where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
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




    $sql1 = "SELECT * FROM samplejobtransfer_tbl_temp  where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        //$ResponseXML .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['exstock'] . "</td><td>" . $row2['issueqty'] . "</td><td>" . $row2['balance_issued'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        $ResponseXML .= "<tr><td>" . $row2['sjbno'] . "</td><td>" . $row2['sjbqty'] . "</td><td>" . $row2['transferqty'] . "</td><td>" . $row2['balance'] . "</td><td>" . $row2['customer'] . "</td><td>" . $row2['tick'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>