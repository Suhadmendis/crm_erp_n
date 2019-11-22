<?php

include './connection_sql.php';
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

$mid = $_GET["Invoice_Number"];
//$pieces = explode("/", $mid);
//$mid = (int)$pieces[2];




$sql2 = "SELECT * FROM proforma_invoice where Invoice_Number = '$mid' limit 1";

foreach ($conn->query($sql2) as $row3) {

    if ($row3["type"] == "CUSTOMER") {
        $supcus = "CUS";
    } else {
        $supcus = "SUP";
    }


    $id = $row3['Invoice_Number'];

    $genid = "";
    if (strlen($id) == 1) {
        $id = "ccs/Pro/19-0000" . $id;
    } else if (strlen($id) == 2) {
        $id = "ccs/Pro/19-000" . $id;
    } else if (strlen($id) == 3) {
        $id = "ccs/Pro/19-00" . $id;
    } else if (strlen($id) == 4) {
        $id = "ccs/Pro/19-0" . $id;
    }






    $date = $row3['Invoice_Date'];
    $day = explode("-", $date);
    $date = $day[2] . "-" . $day[1] . "-" . $day[0];


    echo '
        <div  class="bgimg" id="page-wrap" style="width: 800px;padding-right: 30px;">

  
 

<div style="clear:both"></div>

<div id="customer">


   
                 
    
<div id="middle" style="margin-left: 200px;"><br><br><br><br><br><b id="top">PROFORMA INVOICE</b></div>
    




 <table id="meta" style="margin-top: -11px;">
        <tr style="font-size: 14px;">
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $id . '</div></td>
        </tr>
        <tr>

            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $date . '</div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row3['Settlement_Due'] . '</div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row3['Customer_Order_No'] . '</div></td>
        </tr>
     
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">&nbsp;</div></td>
        </tr>
        <tr>
            <td class="meta-head">&nbsp;</td>
            <td><div class="due">' . $row3['Currency'] . '</div></td>
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

<p>Customer NBT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['NBT'] . '</p>

<p>Customer VAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['VAT'] . '</p>';
    if ($row3['svatboo'] == 1) {
        echo '
<p>Our SVAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 002326 </p>';
    }
    echo '
</div>
<br>
<br>
 
<br>
<p>Customer SVAT Reg. No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['SVAT'] . '</p>
<br>';
    echo '<br><br>
<div id="main-table">
<table id="items" style="table-layout: fixed;"><thead>

    ';



    $sql3 = "SELECT * FROM proforma_invoice_table where Invoice_Number = '$mid'";
    $count = 0;












    if ($row3['no'] == "1") {

        foreach ($conn->query($sql3) as $row4) {


            if ($row3['nbtboo'] == 1) {
                $tablerowsub = $row4['Value'];
                $tablerownbt = $tablerowsub / 100;
                $tablerownbt = $tablerownbt * 2;
                $tablerownbt = $tablerownbt + $tablerowsub;

                $tablerowvat = $tablerownbt / 100;
                $tablerowvat = $tablerowvat * 15;
                $tablerowvat = $tablerowvat + $tablerownbt;

                $tablerowUP = $tablerowvat / $row4['QTY'];
                echo '<tr class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr">' . $row4['QTY'] . '</textarea></div></td>
        <td class="description" style="text-align: left;">' . $row4['Description'] . '</textarea></td>
        <td style="text-align: right;">' . cal($tablerowUP) . '</td>
        <td style="text-align: right;">' . cal($tablerowvat) . '</td>
        
    </tr>';
            } else {
                $tablerowsub = $row4['Value'];

                $tablerowvat = $tablerowsub / 100;
                $tablerowvat = $tablerowvat * 15;
                $tablerowvat = $tablerowvat + $tablerowsub;

                $tablerowUP = $tablerowvat / $row4['QTY'];
                echo '<tr class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr">' . $row4['QTY'] . '</textarea></div></td>
        <td class="description" style="text-align: left;">' . $row4['Description'] . '</textarea></td>
        <td style="text-align: right;">' . cal($tablerowUP) . '</td>
        <td style="text-align: right;">' . cal($tablerowvat) . '</td>
        
    </tr>';
            }
        }
    } else {
        foreach ($conn->query($sql3) as $row4) {
            echo '<tr class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr">' . $row4['QTY'] . '</textarea></div></td>
        <td class="description" style="text-align: left;">' . $row4['Description'] . '</textarea></td>
        <td style="text-align: right;">' . cal($row4['Unit_Price']) . '</td>
        <td style="text-align: right;">' . cal($row4['Value']) . '</td>
        
    </tr>';
        }
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







    if ($row3['Currency'] == "USD" && $row3['svatboo'] == "1") {

        if ($row3['nbtboo'] == "1") {


            $subtot = $row[0];
            $nbt = $subtot / 100;
            $nbt = $nbt * 2;
            $nbt = $nbt + $subtot;

            $vat = $nbt / 100;
            $vat = $vat * 15;
            $vat = $vat * $row3['rate'];




            echo '<div id="usd-rate">(SVAT 15% Amount Rs ' . cal($vat) . ')</div>';
        } else {
            $subtot = $row[0];
            ;
            $vat = $subtot / 100;
            $vat = $vat * 15;
            $vat = $vat * $row3['rate'];

            echo '<div id="usd-rate">(SVAT 15% Amount Rs ' . cal($vat) . ')</div>';
        }
    }



    echo '
<div id="bottom-table">
<table id="items" style="table-layout: fixed;"><thead>

    ';

 $advance = $row3['Advance'];
 
    if ($row3['no'] == "1") {
        if ($_GET['svatboo'] == 1) {
            //no no
            if ($_GET['nbtboo'] == 1) {

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($vsubtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">NBT</textarea></td>
        <td style="text-align: right;">2%</td>
        <td style="text-align: right;">' . cal($nbt) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">VAT</textarea></td>
        <td style="text-align: right;">15%</td>
        <td style="text-align: right;">' . cal($vat) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($totamount) . '</b></td>
        
    </tr>';
                      echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($totamount - $advance) . '</b></td>
        
    </tr>';
                
            } else {

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($vsubtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">NBT</textarea></td>
        <td style="text-align: right;">2%</td>
        <td style="text-align: right;">' . cal($nbt) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">VAT</textarea></td>
        <td style="text-align: right;">15%</td>
        <td style="text-align: right;">' . cal($vat) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($totamount) . '</b></td>
        
    </tr>';
                
                 echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($totamount - $advance) . '</b></td>
        
    </tr>';
            }
        } else {
            if ($_GET['nbtboo'] == 1) {

                $subtot = $row[0];
                $bottomvat = $subtot / 100;
                $bottomvat = $bottomvat * 2;
                $subtot2 = $bottomvat + $subtot;
                $bottomvat = $subtot2 /100;
                $bottomvat = $bottomvat * 15;
                $bottomvat = $bottomvat + $subtot2;

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($bottomvat) . '</td>
        
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
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($bottomvat) . '</b></td>
        
    </tr>';
                 echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($bottomvat - $advance) . '</b></td>
        
    </tr>';
            } else {
                $subtot = $row[0];

                //vat

                $bottomvat = $subtot / 100;
                $bottomvat = $bottomvat * 15;
                $bottomvat = $bottomvat + $subtot;


                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($bottomvat) . '</td>
        
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
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($bottomvat) . '</b></td>
        
    </tr>';
                       echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($bottomvat - $advance) . '</b></td>
        
    </tr>';
            }
        }
    } else {
        if ($_GET['svatboo'] == 1) {
            if ($_GET['nbtboo'] == 1) {


                $subtot = $row[0];
                $nbt = $subtot / 100;
                $nbt = $nbt * 2;

                $totamount = $subtot + $nbt;

                $vat = $totamount / 100;
                $vat = $vat * 15;



                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($subtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">NBT</textarea></td>
        <td style="text-align: right;">2%</td>
        <td style="text-align: right;">' . cal($nbt) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($totamount) . '</b></td>
        
    </tr>';
                       echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($totamount - $advance) . '</b></td>
        
    </tr>';



    //             echo '<tr class="item-row">
    //     <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
    //     <td class="description" style="text-align: right;">SVAT Amount</textarea></td>
    //     <td style="text-align: right;">15%</td>
    //     <td style="text-align: right;">' . cal($vat) . '</td>
        
    // </tr>';
            } else {
                $subtot = $row[0];
                $byone = $subtot / 100;
                $vat = $byone * 15;


                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($subtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">&nbsp;</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"></td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($subtot) . '</b></td>
        
    </tr>';
                
                                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($subtot - $advance) . '</b></td>
        
    </tr>';

    //             echo '<tr class="item-row">
    //     <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
    //     <td class="description" style="text-align: right;">SVAT Amount</textarea></td>
    //     <td style="text-align: right;">15%</td>
    //     <td style="text-align: right;">' . cal($vat) . '</td>
        
    // </tr>';
                
                
            }
        } else {
            if ($_GET['nbtboo'] == 1) {

                $subtot = $row[0];

                $nbt = $subtot / 100;
                $nbt = $nbt * 2;

                $vatwithnbt = $subtot + $nbt;
                $vat = $vatwithnbt / 100;
                $vat = $vat * 15;


                $totamount = $vatwithnbt + $vat;


                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($subtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">NBT</textarea></td>
        <td style="text-align: right;">2%</td>
        <td style="text-align: right;">' . cal($nbt) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">VAT</textarea></td>
        <td style="text-align: right;">15%</td>
        <td style="text-align: right;">' . cal($vat) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($totamount) . '</b></td>
        
    </tr>';
                
                                          echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($totamount - $advance) . '</b></td>
        
    </tr>';
            } else {
                $subtot = $row[0];

                $vat = $subtot / 100;
                $vat = $vat * 15;



                $totamount = $vat + $subtot;

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Sub Total</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($subtot) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">NBT</textarea></td>
        <td style="text-align: right;">2%</td>
        <td style="text-align: right;">' . cal($nbt) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">VAT</textarea></td>
        <td style="text-align: right;">15%</td>
        <td style="text-align: right;">' . cal($vat) . '</td>
        
    </tr>';

                echo '<tr  style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Total Amount</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b style="border-bottom: 3px double;">' . cal($totamount) . '</b></td>
        
    </tr>';
                
                      echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Advance</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;">' . cal($advance) . '</td>
        
    </tr>';

                echo '<tr style="font-size: 12px;line-height: 5px;" class="item-row">
        <td class="item-name" style="text-align: center;"><div class="delete-wpr"></textarea></div></td>
        <td class="description" style="text-align: right;">Balance to be Paid</textarea></td>
        <td style="text-align: right;"></td>
        <td style="text-align: right;"><b>' . cal($totamount - $advance) . '</b></td>
        
    </tr>';
                
                
            }
        }
    }


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




