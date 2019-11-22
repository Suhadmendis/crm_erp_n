<?php
include './connection_sql.php';
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<section class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Customer Master<?php
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

                    <a onclick="NewWindow('search_ccustomer_master.php?stname=cus', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <!--                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; List
                                        </a>
                                        <a onclick="NewWindow('Search_Manuel_AOD.php', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                                        </a>-->

                    <a  onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Delete
                    </a>


                </div>
                <div id="msg_box"></div>


                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Ref.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Customer Ref'  id='ref_id' class='form-control Name  input-sm' disabled="">
                        <input type='text' placeholder=''  id='uniq' class='form-control Name hidden input-sm ' disabled="">
                        <input type='text' placeholder=''  id='vendor' value="C" class='form-control Name hidden input-sm ' disabled="">
                        <!--hidden-->
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Name</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Name'  id='name' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>Telephone</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Tel.'  id='tel' class='form-control Name input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>Web Site</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Web Site'  id='website' class='form-control Name input-sm'>
                    </div>
                </div>
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>Address</label>
                    <div class='col-sm-2'>
<!--                        <input type='text' placeholder='Address'  id='addr' class='form-control Name  input-sm'>-->
                        <textarea rows="3" cols="27" id='addr'></textarea>

                    </div>
                    <label class='col-sm-1' for='c_code'>Mobile No.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Mobile No.'  id='mobile' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>Email.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Email.'  id='email' class='form-control Name  input-sm'>
                    </div>

                </div>
                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-1' for='c_code'>ID No.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='ID No.'  id='idno' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-1' for='c_code'>Fax No.</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Fax No.'  id='faxno' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Date Of Birth</label>
                    <div class='col-sm-2'>
                        <input type='date' placeholder='DOB'  id='dob' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Customer A/C Code</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Code'  id='ac_code' class='form-control Name  input-sm'>
                    </div>
                    <label class='col-sm-2' for='c_code'>Gain / Loss A/C</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Code2'  id='g_l_ac' class='form-control Name  input-sm'>
                    </div>
                </div>

                <div class='form-group'></div>
                <div class='form-group-sm'>
                    <label class='col-sm-2' for='c_code'>Advance A/C Code</label>
                    <div class='col-sm-2'>
                        <input type='text' placeholder='Adv Code'  id='adv_ac_code' class='form-control Name  input-sm'>
                    </div>
                </div>

            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <div>
                    <label class='col-sm-2' for='c_code'>Contact</label>
                </div>
            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Contact Person</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Person'  id='con_person' class='form-control Name  input-sm'>
                </div>
                <label class='col-sm-1' for='c_code'>Telephone</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Tel.'  id='con_tel' class='form-control Name input-sm'>
                </div>

            </div>

            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'>Address</label>
                <div class='col-sm-2'>
<!--                    <input type='text' placeholder='Address'  id='con_addr' class='form-control Name  input-sm'>-->
                    <textarea rows="3" cols="27" id='con_addr'></textarea>
                </div>
                <label class='col-sm-1' for='c_code'>Mobile No.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Mobile'  id='con_mobile' class='form-control Name input-sm'>
                </div>
            </div>
            <div class='form-group'></div>
            <div class='form-group-sm'>
                <label class='col-sm-2' for='c_code'></label>
                <label class='col-sm-2' for='c_code'></label>

                <label class='col-sm-1' for='c_code'>Fax.</label>
                <div class='col-sm-2'>
                    <input type='text' placeholder='Fax'  id='con_fax' class='form-control Name input-sm'>
                </div>

            </div>



        </form>


        <br>
        <br>
        <br>
        <br>

    </div>

</section>
<script src="js/ccustomer_master.js"</script>



<!--<script src="js/Manuel_aod_table.js">
</script>-->
<?php
include 'login.php';
include './cancell.php';
?>
<script>
new_inv('C');
</script>
