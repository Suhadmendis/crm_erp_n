<?php
include './connection_sql.php';
?>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Manuel AOD</h3>
        </div>

        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">


                <div class="form-group">
                    <a style="margin-left: 10px;"  onclick="pageNew()" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; List
                    </a>
                    <a onclick="NewWindow('Search_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 


                </div>
                <div id="msg_box"></div>
                <div class="form-group"></div>
                <div class="form-group-sm">
                    <input id="customer" class="col-sm-1" onchange="csChange();" name="optradio" type="radio" class="form-check-input" id="exampleCheck1">
                    <label class="col-sm-2" for="exampleCheck1">Customer</label>
                    <input id="suppler" class="col-sm-1" onchange="csChange();" name="optradio" type="radio" class="form-check-input" id="exampleCheck1">
                    <label class="col-sm-2" for="exampleCheck1">Suppler</label>

                </div>

                <br>
                <br>

                <div class="col-sm-6">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">Name</label>
                        <div class="col-sm-9">
                            <input id="inputText" onkeyup="filter()" placeholder="Name" class="form-control input-sm" list="contentlist" name="namel" required="">
                            <datalist id="contentlist">

                            </datalist>
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Address</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Address" name="c_code" id="Address" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Name of the contact person</label>
                        <div class="col-sm-9">
                            <input onkeyup="validation('ncp');"  type="text" placeholder="Name of the contact person" name="c_code" id="ncp" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Tel No</label>
                        <div class="col-sm-9">
                            <input onkeyup="validation('tel');" type="text" placeholder="Tel No" name="c_code" id="tel" class="form-control input-sm">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-3" for="c_code">AOD Number</label>
                        <div class="col-sm-9">
                            <input  id="aodnumber" placeholder="AOD Number"  class="form-control input-sm" list="contentlist" name="namel" disabled="">
                            <input id="uniq" type="hidden" >
                            <datalist id="contentlist">

                            </datalist>
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Date of Despatch</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Date of Despatch" name="c_code" id="Date_of_Despatch" value="<?php echo date('Y-m-d') ?>" class="form-control input-sm" disabled="">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">Name of Driver</label>
                        <div class="col-sm-9">
                            <input onkeyup="validation('Name_of_Driver');"  type="text" placeholder="Name of Driver" name="c_code" id="Name_of_Driver" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-group-sm">

                        <label class="col-sm-3" for="c_code">JB No</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="JB No" name="c_code" id="SO_No" class="form-control input-sm">
                        </div>
                    </div>
                </div>

                <br><br><br><br><br><br><br><br><br><br>








                <div class="col-sm-12">
                    <div id="itemdetails" >


                        <div id="getTable">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Customer Purchase Order No.</th>
                                        <th style="width: 70%;">Product Description</th>
                                        <th style="width: 15%;">QTY</th>
                                        <th style="width: 5%;">Item</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>
                                            <input type="text" placeholder="Customer Purchase Order No." id="Customer_Order_number" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Product Description"  id="Product_Des" class="form-control input-sm">
                                        </td>
                                        <td>
                                            <input  type="text" placeholder="QTY"  id="QTY" class="form-control input-sm">
                                        </td>
                                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>


                                    </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>




            </div>       
        </form>


        <br>
        <br>
        <br>
        <br>

    </div>    

</section>
<script src="js/Manuel_aod.js"></script>

<!-- <script>

$(function () {
    $("#inputText").autocomplete({
        source: "autocompleteISO_PATH.php?Command=get_list&gl_name=" + document.getElementById('inputText').value ,
        minLength: 1,
        select: function (event, ui) {
            // $("#txt_gl_code").val(ui.item.id);
            $("#inputText").val(ui.item.name);
            return false;
        }
    });

});
</script> -->

<?php
include 'autocompleJUI/maod_PATH.php';
include 'login.php';
include './cancell.php';

?>

<script>
new_inv();
</script> 