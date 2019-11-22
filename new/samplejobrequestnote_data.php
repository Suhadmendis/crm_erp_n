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

    $sql = "SELECT sjrncode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $uniq = uniqid();
    $no = generateId($row['sjrncode'], "SJR/", "post");
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from samplejobreqnote where jrid = '" . $_GET['sjrequestref'] . "'";
        $result = $conn->query($sql);
        $sql = "Insert into samplejobreqnote(jrid,jobreqdate,customer,mkex)values 
           ('" . $_GET['sjrequestref'] . "','" . $_GET['date_in'] . "','" . $_GET['customer'] . "','" . $_GET['mkex'] . "')";

        $result = $conn->query($sql);
        $sql = "SELECT sjrncode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['sjrncode'];
         
         $sql2 = "select * from samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {
           
                $sql = "Insert into samplejobreqnote_table(itemno,des,qty,jrid)values 
             ('" . $row['itemno'] . "','" . $row['des'] . "','" . $row['qty'] . "','" . $no . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }


        
        
        
        $no2 = $no + 1;
        $sql = "update invpara set sjrncode = $no2 where sjrncode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {

    $sql = "update sponcer set Sponcer = '" . $_GET['Sponcer'] . "',SpAddress = '" . $_GET['SpAddress'] . "',Email = '" . $_GET['Email'] . "',Phone = '" . $_GET['Phone'] . "',VatReg = '" . $_GET['VatReg'] . "',Cordinator = '" . $_GET['Cordinator'] . "',Designation = '" . $_GET['Designation'] . "'  where SponID = '" . $_GET['SponID'] . "'";
    $result = $conn->query($sql);
    echo "Updated";
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejobreqnote where jrid = '" . $_GET['sjrequestref'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}


if ($_GET["Command"] == "cancel") {

    $sql = "update sponcer set Cancel = '1'   where SponID = '" . $_GET['SponID'] . "'";
    $result = $conn->query($sql);


    echo "canceled";
}




if ($_GET["Command"] == "setitem") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    if ($_GET["Command1"] == "add_tmp") {



        $des = str_replace("'", "\'", $_GET['SampleDescription']);
        $des = str_replace("7k7f7d8j8u8", "#", $des);
        $des = str_replace("7k7f788j8u8", "&", $des);
        $des = str_replace("7k7g788j8u8", "+", $des);




        $sql = "Insert into samplejobreqnote_table_temp(itemno,des,qty,uniq,jrid)values 
                                            ('" . $_GET['itemno'] . "','" . $des . "','" . $_GET['SampleQty'] . "','" . $_GET['uniq'] . "','" . $_GET['jrid'] . "')";

        $result = $conn->query($sql);
    }



    $ResponseXML .= "<sales_table><![CDATA[<div id='getTable'><table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>Item No</th>
                                        <th style='width: 75%;'>Sample Description</th>
                                        <th style='width: 10%;'>Sample Qty</th>
                                        <th style='width: 5%;'>Add/Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input  type='text' placeholder='Item No'  id='itemno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='SampleDescription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample QTY' id='SampleQty' class='form-control input-sm'>
                                        </td>


                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                    </tr>
                                   ";


    $sql1 = "SELECT * FROM samplejobreqnote_table_temp WHERE Invoice_Number = '" . $_GET['Invoice_Number'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['QTY'] . "</td><td>" . $row2['Description'] . "</td><td>" . cal($row2['Unit_Price']) . "</td><td>" . cal($row2['Value']) . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


    $sqltot = "SELECT sum(value) from  temporary_manual_invoice_table_temp where uniq = '" . $_GET['uniq'] . "'";


    $result = $conn->query($sqltot);
    $row = $result->fetch();
//    $no = $row['temporary_manual_invoice_code'];
//    $uniq = uniqid();
//    $row = "sdf";
//    $rssvat = "";
//    if ($_GET['rate'] != 1) {
//        $rssvat = "<br>(Rs. " . $row[0] * $_GET['rate'] . ")";
//    } else {
//        $rssvat = "";
//    }


    if ($_GET['svatboo'] == 1) {
        if ($_GET['nbtboo'] == 1) {

            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $svat = $nbt + $row[0];
            $svat = $svat / 100;
            $svat = $svat * 15;
            $grand = $row[0] + $nbt;





            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "
                                                
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($nbt) . "</td>
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td>"
                    . "" . cal($svat) . "  </td>
                                        <td>
                                         
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td><b>"
                    . "" . cal($grand) . "
                                            
                                        </b></td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    ";
        } else {


            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;
//            $totby1 = $totby1 + $row[0];

            $rssvat = "";
            if ($_GET['rate'] != 1) {
                $rssvat = "<br>(Rs. " . cal($_GET['rate'] * $totby1) . ")";
            } else {
                $rssvat = "";
            }

//           $totby1 = $row[0] / 100;
//            $nbt = $totby1 * 2;
//
//            $svat = $nbt + $row[0];
//            $svat = $svat / 100;
//            $svat = $svat * 15;
//            $grand = $row[0] + $nbt;

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td> "
                    . "" .
                    cal($totby1) . "" . $rssvat . "
                                        <td>
                                           
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                     <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td><b>"
                    . "" . cal($row[0]) . "
                                            
                                        </b></td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row[0] - $_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                   ";
        }
    } else {
        if ($_GET['nbtboo'] == 1) {
            $totby1 = $row[0] / 100;
            $nbt = $totby1 * 2;

            $totby1 = $row[0] + $nbt;
            $totby1 = $totby1 / 100;
            $vat = $totby1 * 15;

            $grand = $row[0] + $vat + $nbt;

            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           "
                    . "" . cal($row[0]) . "
                                                
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>"
                    . "" . cal($nbt) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($vat) . "
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td><b>"
                    . "" . cal($grand) . "
                                            
                                        </b></td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    ";
        } else {
            $totby1 = $row[0] / 100;
            $totby1 = $totby1 * 15;

            $grand = $totby1 + $row[0];
            $ResponseXML .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            "
                    . "" . cal($row[0]) . "
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td>2%</td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td>15%</td>
                                        <td>"
                    . "" . cal($totby1) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                     <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td><b>"
                    . "" . cal($grand) . "
                                            
                                        </b></td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand - $_GET['Advance']) . "
                                            
                                        </td>
                                     
                                   
                                        <td></td>

                                    </tr>
                                   ";
        }
    }







    $ResponseXML .= "</tbody></table></div>";




    $ResponseXML .= "   </table>]]></sales_table>";


    $ResponseXML .= "</salesdetails>";


    echo $ResponseXML;
}
?>