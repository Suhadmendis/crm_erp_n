<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Advance Requests Fuel<?php
                $sql = "SELECT docname from doc_acc WHERE name = '" . $_GET['url'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch();

                echo $row['docname'];
                ?>      </h3>
        </div>

        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">


                <div class="form-group">
                    <a style="margin-left: 10px;"  onclick="new_inv();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save 
                    </a>

                    <a onclick="NewWindow('search_advance_requests_fuel.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>
                                        <a onclick="NewWindow('Search_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                                        </a>-->

                    <a  onclick="print();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a> 


                </div>
                <div id="msg_box"></div>


                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>ARF No.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='ARF No.'  id='arf_no' class='form-control Name  input-sm' disabled="">
                        <input type='text' placeholder='uniq'  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                        <!--hidden-->
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Requested Date</label>
                    <div class='col-sm-2'>
                        <input type='date' placeholder='Requested Date'  id='reqdate' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-2' for='c_code'>Department</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Department'  id='dep' class='form-control Name  input-sm'>
                    </div>
                </div>

                <!--                <div class='form-group'></div>
                                <div class='form-group-sm'>
                                    
                                </div>-->

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Requested By</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Requested By'  id='reqby' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-2' for='c_code'>Total Amount For Fuel</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Total Amount For Fuel'  id='t_amount' class='form-control Name  input-sm'>
                    </div>

                </div>
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Exp Settlement Due Date</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Exp Settlement Due Date'  id='ex_settle' class='form-control Name  input-sm'>
                    </div>


                    <div class='form-group'></div>
                    <div class='form-group-sm'>
                        <label class='col-sm-2' for='c_code'>Amount in Word</label>
                        <div class='col-sm-2'>
                            <input type='text' placeholder='Amount in Word'  id='amount_w' class='form-control Name  input-sm'>
                        </div>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Cheque in Favour of</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Cheque in Favour of'  id='c_favor' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Customer</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Customer Code'  id='customer_code' class='form-control Name  input-sm'>
                    </div>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Customer Name'  id='customer_name' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Job Numbers</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Job Numbers'  id='jobnos' class='form-control Name  input-sm'>
                    </div>
                </div>





            </div>   

            <div id="itemdetails">
                <div id='getTable'>
                    <table id='myTable' class='table table-bordered'>
                        <thead>
                            <tr>
                                <th style="width: 10%;">Vehicle Number</th>
                                <th style="width: 10%;">JB</th>
                                <th style="width: 5%;">Rate</th>
                                <th style="width: 10%;">Ltrs</th>
                                <th style="width: 10%;">Amount</th>
                                <th style="width: 10%;">Total KMs</th>
                                <th style="width: 10%;">Avg. Fuel Efficiency</th>
                                <th style="width: 10%;">Remark</th>
                                <th style="width: 5%;">Add/Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                            <input type='text' placeholder='Vehicle Number' id='vnumber' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder='JB'  id='jb' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder='Rate'  id='rate_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Ltrs' id='ltrs' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Amount'  id='amount_arf' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Total KMs'  id='totalkms' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Avg. Fuel Efficiency'  id='avg_fe' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='Remark'  id='remarks_arf' class='form-control input-sm'>
                        </td>
                        
                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                        </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </form>


        <br>
        <br>
        <br>
        <br>

    </div>    

</section>
<script src="js/advance_requests_fuel.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
                            new_inv();
</script> 