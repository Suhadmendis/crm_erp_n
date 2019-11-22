<?php

session_start();



include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {




    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from sub_con_jobconfirm where supno ='" . $cuscode . "'";
   // echo $sql;


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        
        
        $ResponseXML .= "<id><![CDATA[" . $row['supno'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['sname'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['scon_num'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['con_add'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['scon_date'] . "]]></str_customername4>";
        $ResponseXML .= "<str_customername5><![CDATA[" . $row['spo_no'] . "]]></str_customername5>";
        $ResponseXML .= "<str_customername6><![CDATA[" . $row['jobno'] . "]]></str_customername6>";
        $ResponseXML .= "<str_customername7><![CDATA[" . $row['chq_fav'] . "]]></str_customername7>";
        $ResponseXML .= "<str_customername8><![CDATA[" . $row['nicno'] . "]]></str_customername8>";
        $ResponseXML .= "<str_customername9><![CDATA[" . $row['nic_isu_date'] . "]]></str_customername9>";
        $ResponseXML .= "<str_customername10><![CDATA[" . $row['busregno'] . "]]></str_customername10>";
        
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}





if ($_GET["Command"] == "updateTable") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ResponseXML = "";
    $ResponseXML .= "<new>";
    $rows = "";

   $sql = "SELECT * FROM sub_con_jobconfirm_table_a WHERE subconid1 = '" . $_GET['reference_no'] . "'";
    $rows .= "<br><table id='myTable' class='table table-bordered'>
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


    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_a WHERE subconid1 = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

//        $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    $rows .= "<tr><td>" . $row2['des_task'] . "</td><td>" . $row2['qty1'] . "</td><td>" . $row2['unit_price'] . "</td><td>" . $row2['total_value'] . "</td><td>" . $row2['spec_remarks1'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows .= "   </table>";




//    //----------------------------------------------------------------------------
    $rows2 = "";

//     $sql = "SELECT * FROM sub_con_jobconfirm_table_b WHERE subconid2 = '" . $_GET['reference_no'] . "'";
    $rows2 .= "<br><table id='myTable' class='table table-bordered'>
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


    $sql1 = "SELECT * FROM sub_con_jobconfirm_table_b WHERE subconid2 = '" . $_GET['reference_no'] . "'";
    foreach ($conn->query($sql1) as $row2) {

//        $rows .= "<tr><td>" . $row2['aod_no'] . "</td><td>" . $row2['no_text'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
         $rows2 .= "<tr><td>" . $row2['spono1'] . "</td><td>" . $row2['cheqno1'] . "</td><td>" . $row2['qty2'] . "</td><td>" . $row2['unitprice2'] . "</td><td>" . $row2['total'] . "</td><td>" . $row2['spec_remarks2'] . "</td><td><a onclick='remove_tmp2(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $rows2 .= "   </table>";
    $ResponseXML .= "<rows2><![CDATA[" . $rows2 . "]]></rows2>";

    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
//    $ResponseXML .= "<rows2><![CDATA[" . $rows2 . "]]></rows2>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}




if ($_GET["Command"] == "search_custom") {

    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                <th>Sup. No</th>
                    <th>Name :</th>
                    <th>Contact Number :</th> 
                </tr>";

    $sql = "Select * from sub_con_jobconfirm where supno <> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and supno like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and  sname like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and scon_num like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= "ORDER BY supno limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['supno'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['supno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sname'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scon_num'] . "</a></td>
                              
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
