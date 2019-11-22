<!-- Main content -->
<?php
require_once './connection_sql.php';
?>
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dispatch Note</h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">
                <input type="hidden" id="tmpno" value="" class="form-control">
                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group">
                    <a onclick="sess_chk('new', 'crn');" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>
                    <a onclick="sess_chk('save', 'crn');" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <a onclick="sess_chk('print', 'crn');" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a>

                    <a onclick="sess_chk('cancel', 'crn');" class="btn btn-danger btn-sm">
                        <span class="fa fa-trash-o"></span> &nbsp; Cancel
                    </a>

                </div>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="form-group">
                    <label class="col-sm-2 " for="invno">Ref No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Ref No" id="txt_entno" class="form-control  input-sm">
                    </div>
                    <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('serach_gin.php?stname=dp', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="..." id="searchcust" name="searchcust">
                        </a>
                    </div>
                    <label class="col-sm-2" for="invdate">Date</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Date" id="invdate" value="<?php echo date('Y-m-d'); ?>" class="form-control dt input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="invno">FG No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="FG No" id="txt_jobno" class="form-control  input-sm">
                    </div>
                    <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('serach_gin.php?stname=pick_fg', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="...">
                        </a>
                    </div>
                    
                      <label class="col-sm-2" for='c_code'>Manuel Aod</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Manuel Aod'  id='manuel_aod' class='form-control Name  input-sm'>
                </div>
                 <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('Search_Manuel_AOD.php?stname=dis_note', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="...">
                        </a>
                    </div>


                </div>





                <div class='form-group'></div>
                <div class='form-group'>
                <label class="col-sm-2" for='c_code'>Job No</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Job No'  id='job_no' class='form-control Name  input-sm'>
                </div>
            
                </div>


                <div class='form-group'>
                <label class="col-sm-2" for='c_code'>Customer Name</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='customer_name'  id='customer_name' class='form-control Name  input-sm'>
                </div>
                <div class='col-sm-1'>
                </div>

                 <label class="col-sm-2" for='c_code'>Vehicle</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Vehicle'  id='vehicle' class='form-control Name  input-sm'>
                </div>
                 <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('search_vehicle_master.php?stname=dis_note', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="...">
                        </a>
                    </div>

                </div>

                <div class='form-group'>
                <label class="col-sm-2" for='c_code'></label>
                <div class='col-sm-2'>
               
                </div>
                <div class='col-sm-1'>
                </div>

                 <label class="col-sm-2" for='c_code'>Vehicle No</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Vehicle No'  id='vehicle_no' class='form-control Name  input-sm'>
                </div>
                

                </div>

                <div class='form-group'></div>
                <div class='form-group'>
                <label class="col-sm-2" for='c_code'>Customer Address</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Customer Address'  id='customer_address' class='form-control Name  input-sm'>
                </div>
                
                 <div class='col-sm-1'>
                </div>


                <label class="col-sm-2" for='c_code'>Contact Person</label>
                <div class='col-sm-2'>
                <input type='text' placeholder='Contact Person'  id='contact_person' class='form-control Name  input-sm'>
                </div>

                </div>

              
                <div class='form-group'></div>
                <div class='form-group'>
                    <label class="col-sm-2" for='c_code'>Customer Po</label>
                    <div class='col-sm-2'>
                    <input type='text' placeholder='Customer Po'  id='customer_po' class='form-control Name  input-sm'>
                    </div>
                    <div class='col-sm-1'>
                    </div>

                      <label class="col-sm-2" for='c_code'>Supplier Vendor No</label>
                    <div class='col-sm-2'>
                    <input type='text' placeholder='Supplier Vendor No'  id='supplier_vendor_no' class='form-control Name  input-sm'>
                    </div>
                
                </div>

              
             




                <div class='form-group'></div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_remarks">Remark</label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Remarks" id="txt_remarks" class="form-control input-sm">
                    </div>
                </div>
    
<br><br>

            <div class="col-sm-5 well">   
                
                <div class="form-group">
                    <label class="col-sm-5" for="invno">Job Quantity</label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Job Quantity" id="txt_FGQty" class="form-control  input-sm">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5" for="invno">Dispatched</label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Dispatched" id="txt_trfd" class="form-control  input-sm">
                    </div>

                </div>

                <div class="form-group">
                   
                    <label class="col-sm-5" for="invno">Balance To Be Dispatched</label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Balance" id="txt_balTrfd" class="form-control  input-sm">
                    </div>
                </div>

            </div>

<div class="col-sm-1">   
</div>

            <div class="col-sm-6 well">   

                <div class="form-group">
                    <label class="col-sm-4" for="invno">FG Quantity</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Job Quantity" id="FGQty" class="form-control  input-sm">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4" for="invno">Transfered</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Transfered" id="trfd" class="form-control  input-sm">
                    </div>

                </div>

                <div class="form-group">
                   
                    <label class="col-sm-4" for="invno">Balance To Be Transfered</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Balance" id="balTrfd" class="form-control  input-sm">
                    </div>
                </div>

            </div>





                <div class="form-group hidden">
                    <label class="col-sm-1 control-label" for="receipt">From</label>
                    <div class="col-sm-2">
                        <select id="department" class="form-control input-sm" onchange="setDepartment('department');">
                            <?php
                            $sql = "select * from s_stomas where code = 01 order by CODE";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . trim($row["CODE"]) . "'>" . $row["CODE"] . " " . $row["DESCRIPTION"] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <label class="col-sm-1 control-label" for="receipt">To</label>
                    <div class="col-sm-2">
                        <select id="department1" class="form-control input-sm" onchange="setDepartment('department1');">
                            <?php
                            $sql = "select * from s_stomas where code = 02 order by CODE";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . trim($row["CODE"]) . "'>" . $row["CODE"] . " " . $row["DESCRIPTION"] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                </div>


                <div class="form-group" style="visibility: hidden;">
                    <div class="col-sm-12">

                        <label  class="col-sm-1 control-label" ><input type="radio" id="non" name="optradio" value="non">&nbsp;Return</label>

                        <label  class="col-sm-1 control-label" ><input type="radio" id="svat" name="optradio" value="svat" checked="">&nbsp;Issue</label>

                    </div>
                </div>





                <table class="table table-striped">
                    <tr class='info'>
                        <th style="width: 120px;">Item</th>
                        <th>Description</th>
                        <th style="width: 10px;"></th>
                        <th style="width: 120px;">Qty</th>
                        <th style="width: 100px;"></th>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" placeholder="Item" id="itemCode" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" placeholder="Description" id="itemDesc" class="form-control input-sm">
                        </td>
                        <td>
                            <a href="" onclick="NewWindow('serach_item.php?stname=isn', 'mywin', '800', '700', 'yes', 'center');
                                    return false" onfocus="this.blur()">
                                <input type="button" name="searchcusti" id="searchcusti" value="..." class="btn btn-default btn-sm hidden">
                            </a>
                        </td>
                        <td>
                            <input type="text" placeholder="Qty" id="qty" onkeyup="validat();" class="form-control input-sm">
                            <input type="hidden" placeholder="Rate" id="itemPrice" class="form-control input-sm">
                        </td>
                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                    </tr>

                </table>

                <div id="itemdetails" >

                </div>
                <div class="form-group hidden">
                    <div class="col-sm-12">
                        <label  class="col-sm-1 control-label" >Stock Level</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="stock level" name="stkLvl" id="stkLvl" class="form-control  input-sm" disabled="">
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

</section>
<script src="js/gin_dpt.js"></script>
<script>
    new_inv();
</script>
<?php
include 'login.php';
include './cancell.php';
?>
