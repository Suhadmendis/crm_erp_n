
<?php 
/*if($_SESSION["login"]!="True")
{
	header('Location:./index.php');
}*/




/*if($_SESSION["login"]!="True")
{
	header('Location:./index.php');
}*/

	

						 
	require_once("config.inc.php");
	require_once("DBConnector.php");
						
	$sql = "delete FROM TMP_EDU_FILTER";
	$db = new DBConnector();
	$result =$db->RunQuery($sql);
						
	$sql = "delete FROM	TMP_QUALI_FILTER";
	$db = new DBConnector();
	$result =$db->RunQuery($sql);
?>	


<link rel="stylesheet" href="css/table_min.css" type="text/css"/>	
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>


 <input type="hidden" name="chqtot" id="chqtot" value="" disabled="disabled" class="text_purchase3"/></td>
<script language="javascript" type="text/javascript">
<!--
/****************************************************
     Author: Eric King
     Url: http://redrival.com/eak/index.shtml
     This script is free to use as long as this info is left in
     Featured on Dynamic Drive script library (http://www.dynamicdrive.com)
****************************************************/
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
// -->
</script>

<script type="text/javascript">
function openWin()
{
myWindow=window.open('serach_inv.php','','width=200,height=100');
myWindow.focus();

}
</script>

<script type="text/javascript">
function load_calader(tar){
		new JsDatePick({
			useMode:2,
			target:tar,
			dateFormat:"%Y-%m-%d"
			
		});
		
	}

</script>

<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dte_shedule",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>

</label>
          
<fieldset>
                                                	<legend>
  <div class="text_forheader">Credit Note Details</div>
                                               	 </legend>             


  <div id="openGL">
    
  </div>









<form name="form1" id="form1">   
 <input type="hidden" name="hiddencount" id="hiddencount" />         
  <table width="100%" border="0"  class=\"form-matrix-table\">

  <tr>
    <td width="14%"><input type="text"  class="label_purchase" value="CRN No" disabled/></td>
    <td width="14%"><input type="text" name="crnno" id="crnno" value="" class="text_purchase" onkeypress="keyset('searchcust',event);" onfocus="got_focus('invno');"  onblur="lost_focus('invno');"  />
      <a href="serach_crn.php" onClick="NewWindow(this.href,'mywin','800','700','yes','center');return false" onFocus="this.blur()">
        <input type="button" name="searchinv" id="searchinv" value="..." class="btn_purchase1" >
      </a></td>
    <td width="9%"><input type="checkbox" name="vehicle1" id="DE" value=""> Direct Entry<br></td>
    <td width="9%"><input type="text"  class="label_purchase" value="Date" disabled="disabled"/></td>
    <td width="15%"><input type="text"  name="crndate" id="crndate" value="<?php echo date("Y-m-d"); ?>" onfocus="load_calader('crndate');" class="text_purchase2"/></td>
    <td width="14%"><input type="text"  class="label_purchase" value="Department" disabled="disabled"/></td>
    <td width="14%"><select name="department" id="department" onkeypress="keyset('brand',event);" class="text_purchase3">
      <option value=""> --Select-- </option>
      <?php
                                  $sql="select * from s_stomas order by DESCRIPTION";
                                  $result =$db->RunQuery($sql);
                                  while($row = mysql_fetch_array($result)){
                                    if ($row["CODE"]=="01"){
                                                  echo "<option selected value='".$row["CODE"]."'>".$row["DESCRIPTION"]."</option>";
                                    } else {
                                      echo "<option value='".$row["CODE"]."'>".$row["DESCRIPTION"]."</option>";
                                    }
                                              }
                                ?>
    </select></td>
    <td width="4%">&nbsp;</td>
    <td width="0%">&nbsp;</td>
    <td width="0%">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"  class="label_purchase" value="Vendor" disabled="disabled"/></td>
    <td><input type="text" disabled="disabled"  class="text_purchase3" name="cus_code" id="cus_code"/></td>
    <td colspan="3"><input type="text" disabled="disabled"  class="text_purchase2" id="cus_name" name="cus_name" />      <a href="" onclick="NewWindow('serach_customer.php?stname=cre_note','mywin','800','700','yes','center');return false" onfocus="this.blur()">
      <input type="button" name="searchcust" id="searchcust" value="..."  class="btn_purchase" />
      </a></td>
    <td><input type="text"  class="label_purchase" value="Invoice No" disabled="disabled"/></td>
    <td><input type="text" name="invno" id="invno" value="" onkeypress="keyset('orderdate',event);" class="text_purchase3"/>
     <a href="serach_inv.php?stname=crn" onClick="NewWindow(this.href,'mywin','800','700','yes','center');return false" onFocus="this.blur()"><input type="button" name="searchord" id="searchord" value="..." class="btn_purchase1" >
     <input type="hidden" name="txtrno" id="txtrno" value="" onkeypress="keyset('orderdate',event);" class="text_purchase"/>
     </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"  class="label_purchase" value="Address" disabled="disabled"/></td>
    <td colspan="3"><input type="text"  class="text_purchase3"  disabled="disabled" id="cus_address" name="cus_address" /></td>
    <td>&nbsp;</td>
    <td><input type="text"  class="label_purchase" value="Form No" disabled="disabled"/></td>
    <td width="14%"><input type="text" name="orderno1" id="orderno1" value="" onkeypress="keyset('orderdate',event);" class="text_purchase3"/>
     <a href="serach_crn_appro.php?stname=crn" onClick="NewWindow(this.href,'mywin','800','700','yes','center');return false" onFocus="this.blur()"><input type="button" name="searchord" id="searchord" value="..." class="btn_purchase1" ></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="85"><input type="text"  class="label_purchase" value="Remarks" disabled/></td>
    <td colspan="3"><textarea name="remarks" id="remarks" cols="60" rows="5" ></textarea></td>
    <td><div style="color: #ff0000;font-size: 24px;font-weight: bold;" id="cancelid"></div>
