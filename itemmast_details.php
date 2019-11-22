




<script language="JavaScript" src="js/pur_ord.js"></script>
<link rel="stylesheet" href="css/table.css" type="text/css"/>	
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>

<script type="text/javascript" language="javascript" src="js/get_cat_description.js"></script>
<script type="text/javascript" language="javascript" src="js/datepickr.js"></script>

<script language="javascript" src="cal2.js">
    /*
     Xin's Popup calendar script-  Xin Yang (http://www.yxscripts.com/)
     Script featured on/available at http://www.dynamicdrive.com/
     This notice must stay intact for use
     */
</script>
<script language="javascript" src="cal_conf2.js"></script>
<script language="javascript" type="text/javascript">
<!--
    /****************************************************
     Author: Eric King
     Url: http://redrival.com/eak/index.shtml
     This script is free to use as long as this info is left in
     Featured on Dynamic Drive script library (http://www.dynamicdrive.com)
     ****************************************************/
    var win = null;
    function NewWindow(mypage, myname, w, h, scroll, pos) {
        if (pos == "random") {
            LeftPosition = (screen.width) ? Math.floor(Math.random() * (screen.width - w)) : 100;
            TopPosition = (screen.height) ? Math.floor(Math.random() * ((screen.height - h) - 75)) : 100;
        }
        if (pos == "center") {
            LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
            TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
        } else if ((pos != "center" && pos != "random") || pos == null) {
            LeftPosition = 0;
            TopPosition = 20
        }
        settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
        win = window.open(mypage, myname, settings);
    }
    //    -->
</script>

    <script type="text/j        avascript">
        functio        n open            Win()
        {
        myWindow = window.open('serach_inv.php', '', 'width=200,he            ight=100');
        myWindo        w.focu            s();

        }            
    </script>

    <script type="te                xt/javascript">
        window.onload                     = function () {
        n                        ew JsDatePick({
        useMode: 2,
        target:                        "dte_shedule",
        dateFor                                mat: "%Y-%m-%d"
        /*selectedDate:{				This is an example of what the full config                                 uration offers.
        day:5,						For full documentation about these settings please see the full versi                                 on of the code.
        month:9,
        year:2006
        },
        yearsRan                                 ge:[1978,2020],
        limi                                 tToToday:false,
        cellColor                                 Scheme:"beige",
        dateFor                                 mat:"%m-%d-%Y",
        imgPath:"img/",
        w                    eekStartDay:                1*/
        });
        };
    </script>


    <!-- Dynamic                List area -->

    <script type="text/javascript" src="ajax-dynamic-list.js"></script>
    <script type="text/javascript" language="JavaScript1.2" src="ajax.js"></script>






    <style type="text/css">
        /* Big box with list of options */
        #ajax_listOfOptions{
            position:absolute;	/* Never change this one */
            width:175px;	/* Width of box */
            height:250px;	/* Height of box */
            overflow:auto;	/* Scrolling features */
            border:1px solid #317082;	/* Dark green border */
            background-color:#FFF;	/* White background color */
            text-align:left;
            font-size:0.9em;
            z-index:100;
        }
        #ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
            margin:1px;		
            padding:1px;
            cursor:pointer;
            font-size:0.9em;
        }
        #ajax_listOfOptions .optionDiv{	/* Div for each item in list */

        }
        #ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
            background-color:#317082;
            color:#FFF;
        }
        #ajax_listOfOptions_iframe{
            background-color:#F00;
            position:absolute;
            z-index:5;
        }

        form{
            display:inline;
        }

        #article {font: 12pt Verdana, geneva, arial, sans-serif;  background: white; color: black; padding: 10pt 15pt 0 5pt}
        .style1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;
        }
    </style>   

    <!-- End of Dynamic list area -->
</label>

<style type="text/css">
    <!--
    .style1 {font-weight: bold}
    -->
