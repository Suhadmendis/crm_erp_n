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


    $sql = "Select * from deptinfo where dpt_no ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<id><![CDATA[" . $row['dpt_no'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['dpt_name'] . "]]></str_customername1>";
        $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>Dept No.</th>
                   <th>Department Name</th>
                </tr>";


    $sql = "Select * from deptinfo where dpt_no<> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and dpt_no like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and dpt_name like '%" . $_GET['customername1'] . "%'";
    }
  
    $sql .= " ORDER BY dpt_no limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['dpt_no'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['dpt_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['dpt_name'] . "</a></td>
                         </tr>";
    }

    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
