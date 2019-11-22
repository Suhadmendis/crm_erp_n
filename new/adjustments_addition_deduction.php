  
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Adjustment Addition & Deduction</b></h3>
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
<!--                    <a   onclick="delete1();" class="btn btn-danger btn-sm">
                         <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                    </a>-->
                    <a onfocus="this.blur()" onclick="NewWindow('search_adjustments_addition_deduction.php?stname=AAD', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
<!--                                            <input type="button" class="btn btn-default "  id="searchcust" name="searchcust">-->
                        <button  type="button" class="btn btn-info btn-sm">
                                    <span class="glyphicon glyphicon-search"></span>&nbsp; FIND
                                </button>
                            </a>
                    
                    <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Reference No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reference No"  id="reference_no" class="form-control  input-sm  " disabled="">
                             <input type="text" placeholder="uniq"  id="uniq" class="form-control hidden input-sm"  disabled="">
                        </div>
                        
                         <div class="col-sm-1">
                           <input type="radio" name="shipingMethod" id="addition"> Addition<br>
                        </div>
                                        
                        <div class="col-sm-2">
                           <input type="radio" name="shipingMethod" id="deduction"> Deduction<br>
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="date"  id="date" value="<?php echo  date("Y/m/d") ?>" class="form-control  input-sm">
                        </div>
                      
                    </div>
                   
                   <div class="form-group"></div>
                       <label class="col-sm-2" for="c_code">Manual No.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Manual No."  id="manual_no" class="form-control  input-sm">
                        </div>
                     
                      <div class="form-group"></div>
                    <div class="form-group-sm">
                        <!--<label class="col-sm-2" for="c_code">Location Code</label>-->
                        <div class="col-sm-2">
                            <input type="text" placeholder="Location Code"  id="location_code" class="form-control hidden input-sm">
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Location Code"  id="location_code2" class="form-control hidden input-sm">
                        </div>

                    </div>
                  
                     
                     
<!--                        <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Cost Center</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Cost Center"  id="cost_center" class="form-control hidden input-sm">
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Cost Center"  id="cost_center2" class="form-control hidden input-sm">
                        </div>

                    </div>-->
                    
                   
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Remarks</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Remarks"  id="remarks" class="form-control  input-sm">
                        </div>
                    </div>
               
<!--                       <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Reason</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reason"  id="reason" class="form-control hidden  input-sm">
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Reason"  id="reason2" class="form-control hidden input-sm">
                        </div>

                    </div>-->
                     
                 
                  
                    
                     
                       <br><br><br>
               <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Rec No.</th>
                                        <th style="width: 10%;">Product Code</th>
                                        <th style="width: 30%;">Product Description</th>
                                        <th style="width: 10%;">Qty On Hand</th>
                                        <th style="width: 10%;">Quantity</th>
                                        <th style="width: 10%;">Rate</th>
                                        <th style="width: 10%;">Reason</th>
                                        <th style="width: 12%;">Add/Remove</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No." id="rec_no" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Code" id="product_code" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Description"  id="Product_Des" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Qty On Hand"  id="qty_on_hand" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Quantity"  id="quantity" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Rate"  id="rate" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Reason"  id="reason" class="form-control input-sm">
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
                
                </div>
            
  
            </div>
    
        </form>
     
    </div>

</section>
        <script src="js/adjustments_addition_deduction.js"></script>


<script>newent();</script>
