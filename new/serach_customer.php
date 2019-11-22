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



            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">



            <!-- <script language="JavaScript" src="js/search_joborder.js"></script> -->

            <script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


        <script language="JavaScript" src="js/cusmas.js"></script>
            <!-- <script language="JavaScript" src="js/search_quotation.js"></script> -->



    </head>

    <body>


        <?php
        $stname = "";
        if (isset($_GET['stname'])) {
            $stname = $_GET["stname"];
        }
        ?>
<input type="hidden" value="" id="cur" />

<!--        <table width="735"   class="table table-bordered">



            <td width="16%"><div style="float: left;width: 65%;height: 32px;background-color: #3c8dbc;border-radius: 5px;"><p style="text-align: center;color: white;padding-top: 7px;font-size: 12px">MAOD/(CUS/SUP)</p></div><input style="float: right;width:30%" type="text" id="maod" value=""  class="form-control" tabindex="1" onkeyup="update_aod_list();"/></td>
            <td width="10%"><input type="text" id="date" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="18%"><input type="text" id="customer" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="24%"><input type="text" id="name" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="25%"><input type="text" id="item" value=""  class="form-control" onkeyup="update_aod_list();"/></td>
            <td width="7%"><input type="text" id="qty" value=""  class="form-control" onkeyup="update_aod_list();"/></td>

        </table>    -->

        <div id="filt_table" class="CSSTableGenerator container"> 
            <table id="testTable"  class="table table-bordered">
                <?php
                $sql2 = "SELECT * from vendor where CAT = 'C' order by code";




                echo "<table id='example'  class='table table-bordered'>";

                echo "<thead><tr>";
                echo "<th>Customer No</th>";
                echo "<th>Customer Name</th>";
                echo "<th>Address</th>";
              

                echo "</tr></thead><tbody>";




                foreach ($conn->query($sql2) as $row) {

 $cuscode = $row['CODE'];
                   

                         echo "<tr>               

                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['CODE'] . "</a></td>

                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['NAME'] . "</a></td>

                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['ADD1'] . "</a></td>

                            </tr>";
                }
                ?>
            </table> </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').dataTable( {
          "pageLength": 17
        } );
    } );

</script>

    </body>
</html>
