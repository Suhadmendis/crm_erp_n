<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
}

.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight:bold;
}
-->
</style>
</head>

<body><center>
<?php 
require_once("config.inc.php");
	require_once("DBConnector.php");
	$db = new DBConnector();
	
	$sql="Select * from s_salma where REF_NO='".$_GET["invno"]."'";
    	$result =$db->RunQuery($sql);	
		$row = mysql_fetch_array($result);			
        
		$sql1="Select * from vendor where CODE='".$row["C_CODE"]."'";
    	$result1 =$db->RunQuery($sql1);	
		$row1 = mysql_fetch_array($result1);	
		
		$sql2="Select * from s_stomas where CODE='".$row["DEPARTMENT"]."'";
    	$result2 =$db->RunQuery($sql2);	
		$row2 = mysql_fetch_array($result2);
				
		$TXTDEP= $row2["DESCRIPTION"];
		$rtxtinvno= $row["invno"];
		$rtxtordno= $row["ORD_NO"]; 
		
		$sql2="Select * from s_salrep where REPCODE='".$row["SAL_EX"]."'";
    	$result2 =$db->RunQuery($sql2);	
		$row2 = mysql_fetch_array($result2);
		
		$rtxtrep = $row2["Name"];
		$rtxtSupCode= $row1["CODE"];
		$rtxtSupName=  $row1["NAME"];
		$txtadd = $row1["ADD1"]." ".$row1["ADD2"];
		$rtxtdate=date("Y-m-d", strtotime($row["SDATE"]));
		$rtxttot = $row["GRAND_TOT"];

		
		
		
    	
		$sql_para="Select * from invpara ";
    	$result_para =$db->RunQuery($sql_para);	
		$row_para = mysql_fetch_array($result_para);

		if ($row["VAT"]=="1") {
    		$txtcusvat= "Customer VAT  " . $row1["vatno"];
    		$txtcomvat= "VAT Reg. " . $row_para["VAT"];
    		$RTXTVAT = "VAT 12%  ";
    		$RTXVATAMU = $row["BTT"];
    		$txttaxinv = "<b>TAX INVOICE</b>";
    		$txtsubtot = $row["AMOUNT"];
    		$txtsubtotdes= "Sub Total";
		}
		
		if ($row["SVAT"]!="0") {
    		$txtcusvat= "Customer VAT  " . $row1["vatno"];
    		$txtcomvat= "VAT Reg. " . $row_para["VAT"];
    		$RTXTVAT = "Suspended VAT 12%  ";
    		$RTXVATAMU= $row["BTT"];
    		$txttaxinv= "<b>SUSPENDED TAX INVOICE</b>";
    		$txtsubtot= $row["AMOUNT"];
    		$txtsubtotdes = "Nett Total";
    
    		$txtoursvat = "SVAT Reg. " . $row_para["svatno"];
    		$txtcussavat= "Customer SVAT " . $row_para["svatno"];
    
		}

	?>
    
