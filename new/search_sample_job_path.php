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


            <script language="JavaScript" src="js/search_sample_job_path.js"></script>

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
                <?php if ($stname == "SAMPLE_JOB_REQUEST_NOTE") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "SAMPLE_JOB_ORDER") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

                <?php } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <?php } else if ($stname == "SAMPLE_JOB_TRANSFER") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <?php } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <?php } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") { ?>

                    <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <?php } ?> 

        </table>    
        <div id="filt_table" class="CSSTableGenerator">  <table width="735"   class="table table-bordered">

                <?php
                if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

                    echo ' <tr>
                    <th>SJ Request Ref</th>
                    <th>SJ Request Date</th>
                    <th>Customer Ref</th> 
                </tr>';
                    $sql = "SELECT * from samplejobreqnote";
                } else if ($stname == "SAMPLE_JOB_ORDER") {

                    echo ' <tr>
                   <th>SJ Request No</th>
                   <th>SJB Ref</th>
                   <th>Customer</th> 
                </tr>';
                    $sql = "SELECT * from samplejoborder ";
                } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

                    echo ' <tr>
                    <th>SJB NO.</th>
                    <th>SJB MRN Ref</th>
                    <th>Date</th>
                </tr>';
                    $sql = "SELECT * from samplejobmatirealissue ";
                } else if ($stname == "SAMPLE_JOB_TRANSFER") {

                    echo ' <tr>
                     <th>Sample Job Transfer no.</th>
                    <th>Date</th>
                    <th>Customer</th>
                </tr>';
                    $sql = "SELECT * from samplejobtransfer ";
                } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") {

                    echo ' <tr>
                     <th>Sample Job Transfer no.</th>
                    <th>A.O.D. Ref</th>
                    <th>Customer</th>
                </tr>';
                    $sql = "SELECT * from sampledeliverynote ";
                } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

                    echo ' <tr>
                     <th>SJB No.</th>
                    <th>SJB MRN Ref</th>
                    <th>Date</th>
                </tr>';
                    $sql = "SELECT * from samplejobmatreq ";
                }

                if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SAMPLE_JOB_ORDER") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SAMPLE_JOB_TRANSFER") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") {

                    $sql = $sql . " order by reference_no limit 50";
                } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

                    $sql = $sql . " order by reference_no limit 50";
                }

                if ($stname == "SAMPLE_JOB_REQUEST_NOTE") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobreqdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer_ref'] . "</a></td>
                             </tr>";
                    }
                } else if ($stname == "SAMPLE_JOB_ORDER") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>       
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                           
                            </tr>";
                    }
                } else if ($stname == "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>       
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['mrnref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['issueddate'] . "</a></td>
                           
                            </tr>";
                    }
                } else if ($stname == "SAMPLE_JOB_TRANSFER") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjtdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                             </tr>";
                    }
                } else if ($stname == "SAMPLE_DELIVERY_NOTE_DATA") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['aod'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                             </tr>";
                    }
                } else if ($stname == "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

                    foreach ($conn->query($sql) as $row) {
                        $cuscode = $row['reference_no'];
                        echo "<tr>       
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbmrnref'] . "</a></td>
                           
                            </tr>";
                    }
                }
                ?>
            </table>
        </div>

    </body>
</html>
