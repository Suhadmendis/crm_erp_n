<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Department Master<?php
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

                    <a onclick="NewWindow('search_dept_master.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>
                                        <a onclick="NewWindow('Search_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                                        </a>-->

                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 


                </div>
                <div id="msg_box"></div>


                <div class='form-group'></div>
                
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Dept No.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Dept No.'  id='dpt_no' class='form-control Name  input-sm' disabled="">
                        <input type='text' placeholder='uniq'  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                        <!--hidden-->
                    </div>
                </div>
              

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Department Name</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Department Name'  id='dpt_name' class='form-control Name  input-sm'>
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
<script src="js/dept_master.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
                            new_inv();
</script> 