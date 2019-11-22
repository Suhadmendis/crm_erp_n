<?php
session_start();
include_once './connection_sql.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />


        <title>Search Customer</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <!--<script language="JavaScript" src="js/cusmas.js"></script>-->
            <script language="JavaScript" src="js/search_proforma_invoice.js"></script>



    </head>

    <body>



<!--        <table width="735"   class="table table-bordered">



            <td width="16%"><div style="float: left;width: 65%;height: 32px;background-color: #3c8dbc;border-radius: 5px;"><p style="text-align: center;color: white;padding-top: 7px;font-size: 12px">MAOD/(CUS/SUP)</p></div><input style="float: right;width:30%" type="text" id="maod" value=""  class="form-control" tabindex="1" onkeyup="update_aod_list();"/></td>
            <td width="10%"><input type="text" id="date" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="18%"><input type="text" id="customer" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="24%"><input type="text" id="name" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="25%"><input type="text" id="item" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="7%"><input type="text" id="qty" value=""  class="form-control" onkeyup="update_aod_list();"/></td>

        </table>    -->

        <div id="filt_table" class="CSSTableGenerator"> 
            <table id="testTable"  class="table table-bordered">
                <?php
                $sql2 = "select * from proforma_invoice";

                echo "<thead><tr>";
                echo "<th>Invoice NO</th>";
                echo "<th>Invoice Date</th>";
                echo "<th>Customer Name</th>";
                echo "<th>Item</th>";
                echo "<th>QTY</th>";
                echo "<th>Unit Price</th>";
                echo "<th>Value without Tax</th>";
                echo "<th>Value with Tax</th>";

                echo "</tr>";

                echo "</thead><tbody>";

                foreach ($conn->query($sql2) as $row) {
                    //$cuscode = $row['Invoice_Number'];
                    $code = $row['Invoice_Number'];


                    $sql3 = "select * from proforma_invoice_table where Invoice_Number = '" . $row['Invoice_Number'] . "'";


                    $sql4 = "select count(Invoice_Number) from proforma_invoice_table where Invoice_Number = '" . $row['Invoice_Number'] . "'";
                    $resul = $conn->query($sql4);
                    $row4 = $resul->fetch();



                    if (strlen($code) == 1) {
                        $code = "ccs/Pro/19-0000" . $code;
                    } else if (strlen($code) == 2) {
                        $code = "ccs/Pro/19-000" . $code;
                    } else if (strlen($code) == 3) {
                        $code = "ccs/Pro/19-00" . $code;
                    } else if (strlen($code) == 4) {
                        $code = "ccs/Pro/19-0" . $code;
                    }

                    $invonumber = $row['Invoice_Number'];

                    if ($row4[0] == 0) {
                        echo "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $code . "</td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Invoice_Date'] . "</td>
                              <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Customer_Name'] . "</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>";
                    } else {
                        echo "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $code . "</td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Invoice_Date'] . "</td>                            
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Customer_Order_No'] . "</td>
                               ";
                    }



                    foreach ($conn->query($sql3) as $row1) {

                        $valwithtax = 00.00;
                        $inv_name = "";

                        $valwithtax = $row1['Unit_Price'] * $row1['QTY'];

                        if ($row['svatboo'] == 1) {
                            //tot price

                            if ($row['nbtboo'] == 1) {


                                $inv_name = "";
                            } else {


                                $inv_name = "";
                            }
                        } else {
                            if ($row['nbtboo'] == 1) {
                                $tempval = $valwithtax;
                                $valwithtax = $valwithtax / 100 * 2;
                                $valwithtax = $valwithtax + $tempval;

                                $tempval = $valwithtax;
                                $valwithtax = $valwithtax / 100 * 15;
                                $valwithtax = $valwithtax + $tempval;
                                $inv_name = "+ NBT + VAT";
                            } else {



                                $tempval = $valwithtax;
                                $valwithtax = $valwithtax / 100 * 15;
                                $valwithtax = $valwithtax + $tempval;

                                $inv_name = "+ VAT";
                            }
                        }


 // It's a string from a DB

$valwithtax = number_format((float)$valwithtax, 2, '.', '');



                        echo " <td onclick=\"custno('$code');\">" . $row1['Description'] . "</td>
                              <td onclick=\"custno('$code');\">" . $row1['QTY'] . "</td>
                              <td onclick=\"custno('$code');\">" . $row1['Unit_Price'] . "</td>
                              <td onclick=\"custno('$code');\">" . $row1['Value'] . "</td>
                              <td onclick=\"custno('$code');\">" . $valwithtax . " " . $inv_name . " </td>
                            </tr>";
                    }
                }
                echo "</tbody>";
                ?>
            </table> </div>



    </body>
</html>
