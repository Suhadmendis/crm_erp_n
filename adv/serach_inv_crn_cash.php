<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="admin_min.css" rel="stylesheet" type="text/css" media="screen" />



<title>Search Customer</title>

<script language="JavaScript" src="js/cash_credit_note_form.js"></script>
<link rel="stylesheet" href="css/table_min.css" type="text/css"/>
<style type="text/css">

	/* START CSS NEEDED ONLY IN DEMO */
	html{
		height:100%;
	}
	
	
	#mainContainer{
		width:700px;
		margin:0 auto;
		text-align:left;
		height:100%;
		background-color:#FFF;
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
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
    </style>
	

</head>

<body>
<?php

require_once("config.inc.php");
							require_once("DBConnector.php");
							$db = new DBConnector();
							
							?>
 <table width="735" border="0">
 <tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
 </tr>
 <tr><td><select name="brand" id="brand" onkeypress="keyset('searchitem',event);" class="text_purchase3"  onchange="setord();">
   <?php
																	$sql="select * from brand_mas order by barnd_name";
																	$result =$db->RunQuery($sql);
																	while($row = mysql_fetch_array($result)){
                        												echo "<option value='".$row["barnd_name"]."'>".$row["barnd_name"]."</option>";
                       												}
																?>
 </select></td><td>&nbsp;</td><td>&nbsp;</td></tr>
 
<tr>					
						<?php 
	  				$stname = $_GET["stname"];
					?>
                             <td width="122"  background="" ><input type="text" size="20" name="invno" id="invno" value="" class="txtbox"  onkeyup="<?php echo "update_list('$stname')"; ?>"/></td>
      <td width="603"  background="" ><input type="text" size="70" name="customername" id="customername" value="" class="txtbox" onkeyup="<?php echo "update_list('$stname')"; ?>"/></td>
      <td width="603"  background="" ><input type="text" size="29" name="invdate" id="invdate" value="" class="txtbox"/></td>
   </tr>  </table>   
<div class="CSSTableGenerator"  > 
                <div id="filt_table">  <table width="735" border="0" class=\"form-matrix-table\">
                            <tr>
                              <td width="121"  background="" ><font color="#FFFFFF">Invoice No</font></td>
                              <td width="424"  background=""><font color="#FFFFFF">Amount</font></td>
                              <td width="176"  background=""><font color="#FFFFFF">Balance</font></td>
   </tr>
                            <?php 
							
							$_SESSION["check"]="new";
							
							//if ($_GET["stname"]=="crn"){
						
						if ($_SESSION["MonthView1"]!=""){	
								$year=substr($_SESSION["MonthView1"], 0, 4);
								$month=substr($_SESSION["MonthView1"], 5, 2);
								
								$sql="select REF_NO , SDATE, GRAND_TOT, TOTPAY  from s_salma where Accname != 'NON STOCK' and CANCELL='0' and C_CODE='" . $_SESSION["suppno"] . "' and year(SDATE)='".$year."' and month(SDATE)='".$month."' ORDER BY SDATE desc limit 120";
								//echo $sql;
								//$sql = "select REF_NO , SDATE, GRAND_TOT  from s_salma where Accname='OFFICE' and CANCELL='0'and C_CODE='" . $_SESSION["crn_form_supplierno"] . "' and year(SDATE)='".$year."' and month(SDATE)='".$month."'   ORDER BY SDATE desc limit 50";
							//}
								
							//echo $sql;
							$result =$db->RunQuery($sql);
							while($row = mysql_fetch_array($result)){
							
							echo "<tr>               
                              <td onclick=\"invno1('".$row['REF_NO']."', '".$_GET['stname']."');\">".$row['REF_NO']."</a></td>
                              <td align=\"right\" onclick=\"invno1('".$row['REF_NO']."', '".$_GET['stname']."');\">".number_format($row["GRAND_TOT"], 2, ".", ",")."</a></td>";
							  $balance=$row["GRAND_TOT"]-$row["TOTPAY"];
                              echo "<td align=\"right\" onclick=\"invno1('".$row['REF_NO']."', '".$_GET['stname']."');\">".number_format($balance, 2, ".", ",")."</a></td>
                              
                            </tr>";
							}
						}	
							  ?>
                    </table>
                </div>
      </div>              

</body>
</html>
