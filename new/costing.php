<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section id="full" class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title"><strong>Costing</strong></h1>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">

                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">
                <div class="form-group-sm">
                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>
                    <a id="savebtn" onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                    <a onclick="cancel_inv();" class="btn btn-danger btn-sm">
                        <span class="fa fa-trash-o"></span> &nbsp; CANCEL
                    </a>

                    <a style="float: right;margin-right: 10px;" onclick="NewWindow('list_costing.php', 'mywin', '1920', '1080', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; List
                    </a>
                    <a style="float: right;margin-right: 10px;" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm">
                        <span  ></span> &nbsp; Tools
                    </a>
                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>

                <div id="msg_box"  class="span12 text-center"></div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <table  class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item Code</th>
                                                    <th>Item Name</th>

                                                </tr>
                                            </thead>
                                        </table>
                                        <div style="height: 10px;background-color: #337ab7;"></div>
                                        <table id="costingTool" class="table table-bordered">

                                            <tbody>


                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="col-sm-1">
                                        <a href="" onclick="NewWindow('serach_item.php?stname=costing_tool', 'mywin', '800', '700', 'yes', 'center');
                                                return false" onfocus="this.blur()">
                                            <input type="button" name="searchcusti" id="searchcusti" value="..." class="btn btn-default btn-sm">
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="form-group"></div>
                <div class="form-group"></div>
                <table class="table table-borderless">
                    <tr>
                        <td class="col-sm-12">
                            <div class="form-group">
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Ref No:</label>
                                <div class="col-sm-3">
                                    <input type="text" id="refText" name="refText" placeholder="Reference No" class="form-control  input-sm" disabled>
                                </div>
                                <div class="col-sm-1">
                                    <a onfocus="this.blur()" onclick="NewWindow('search_costing.php', 'mywin', '1300', '700', 'yes', 'center');
                                            return false" href="">
                                        <button type="button" class="btn btn-default">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </a>
                                </div>
                                <!--                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno"></label>-->
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Date:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="dateTxt" value="<?php echo date("Y-m-d"); ?>" class="form-control dt input-sm">
                                </div>
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Manual Ref </label>
                                <div class="col-sm-2">
                                    <input type="text" id="drfTxt" placeholder="DRF No" class="form-control  input-sm">
                                </div>
                                <br>
                                <br>
                                <br>
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Quoation Ref :</label>
                                <div class="col-sm-2">
                                    <input type="text" id="quoTxt" placeholder="Quoation Ref" class="form-control  input-sm">
                                </div>
                                 <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_quotation.php?stname=quotation_code', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
                                    </div>
                            </div>
                            <br>
                            <div class="col-md-2">

                                <div class="form-group">
                                    <?php
                                    include './connectioni.php';
                                    echo" <div class = \"col-md-12\" id = \"filup\">";

                                    echo" <label class = \"col-md-12\" for = \"file-3\">1. Choose Your Excel</label>";
                                    echo" <br>";
                                    echo"  <label class = \"btn btn-default col-md-12\" for = \"file-3\">";
                                    echo" <input onchange = \"upfile();\" class=\"form-control\" id = \"file-3\" name = \"file-3\" multiple = \"true\" type = \"file\" >";
                                    echo"Select Files";

                                    echo"  </label>";
                                    echo" <div class = \"col-sm-12\">";
                                    echo" <label class = \"col-sm-2\"></label>";
                                    echo" <div class = \"form-group\"></div>";
                                    // echo" <input type=\"submit\" id=\"submit\" name=\"submit\" value=\"upload\">";

                                    echo" </div>";
                                    echo" </div>";
                                    echo" </div>";

                                    echo" <div class = \"row\">";
                                    echo" <div id = \"filebox\" class = \"col-md-6 scroll\" style = \"visibility: hidden\">";
                                    echo"</div>";
                                    echo"</div>";
                                    ?>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>2. Choose Ink</label>
                                <br>
                                <br>
                                <div class="form-group">
                                    <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Ink</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="inkCode" name="inkCode" placeholder="Ink" class="form-control  input-sm" disabled>
                                    </div>
                                    <div class="col-sm-1">
                                        <a onfocus="this.blur()" onclick="NewWindow('search_ink_master.php?stname=pre_ink', 'mywin', '800', '700', 'yes', 'center');
                                                return false" href="">
                                            <button type="button" class="btn btn-default">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </a>
                                    </div>
                                    <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Ink Avg Cost</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="inkAvg" name="inkAvg" placeholder="Avg Cost" class="form-control  input-sm"  disabled>
                                    </div>
                                    <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Sqft Capacity</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="inkCap" name="inkCap" placeholder="Sqft Capacity" class="form-control  input-sm" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                    </div>
                                    <label  class="col-sm-2" style="text-align: left;" for="invno">Ink Qty</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" id="inkQty" name="" placeholder="Qty" class="form-control  input-sm" disabled>
                                         <input type="text" id="inkQtyShow" name="" placeholder="Ink Qty" class="form-control  input-sm" disabled>
                                        <input type="hidden" id="effSqFt" name="effSqFt" placeholder="effSqFt" class="form-control  input-sm" disabled>
                                    </div>
                                    <label  class="col-sm-2" style="text-align: left;" for="invno">Ink Total Cost</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="inkTotCostShow" name="" placeholder="Ink Total Cost" class="form-control  input-sm" 
                                        disabled>
                                        <input type="hidden" id="inkTotCost" name="" placeholder="Cost" class="form-control  input-sm" 
                                        disabled>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>3. Generate</label>
                                <br>
                                <br>
                                <a class ="btn btn-primary" id="genbtn" style="width: 100%;" onclick = "upfile();setTimeout(upbar, 1500);" class = "btn">Generate</a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Customer</label>
                                <div class="col-sm-2">
                                    <input type="text" id="cusText" name="cusText" placeholder="Customer Code" class="form-control  input-sm">
                                </div>
                                <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Customer Name</label>
                                <div class="col-sm-3">
                                    <input type="text" id="cusTextName" name="cusTextName" placeholder="Customer Name" class="form-control  input-sm">
                                </div>
                                <div class="col-sm-1">
                                    <a onfocus="this.blur()" onclick="NewWindow('serach_customer.php?stname=costing', 'mywin', '800', '700', 'yes', 'center');
                                            return false" href="">
                                        <button type="button" class="btn btn-default">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label  class="col-sm-1 control-label text-center" style="text-align: left;" >Factory:</label>
                                <div class="col-sm-3">
                                    <select id="txt_factory" class="form-control input-sm">

                                    </select>



                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p id="proval">0%</p>
                            <div id="probar" class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%" >

                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Description:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="desText" name="desText" placeholder="Product Description" class="form-control  input-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Product Ref</label>
                                <div class="col-sm-2">
                                    <input type="text" id="proCodeText" name="proCodeText" placeholder="Product Code" class="form-control  input-sm">
                                </div>
                                <label  class="col-sm-2 control-label text-center" style="text-align: left;" for="invno">Product Name</label>
                                <div class="col-sm-3">
                                    <input type="text" id="proNameText" name="proNameText" placeholder="Product Name" class="form-control  input-sm">
                                </div>
                                <div class="col-sm-1">
                                    <a onfocus="this.blur()" onclick="NewWindow('search_product_master.php?stname=costing', 'mywin', '800', '700', 'yes', 'center');
                                            return false" href="">
                                        <button type="button" class="btn btn-default">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </a>
                                </div>



                            </div>
                            <div class="form-group">

                                <label  class="col-sm-2 control-label text-center" style="text-align: left;" >Metric Measurement Type:</label>
                                <div class="col-sm-3">
