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

    $sql = "SELECT jobmatisscode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vmrcode'];
    $post = generateId($row['jobmatisscode'], "SJMI/", "post");
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


        $sql = "SELECT jobmatisscode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobmatisscode'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["jobmatisscode"];
        $lenth = strlen($tmpinvno);
        $no = trim("SJMI/") . substr($tmpinvno, $lenth - 7);

        $sql = "Insert into samplejobmatirealissue(reference_no,mrnref,issueddate,minref,manualref,remarks)values 
           ('" . $no . "','" . $_GET['sjbmrnref_txt'] . "','" . $_GET['date_txt'] . "','" . $_GET['sjbminref_txt'] . "','" . $_GET['manualref_txt'] . "','" . $_GET['remark_txt'] . "')";

        $result = $conn->query($sql);


        $sql2 = "select * from sjobmissue_tbl_temp where uniq = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into sjobmissue_tbl(itemcode,materialname,requiredqty,exstock,issueqty,balance_issued,uom,reference_no)values 
             ('" . $row['itemcode'] . "','" . $row['materialname'] . "','" . $row['requiredqty'] . "','" . $row['exstock'] . "','" . $row['issueqty'] . "','" . $row['balance_issued'] . "','" . $row['uom'] . "','" . $no . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM sjobmissue_tbl_temp where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT jobmatisscode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jobmatisscode'];
        $no2 = $no + 1;
        $sql = "update invpara set jobmatisscode = $no2 where jobmatisscode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

//if ($_GET["Command"] == "update") {
//    try {
//        $sql = "update grndetails set grndate = '" . $_GET['date_txt'] . "',manualrefno = '" . $_GET['manualrefno_txt'] . "',purchasingorderno = '" . $_GET['pono_txt'] . "',currencycode = '" . $_GET['currencycode_txt'] . "',exchange = '" . $_GET['exchange_txt'] . "',suppliercode = '" . $_GET['suppliercodeno_txt'] . "',costcenter = '" . $_GET['costcenter_txt'] . "',remarks = '" . $_GET['remarks_txt'] . "',textcombination = '" . $_GET['tcomb_txt'] . "'  where referenceno = '" . $_GET['reference_no_Text'] . "'";
//        $result = $conn->query($sql);
//        echo "update";
//    } catch (Exception $e) {
//        $conn->rollBack();
//        echo $e;
//    }
//}



if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejobmatirealissue where sjbno = '" . $_GET['sjbno_txt'] . "'";
    $result = $conn->query($sql);


    echo "deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {


        $sql = "Insert into sjobmissue_tbl_temp(reference_no,uniq,itemcode,materialname,requiredqty,exstock,issueqty,balance_issued,uom)values 
     ('" . $_GET['sjbno_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['itemcode'] . "','" . $_GET['materialname'] . "','" . $_GET['requiredqty'] . "','" . $_GET['exstock'] . "','" . $_GET['issueqty'] . "','" . $_GET['balance_issued'] . "','" . $_GET['uom'] . "')";

        $result = $conn->query($sql);
        // echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    
                                   <th style='width: 10%;'>Item Code</th>
                                    <th style='width: 10%;'>Material Name</th>
                                    <th style='width: 10%;'>Required Qty</th>
                                    <th style='width: 10%;'>Ex. Stock</th>
                                    <th style='width: 10%;'>Issue Qty</th>
                                    <th style='width: 10%;'>Balance to be issued</th>
                                    <th style='width: 10%;'>UOM</th>
                                    <th style='width: 10%;'>Add/Remove</th>
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
                                        <input type='text' placeholder='Ex. Stock' id='exstock' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Issue Qty'  id='issueqty' class='form-control input-sm'>
                                    </td>
                                                                        
                                    <td>
                                        <input type='text' placeholder='Balance to be issued' id='balance_issued' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                    </td>

                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM sjobmissue_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['exstock'] . "</td><td>" . $row2['issueqty'] . "</td><td>" . $row2['balance_issued'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from sjobmissue_tbl_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Item Code</th>
                                    <th style='width: 10%;'>Material Name</th>
                                    <th style='width: 10%;'>Required Qty</th>
                                    <th style='width: 10%;'>Ex. Stock</th>
                                    <th style='width: 10%;'>Issue Qty</th>
                                    <th style='width: 10%;'>Balance to be issued</th>
                                    <th style='width: 10%;'>UOM</th>
                                    <th style='width: 10%;'>Add/Remove</th>
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
                                        <input type='text' placeholder='Ex. Stock' id='exstock' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Issue Qty'  id='issueqty' class='form-control input-sm'>
                                    </td>
                                                                        
                                    <td>
                                        <input type='text' placeholder='Balance to be issued' id='balance_issued' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                    </td>

                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM sjobmissue_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemcode'] . "</td><td>" . $row2['materialname'] . "</td><td>" . $row2['requiredqty'] . "</td><td>" . $row2['exstock'] . "</td><td>" . $row2['issueqty'] . "</td><td>" . $row2['balance_issued'] . "</td><td>" . $row2['uom'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>