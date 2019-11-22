<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Sales Executive Master 
            <?php
            $sql = "SELECT docname from doc_acc WHERE name = '" . $_GET['url'] . "'";
            $result = $conn->query($sql);
            $row = $result->fetch();

            echo $row['docname'];
            ?>      </h3>
        </div>      


        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">


                <div class="form-group">
                    <a style="margin-left: 10px;"  onclick="new_inv();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save 
                    </a>

                    <a onclick="NewWindow('search_sales_executive_master.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 


                </div>
                <div id="msg_box"></div>


                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Sales Executive Ref</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='se_ref' class='form-control Name  input-sm' disabled="">
                        <input type='text' placeholder='uniq'  id='uniq' class='form-control Name hidden input-sm ' disabled="">

                    </div>
                    <label class='col-sm-2' for='c_code'>NIC</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='nic' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Sales Executive Name</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='se_name' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-2' for='c_code'>Address</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='addr' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Mobile No</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='mobile' class='form-control Name  input-sm'>   
                    </div>
                    <label class='col-sm-2' for='c_code'>E-Mail</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='email' class='form-control Name  input-sm'>
                    </div>

                </div>





            </div>   

    </div>
</form>


<br>
<br>
<br>
<br>

</div>    

</section>
<script src="js/sales_executive_master.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
                        new_inv();
</script> 