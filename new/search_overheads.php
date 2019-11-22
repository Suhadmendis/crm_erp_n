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


            <script language="JavaScript" src="js/search_overheads.js"></script>

    </head>

    <body>

        <?php if (isset($_GET['cur'])) { ?>
            <input type="hidden" value="<?php echo $_GET['cur']; ?>" id="cur" />
            <?php
        } else {
            ?>
            <input type="hidden" value="" id="cur" />
            <?php
        }
        ?>
        <table width="735"   class="table table-bordered">

            <tr>
                <?php
                $stname = "";
                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }
                ?>
                <?php if ($stname == "PORN") { ?>

                    <td width="122" ><input type="text" size="20" name="id" id="reference_no" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="400" ><input type="text" size="70" name="ref" id="manual_no" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="date" size="70" name="productname" id="dateText" value=""  class="form-control" onchange="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "POED") { ?>

                    <td width="122" ><input type="text" size="20" name="reference_no" id="reference_no" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="300" ><input type="text" size="70" name="manual_no" id="manual_no" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="124" ><input type="text" size="70" name="job_no" id="job_no" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "SIVE") { ?>

                    <td width="122" ><input type="text" size="20" name="reference_no" id="reference_no" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="300" ><input type="text" size="70" name="manual_no" id="manual_no" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="124" ><input type="text" size="70" name="currency_code" id="currency_code" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "PRNTR") { ?>
                    <!--janith Search-->
                    <td width="110" ><input type="text" size="20" id="cusno"  value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="text" size="70" id="customername1"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="text" size="70" id="customername2"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "POSER") { ?> 

                    <td width="110" ><input type="text" size="20" id="cusno"  value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="text" size="70" id="customername1"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="text" size="70" id="customername2"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "SUBCONTRACTOR") { ?> 

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="date" size="70" id="customername1" value=""  class="form-control" onchange="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "PAYMENTVOUCHER") { ?> 

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="date" size="70" id="customername1" value=""  class="form-control" onchange="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "GRNNOTE") { ?> 

                    <td width="110" ><input type="text" size="20" id="cusno"  value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="text" size="70" id="customername1"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="date" size="70" id="customername2"  value=""  class="form-control" onchange="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "GRNRECEIVED") { ?> 

                    <td width="110" ><input type="text" size="20" id="cusno"  value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="200" ><input type="date" size="70" id="customername1"  value=""  class="form-control" onchange="<?php echo "update_cust_list('$stname')"; ?>"/></td>   
                    <td width="200" ><input type="text" size="70" id="customername2"  value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } ?>





        </table>    
        <div id="filt_table" class="CSSTableGenerator">  <table width="735"   class="table table-bordered">

                <?php
                if ($stname == "lab") {

                    echo '<tr>
                    <th>Reference No</th>
                    <th>Despriction</th>
                          </tr>';
                    $sql = "SELECT * from labour_mas ";
                    
                } else if ($stname == "var_o_h") {

                    echo ' <tr>
                   <th>Reference No</th>
                    <th>Despriction</th>
                </tr>';
                    $sql = "SELECT * from voh_mas ";
                } else if ($stname == "foh") {

                    echo ' <tr>
                    <th>Reference No</th>
                    <th>Despriction</th>
                </tr>';
                    $sql = "SELECT * from foh_mas ";
                }
                // common sql part
                $sql = $sql . "order by STK_NO limit 50";
                //

                if ($stname == "lab") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['STK_NO'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['STK_NO'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['DESCRIPT'] . "</a></td>
                        </tr>";
                    }
                } else if ($stname == "var_o_h") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['STK_NO'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['STK_NO'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['DESCRIPT'] . "</a></td>
                        </tr>";
                    }
                } else if ($stname == "foh") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['STK_NO'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['STK_NO'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['DESCRIPT'] . "</a></td>
                        </tr>";
                    }
                } 
                
                ?>
            </table>
        </div>

    </body>
</html>
