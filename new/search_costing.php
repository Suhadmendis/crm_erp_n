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


<!-- 
            <script language="JavaScript" src="js/search_joborder.js"></script> -->

            <script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>






            <script language="JavaScript" src="js/costing.js"></script>


    </head>



    <body >



        <?php if (isset($_GET['cur'])) { ?>

            <input type="hidden" value="<?php echo $_GET['cur']; ?>" id="cur" />

            <?php
        } else {
            ?>

            <input type="hidden" value="" id="cur" />

            <?php
        }
        ?>

        <?php if (isset($_GET['cur'])) { ?>

            <input type="hidden" value="<?php echo $_GET['cur']; ?>" id="stname" />

            <?php
        } else {
            ?>

            <input type="hidden" value="" id="stname" />

            <?php
        }
        ?>

 <!--        <table width="735" id="filt_table" class="table table-bordered">

            <tr>

                <?php
                $stname = "";

                if (isset($_GET['stname'])) {
                    $stname = $_GET["stname"];
                }
                ?>

                <td width="122"><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                <td width="424"><input type="text" size="70" name="customername" id="customername" value=""  class="form-control" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>

        </table> -->
<br><br>
        <div id="filt_table" class="CSSTableGenerator container">

            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ref No</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Factory</th>
                        <th>Product</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from costing_details";
                   
                    foreach ($conn->query($sql) as $row) {

                        $cuscode = $row['ref_no'];
                        echo "<tr>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['ref_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['co_date'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customerName'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['factory'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['description'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['req_qty'] . "</a></td>
                            </tr>";
                    }
                    ?>

                </tbody>

              <!--   <tfoot>
                    <tr>
                        <tr>
                            <th>Ref No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Factory</th>
                            <th>Product</th>
                            <th>Qty</th>
                        </tr>
                    </tr>
                </tfoot>
 -->

            </table>
        </div>





<!--         <script>
            $(document).ready(function () {
// Setup - add a text input to each footer cell
                $('#example tfoot th').each(function (i) {
                    var title = $('#example thead th').eq($(this).index()).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" data-index="' + i + '" />');
                });

// DataTable
                var table = $('#example').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: true
                });

// Filter event handler
                $(table.table().container()).on('keyup', 'tfoot input', function () {
                    table
                            .column($(this).data('index'))
                            .search(this.value)
                            .draw();
                });
            });
        </script> -->

<!-- 
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script> -->

        <script type="text/javascript">
    $(document).ready(function() {
        $('#example').dataTable( {
          "pageLength": 15
        } );
    } );

</script>
    </body>
</html>
