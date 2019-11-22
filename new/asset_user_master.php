<style>


    .table {
        border-radius: 12px;
    }

    .table thead tr{
        background-color:lavender;
        border: 2px solid #ddd;
    }

    .table thead tr th{
        border: 2px solid #ddd;
    }


    .table {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .table tr td{
        border: 2px solid #ddd;
    }s
</style>   
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Asset User Master</b></h3>
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

                    <a onclick="NewWindow('SEARCH_GRN_Stores_GT.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="edit();" class="btn btn-warning btn-sm ">
                        <span class="glyphicon glyphicon-edit"></span> &nbsp; EDIT
                    </a>       
                    <a onclick="delete1();" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>



                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Ref.</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Ref."  id="ref" class="form-control  input-sm  " disabled="">
                        </div>


                        <div class="form-group-sm">

                            <div class="col-sm-2">
                                <input type="text" placeholder=""  id="uniq" class="form-control hidden input-sm">
                            </div>

                        </div>

                        <div class="form-group"></div>
                        <div class="form-group-sm">

                            <label class="col-sm-2" for="c_code">User Department</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="User Department"  id="user_department" class="form-control  input-sm">
                            </div>
                            <div class="form-group"></div>
                            <div class="form-group-sm">
                                <label class="col-sm-2" for="c_code">Name Of User</label>
                                <div class="col-sm-2">

                                    <input type="text" placeholder="Name Of User"  id="nameofuser" class="form-control  input-sm">
                                </div>

                                <div class="form-group"></div>
                                <div class="form-group-sm">
                                    <label class="col-sm-2" for="c_code">User</label>
                                    <div class="col-sm-2">
                                        <input type="text" placeholder="User"  id="user" class="form-control  input-sm">
                                    </div>

                                </div>

                                


                            </div>


                        </div>

                        </form>

                    </div>

                    </section>
<script src="js/asset_user_master.js"></script>


                    <script>newent();</script>
