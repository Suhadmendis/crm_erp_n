<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="admin_min.css" rel="stylesheet" type="text/css" media="screen" />



        <title>Search Customer</title>
        <link rel="stylesheet" href="css/table_min.css" type="text/css"/>
        <script language="JavaScript" src="js/inv.js"></script>
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
                <td  background="" >&nbsp;</td>
                <td  background="" >
                    <?php
                    if ($_GET["stname"] == "un_delivered") {
                        $_SESSION["brand"] = null;
                    }

                    if ($_GET["stname"] == "ord_item") {
                        echo "<input type=\"checkbox\" name=\"checkbox\" id=\"checkbox\" onclick=\"update_item_list_ord();\" />";
                    } else {
                        echo "<input type=\"checkbox\" name=\"checkbox\" id=\"checkbox\" onclick=\"update_item_list();\" />";
                    }
                    ?>	
                    Stock Item Only</td><td><input type="checkbox" name="chkProblem" id="chkProblem" onclick="update_item_list();"/> With Problematic</td>
                <tr>
                    <td><input type="text"  class="label_purchase" value="Item Code" disabled="disabled"/></td>
                    <td><input type="text"  class="label_purchase" value="Item Description" disabled="disabled"/></td>
                    <td><input type="text"  class="label_purchase" value="Brand" disabled="disabled"/></td>
                    <td><input type="text"  class="label_purchase" value="Part No" disabled="disabled"/></td>
                    <tr>
                        <?php
                        if (($_GET["stname"] == "")||($_GET["stname"] == "itm_mast")) {
                            $stname = $_GET["stname"];
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list('$stname');\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list('$stname');\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"brand\" id=\"brand\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list('$stname');\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"10\" name=\"jobno\" id=\"jobno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list('$stname');\"/></td>";
                        } else if ($_GET["stname"] == "pur_ord") {
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_pur_ord();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_pur_ord();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"brand\" id=\"brand\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_pur_ord();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"10\" name=\"jobno\" id=\"jobno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_pur_ord();\"/></td>";
                        } else if ($_GET["stname"] == "grn_item") {
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_grn();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_grn();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"brand\" id=\"brand\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_grn();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"10\" name=\"jobno\" id=\"jobno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_grn();\"/></td>";
                        } else if ($_GET["stname"] == "bin_card") {
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_bin();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_bin();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"brand\" id=\"brand\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_bin();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"10\" name=\"jobno\" id=\"jobno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_bin();\"/></td>";
                        } else if ($_GET["stname"] == "claim_item") {
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_claim();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_claim();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"brand\" id=\"brand\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_claim();\"/></td>
	  <td width=\"122\"  background=\"\" ><input type=\"text\" size=\"10\" name=\"jobno\" id=\"jobno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list_claim();\"/></td>";
                        }else if ($_GET["stname"] == "itm_mast"){
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list();\"/></td>";
                        } else {
                            echo "<td width=\"122\"  background=\"\" ><input type=\"text\" size=\"20\" name=\"itno\" id=\"itno\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list();\"/></td>
      <td width=\"603\"  background=\"\" ><input type=\"text\" size=\"70\" name=\"itemname\" id=\"itemname\" value=\"\" class=\"txtbox\" onkeyup=\"update_item_list();\"/></td>";
                        }
                        ?>  
                        </table>    
                        <div id="filt_table" class="CSSTableGenerator">  <table width="735" border="0" class=\"form-matrix-table\">
                                <tr>
                                    <td width="121"  background="" ><strong><font color="#FFFFFF">Item No</font></strong></td>
                                    <td width="424"  background=""><strong><font color="#FFFFFF">Item Description</font></strong></td>
                                    <td width="200"  background=""><strong><font color="#FFFFFF">Brand</font></strong></td>
                                    <td width="100"  background=""><strong><font color="#FFFFFF">Gen No</font></strong></td>
                                    <td width="80"  background=""><strong><font color="#FFFFFF">Substitute</font></strong></td>
                                    <td width="100"  background=""><strong><font color="#FFFFFF">Selling</font></strong></td>
                                    <td width="100"  background=""><strong><font color="#FFFFFF">Part No</font></strong></td>
                                    <td width="100"  background=""><strong><font color="#FFFFFF">Stock In Hand</font></strong></td>
                                </tr>
                                <?php
                                require_once("config.inc.php");
                                require_once("DBConnector.php");
                                $db = new DBConnector();


                                $_SESSION["stname"] = $_GET["stname"];

                                if ($_GET["stname"] == "un_delivered") {

                                    $sql = "SELECT * from s_mas where QTYINHAND>0 order by STK_NO limit 50";

                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_undeliver('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['STK_NO'] . "</a></td>
                              <td onclick=\"itno_undeliver('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['DESCRIPT'] . "</a></td>
							  <td onclick=\"itno_undeliver('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['QTYINHAND'] . "</a></td>";


                                        echo "</tr>";
                                    }
                                }


                                if ($_GET["stname"] == "defective_item") {

                                    $sql = "SELECT * from s_mas where QTYINHAND>0 order by STK_NO limit 50";

                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_defect('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['STK_NO'] . "</a></td>
                              <td onclick=\"itno_defect('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['DESCRIPT'] . "</a></td>
							  <td onclick=\"itno_defect('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['QTYINHAND'] . "</a></td>";


                                        echo "</tr>";
                                    }
                                }if ($_GET["stname"] == "weekly_order") {

                                    if (isset($_SESSION["brand"]) == true) {
                                        $sql = "SELECT * from s_mas where BRAND_NAME='" . $_SESSION["brand"] . "' order by STK_NO limit 50";
                                    } else {
                                        $sql = "SELECT * from s_mas order by STK_NO";
                                    }

                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_weekly('" . $row['STK_NO'] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_weekly('" . $row['STK_NO'] . "');\">" . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno_weekly('" . $row['STK_NO'] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno_weekly('" . $row['STK_NO'] . "');\">" . $row['QTYINHAND'] . "</td>";


                                        echo "</tr>";
                                    }
                                } else if ($_GET["stname"] == "quot") {

                                    //echo "Brand :".$_SESSION["brand"];

                                    if (isset($_SESSION["brand"]) == true) {
                                        $sql = "SELECT * from s_mas where BRAND_NAME='" . $_SESSION["brand"] . "' order by STK_NO limit 50";
                                    } else {
                                        $sql = "SELECT * from s_mas order by STK_NO";
                                    }

                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_quot('" . $row['STK_NO'] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_quot('" . $row['STK_NO'] . "');\">" . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno_quot('" . $row['STK_NO'] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno_quot('" . $row['STK_NO'] . "');\">" . $row['QTYINHAND'] . "</td>";
                                        echo "</tr>";
                                    }
                                    $department = $_SESSION["department"];

                                    /*  $sql1="select QTYINHAND from s_submas where STK_NO='".$row['STK_NO']."' AND STO_CODE='".$department."'";

                                      $result1 =$db->RunQuery($sql1);
                                      if($row1 = mysql_fetch_array($result1)){
                                      echo "<td onclick=\"itno('".$row['STK_NO']."');\">".$row1['QTYINHAND']."</a></td>";
                                      } else {
                                      echo "<td onclick=\"itno('".$row['STK_NO']."');\">0</a></td>";
                                      }
                                     */
                                } else if ($_GET["stname"] == "grn_item") {

                                    $sql = "SELECT * from s_mas order by STK_NO limit 50";
                                    //}

                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['GEN_NO'] . "</td>
							   <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['SUBSTITUTE'] . "</td>
							   <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
							   <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=left>" . $row['PART_NO'] . "</td>
							   <td onclick=\"itno_grn('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";
                                    }
                                } else if ($_GET["stname"] == "pur_ord") {

                                    $sql = "SELECT * from s_mas order by STK_NO limit 50";
                                    $result = $db->RunQuery($sql);
                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\">" . $row['GEN_NO'] . "</td>
							   <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\">" . $row['SUBSTITUTE'] . "</td>
							   <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
							   <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\" align=left>" . $row['PART_NO'] . "</td>
							   <td onclick=\"itno_purord('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";

                                        $department = $_SESSION["department"];
                                    }

                                    echo "</tr>";
                                } else if ($_GET["stname"] == "bin_card") {

                                    $sql = "SELECT * from s_mas order by STK_NO limit 50";
                                    $result = $db->RunQuery($sql);
                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\">" . $row['GEN_NO'] . "</td>
							   <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\">" . $row['SUBSTITUTE'] . "</td>
							   <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
							   <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\" align=left>" . $row['PART_NO'] . "</td>
							   <td onclick=\"itno_bin('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";

                                        $department = $_SESSION["department"];
                                    }

                                    echo "</tr>";
                                } else if ($_GET["stname"] == "claim_item") {

                                    $sql = "SELECT * from s_mas order by STK_NO limit 50";
                                    $result = $db->RunQuery($sql);
                                    while ($row = mysql_fetch_array($result)) {

                                        echo "<tr>               
                              <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
                              <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\">" . $row['BRAND_NAME'] . "</td>
                              <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\">" . $row['GEN_NO'] . "</td>
                               <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\">" . $row['SUBSTITUTE'] . "</td>
                               <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
                               <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\" align=left>" . $row['PART_NO'] . "</td>
                               <td onclick=\"itno_claim('" . $row['STK_NO'] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";

                                        $department = $_SESSION["department"];
                                    }

                                    echo "</tr>";
                                } else if ($_GET["stname"] == "itm_mast") {

                                    $sql = "SELECT * from s_rawmas order by STK_NO";
                                 
                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                            $brName = $row['BRAND_NAME'];
                                            $problemBrands = ($brName == 'Dag Customer' || $brName == 'Dag Custormer' || $brName == 'Dag CustomeDag Customerr' || $brName == 'Dag Sale' || $brName == 'Rebuild Customer' || $brName == 'rebuild sale');

                                        if (!($problemBrands && ($row['QTYINHAND'] == '0'))) {
                                            echo "<tr>               
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['BRAND_NAME'] . "</td>
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['GEN_NO'] . "</td>
                               <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['SUBSTITUTE'] . "</td>
                               <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
                               <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=left>" . $row['PART_NO'] . "</td>
                               <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";

                                            $department = $_SESSION["department"];

                                            /*  $sql1="select QTYINHAND from s_submas where STK_NO='".$row['STK_NO']."' AND STO_CODE='".$department."'";

                                              $result1 =$db->RunQuery($sql1);
                                              if($row1 = mysql_fetch_array($result1)){
                                              echo "<td onclick=\"itno('".$row['STK_NO']."');\">".$row1['QTYINHAND']."</a></td>";
                                              } else {
                                              echo "<td onclick=\"itno('".$row['STK_NO']."');\">0</a></td>";
                                              }
                                             */
                                        }
                                    }

                                    echo "</tr>";
                                } else {


                                    //echo "Brand :".$_SESSION["brand"];
                                    //if (isset($_SESSION["brand"])==true){
                                    //	$sql="SELECT * from s_mas where BRAND_NAME='".$_SESSION["brand"]."' order by STK_NO limit 50";
                                    //} else {
                                    $sql = "SELECT * from s_mas order by STK_NO limit 50";
                                    //}
									//echo $sql;
                                    $result = $db->RunQuery($sql);

                                    while ($row = mysql_fetch_array($result)) {

                                            $brName = $row['BRAND_NAME'];
                                            $problemBrands = ($brName == 'Dag Customer' || $brName == 'Dag Custormer' || $brName == 'Dag CustomeDag Customerr' || $brName == 'Dag Sale' || $brName == 'Rebuild Customer' || $brName == 'rebuild sale');

                                        if (!($problemBrands && ($row['QTYINHAND'] == '0'))) {
                                            echo "<tr>               
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['STK_NO'] . "</td>
                              <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['PART_NO'] . " " . $row['DESCRIPT'] . "</td>
							  <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['BRAND_NAME'] . "</td>
							  <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['GEN_NO'] . "</td>
							   <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\">" . $row['SUBSTITUTE'] . "</td>
							   <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['SELLING'], 2, ".", ",") . "</td>
							   <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=left>" . $row['PART_NO'] . "</td>
							   <td onclick=\"itno('" . $row['STK_NO'] . "', '" . $_GET["stname"] . "');\" align=right>" . number_format($row['QTYINHAND'], 2, ".", "") . "</td>";

                                            $department = $_SESSION["department"];

                                            /*  $sql1="select QTYINHAND from s_submas where STK_NO='".$row['STK_NO']."' AND STO_CODE='".$department."'";

                                              $result1 =$db->RunQuery($sql1);
                                              if($row1 = mysql_fetch_array($result1)){
                                              echo "<td onclick=\"itno('".$row['STK_NO']."');\">".$row1['QTYINHAND']."</a></td>";
                                              } else {
                                              echo "<td onclick=\"itno('".$row['STK_NO']."');\">0</a></td>";
                                              }
                                             */
                                        }
                                    }

                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>

                        </body>
                        </html>
