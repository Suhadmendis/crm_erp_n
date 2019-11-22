<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT po_requistion_note_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['po_requistion_note_code'];
//    uniq
    $uniq = uniqid();

    $tmpinvno = "0000000" . $row["po_requistion_note_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("CPR/") . substr($tmpinvno, $lenth - 7);




    $ResponseXML .= "<reference_no><![CDATA[$no]]></reference_no>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
//add
        $sql = "SELECT po_requistion_note_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['po_requistion_note_code'];
        $uniq = uniqid();
        $tmpinvno = "000000000" . $row["po_requistion_note_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("CPR/") . substr($tmpinvno, $lenth - 7);

        $sql = "delete from po_requistion_note where reference_no = '" . $_GET['reference_no'] . "'";
        $result = $conn->query($sql);
       
        $sql1 = "Insert into po_requistion_note(reference_no,manual_no,remarks,date,job_no,dummy)values 
                        ('" . $_GET['reference_no'] . "','" . $_GET['manual_no'] . "','" . $_GET['remarks'] . "','" . $_GET['date'] . "','" . $_GET['job_no'] . "','" . $_GET['dummy'] . "')";
        $result = $conn->query($sql1);
                
        $sql2 = "SELECT * FROM po_requistion_note_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into po_requistion_note_table(reference_no,rec_no,product_code,product_description,quantity,umo,uniq)values 
             ('" . $row['reference_no'] . "','" . $row['rec_no'] . "','" . $row['product_code'] . "','" . $row['product_description'] . "','" . $row['quantity'] ."','" . $row['umo'] ."','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
            
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM po_requistion_note_table_temp where uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }

        $sql = "SELECT po_requistion_note_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['po_requistion_note_code'];
        $no2 = $no + 1;
        $sql = "update invpara set po_requistion_note_code = $no2 where po_requistion_note_code = $no";
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
        $sql = "update po_requistion_note set manual_no = '" . $_GET['manual_no'] . "' ,remarks = '" . $_GET['remarks'] . "' ,date = '" . $_GET['date'] . "' ,job_no = '" . $_GET['job_no'] . "' ,dummy = '" . $_GET['dummy'] . "'  where reference_no = '" . $_GET['reference_no'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from po_requistion_note where reference_no = '" . $_GET['reference_no'] . "'";
    $result = $conn->query($sql);
    //  echo $sql;
    // echo "delete";
}

//if ($_GET["Command"] == "setitem") {
//
//    $ResponseXML = "";
//    $ResponseXML .= "<salesdetails>";
//
//
//
//    if ($_GET["Command1"] == "add_tmp") {
//
//        $sql = "Insert into po_requistion_note_table_temp(reference_no,rec_no,product_code,product_description,quantity,umo,uniq)values 
//     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['product_description'] . "','" . $_GET['quantity'] . "','" . $_GET['umo'] . "','" . $_GET['uniq'] . "')";
//
//        $result = $conn->query($sql);
//    }
//
//    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
//                            <thead>
//                                <tr>
//                                    <th style='width: 10%;'>Rec No</th>
//                                    <th style='width: 20%;'>Product Code</th>
//                                    <th style='width: 40%;'>Product Description</th>
//                                    <th style='width: 20%;'>Quantity</th>
//                                    <th style='width: 10%;'>UOM</th>
//                                </tr>
//                            </thead>
//                            <tbody>
//                                <tr>
//
//                                      <td>
//                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
//                                        </td>
//                                        <td>
//                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
//                                        </td>
//                                        <td>
//                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
//                                        </td>
//                                        <td>
//                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
//                                        </td>
//                                        <td>
//                                            <input  type='text' placeholder='UOM'  id='umo' class='form-control input-sm'>
//                                        </td>
//                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
//
//
//                                </tr>";
//      $sql1 = "SELECT * FROM po_requistion_note_table_temp";
//      
//    foreach ($conn->query($sql1) as $row2) {
//
//           $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
//    }
//
//
//    $ResponseXML .= "</tbody></table>";
//
//
//
//
//    $ResponseXML .= "   </table>]]></sales_table>";
//
//
//    $ResponseXML .= "</salesdetails>";
//
//
//    echo $ResponseXML;
//}

  
if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



//        $mid = $_GET["sjrequestref"];
//        $pieces = explode("/", $mid);
//        $mid = (int) $pieces[1];




       if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into po_requistion_note_table_temp(reference_no,rec_no,product_code,product_description,quantity,umo,uniq)values 
     ('" . $_GET['reference_no'] . "','" . $_GET['rec_no'] . "','" . $_GET['product_code'] . "','" . $_GET['product_description'] . "','" . $_GET['quantity'] . "','" . $_GET['umo'] . "','" . $_GET['uniq'] . "')";

        $result = $conn->query($sql);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 20%;'>Product Code</th>
                                    <th style='width: 40%;'>Product Description</th>
                                    <th style='width: 20%;'>Quantity</th>
                                    <th style='width: 10%;'>UOM</th>
                                    <th style='width: 10%;'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                      <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='UOM'  id='umo' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




     $sql1 = "SELECT * FROM po_requistion_note_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['umo'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
        }


}

//delete


if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from po_requistion_note_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 20%;'>Product Code</th>
                                    <th style='width: 40%;'>Product Description</th>
                                    <th style='width: 20%;'>Quantity</th>
                                    <th style='width: 10%;'>UOM</th>
                                    <th style='width: 10%;'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                       <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='UOM'  id='umo' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    
     $sql1 = "SELECT * FROM po_requistion_note_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['umo'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
        
}



?>