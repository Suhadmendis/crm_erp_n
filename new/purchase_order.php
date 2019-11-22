
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Purchase Order</b></h3>
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

                    <a onclick="NewWindow('search_purchase_path.php?stname=PURCHASE_ORDER', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="edit();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a>       
                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>


                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Ref. No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reference No"  id="refno_txt" class="form-control  input-sm  " disabled="">
                        </div>

                    </div>

                    <div class="col-sm-1"></div>

                    <label class="col-sm-1" for="c_code">Manual No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Manual No"  id="manual_txt" class="form-control  input-sm">
                    </div>

                    <div class="col-sm-1"></div>
                    <label class="col-sm-1" for="c_code">Date</label>
                    <div class="col-sm-1">

                        <input type="date" placeholder="Date"  id="date_txt" class="form-control  input-sm">
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Currency Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="LKR"  id="currencycode_txt" class="form-control  input-sm">
                        </div>

                    </div>
                    <div class="col-sm-1"></div>

                    <label class="col-sm-1" for="c_code">Exchange Rate</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Exchange Code"  id="exchangerate_txt" class="form-control  input-sm">
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-1">
                        <input type="radio" name="shippingmethod" id="local"> Local<br>
                    </div>


                    <div class="col-sm-1">
                        <input type="radio" name="shippingmethod" id="sea"> Sea<br>
                    </div>

                    <div class="col-sm-1">
                        <input type="radio" name="shippingmethod" id="air"> Air<br>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Suppler</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Supplier"  id="supplier_no" class="form-control  input-sm">
                        </div>

                    </div>
                    <div class=""></div>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Date of birth"  id="date_of_birth_txt" class="form-control  input-sm">
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Cost Center</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Cost Center"  id="costcenter_txt" class="form-control  input-sm">
                        </div>

                    </div>
                    <div class=""></div>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Date of birth"  id="date_of_birth_txt" class="form-control  input-sm">
                    </div>


                    <div class="col-sm-1"></div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Remarks"  id="remarks_txt" class="form-control  input-sm">
                        </div>

                    </div>
                    <div class="form-group"></div>

                    <div class="col-sm-3">
                        <input type="text" placeholder="uniq"  id="uniq" class="form-control  input-sm hidden">
                    </div>
                   
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                         <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="abc_txt"class="form-control  input-sm">
                        </div>

                    </div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Job No.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Job No."  id="jobno_txt" class="form-control  input-sm">
                        </div>
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Text Combination</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Text Combination"  id="tcomb_txt"class="form-control  input-sm">
                        </div>

                    </div>
                    <div class=""></div>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Date of birth"  id="date_of_birth_txt" class="form-control  input-sm">
                    </div>

                    <br><br><br>

                    <br>

                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Total Discount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Total Discount"  id="totaldis_txt" class="form-control  input-sm">
                        </div>


                        <div class="col-sm-1"></div>

                        <label class="col-sm-1" for="c_code">Total Tax</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Date of birth"  id="totaltax_txt" class="form-control  input-sm">
                        </div>

                        <div class="col-sm-1"></div>

                        <label class="col-sm-1" for="c_code">Total Value</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Date of birth"  id="totalvalue_txt" class="form-control  input-sm">
                        </div>

                    </div>

                </div>  
                
                <div class="col-sm-12">
                    <br><br>
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Rec No</th>
                                        <th style="width: 10%;">Product Dis.</th>
                                        <th style="width: 10%;">QTY</th>
                                        <th style="width: 10%;">Price</th>
                                        <th style="width: 10%;">Discount</th>
                                        <th style="width: 10%;">Value</th>
                                        <th style="width: 10%;">Tax Com. Code</th>
                                        <th style="width: 10%;">Add/Remove</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No" id="recordno" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Dis."  id="p_discription" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="QTY"  id="p_quantity" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Price"  id="p_price" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Discount"  id="p_discount" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Value"  id="p_value" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Tax Comb. Code"  id="p_tccode" class="form-control input-sm">
                                        </td>

                                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>



</div>


</div>



</form>

</div>

</section>
<script src="js/purchase_order.js"></script>


<script>newent();</script>
