<?php
//session_start();
?>

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Ink Master</b></h3>
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


                    <a onclick="NewWindow('search_ink_master.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
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
                        <label class="col-sm-3" for="c_code">Ink Ref</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Ink Ref"  id="inkref_txt" class="form-control  input-sm" disabled="">

                        </div>

                    </div>
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Avg Cost Per liter</label>
                        <div class="col-sm-3">
                            <input type="double" placeholder="Avg Cost"  id="avgcostpl_txt" class="form-control  input-sm">
                        </div>
                        <label class="col-sm-3" for="c_code">No of SQFT</label>
                        <div class="col-sm-3">
                            <input type="double" placeholder="SQFT"  id="sqft_txt" class="form-control  input-sm">   
                        </div>

                    </div>

                </div>
                
                <div class="col-sm-8">



                 
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Description</label>
                        <div class="col-sm-3">
                            <input type="double" placeholder="Description"  id="description" class="form-control  input-sm">
                        </div>
                       

                    </div>

                </div>
        </form>
    </div>

</section>
<script src="js/ink_master.js"></script>

<script>newent();</script>

