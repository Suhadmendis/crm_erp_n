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

    $sql = "SELECT pocode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vmrcode'];
    $post = generateId($row['pocode'], "CSPO/", "post");
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

        $sql = "SELECT pocode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['pocode'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["pocode"];
        $lenth = strlen($tmpinvno);
        $no = trim("CSPO/") . substr($tmpinvno, $lenth - 7);

        $sql1 = "Insert into purchaseorder_dtls(reference_no,manual,shippingmethod,podate,jobno,currencycode,exchangerate,supplier,costcenter,uniq,remarks,tcomb)values 
           ('" . $no . "','" . $_GET['manual_txt'] . "','" . $_GET['shippingmethod'] . "','" . $_GET['date_txt'] . "','" . $_GET['jobno_txt'] . "','" . $_GET['currencycode_txt'] . "','" . $_GET['exchangerate_txt'] . "','" . $_GET['supplier_no'] . "','" . $_GET['costcenter_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['remarks_txt'] . "','" . $_GET['tcomb_txt'] . "')";
        $result = $conn->query($sql1);

        $sql2 = "select * from purchase_order_tbl_temp where uniq = '" . $_GET['uniq'] . "'";
        
        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into purchase_order_tbl(reference_no,recordno,p_discription,p_quantity,p_price,p_discount,p_value,p_tccode)values 
           ('" . $no . "','" . $row['recordno'] . "','" . $row['p_discription'] . "','" . $row['p_quantity'] . "','" . $row['p_price'] . "','" . $row['p_discount'] . "','" . $row['p_value'] . "','" . $row['p_tccode'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM purchase_order_tbl_temp where uniq= '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT pocode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['pocode'];
        $no2 = $no + 1;
        $sql = "update invpara set pocode = $no2 where pocode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {
    try {
        $sql = "update purchaseorder_dtls set manual = '" . $_GET['manual_txt'] . "',shippingmethod = '" . $_GET['shippingmethod'] . "',podate = '" . $_GET['date_txt'] . "',jobno = '" . $_GET['jobno_txt'] . "',currencycode = '" . $_GET['currencycode_txt'] . "',exchangerate = '" . $_GET['exchangerate_txt'] . "',supplier = '" . $_GET['supplier_no'] . "',costcenter = '" . $_GET['costcenter_txt'] . "',remarks = '" . $_GET['remarks_txt'] . "',tcomb = '" . $_GET['tcomb_txt'] . "'  where reference_no = '" . $_GET['refno_txt'] . "'";
        $result = $conn->query($sql);
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}



if ($_GET["Command"] == "delete") {

    $sql = "update purchaseorder_dtls set cancel = '1'   where reference_no = '" . $_GET['refno_txt'] . "'";
    $result = $conn->query($sql);
    echo "deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into purchase_order_tbl_temp(reference_no,uniq,recordno,p_discription,p_quantity,p_price,p_discount,p_value,p_tccode)values 
     ('" . $_GET['refno_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['recordno'] . "','" . $_GET['p_discription'] . "','" . $_GET['p_quantity'] . "','" . $_GET['p_price'] . "','" . $_GET['p_discount'] . "','" . $_GET['p_value'] . "','" . $_GET['p_tccode'] . "')";

        $result = $conn->query($sql);
        //echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Com. Code </th>
                                    <th style='width: 10%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      
                                        <td>
                                            <input type='text' placeholder='Rec No'  id='recordno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Code'  id='p_discription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='QTY' id='p_quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Price'  id='p_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='p_discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='p_value' class='form-control input-sm'>
                                        </td>
                                        
                                         <td>
                                            <input  type='text' placeholder='Tax Com. Code'  id='p_tccode' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM purchase_order_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['recordno'] . "</td><td>" . $row2['p_discription'] . "</td><td>" . $row2['p_quantity'] . "</td><td>" . $row2['p_price'] . "</td><td>" . $row2['p_discount'] . "</td><td>" . $row2['p_value'] . "</td><td>" . $row2['p_tccode'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from purchase_order_tbl_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                   
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Com. Code </th>
                                    <th style='width: 10%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      
                                        <td>
                                            <input type='text' placeholder='Rec No'  id='recordno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Code'  id='p_discription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='QTY' id='p_quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Price'  id='p_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='p_discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='p_value' class='form-control input-sm'>
                                        </td>
                                        
                                         <td>
                                            <input  type='text' placeholder='Tax Com. Code'  id='p_tccode' class='form-control input-sm'>
                                        </td>

                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM purchase_order_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['recordno'] . "</td><td>" . $row2['p_discription'] . "</td><td>" . $row2['p_quantity'] . "</td><td>" . $row2['p_price'] . "</td><td>" . $row2['p_discount'] . "</td><td>" . $row2['p_value'] . "</td><td>" . $row2['p_tccode'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>