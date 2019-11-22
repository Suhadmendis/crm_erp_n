<?php
include './connection_sql.php';
?>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Quotation</h3>
        </div>

        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">


                <div class="form-group">
                    <a style="margin-left: 10px;float: left;margin-right: 3px;"  onclick="pageNew()" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a style="float: left;margin-right: 3px;"  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>-->
                    <a style="float: left;margin-right: 3px;" onclick="NewWindow('search_quotation.php?stname=quotation', 'mywin', '1200', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                    <a style="float: left;margin-right: 3px;" onclick="NewWindow('search_quotation.php?stname=REPEAT', 'mywin', '1200', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; REPEAT
                    </a>



                    <div style="float: left;margin-right: 3px;" class="dropdown" class="btn btn-default btn-sm">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Print
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a onclick="print('p1');">p1</a></li>
                            <li><a onclick="print('p2');">p2</a></li>
                            <li><a onclick="print('p3');">p3</a></li>
                            <li><a onclick="print('p4');">p4</a></li>
                        </ul>
                    </div>

                </div>

                <div id="msg_box"></div>






                <div class="col-md-4">


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Quotation NO</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Quotation NO" name="c_code" id="Quotation_NO" class="form-control input-sm">
                            <input type="text" placeholder="Quotation NO" name="c_code" id="uniq" class="form-control hidden input-sm">
                            <input type="text" placeholder="Quotation NO" name="c_code" id="update" class="form-control hidden input-sm">
                        </div>

                        <div id="ver_con">

                            <label class="col-sm-2" for="c_code">Version</label>
                            <div class="col-sm-3">
                                <input type="checkbox" id="version"  data-toggle="toggle">
                            </div>
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Manual ref</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Quotation NO" name="c_code" id="manual_ref" class="form-control input-sm">
                            
                        </div>

                      

                    </div>

                    <div class="form-group"> </div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">ATTN</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="ATTN" name="c_code" id="ATTN" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">CC</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="CC" name="c_code" id="CC" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">TO</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="TO" name="c_code" id="TO" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">FROM</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="FROM" name="c_code" id="FROM" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">DATE</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="DATE" name="c_code" id="DATE" value="<?php echo date("Y-m-d"); ?>" class="form-control dt input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">SUBJECT</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="SUBJECT" name="c_code" id="SUBJECT" class="form-control input-sm">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-5" for="c_code">All payment should be written in favour of</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="All payment should be written in favour of" value="CRIMSON CS (PVT) LTD." name="c_code" id="All_payment" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Validity of quotation</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Validity of quotation" name="c_code" value="30 Days" id="Validity_of_quotation" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Payment</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Payment" value="To be discussed and mutually agreed" name="c_code" id="Payment" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Delivery</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Delivery" value="To be discussed and mutually agreed" name="c_code" id="Delivery" class="form-control input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Remark</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Remark" value="Above prices are subject to taxes -NBT (2%) + VAT (15%)" name="c_code" id="Remark" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Top Text</label>
                        <div class="col-sm-9">
                            <textarea type="text" placeholder="Text 0" value="" name="c_code" id="Text_0" class="form-control input-sm"></textarea>
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Bottom Text 1</label>
                        <div class="col-sm-9">
                            <textarea type="text" placeholder="Text 1" value="" name="c_code" id="Text_1" class="form-control input-sm"></textarea>
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Bottom Text 2</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Text 2" value="" name="c_code" id="Text_2" class="form-control input-sm">
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code"></label>
                        <label class="col-sm-1" for="c_code">SVAT</label>
                        <div class="col-sm-2">
                            <input type="radio" name="vat" onchange="vatFun('SVAT');" id="SVAT"  >
                        </div>
                        <label class="col-sm-1" for="c_code">VAT</label>
                        <div class="col-sm-2">
                            <input type="radio" name="vat" id="VAT" onchange="vatFun('VAT');" >
                        </div>
                        <label class="col-sm-1" for="c_code">NBT</label>
                        <div class="col-sm-2">
                            <input type="checkbox" id="NBT"  >
                        </div>
                        <br>
                        <br>
                        <br>

                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                       
                        <label class="col-sm-2" for="c_code">Value Panel</label>
                        <div class="col-sm-2">
                            <input type="checkbox" id="botpanel"  data-toggle="toggle">
                        </div>
                        
                        
                        <label class="col-sm-2" for="c_code">Remark Panel</label>
                        <div class="col-sm-2">
                            <input type="checkbox" id="remarkpanel"  data-toggle="toggle">
                        </div>
                        <label class="col-sm-2" for="c_code">VAT and NBT</label>
                        <div class="col-sm-2">
                            <input type="checkbox" id="VNpanel"  data-toggle="toggle">
                        </div>

                    </div>




                </div>


                <br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br>



                <div class="col-sm-12">
                    <p style="float: left;">Prepared by : &nbsp;</p>
                    <p id="prepare"></p>
                    <div id="itemdetails" >


                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Heading 1</th>
                                        <th style="width: 15%;">Heading 2</th>
                                        <th style="width: 30%;">Heading 3</th>
                                        <th style="width: 15%;">Remark</th>
                                        <th style="width: 10%;">Qty</th>
                                        <th style="width: 15%;">Unit Price</th>
                                        <th style="width: 5%;">Add or Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <!--<input type="text" placeholder="Location" id="Location" class="form-control input-sm">-->
                                            <textarea rows="3"  cols="25" id="Location" class="form-control input-sm"></textarea>
                                        </td>
                                        <td>
                                            <!--<input type="text" placeholder="Item Name" id="Item_Name" class="form-control input-sm">-->
                                              <textarea rows="3"cols="25" id="Item_Name" class="form-control input-sm"></textarea>
                                        </td>
                                        <td>
                                            <!--<input type="text" placeholder="Description" id="Description" class="form-control input-sm">-->
                                             <textarea rows="3" cols="55" id="Description" class="form-control input-sm"></textarea>
                                        </td>
                                        <td>
                                            <!--<input type="text" placeholder="remark" id="Description" class="form-control input-sm">-->
                                             <textarea rows="3"  cols="35" id="tbl_remark"  class="form-control input-sm"></textarea>
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Qty" id="Qty" class="form-control input-sm">
                                             <!--<textarea rows="4" cols="20"></textarea>-->
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="taxCal(event);"  placeholder="Unit Price" id="Unit_Price" class="form-control input-sm">
                                        </td>
                                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"><span class="fa fa-plus"></span> &nbsp; </a></td>
                                    </tr>
                                </tbody>

                            </table>

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






<script src="js/quotation.js"></script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'autocompleJUI/autocompleISO_PATH.php';
include 'login.php';
include './cancell.php';
?>
<script>
new_inv();
</script> 