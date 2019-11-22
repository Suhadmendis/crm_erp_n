
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Meal Reimbursement Form</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">
                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group-sm">

                    <a  onclick="new_inv();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a  onclick="save_inv();" id="savebtn" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                         <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>
                            <a onclick="NewWindow('search_meal_reimbursement.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="col-md-12">
                 
                    
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Ref No.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Ref No.'  id='refno' class='form-control Name  input-sm' disabled="">
                    <input type='text' placeholder='uniq'  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                    <!--hidden-->
                </div>
            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Reference</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Reference'  id='reference' class='form-control Name  input-sm'>
                </div>
                <label class='col-sm-2' for='c_code'>Date</label>
                <div class='col-sm-2'>
                    <input type='date' placeholder='Date'  id='mr_date' class='form-control Name  input-sm'>
                </div>
            </div>         
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Department Ref.</label>
                <div class='col-sm-2'>
                   <input type='type' placeholder='Department'  id='dept' class='form-control Name  input-sm'>
                </div>
               
               
                  <label class='col-sm-2' for='c_code'>Department Name</label>
                <div class='col-sm-2'>
                   <input type='type' placeholder='Department name'  id='depst_name' class='form-control Name  input-sm'>
                </div>
                   <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('search_dept_master.php?stname=meal', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="..." id="searchcust" name="searchcust">
                        </a>
                    </div>
                 </div>

                    
                   <br><br><br><br>
                   <h1 style="text-decoration: underline; font-size: 14px"><b>JB Allocation</b></h1>
                   
                   
               <div class="col-sm-12">
                    <div id="itemdetails">
            <div id='getTable'>
                <table id='myTable' class='table table-bordered'>
                    <thead>
                        <tr>

                            <th style="width: 20%;">Job No.</th>
                            <th style="width: 20%;">Amount</th>
                            <th style="width: 20%;">Equally</th>
                            <th style="width: 20%;">C.A. Amount</th>
                            <th style="width: 12%;">Usage</th>
                            <th style="width: 8%;">Add/Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <input type="text" placeholder="Job No." id="jobnum" class="form-control input-sm">
                    </td>

                    <td>
                        <input  type="text" placeholder="Amount"  id="mramount" class="form-control input-sm">
                    </td>
                    <td>
                        <input  type="text" placeholder="Equally"  id="equli" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" placeholder="C.A. Amount" id="ca_amount" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" placeholder="Usage"  id="usage1" class="form-control input-sm">
                    </td>
                   
                    <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>
                    </tr>
                    </tbody>


                </table>
            </div>
        </div> 
                </div>
                   <br><br><br><br>
                   <h1 style="text-decoration: underline; font-size: 14px"><b>Meal Reimbursement Details</b></h1>
                   <div class="col-sm-12">
                        <div id="itemdetails2">
            <div id='getTable'>
                <table id='myTable' class='table table-bordered'>
                    <thead>
                        <tr>

                            <th style="width: 20%;">Emp No.</th>
                            <th style="width: 20%;">Emp Name</th>
                            <th style="width: 20%;">Amount</th>
                            <th style="width: 20%;">Out Time & Date</th>
                            <th style="width: 12%;">Remark</th>
                            <th style="width: 8%;">Add/Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td>
                        <input type="text" placeholder="Emp No." id="empno" class="form-control input-sm">
                    </td>

                    <td>
                        <input  type="text" placeholder="Emp Name"  id="empname" class="form-control input-sm">
                    </td>
                    <td>
                        <input  type="text" placeholder="Amount"  id="mreamb_amount" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="datetime" placeholder="Out Time & Date" id="out_td" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" placeholder="Remark"  id="mr_remarks" class="form-control input-sm">
                    </td>
                   
                    <td><a onclick="add_tmp2();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>


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
    </div>

</section>

<script src="js/meal_reimbursement.js"></script>


<script>new_inv();</script>