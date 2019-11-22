<?php

session_start();

include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {
    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];
    $stname = $_GET["stname"];

    $sql = "Select * from vendor where CODE ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {
        $ResponseXML .= "<obj><![CDATA[" . json_encode($row) . "]]></obj>";
        $ResponseXML .= "<stname><![CDATA[" . $stname . "]]></stname>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {

 $stname = $_GET["stname"];
    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>Ref No.</th>
                    <th>Name</th>
                    <th>Telephone</th>
                </tr>";

    if ($stname == "sup") {
         $sql = "Select * from vendor_mas where VEN_CAT = 'S'";
    } else if ($stname == "cus") {
          $sql = "Select * from vendor_mas where VEN_CAT = 'C'";
    }

   

    if ($_GET['cusno'] != "") {
        $sql .= " and ref_id like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and name like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and tel like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= " ORDER BY ref_id limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['ref_id'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['ref_id'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['name'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['tel'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
