<?php

session_start();



include_once './connection_sql.php';



if ($_GET["Command"] == "search_aod") {


    $ResponseXML = "";




    $ResponseXML .= "<table id=\"testTable\"  class=\"table table-bordered\">";

    $ResponseXML .= "<thead><tr>";
    $ResponseXML .= "<th>MAOD NO</th>";
    $ResponseXML .= "<th>Date</th>";
    $ResponseXML .= "<th>Customer / Supplier</th>";
    $ResponseXML .= "<th>Name</th>";
    $ResponseXML .= "<th>Item</th>";
    $ResponseXML .= "<th>Qty</th>";

    $ResponseXML .= "</tr>";

    $ResponseXML .= "</thead><tbody>";




    $sql = "Select * from manuel_aod where aod_number <> ''";

    if ($_GET['maod'] != "") {
        $sql .= " and aod_number like '%" . $_GET['maod'] . "%'";
    }
    if ($_GET['date'] != "") {
        $sql .= " and dod like '%" . $_GET['date'] . "%'";
    }
    if ($_GET['customer'] != "") {
        $sql .= " and type like '%" . $_GET['customer'] . "%'";
    }
    if ($_GET['name'] != "") {
        $sql .= " and Name like '%" . $_GET['name'] . "%'";
    }
    if ($_GET['item'] != "") {
        $sql .= " and Product_Des like '%" . $_GET['item'] . "%'";
    }
    if ($_GET['qty'] != "") {
        $sql .= " and QTY like '%" . $_GET['qty'] . "%'";
    }

    $sql .= " ORDER BY aod_number limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['aod_number'];
        $code = $row['aod_number'];
        $sql3 = "select * from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";


        $sql4 = "select count(aodnumber) from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";
        $resul = $conn->query($sql4);
        $row4 = $resul->fetch();


        $type = "";
        if ($row['type'] == "CUSTOMER") {
            $type = "CUS";
        } else {
            $type = "SUP";
        }

        if (strlen($cuscode) == 1) {
            $cuscode = "MAOD/$type/0000" . $cuscode;
        } else if (strlen($cuscode) == 2) {
            $cuscode = "MAOD/$type/000" . $cuscode;
        } else if (strlen($cuscode) == 3) {
            $cuscode = "MAOD/$type/00" . $cuscode;
        } else if (strlen($cuscode) == 4) {
            $cuscode = "MAOD/$type/0" . $cuscode;
        }




        if ($row4[0] == 0) {
            $ResponseXML .= "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>";
        } else {
            $ResponseXML .= "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>";
        }



        foreach ($conn->query($sql3) as $row1) {

            if ($row1['Product_Des'] == "") {
                $ResponseXML .= " <td onclick=\"custno('$code');\">&nbsp;</td>
                              <td onclick=\"custno('$code');\">&nbsp;</td>
                            </tr>";
            } else {
                $ResponseXML .= " <td onclick=\"custno('$code');\">" . $row1['Product_Des'] . "</a></td>
                              <td onclick=\"custno('$code');\">" . $row1['QTY'] . "</a></td>
                            </tr>";
            }
        }
    }
    $ResponseXML .= "</tbody></table>";


















    echo $ResponseXML;
}


