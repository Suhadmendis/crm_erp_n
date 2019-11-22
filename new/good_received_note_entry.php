
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Good Received Note Entry</b></h3>
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
                    <a onclick="NewWindow('search_purchase_path.php?stname=GRNRECEIVED', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="edit();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a>       
                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>


<!--                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                      <a onclick="edit();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a> 
                    <a  style="background-color: red" onclick="delete1();" class="btn btn-danger btn-sm">
                         <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                    </a>
                    <a onfocus="this.blur()" onclick="NewWindow('search_good_received_note_entry.php', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
                                            <input type="button" class="btn btn-default "  id="searchcust" name="searchcust">
                        <button style="background-color: #0088cc" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>&nbsp; FIND
                                </button>
                            </a>-->
                    
                   
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Reference No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="reference_no" class="form-control  input-sm  " disabled="">
                        </div>

                    </div>
                   
<!--                       <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Manual No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="manual_no" class="form-control  input-sm">
                        </div>-->
                     
                     <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            
                            <input type="text"   id="date_of_birth_txt" class="form-control hidden input-sm">
                        </div>
                 
                     <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-2">
                            <input type="date" placeholder=""  id="date" class="form-control  input-sm">
                        </div>
<!--                     <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            
                            <input type="date" placeholder=""  id="date" class="form-control  input-sm">
                        </div>-->
                     
                   
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Purchase Order No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="purchase_order_no" class="form-control  input-sm">
                        </div>

                    </div>
<!--                     <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Exchange Rate</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="exchange_rate" class="form-control  input-sm">
                        </div>-->
                       <div class="col-sm-1"></div>
                        <div class="col-sm-1">
                            <input type="radio" name="shipping_method" id="local"> Local<br>
                        </div>
                     
                      
                        <div class="col-sm-1">
                            <input type="radio" name="shipping_method" id="sea"> Sea<br>
                        </div>
                      
                        <div class="col-sm-1">
                            <input type="radio" name="shipping_method" id="air"> Air<br>
                        </div>
                       
                       <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Manual No</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="manual_no" class="form-control  input-sm">
                        </div>
                       
                     
                      <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Currency Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="currency_code" class="form-control  input-sm">
                        </div>
                        

                        <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Exchange Rate</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="exchange_rate" class="form-control  input-sm">
                        </div>
<!--                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="date_of_birth_txt" class="form-control  input-sm">
                        </div>-->
                     
                     
                        <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Supplier Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="supplier_code" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="supplier_code_1" class="form-control  input-sm">
                        </div>
                     
                     <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Location Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="location_code" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="location_code_1" class="form-control  input-sm">
                        </div>
                     
                     <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Cost Center</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="cost_centre" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="date_of_birth_txt" class="form-control  input-sm">
                        </div>
                     
                     
                    
                   
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-11">
                            <input type="text" placeholder=""  id="remarks" class="form-control  input-sm">
                        </div>

                    </div>
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <div class="col-sm-11">
                            <input type="text" placeholder=""  id="a" class="form-control  input-sm">
                        </div>

                    </div>
                   
<!--                     <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="uniq"  id="uniq" class="form-control  input-sm">
                        </div>-->
                 
                  
                       <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Tax Combination</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="tax_combination" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="date_of_birth_txt" class="form-control  input-sm">
                        </div>
                     <div class="form-group"></div>
                       <div class="col-sm-3">
                            <input type="text" placeholder=""  id="uniq" class="form-control hidden input-sm">
                            <!--hidden-->
                        </div>
                     
                     <br><br><br>
                     
                  
                     
                     
<!--                 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Lastname</th>
        <th>Email</th>
         <th>Email</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>xyz</td>
        <td>xyz</td>
        <td>abc@example.com</td>
          <td>xyz</td>
        <td>xyz</td>
        <td>abc@example.com</td>
          <td>xyz</td>
        <td>xyz</td>
            </tr>
    </tbody>
  </table>-->
                     
                     
                     
                     
                     
                     <!--<br>-->
                     
<!--                        <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Total Discount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="total_discount" class="form-control  input-sm  " disabled="">
                        </div>
                             
                        
                        <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Total Tax</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder=""  id="total_tax" class="form-control  input-sm" disabled="">
                        </div>
                     
                       <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Total Value</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="total_value" class="form-control  input-sm" disabled="">
                        </div>

                    </div>-->
                     
                </div> 
                      
                         <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:  5%;">Rec No</th>
                                        <th style="width: 10%;">Product Code</th>
                                        <th style="width: 10%;">Product Description</th>
                                        <th style="width: 10%;">Quantity</th>
                                        <th style="width: 10%;">Purchase Price</th>
                                        <th style="width: 10%;">Local Price</th>
                                        <th style="width: 10%;">Discount</th>
                                        <th style="width: 10%;">import Exp</th>
                                        <th style="width: 10%;">Value</th>
                                        <th style="width: 10%;">Tax Combination</th>
                                        <th style="width:  5%;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No" id="rec_no" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Code"  id="product_code" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Product Description"  id="product_description" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Quantity"  id="quantity" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Purchase Price"  id="purchase_price" class="form-control input-sm">
                                        </td>
                                         <td>
                                            <input type="text" placeholder="Local Price"  id="local_price" class="form-control input-sm">
                                        </td>
                                         <td>
                                            <input type="text" placeholder="Discount"  id="discount" class="form-control input-sm">
                                        </td>
                                         <td>
                                            <input type="text" placeholder="Import EXP"  id="import_exp" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="value"  id="grn_value" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Tax Combination"  id="tax_combination_txt" class="form-control input-sm">
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
        <script src="js/good_received_note_entry.js"></script>


<script>newent();</script>
