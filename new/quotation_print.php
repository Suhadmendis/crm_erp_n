<?php
include './connection_sql.php';
?>


<style>
    /*    body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }*/

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    /*    .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 40px;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }*/
    /*    .subpage {
                    padding: 1cm;
            border: 5px red solid;
            height: 256mm;
                    outline: 2cm #FFEAEA solid;
    
            background: url(logo.gif);
            background-repeat: no-repeat;
            background-position: top right; 
            background-size: 98%;
        }*/

    #pagenumber{
        /*position  : fixed;*/
        bottom: 0;
        right: 0;

    }




    * { margin: 0; padding: 0; }
    body { font: 14px/1.4 Georgia, serif; }

    /*            #page-wrap { width: 900px; margin: 0 auto; }
        #page-wrap1 { width: 800px;float: left;}
        #page-wrap2 { float: left;}*/

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

    #items { clear: both; width: 620px; margin: 30px 0 0 0; border: 1px solid black; }

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


    /*    @media all {
            .page-break { display: none; }
        }*/

    /*    @media print {
            .page-break { display: block; page-break-before: always; }
        }*/

    .para{
        margin-bottom: 4px;
    }

    .para-align{
        width: 200px;
    }


    .divlogo{
        padding-top: 20px;
        /*margin-top: -70px;*/
        width: 700px;
        height: 900px;
        position: fixed;


    }

    /*  @page {
          
           // margin: 0;
        }*/
    @media print {
        .page {

            margin-bottom: 10px;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    @media print {

        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        div.divlogo {
            margin-top: -100px;
            margin-left: 30px;


        }
        body{
            padding-left: 10px
        }
        div.downpart2 {
            page-break-before: auto;
            /*page-break-inside: avoid;*/
        }
    }   

    body {
        font-family: Calibri; 
    } 

    #element1 {display:inline-block;margin-right:10px; width:100px;} 
    #element2 {display:inline-block;} 
    #element3 {display:inline-block;font-size: 14px;} 

</style>

<!--<style type="text/css" media="print">
    body
    {
        background-image:url(logo.gif);
      
        background-position: top right; 
        background-attachment:fixed;
        background-size:100%;
    }
</style>-->



<?php
include './connection_sql.php';


$mid = $_GET["Quotation_NO"];




$sql2 = "SELECT * FROM quotation where Quotation_NO = '$mid'";

foreach ($conn->query($sql2) as $row3) {


    $pagePartition = 0;

    echo '<div class="book">
            <div class="page">
            
                <div class="subpage">';
    echo '
        <br>
        <br>
        <br>
        <div >
        <div >

  

<div style="width: 530px;float:  left;">';
    if ($row3['ATTN'] == "") {
        
    } else {
        echo '<p class="para" id="element1"><b>ATTN  </b></p><p class="para" id="element2"><b> : ' . $row3['ATTN'] . '</b></p><br>';
    }

    if ($row3['CC'] == "") {
        
    } else {
        echo '<p class="para" id="element1">CC  </p><p class="para"  id="element2"> : ' . $row3['CC'] . '</p><br>';
    }



    if ($row3['TOOO'] == "") {
        
    } else {
        echo '<p class="para" id="element1"><b>TO  </b></p><p class="para"  id="element2"><b> : ' . $row3['TOOO'] . '</b></p><br>';
    }


    if ($row3['FROMMM'] == "") {
        
    } else {
        echo '<p class="para" id="element1">FROM   </p><p class="para"  id="element2">: ' . $row3['FROMMM'] . '</p><br>';
    }

    echo '<p class="para" id="element1">DATE   </p><p class="para"  id="element2">: ' . $row3['DATE'] . '</p><br>';

    echo '<p class="para" id="element1"><b>SUBJECT   </b></p><p class="para"  id="element2"><b>: ' . $row3['SUBJECT'] . '</b></p><br>';

    echo '<p  id="element3">' . $row3['Text_0'] . '</p>';

    echo '
</div>

<!--
<div style="float:  right;">

<p>ADDRESS &nbsp;: ' . $row3['Address'] . '</p>

</div>
-->

<div style="float:  right;">

<p><b  style="margin-right: 60px;">  ' . $row3['Quotation_NO'] . '</b></p>


</div>



<br>
<input type="hidden" value="' . $_GET['format'] . '" id="format">';

    $vartable = '';
    $VNpanel = '';






    if ($_GET['format'] == "p1") {


        if ($_GET['botpanel'] == 1) {

        }
        if ($_GET['remarkpanel'] == 1) {

        }
        if ($_GET['VNpanel'] == 1) {
            $VNpanel = ' + NBT + VAT';
        }

        $vartable .= '<table id="items">

    <tr style="font-size: 15;">
        <th style="width: 300px;"><b>DESCRIPTION</b></th>
        <th style="width: 100px;"><b>QTY</b></th>
        <th style="width: 150px;"><b>UNIT PRICE</b></th>';

        if ($_GET['botpanel'] == 1) {
            $vartable .= '<th style="width: 150px;">TOTAL PRICE</th>';
        }
        if ($_GET['remarkpanel'] == 1) {
            $vartable .= '<th style="width: 200px;">REMARK</th>';
        }
        $vartable .= '</tr>';



        $sql3 = "SELECT * FROM quotation_table where Quotation_NO = '$mid'";
        $count = 0;

        $item = "";

        $count = 1;

        $tot = 0;

        foreach ($conn->query($sql3) as $row4) {

            if ($item != $row4['Item_Name']) {



                $countsql = "select count(Item_Name) from quotation_table where Item_Name = '" . $row4['Item_Name'] . "' and Quotation_NO = '" . $row4['Quotation_NO'] . "'";
                $resul = $conn->query($countsql);
                $row = $resul->fetch();
                $no = $row[0];

                $temp1111 = $no * 50;

                $pagePartition = $pagePartition + $temp1111;

                if ($_GET['botpanel'] == 1) {

                    if ($row4['Location']!="") {
                        $vartable .= '<td colspan="4"><b>' . $row4['Location'] . '</b></td>';
                    }

                } else {

                    if ($row4['Location']!="") {
                        $vartable .= '<td colspan="3"><b>' . $row4['Location'] . '</b></td>';
                    }

                }

                $item = $row4['Item_Name'];

                if ($_GET['botpanel'] == 1) {
                    $vartable .= '<tr class="item-row">
        <td  rowspan="' . $no . '"> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
        <td style="text-align: center;">' . number_format($row4['Qty'],2) . '</b></td>
        <td style="text-align: center;"> RS.' . number_format($row4['Unit_Price'],2) . $VNpanel . '</b></td>
       <td style="text-align: center;">RS.' . number_format($row4['Unit_Price'] * $row4['Qty'],2) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style="text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }
                    $vartable .= '</tr>';
                } else {
                    $vartable .= '<tr class="item-row">
        <td  rowspan="' . $no . '"> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
        <td style="text-align: center;">' . number_format($row4['Qty'],2) . '</b></td>
        <td style="text-align: center;"> RS.' . number_format($row4['Unit_Price'],2) . $VNpanel . '</b></td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }
                    $vartable .= '</tr>';
                }


                $temptot = $row4['Qty'] * $row4['Unit_Price'];
                $tot = $tot + $temptot;

                ++$count;
            } else {
                $pagePartition = $pagePartition + 30;
                if ($_GET['botpanel'] == 1) {
                    $vartable .= '<tr class = "item-row">

                    <td style = "text-align: center;">' . number_format($row4['Qty'],2) . '</td>
                    <td style = "text-align: center;">RS.' . number_format($row4['Unit_Price'],2) . $VNpanel . '</td>
                    <td style = "text-align: center;">RS.' . number_format($row4['Unit_Price'] * $row4['Qty'],2) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }
                    $vartable .= '</tr>';
                } else {
                    $vartable .= '<tr class = "item-row">

                    <td style = "text-align: center;">' . number_format($row4['Qty'],2) . '</td>
                    <td style = "text-align: center;">RS.' . number_format($row4['Unit_Price'],2) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }
                    $vartable .= '</tr>';
                }
                $temptot = $row4['Qty'] * $row4['Unit_Price'];
                $tot = $tot + $temptot;
            }
        }

        //tot 
        $retot = $tot;

        //nbt 
        $renbt = $retot / 100;
        $renbt = $renbt * 2;

        //tot and nbt
        $totnbt = $renbt + $retot;

        //vat 
        $revat = $totnbt / 100;
        $revat = $revat * 15;

        //tot and vat
        $totvat = $revat + $totnbt;


        if ($_GET['botpanel'] == 1) {

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">Total</td>
                    <td style = "text-align: center;">' . cal($retot) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">NBT (2%)</td>
                    <td style = "text-align: center;">' . cal($renbt) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;"></td>
                    <td style = "text-align: center;">' . cal($totnbt) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">VAT (15%)</td>
                    <td style = "text-align: center;">' . cal($revat) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">
                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">Value</td>
                    <td style = "text-align: center;">' . cal($totvat) . '</td>

                    </tr>';
            $pagePartition = $pagePartition + 150;
        } else {
            
        }


        $vartable .= '</table>';








    } else if ($_GET['format'] == "p2") {
        
         if ($_GET['VNpanel'] == 1) {
            $VNpanel = ' + NBT + VAT';
        }
        $vartable .= '<table id = "items">

                    <tr style = "font-size: 13;">
                    <th style = "width: 300px;">DESCRIPTION</th>
                    <th style = "width: 100px;">QTY</th>
                    <th style = "width: 150px;">UNIT PRICE</th>

                    ';
        if ($_GET['botpanel'] == 1) {
            $vartable .= '<th style = "width: 150px;">TOTAL PRICE</th>';
        }
        if ($_GET['remarkpanel'] == 1) {
            $vartable .= '<th style = "width: 200px;">REMARK</th>';
        }
        $vartable .= '</tr>';

        $sql3 = "SELECT * FROM quotation_table where Quotation_NO = '$mid'";
        $count = 0;

        $item = "";

        $count = 1;

        foreach ($conn->query($sql3) as $row4) {

            if ($item != $row4['Item_Name']) {


                $countsql = "select count(Item_Name) from quotation_table where Item_Name = '" . $row4['Item_Name'] . "' and Quotation_NO = '" . $row4['Quotation_NO'] . "'";
                $resul = $conn->query($countsql);
                $row = $resul->fetch();
                $no = $row[0];


                $item = $row4['Item_Name'];

                if ($_GET['botpanel'] == 1) {

                    $vartable .= '<tr class = "item-row">
                    <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                    <td style = "text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                    <td style = "text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>
                    <td style = "text-align: center;"> RS.' . printAmount($row4['Unit_Price'] * $row4['Qty']) . $VNpanel . '</td>';

                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                    $temptot = $row4['Qty'] * $row4['Unit_Price'];
                    $tot = $tot + $temptot;

                    ++$count;
                } else {
                    $vartable .= '<tr class = "item-row">
                    <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                    <td style = "text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                    <td style = "text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                 
                    $temptot = $row4['Qty'] * $row4['Unit_Price'];
                    $tot = $tot + $temptot;

                    ++$count;
                }
            } else {
                
            }
        }

          //tot 
        $retot = $tot;

        //nbt 
        $renbt = $retot / 100;
        $renbt = $renbt * 2;

        //tot and nbt
        $totnbt = $renbt + $retot;

        //vat 
        $revat = $totnbt / 100;
        $revat = $revat * 15;

        //tot and vat
        $totvat = $revat + $totnbt;


        if ($_GET['botpanel'] == 1) {

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">Total</td>
                    <td style = "text-align: center;">' . cal($retot) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">NBT (2%)</td>
                    <td style = "text-align: center;">' . cal($renbt) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;"></td>
                    <td style = "text-align: center;">' . cal($totnbt) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">

                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">VAT (15%)</td>
                    <td style = "text-align: center;">' . cal($revat) . '</td>

                    </tr>';

            $vartable .= '<tr class = "item-row">
                    <td style = "border-right-color: white;text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;border-bottom-color: white;border-left-color: white;"></td>
                    <td style = "text-align: center;">Value</td>
                    <td style = "text-align: center;">' . cal($totvat) . '</td>

                    </tr>';
            $pagePartition = $pagePartition + 150;
        } else {
            
        }





        $vartable .= '</table><br>';


    } else if ($_GET['format'] == "p3") {
        
         if ($_GET['VNpanel'] == 1) {
            $VNpanel = ' + NBT + VAT';
        }
        $vartable .= '<table id = "items">

                    <tr style = "font-size: 13;">
                    <th style = "width: 300px;">DESCRIPTION</th>
                    <th style = "width: 100px;">QTY</th>
                    <th style = "width: 150px;">UNIT PRICE</th>

                    ';


        if ($_GET['botpanel'] == 1) {
            $vartable .= '<th style = "width: 150px;">TOTAL PRICE</th>';
        }
        if ($_GET['remarkpanel'] == 1) {
            $vartable .= '<th style = "width: 200px;">REMARK</th>';
        }


        $vartable .= '</tr>';



        $sql3 = "SELECT * FROM quotation_table where Quotation_NO = '$mid'";
        $count = 0;

        $item = "";

        $count = 1;

        foreach ($conn->query($sql3) as $row4) {

            if ($item != $row4['Item_Name']) {


                $countsql = "select count(Item_Name) from quotation_table where Item_Name = '" . $row4['Item_Name'] . "' and Quotation_NO = '" . $row4['Quotation_NO'] . "'";
                $resul = $conn->query($countsql);
                $row = $resul->fetch();
                $no = $row[0];


                $item = $row4['Item_Name'];

//                $vartable .= '<tr class = "item-row">
//                                <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
//                                <td style="text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
//                                <td style="text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>
//
//                            </tr>';

                if ($_GET['botpanel'] == 1) {

                    $vartable .= '<tr class="item-row">
                                <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                                <td style="text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                                <td style="text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>
                                <td style="text-align: center;">RS.' . $row4['Unit_Price'] * $row4['Qty'] . $VNpanel . '</b></td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                } else {
                    $vartable .= '<tr class="item-row">
                                <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                                <td style="text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                                <td style="text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                }





                ++$count;
            } else {
                if ($_GET['botpanel'] == 1) {

                    $vartable .= '<tr class="item-row">
                                <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                                <td style="text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                                <td style="text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>
                                <td style="text-align: center;">RS.' . $row4['Unit_Price'] * $row4['Qty'] . $VNpanel . '</b></td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                } else {
                    $vartable .= '<tr class="item-row">
                                <td> <b>' . $row4['Item_Name'] . '</b><br> ' . $row4['Description'] . '</td>
                                <td style="text-align: center;"> ' . printQTY($row4['Qty']) . '</td>
                                <td style="text-align: center;"> RS.' . printAmount($row4['Unit_Price']) . $VNpanel . '</td>';
                    if ($_GET['remarkpanel'] == 1) {
                        $vartable .= '<td style = "text-align: center;">' . $row4['tbl_remark'] . '</td>';
                    }

                    $vartable .= ' </tr>';
                }
            }
        }



        $vartable .= '</table><br>';
    }



    echo '<div class="divlogo"><img style="width: 690px;" src="logo.png" ></div>';
    echo '<div id="mainTablediv" style="position: relative;width: 500;">' . $vartable . '</div>';




    // echo '<div id="table1" style="position: relative;width: 500;"></div></div></div></div></div>';
    //end of 1 page
    //start of 2 page
    //   echo '<div id="pageScript">';
//    echo '<div class="book">
//         
//            <div class="page">
//            
//                <div class="subpage">';
//
//    echo '<div id="table2" style="position: relative;width: 500;"></div></div></div></div></div>';
    //  echo '</div>';




    echo '<div id="downpart1"><div  style="width: 680px;float:  left;">
            <h5>CONDITIONS :</h5>
            <br>

            <ul style="margin-left: 40px;">
                <li><p>Remark   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Remark'] . '</p><br></li>
                <li><p>All payment should be written in favour of  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['All_payment'] . '</p><br></li>
                <li><p>Validity of quotation  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Validity_of_quotation'] . '</p><br></li>
                <li><p>Payment  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :-&nbsp;&nbsp; ' . $row3['Payment'] . '</p><br></li>
                <li><p>Delivery   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :-&nbsp;&nbsp; ' . $row3['Delivery'] . '</p><br></li>
            </ul>
 </div>
 </div>
 <div class="downpart2">
            <p style="width: 650px;">' . $row3['Text_1'] . '</p><br>
            <p>' . $row3['Text_2'] . '</p>

           
            
                <div style="float:  left;">
               <br>
                <p>Yours sincerely</p>
                <b><p>CRIMSON CREATIVE SOLUTIONS PVT LTD</p></b>


                <img src="_img/tania francis sign/unnamed.jpg" style="width: 130px; alt=""/>
                <p>Tania Francis</p>
                <b><p>GENERAL MANAGER SALES/MARKETING</p></b><br>


                </div></div>';
}

function cal($val) {
    return number_format($val, 2, ".", ",");
}

function printAmount($val) {

    $tempArray = explode(".", (string) $val);

    $temp1 = $tempArray[0];
    $temp2 = ".";
    $temp3 = (int) $tempArray[1];

    if (strlen($temp3) < 3) {
        $temp3 = (string) 00;
        $tt = $temp1 . $temp2 . "00";
        $ttt = $tt;
        return $ttt;
    } else {
        $tt = $temp1 . $temp2 . $temp3;
        $ttt = (float) $tt;
        return number_format($ttt, 2);
    }
}

function printQTY($val) {

    $tempArray = explode(".", (string) $val);

    $temp1 = $tempArray[0];
    $temp2 = ".";
    $temp3 = (int) $tempArray[1];


    $tt = $temp1 . $temp2 . $temp3;
    $ttt = (float) $tt;
    return $ttt;
}
?>

<!--<input type="button" onclick="printDiv('page')" value="print a div!" />
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script> -->

<script>
    setTable();
    function setTable() {
    var table = document.getElementById("mainTablediv").innerHTML;
            document.getElementById("mainTablediv").innerHTML = "";
            var format = document.getElementById("format").value;
            if (format === "p1") {


    var res = table.split("rowspan=");
            for (var i = 0; i < res.length; i++) {
    console.log(res[i]);
    }

    var page1table;
            var createTable1 = "";
            if (res.length > 1) {
    page1table = res;
            var temp = "";
            for (var i = 0; i < page1table.length; i++) {

//                var temp11 = res[i];
//                var temp22 = "<tr class='item-row'><td rowspan=" + temp11.substring(0, temp11.length - 34);

    //removeLastChildINNERHTML(temp22);

    // console.log(temp22);
    // console.log("------------------------------------");
    temp = "rowspan=" + res[i];
            createTable1 = createTable1 + temp;
    }

    createTable1 = createTable1.slice(8);
    }


    //var upPart = "<table id='items'>    <tbody><tr style='font-size: 15;'>        <th style='width: 500px;'><b>DESCRIPTION</b></th>        <th style='width: 200px;'><b>QTY</b></th>        <th style='width: 200px;'><b>UNIT PRICE</b></th><th style='width: 200px;'>TOTAL PRICE</th></tr>";


    //console.log(createTable1);
//        var page2table;
//
//        var createTable2 = "";
//
//        if (res.length > 24) {
//            page2table = res.slice(13);
//
//            for (var i = 12; i < page2table.length; i++) {
//                createTable2 = createTable2 + "<tr" + res[i];
//            }
//
//            createTable2 = createTable2.slice(3);
//        }

//console.log(createTable1);
//console.log("-----------------------------------------------");
//console.log(createTable2);

    document.getElementById("table1").innerHTML = createTable1 + "</tbody></table>";
            //document.getElementById("table2").innerHTML = createTable2+"</tbody></table>";
            //document.getElementById("table3").innerHTML = createTable3+"</tbody></table>";
    } else if (format === "p2")
//        {
//
//
//            var array = table.split('<tr');
//            var page1table;
//
//            var createTable1 = "";
//
//
//
//            array.shift();
//            array.shift();
//            //alert(array.length);
//            var count = 10
//            if (true) {
//                for (var i = 0; i < 9; i++) {
//                    createTable1 = createTable1 + '<tr' + array[i];
//
//                }
//
//                var tableUpString = '<table id="items">   <tbody><tr style="font-size: 13;">        <th style="width: 500px;">DESCRIPTION</th>        <th style="width: 200px;">QTY</th>        <th style="width: 200px;">UNIT PRICE</th></tr>';
//
//                if (array.length < 6) {
//
//                    var downpart1 = document.getElementById("downpart1").innerHTML;
//                    // document.getElementById("downpart1").innerHTML = "";
//                    // document.getElementById("downpart2").innerHTML = "";
//                    document.getElementById("table1").innerHTML = tableUpString + createTable1 + "<br><br>" + downpart1;
//                } else {
//                    document.getElementById("table1").innerHTML = tableUpString + createTable1;
//                }
//
//
//            }
//            if (array.length > 25) {
//                var createTable2 = "";
//                if (array.length > 9) {
//                    for (var i = 9; i < 25; i++) {
//                        createTable2 = createTable2 + '<tr' + array[i];
//
//                    }
//                    // createTable1 = createTable1.slice(4);
//
//                    var tableUpString = '<table id="items">   <tbody><tr style="font-size: 13;">        <th style="width: 500px;">DESCRIPTION</th>        <th style="width: 200px;">QTY</th>        <th style="width: 200px;">UNIT PRICE</th></tr>';
//
//                    //  console.log(createTable1);
//                    document.getElementById("pageScript").innerHTML = '<div class="book">                     <div class="page">                            <div class="subpage"><div id="table2" style="position: relative;width: 500;"></div></div></div></div>';
//                    document.getElementById("table2").innerHTML = tableUpString + createTable2;
//
//                }
//
//            } else {
//                var createTable2 = "";
//                if (array.length > 9) {
//                    for (var i = 9; i < array.length; i++) {
//                        createTable2 = createTable2 + '<tr' + array[i];
//
//                    }
//                    // createTable1 = createTable1.slice(4);
//
//                    var tableUpString = '<table id="items">   <tbody><tr style="font-size: 13;">        <th style="width: 500px;">DESCRIPTION</th>        <th style="width: 200px;">QTY</th>        <th style="width: 200px;">UNIT PRICE</th></tr>';
//
//                    //  console.log(createTable1);
//                    document.getElementById("pageScript").innerHTML = '<div class="book">                     <div class="page">                            <div class="subpage"><div id="table2" style="position: relative;width: 500;"></div></div></div></div>';
//                    document.getElementById("table2").innerHTML = tableUpString + createTable2;
//
//                }
//
//            }
//
//            var createTable3 = "";
//            if (array.length > 10) {
//                for (var i = 25; i < array.length; i++) {
//                    createTable3 = createTable3 + '<tr' + array[i];
//
//                }
//                // createTable1 = createTable1.slice(4);
//
//                var tableUpString = '<table id="items">   <tbody><tr style="font-size: 13;">        <th style="width: 500px;">DESCRIPTION</th>        <th style="width: 200px;">QTY</th>        <th style="width: 200px;">UNIT PRICE</th></tr>';
//
//                //  console.log(createTable1);
//
//                document.getElementById("pageScript").innerHTML = document.getElementById("pageScript").innerHTML + '<div class="book">                     <div class="page">                            <div class="subpage"><div id="table3" style="position: relative;width: 500;"></div></div></div></div>';
//                document.getElementById("table3").innerHTML = tableUpString + createTable3;
//
//            }
//
//
//
//
//
//
//
//            //down part
//
//
//            var downpart1 = document.getElementById("downpart1").innerHTML;
//            var downpart2 = document.getElementById("downpart2").innerHTML;
//            document.getElementById("downpart1").innerHTML = "";
//            document.getElementById("downpart2").innerHTML = "";
//
//            var page = document.getElementById("pageScript").innerHTML;
//
//            if (array.length < 6) {
//                document.getElementById("pageScript").innerHTML = page + '<div class="book">                     <div class="page">                            <div class="subpage">' + downpart2 + '</div></div></div>';
//
//            } else {
//                document.getElementById("pageScript").innerHTML = page + '<div class="book">                     <div class="page">                            <div class="subpage">' + downpart1 + downpart2 + '</div></div></div>';
//
//            }
//
//
//
//
//
////            console.log(document.getElementById("pageScript").innerHTML);
////            console.log(document.getElementById("pageScript").innerHTML);
//
//
//
//
//
//            //document.getElementById("table2").innerHTML = createTable2+"</tbody></table>";
//            //document.getElementById("table3").innerHTML = createTable3+"</tbody></table>";
//        }

    }



    function removeLastChildINNERHTML(INNERHTML) {
    alert(INNERHTML);
            return INNERHTML;
    }

</script> 