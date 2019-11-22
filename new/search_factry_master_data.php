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

    $sql = "Select * from factrymaster where factryref ='" . $cuscode . "'";




    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['factryref'] . "]]></id>";

        $ResponseXML .= "<str_customername1><![CDATA[" . $row['factryname'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['factrydiscription'] . "]]></str_customername2>";
    }


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";




    $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                <th>Factry Ref.</th>
                    <th>Factry Name</th>
                    <th>Factry Description</th>
                  
                </tr>";

    $sql = "Select * from factrymaster where factryref <> ''";



    if ($_GET['cusno'] != "") {
        $sql .= " and factryref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and factryname like '%" . $_GET['customername1'] . "%'";
    }
    if ($_GET['customername2'] != "") {
        $sql .= " and factrydiscription like '%" . $_GET['customername2'] . "%'";
    }


    $sql .= " ORDER BY factryref limit 50 ";

    //$sql .= " ORDER BY CourseCode limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['factryref'];

        $stname = $_GET["stname"];

        $ResponseXML .= "<tr>    
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['factryref'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['factryname'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['factrydiscription'] . "</a></td>
                           
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
