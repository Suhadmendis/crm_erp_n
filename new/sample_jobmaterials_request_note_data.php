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

    $sql = "SELECT jobmatreqcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['jobmatreqcode'];
    $post = generateId($row['jobmatreqcode'], "SJMR/", "post");
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

        $sql = "SELECT jobmatreqcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobmatreqcode'];
        $tmpinvno = "000000000" . $row["jobmatreqcode"];
        $lenth = strlen($tmpinvno);
        $no = trim("SJMR/") . substr($tmpinvno, $lenth - 7);

        $sql1 = "Insert into samplejobmatreq(reference_no,sjbdate,sjbmrnref,manualref,remark)values 
           ('" . $no .  "','" . $_GET['date_txt'] . "','" . $_GET['sjbmrn_txt'] . "','" . $_GET['manualref_txt'] . "','" . $_GET['remark_txt'] . "')";
        $result = $conn->query($sql1);

        $sql2 = "select * from sjobmatreq_tbl_temp where uniq = '" . $_GET['uniq'] . "'";

        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into sjobmatreq_tbl(itemcode,materialname,requiredqty,uom,reference_no)values 
             ('" . $row['itemcode'] . "','" . $row['materialname'] . "','" . $row['requiredqty'] . "','" . $row['uom'] . "','" . $no .  "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM sjobmatreq_tbl_temp where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT jobmatreqcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobmatreqcode'];
        $no2 = $no + 1;
        $sql = "update invpara set jobmatreqcode = $no2 where jobmatreqcode = $no";
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
//    $sql = "update samplejobmatreq set sjbdate = '" . $_GET['date_txt'] . "',sjbmrnref = '" . $_GET['sjbmrn_txt'] . "',manualref = '" . $_GET['manualref_txt'] . "',remark = '" . $_GET['remark_txt'] . "'  where sjmid = '" . $_GET['sjb_txt'] . "'";
//    $result = $conn->query($sql);
//    echo "update";
//}


if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejobmatreq where sjmid = '" . $_GET['sjb_txt'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {

//        $mid = $_GET["sjb_txt"];


        $sql = "Insert into sjobmatreq_tbl_temp(reference_no,uniq,itemcode,materialname,requiredqty,uom)values 
     ('" . $_GET['sjb_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['itemcode'] . "','" . $_GET['materialname'] . "','" . $_GET['requiredqty'] . "','" . $_GET['uom'] . "')";

        $result = $conn->query($sql);
        // echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                     <th style='width: 15%;'>Item Code</th>
                                     <th style='width: 15%;'>Material Name</th>
                                     <th style='width: 15%;'>Required Qty</th>
                                     <th style='width: 15%;'>UOM</th>
                                     <th style='width: 15%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type='text' placeholder='Item Code' id='itemcode' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input type='text' placeholder='Material Name'  id='materialname' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='Required Qty'  id='requiredqty' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                </td>
                                <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                            </tr>";




    $sql1 = "SELECT * FROM sjobmatreq_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from sjobmatreq_tbl_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                               <tr>
                                     <th style='width: 15%;'>Item Code</th>
                                     <th style='width: 15%;'>Material Name</th>
                                     <th style='width: 15%;'>Required Qty</th>
                                     <th style='width: 15%;'>UOM</th>
                                     <th style='width: 15%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <input type='text' placeholder='Item Code' id='itemcode' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input type='text' placeholder='Material Name'  id='materialname' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='Required Qty'  id='requiredqty' class='form-control input-sm'>
                                </td>
                                <td>
                                    <input  type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                </td>
                                <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                               </tr>";




    $sql1 = "SELECT * FROM sjobmatreq_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>