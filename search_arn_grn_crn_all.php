<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin_min.css" rel="stylesheet" type="text/css" media="screen" />


<title>Search Customer</title>
<link rel="stylesheet" href="css/table_min.css" type="text/css"/>	
<script language="JavaScript" src="js/utilization.js"></script>
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

 <table width="735" border="0" class=\"form-matrix-table\">
 
<tr>
					<?php 
	  				$stname = "";
                                        if (isset($_GET["stname"])) {
                                            $stname = $_GET["stname"];
                                        }
					?>
    <td width="122"  background="" style="visibility:hidden;"><input type="text" size="20" name="cusno" id="cusno" value="" class="txtbox" onkeyup="<?php	echo "update_cust_list('$stname')"; ?>"/></td>
      <td width="603"  background="" style="visibility:hidden;"><input type="text" size="70" name="customername" id="customername" value="" class="txtbox" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
      </table>    
                <div id="filt_table" class="CSSTableGenerator">  <table width="735" border="0" class=\"form-matrix-table\">
                            <tr>
                              <td width="121"  background="" ><font color="#FFFFFF">Ref No</font></td>
                              <td width="424"  background=""><font color="#FFFFFF">Date</font></td>
                              <td width="424"  background=""><font color="#FFFFFF">Balance</font></td>
                              <td width="424"  background=""><font color="#FFFFFF">Sales Ex</font></td>
                             
   </tr>
                            <?php 
							
							require_once("config.inc.php");
							require_once("DBConnector.php");
							$db = new DBConnector();
							
								$phrase = "";
							if(($stname=="adp")){
                                $phrase = "and trn_type = 'AR_ADP'";
                            } 
							if(($stname=="")){
                            	$phrase = "and trn_type!='ARN' and trn_type!='AR_ADP'";
							}

							$sql="select REFNO , SDATE, BALANCE, SAL_EX  from c_bal where Cancell='0' and BALANCE>0 and SDATE>='2011-01-01' $phrase ORDER BY SDATE desc";
							echo $_SESSION["UserName"]." ".$sql;							
							$result =$db->RunQuery($sql);
							while($row = mysql_fetch_array($result)){
								
							echo "<tr>               
                              <td onclick=\"allno('".$row['REFNO']."');\">".$row['REFNO']."</a></td>
                              <td onclick=\"allno('".$row['REFNO']."');\">".$row['SDATE']."</a></td>
							   <td onclick=\"allno('".$row['REFNO']."');\">".$row['BALANCE']."</a></td>
							    <td onclick=\"allno('".$row['REFNO']."');\">".$row['SAL_EX']."</a></td>
                         
                              
                            </tr>";
							}
							  ?>
                    </table>
                </div>

</body>
</html>
