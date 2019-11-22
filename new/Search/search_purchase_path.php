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


            <script language="JavaScript" src="js/search_purchase_path.js"></script>

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

                <?php } else if ($stname == "GRNDETAILS") { ?> 

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } ?>





        </table>    
        <div id="filt_table" class="CSSTableGenerator">  <table width="735"   class="table table-bordered">

                <?php
                if ($stname == "PORN") {

                    echo ' <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Manual No</th>
                    <th>Remarks</th>  
                </tr>';
                    $sql = "SELECT * from po_requisition_note_dummy ";
                } else if ($stname == "POED") {

                    echo ' <tr>
                     <th>Reference No</th>
                    <th>manual No</th>
                    <th>Job No</th>     
                </tr>';
                    $sql = "SELECT * from purchase_order_entry_dummy ";
                } else if ($stname == "SIVE") {

                    echo ' <tr>
                    <th>Reference No</th>
                    <th>Currency Code</th>
                    <th>Manual No</th>
                    <th>Date</th>
                </tr>';
                    $sql = "SELECT * from service_invoice ";
                } else if ($stname == "GRN") {

                    echo ' <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Manual Ref No</th> 
                   </tr>';
                    $sql = "SELECT * from good_received_note_entry ";
                } else if ($stname == "PRNTR") {

                    echo ' <tr>
                    <th >Reference NO</th>
                    <th >Manual No</th>
                    <th >Remarks</th>
                   </tr>';
                    $sql = "SELECT * from po_requistion_note ";
                } else if ($stname == "POSER") {

                    echo ' <tr>
                     <th>Reference No</th>
                     <th>Manual No</th>
                     <th>po Requisition</th>
                   </tr>';
                    $sql = "SELECT * from purchase_order_entry ";
                } else if ($stname == "SUBCONTRACTOR") {

                    echo ' <tr>
                    <th>Reference No.</th>
                    <th>Date.</th>
                    <th>SC PO No.</th>
                   </tr>';
                    $sql = "SELECT * from subcontractordtls ";
                } else if ($stname == "PAYMENTVOUCHER") {

                    echo ' <tr>
                    <th>Ref No.</th>
                    <th>Date.</th>
                    <th>Currency Code</th>
                   </tr>';
                    $sql = "SELECT * from paymentvoucher ";
                } else if ($stname == "GRNNOTE") {

                    echo ' <tr>
                    <th width="110">Reference No</th>
                    <th width="200">Manual No</th>
                    <th width="200">Date</th>
                   </tr>';
                    $sql = "SELECT * from good_return_note_entry ";
                } else if ($stname == "GRNRECEIVED") {

                    echo ' <tr>
                     <th width="110">Reference No</th>
                    <th width="200">Date</th>
                    <th width="200">Purchase Order No</th>
                   </tr>';
                    $sql = "SELECT * from good_received_note_ent ";
                } else if ($stname == "GRNDETAILS") {

                    echo ' <tr>
                     <th>Ref No.</th>   
                     <th>Manual No.</th>
                     <th>Date.</th>
                   </tr>';
                    $sql = "SELECT * from grndetails ";
                }

                // common sql part
                //
                if ($stname == "PORN") {

                    $sql = $sql . "order by reference_no limit 50";
                } else if ($stname == "POED") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SIVE") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "GRN") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "PRNTR") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "POSER") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SUBCONTRACTOR") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "PAYMENTVOUCHER") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "GRNNOTE") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "GRNRECEIVED") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "GRNDETAILS") {

                    $sql = $sql . " order by referenceno limit 50";
                }


                if ($stname == "PORN") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['remarks'] . "</a></td>
                        </tr>";
                    }
                } else if ($stname == "POED") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['job_no'] . "</a></td>                      
                            </tr>";
                    }
                } else if ($stname == "SIVE") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['currency_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                            </tr>";
                    }
                } else if ($stname == "GRN") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>        
                            </tr>";
                    }
                } else if ($stname == "PRNTR") {
                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['remarks'] . "</a></td>
                              
                           </tr>";
                    }
                } else if ($stname == "POSER") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['po_requisition'] . "</a></td>
                           </tr>";
                    }
                } else if ($stname == "SUBCONTRACTOR") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scpono'] . "</a></td>
                             </tr>";
                    }
                } else if ($stname == "PAYMENTVOUCHER") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['pvdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['currencycode'] . "</a></td>
                             </tr>";
                    }
                } else if ($stname == "GRNNOTE") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                              
                           </tr>";
                    }
                } else if ($stname == "GRNRECEIVED") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['purchase_order_no'] . "</a></td>
                              
                           </tr>";
                    }
                } else if ($stname == "GRNDETAILS") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['referenceno'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['referenceno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manualrefno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['grndate'] . "</a></td>
                             </tr>";
                    }
                }
                ?>
            </table>
        </div>

    </body>
</html>
