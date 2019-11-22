<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Product Master<?php
                $sql = "SELECT docname from doc WHERE name = '" . $_GET['url'] . "'";
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
                    
                     <a onclick="NewWindow('search_product_master.php?stname=main', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>
                                        <a onclick="NewWindow('Search_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                                        </a>-->

                     <a  onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Delete
                    </a> 


                </div>
                <div id="msg_box"></div>


                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Product Ref</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_ref' class='form-control Name  input-sm' disabled="">
                         <input type='text' placeholder=''  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                         <input type='text' placeholder=''  id='up_flag' class='form-control Name hidden input-sm ' disabled="">
                         <!--hidden-->
                    </div>
                               
                    <label class='col-sm-2' for='c_code'>Status active / inactive</label>
                    <div class='col-sm-1'>
                        <input type='checkbox' placeholder=''  id='status'>
                    </div>
                    
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Name</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_name' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-2' for='c_code'>Product UOM</label>              
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_uom' class='form-control Name  input-sm'>
                    </div>
                </div>
                
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Group</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='group1' class='form-control Name  input-sm'>
                    </div>
                </div>
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Type</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='grp_type' class='form-control Name  input-sm'>
                    </div>
                </div>
                
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Length</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_length' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>Width</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_width' class='form-control Name  input-sm'>
                    </div>
                     <label class='col-sm-1' for='c_code'>Height</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='prod_height' class='form-control Name  input-sm'>
                    </div>
                </div>
                
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Width Inch.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='w_inches' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>SQF</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder=''  id='sqf' class='form-control Name  input-sm'>
                    </div>
                </div>
                
<br>
<br>
<br>
<br>

                  <div class='form-group'></div>
                    <div class='form-group-sm'>
                                     <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Finished Good Accrual Account</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="LC_1" name="LC_1" placeholder="Account Code" class="form-control  input-sm">
                                    </div>
                                  
                                    <div class="col-sm-3">
                                        <input type="text" id="LN_1" name="LN_1" placeholder="Account Name" class="form-control  input-sm">
                                    </div>
                                    <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_ledg.php?stname=pro_mas_led_1', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
                                    </div>
                    </div>

                    <div class='form-group'></div>
                    <div class='form-group-sm'>
                                     <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Finished Good Account</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="LC_2" name="LC_2" placeholder="Account Code" class="form-control  input-sm">
                                    </div>
                                  
                                    <div class="col-sm-3">
                                        <input type="text" id="LN_2" name="LN_2" placeholder="Account Name" class="form-control  input-sm">
                                    </div>
                                    <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_ledg.php?stname=pro_mas_led_2', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
                                    </div>
                    </div>


 <div class='form-group'></div>
                    <div class='form-group-sm'>
                                     <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Turnover Return Account</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="LC_3" name="LC_3" placeholder="Account Code" class="form-control  input-sm">
                                    </div>
                                  
                                    <div class="col-sm-3">
                                        <input type="text" id="LN_3" name="LN_3" placeholder="Account Name" class="form-control  input-sm">
                                    </div>
                                    <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_ledg.php?stname=pro_mas_led_3', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
                                    </div>
                    </div>


 <div class='form-group'></div>
                    <div class='form-group-sm'>
                                     <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Turnover Account</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="LC_4" name="LC_4" placeholder="Account Code" class="form-control  input-sm">
                                    </div>
                                  
                                    <div class="col-sm-3">
                                        <input type="text" id="LN_4" name="LN_4" placeholder="Account Name" class="form-control  input-sm">
                                    </div>
                                    <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_ledg.php?stname=pro_mas_led_4', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
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
<script src="js/product_master.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
                        new_inv();
</script> 