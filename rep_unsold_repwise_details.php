
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
          
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<fieldset>
                                                	<legend>
  <div class="text_forheader">Unsold Stock Report - Rep Wise</div>
                                               	 </legend>             

<form id="form1" name="form1" action="report_unsold_rep_wise.php" target="_blank" method="get">
<table width="767" border="0">
  <tr>
    <td colspan="2" align="left"><table width="274">
      <tr>
        <td width="76" align="left">Brand</td>
        <td width="186"><select name="cmbbrand" id="cmbbrand" onkeypress="keyset('brand',event);" class="text_purchase3">
          <option value='All'>All</option>
          <?php
																	$sql="select * from brand_mas order by barnd_name";
																	$result =$db->RunQuery($sql);
																	while($row = mysql_fetch_array($result)){
                        												echo "<option value='".$row["barnd_name"]."'>".$row["barnd_name"]."</option>";
                       												}
																?>
        </select>
              <select name="cmbtype" id="cmbtype" onchange="setvisible();" class="text_purchase3">
                <option value='All'>All</option>
                <option value='Over'>Over</option>
                <option value='Between'>Between</option>
            </select></td>
      </tr>
    </table></td>
    <td width="160" align="right">Day &gt;</td>
    <td width="234"><div id="over">
      <input type="text" name="txtdays" id="txtdays" value="0" />
    </div></td>
  </tr>
  <tr>
    <td width="136" align="left">Department</td>
    <td width="219" align="left"><select name="com_dep" id="com_dep" onkeypress="keyset('brand',event);" class="text_purchase3">
      <?php
																	$sql="select * from s_stomas order by CODE";
																	$result =$db->RunQuery($sql);
																	while($row = mysql_fetch_array($result)){
                        												echo "<option value='".$row["CODE"]."'>".$row["CODE"]." ".$row["DESCRIPTION"]."</option>";
                       												}
																?>
    </select></td>
    <td align="right">&lt;</td>
    <td><div id="between">
      <input type="text" name="txtbel" id="txtbel" value="0" />
    </div></td>
  </tr>
  <tr>
    <td colspan="4" align="left"><label>
      <input type="radio" name="unsold" value="details" id="unsold_0" checked="checked" />
      Details</label>
        <label>
        <input type="radio" name="unsold" value="summery" id="unsold_1" />
          Summery</label>  
          <input type="radio" name="unsold" value="soldsummery" id="unsold_1" />
          Sold Summery</label>    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><table>
      <tr>
        <td width="60" align="left"></td>
        <td></td>
      </tr>
    </table></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left"></td>
    <td colspan="2"><input type="submit" name="button" id="button" value="View" class="btn_purchase1"/></td>
  </tr>
</table>
<fieldset>               
            
 
</form>        

   
            
          