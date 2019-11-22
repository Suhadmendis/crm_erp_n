<?php
include './connection_sql.php';
?>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Temporary Manual Invoice</h3>
        </div>

        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">


                <div class="form-group">
                    <a style="margin-left: 10px;"  onclick="pageNew()" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>-->
                    <a onclick="NewWindow('search_temporary_manual_invoice.php', 'mywin', '1200', '600', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    
                        <a style="float: right;margin-right: 10px;" onclick="NewFullWindow('list_temporary_manual_invoice.php', 'mywin', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; List
                    </a>
                    
                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 
                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>

                </div>
                <div id="msg_box"></div>

                <br>
                <br>

                <div class="col-sm-6">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Invoice Number</label>
                        <div class="col-sm-9">
                            <input id="Invoice_Number" onkeyup="filter()" placeholder="Invoice Number" class="form-control input-sm" disabled="">
                            <input id="uniq" type="hidden" >


                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">


                        <label class="col-sm-3" for="c_code">Invoice Date</label>
                        <div class="col-sm-9">
                            <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                <input type="text" placeholder="Invoice Date" id="Invoice_Date" class="form-control input-sm" >
                               
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Settlement Due</label>
                        <div class="col-sm-9">
                            <input  type="text" placeholder="Settlement Due" id="Settlement_Due" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Customer Order No</label>
                        <div class="col-sm-9">
                            <input  type="text" placeholder="Custoer Order No" name="c_code" id="Customer_Order_No" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Our AOD Number</label>
                        <div class="col-sm-7">
                            <input  id="addaod" placeholder="Our AOD Number"  class="form-control input-sm"  name="namel">
                        </div>
                        <div class="col-sm-2">
                            <a style="width: 100%;" onclick="addAod();" accesskey="addaodbtn" class="btn btn-info btn-sm">
                                <span class=""></span> &nbsp; ADD
                            </a>
                        </div>

                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code"></label>
                        <div class="col-sm-9">
                            <textarea rows="4" cols="50"  id="ouraodnumber" placeholder="Our AOD Numbers"  class="form-control input-sm"  name="namel"></textarea>
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Advance</label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="Advance" name="" id="Advance" class="form-control input-sm">
                        </div>
                    </div>
                    
                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Currency</label>
                        <div class="col-sm-4">

                            <select name="curr"  onchange="curren();" id="Cuddrrency"  class="form-control input-sm">
                                <option value="lkr" selected>LKR</option>
                                <option value="usd">USD</option>
                            </select>
                        </div>
                        <div class="col-sm-2">

                            <label>Rate</label>



                        </div>
                        <div class="col-sm-3">

                            <input type="text" id="crate"  placeholder="Rate"  class="form-control input-sm">

                        </div>
                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">Customer Name</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="Customer Name" id="Customer_Name" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">Customer Address</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="Customer Address" id="Customer_Address" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">Customer NBT Registration No</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="NBT Registration No" id="NBT" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">Customer VAT Registration No</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="VAT Registration No"  id="VAT" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">Customer SVAT Registration No</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="SVAT Registration No"  id="SVAT" class="form-control input-sm">
                        </div>
                    </div>
                    
                     <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">text 1</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="text 1"  id="text_1" class="form-control input-sm">
                        </div>
                    </div>
                     
                      <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code">text 2</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="text 2"  id="text_2" class="form-control input-sm">
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>
                  

                    <div class="form-group-sm">

                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="radio1"  id="svatboo" checked=""> SVAT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="radio1" id="vatboo"> VAT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" id="nbtboo" name="feature" value="scales" > NBT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label>Tax Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input onchange="vattdiable();" type="radio" name="radio2"  id="yes" checked=""> yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input onchange="vattdiable();" type="radio" name="radio2" id="no"> no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <a  onclick="vatdisable();" class="btn btn-default btn-sm">
                                <span></span> &nbsp; Apply
                            </a> 
                        </div>
                        <br>

                    </div>


                </div>

               







                <div class="col-sm-12">
                    <div id="itemdetails">
                        <div id='getTable'>
                            <table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>QTY</th>
                                        <th style='width: 65%;'>Description</th>
                                        <th style='width: 10%;'>Unit Price</th>
                                        <th style='width: 10%;'>Value</th>


                                        <th style='width: 5%;'>Add/Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input  type='text' onkeyup="taxCal();" placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Description'  id='Description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' onkeyup="taxCal(event);" placeholder='Unit Price'  id='Unit_Price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Value' id='Value' class='form-control input-sm'>
                                        </td>


                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                    </tr>
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>Sub Total</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>NBT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>VAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>SVAT</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>Grand Total</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

                                    </tr>
                                    <tr style="text-align: right;">
                                        <td></td>
                                        <td>
                                            <label>Advance</label>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>


                                        <td></td>

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
<script src="js/temporary_manual_invoice.js"></script>

<?php
include 'autocompleJUI/tmi_PATH.php';
include 'login.php';
include './cancell.php';
?>
<script>
                                            new_inv();
</script>
<script>
    $(function () {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });

</script>