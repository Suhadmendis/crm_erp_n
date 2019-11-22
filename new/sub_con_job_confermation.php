<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">SUB CONTRACTOR JOB CONFIRMATION</h3>
        </div>
        <?php
        $sql = "SELECT docname from doc_acc WHERE name = '" . $_GET['url'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();

        echo $row['docname'];
        ?>      </h3>
  

    <form role="form" name ="form1" class="form-horizontal">
        <div class="box-body">


            <div class="form-group">
                <a style="margin-left: 10px;"  onclick="new_inv();" class="btn btn-default btn-sm">
                    <span class="fa fa-user-plus"></span> &nbsp; New
                </a>

                <a  id="savebtn"  onclick="save_inv();" class="btn btn-success btn-sm">
                    <span class="fa fa-save"></span> &nbsp; Save 
                </a>

                <a onclick="NewWindow('search_sub_job_confermation.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
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
                <label class='col-sm-6' for='c_code'>Details of Supplier</label>
            </div>


            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Sup. No.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Sup. No.'  id='supno' class='form-control Name  input-sm' disabled="">
                    <input type='text' placeholder='uniq'  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                    <!--hidden-->
                </div>
            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Contact Name :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder=''  id='sname' class='form-control Name  input-sm'>
                </div>
                 <label class='col-sm-2' for='c_code'>Date :</label>
                <div class='col-sm-2'>
                    <input type='date' placeholder=''  id='scon_date' class='form-control Name  input-sm'>
                </div>
            </div>

            <!--                <div class='form-group'></div>
                            <div class='form-group-sm'>
                                
                            </div>-->


            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Contact Address :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='' id='con_add' class='form-control input-sm'>  
                </div>
                
                <label class='col-sm-2' for='c_code'>Our SPO No. :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Our SPO No.' id='spo_no' class='form-control input-sm'>  
                </div>

            </div>
            
             <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Job No.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Job No.' id='jobno' class='form-control input-sm'>  
                </div>

            </div>
             
             
            
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Contact No :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Contact No.' id='scon_num' class='form-control input-sm'>  
                </div>

            </div>
            
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Cheque in favour of   :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='' id='chq_fav' class='form-control input-sm'>  
                </div>

            </div>
            
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>NIC No.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='' id='nicno' class='form-control input-sm'>  
                </div>

            </div>
            
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>NIC Issued Date :</label>
                <div class='col-sm-2'>
                    <input type='date' placeholder='' id='nic_isu_date' class='form-control input-sm'>  
                </div>

            </div>
            
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Bus. Reg No. (If any )  :</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='' id='busregno' class='form-control input-sm'>  
                </div>

            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-6' for='c_code'>Sub Contracting Task Description</label>
            </div>     

            <div id="itemdetails">
                <div id='getTable'>
                    <table id='myTable' class='table table-bordered'>
                        <thead>
                            <tr>

                                <th style="width: 20%;">Description of Task</th>
                                <th style="width: 20%;">Qty</th>
                                <th style="width: 20%;">Unit Price</th>
                                <th style="width: 20%;">Total Value</th>
                                <th style="width: 12%;">Special Remark</th>
                                <th style="width: 8%;">Add/Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                            <input type='text' placeholder='' id='des_task' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='qty1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='unit_price' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='total_value' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='spec_remarks1' class='form-control input-sm'>
                        </td>
                        

                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                        </tr>
                        </tbody>


                    </table>
                </div>
            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-6' for='c_code'>Advance Payments</label>
            </div>

            <div id="itemdetails2">
                <div id='getTable'>
                    <table id='myTable' class='table table-bordered'>
                        <thead>
                            <tr>
                                <th style="width: 15%;">SPO No.</th>
                                <th style="width: 15%;">Cheque No.</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 20%;">Unit Price</th>
                                <th style="width: 15%;">Total</th>
                                <th style="width: 30%;">Special Remark</th>
                                <th style="width: 10%;">Add/Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <td>
                            <input type='text' placeholder='' id='spono1' class='form-control input-sm'>
                        </td>

                        <td>
                            <input  type='text' placeholder=''  id='cheqno1' class='form-control input-sm'>
                        </td>
                        <td>
                            <input  type='text' placeholder=''  id='qty2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder='' id='unitprice2' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='total' class='form-control input-sm'>
                        </td>
                        <td>
                            <input type='text' placeholder=''  id='spec_remarks2' class='form-control input-sm'>
                        </td>

                        <td><a onclick='add_tmp2();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


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
          </div>

</section>
<script src="js/sub_con_job_confermation.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
                        new_inv();
</script> 