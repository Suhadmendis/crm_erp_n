  
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Good Received Note Entry Dummy</b></h3>
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
                    <a   onclick="delete1();" class="btn btn-danger btn-sm">
                         <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                    </a>
                    <a onfocus="this.blur()" onclick="NewWindow('search_purchase_path.php?stname=GRN', 'mywin', '800', '700', 'yes', 'center');
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
                        <label class="col-sm-1" for="c_code">Reference No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reference No"  id="reference_no_Text" class="form-control  input-sm  " disabled="">
                             <input type="text" placeholder="uniq"  id="uniq" class="form-control hidden input-sm"  disabled="">
                        </div>

                    </div>
                   
                
                     
                     <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <input type="text" placeholder="Code1"  id="code1" class="form-control hidden input-sm">
                        </div>
                     <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-2">
                            <input type="date" placeholder="Date"  id="date_txt" class="form-control  input-sm">
                        </div>
                     
                   
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Purchase Order No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Purchase Order No"  id="purchase_order_no_Text" class="form-control  input-sm">
                        </div>

                    </div>
                        <div class="col-sm-1">
                           <input type="radio" name="shipingMethod" id="local"> Local<br>
                        </div>
                     
                      
                        <div class="col-sm-1">
                           <input type="radio" name="shipingMethod" id="sea"> Sea<br>
                        </div>
                      
                        <div class="col-sm-1">
                           <input type="radio" name="shipingMethod" id="air"> Air<br>
                        </div>
                    
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="" class="form-control hidden input-sm">
                        </div>
                       <label class="col-sm-1" for="c_code">Manual Ref.No.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Manual Ref.No."  id="manual_ref_no_Text" class="form-control  input-sm">
                        </div>
                     
                      <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Currency Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Currency Code"  id="currency_code_Text" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                      <label class="col-sm-1" for="c_code">Exchange Rate</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Exchange Rate"  id="exchange_rate_Text" class="form-control  input-sm">
                        </div>
                     
                     
                        <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Suppler Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Suppler Code"  id="suppler_code_Text" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Consoalidate Cost Center"  id="consoalidate_cost_center" class="form-control  input-sm">
                        </div>
                      <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Cost Center</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Cost Centre"  id="cost_centre_Text" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=" Center"  id="textfiled_Text" class="form-control  input-sm">
                        </div>
                     
                     
                    <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                           
                        </div>
                   
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-11">
                            <input type="text" placeholder="Remarks"  id="remarks_Text" class="form-control  input-sm">
                        </div>

                    </div>
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code"></label>
                        <div class="col-sm-11">
                            <input type="text" placeholder=""  id="textfiled2_Text" class="form-control  input-sm">
                        </div>

                    </div>
                   
                     
                 
                  
                       <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Tax Combination Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Tax Combination Code"  id="tax_combination_code_Text" class="form-control  input-sm">
                        </div>

                    </div>
                     <div class=""></div>
                        <div class="col-sm-9">
                            <input type="text" placeholder=""  id="textfiled3_Text" class="form-control  input-sm">
                        </div>
                    
                     
                       <br><br><br>
               <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Rec No.</th>
                                        <th style="width: 30%;">Product Description</th>
                                        <th style="width: 10%;">Quantity</th>
                                        <th style="width: 10%;">parchase Price</th>
                                        <th style="width: 10%;">Discount %</th>
                                        <th style="width: 15%;">Value</th>
                                        <th style="width: 15%;">Tax Combination Code</th>
                                        <th style="width: 12%;"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No." id="rec_no_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Description"  id="Product_Des_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Quantity"  id="quantity_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="parchase Price"  id="parchase_price_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Discount %"  id="discount_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Value"  id="value_Text" class="form-control input-sm">
                                        </td>
                                         <td>
                                            <input  type="text" placeholder="Tax Combination Code"  id="tax_combination_code_Text" class="form-control input-sm">
                                        </td>
                                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
                
                     <br><br><br><br><br><br>
                     
                     
                     
                        <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Total Discount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Total Discount"  id="total_discount_Text" class="form-control  input-sm  ">
                        </div>
                             
                        
                        <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Total Tax</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Total Tax"  id="total_tax_Text" class="form-control  input-sm">
                        </div>
                     
                       <div class="col-sm-1"></div>
                        
                     <label class="col-sm-1" for="c_code">Total Value</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Total Value"  id="total_value_Text" class="form-control  input-sm">
                        </div>

                    </div>
                     
                </div>  
                
                </div>
            
  
            </div>
    
        </form>
     
    </div>

</section>
        <script src="js/good_received_note_entry_dummy.js"></script>


<script>newent();</script>
