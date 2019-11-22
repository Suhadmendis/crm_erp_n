<?php
include './connection_sql.php';
?>



<style>
    * { margin: 0; padding: 0; }
    body { font: 14px/1.4 Georgia, serif;margin-top: -20px; }
    #page-wrap { width: 900px; margin: 0 auto; }

    textarea { border: 0; font: 18px Georgia, Serif; overflow: hidden; resize: none; }
    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }
    #middle{float: left;width: 300px;height: 150px;text-align: center;}
    #top{font-size: 25px;}
    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left; }
    #add { width: 250px; float: left; }
    #customer { overflow: hidden;height: 110px; }

    #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
    #logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
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
    #meta td.meta-head { text-align: left; background: #eee; }
    #meta td textarea { width: 100%; text-align: right; }

    #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
    #items th { background: #eee; }
    #items textarea { width: 80px; height: 20px; }
    #items tr.item-row td { border: 1; vertical-align: top; }
    #items td.description { width: 300px; }
    #items td.item-name { width: 175px; }
    #items td.description textarea, #items td.item-name textarea { width: 100%; }
    #items td.total-line { border-right: 0; text-align: right; }
    #items td.total-value { border-left: 0; padding: 10px; }
    #items td.total-value textarea { height: 20px; background: none; }
    #items td.balance { background: #eee; }
    #items td.blank { border: 0; }

    #terms { text-align: center; margin: 20px 0 0 0; }
    #terms h5 {border-bottom: 1px solid black;text-align: left;}
    #terms textarea { width: 100%; text-align: center;}

    textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

    .delete-wpr { position: relative; }
    .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }

</style>



<?php

include './connection_sql.php';



//$mid = $_GET["manuel_grn_ref"];


$sql2 = "Select * from s_mrnmas where tmp_no='" . $_GET['tmp_no'] . "'";

foreach ($conn->query($sql2) as $row3) {


//    if ($row3["type"] == "CUSTOMER") {
//        $supcus = "CUS";
//    } else {
//        $supcus = "SUP";
//    }


//    $id = $row3['aod_number'];
//
//    $genid = "";
//    if (strlen($id) == 1) {
//        $id = "MAOD/" . $supcus . "/0000";
//    } else if (strlen($id) == 2) {
//        $id = "MAOD/" . $supcus . "/000";
//    } else if (strlen($id) == 3) {
//        $id = "MAOD/" . $supcus . "/00";
//    } else if (strlen($id) == 4) {
//        $id = "MAOD/" . $supcus . "/0";
//    }



    echo '<br>
        <div id="page-wrap">

  
 

<div id="customer">


    <textarea readonly id="address" >CRIMSON CS (PVT) LTD
No. 69/72, U.D.A. Industral Estate,
Katuwama, Homagama

</textarea>

 <table id="meta">
        <tr>
            <td class="meta-head">MRN NO</td>
            <td><textarea readonly >' . $row3['REF_NO'] . '</textarea></td>
        </tr>
        <tr>


            <td class="meta-head">Date of Request</td>
            <td><textarea readonly id="date">' . $row3['SDATE'] . '</textarea></td>
        </tr>
       
    </table>
   
</div>

<h2>MRN</h2>
<hr>
<div style="float:  left;">
<p>REMARK  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row3['remark']. '</p>
</div>



<br>
<table id="items">

    <tr style="
    font-size:  13;
">
       
        <th style="width: 100px;">NO</th>
        <th style="width: 500px;">Description</th>
        <th>Qty</th>
       
    </tr>';



    $sql3 = "Select * from s_mrntrn where REFNO='" . $row3["REF_NO"] . "' and LEDINDI = 'GINR'";
    $count = 0;
    $i = 1;
    
    foreach ($conn->query($sql3) as $row4) {

        if ($count<5) {
            echo '<tr class="item-row">
               
                    <td>' . $i . '</td>
                    <td>' . $row4['DESCRIPt'] . '</td>
                     <td><textarea readonly class="cost">' . number_format($row4['QTY'], 4, ".", ",") . '</textarea></td>
                </tr>';
            
            $i = $i + 1;
        
            
        }else{
            
        }

//        ++$count;
    }



    echo '</table>';

    echo '

<div style="float: left;margin: 10px;">

<br>
<p>Authorized Signature :</p>   
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>  
<p>..................................................................</p>
</div>

<div style="float: left;margin: 10px;">

</div>';
    
        echo '</div>';
   
}
?>


