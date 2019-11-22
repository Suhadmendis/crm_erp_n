  
<?php
include './connection_sql.php';
?>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Manuel GRN</b></h3>
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
                    <!--                    <a   onclick="delete1();" class="btn btn-danger btn-sm">
                                            <span class="glyphicon glyphicon-trash" ></span> &nbsp; DELETE
                                        </a>-->
                    <a onfocus="this.blur()" onclick="NewWindow('search_manuel_grn.php?', 'mywin', '800', '700', 'yes', 'center');
                            return false" href="">
<!--                                            <input type="button" class="btn btn-default "  id="searchcust" name="searchcust">-->
                        <button  type="button" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-search"></span>&nbsp; FIND
                        </button>
                    </a>

                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 

                    <!--                    <a onclick="print();" class="btn btn-primary btn-sm">
                                            <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                                        </a>-->
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Manuel GRN Ref</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Manuel GRN Ref'  id='manuel_grn_ref' class='form-control Name  input-sm'>
                        <input type="text" placeholder="uniq"  id="uniq" class="form-control  hidden input-sm  " disabled="">
                        <!--hidden-->
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Name</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Name'  id='name' class='form-control Name  input-sm'>
                    </div>\
                    <label class='col-sm-2' for='c_code'>Date</label>
                    <div class='col-sm-2'>
                        <input type='date' placeholder='Date'  id='date' class='form-control Name  input-sm'>
                    </div>
                </div>



                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Address</label>
                    <div class='col-sm-4'>
                        <input type='text' placeholder='Address'  id='address' class='form-control Name  input-sm'>
                    </div>
                </div>

                <br><br><br>
                <div class="col-sm-12">
                    <div id="itemdetails" >
                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">AOD NO.</th>
                                        <th style="width: 20%;">NO</th>
                                        <th style="width: 50%;">Product Description</th>
                                        <th style="width: 10%;">Qty</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="AOD NO." id="aod_no" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="NO"  id="no_text" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Product Description"  id="product_description" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="Qty"  id="qty" class="form-control input-sm">
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


</div>

</form>

</div>

</section>
<script src="js/manuel_grn.js"></script>
<?php


  include 'autocompleJUI/mgrn_PATH.php';

?>




<script>newent();</script>
