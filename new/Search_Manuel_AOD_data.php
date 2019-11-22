<?php

session_start();



include_once './connection_sql.php';



if ($_GET["Command"] == "search_aod") {


    $ResponseXML = "";




    $ResponseXML .= "<table id=\"testTable\"  class=\"table table-bordered\">";

    $ResponseXML .= "<thead><tr>";
    $ResponseXML .= "<th>MAOD NO</th>";
    $ResponseXML .= "<th>Date</th>";
    $ResponseXML .= "<th>Customer / Supplier</th>";
    $ResponseXML .= "<th>Name</th>";
    $ResponseXML .= "<th>Item</th>";
    $ResponseXML .= "<th>Qty</th>";

    $ResponseXML .= "</tr>";

    $ResponseXML .= "</thead><tbody>";




    $sql = "Select * from manuel_aod where aod_number <> ''";

    if ($_GET['maod'] != "") {
        $sql .= " and aod_number like '%" . $_GET['maod'] . "%'";
    }
    if ($_GET['date'] != "") {
        $sql .= " and dod like '%" . $_GET['date'] . "%'";
    }
    if ($_GET['customer'] != "") {
        $sql .= " and type like '%" . $_GET['customer'] . "%'";
    }
    if ($_GET['name'] != "") {
        $sql .= " and Name like '%" . $_GET['name'] . "%'";
    }
    if ($_GET['item'] != "") {
        $sql .= " and Product_Des like '%" . $_GET['item'] . "%'";
    }
    if ($_GET['qty'] != "") {
        $sql .= " and QTY like '%" . $_GET['qty'] . "%'";
    }

    $sql .= " ORDER BY aod_number limit 50 ";



    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['aod_number'];
        $code = $row['aod_number'];
        $sql3 = "select * from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";


        $sql4 = "select count(aodnumber) from manuel_aod_table where aodnumber = '" . $row['aod_number'] . "'";
        $resul = $conn->query($sql4);
        $row4 = $resul->fetch();


        $type = "";
        if ($row['type'] == "CUSTOMER") {
            $type = "CUS";
        } else {
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




        if ($row4[0] == 0) {
            $ResponseXML .= "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>";
        } else {
            $ResponseXML .= "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['dod'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['type'] . "</a></td>                              
                              <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Name'] . "</a></td>";
        }



        foreach ($conn->query($sql3) as $row1) {

            if ($row1['Product_Des'] == "") {
                $ResponseXML .= " <td onclick=\"custno('$code');\">&nbsp;</td>
                              <td onclick=\"custno('$code');\">&nbsp;</td>
                            </tr>";
            } else {
                $ResponseXML .= " <td onclick=\"custno('$code');\">" . $row1['Product_Des'] . "</a></td>
                              <td onclick=\"custno('$code');\">" . $row1['QTY'] . "</a></td>
                            </tr>";
            }
        }
    }
    $ResponseXML .= "</tbody></table>";














   



    echo $ResponseXML;
}


if ($_GET["Command"] == "pass_quot") {




    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from manuel_aod where aod_number ='" . $cuscode . "'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


        $ResponseXML .= "<id><![CDATA[" . $row['aod_number'] . "]]></id>";
        $ResponseXML .= "<str1><![CDATA[" . $row['Name'] . "]]></str1>";
        $ResponseXML .= "<str2><![CDATA[" . $row['Address'] . "]]></str2>";
        $ResponseXML .= "<str3><![CDATA[" . $row['ncp'] . "]]></str3>";
        $ResponseXML .= "<str4><![CDATA[" . $row['tel'] . "]]></str4>";
        $ResponseXML .= "<str5><![CDATA[" . $row['dod'] . "]]></str5>";
        $ResponseXML .= "<str6><![CDATA[" . $row['nod'] . "]]></str6>";
        $ResponseXML .= "<str7><![CDATA[" . $row['sono'] . "]]></str7>";
        $ResponseXML .= "<str8><![CDATA[" . $row['type'] . "]]></str8>";
    }
 $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "updateTable") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql1 = "SELECT * FROM manuel_aod_table WHERE aodnumber = '" . $_GET['aodnumber'] . "'";


    $qty = "QTY";


    $rows .= "<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Customer Purchase Order No.</th>
                                    <th style='width: 70%;'>Product Description</th>
                                    <th style='width: 15%;'>QTY</th>
                                    <th style='width: 5%;'>Item</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='Customer Purchase Order No.' id='Customer_Order_number' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Product Description'  id='Product_Des' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input   type='text' placeholder='QTY'  id='QTY' class='form-control input-sm'>
                                    </td>
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";


    foreach ($conn->query($sql1) as $row2) {

        $rows .= "<tr><td>" . $row2['Customer_Order_number'] . "</td><td>" . $row2['Product_Des'] . "</td><td>" . $row2['QTY'] . "</td><td></td></tr>";
    }


    $rows .= "</tbody>

                        </table>";



    $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}
?>
