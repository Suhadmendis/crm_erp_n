<?php  session_start();


include_once("connection.php");

if ($_GET["Command"]=="set_sales_month12"){
	
	//$_GET["month1"];
}


if ($_GET["Command"]=="search_item"){

	if(isset($_GET['item_name']) or isset($_GET['itemno'])){
		
//	$res = mysql_query("SELECT * FROM mast_family where name like '".$letters."%'") or die(mysql_error());
	
	//$res = mysql_query("SELECT distinct trn_involved.str_name FROM trn_involved where str_name like '".$letters."%'") or die(mysql_error());
		
	
	//SELECT * FROM occupation_details where str_first_name like 'k%'
//echo $res;
	
		$ResponseXML .= "";
		//$ResponseXML .= "<invdetails>";
			
	
	
		$ResponseXML .= "<table width=\"735\" border=\"0\" class=\"form-matrix-table\">
                            <tr>
                              <td width=\"121\"  background=\"images/headingbg.gif\" ><font color=\"#FFFFFF\"><b>Item Code</b></font></td>
                              <td width=\"424\"  background=\"images/headingbg.gif\"><font color=\"#FFFFFF\"><b>Item Description</b></font></td>
                              <td width=\"176\"  background=\"images/headingbg.gif\"><font color=\"#FFFFFF\"><b>Genuine No</b></font></td>
							  <td width=\"176\"  background=\"images/headingbg.gif\"><font color=\"#FFFFFF\"><b>Part No</b></font></td>
							  <td width=\"176\"  background=\"images/headingbg.gif\"><font color=\"#FFFFFF\"><b>Model</b></font></td>
							  <td width=\"176\"  background=\"images/headingbg.gif\"><font color=\"#FFFFFF\"><b>QTY in Hand</b></font></td>
   							</tr>";
                           
						   if ($_GET["mstatus"]=="name"){
						   		$letters = $_GET['item_name'];
								//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
								$tmp="select STK_NO,DESCRIPT,GEN_NO,PART_NO,BRAND_NAME from s_mas where DESCRIPT like  '$letters%'";
								$sql = mysql_query("select * from s_mas where DESCRIPT like  '$letters%'") or die(mysql_error());
							} else if ($_GET["mstatus"]=="itemno"){
								$letters = $_GET['itemno'];
								//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
								$tmp="select STK_NO,DESCRIPT,GEN_NO,PART_NO,BRAND_NAME from s_mas where STK_NO like  '$letters%'";
								$sql = mysql_query("select * from s_mas where STK_NO like  '$letters%'") or die(mysql_error());
							}  else if ($_GET["mstatus"]=="model"){
								$letters = $_GET['model'];
								//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
								$tmp="select STK_NO,DESCRIPT,GEN_NO,PART_NO,BRAND_NAME from s_mas where STK_NO like  '$letters%'";
								$sql = mysql_query("select * from s_mas where BRAND_NAME like  '$letters%'") or die(mysql_error());
							} else {
								
								$letters = $_GET['item_name'];
								//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
								$tmp="select STK_NO,DESCRIPT,GEN_NO,PART_NO,BRAND_NAME from s_mas where DESCRIPT like  '$letters%'";
								$sql = mysql_query("select * from s_mas where DESCRIPT like  '$letters%'") or die(mysql_error());
							}
							
							
							
							while($row = mysql_fetch_array($sql)){
					
							$ResponseXML .= "<tr>
                              <td onclick=\"itemno('".$row['STK_NO']."');\">".$row['STK_NO']."</a></td>
                              <td onclick=\"itemno('".$row['STK_NO']."');\">".$row['DESCRIPT']."</a></td>
                              <td onclick=\"itemno('".$row['STK_NO']."');\">".$row['GEN_NO']."</a></td>
							  <td onclick=\"itemno('".$row['STK_NO']."');\">".$row['PART_NO']."</a></td>
							  <td onclick=\"itemno('".$row['STK_NO']."');\">".$row['BRAND_NAME']."</a></td>
                              	<td onclick=\"itemno('".$row['STK_NO']."');\">".$row['QTYINHAND']."</a></td>
                            </tr>";
							}
							  
                    $ResponseXML .= "   </table>";
		
										
					echo $ResponseXML;
	}
}