</style>
<fieldset>
    <legend>
        <div class="text_forheader">Enter Item Details</div>
    </legend>             

    <form name="form1" id="form1">
        <input type="hidden" id="tmpno" name="tmpno" value="" />
        <input type="text" name="autho" id="autho" value="" class="text_purchase3"  />            
        <table width="100%" border="0"  class=\"form-matrix-table\">
            <tr>
                <td width="9%"><input type="text"  class="label_purchase" value="Stock No (Code)" disabled/></td>
                <td width="15%"><input type="text" name="txtSTK_NO" id="txtSTK_NO" value="" class="text_purchase" onKeyPress="keyset('txtDESCRIPTION', event);" onblur="itemno_ind();
                                       "   />
                    <a href="serach_item.php?stname=itm_mast" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                        return false" onFocus="this.blur()">
                        <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                    </a></td>
                <td width="8%"><input type="text"  class="label_purchase" value="Description" disabled/></td>
                <td><input type="text" name="txtDESCRIPTION" id="txtDESCRIPTION" value="" class="text_purchase3" onkeypress="keyset('txtBRAND_NAME', event);"    /></td>
                <td><input type="text"  class="label_purchase" value="Job No" disabled="disabled"/></td>
                <td><input type="text" name="txtjobno" id="txtjobno" value="" class="text_purchase3" onkeypress="keyset('txtBRAND_NAME', event);"    /></td>
                <td><input type="text"  class="label_purchase" value="Com No" disabled="disabled"/></td>
                <td><input type="text" name="txtcomno" id="txtcomno" value="" class="text_purchase3" onkeypress="keyset('txtBRAND_NAME', event);"    /></td>
                <td width="3%">&nbsp;</td>
                <td width="3%">&nbsp;</td>
                <td width="5%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="text"  class="label_purchase" value="Brand Name" disabled/></td>
                <td><input id="txtBRAND_NAME" name="txtBRAND_NAME" type="text" onkeypress="keyset('txtGEN_NO', event);" class="text_purchase3" /></td>
                <td><input type="text"  class="label_purchase" value="Model" disabled="disabled"/></td>
                <td width="15%"><input id="txtmodel" name="txtmodel" type="text"  class="text_purchase3" onkeypress="keyset('txtPART_NO', event);"/></td>
                <td colspan="4" rowspan="2">
                    <fieldset>
                        <legend><strong>Reference Numbers (Equal Items)</strong></legend>
                        <input type="text" class="text_purchase1"  id="txtREFNO1" name="txtREFNO1" onkeypress="keyset('txtREFNO2', event);">
                        <input type="text" class="text_purchase1"  id="txtREFNO2" name="txtREFNO2" onkeypress="keyset('txtREFNO3', event);">
                        <input type="text" class="text_purchase1"  id="txtREFNO3" name="txtREFNO3" onkeypress="keyset('Com_group1', event);">
                    </fieldset>    </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="text"  class="label_purchase" value="Part No" disabled="disabled"/></td>
                <td><input id="txtPART_NO" name="txtPART_NO" type="text" onkeypress="keyset('txtGEN_NO', event);" class="text_purchase3" /></td>
                <td><input type="text"  class="label_purchase" value="Genuine No" disabled="disabled"/></td>
                <td><input type="text" class="text_purchase3"  id="txtGEN_NO" name="txtGEN_NO" onkeypress="keyset('Com_group1', event);" onKeyUp="ajax_showOptionsfname(this, 'getCountriesByLetters', event, 'ajax-list-road.php');"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
                <td width="35%" colspan="3">&nbsp;</td>
                <td width="3%">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="21%">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5"><fieldset>
                        <legend><strong>Groups</strong></legend>
                        <input type="text" class="text_purchase1"  id="Com_group1" name="Com_group1" onkeypress="keyset('Com_group2', event);">
                        <input type="text" class="text_purchase1"  id="Com_group2" name="Com_group2" onkeypress="keyset('Com_group3', event);">
                        <input type="text" class="text_purchase1"  id="Com_group3" name="Com_group3" onkeypress="keyset('Com_group4', event);">
                        <input type="text" class="text_purchase1"  id="Com_group4" name="Com_group4" onkeypress="keyset('cmbcat', event);" disabled="disabled">
                    </fieldset> </td>
                <td colspan="6"><fieldset>
                        <legend><strong>Locations (Bins)</strong></legend>
                        <input type="text" class="text_purchase1"  id="txtLOCATE_1" name="txtLOCATE_1" onkeypress="keyset('txtLOCATE_2', event);">
                        <input type="text" class="text_purchase1"  id="txtLOCATE_2" name="txtLOCATE_2" onkeypress="keyset('txtLOCATE_3', event);">
                        <input type="text" class="text_purchase1"  id="txtLOCATE_3" name="txtLOCATE_3" onkeypress="keyset('txtLOCATE_4', event);">
                        <input type="text" class="text_purchase1"  id="txtLOCATE_4" name="txtLOCATE_4" onkeypress="keyset('txtCOST', event);">
                    </fieldset> </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="-1%">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="12">
                    <table width="1000" border="0">
                        <tr>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Cost" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtCOST" name="txtCOST" onkeypress="keyset('txtMARGIN', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Margine" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtMARGIN" name="txtMARGIN" onkeypress="keyset('txtSELLING', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Selling" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtSELLING" name="txtSELLING" onkeypress="keyset('TXTSELLING_DISPLAY', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Display Selling" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="TXTSELLING_DISPLAY" name="TXTSELLING_DISPLAY" onkeypress="keyset('txtweight', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Weight" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtweight" name="txtweight" onkeypress="keyset('txtcountry', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Country" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtcountry" name="txtcountry" onkeypress="keyset('txtUNIT', event);"/></th>
                        </tr>
                        <tr>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Unit" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtUNIT" name="txtUNIT" onkeypress="keyset('txtSIZE', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Size" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtSIZE" name="txtSIZE" onkeypress="keyset('txtRE_O_LEVEL', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Re-Order Level" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtRE_O_LEVEL" name="txtRE_O_LEVEL" onkeypress="keyset('txtRE_O_qty', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Re-Order Qty" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtRE_O_qty" name="txtRE_O_qty" onkeypress="keyset('txttype', event);"/></th>
                            <th scope="col"><input type="text"  class="label_purchase" value="Type" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txttype" name="txttype" onkeypress="keyset('txtpendingord', event);"/></th>
                            <th scope="col"><input type="text"  class="label_purchase" value="NSD" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtNSD" name="txtNSD" onkeypress="keyset('txtpendingord', event);"/></th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="12"><br>
                    <table width="1000" border="0">
                        <tr>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="UOM" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtUOM" name="txtCOST" onkeypress="keyset('txtMARGIN', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Margine" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtfdMARGIN" name="txtMARGIN" onkeypress="keyset('txtSELLING', event);"/></th>
                            
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                            <th width="10%" scope="col"></th>
                            <th scope="col"></th>
                          
                       
                        </tr>
                       
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="3">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="11"><table width="1000" border="0">
                        <tr>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Pending Orders" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtpendingord" name="txtpendingord" onkeypress="keyset('txtdelivered', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Delivered" disabled="disabled"/></th>
                            <th scope="col"><input type="text" class="text_purchase3"  id="txtdelivered" name="txtdelivered" onkeypress="keyset('cmbcat', event);"/></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Cat" disabled="disabled"/></th>
                            <th scope="col"><select name="cmbcat" id="cmbcat" onkeypress="keyset('cmbtype', event);" onchange="keyset_chng('cmbtype', event);" class="text_purchase3">
                                    <option value="">--Not Selected--</option>
                                    <option value="TYRE">TYRE</option>
                                    <option value="BATTERY">BATTERY</option>
                                    <option value="TUBE">TUBE</option>
                                    <option value="ALLOY WHEEL">ALLOY WHEEL</option>
                                    <option value="MORTOR CYCLE">MORTOR CYCLE</option>
                                    <option value="NON STOCK">NON STOCK</option>
                                </select></th>
                            <th width="10%" scope="col"><input type="text"  class="label_purchase" value="Type" disabled="disabled"/></th>
                            <th scope="col"><select name="cmbtype" id="cmbtype" onkeypress="keyset('brand', event);" class="text_purchase3">
                                    <option value="">--Not Selected--</option>
                                    <option value="PCR">PCR</option>
                                    <option value="LTR">LTR</option>
                                    <option value="OTR">OTR</option>
                                    <option value="TBR">TBR</option>
                                    <option value="BIAS TYRES">BIAS TYRES</option>
                                    <option value="MC">MC</option>
                                </select></th>
                            <th width="10%" scope="col">&nbsp;</th>
                            <th scope="col">&nbsp;</th>
                            <th width="10%" scope="col">&nbsp;</th>
                            <th scope="col">&nbsp;</th>
                        </tr>

                    </table></td>
            </tr>

            <tr <?php
            if ($_SESSION["User_Type"] == "0") {
                echo "style=visibility:hidden;";
            }
            ?>>
                <td><input type="text"  class="label_purchase" value="To" disabled="disabled"/></td>
                <td><select name="to_dep" id="to_dep" class="text_purchase3">
                        <?php
                        require_once './connectioni.php';
                        $sql = "select * from s_stomas order by CODE";
                        $result = mysqli_query($GLOBALS['dbinv'], $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            if ($row["CODE"] == "01") {
                                echo "<option selected value='" . $row["CODE"] . "'>" . $row["DESCRIPTION"] . "</option>";
                            } else {
                                echo "<option value='" . $row["CODE"] . "'>" . $row["DESCRIPTION"] . "</option>";
                            }
                        }
                        mysqli_close($GLOBALS['dbinv']);
                        ?>
                    </select></td>

                <td><input type="text" size="15" name="qty" id="qty" value="" class="text_purchase3"></td>
                <td><input type="checkbox" id="chkUpdate" name="chkUpdate" value="" />Update</td>
            </tr>


 <tr>
              <td>&nbsp;</td>
            </tr> <tr>
              <td>&nbsp;</td>
            </tr> 
            <tr>
                <td colspan="11"><table width="1000" border="0">
                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumptionACMIN" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_1" name="ILC_1" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_1" name="ILN_1" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_1" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumptionReturnACMIN" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_2" name="ILC_2" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_2" name="ILN_2" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_2" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumption_ReturnACMI" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_3" name="ILC_3" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_3" name="ILN_3" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_3" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumption" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_4" name="ILC_4" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_4" name="ILN_4" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_4" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>
                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="SalesTurnoverAC" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_5" name="ILC_5" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_5" name="ILN_5" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_5" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>
                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="SalesReturnTurnoverReturnAc" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_6" name="ILC_6" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_6" name="ILN_6" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_6" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>
                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="DisAcc" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_7" name="ILC_7" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_7" name="ILN_7" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_7" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MaterialIssueWIPMIN" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_8" name="ILC_8" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_8" name="ILN_8" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_8" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                        <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MaterialIssueWIPIS" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_9" name="ILC_9" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_9" name="ILN_9" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_9" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                          <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumptionIS" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_10" name="ILC_10" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_10" name="ILN_10" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_10" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>



 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MINGIIssueReturnDirec" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_11" name="ILC_11" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_11" name="ILN_11" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_11" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>


 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="RMConsumptionReturnIS" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_12" name="ILC_12" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_12" name="ILN_12" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_12" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>


 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="StockInHandAccoun" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_13" name="ILC_13" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_13" name="ILN_13" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_13" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>


 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MINGeneralIssueAccountNorma" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_14" name="ILC_14" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_14" name="ILN_14" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_14" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>


 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MINGeneralIssueReturnAccountNorma" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_15" name="ILC_15" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_15" name="ILN_15" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_15" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>


 <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MINGeneralIssueDirect" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_16" name="ILC_16" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_16" name="ILN_16" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_16" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>

                         <tr>

                            <th width="35%" scope="col">
                                <input type="text"  class="label_purchase" value="MINGeneralIssueReturnDirec" disabled="disabled"/>
                            </th>

                            <th width="15%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILC_17" name="ILC_17" onkeypress="keyset('txtdelivered', event);"/>
                            </th>

                             <th  width="30%" scope="col">
                                <input type="text" class="text_purchase3"  id="ILN_17" name="ILN_17" onkeypress="keyset('txtdelivered', event);"/>
                             </th>
                             <th  width="20%" scope="col">
                                    <a href="new/search_ledg.php?stname=item_mas_led_17" onClick="NewWindow(this.href, 'mywin', '1000', '700', 'yes', 'center');
                                                    return false" onFocus="this.blur()">
                                    <input type="button" name="searchinv2" id="searchinv2" value="..." class="btn_purchase1" >
                             </th>



               
                        </tr>



                    </table></td>
            </tr>
        </table>



        <fieldset>               


    </form>        



