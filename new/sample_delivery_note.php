<?php
//session_start();
?>

<?php
?>

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Sample Delivery Note</b></h3>
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

                    <a  style="float: right;"  onclick="NewWindow('list_sample_delivery_note.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; Listing
                    </a>

                    <a onclick="NewWindow('search_sample_job_path.php?stname=SAMPLE_DELIVERY_NOTE_DATA', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
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
                        <div class="form-group-sm">
                            <label class="col-sm-3" for="c_code">Delivery Code</label>
                            <div class="col-sm-3">
                                <input type="text" placeholder=""  id="sampletransnote_txt" class="form-control  input-sm" disabled ="">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" placeholder="Sample Job Request Ref"  id="uniq" class="form-control hidden  input-sm" hidden="">                            </div>
                        </div>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <div class="form-group-sm">
                            <label class="col-sm-3" for="c_code">Date</label>
                            <div class="col-sm-3">
                                <input type="date" placeholder="Date"  id="date_txt" class="form-control  input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">AOD ref</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="AOD ref"  id="aod_txt" class="form-control  input-sm">
                        </div>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Customer</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Customer"  id="customer_txt" class="form-control  input-sm">
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
                                    <th style="width: 10%;">SJB No.</th>
                                    <th style="width: 10%;">Item Name</th>
                                    <th style="width: 10%;">QTY</th>
                                    <th style="width: 10%;">Remarks</th>
                                    <th style='width: 10%;'>Add/Remove</th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='SJB No.' id='sjbno' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Item Name'  id='itemname' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Remarks'  id='remarks' class='form-control input-sm'>
                                    </td>
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>
                            </tbody>


                        </table>
                    </div>
                </div>

</section>
<script src="js/sample_delivery_note.js"></script>

<script>newent();</script>

