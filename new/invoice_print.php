<?php
require_once("connectioni.php");

$sql = "Select * from s_salma where tmp_no='" . $_GET["tmp_no"] . "'";
$result = mysqli_query($GLOBALS['dbinv'], $sql);
$row = mysqli_fetch_array($result);

$sql1 = "Select * from vendor where CODE='" . $row["C_CODE"] . "'";
$result1 = mysqli_query($GLOBALS['dbinv'], $sql1);
$row1 = mysqli_fetch_array($result1);


$sql_invpara = "SELECT * from invpara";
$result_invpara = mysqli_query($GLOBALS['dbinv'], $sql_invpara);
$row_invpara = mysqli_fetch_array($result_invpara);
?>
<!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
    <head>


        <title>Invoice Print</title>
        <meta name="generator" content="LibreOffice 5.1.6.2 (Linux)"/>
        <meta name="created" content="2006-09-16T00:00:00"/>
        <meta name="changed" content="2017-08-18T00:24:42.237600141"/>
        <meta name="AppVersion" content="14.0300"/>
        <meta name="DocSecurity" content="0"/>
        <meta name="HyperlinksChanged" content="false"/>
        <meta name="LinksUpToDate" content="false"/>
        <meta name="ScaleCrop" content="false"/>
        <meta name="ShareDoc" content="false"/>
        <style>
            .center {
                text-align: center;
            }
            
            .right {
                text-align: right;
            }
            
        </style>

    </head>

    <body>
        <table width="800px;" cellspacing="0" border="0">
            
            <tr>
                <th class="center"  colspan=6 ><?php echo $row_invpara['COMPANY'] ?></th>
            </tr>
            <tr>
                <th class="center" colspan=6 ><?php echo $row_invpara['ADD1'] ?></th>
            </tr>
            <tr>
                <th class="center" colspan=6 >Tel: <?php echo $row_invpara['TELE'] ?>, Fax: <?php echo $row_invpara['FAX'] ?></th>
            </tr>
            <tr>
                <th class="center" colspan=6 >E- mail : <?php echo $row_invpara['EMAIL'] ?></th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td height="18"></td>
                <td><?php echo $row['CUS_NAME'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><br></td>
            </tr>
            <tr>
                <td ></td>
                <td><?php echo $row['ADD'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td >Credit</td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td>Company VAT No: <?php echo $row_invpara['VAT'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Date: <?php echo $row['SDATE'] ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Customer VAT No: </td>
                <td></td>
                <td></td>
                <td></td>
                <td>Invoice No: <?php echo $row['REF_NO']; ?></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class='center' colspan='6'><?php if ($row["vat"]==1){echo "VAT ";}else{echo "SVAT ";}?>INVOICE</th>
            </tr>
        </table><table width="800px;">
            <tr>
                <th width="0px;"></th>
                <th width="30px;">No</th>
                <th width="80px;">Qty</th>
                <th width="450px;">Description</th>
                <th width="120px;">Rate</th>
                <th width="120px;">Amount</th>
            </tr>
            <?php
            $sql1 = "Select * from s_invo where REF_NO='" . $row['REF_NO'] . "'";
            $result1 = mysqli_query($GLOBALS['dbinv'], $sql1);
            while ($row1 = mysqli_fetch_array($result1)) {
                ?>
            <tr>
                <td></td>
                <td>1</td>
                <td><?php echo $row1['QTY']; ?></td>
                <td><?php echo $row1['DESCRIPT']; ?></td>
                <td class="right"><?php echo $row1['PRICE']; ?></td>
                <td class="right"><?php echo number_format($row1['PRICE']*$row1['QTY'], 2, ".", ","); ?></td>
            </tr>
            <?php
//            $mtot = $mtot + ($row1['QTY']*$row1['PRICE']);
            }
            ?>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td><?php if($row['BTT']>0) echo "NBT " .$row['btt_rate']."%";?></td>
                <td></td></td>
                <td class="right"><?php 
                if($row['BTT']>0) echo number_format($row['BTT'], 2, ".", ","); ?></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td  ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td  ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td  ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td  ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td</td>
                <td</td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td</td>
                <td  ></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td>Sub Total</td>
                <td class="right"><?php
                echo number_format(($row['GRAND_TOT']-$row['btt']), 2, ".", ",");
                
                ?></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php if($row['vat']==1) {echo "VAT " .$row['gst']. "%"; $vat = $row["VAT_VAL"];}else{echo "SVAT " .$row['gst']. "%";$vat = $row["SVAT"];}?></td>
                <td class="right"><?php
                echo number_format($vat, 2, ".", ",");
                
                ?></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Amount</td>
                <td class="right"><?php
                $invtot_g = $row["GRAND_TOT"];
                echo number_format($invtot_g, 2, ".", ",");
                
                ?></td>
            </tr>
            </table><table width="800px;">
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td  colspan='2'></td>
                 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table><table width="800px;">
            <tr>
                <td> </td>
                <td>Prepared By:  .................     </td>
                <td></td> 
                <td>Checked By:   .................</td>
                <td></td>
                <td>Authorised By:.................</td>
            </tr>
        </table>
       
    </body>

</html> -->



<?php

include './connection_sql.php';


?>

<?php
require_once("connectioni.php");

$sql = "Select * from s_salma where tmp_no='" . $_GET["tmp_no"] . "'";
$result = mysqli_query($GLOBALS['dbinv'], $sql);
$row = mysqli_fetch_array($result);

$sql1 = "Select * from vendor where CODE='" . $row["C_CODE"] . "'";
$result1 = mysqli_query($GLOBALS['dbinv'], $sql1);
$row1 = mysqli_fetch_array($result1);


$sql_invpara = "SELECT * from invpara";
$result_invpara = mysqli_query($GLOBALS['dbinv'], $sql_invpara);
$row_invpara = mysqli_fetch_array($result_invpara);
?>

<style>
    * { margin: 0; padding: 0; }
    body { font: 14px/1.4 Georgia, serif; }
    #page-wrap { width: 800px; margin: 0 auto; }

    textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
    /*    table { border-collapse: collapse; }*/
    table td, table th { border: 0px solid black; padding: 5px; }
    #middle{float: left;width: 200px;height: 150px;text-align: center;}
    #top{font-size: 25px;}
    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left; }
    #add { width: 250px; float: left; }
    #customer { overflow: hidden; }

    #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 0px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
    #logo:hover, #logo.edit { border: 0px solid #000; margin-top: 0px; max-height: 125px; }
    #logoctr { display: none; }
    #logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
    #logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
    #logohelp input { margin-bottom: 5px; }
    .edit #logohelp { display: block; }
    .edit #save-logo, .edit #cancel-logo { display: inline; }
    .edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
    #customer-title { font-size: 20px; font-weight: bold; float: left; }

    #meta { margin-top: 1px; width: 300px; float: right; }
    #meta td { text-align: right;  }
    #meta td.meta-head { text-align: left; background: white; }
    #meta td textarea { width: 100%; text-align: right; }

    #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 0px solid black; }
    #items th { background: #eee; }
    #items textarea { width: 80px; height: 20px; }
    #items tr.item-row td { border: 0; vertical-align: top; }
    #items td.description { width: 375px; }
    #items td.item-name { width: 100px; }
    #items td.description textarea, #items td.item-name textarea { width: 100%; }
    #items td.total-line { border-right: 0; text-align: right; }
    #items td.total-value { border-left: 0; padding: 10px; }
    #items td.total-value textarea { height: 20px; background: none; }
    #items td.balance { background: #eee; }
    #items td.blank { border: 0; }

    #terms { text-align: center; margin: 20px 0 0 0; }
    #terms h5 {border-bottom: 1px solid black;text-align: left;}
    #terms textarea { width: 100%; text-align: center;}

    #main-table { background-color: white; height: 455px;margin-top: 5px;}
    #bottom-table { background-color: white;}
    #usd-rate {margin-left: 120px;margin-top: -25px;}


    textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

    .delete-wpr { position: relative; }
    .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }

    div.groove {border-style: groove;}
    /*    div.bgimg {background-image: url('img/invoice_logo/Invoice-2018.gif');background-repeat: no-repeat;background-position: center;position: relative;;width: 1413px;height: 2000px}*/
</style>


<?php

include './connection_sql.php';

echo '<div>';





$sql2 = "Select * from s_salma where tmp_no='" . $_GET["tmp_no"] . "'";

foreach ($conn->query($sql2) as $row3) {

 
// echo print_r($row3);





    $date = $row3['Invoice_Date'];
    $day = explode("-", $date);
    $date = $day[2] . "-" . $day[1] . "-" . $day[0];






if ($row3['VAT']=="2") {
    $TAX_TYPE = "SVAT INVOICE";
}else{
    $TAX_TYPE = "TAX INVOICE";
}


    echo '
        <div  class="bgimg" id="page-wrap" style="width: 800px;padding-right: 30px;">

  
 

<div style="clear:both"></div>

<div id="customer">


   
                 
    
<div id="middle" style="margin-left: 200px;"><br><br><br><br><br><b id="top">' . $TAX_TYPE . '</b></div>
    




 <table id="meta" style="margin-top: -11px;">
        <tr style="font-size: 14px;">
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row['REF_NO'] . '</div></td>
        </tr>
        <tr>

            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row['SDATE'] . '</div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due"></div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due"></div></td>
        </tr>
     
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row3['ORD_NO'] . '</div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row3['currency'] . '</div></td>
        </tr>
        

    </table>
  
</div>
 <div style="height: 5px"></div>
<br>



<div style="width: 300px;float:  left;margin-left: 100px">
<p>' . $row3['Customer_Name'] . '</p>
<p>' . $row3['Customer_Address'] . '</p>
   
</div>



<div style="float:  right;">

<p>Customer NBT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['C_NBT'] . '</p>

<p>Customer VAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['C_VAT'] . '</p>';
    if ($row3['svatboo'] == 1) {
        echo '
<p>Our SVAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 002326 </p>';
    }
    echo '
</div>
<br>
<br>
 
<br>
<p>Customer SVAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['C_SVAT'] . '</p>
<br>';
    echo '<br><br>
<div id="main-table">
<table id="items" style="table-layout: fixed;"><thead>

    ';



    $sql3 = "SELECT * FROM s_invo where REF_NO = '" . $row3['REF_NO'] . "'";

    $count = 0;

    // echo $sql3;





    foreach ($conn->query($sql3) as $row4) {


           
               
                echo '<tr class="item-row">
                        <td class="item-name" style="text-align: center;"><div class="delete-wpr">' . $row4['QTY'] . '</textarea></div></td>
                        <td class="description" style="text-align: left;">' . $row4['DESCRIPT'] . '</textarea></td>
                        <td style="text-align: right;">' . $row4['PRICE'] . '</td>
                        <td style="text-align: right;">' . number_format($row4['PRICE']*$row4['QTY'],2) . '</td>
                        
                    </tr>';
            
        }



    

    echo '<tr class="item-row">
      
        <td style="text-align: right;">&nbsp;</td>
        
    </tr>';


    if ($row3['ouraodnumber'] != "") {
        echo '<tr class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: left;">AOD : ' . $row3['ouraodnumber'] . '</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        
    </tr>';
    }


    echo '</table>';





    echo '</div>';


    $subtotsql = "SELECT SUM(Value) FROM proforma_invoice_table where Invoice_Number = '$mid'";


    $result = $conn->query($subtotsql);
    $row = $result->fetch();
//    $subtot = $row[0];
//
//    $nbt = $subtot / 100;
//    $nbt = $nbt * 2;
//
//    $vat = $subtot + $nbt;
//    $vat = $vat / 100;
//    $vat = $vat * 15;
//
//    $subtot = number_format($subtot, 2, '.', '');
//    $nbt = number_format($nbt, 2, '.', '');
//    $vat = number_format($vat, 2, '.', '');
//
//    $totamount = $subtot + $nbt + $vat;
//    $totamount = number_format($totamount, 2, '.', '');
//


$SUB_TOT = $row4['PRICE']*$row4['QTY'];
$ADVANCE = $row3['advance'];



    echo '
<div id="bottom-table">
<table id="items" style="table-layout: fixed;"><thead>

    ';


                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . number_format($SUB_TOT,2) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr">&nbsp;</textarea></div></td>
        <td class="description" style="text-align: right;">&nbsp;</textarea></td>
        <td style="text-align: right;">&nbsp;</td>
        <td style="text-align: right;">&nbsp;</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr">&nbsp;</textarea></div></td>
        <td class="description" style="text-align: right;">&nbsp;</textarea></td>
        <td style="text-align: right;">&nbsp;</td>
        <td style="text-align: right;">&nbsp;</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . number_format($SUB_TOT,2) . '</b></td>
        
    </tr>';
                 echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . number_format($ADVANCE,2) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . number_format($SUB_TOT - $ADVANCE,2) . '</b></td>
        
    </tr>';
 

    


    echo '</table></div>';



}


echo '</div>';

function cal($val) {
    if ($_GET['rate'] > 1) {
        $backfront = explode(".", $val);
        if ($backfront[1] == NULL) {
            return number_format($backfront[0]) . ".0000";
        } else {
            $backfront[1] = $backfront[1] . "0000";
            return number_format($backfront[0]) . "." . substr($backfront[1], 0, 4);
        }
    } else {
        $backfront = explode(".", $val);
        if ($backfront[1] == NULL) {
            return number_format($backfront[0]) . ".00";
        } else {
            $backfront[1] = $backfront[1] . "0000";
            return number_format($backfront[0]) . "." . substr($backfront[1], 0, 2);
        }
    }
}
?>