<!--                                    <select style="color: white; background-color: #3c8dbc;" id="txt_factory" class="form-control input-sm">

                                    </select>-->

                                    <input type="text" id="MMT" placeholder="Metric Measurement Type" class="form-control  input-sm">
                                    <input type="text" id="Meas" placeholder="Metric Measurement Type" class="form-control hidden input-sm">

                                </div>

                            </div>
                        </td>
                    </tr>







                    <tr>
                        <td>
                            <div class="form-group">
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Costing Qty:</label>
                                <div class="col-sm-2">
                                    <input type="text" id="reqQtyText" name="reqQtyText" placeholder="Requested Qty" class="form-control  input-sm">
                                </div>
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;" for="invno">Total Cost per Unit (Rs.)</label>
                                <div class="col-sm-2">
                                    <input type="text" id="Total_Cost_per_Unit" name="Total_Cost_per_Unit" placeholder="Total Cost Per Unit" class="form-control  input-sm">
                                </div>
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Selling (Rs.)</label>
                                <div class="col-sm-2">
                                    <input type="text" id="sellingText" name="sellingText" placeholder="Selling Price" class="form-control  input-sm">
                                </div>

                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Total Sales Value  (Rs.)</label>
                                <div class="col-sm-2">
                                    <input type="text" id="Total_Sales_Value" name="TotalSalesValue" placeholder="Total Sales Value" class="form-control  input-sm">
                                </div>
                                <br><br>
                                <br><br>
                                <label  class="col-sm-1 control-label text-center" style="text-align: left;"  for="invno">Total Job Cost  (Rs.)</label>
                                <div class="col-sm-2">
                                    <input type="text" id="Total_Job_Cost" name="TotalJobCost" placeholder="Total Job Cost" class="form-control  input-sm">
                                </div>

                                <label  class="col-sm-1 control-label hidden text-center" style="text-align: left;" for="invno">Order Qty:</label>
                                <div class="col-sm-2 hidden">
                                    <input type="text" id="orderQtyTxt" name="orderQtyTxt" placeholder="Order Qty" class="form-control  input-sm">
                                </div>

                            </div>
                            <br>



                        </td>
                    </tr>

                    <tr>
                        <td>