</td>
    <td><input type="text"  class="label_purchase" value="Invoice Date" disabled="disabled"/></td>
    <td><input type="text" size="15" name="inv_date" id="inv_date" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td><input type="text"  class="label_purchase" value="Marketing Executive" disabled="disabled"/></td>
    <td colspan="4"><select name="salesrep" id="salesrep" onkeypress="keyset('dte_dor',event);" onchange="setord();" class="text_purchase1">
      <option value=''></option>
	  <?php
																	$sql="select * from s_salrep where cancel='1' order by REPCODE";
																	$result =$db->RunQuery($sql);
																	while($row = mysql_fetch_array($result)){
                        												echo "<option value='".$row["REPCODE"]."'>".$row["REPCODE"]." ".$row["Name"]."</option>";
                       												}
																?>
    </select></td>
    <td><input type="text"  class="label_purchase" value="Invoice Amount" disabled="disabled"/></td>
    <td><input type="text" size="15" name="invamount" id="invamount" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#00CCCC"><label>
            <input type="radio" name="vatgroup" value="vat" id="vatgroup_0" checked=""  />
      VAT Invoice</label></td>
    <td  bgcolor="#00CCCC"><label>
      <input type="radio" name="vatgroup" value="svat" id="vatgroup_2"  />
      SVAT Invoice</label></td>
      <td bgcolor="#00CCCC"><input type="checkbox" name="chk_nbt" id="chk_nbt" checked=""/>NBT</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text"  class="label_purchase" value="Cost Centre" disabled="disabled"/></td>
    <td><select name="costcenter" id="costcenter" onkeypress="keyset('vatgroup_0',event);" class="text_purchase3" onchange="assignbrand();">
      <option> --Select-- </option>
      <option value='1'>1</option>
      <option value='2'>2</option>
      <option value='3'>3</option>
      <option value='4'>4</option>
      <option value='5'>5</option>
      <option value='6'>6</option>
      <option value='7'>7</option>
      <option value='8'>8</option>
      <option value='9'>9</option>
      <option value='10'>10</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"  class="label_purchase" value="Amount" disabled="disabled"/></td>
    <td><input type="text" size="15" name="amount" id="amount" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text"  class="label_purchase" value="Total Paid" disabled="disabled"/></td>
    <td><input type="text" size="15" name="totpay" id="totpay" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text"  class="label_purchase" value="Invoice Balance" disabled="disabled"/></td>
    <td><input type="text" size="15" name="invbal" id="invbal" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"  class="label_purchase" value="Brand" disabled="disabled"/></td>
    <td><select name="brand" id="brand" onkeypress="keyset('searchitem',event);" class="text_purchase3"  onchange="setord();">
      <?php
																	$sql="select * from brand_mas order by barnd_name";
																	$result =$db->RunQuery($sql);
																	while($row = mysql_fetch_array($result)){
                        												echo "<option value='".$row["barnd_name"]."'>".$row["barnd_name"]."</option>";
                       												}
																?>
    </select></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td style="visibility:hidden;"><input type="checkbox" name="chkcash_disc" id="chkcash_disc" />
      Cash Discount</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"  class="label_purchase" value="Debit" disabled="disabled"/></td>
    <td><input type="text"  class="text_purchase3" name="accno2" id="accno2" size="10" value="" disabled=""/></td>
    <td><input type="text"  class="text_purchase3" size="10" id="acc_name2" name="acc_name2" value="" disabled=""/></td>
    <td><a href="search_ledger_acc.php?stname=cash_rec2" onclick="NewWindow(this.href,'mywin','800','700','yes','center');return false" onfocus="this.blur()">
      <input type="button" name="additem_tmp3" id="additem_tmp3" value="..." class="btn_purchase1" />
    </a></td>
    <td>&nbsp;</td>
    <td><input type="text"  class="label_purchase" value="Settled" disabled="disabled"/></td>
    <td><input type="text" size="15" name="settled" id="settled" value="" onkeypress="keyset('creditlimit',event);" class="text_purchase3"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>

  
  <br/>   
              
            
  
