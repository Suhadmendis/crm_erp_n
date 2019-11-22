<?php

session_start();



include_once './connection_sql.php';

function generateId($id, $ref, $switch) {

    if ($switch == "pre") {
        $temp = substr($id, strlen($ref));
        $id = (int) $temp;

        return $id;
    } else if ($switch == "post") {

        $temp = substr("0000000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}

if ($_GET["Command"] == "pass_quot") {

    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "SELECT * from delivery_note where REF_NO = '" . $cuscode . "'";  


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {
          
    $ResponseXML .= "<str_code><![CDATA[" . $row['REF_NO'] . "]]></str_code>";
    $ResponseXML .= "<cus_txt><![CDATA[" . $row['cus_txt'] . "]]></cus_txt>";
    $ResponseXML .= "<addr_txt><![CDATA[" . $row['addr_txt'] . "]]></addr_txt>";
    $ResponseXML .= "<costingref_txt><![CDATA[" . $row['costingref_txt'] . "]]></costingref_txt>";
    $ResponseXML .= "<sdate><![CDATA[" . $row['sdate'] . "]]></sdate>";
    $ResponseXML .= "<pono_txt><![CDATA[" . $row['pono_txt'] . "]]></pono_txt>";
    $ResponseXML .= "<jobno_txt><![CDATA[" . $row['jobno_txt'] . "]]></jobno_txt>";
    $ResponseXML .= "<dis_ref><![CDATA[" . $row['dis_ref'] . "]]></dis_ref>";

    
    $ResponseXML .= "<h1><![CDATA[" . $row['H1'] . "]]></h1>";
    $ResponseXML .= "<h2><![CDATA[" . $row['H2'] . "]]></h2>";
    $ResponseXML .= "<h3><![CDATA[" . $row['H3'] . "]]></h3>";
    $ResponseXML .= "<h4><![CDATA[" . $row['H4'] . "]]></h4>";
    $ResponseXML .= "<h5><![CDATA[" . $row['H5'] . "]]></h5>";

    $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

    }


    $sql3 = "SELECT * from delivery_note_table where REF_NO = '" . $cuscode . "'";



      foreach ($conn->query($sql3) as $row1) {

           
              
                $myObj->h1 = $row1['h1'];
                $myObj->h2 = $row1['h2'];
                $myObj->h3 = $row1['h3'];
                $myObj->h4 = $row1['h4'];
                $myObj->h5 = $row1['h5'];
                $myObj->h6 = $row1['h6'];
                
             $myJSON = json_encode($myObj);


            $ResponseXML .= "<jTable><![CDATA[" . $myJSON . "]]></jTable>";
                
           
        }

       
    

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {

    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                 <th>Ink Ref.</th>
                    <th>Average Cost</th>
                    <th>No. Of SQFT</th>    
                </tr>";

    $sql = "Select * from inkmaster where inkref <> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and inkref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and  avgcost like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and sqft like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= "ORDER BY inkref limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['inkref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['inkref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['avgcost'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sqft'] . "</a></td>
                              
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
