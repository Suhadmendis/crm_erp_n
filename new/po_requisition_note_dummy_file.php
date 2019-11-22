
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Po Requisition Note Dummy File</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">
                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group-sm">

                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a  onclick="save_user();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                    <a  style="background-color: red" onclick="delete1();" class="btn btn-success btn-sm">
                         <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                    </a>
                    <a onfocus="this.blur()" onclick="NewWindow('search_purchase_path.php?stname=PORN', 'mywin', '800', '700', 'yes', 'center');
                                    return false" href="">
<!--                                            <input type="button" class="btn btn-default "  id="searchcust" name="searchcust">-->
                        <button style="background-color: #0088cc" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>&nbsp; FIND
                                </button>
                            </a>                                    
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="col-md-12">
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Reference No</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Reference No"  id="reference_no_Text" class="form-control  input-sm  " disabled="">
                             <input type="text" placeholder="uniq"  id="uniq" class="form-control hidden input-sm"disabled="">
                        </div>
                    </div>                 
                       <div class="col-sm-1"></div>                       
                     <label class="col-sm-1" for="c_code">Date</label>
                        <div class="col-sm-3">
                            <input type="date" placeholder="Date of birth"  id="date_of_birth_txt" class="form-control  input-sm">
                        </div>                   
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Manual No</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Manual No"  id="manual_no" class="form-control  input-sm">
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          
                        </div>                   
                 <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Remarks</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Remarks No"  id="remarks_Text" class="form-control  input-sm">
                        </div>
                    </div> 
                   <br><br><br>
               <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Rec No.</th>
                                        <th style="width: 50%;">Product Code</th>
                                        <th style="width: 20%;">Qty</th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Rec No." id="rec_no_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Code"  id="product_code_Text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Qty"  id="qty_Text" class="form-control input-sm">
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
            </form>
          </div>
    </div>

</section>
<script src="js/po_requisition_note_dummy.js"></script>


<script>newent();</script>