if ($_GET["Command"] == "pass_quot") {




    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from temporary_manual_invoice where Invoice_Number ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['Invoice_Number'] . "]]></id>";
        $ResponseXML .= "<str1><![CDATA[" . $row['Invoice_Date'] . "]]></str1>";
        $ResponseXML .= "<str2><![CDATA[" . $row['Settlement_Due'] . "]]></str2>";
        $ResponseXML .= "<str3><![CDATA[" . $row['Customer_Order_No'] . "]]></str3>";
        $ResponseXML .= "<str4><![CDATA[" . $row['ouraodnumber'] . "]]></str4>";
        $ResponseXML .= "<str5><![CDATA[" . $row['Currency'] . "]]></str5>";
        $ResponseXML .= "<str6><![CDATA[" . $row['NBT'] . "]]></str6>";
        $ResponseXML .= "<str7><![CDATA[" . $row['VAT'] . "]]></str7>";


        $ResponseXML .= "<str8><![CDATA[" . $row['svatboo'] . "]]></str8>";
        $ResponseXML .= "<str9><![CDATA[" . $row['vatboo'] . "]]></str9>";
        $ResponseXML .= "<str10><![CDATA[" . $row['nbtboo'] . "]]></str10>";
        $ResponseXML .= "<str11><![CDATA[" . $row['Customer_Name'] . "]]></str11>";
        $ResponseXML .= "<str12><![CDATA[" . $row['Customer_Address'] . "]]></str12>";
        

        $ResponseXML .= "<str13><![CDATA[" . $row['SVAT'] . "]]></str13>";

        $ResponseXML .= "<str14><![CDATA[" . $row['no'] . "]]></str14>";
        $ResponseXML .= "<str15><![CDATA[" . $row['rate'] . "]]></str15>";
        
        $ResponseXML .= "<str16><![CDATA[" . $row['Advance'] . "]]></str16>";
        
        
    }


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "updateTable") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT * FROM temporary_manual_invoice_table WHERE Invoice_Number = '" . $_GET['Invoice_Number'] . "'";


    $qty = "QTY";


    $rows .= "<br><table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>QTY</th>
                                        <th style='width: 70%;'>Description</th>
                                        <th style='width: 10%;'>Unit Price</th>
                                        <th style='width: 10%;'>Value</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   ";




    $sql1 = "SELECT * FROM temporary_manual_invoice_table WHERE Invoice_Number = '" . $_GET['Invoice_Number'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $rows .= "<tr><td>" . $row2['QTY'] . "</td><td>" . $row2['Description'] . "</td><td>" . $row2['Unit_Price'] . "</td><td>" . $row2['Value'] . "</td></tr>";
    }


    $sqlmain = "Select * from temporary_manual_invoice where Invoice_Number ='" . $_GET['Invoice_Number'] . "'";
    $result = $conn->query($sqlmain);
    $rowmain = $result->fetch();

    $sqltot = "SELECT sum(value) from  temporary_manual_invoice_table where Invoice_Number = '" . $_GET['Invoice_Number'] . "'";
    $result = $conn->query($sqltot);
    $row11 = $result->fetch();

    $adv = "SELECT Advance from temporary_manual_invoice where Invoice_Number = '" . $_GET['Invoice_Number'] . "'";
    $result = $conn->query($adv);
    $advance = $result->fetch();




    if ($rowmain['svatboo'] == 1) {
        if ($rowmain['nbtboo'] == 1) {

            $totby1 = $row11[0] / 100;
            $nbt = $totby1 * 2;

            $svat = $nbt + $row11[0];
            $svat = $svat / 100;
            $svat = $svat * 15;
            $grand = $row11[0] + $nbt;
            $rows .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td>$row11[0] </td>
                                        <td>
                                            "
                    . "" . cal($row11[0]) . "
                                                
                                        </td>
                                     
                                   
                                     

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
                                     
                                   
                                    

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td>"
                    . "" . cal($svat) . "</td>
                                        <td>
                                         
                                        </td>
                                     
                                   
                                     

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>
                                    

                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand-$advance[0]) . "
                                            
                                        </td>
                                     
                                    </tr>   
                                    

                                ";
        } else {


            $totby1 = $row11[0] / 100;
            $totby1 = $totby1 * 15;
//            $totby1 = $totby1 + $row11[0];



            $rows .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>" . $row11[0] . "
                                            
                                                
                                        </td>
                                     
                                   
                                      

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                    
                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                      

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td>" . cal($totby1) . "</td>
                                        <td>
                                           
                                        </td>
                                     
                                   
                                       

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row11[0]) . "
                                            
                                        </td>
                                     
                                   
                                      

                                    </tr>
                                    
    

                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand-$row11[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                    

                                ";
        }
    } else {
        if ($rowmain['nbtboo'] == 1) {
            $totby1 = $row11[0] / 100;
            $nbt = $totby1 * 2;

            $totby1 = $row11[0] + $nbt;
            $totby1 = $totby1 / 100;
            $vat = $totby1 * 15;

            $grand = $row11[0] + $vat + $nbt;

            $rows .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            " . $row11[0] . "
                                                
                                        </td>
                                     
                                   
                                      
                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($nbt) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($vat) . "
                                        </td>
                                     
                                   

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           
                                        </td>
                                     
                                   
                                      

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "
                                        </td>
                                     
                                   
                                       

                                    </tr>
                                    
    

                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand-$advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                    

                                ";
        } else {
            $totby1 = $row11[0] / 100;
            $totby1 = $totby1 * 15;

            $grand = $totby1 + $row11[0];
            $rows .= "<tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($row11[0]) . "
                                            
                                                
                                        </td>
                                     
                                   

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                     
                                   
                                      

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($totby1) . "
                                            
                                        </td>
                                     
                                   
                                       

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>
                                           
                                        </td>
                                     
                                   
                                       

                                    </tr>
                                    <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand) . "
                                            
                                        </td>
                                     
                                   
                                     

                                    </tr>
                                    
    

                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                <tr style='text-align: right;'>
                                        <td></td>
                                        <td>
                                            <label>Balance to be Paid</label>
                                        </td>
                                        <td></td>
                                        <td>"
                    . "" . cal($grand-$advance[0]) . "
                                            
                                        </td>
                                     
                                   
                                    

                                    </tr>   
                                    

                                ";
        }
    }


    $rows .= "</tbody></table>";




    $rows .= "   </table>";



    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

function cal($val) {

    $backfront = explode(".", $val);
    if ($backfront[1] == NULL) {
        return $backfront[0] . ".0000";
    } else {
        return $backfront[0] . "." . substr($backfront[1], 0, 4);
    }
}

?>
