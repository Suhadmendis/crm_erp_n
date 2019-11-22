<?php
//session_start();
?>

<?php
?>

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Sample Job Material Issue Note</b></h3>
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
                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>
                    
                    <a  style="float: right;"  onclick="NewWindow('list_sample_jobmaterials_issue_note.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; Listing
                    </a>


                    <a onclick="NewWindow('search_sample_job_path.php?stname=SAMPLE_JOBMATERIAL_ISSUE_NOTE', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                </div>
                <div class="form-group"></div>
                <div id="msg_box"  class="span12 text-center"  ></div>

                <div class="form-group"></div>
                <div class="form-group"></div>
                <div class="col-sm-8">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">SJB NO.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="SJB NO."  id="sjbno_txt" class="form-control  input-sm" disabled ="">
                        </div>

                        <div class="col-sm-3">
                            <input type="text" placeholder="Sample Job Request Ref"  id="uniq" class="form-control hidden input-sm">
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">SJB MRN Ref.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="SJB MRN Ref."  id="sjbmrnref_txt" class="form-control  input-sm">
                        </div>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Date</label>
                        <div class="col-sm-3">
                            <input type="date" placeholder="Date"  id="date_txt" class="form-control  input-sm">
                        </div>
                    </div>



                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">SJB MIN Ref</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="SJB MIN Ref"  id="sjbminref_txt" class="form-control  input-sm">
                        </div>
                    </div>
                    

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Manual Ref</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Manual Ref"  id="manualref_txt" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Remark</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Remark"  id="remark_txt" class="form-control  input-sm">
                        </div>
                    </div>
                </div>
        </form>
    </div>
            
             <div id="itemdetails">
                        <div id='getTable'>
                            <table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Item Code</th>
                                    <th style="width: 10%;">Material Name</th>
                                    <th style="width: 10%;">Required Qty</th>
                                    <th style="width: 10%;">Ex. Stock</th>
                                    <th style="width: 10%;">Issue Qty</th>
                                    <th style="width: 10%;">Balance to be issued</th>
                                    <th style="width: 10%;">UOM</th>
                                    <th style="width: 10%;">Add/Remove</th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='Item Code' id='itemcode' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Material Name'  id='materialname' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Required Qty'  id='requiredqty' class='form-control input-sm'>
                                    </td>
                                    
                                    <td>
                                        <input type='text' placeholder='Ex. Stock' id='exstock' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Issue Qty'  id='issueqty' class='form-control input-sm'>
                                    </td>
                                                                        
                                    <td>
                                        <input type='text' placeholder='Balance to be issued' id='balance_issued' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='UOM'  id='uom' class='form-control input-sm'>
                                    </td>
                                    
                                    <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>


                                </tr>
                            </tbody>


                        </table>
                    </div>
                </div>

</section>
<script src="js/sample_jobmaterials_issue_note.js"></script>

<script>newent();</script>

