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


            <script language="JavaScript" src="js/search_sample_jobrequest_note.js"></script>



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
<!--                <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <td width="24" ><input type="text" size="70" id="customername1" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <td width="24" ><input type="text" size="70" id="customername2" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>-->
                <!--<td width="24" ><input type="text" size="70" name="customername" id="customername" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>-->
        </table>    
        <div id="filt_table" class="CSSTableGenerator">  <table width="735"   class="table table-bordered">
                <tr>
                    <th>SJ Request No.</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Mk. Ex</th>
                    <th>Item Description</th>
                    <th>Sample Qty</th>
                    <th>Prpared by</th>
                </tr>
                <?php

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

                $sql = "SELECT samplejobreqnote.jrid,samplejobreqnote.jobreqdate,samplejobreqnote.customer,samplejobreqnote.mkex,samplejobreqnote_table.des,samplejobreqnote_table.qty,samplejobreqnote.username FROM samplejobreqnote INNER JOIN samplejobreqnote_table ON samplejobreqnote.jrid = samplejobreqnote_table.jrid ";

                $sql = $sql . " order by jrid limit 50";

                $stname = "";
                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }

                foreach ($conn->query($sql) as $row) {





                    if ($cuscode != $row['jrid']) {
                        $cuscode = $row['jrid'];
  
                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . generateId($row['jrid'], "SJR/", "post") . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['jobreqdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['mkex'] . "</a></td>";
                    } else {

                        echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\"></a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\"></a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\"></a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\"></a></td>";
                    }



                    echo "   <td onclick=\"custno('$cuscode', '$stname');\">" . $row['des'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['qty'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['username'] . "</a></td>
                             </tr>";
                }
                ?>
            </table>
        </div>

    </body>
</html>
