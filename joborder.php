<?php
//session_start();
?>

<section class="content">

    <div class="box box-primary">
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

                    <a onclick="edit();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a>    

                    <a onclick="approve();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; Approve
                    </a>

                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE 
                    </a>

                    <a onclick="NewWindow('search_joborder.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>

                    <a onclick="cancel();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; CANCEL
                    </a>

                    <a onclick="slider('back');" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; BACKWARD
                    </a>

                    <a onclick="slider('for');" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; FORWARD
                    </a>

                    <a onclick="close_form();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; CLOSE
                    </a>


                </div>
                <hr>
                <div id="msg_box" class="span12 text-center"></div>



                <div class="form-group"></div>
                <div class="form-group-sm">
                    <label class="col-sm-2" for="c_code">Job Order Ref</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Job Code"  id="jcode" class="form-control  input-sm" disabled="">
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
                        <input type="date" placeholder="Date" onchange="" id="date_txt" value="" class="form-control  input-sm">
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Quotation Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Quotation Ref" onchange="" id="Quotation_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=joborder', 'mywin', '800', '700', 'yes', 'center');
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
                            <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=joborder', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>

                        <label class="col-sm-2" for="c_code">Manual Ref</label>
                        <div class="col-sm-1 form-group-sm">
                            <input type="text" placeholder="Manual Ref" id="Manual_Ref" class="form-control  input-sm">
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=joborder', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>


                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-4" for="c_code"></label>

                        <label class="col-sm-2" for="c_code">New</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="New" id="new_txt" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Customer</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Customer"  id="Customer" class="form-control  input-sm">
                        </div>


                        <label class="col-sm-2" for="c_code">Repeat</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Repeat"  id="repeat_txt" class="form-control  input-sm">
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Marketing Ex</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Marketing Ex"  id="Marketing_Ex" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >If Repeat Previous JBN Ref</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Repeat Previous JBN Ref"  id="Repeat_Previous_JBN_Ref" class="form-control  input-sm">
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


                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Customer PO No.</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Customer PO No"  id="Customer_PO_No" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >Job Qty</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Job Qty"  id="Job_Qty" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group-sm">
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
                        <label class="col-sm-2" for="c_code" >Length</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="Length"  id="length_txt" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-4" for="c_code"></label>

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


                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code" >No. of Impressions</label>
                        <div class="col-sm-2">
                            <input type="varchar" placeholder="No Of Impressions"  id="No_of_Impressions" class="form-control  input-sm">
                        </div>
                    </div>






                    <br><br>
                    <br><br>


                </div>
        </form>
        <div class="row">
            <div class="col-md-8" id="mattable">

            </div>


        </div>
    </div>

</section>
<script src="js/joborder.js"></script>

<script>newent();</script>

