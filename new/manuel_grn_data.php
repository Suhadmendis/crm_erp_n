<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT manuel_grn_ref_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['manuel_grn_ref_code'];
//    uniq
    $uniq = uniqid();

    $tmpinvno = "0000000" . $row["manuel_grn_ref_code"];
    $lenth = strlen($tmpinvno);
    $no = trim("MGRN/") . substr($tmpinvno, $lenth - 7);




    $ResponseXML .= "<reference_no><![CDATA[$no]]></reference_no>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";



    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "SELECT manuel_grn_ref_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['manuel_grn_ref_code'];
        $uniq = uniqid();
        $tmpinvno = "0000000" . $row["manuel_grn_ref_code"];
        $lenth = strlen($tmpinvno);
        $no = trim("MGRN/") . substr($tmpinvno, $lenth - 7);


        $sql = "delete from manuel_grn where manuel_grn_ref='" . $_GET['manuel_grn_ref'] . "' ";
        $result = $conn->query($sql);


        $sql = "Insert into manuel_grn(manuel_grn_ref,name,date,address,uniq)values 
                        ('" . $no . "','" . $_GET['name'] . "','" . $_GET['date'] . "','" . $_GET['address'] . "','" . $_GET['uniq'] . "')";
        $result = $conn->query($sql);
        //echo $sql;


        $sql2 = "SELECT * FROM manuel_grn_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into manuel_grn_table(manuel_grn_ref,aod_no,no_text,product_description,qty,uniq)values 
             ('" . $no . "','" . $row['aod_no'] . "','" . $row['no_text'] . "','" . $row['product_description'] . "','" . $row['qty'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM manuel_grn_table_temp where uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }


        $sql = "SELECT manuel_grn_ref_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['manuel_grn_ref_code'];
        $no2 = $no + 1;
        $sql = "update invpara set manuel_grn_ref_code = $no2 where manuel_grn_ref_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}



if ($_GET["Command"] == "delete") {

    $sql = "delete from good_received_note_ent where reference_no = '" . $_GET['reference_no'] . "'";
    $result = $conn->query($sql);
    //  echo $sql;
    echo "delete";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



        if ($_GET["Command1"] == "add_tmp") {



            $sql = "Insert into manuel_grn_table_temp(manuel_grn_ref,aod_no,no_text,product_description,qty,uniq)values 
     ('" . $_GET['manuel_grn_ref'] . "','" . $_GET['aod_no'] . "','" . $_GET['no_text'] . "','" . $_GET['product_description'] . "','" . $_GET['qty'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
                                        <th style='width: 20%;'>AOD NO.</th>
                                        <th style='width: 20%;'>NO</th>
                                        <th style='width: 50%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type='text' placeholder='AOD NO.' id='aod_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='NO'  id='no_text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                        </td>   
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";
        $sql1 = "SELECT * FROM manuel_grn_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
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

    $sql = "delete from manuel_grn_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                           <thead>
                                
                                        <th style='width: 20%;'>AOD NO.</th>
                                        <th style='width: 20%;'>NO</th>
                                        <th style='width: 50%;'>Product Description</th>
                                        <th style='width: 10%;'>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type='text' placeholder='AOD NO.' id='aod_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='NO'  id='no_text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                        </td>   
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

    $sql1 = "SELECT * FROM manuel_grn_table_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>