</form>        

</fieldset>    

<fieldset>               
            
    <legend><div class="text_forheader">Invoice Details</div></legend>
  <table width="100%" border="0">
      
      
      <tr>
        <td colspan="5"><div class="CSSTableGenerator" id="inv_details" >
          <div class="CSSTableGenerator" id="itemdetails" >
            <table width="80%">
              <tr>
                <td width="10%"   background="" ><font color="#FFFFFF">Date</font></td>
                <td width="20%"  background=""><font color="#FFFFFF">Invoice No</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">DA No</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Value</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Paid</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Overdue</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Chq Pay</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Chq Balance</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Cash Pay</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">Inv Balance</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">GPAY</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">VAT</font></td>
                <td width="10%"  background=""><font color="#FFFFFF">NBT</font></td>
              </tr>
            </table>
            </div>
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="hidden"  class="label_purchase" value="Selected Invoice Amount" disabled="disabled"/></td>
        <td><input type="hidden" size="20" name="txtpaytot" id="txtpaytot" value="" disabled="disabled" class="text_purchase3"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="17%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="21%">&nbsp;</td>
        <td width="17%"><input type="hidden"  class="label_purchase" value="Over Payment" disabled="disabled"/></td>
        <td width="17%"><input type="hidden" size="20" name="txtoverpay" id="txtoverpay" value="" disabled="disabled" class="text_purchase3"/></td>
        <td width="11%">&nbsp;</td>
        <td width="1%">&nbsp;</td>
      </tr>
</table>
</form>        

</fieldset>    
            
            <table width="765" border="0" cellpadding="0">
<tr>
                	<th height="189" colspan="5" align="left" nowrap="nowrap">
              			<div align="left">

