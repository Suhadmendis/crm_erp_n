  
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Service ddd</b></h3>
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
                    <a  style="background-color: red" onclick="delete1();" class="btn btn-danger btn-sm">
                         <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                    </a>
                    <a onfocus="this.blur()" onclick="NewWindow('search_purchase_path.php?stname=SIVE', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
<!--                                            <input type="button" class="btn btn-default "  id="searchcust" name="searchcust">-->
                        <button style="background-color: #0088cc" type="button" class="btn btn-info btn-sm">
                                    <span class="glyphicon glyphicon-search"></span>&nbsp; FIND
                                </button>
                            </a>  
                    
                     <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="col-md-12"class="dotted">
                   <div class="form-group"></div>
                    <div class="form-group-sm" >
                        <label class="col-sm-1" for="c_code">Reference No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reference No"  id="reference_no_Text" class="form-control  input-sm  " disabled="">
                        </div>
                    </div>                       
                        <div class="col-sm-1 "></div>
                     <label class="col-sm-1" for="c_code">Date </label>
                        <div class="col-sm-2">
                            <input type="date" placeholder=""  id="date_Text" class="form-control  input-sm">
                        </div>
                     <div class="col-sm-2"></div>
                     <label class="col-sm-1 " for="c_code">Dummy PO No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Dummy PO No"  id="dummy_po_no_Text" class="form-control  input-sm">
                        </div>
                      <div class="form-group"></div>
                        <label class="col-sm-1" for="c_code">Currency Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="LKR"  id="currency_code_Text" class="form-control  input-sm">
                        </div>
                         <div class="col-sm-1"></div>
                     <label class="col-sm-1" for="c_code">Currency Rate</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Currency Rate"  id="currency_rate_Text" class="form-control  input-sm">
                        </div>
                         <div class="col-sm-1"></div>
                        <div class="col-sm-1">
                            <input type="text" placeholder="Code1"  id="code1" class="form-control hidden input-sm">
                        </div>
                          <label class="col-sm-1" for="c_code">Manual No</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Manual No"  id="manual_no_Text" class="form-control  input-sm">
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
                            <input type="text" placeholder="Katuwana EnterPrises (PVT) LTD"  id="katuwana_enterPrises_Text" class="form-control  input-sm">
                        </div>                             
                        <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Net Amount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Net Amount"  id="net_amount_Text" class="form-control  input-sm">
                        </div>
                    </div>
                                  
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Tax Combination Code</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Tax Combination Code"  id="tax_combination_code_Text" class="form-control  input-sm">
                        </div>

                    </div>
                   <div class="col-sm-5">
                            <input type="text" placeholder="Consoalidate Cost Center"  id="consoalidate_cost_center_Text" class="form-control  input-sm">
                        </div>
                 <div class="col-sm-1"></div>
                 <label class="col-sm-1" for="c_code">Tax Amount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Tax Amount"  id="tax_amount_Text" class="form-control  input-sm">
                        </div>
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Total Credt Amount</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Total Credt Amount"  id="total_credt_amount_Text" class="form-control  input-sm">
                        </div>

                    </div>           
                  <div class="col-sm-6"></div>
                  <label class="col-sm-3" for="c_code">Balance Amount To Be Alocated</label>
                                            <div class="col-sm-2">
                            <input type="text" placeholder="Balance Amount To Be Alocated"  id="balance_amount_to_be_alocated" class="form-control  input-sm">
                        </div>  
                        
                  
                       <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-11">
                            <input type="text" placeholder="Remarks"  id="remarks_Text" class="form-control  input-sm">
                        </div>
                    </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <input type="text" placeholder="uniq"  id="uniq" class="form-control hidden input-sm">
                        </div>  
                 
                   <br><br><br>
               <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Rec No.</th>
                                        <th style="width: 30%;">Account Name</th>
                                        <th style="width: 10%;">Apply Tax</th>
                                        <th style="width: 10%;">Allocated Amount</th>
                                        <th style="width: 10%;">Tax Amount</th>
                                        <th style="width: 10%;">Total Amount</th>
                                        <th style="width: 10%;">Job No</th>
                                        <th style="width: 15%;">Remarks</th>
                                        <th style="width: 12%;"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No." id="rec_no_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Account Name"  id="account_name_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Apply Tax"  id="apply_tax_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Allocated Amount"  id="allocated_amount_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Tax Amount"  id="tax_amount_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Total Amount"  id="total_Amount_Tax" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Job No"  id="job_no_Text" class="form-control input-sm">
                                        </td>
                                         <td>
                                            <input  type="text" placeholder="Remarks"  id="remarks_Text2" class="form-control input-sm">
                                        </td>
                                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
                     <br><br><br><br><br><br>
                </div> 
                </div>            
            </div>
        </form>
    </div>
</section>
        <script src="js/sarvice_invoice.js"></script>


<script>newent();</script>
