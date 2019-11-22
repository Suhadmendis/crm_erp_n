<?php
//session_start();
?>

<?php
?>

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Sample Job Order ( SJB)</b></h3>
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

                    <a  style="float: right;"  onclick="NewWindow('list_sample_joborder_note.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; Listing
                    </a>

                    <a onclick="NewWindow('search_sample_joborder.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
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
                        <label class="col-sm-3" for="c_code">SJ Request No.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder=""  id="sjrequestno_txt" class="form-control  input-sm" >
                        </div>
                        <div class="col-sm-1">
                            <a onfocus="this.blur()" onclick="NewWindow('search_sample_jobrequest_note.php?stname=joborder', 'mywin', '1300', '700', 'yes', 'center');
                                            return false" href="">
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </button>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Sample Job Request Ref"  id="uniq" class="form-control hidden input-sm" hidden="">
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
                        <label class="col-sm-3" for="c_code">SJB Ref.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="SJB Ref."  id="sjbref_txt" class="form-control  input-sm" disabled="">
                        </div>

                    </div>



                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Customer</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Customer"  id="customer_txt" class="form-control  input-sm">
                        </div>

                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Mk. Ex</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Mk. Ex"  id="mkex_txt" class="form-control  input-sm">
                        </div>

                    </div>



                </div>

                <div class="col-sm-12">
                    <br>
                    <div id="itemdetails">
                        <div id='getTable'>
                            <table id='myTable' class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Item No.</th>
                                        <th style="width: 70%;">Sample Description</th>
                                        <th style="width: 15%;">Sample Qty</th>
                                        <th style='width: 5%;'>Add/Remove</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>
                                            <input type='text' placeholder='Item No.' id='itemno' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Sample Description'  id='SampleDescription' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Sample Qty'  id='SampleQty' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>

        </form>
    </div>

</section>
<script src="js/sample_job_order.js"></script>

<script>newent();</script>