if ($_GET["Command"]=="pass_invno"){
	header('Content-Type: text/xml'); 
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
			
			$ResponseXML = "";
			$ResponseXML .= "<salesdetails>";
			
					
				$sql = mysql_query("select * from s_rawmas where stk_no = '".trim($_GET["itno"])."'") or die(mysql_error());
				// echo "select * from s_mas where stk_no = '".trim($_GET["itno"])."'";
				if($row = mysql_fetch_array($sql)){
                                        
                                        $stname = "";
                                        if (isset($_GET["stname"])){
                                            $stname = $_GET["stname"];
                                        }
                                        
				
					$ResponseXML .= "<STK_NO><![CDATA[".$row['STK_NO']."]]></STK_NO>";
					$ResponseXML .= "<BRAND_NAME><![CDATA[".trim($row['BRAND_NAME'])."]]></BRAND_NAME>";
					$ResponseXML .= "<DESCRIPT><![CDATA[".$row['DESCRIPT']."]]></DESCRIPT>";
					$ResponseXML .= "<GEN_NO><![CDATA[".$row['GEN_NO']."]]></GEN_NO>";
					$ResponseXML .= "<PART_NO><![CDATA[".$row['PART_NO']."]]></PART_NO>";
					$ResponseXML .= "<cost><![CDATA[".$row['COST']."]]></cost>";
					$ResponseXML .= "<stk_no><![CDATA[".$row['stk_no']."]]></stk_no>";
					$ResponseXML .= "<LOCATE_1><![CDATA[".$row['LOCATE_1']."]]></LOCATE_1>";
					$ResponseXML .= "<LOCATE_2><![CDATA[".$row['LOCATE_2']."]]></LOCATE_2>";
					$ResponseXML .= "<LOCATE_3><![CDATA[".$row['LOCATE_3']."]]></LOCATE_3>";
					$ResponseXML .= "<LOCATE_4><![CDATA[".$row['LOCATE_4']."]]></LOCATE_4>";
					$ResponseXML .= "<MARGIN><![CDATA[".$row['MARGIN']."]]></MARGIN>";
					$ResponseXML .= "<model><![CDATA[".$row['model']."]]></model>";
					$ResponseXML .= "<SELLING><![CDATA[".$row['SELLING']."]]></SELLING>";
					$ResponseXML .= "<ar_selling><![CDATA[".$row['AR_selling']."]]></ar_selling>";
					$ResponseXML .= "<cat1><![CDATA[".trim($row['Cat1'])."]]></cat1>";
					$ResponseXML .= "<type><![CDATA[".trim($row['type'])."]]></type>";
					$ResponseXML .= "<GROUP1><![CDATA[".$row['GROUP1']."]]></GROUP1>";
					$ResponseXML .= "<GROUP2><![CDATA[".$row['GROUP2']."]]></GROUP2>";
					$ResponseXML .= "<GROUP3><![CDATA[".$row['GROUP3']."]]></GROUP3>";
					$ResponseXML .= "<GROUP4><![CDATA[".$row['GROUP4']."]]></GROUP4>";
					$ResponseXML .= "<UNIT><![CDATA[".$row['UNIT']."]]></UNIT>";
					$ResponseXML .= "<SIZE><![CDATA[".$row['SIZE']."]]></SIZE>";
					$ResponseXML .= "<RE_O_qty><![CDATA[".$row['RE_O_qty']."]]></RE_O_qty>";
					$ResponseXML .= "<RE_O_LEVEL><![CDATA[".$row['RE_O_LEVEL']."]]></RE_O_LEVEL>";
					$ResponseXML .= "<cus_ord><![CDATA[".$row['cus_ord']."]]></cus_ord>";
					$ResponseXML .= "<delivered><![CDATA[".$row['delivered']."]]></delivered>";
					$ResponseXML .= "<weight><![CDATA[".$row['weight']."]]></weight>";
					$ResponseXML .= "<unit><![CDATA[".$row['UNIT']."]]></unit>";
					$ResponseXML .= "<size><![CDATA[".$row['SIZE']."]]></size>";
					$ResponseXML .= "<RE_O_LEVEL><![CDATA[".$row['RE_O_LEVEL']."]]></RE_O_LEVEL>";
					$ResponseXML .= "<RE_O_QTY><![CDATA[".$row['RE_O_QTY']."]]></RE_O_QTY>";
					$ResponseXML .= "<country><![CDATA[".$row['SUBSTITUTE']."]]></country>";
					$ResponseXML .= "<jobno><![CDATA[".$row['jobno']."]]></jobno>";
					$ResponseXML .= "<comno><![CDATA[".$row['comno']."]]></comno>";
					$ResponseXML .= "<NSD><![CDATA[".$row['NSD']."]]></NSD>";
					$ResponseXML .= "<stname><![CDATA[".$stname."]]></stname>";
					$ResponseXML .= "<qtyinhand><![CDATA[".$row['QTYINHAND']."]]></qtyinhand>";
                    $ResponseXML .= "<tmpno><![CDATA[" . $row["tmp_no"] . "]]></tmpno>";




 	// 	$sqlLCODE="Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['ILC_1'] . "'";
  //       $result =$db->RunQuery($sqlLCODE);
		// $rowL = mysql_fetch_array($result);
        
					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumptionACMIN'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
 						$ResponseXML .= "<ILC_1><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_1>";
 						$ResponseXML .= "<ILN_1><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_1>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumptionReturnACMIN'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_2><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_2>";
 						$ResponseXML .= "<ILN_2><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_2>";

						


					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumption_ReturnACMI'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}
						$ResponseXML .= "<ILC_3><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_3>";
 						$ResponseXML .= "<ILN_3><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_3>";


					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumption'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_4><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_4>";
 						$ResponseXML .= "<ILN_4><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_4>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['SalesTurnoverAC'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
					$ResponseXML .= "<ILC_5><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_5>";
 						$ResponseXML .= "<ILN_5><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_5>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['SalesReturnTurnoverReturnAc'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
					$ResponseXML .= "<ILC_6><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_6>";
 						$ResponseXML .= "<ILN_6><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_6>";

						


					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['DisAcc'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}
 						$ResponseXML .= "<ILC_7><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_7>";
 						$ResponseXML .= "<ILN_7><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_7>";
					

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MaterialIssueWIPMIN'] . "'") or die(mysql_error());	
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
					$ResponseXML .= "<ILC_8><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_8>";
 						$ResponseXML .= "<ILN_8><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_8>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MaterialIssueWIPIS'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_9><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_9>";
 						$ResponseXML .= "<ILN_9><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_9>";

						


					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumptionIS'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_10><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_10>";
 						$ResponseXML .= "<ILN_10><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_10>";

						


					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MINGIIssueReturnDirec'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_11><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_11>";
 						$ResponseXML .= "<ILN_11><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_11>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['RMConsumptionReturnIS'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_12><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_12>";
 						$ResponseXML .= "<ILN_12><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_12>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['StockInHandAccoun'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_13><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_13>";
 						$ResponseXML .= "<ILN_13><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_13>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MINGeneralIssueAccountNorma'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_14><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_14>";
 						$ResponseXML .= "<ILN_14><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_14>";
					

											$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MINGeneralIssueReturnAccountNorma'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 						
					}
						$ResponseXML .= "<ILC_15><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_15>";
 						$ResponseXML .= "<ILN_15><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_15>";

						

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MINGeneralIssueDirect'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_16><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_16>";
 						$ResponseXML .= "<ILN_16><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_16>";
					

					$sqlL = mysql_query("Select C_CODE,C_NAME from lcodes where C_CODE = '" . $row['MINGeneralIssueReturnDirec'] . "'") or die(mysql_error());
					if($rowL = mysql_fetch_array($sqlL)){
 					}	
					
						$ResponseXML .= "<ILC_17><![CDATA[" . $rowL['C_CODE'] . "]]></ILC_17>";
 						$ResponseXML .= "<ILN_17><![CDATA[" . $rowL['C_NAME'] . "]]></ILN_17>";

						




					
					$sql1 = mysql_query("select * from userpermission where username = '".$_SESSION["CURRENT_USER"]."' and docid=43") or die(mysql_error());
					$row1 = mysql_fetch_array($sql1);
					$ResponseXML .= "<price_edit><![CDATA[".$row1["price_edit"]."]]></price_edit>";
						
				}				
			
				
				$ResponseXML .= "</salesdetails>";	
				echo $ResponseXML;
				
				
	
}	
?>
