<?php

session_start();



include_once './connection_sql.php';



if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";


    if ($_GET['cus'] == 1) {
        if ($_GET['sup'] == 1) {
            $sql2 = "select * from manuel_aod where dod BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        } else {
            $sql2 = "select * from manuel_aod where type = 'CUSTOMER' and dod BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }
    } else {
        if ($_GET['sup'] == 1) {
            $sql2 = "select * from manuel_aod where type = 'SUPPLIER' and dod BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        } else {
            $sql2 = "select * from manuel_aod limit 0";
        }
    }








    $tb = "";
    $tb .= "<table id='testTable'  class='table table-bordered'>";


    $tb .= "<thead><tr>";
    $tb .= "<th>MAOD NO</th>";
    $tb .= "<th>Date</th>";
    $tb .= "<th>Customer / Supplier</th>";
    $tb .= "<th>Name</th>";
    $tb .= "<th>Item</th>";
    $tb .= "<th>Qty</th>";


    $tb .= "</tr></thead><tbody>";



    foreach ($conn->query($sql2) as $row) {
        $cuscode = $row['aod_number'];
$code = $row['aod_number'];
        $sql3 = "select * from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";
        
        
        $sql4 = "select count(aodnumber) from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";
        $resul = $conn->query($sql4);
        $row4 = $resul->fetch();
      
        
        $type = "";
        if ($row['type']=="CUSTOMER") {
            $type = "CUS";
        }else{
            $type = "SUP";
        }
        
        if (strlen($cuscode) == 1) {
            $cuscode = "MAOD/$type/0000" . $cuscode;
        } else if (strlen($cuscode) == 2) {
            $cuscode = "MAOD/$type/000" . $cuscode;
        } else if (strlen($cuscode) == 3) {
            $cuscode = "MAOD/$type/00" . $cuscode;
        } else if (strlen($cuscode) == 4) {
            $cuscode = "MAOD/$type/0" . $cuscode;
        }

        
   
        
        if ($row4[0]==0) {
              $tb .= "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>";
       
   
        }else{
              $tb .= "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>";
       
   
        } 
        
      
        
        foreach ($conn->query($sql3) as $row1) {

            if ($row1['Product_Des']=="") {
                $tb .= " <td onclick=\"custno('$code');\">&nbsp;</td>
                              <td onclick=\"custno('$code');\">&nbsp;</td>
                            </tr>";
            }else{
                $tb .= " <td onclick=\"custno('$code');\">" . $row1['Product_Des'] . "</a></td>
                              <td onclick=\"custno('$code');\">" . $row1['QTY'] . "</a></td>
                            </tr>";
            }
            
            
        }
    }
    $tb .= "</tbody></table>";




    $ResponseXML .= "<td><![CDATA[" . $tb . "]]></td>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}
?>
