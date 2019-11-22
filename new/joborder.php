<?php
//session_start();
?>

<section class="content" >

    <div class="box box-primary" id="app">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Job Order</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">


                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group-sm">

                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                    <!-- <a  id="save_inv_top" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a> -->

                    <a onclick="//edit();" class="btn btn-warning btn-sm " disabled="disabled">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a>

                    <a onclick="//approve();" class="btn btn-warning btn-sm " disabled="disabled">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; Approve
                    </a>

                    <a onclick="//delete1();" class="btn btn-danger btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>

                    <a onclick="NewWindow('search_joborder.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>

                    <a onclick="//cancel();" class="btn btn-primary btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; CANCEL
                    </a>

                    <a onclick="//slider('back');" class="btn btn-primary btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; BACKWARD
                    </a>

                    <a onclick="//slider('for');" class="btn btn-primary btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; FORWARD
                    </a>

                    <a onclick="//close_form();" class="btn btn-primary btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-print" ></span> &nbsp; CLOSE
                    </a>


                </div>
                <hr>
                <div id="msg_box" class="span12 text-center"></div>



                <div class="form-group"></div>
                <div class="form-group-sm">
                    <label class="col-sm-2" for="c_code">Job Order Ref</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Job Code"  id="jcode" class="form-control  input-sm" disabled="">
                        <input type="text" placeholder="Job Code"  id="uniq" class="form-control hidden input-sm" disabled="">
                    </div>
                </div>
                <div class="col-sm-1">
                    <a onfocus="this.blur()" onclick="NewWindow('search_joborder.php?stname=code', 'mywin', '800', '700', 'yes', 'center');
                            return false" href="">
                        <button type="button" class="btn btn-default">
                            <span class="fa fa-search"></span>
                        </button>
                    </a>
                </div>

                <div class="form-group-sm">
                    <label class="col-sm-2" for="c_code">Date</label>

                    <div class="col-sm-2">
                        <input type="date" placeholder="Date" onchange="" id="date_txt" value="<?php echo date("Y-m-d"); ?>" class="form-control  input-sm">
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Quotation Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Quotation Ref" onchange="" id="Quotation_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('search_quotation.php?stname=job_order', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>
                        <label class="col-sm-2" for="c_code">Costing Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Costing Ref" onchange="" id="Costing_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('search_costing.php?stname=joborder', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>


                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Job Request Ref</label>
                        <div class="col-sm-2 form-group-sm">
                            <input type="text" placeholder="Job Request Ref" id="Job_Request_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('serach_job_request.php?stname=job_order', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>

                        <label class="col-sm-2" for="c_code">Manual Ref</label>
                        <div class="col-sm-2 form-group-sm">
                            <input type="text" placeholder="Manual Ref" id="Manual_Ref" class="form-control  input-sm">
                        </div>



                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-5" for="c_code"></label>

                        <label class="col-sm-2 hidden" for="c_code">New</label>
                        <div class="col-sm-2 hidden">
                            <input type="radio" id="new_txt" name="nor" >
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Customer</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Customer"  id="Customer" class="form-control">

                        </div>


                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=job_ord', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>

                         <label class="col-sm-2" for="c_code">Product Ref</label>

                        <div class="col-sm-2">
                            <input type="text" id="proCodeText" name="proCodeText" placeholder="Product Ref" class="form-control  input-sm">
                        </div>

                        <label class="col-sm-2 hidden" for="c_code">Repeat</label>
                        <div class="col-sm-2 hidden">
                            <input type="radio"  id="repeat_txt" name="nor" >
<!--                            <input type="radio" name="gender" value="male"> Male<br>
<input type="radio" name="gender" value="female"> Female<br>
<input type="radio" name="gender" value="other"> Other-->
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                       

                       

                         <label class="col-sm-2" for="c_code">Customer Name</label>

                        <div class="col-sm-2">
                            <input type="text" id="cusTextName" name="cusTextName" placeholder="Customer Name" class="form-control  input-sm">
                        </div>

                        <label class="col-sm-1" for="c_code"></label>

                        <label class="col-sm-2" for="c_code">Product Name</label>

                        <div class="col-sm-2">
                            <input type="text" id="proNameText" name="proNameText" placeholder="Product Name" class="form-control  input-sm">
                        </div>

                    </div>






                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-2" for="c_code" >Marketing Ex</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Ref"  id="Marketing_Ex" class="form-control  input-sm">
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code"></label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Marketing Ex Name"  id="Marketing_name" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >If Repeat Previous JBN Ref</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Repeat Previous JBN Ref"  id="Repeat_Previous_JBN_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('search_joborder.php?stname=code_repeat', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Product Description</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Product Description"  id="Product_Description" class="form-control  input-sm">
                        </div>
                    </div>




                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Instructions</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Instructions"  id="Instructions" class="form-control  input-sm">
                        </div>
                    </div>

                    <label class="col-sm-1" for="c_code"></label>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Customer PO No.</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Customer PO No"  id="Customer_PO_No" class="form-control  input-sm">
                        </div>
                    </div>


                    <br>
                    <br>
                    <br>
                    <br>

                  <div class="hidden">

                    <!--<label class="col-sm-1 control-label" for="file-3">File Box</label>-->
                    <label class="btn btn-default" for="file-3">
                        <input id="file-3" name="file-3" multiple="true" type="file" >
                        Select Files

                    </label>
                    <label class="btn btn-default" for="file-3">
                        <input id="file-3" name="file-3" multiple="true" type="file" >
                        Select Files

                    </label>
                    <label class="btn btn-default" for="file-3">
                        <input id="file-3" name="file-3" multiple="true" type="file" >
                        Select Files

                    </label>

                  </div>
                    <!--<a  class="btn btn-primary" onclick="upload('job_order');" class="btn"/>Upload</a>-->


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Job Qty</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Job Qty"  id="Job_Qty" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >Location</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Location"  id="Location" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Sales Price</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Sales Price"  id="Sales_Price" class="form-control  input-sm">
                        </div>
                    </div>




                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Total Value</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Total Value"  id="Total_Value" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >Length</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Length"  id="length_txt" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-5" for="c_code"></label>

                        <label class="col-sm-2" for="c_code">Width</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Width"  id="width_txt" class="form-control  input-sm">
                        </div>

                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >No. of Colors</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="No Of Colors"  id="No_of_Colors" class="form-control  input-sm">
                        </div>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >No. of Sides</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="No Of Sides"  id="No_of_sides" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >No. of Outs</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="No Of Outs"  id="No_of_outs" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >No. of Impressions</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="No Of Impressions"  id="No_of_Impressions" class="form-control  input-sm">
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label  for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >Ink Code</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Ink Code"  id="inkCode" class="form-control  input-sm">
                        </div>
                          <label  class="col-sm-1"  for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >Ink Wastage Qty</label>
                        <div class="col-sm-2">
                            <input type="number" placeholder="Ink Wastage Qty" onkeyup="inkCal();" id="Ink_Was" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label  for="c_code"></label>
                        <label class="col-sm-2" for="c_code" >Ink Description</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Ink Description"  id="inkDes" class="form-control  input-sm">
                        </div>
                        <label  class="col-sm-1"  for="c_code"></label>
                         <label class="col-sm-2" for="c_code" >Ink Qty Allocation total for Production</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Ink Qty Allocation total for Production"  id="all_pro" class="form-control input-sm">
                            <input type="varchar" placeholder="Ink Qty Allocation total for Production"  id="allocation_Pro" class="form-control hidden input-sm">
                        </div>
                    </div>

                    






                    <br><br>
                    <br><br>


                </div>
        </form>

<div class="Container hidden">

        <div id="beTable">
            <div id="getTable">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Style</th>
                            <th style="width: 20%;">Size</th>
                            <th style="width: 10%;">Qty</th>
                            <th style="width: 50%;">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" placeholder="Style" id="style" class="form-control input-sm">
                            </td>
                            <td>
                                <input type="text" placeholder="Size"  id="size" class="form-control input-sm">
                            </td>
                            <td>
                                <input  type="text" placeholder="Qty"  id="qty" class="form-control input-sm">
                            </td>
                            <td>
                                <input  type="text" placeholder="Remark"  id="remark" class="form-control input-sm">
                            </td>
                            <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                        </tr>
                    </tbody>

                </table>

              </div>
          </div>

</div>



        <div class="row">
            <div class="col-md-8" id="mattable">

            </div>


        </div>
    </div>

</section>
<script src="js/joborder.js"></script>

<script>newent();</script>
