<?php session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT adjustments_addition_deduction_code FROM invpara";
    $result = $conn->query($sql);
     
    $row = $result->fetch();
    $no = $row['adjustments_addition_deduction_code'];
    
    $uniq = uniqid();
    
    
    $tmpinvno = "00000000" . $row["adjustments_addition_deduction_code"];
    
    $lenth = strlen($tmpinvno);
    $no = trim("AADC/") . substr($tmpinvno, $lenth - 7);
   
   
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";
   

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction(); 
        
        $sql = "SELECT adjustments_addition_deduction_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['adjustments_addition_deduction_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["adjustments_addition_deduction_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("AADC/") . substr($tmpinvno, $lenth - 7);
     
        $sql1 = "Insert into adjustments_addition_deduction(reference_no,addition,deduction,date,manual_no,remarks,uniq)values 
        ('" . $no . "','" . $_GET['addition'] .  "','" . $_GET['deduction'] . "','" . $_GET['date'] . "','" . $_GET['manual_no'] . "','" . $_GET['remarks'] . "','" . $_GET['uniq'] ."') ";
       
        $result = $conn->query($sql1);
        
        $sql2 = "select * from adjustments_addition_deduction_tamp where uniq = '" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into adjustments_addition_deduction_table(reference_no,rec_no,product_code,product_Des,qty_on_hand,quantity,rate,reason,uniq)values 
             ('" . $no . "','" . $row['rec_no'] . "','" . $row['product_code'] . "','" . $row['product_Des'] . "','" . $row['qty_on_hand'] . "','" . $row['quantity'] . "','" . $row['rate'] . "','" . $row['reason'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }
        foreach ($conn->query($sql2) as $row) {
            $sql = "DELETE FROM adjustments_addition_deduction_tamp WHERE uniq = '" . $_GET['uniq'] . "'";
            $result = $conn->query($sql);
        }
        
        $sql = "SELECT adjustments_addition_deduction_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['adjustments_addition_deduction_code'];
        $no2 = $no + 1;
        $sql = "update invpara set adjustments_addition_deduction_code = $no2 where adjustments_addition_deduction_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {
   
        $sql = "delete from purchase_order_entry_dummy where reference_no = '" . $_GET['reference_no_Text'] . "'";
        $result = $conn->query($sql);
        echo "delete";
   
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    if ($_GET["Command1"] == "add_tmp") {

        if ($_GET["Command1"] == "add_tmp") {

            $sql = "Insert into adjustments_addition_deduction_tamp(reference_no,rec_no,product_code,product_Des,qty_on_hand,quantity,rate,reason,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['product_Des'] . "','" . $_GET['qty_on_hand'] . "','" . $_GET['quantity'] . "','" . $_GET['rate'] . "','" . $_GET['reason'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 10%;'>Product Code</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty On Hand</th>
                                        <th style='width: 10%;'>Quantity</th>
                                        <th style='width: 10%;'>Rate</th>
                                        <th style='width: 10%;'>Reason</th>
                                        <th style='width: 12%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code' id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty On Hand'  id='qty_on_hand' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Rate'  id='rate' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Reason'  id='reason' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM adjustments_addition_deduction_tamp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_Des'] . "</td><td>" . $row2['qty_on_hand'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['rate'] ."</td><td>" . $row2['reason'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from adjustments_addition_deduction_tamp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 10%;'>Product Code</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty On Hand</th>
                                        <th style='width: 10%;'>Quantity</th>
                                        <th style='width: 10%;'>Rate</th>
                                        <th style='width: 10%;'>Reason</th>
                                        <th style='width: 12%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code' id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty On Hand'  id='qty_on_hand' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Rate'  id='rate' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Reason'  id='reason' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM adjustments_addition_deduction_tamp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_Des'] . "</td><td>" . $row2['qty_on_hand'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['rate'] ."</td><td>" . $row2['reason'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        
    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

?>