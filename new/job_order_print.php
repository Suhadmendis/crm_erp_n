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


$REF_NO = $_GET["REF_NO"];


$sql2 = "SELECT * FROM joborder where jid = '$REF_NO'";

foreach ($conn->query($sql2) as $row3) {


   


    echo '<br>
        <div id="page-wrap">

  
 

<div id="customer">


    <textarea readonly id="address" >CRIMSON CS (PVT) LTD
No. 69/72, U.D.A. Industral Estate,
Katuwama, Homagama

</textarea>

<tr>
                    <th colspan="4" scope="col">
                        <table cellpadding="0" cellspacing="0" >                                   
                            <tr  style="text-align: left;">
                                <td style="width: 500px">
                                    <p style="margin: 0px;" ><?php echo $row_head["ADD1"]; ?></p> 
                                    <p style="margin: 0px;" ><?php echo $row_head["ADD3"]; ?></p> 
                                    <p style="margin: 0px;" ><?php echo $row_head["TELE"]; ?></p> 
                                    <p style="margin: 0px;" ><?php echo $row_head["FAX"]; ?></p> 
                                </td>

                                <td>
                                    <img style="margin-left: 350px;width: 300px;" src="images/piclogo.PNG"/>
                                </td>
                            </tr>


                        </table>

                        <table width="1000" cellpadding="0" cellspacing="0" border="0"><tr><td>
                                    <table border="0">
                                        <tr>
                                            <td style="padding: 0px;">
                                                <div style="width: 492px;background-color: white;height: 100px;border-style: solid;text-align: left;">
                                                    <div style="width: 492px;background-color: #d4d7db;height: 25px;">


                                                    </div>
                                                    <p style="margin-left: 20px;">Date : <?php echo $row3[jobdate]; ?></p>
                                                    <p style="margin-left: 20px;">Quotation NO : <?php echo $row[QuotationRef]; ?></p>
                                                    <p style="margin-left: 20px;">Job Request No: <?php echo $row[JobRequestRef]; ?></p>
                                                     <p style="margin-left: 20px;">Instructions : <?php echo $row3[Instructions]; ?></p>
                                                    <p style="margin-left: 20px;">Length : <?php echo $row[joblength]; ?></p>
                                                    <p style="margin-left: 20px;">Width : <?php echo $row[jobwidth]; ?></p>
                                                    <p style="margin-left: 20px;">NO. OF Impressions : <?php echo $row[NoofImp]; ?></p>
                                                    <p style="margin-left: 20px;">NO. OF Colors : <?php echo $row[NoofColors]; ?></p>
                                                    <p style="margin-left: 20px;">No. Of Sides : <?php echo $row[Noofsides]; ?></p>
                                                    <p style="margin-left: 20px;">No. of Outs : <?php echo $row[Noofouts]; ?></p>
                                                    <p style="margin-left: 20px;">Quantity : <?php echo $row[JobQty]; ?></p>
                                                    <p style="margin-left: 20px;">Mk Ex. : <?php echo $row[MarketingEx]; ?></p>





                                                </div>
                                                <div style="width: 492px;background-color: white;height: 100px;border-style: solid;margin-top: 4px;text-align: left;">
                                                    <div style="width: 492px;background-color: #d4d7db;height: 25px;">

                                                    </div>
                                                    <p style="margin-left: 20px;">Product Ref : <?php echo $row[manuel_grn_ref]; ?></p>
                                                    <p style="margin-left: 20px;">Product Name : <?php echo $row[manuel_grn_ref]; ?></p>
                                                    <p style="margin-left: 20px;">Product Description : <?php echo $row[ProductDescription]; ?></p>
                                                   



                                                </div>
                                            </td>
                                            <td>
                                                <div style="width: 492px;background-color: white;height: 210px;border-style: solid;text-align: left;">
                                                    <div style="width: 492px;background-color: #d4d7db;height: 25px;">

                                                    </div>

                                                    <p style="margin-left: 20px;">Customer PO: <?php echo $row[CustomerPONo]; ?></p>
                                                    <p style="margin-left: 20px;">Customer : <?php echo $row[Customer]; ?></p>
                                                    <p style="margin-left: 20px;">Location : <?php echo $row[Location]; ?></p>



                                                </div>
                                            </td>

                                        </tr>

                                    </table>
                                </td></tr></table>



                    </th>
                </tr>


 <table id="meta">
        <tr>
            <td class="meta-head">Date</td>
        
             <td><textarea readonly >' . $row3['jobdate'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Quotation NO</td>
            <td><textarea readonly >' . $row3['QuotationRef'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Job Request No.</td>
            <td><textarea readonly >' . $row3['JobRequestRef'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Customer PO</td>
            <td><textarea readonly >' . $row3['CustomerPONo'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Customer</td>
            <td><textarea readonly >' . $row3['Customer'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Location</td>
            <td><textarea readonly >' . $row3['Location'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Product Ref</td>
            <td><textarea readonly >' . $row3['manuel_grn_ref'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Product Name</td>
            <td><textarea readonly >' . $row3['manuel_grn_ref'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Product Description</td>
            <td><textarea readonly >' . $row3['ProductDescription'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Instructions</td>
            <td><textarea readonly >' . $row3['Instructions'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Quantity</td>
            <td><textarea readonly >' . $row3['JobQty'] . '</textarea></td>
        </tr>


        <tr>
            <td class="meta-head">Length</td>
            <td><textarea readonly >' . $row3['joblength'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Width</td>
            <td><textarea readonly >' . $row3['jobwidth'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">NO. OF Impressions</td>
            <td><textarea readonly >' . $row3['NoofImp'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Mk. Ex</td>
            <td><textarea readonly >' . $row3['MarketingEx'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">NO. OF Colors</td>
            <td><textarea readonly >' . $row3['NoofColors'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">No. Of Sides</td>
            <td><textarea readonly >' . $row3['Noofsides'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">No. of Outs</td>
            <td><textarea readonly >' . $row3['Noofouts'] . '</textarea></td>
        </tr>
       
    </table>
    
   
   
</div>



<h2>JOB ORDER</h2>
<hr>
<div style="float:  left;">
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
</div>



<br>
<table id="items">

    <tr style="
    font-size:  13;
">
        <th style="width: 100px;">AOD NO</th>
        <th style="width: 100px;">NO</th>
        <th style="width: 500px;">Product Description</th>
        <th>Qty</th>
       
    </tr>';



    $sql3 = "SELECT * FROM manuel_grn_table where manuel_grn_ref = '$mid'";
    $count = 0;
    foreach ($conn->query($sql3) as $row4) {

        if ($count<5) {
            echo '<tr class="item-row">
                    <td class="item-name"><div class="delete-wpr">' . $row4['aod_no'] . '</div></td>
                    <td>' . $row4['no_text'] . '</td>
                    <td>' . $row4['product_description'] . '</td>
                     <td><textarea readonly class="cost">' . $row4['qty'] . '</textarea></td>
                </tr>';
        }else{
            
        }
        
        ++$count;
    }



    echo '</table>';

    echo '

<div style="float: left;margin: 10px;">

<br>
<p>Received By :</p>   
<br>
<p>Name</p>
<br>
<p>Signature</p>
</div>

<div style="float: left;margin: 10px;">

<br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>  
<br>
<p>........................................................................................</p>     
<br>
<p>........................................................................................</p>   
</div>';
    
        echo '</div>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<p>-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;</p>';
        echo '<br>';
        echo '<br>';
        
  


    if ($count > 5) {
        
  
            echo '<br>
        <div id="page-wrap">

  
 

<div id="customer">


    <textarea readonly id="address" >CRIMSON CS (PVT) LTD
No. 69/72, U.D.A. Industral Estate,
Katuwama, Homagama

</textarea>

 <table id="meta">
        <tr>
            <td class="meta-head">GRN NO</td>
            <td><textarea readonly >' . $row3['manuel_grn_ref'] . '</textarea></td>
        </tr>
        <tr>

            <td class="meta-head">GRN Date</td>
            <td><textarea readonly id="date">' . $row3['date'] . '</textarea></td>
        </tr>
       
    </table>
   
</div>

<h2>GOODS RECEIVED NOTE</h2>
<hr>
<div style="float:  left;">
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['name'] . '</p>
<p>ADDRESS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['address'] . '</p>
</div>



<br>
<table id="items">

    <tr style="
    font-size:  13;
">
        <th style="width: 100px;">AOD NO</th>
        <th style="width: 100px;">NO</th>
        <th style="width: 500px;">Product Description</th>
        <th>Qty</th>
       
    </tr>';



    $sql3 = "SELECT * FROM manuel_grn_table where manuel_grn_ref = '$mid'";
    $count = 0;
    foreach ($conn->query($sql3) as $row4) {

        if ($count>=5) {
            echo '<tr class="item-row">
                    <td class="item-name"><div class="delete-wpr">' . $row4['aod_no'] . '</div></td>
                    <td>' . $row4['no_text'] . '</td>
                    <td>' . $row4['product_description'] . '</td>
                     <td><textarea readonly class="cost">' . $row4['qty'] . '</textarea></td>
                </tr>';
        }else{
            
        }
        
        ++$count;
    }



    echo '</table>';

    echo '

<div style="float: left;margin: 10px;">

<br>
<p>Received By :</p>   
<br>
<p>Name</p>
<br>
<p>Signature</p>
</div>

<div style="float: left;margin: 10px;">

<br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>  
<br>
<p>........................................................................................</p>     
<br>
<p>........................................................................................</p>   
</div>';
    
        echo '</div>';
        
        
        
        
        
        
        
    }





}
?>




