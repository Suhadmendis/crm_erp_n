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
            <script language="JavaScript" src="js/search_Manuel_aod.js"></script>



    </head>

    <body>



        <table width="735"   class="table table-bordered">
  <?php
                $stname = "";
                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }
                ?>


            <td width="16%"><div style="float: left;width: 65%;height: 32px;background-color: #3c8dbc;border-radius: 5px;"><p style="text-align: center;color: white;padding-top: 7px;font-size: 12px">MAOD/(CUS/SUP)</p></div><input style="float: right;width:30%" type="text" id="maod" value=""  class="form-control" tabindex="1" onkeyup="update_aod_list();"/></td>
            <td width="10%"><input type="text" id="date" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="18%"><input type="text" id="customer" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="24%"><input type="text" id="name" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="25%"><input type="text" id="item" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="7%"><input type="text" id="qty" value=""  class="form-control" onkeyup="update_aod_list();"/></td>

        </table>    

        <div id="filt_table" class="CSSTableGenerator"> 
            <table id="testTable"  class="table table-bordered">
                <?php

                   $stname = "";
                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }


                if ($stname == "dis_note") {
                     $sql2 = "select * from manuel_aod where type = 'CUSTOMER'";
                }else{
                     $sql2 = "select * from manuel_aod";
                }


               


             



                echo "<thead><tr>";
                echo "<th>MAOD NO</th>";
                echo "<th>Date</th>";
                echo "<th>Customer / Supplier</th>";
                echo "<th>Name</th>";
                echo "<th>Item</th>";
                echo "<th>Qty</th>";


                echo "</tr>";




                echo "</thead><tbody>";







                foreach ($conn->query($sql2) as $row) {
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
                        echo "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code','$stname');\">$cuscode</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code','$stname');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code','$stname');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"1\" onclick=\"custno('$code','$stname');\">" . $row['Name'] . "</a></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>";
                    } else {
                        echo "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code','$stname');\">$cuscode</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code','$stname');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code','$stname');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"$row4[0]\" onclick=\"custno('$code','$stname');\">" . $row['Name'] . "</a></td>";
                    }



                    foreach ($conn->query($sql3) as $row1) {

                        if ($row1['Product_Des'] == "") {
                            echo " <td onclick=\"custno('$code','$stname');\">&nbsp;</td>
                              <td onclick=\"custno('$code','$stname');\">&nbsp;</td>
                            </tr>";
                        } else {
                            echo " <td onclick=\"custno('$code','$stname');\">" . $row1['Product_Des'] . "</a></td>
                              <td onclick=\"custno('$code','$stname');\">" . $row1['QTY'] . "</a></td>
                            </tr>";
                        }
                    }
                }
                echo "</tbody>";
                ?>
            </table> </div>



    </body>
</html>
