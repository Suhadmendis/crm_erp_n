<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="admin_min.css" rel="stylesheet" type="text/css" media="screen" />


        <title>Search Customer1</title>
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
                <?php
                $stname = $_GET["stname"];
                    ?>
                    <td width="122"  background="" ><input type="text" size="20" name="cusno" id="cusno" value="" class="txtbox" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
                    <td width="603"  background="" ><input type="text" size="70" name="customername" id="customername" value="" class="txtbox" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td>
        </table>    
        <div id="filt_table" class="CSSTableGenerator">  <table width="735" border="0" class=\"form-matrix-table\">
                <tr>
                    <td width="121"  background="" ><font color="#FFFFFF">Customer No</font></td>
                    <td width="424"  background=""><font color="#FFFFFF">Customer Name</font></td>
                    <td width="424"  background=""><font color="#FFFFFF">Address</font></td>

                </tr>
                <?php
                require_once("config.inc.php");
                require_once("DBConnector.php");
                $db = new DBConnector();


               


                if ($_GET["stname"] == "incentive2") {
                    $sql = "SELECT * from vendor where CAT='Z' order by CODE limit 50";
                } else if ($_GET["stname"] == "incentive") {
                    $sql = "SELECT * from vendor where CAT<>'X' and CAT<>'Z' order by CODE limit 50";
                } else if ($_GET["stname"] == "supplier") {
                    $sql = "select DISTINCT sup_code,SUP_NAME from s_purmas";
                }else if($_GET["stname"] == "setInvoice"){
                    $sql = "SELECT * from vendor where CAT<>'Z' and blacklist !='1' and commoncode = '".$_SESSION["company"]."' and NAME != 'CASH' order by CODE limit 50";
                }else {
                    $sql = "SELECT * from vendor where CAT<>'Z' and commoncode = '".$_SESSION["company"]."' order by CODE limit 50";
                }




//crison deploy
                 if ($_GET["stname"] == "cre_note") {
                    $sql = "SELECT * from vendor";
                }
                 if ($_GET["stname"] == "crn") {
                    $sql = "SELECT * from vendor where CAT = 'C'";
                }

                if ($_GET["stname"] == "cash_rec") {
                    $sql = "SELECT * from vendor where CAT = 'C'";
                }
                 if ($_GET["stname"] == "advance_ar") {
                    $sql = "SELECT * from vendor where CAT = 'C'";
                }
                if ($_GET["stname"] == "utilization") {
                    $sql = "SELECT * from vendor where CAT = 'C'";
                }
                $stname = $_GET["stname"];
//                echo $sql;
                $result = $db->RunQuery($sql);
                if ($stname != "supplier") {
                    while ($row = mysql_fetch_array($result)) {
                        $cuscode = $row["CODE"];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['CODE'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['NAME'] . "</a></td>
                         		<td onclick=\"custno('$cuscode', '$stname');\">" . $row['ADD1'] . "</a></td>
                              
                            </tr>";
                    }
                } else {
                    while ($row = mysql_fetch_array($result)) {
                        $cuscode = $row["sup_code"];
                        echo "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sup_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['SUP_NAME'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\"></a></td>
                            </tr>";
                    }
                }
                ?>
            </table>
        </div>

    </body>
</html>
