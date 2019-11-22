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

    $sql = "SELECT * from s_mas where STK_NO = '" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {
          $ResponseXML .= "<str_code><![CDATA[" . generateId($row['STK_NO'], "PREINK/", "post") . "]]></str_code>";
    $ResponseXML .= "<GROUP2><![CDATA[" . $row['GROUP2'] . "]]></GROUP2>";
    $ResponseXML .= "<GROUP3><![CDATA[" . $row['GROUP3'] . "]]></GROUP3>";
    $ResponseXML .= "<DESCRIPT><![CDATA[" . $row['DESCRIPT'] . "]]></DESCRIPT>";
    $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

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
