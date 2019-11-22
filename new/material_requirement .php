<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Material Requirement</b></h3>
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
                    <!--                    <a onclick="edit();" class="btn btn-warning btn-sm ">
                                            <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                                        </a>       -->
                    <!--                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                                            <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                                        </a>-->
                    <a onclick="NewWindow('search_purchase_path.php?stname=PRNTR', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                    <a onclick="print();" class="btn btn-primary btn-sm" >
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="col-md-12">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Ref. No.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="reference_no" class="form-control  input-sm" disabled="">
                        </div>
                    </div>




                    <!--                     <div>
                                             <input type="checkbox" id="dummy">Dummy<br>
                                         </div>     -->
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Customer</label>
                        <!--                        <div class="col-sm-1">
                                                    <input type="text" placeholder="Vehicle Ref"  id="vehicle_ref" class="form-control  input-sm">
                                                </div>-->
                        <div class="col-sm-1">
                            <input type="text" placeholder="customer_m"  id="customer_m" class="form-control  input-sm">
                        </div>
                        <!--                        <div class="col-sm-2">
                                                    <input type="text" placeholder="Vehicle Name"  id="vehicle_number" class="form-control  input-sm">
                                                </div>-->
                        <div class="col-sm-2">
                            <input type="text" placeholder="customer_f"  id="customer_f" class="form-control  input-sm">
                        </div>

                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=iso_mr', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                <input type="button" class="btn btn-default" value="..."  name="searchcust">
                            </a>
                        </div>
                        <div class="col-sm-1"></div>       
                        <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-3">
                            <input type="date" placeholder=""  id="date" class="form-control  input-sm">
                        </div>
                        <!--                        <label class="col-sm-2" for="c_code">Date</label>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Date"  id="date" class="form-control dt input-sm">
                                                </div>-->

                    </div>






                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Description</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="description" class="form-control  input-sm">
                        </div>
                    </div>              
                    <div class="col-sm-2"></div>                       
                    <label class="col-sm-1" for="c_code">Handled,Mir:</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder=""  id="handled" class="form-control  input-sm">
                    </div>       
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Order Quantity </label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="order_quantity" class="form-control  input-sm">
                        </div>
                    </div>     
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="remarks" class="form-control  input-sm">
                        </div>
                    </div>                  
                    <div class="form-group"></div>
                    <div class="col-sm-3">
                        <input type="text" placeholder=""  id="uniq" class="form-control hidden input-sm">
                        <!--hidden-->
                    </div>
                    <div class="col-sm-12">
                        <h5>Material</h5>
                        <div id="itemdetails" >
                            <div id="getTable">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">No</th>
                                            <th style="width: 20%;">Code</th>
                                            <th style="width: 20%;">DES</th>
                                            <th style="width: 3%;"></th>
                                            <th style="width: 20%;">UOM</th>
                                            <th style="width: 10%;">Cost</th>
                                            <th style="width: 10%;">Outs</th>
                                            <th style="width: 10%;">Qty</th>
                                            <th style="width: 10%;">Add / Remove</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="No" id="no" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input type="text" placeholder="Code"  id="code" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="DES"  id="des" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <a href="" onclick="NewWindow('serach_item.php?stname=mat_req', 'mywin', '800', '700', 'yes', 'center');
                                                        return false" onfocus="this.blur()">
                                                    <input type="button" name="searchcusti" id="searchcusti" value="..." class="btn btn-default btn-sm">
                                                </a>
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="UOM"  id="uom" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="Cost"  id="cost" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="Outs"  id="outs" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="Qty"  id="qty" class="form-control input-sm">
                                            </td>

                                            <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <h5>Labour</h5>
                        <div id="itemdetails" >
                            <div id="getTable">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">Labour</th>
                                            <th style="width: 20%;">Hours</th>
                                            <th style="width: 20%;">Remarks</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="Labour" id="labour" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input type="text" placeholder="Hours"  id="hours" class="form-control input-sm">
                                            </td>
                                            <td>
                                                <input  type="text" placeholder="Remarks"  id="labour_remarks" class="form-control input-sm">
                                            </td>


                                            <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </form>
    </div>
</section>
<script src="js/material_requirement.js"></script>
<script>newent();</script>