<table width="922" height="434" border="0">
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4" align="center"></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="157" align="center">    </td>
    <td colspan="3" align="center"><span class="style2"><?php echo $txttaxinv; ?></span></td>
    <td width="143"><span class="style2">
      <?php
		echo $_GET["invno"];
    	
	?>
    </span></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><span class="style2"><?php echo $txtcomvat; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><span class="style2"><?php echo $txtoursvat; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="90" height="21" align="right"><span class="style2"><?php echo $rtxtSupCode; ?></span></td>
    <td colspan="4"><span class="style2"><?php 
	$txtCNAME=str_replace("~", "&", $_GET['cus_name']);
	echo $txtCNAME; ?></span></td>
    <td width="232"><span class="style2">&nbsp;&nbsp;<?php echo $rtxtordno; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td height="21" colspan="4"><span class="style2"><?php 
	$cus_address=str_replace("~", "&", $_GET['cus_address']);
	echo $cus_address; ?></span></td>
    <td height="21">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td colspan="3"><span class="style2"><?php 
	echo $txtcusvat;
	
	 ?></span></td>
    <td><span class="style2">&nbsp;&nbsp;<?php echo $rtxtrep; ?></span></td>
    <td><span class="style2"><?php echo $rtxtdate; ?></span></td>
  </tr>
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td colspan="3"><span class="style2"><?php echo $txtcussavat; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td colspan="2"></td>
    <td width="177">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="56" colspan="7"><table width="904" height="81" border="0" cellspacing="0">
    <!--  <tr  bgcolor="#999999">
        <td width="130" height="23"><span class="style1">STK No</span></td>
        <td width="295"><span class="style1">Description</span></td>
        <td width="158"><span class="style1">Rate</span></td>
        <td width="135"><span class="style1">Quantity</span></td>
        <td width="152"><span class="style1">Sub Total</span></td>
        </tr> -->
      <?php 
	  	$i=1;
		$totsuntot=0;
		
	  	$sql1="Select * from s_invo where REF_NO='".$_GET["invno"]."'";
    	$result1 =$db->RunQuery($sql1);	
		while ($row1 = mysql_fetch_array($result1)){
			$sql_part="Select * from s_mas where STK_NO='".$row1["STK_NO"]."'";
    		$result_part =$db->RunQuery($sql_part);	
			$row_part = mysql_fetch_array($result_part);
			
			if ($row1["ad"]=="1"){
				echo "<tr><td width=50><span class=\"style3\">".$row1["STK_NO"]."</span></td>
				<td width=400><span class=\"style3\">&nbsp;&nbsp;".$row1["DESCRIPT"]."</span></td>
				<td width=150><span class=\"style3\">".$row_part["PART_NO"]."</span></td>
				<td width=80 align=\"right\"><span class=\"style3\">".number_format($row1["PRICE"], 2, ".", ",")."</span></td>
				<td width=50 align=\"right\"><span class=\"style3\">".number_format($row1["QTY"], 0, ".", ",")."</span></td>
				<td width=70 align=\"right\"><span class=\"style3\">".floatval($row["DIS"])."</span></td>";
				$discount1=$row1["PRICE"]*$row1["QTY"]*$row["DIS"]/100;
				$subtot=($row1["PRICE"]*$row1["QTY"])-$discount1;
			echo "<td width=100 align=\"right\"><span class=\"style3\">".number_format($subtot, 2, ".", ",")."</span></td>
			<td align=\"right\"><span class=\"style3\">AD</span></tr>";
			
			} else {
				echo "<tr><td width=50><span class=\"style2\">".$row1["STK_NO"]."</span></td>
				<td width=400><span class=\"style2\">&nbsp;&nbsp;".$row1["DESCRIPT"]."</span></td>
				<td width=150><span class=\"style2\">".$row_part["PART_NO"]."</span></td>
				<td width=80 align=\"right\"><span class=\"style2\">".number_format($row1["PRICE"], 2, ".", ",")."</span></td>
				<td width=50 align=\"right\"><span class=\"style2\">".number_format($row1["QTY"], 0, ".", ",")."</span></td>
				<td width=70 align=\"right\"><span class=\"style2\">".floatval($row["DIS"])."</span></td>";
				$discount1=$row1["PRICE"]*$row1["QTY"]*$row["DIS"]/100;
				$subtot=($row1["PRICE"]*$row1["QTY"])-$discount1;
				echo "<td width=100 align=\"right\"><span class=\"style2\">".number_format($subtot, 2, ".", ",")."</span></td>
				<td align=\"right\"><span class=\"style3\"></span></tr>";
			}
			$totsuntot=$totsuntot+$subtot;
			$i=$i+1;
		}	
	  
	  	if ($row["DIS1"] > 0) {
    		$txtspdis= "Special Discount   " . floatval($row["DIS1"]) . " %";
   		}
       
    //	if ($row["VAT"]=="0") {
        	$txtdis2= $totsuntot/100 * $row["DIS1"];
    	//} else {
       // 	$txtdis2= (($totsuntot / (1 + $row["GST"] / 100)) / 100) * $row["DIS1"];
    	//}
		
	  	while ($i<18){
			echo "<tr><td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td></tr>";
			$i=$i+1;
		}
	   ?>
      
     
    </table></td>
  </tr>
  <tr><td colspan="7" valign="top">
  	<table width="900" border="0">
    	
    	<tr>
    	<td colspan="2">&nbsp;</td>
    	<td width="122">&nbsp;</td>
   	 	<td colspan="2">&nbsp;</td>
    	<td width="236"><span class="style2"><?php echo $txtspdis; ?></span></td>
    	<td width="164" align="right"><span class="style2"><?php if ($txtdis2>0){ echo number_format($txtdis2, 2, ".", ",");} ?></span></td>
  		</tr>
  		<tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td><span class="style2"><?php echo $txtsubtotdes; ?></span></td>
    <td align="right"><span class="style2"><?php if ($txtsubtot>0){ echo number_format($txtsubtot, 2, ".", ","); } ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td><span class="style2"><?php echo $RTXTVAT; ?></span></td>
    <td align="right"><span class="style2"><?php if ($RTXVATAMU>0){echo number_format($RTXVATAMU, 2, ".", ",");} ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style2"><?php echo $txtPrePoints; ?></span></td>
    <td><span class="style2"><?php echo $txtInvPoints; ?></span></td>
    <td colspan="2"><span class="style2"><?php echo $txtTotpoints; ?></span></td>
    <td>&nbsp;</td>
    <td align="right"><span class="style2"><?php if ($rtxttot>0){echo number_format($rtxttot, 2, ".", ",");} ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style2"><?php echo $txtentered; ?></span></td>
    <td><span class="style2"><?php echo $txtauth; ?></span></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style2"><?php echo $txtrepono; ?></span></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td></td>
    <td align="right"><span class="style2"><?php echo $TXTDEP; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
