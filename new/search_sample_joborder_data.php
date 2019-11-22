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

    $sql = "Select * from samplejoborder where SJRequestNo ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<id><![CDATA[" . generateId($row['SJRequestNo'], "SJO/", "post") . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . generateId($row['sjbref'], "SJO/", "post") . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['customer'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['jodate'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['mkex'] . "]]></str_customername4>";
        $ResponseXML .= "<stnme><![CDATA[" . $_GET['stnme'] . "]]></stnme>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {

    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                 <th>SJ Request No</th>
                    <th>SJB Ref</th>
                    <th>Customer</th> 
                </tr>";

    $sql = "Select * from samplejoborder where SJRequestNo <> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and SJRequestNo like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and  sjbref like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and customer like '%" . $_GET['customername2'] . "%'";
    }

    $sql .= "ORDER BY SJRequestNo limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['SJRequestNo'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
            
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['SJRequestNo'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['sjbref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['customer'] . "</a></td>
                              
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
