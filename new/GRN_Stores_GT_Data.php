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

    $sql = "SELECT grncode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    //$no = $row['vmrcode'];
    $post = generateId($row['grncode'], "CSGT/", "post");
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

        $sql = "SELECT grncode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['grncode'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["grncode"];
        $lenth = strlen($tmpinvno);
        $no = trim("CDGT/") . substr($tmpinvno, $lenth - 7);

        $sql1 = "Insert into grndetails(referenceno,grndate,manualrefno,shippingmethod,purchasingorderno,currencycode,exchange,suppliercode,costcenter,remarks,uniq,textcombination)values 
           ('" . $no . "','" . $_GET['date_txt'] . "','" . $_GET['manualrefno_txt'] . "','" . $_GET['shippingmethod'] . "','" . $_GET['pono_txt'] . "','" . $_GET['currencycode_txt'] . "','" . $_GET['exchange_txt'] . "','" . $_GET['suppliercodeno_txt'] . "','" . $_GET['costcenter_txt'] . "','" . $_GET['remarks_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['tcomb_txt'] . "')";
        
        $result = $conn->query($sql1);
        $sql2 = "select * from goodrecievednote_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into goodrecievednote_tbl(jrid,prod_discription,p_quantity,pur_price,p_discount,p_value,p_taxcomb)values 
           ('" . $no . "','" . $row['prod_discription'] . "','" . $row['p_quantity'] . "','" . $row['pur_price'] . "','" . $row['p_discount'] . "','" . $row['p_value'] . "','" . $row['p_taxcomb'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM goodrecievednote_tbl_temp where jrid = '" . $_GET['reference_no_Text'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT grncode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['grncode'];
        $no2 = $no + 1;
        $sql = "update invpara set grncode = $no2 where grncode = $no";
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
        $sql = "update grndetails set grndate = '" . $_GET['date_txt'] . "',manualrefno = '" . $_GET['manualrefno_txt'] . "',purchasingorderno = '" . $_GET['pono_txt'] . "',currencycode = '" . $_GET['currencycode_txt'] . "',exchange = '" . $_GET['exchange_txt'] . "',suppliercode = '" . $_GET['suppliercodeno_txt'] . "',costcenter = '" . $_GET['costcenter_txt'] . "',remarks = '" . $_GET['remarks_txt'] . "',textcombination = '" . $_GET['tcomb_txt'] . "'  where referenceno = '" . $_GET['reference_no_Text'] . "'";
        $result = $conn->query($sql);
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}



if ($_GET["Command"] == "delete") {

    $sql = "update grndetails set cancel = '1'   where referenceno = '" . $_GET['reference_no_Text'] . "'";
    $result = $conn->query($sql);


    echo "deleted";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



        $mid = $_GET["reference_no_Text"];
        $pieces = explode("/", $mid);
        $mid = (int) $pieces[1];




        $sql = "Insert into goodrecievednote_tbl_temp(jrid,uniq,prod_discription,p_quantity,pur_price,p_discount,p_value,p_taxcomb)values 
     ('" . $mid . "','" . $_GET['uniq'] . "','" . $_GET['prod_discription'] . "','" . $_GET['p_quantity'] . "','" . $_GET['pur_price'] . "','" . $_GET['p_discount'] . "','" . $_GET['p_value'] . "','" . $_GET['p_taxcomb'] . "')";

        $result = $conn->query($sql);
        // echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Comb. Code</th>
                                    <th style='width: 10%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='prod_discription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='QTY'  id='p_quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Price' id='pur_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Discount'  id='p_discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='p_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Comb. Code'  id='p_taxcomb' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM goodrecievednote_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['prod_discription'] . "</td><td>" . $row2['p_quantity'] . "</td><td>" . $row2['pur_price'] . "</td><td>" . $row2['p_discount'] . "</td><td>" . $row2['p_value'] . "</td><td>" . $row2['p_taxcomb'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from goodrecievednote_tbl_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                   
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>QTY</th>
                                    <th style='width: 10%;'>Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Comb. Code</th>
                                    <th style='width: 10%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='prod_discription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='QTY'  id='p_quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Price' id='pur_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Discount'  id='p_discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='p_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Comb. Code'  id='p_taxcomb' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM goodrecievednote_tbl_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['prod_discription'] . "</td><td>" . $row2['p_quantity'] . "</td><td>" . $row2['pur_price'] . "</td><td>" . $row2['p_discount'] . "</td><td>" . $row2['p_value'] . "</td><td>" . $row2['p_taxcomb'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>