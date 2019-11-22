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

    $sql = "select * from general where doc_ref= '" . $cuscode . "'";

    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<id><![CDATA[" . $row['doc_ref'] . "]]></id>";
        $ResponseXML .= "<str_customername1><![CDATA[" . $row['manual_no'] . "]]></str_customername1>";
        $ResponseXML .= "<str_customername2><![CDATA[" . $row['g_flag'] . "]]></str_customername2>";
        $ResponseXML .= "<str_customername3><![CDATA[" . $row['remarks'] . "]]></str_customername3>";
        $ResponseXML .= "<str_customername4><![CDATA[" . $row['notes'] . "]]></str_customername4>";
       

    }

  // $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Doc Ref</th>
                    <th>Manual Ref</th>
                   
                    
                </tr>";
    
     $sql = "Select * from general where doc_ref<> ''";
// 
    if ($_GET['cusno'] != "") {
        $sql .= " and doc_ref like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET[''] != "customername1") {
        $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
    }
//    if ($_GET['customername2'] != "") {
//        $sql .= " and address like '%" . $_GET['customername2'] . "%'";
//    }

    $sql .= " ORDER BY doc_ref limit 50";


    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['doc_ref'];
        //$stname = $_GET["stname"];

        $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode');\">" . $row['doc_ref'] . "</a></td>
                               <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              
                               
                            </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>
