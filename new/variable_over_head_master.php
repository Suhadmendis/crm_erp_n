 
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Variable Over Head Master</b></h3>
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
                     <a onclick="NewWindow('search_overheads.php?stname=var_o_h', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>
                </div>
                <br>
                <div id="msg_box"  class="span12 text-center"  ></div>


                <div class="col-md-12">
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Labour Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Reference No"  id="reference_no_Text" class="form-control  input-sm  " disabled="">
                            <input type="text" placeholder="uniq"  id="uniq" class="form-control  hidden input-sm  " disabled="">
                        </div>

                    </div>
                   
                   <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-1" for="c_code">Description</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Description"  id="description_text" class="form-control  input-sm  " >
                            <!--<input type="text" placeholder="uniq"  id="uniq" class="form-control  hidden input-sm  " disabled="">-->
                        </div>

                    </div>
                   
                      
                </div>  
                
                </div>
            
  
            </div>
    
        </form>
     
    </div>

</section>
<script src="js/variable_over_head_master.js"></script>


<script>newent();</script>
