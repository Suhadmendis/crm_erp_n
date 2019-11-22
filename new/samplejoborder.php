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
                    <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>
                    <a onclick="cancel();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; CANCEL
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
                            <input type="text" placeholder="Customer"  id="sjrequestno_txt" class="form-control  input-sm" disabled="">
                        </div>
                        <label class="col-sm-3" for="c_code">Date</label>
                        <div class="col-sm-3">
                            <input type="date" placeholder="Date"  id="date_txt" class="form-control  input-sm">
                        </div>

                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">SJB Ref.</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="SJB Ref."  id="sjbref_txt" class="form-control  input-sm">
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
        </form>
    </div>

</section>
<script src="js/samplejoborder.js"></script>

<script>newent();</script>

