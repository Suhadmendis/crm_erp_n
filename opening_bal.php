<?php

	include('connection1.php');

 	/*$sql= "select * from lcodes";
	$result=mysql_query($sql, $dbacc2);
	while($row = mysql_fetch_array($result)){	
		$sql_up= "update lcodes set c_opbal1='".$row["c_opbal1"]."' where c_code='".$row["c_code"]."'";
		$result_up=mysql_query($sql_up, $dbacc1);
	}
	*/
	$sql_up= "update lcodes set c_opbal1='0' ";
			echo $sql_up;
			$result_up=mysql_query($sql_up, $dbacc1);
			
	$sql= "select * from ledger where l_flag='OPB'";
	$result=mysql_query($sql, $dbacc2);
	while($row = mysql_fetch_array($result)){	
		if ($row["l_flag1"]=="DEB"){
			$sql_up= "update lcodes set c_opbal1='".$row["l_amount"]."'  where c_code='".$row["l_code"]."'";
			echo $sql_up;
			$result_up=mysql_query($sql_up, $dbacc1);
		} else if ($row["l_flag1"]=="CRE"){
			$sql_up= "update lcodes set c_opbal1='".(-1*$row["l_amount"])."'  where c_code='".$row["l_code"]."'";
			echo $sql_up;
			$result_up=mysql_query($sql_up, $dbacc1);
		}	
	}
	
?>
