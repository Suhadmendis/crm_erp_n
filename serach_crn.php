<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="admin_min.css" rel="stylesheet" type="text/css" media="screen" />



<title>Search Customer</title>
<link rel="stylesheet" href="css/table_min.css" type="text/css"/>	
<script language="JavaScript" src="js/crn.js"></script>
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

 <table width="735" border="0">
 
<tr>					
						<?php 
                                                        $stname = "";
                                                        if (isset($_GET["stname"])) {
                                                            $stname = $_GET["stname"];
                                                        }
					?>
                             <td width="122"  background="" ><input type="text" size="20" name="invno" id="invno" value="" class="txtbox"  onkeyup="<?php echo "update_list('$stname')"; ?>"/></td>
      <td width="603"  background="" ><input type="text" size="70" name="customername" id="customername" value="" class="txtbox" onkeyup="<?php echo "update_list('$stname')"; ?>"/></td>
      <td width="603"  background="" ><input type="text" size="29" name="invdate" id="invdate" value="" class="txtbox"/></td>
                             
   </tr>  </table>    
                <div class="CSSTableGenerator" id="filt_table">  <table width="735" border="0" class=\"form-matrix-table\">
                            <tr>
                              <td width="121"  background="" ><font color="#FFFFFF">CRN No</font></td>
                              <td width="424"  background=""><font color="#FFFFFF">Customer</font></td>
                              <td width="176"  background=""><font color="#FFFFFF">CRN Date</font></td>
   </tr>
                            <?php                       
                            

							
							require_once("config.inc.php");
							require_once("DBConnector.php");
							$db = new DBConnector();
							
                                                        $sql = "SELECT * FROM cred where";
                                                        
                                                        if($stname == ""){
                                                            $sql .= " type = '0'";
                                                        }else{
                                                            $sql .= " type = '1'";
                                                        }
                                                        
							if ($_SESSION['COMCODE'] != "C"){
                                                            $sql .= " and company = '".$_SESSION['COMCODE']."'";
                                                        }
                                                        
                                                        $sql .=  " order by C_DATE desc limit 50";
							$result =$db->RunQuery($sql);
							while($row = mysql_fetch_array(
                                                                
                                                        $result)){
					
							echo "<tr>               
                              <td onclick=\"crnno('".$row['C_REFNO']."');\">".$row['C_REFNO']."</a></td>";
							    
								$sql1="SELECT * FROM vendor where CODE='".$row["C_CODE"]."'";
								$result1 =$db->RunQuery($sql1);
								if($row1 = mysql_fetch_array($result1)){
							  		echo "<td onclick=\"crnno('".$row['C_REFNO']."');\">".$row1["NAME"]."</a></td>";
								}	
                              echo "<td onclick=\"crnno('".$row['C_REFNO']."');\">".$row['C_DATE']."</a></td>
                              
                            </tr>";
							}
							  ?>
                    </table>
                    
                    </div>

</body>
</html>
