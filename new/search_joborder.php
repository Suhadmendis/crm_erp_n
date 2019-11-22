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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">



            <script language="JavaScript" src="js/search_joborder.js"></script>

<script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>




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
               <!--  <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td> -->

                <!--<td width="24" ><input type="text" size="70" name="customername" id="customername" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>-->
        </table>    
        <div id="filt_table" class="CSSTableGenerator"> 
 















<div class="container">


            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Job Code</th>
                    <th>Job Order Ref</th>
                    <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * from joborder where Cancel='0'";


                // $sql = $sql . " order by jid limit 50";

                $stname = "";
                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }

                foreach ($conn->query($sql) as $row) {
                    $cuscode = $row['jid'];
                    


                    if ($stname == "pickJOB") {

                        $sqltempCal = "SELECT joborder_mat_table_temp.qty,joborder_mat_table_temp.item_code from joborder_mat_table_temp join joborder on joborder_mat_table_temp.jcode = joborder.jid where joborder_mat_table_temp.jcode = '$cuscode'";


                        $Block = "ON";
                        foreach ($conn->query($sqltempCal) as $rowtempCal) {

                           
                                
                               $sqltemp01Cal = "SELECT SUM(cur_qty) from tmp_stock_adjust_data where txt_jobno = '$cuscode' and str_code = '" . $rowtempCal['item_code'] . "'";                     


                            $resultt = $conn->query($sqltemp01Cal);
                            $rowtemp02 = $resultt->fetch();



                            if ($rowtempCal['item_code'] != "MM0010100") {

                                if (number_format($rowtempCal['qty'],4) == number_format($rowtemp02[0],4)) {
                                   
                                }else{
                                    $Block = "OFF";
                                   

                                }
                                

                            }
                            

                        }



                        //switch

                        if ($Block == "OFF") {
                            
                            echo "<tr>    
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jid'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['joborderref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobdate'] . "</a></td>
                            </tr>";

                        }
                        
                    }else{
                         echo "<tr>    
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jid'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['joborderref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobdate'] . "</a></td>
                            </tr>";
                    }
                   
                }
                ?>
          
        </tbody>
        <tfoot>
            <tr>
                <th>Job Code</th>
                    <th>Job Order Ref</th>
                    <th>Date</th>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
        "order": [[ 0, "desc" ]],
        "pageLength": 25
    });
    } );
</script>



        </div>

    </body>
</html>
