<!-- Main content -->
<?php
require_once './connection_sql.php';
?>
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Quotation</h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">
                <input type="hidden" id="tmpno" value="" class="form-control">
                <input type="hidden" id="item_count" class="form-control">
                <input type="hidden" id="item_count_org" class="form-control">

                <div class="form-group">
                    <a onclick="sess_chk('new', 'crn');" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>
                    <!--                    <a onclick="save_inv('getGl');" class="btn btn-info btn-sm">
                                            <span class="fa fa-balance-scale"></span> &nbsp; Check GL
                                        </a>                    -->
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
                    <label class="col-sm-1 control-label" for="invno">Ref No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Ref No" id="txt_entno" class="form-control  input-sm" disabled="">
                    </div>
                    <div class="col-sm-1">
<!--                        <a onfocus="this.blur()" onclick="NewWindow('serach_gin.php?stname=ming_dsr', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="..." id="searchcust" name="searchcust">
                        </a>-->
                        <a onfocus="this.blur()" onclick="NewWindow('serach_gin.php?stname=qttn', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="..." id="searchcust" name="searchcust">
                        </a>
                    </div>
                    <label class="col-sm-2 control-label" for="invdate">Date</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Date" id="invdate" value="<?php echo date('Y-m-d'); ?>" class="form-control dt input-sm">
                    </div>
                </div>
                <div class="form-group hidden">
                    <label  class="col-sm-1 control-label" ><input type="radio" id="non" name="optradio" onclick="setType();" value="non">&nbsp;Material</label>
                    <label  class="col-sm-1 control-label" ><input type="radio" id="svat" name="optradio" value="svat" onclick="setType();" checked="">&nbsp;Other</label>
                    
                    <label class="col-sm-4 control-label" for="invno">MIN No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="MIN No" id="txt_jobno" class="form-control  input-sm">
                    </div>
                    <div class="col-sm-1" id="searchCustDiv">
                        <a onfocus="this.blur()" onclick="NewWindow('serach_gin.php?stname=ming_req', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="..." id="searchcust" name="searchcust">
                        </a>
                    </div>                    
                </div>
                <div class="form-group">
                    <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Customer</label>
                    <div class="col-sm-3">
                        <input type="text" id="cusText" name="cusText" placeholder="Customer Code" class="form-control  input-sm" disabled="">
                    </div>
                    <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Customer Name</label>
                    <div class="col-sm-3">
                        <input type="text" id="cusTextName" name="cusTextName" placeholder="Customer Name" class="form-control  input-sm" disabled="">
                    </div>
                    <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=costing', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <button type="button" class="btn btn-default">
                                <span class="fa fa-search"></span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="txt_remarks">Remark</label>
                    <div class="col-sm-7">
                        <input type="text" placeholder="Remarks" id="txt_remarks" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group hidden">
                    <label class="col-sm-1 control-label" for="receipt">From</label>
                    <div class="col-sm-2">
                        <select id="department" class="form-control input-sm" onchange="setDepartment('department');">
                            <?php
                            $sql = "select * from s_stomas where code = '01' order by CODE";
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
                            $sql = "select * from s_stomas where code = '02' order by CODE";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . trim($row["CODE"]) . "'>" . $row["CODE"] . " " . $row["DESCRIPTION"] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <table class="table table-striped">
                    <tr class='info'>
                        <th>Shop Or Option</th>
                        <th>Description</th>
                        <th style="width: 100px;">Qty</th>
                        <th style="width: 100px;">Rate</th>
                        <th style="width: 100px;"></th>
                    </tr>

                    <tr>
                        <td>
                            <!--<input type="text" placeholder="Item" id="itemCode" class="form-control input-sm">-->
                            <input type="text" placeholder="Item" id="proCodeText" class="form-control input-sm">
                        </td>
                        <td>
                            <!--<input type="text" placeholder="Description" id="itemDesc" class="form-control input-sm">-->
                            <input type="text" placeholder="desText" id="desText" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" placeholder="Qty" id="qty" class="form-control input-sm">
                        </td>
                        <td>    
                            <input type="text" placeholder="Rate" id="itemPrice" class="form-control input-sm">
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
<script src="js/gin_general_1_qttn.js"></script>
<script>
                            new_inv();
</script>
<?php
include 'login.php';
include './cancell.php';
?>
    