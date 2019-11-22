<?php

include './connection_sql.php';
?>


<style>
    * { margin: 0; padding: 0; }
    body { font: 14px/1.4 Georgia, serif; }
    #page-wrap { width: 900px; margin: 0 auto; }

    textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }
    #middle{float: left;width: 300px;height: 150px;text-align: center;}
    #top{font-size: 25px;}
    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left; }
    #add { width: 250px; float: left; }
    #customer { overflow: hidden; }

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
    #items textarea { width: 80px;}
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


$mid = $_GET["Quotation_NO"];




$sql2 = "SELECT * FROM quotation where Quotation_NO = '$mid'";

foreach ($conn->query($sql2) as $row3) {


//    if ($row3["type"] == "CUSTOMER") {
//        $supcus = "CUS";
//    } else {
//        $supcus = "SUP";
//    }
//
//
//    $id = $row3['aod_number'];
//
//    $genid = "";
//    if (strlen($id) == 1) {
//        $id = "MAOD/" . $supcus . "/0000";
//       
//    } else if (strlen($id) == 2) {
//        $id = "MAOD/" . $supcus . "/000";
//     
//    } else if (strlen($id) == 3) {
//        $id = "MAOD/" . $supcus . "/00";
//      
//    } else if (strlen($id) == 4) {
//        $id = "MAOD/" . $supcus . "/0";
//       
//    }



    echo '
        <br>
        <br>
        <br>
        <div id="page-wrap">

  

<div style="float:  left;">

<p>ATTN  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $row3['ATTN'] . '</p><br>
<p>CC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $row3['CC'] . '</p><br>
<p>TOOO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : ' . $row3['TOOO'] . '</p><br>
<p>FROM  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $row3['FROMMM'] . '</p><br>
<p>DATE  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $row3['DATE'] . '</p><br>
<p>SUBJECT  &nbsp; : ' . $row3['SUBJECT'] . '</p><br>
    <br>
    
</div>
<!--
<div style="float:  right;">

<p>ADDRESS &nbsp;: ' . $row3['Address'] . '</p>

</div>
-->
<div style="float:  right;">

<p><b>' . $row3['Quotation_NO'] . '</b></p>

</div>


<br>
<table id="items">

    <tr style="font-size: 13;">
        <th style="width: 500px;">DESCRIPTION</th>
        <th style="width: 200px;">QTY</th>
        <th style="width: 200px;">UNIT PRICE</th>
       
    </tr>';



    $sql3 = "SELECT * FROM quotation_table where Quotation_NO = '$mid'";
    $count = 0;

    $item = "";

    $count = 1;

    foreach ($conn->query($sql3) as $row4) {

        if ($item != $row4['Item_Name']) {
            
            
        $countsql = "select count(Item_Name) from quotation_table where Item_Name = '". $row4['Item_Name'] ."' and Quotation_NO = '". $row4['Quotation_NO'] ."'";
        $resul = $conn->query($countsql);
        $row = $resul->fetch();
        $no = $row[0];
    


        
        
        
            echo '<td colspan="3"><b>Option ' . $count . '</b></td>';
            $item = $row4['Item_Name'];
            echo '<tr class="item-row">
        <td  rowspan="' . $no . '"> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
        <td style="text-align: center;"> <b>' . $row4['Qty'] . '</b></td>
        <td style="text-align: center;"> <b>' . $row4['Unit_Price'] . '</b></td>
        
    </tr>';
            
             ++$count;
        } else {
            echo '<tr class="item-row">
      
        <td style="text-align: center;"> <b>' . $row4['Qty'] . '</b></td>
        <td style="text-align: center;"> <b>' . $row4['Unit_Price'] . '</b></td>
        
        </tr>';
        }




       
    }



    echo '</table>';

//
//    if ($count > 10) {
//        
//    } else {
//        $count = 10 - $count;
//        for ($x = 0; $x < $count; $x++) {
//            echo "<br><br>";
//        }
//    }



    echo '

<br>
<br>
<br>
<div style="float:  left;">

<p>All payment should be written in favour of  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['All_payment'] . '</p><br>
<p>Validity of quotation  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Validity_of_quotation'] . '</p><br>
<p>Payment  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :-&nbsp;&nbsp; ' . $row3['Payment'] . '</p><br>
<p>Delivery   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Delivery'] . '</p><br>
<p>Remark   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Remark'] . '</p><br>
    
<p>' . $row3['Text_1'] . '</p><br>
<p>' . $row3['Text_2'] . '</p><br>

    <br>
    
</div>




';
}
?>