<!--                            <div id="meas" style="width: 50px;height: 30px;background-color: #3c8dbc;border-radius: 5px;">
                                <p id="MM"></p>
                            </div>-->
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Length</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Length" name="lengthTxt" id="lengthTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Total SQ Inch</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Total SQ Inch" name="totSqInchTxt" id="totSqInchTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">No Of Ups</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="No Of Ups" id="noOfUpsTxt" name="noOfUpsTxt" class="form-control input-sm">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Width</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="width" id="widthTxt" name="widthTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Total SQFT</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Total SQFT" id="totSqftTxt" name="totSqftTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">FOH Margin</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="FOH Margin" id="fohMarginTxt" name="fohMarginTxt" class="form-control input-sm">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Color</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Color" id="colorTxt" name="colorTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">No Of Impressions</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="No Of Impressions" id="noOfImpTxt" name="noOfImpTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Sales Margin</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Sales Margin" id="salesMarginTxt" name="salesMarginTxt" class="form-control input-sm">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Waste</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Waste" id="wasteTxt" name="wasteTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno"> No. of Outs</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder=" No. of Outs" id="noOfOutsTxt" name="noOfOutsTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Commission Per Unit</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Commission Per Unit" id="commissionPerUnitTxt" name="commissionPerUnitTxt" class="form-control input-sm">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Material Cost Per Unit (Rs.) </label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="unit cost" id="unitCostTxt" name="unitCostTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Unit Waste</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="unit waste" id="unitWasteTxt" name="unitWasteTxt" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Material Cost Per Total Job (Rs.)</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="unit job cost" id="unitJobCostTxt" name="unitJobCostTxt" class="form-control input-sm">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-sm">
                                <label class="col-sm-2 input-sm" for="invno">Sides</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="Sides " id="sidesText" name="sidesText" class="form-control input-sm">
                                </div>
                            </div>

                        </td>
                    </tr>

                </table>

                <div id="itemList"  class="span12 text-center"  ></div>




                <div class="form-group">

                </div>

                <div class="container">
                    <label>Prepared By</label>
                    <p><?php echo $_SESSION['UserName']; ?></p>
                </div>





        </form>
    </div>

</section>
<script src="js/costing.js"></script>

<script>

function stock_report() {

  if (document.getElementById('dt').value == "") {
      return false;
  }
                                            alert("fsdkjd");
                                            var url = "report_stock.php";
                                            url = url + "?dtto=" + document.getElementById('dt').value;

                                            window.open(url, '_blank');




                                        }


</script>

<script>
    newent();
    // n();
</script>
