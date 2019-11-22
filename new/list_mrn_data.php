<?php

session_start();



include_once './connection_sql.php';



if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";






    if ($_GET['stname'] == "mrn") {



        if ($_GET['sdate'] == "") {
            $sql2 = "select * from view_z_list_mrn";
        } else {
            $sql2 = "select * from view_z_list_mrn where SDATE BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }


        $tb = "";

        $tb .= "<table id='example'  class='table table-bordered'>";

        $tb .= "<thead><tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";

        $tb .= "</tr></thead><tbody>";

        $temp1 = "ffcj";
        $temp2 = "";


        foreach ($conn->query($sql2) as $row) {


            $subsql = "select count(*) from view_z_list_mrn where REF_NO = '" . $row['REF_NO'] . "'";
            $resul = $conn->query($subsql);
            $row4 = $resul->fetch();
            $temp2 = $row['REF_NO'];


            if ($temp1 != $temp2) {
                $tb .= "<tr>               
                           <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['REF_NO'] . "</td>
                          <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['SDATE'] . "</td>
                           <td  rowspan=\"$row4[0]\"  onclick=\"custno('$cuscode');\">" . $row['JOB_NO'] . "</td>";


                $temp1 = $row['REF_NO'];
            }


            $tb .= "    <td>" . $row['STK_NO'] . "</td>
                           <td>" . $row['DESCRIPt'] . "</td>
                            <td>" . $row['QTY'] . "</td>
                            <td></td>
                             <td></td>
                              <td></td>
                        </tr>";
        }

        $tb .= "</tbody><tfoot>
              <tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";
        $tb .= "  </tr>
          </tfoot></table>";
    }
    if ($_GET['stname'] == "mrn_ink") {


        if ($_GET['sdate'] == "") {
            $sql2 = "select * from view_z_list_mrn_ink";
        } else {
            $sql2 = "select * from view_z_list_mrn_ink where SDATE BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }




        $tb = "";

        $tb .= "<table id='example'  class='table table-bordered'>";

        $tb .= "<thead><tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";

        $tb .= "</tr></thead><tbody>";

        $temp1 = "ffcj";
        $temp2 = "";


        foreach ($conn->query($sql2) as $row) {


            $subsql = "select count(*) from view_z_list_mrn_ink where REF_NO = '" . $row['REF_NO'] . "'";
            $resul = $conn->query($subsql);
            $row4 = $resul->fetch();
            $temp2 = $row['REF_NO'];


            if ($temp1 != $temp2) {
                $tb .= "<tr>               
                           <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['REF_NO'] . "</td>
                          <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['SDATE'] . "</td>
                           <td  rowspan=\"$row4[0]\"  onclick=\"custno('$cuscode');\">" . $row['JOB_NO'] . "</td>";


                $temp1 = $row['REF_NO'];
            }


            $tb .= "    <td>" . $row['STK_NO'] . "</td>
                           <td>" . $row['DESCRIPt'] . "</td>
                            <td>" . $row['QTY'] . "</td>
                            <td></td>
                             <td></td>
                              <td></td>
                        </tr>";
        }

        $tb .= "</tbody><tfoot>
              <tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";
        $tb .= "  </tr>
          </tfoot></table>";
    }
    if ($_GET['stname'] == "mrn_ex") {



        if ($_GET['sdate'] == "") {
            $sql2 = "select * from view_z_list_mrn_ex";
        } else {
            $sql2 = "select * from view_z_list_mrn_ex where SDATE BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }




        $tb = "";

        $tb .= "<table id='example'  class='table table-bordered'>";

        $tb .= "<thead><tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";

        $tb .= "</tr></thead><tbody>";

        $temp1 = "ffcj";
        $temp2 = "";


        foreach ($conn->query($sql2) as $row) {


            $subsql = "select count(*) from view_z_list_mrn_ex where REF_NO = '" . $row['REF_NO'] . "'";
            $resul = $conn->query($subsql);
            $row4 = $resul->fetch();
            $temp2 = $row['REF_NO'];


            if ($temp1 != $temp2) {
                $tb .= "<tr>               
                           <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['REF_NO'] . "</td>
                          <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['SDATE'] . "</td>
                           <td  rowspan=\"$row4[0]\"  onclick=\"custno('$cuscode');\">" . $row['JOB_NO'] . "</td>";


                $temp1 = $row['REF_NO'];
            }


            $tb .= "    <td>" . $row['STK_NO'] . "</td>
                           <td>" . $row['DESCRIPt'] . "</td>
                            <td>" . $row['QTY'] . "</td>
                            <td></td>
                             <td></td>
                              <td></td>
                        </tr>";
        }

        $tb .= "</tbody><tfoot>
              <tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";
        $tb .= "  </tr>
          </tfoot></table>";
    }
    if ($_GET['stname'] == "mrn_is") {
        if ($_GET['sdate'] == "") {
            $sql2 = "select * from view_z_list_mrn_i";
        } else {
            $sql2 = "select * from view_z_list_mrn_i where SDATE BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }





        $sql2 = "select * from view_z_list_mrn_i";

        $tb = "";

        $tb .= "<table id='example'  class='table table-bordered'>";

        $tb .= "<thead><tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";

        $tb .= "</tr></thead><tbody>";

        $temp1 = "ffcj";
        $temp2 = "";


        foreach ($conn->query($sql2) as $row) {


            $subsql = "select count(*) from view_z_list_mrn_i where REF_NO = '" . $row['REF_NO'] . "'";
            $resul = $conn->query($subsql);
            $row4 = $resul->fetch();
            $temp2 = $row['REF_NO'];


            if ($temp1 != $temp2) {
                $tb .= "<tr>               
                           <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['REF_NO'] . "</td>
                          <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['SDATE'] . "</td>
                           <td  rowspan=\"$row4[0]\"  onclick=\"custno('$cuscode');\">" . $row['JOB_NO'] . "</td>";


                $temp1 = $row['REF_NO'];
            }


            $tb .= "    <td>" . $row['STK_NO'] . "</td>
                           <td>" . $row['DESCRIPt'] . "</td>
                            <td>" . $row['QTY'] . "</td>
                            <td></td>
                             <td></td>
                              <td></td>
                        </tr>";
        }

        $tb .= "</tbody><tfoot>
              <tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";
        $tb .= "  </tr>
          </tfoot></table>";
    }

    if ($_GET['stname'] == "mrn_gn") {


        if ($_GET['sdate'] == "") {
            $sql2 = "select * from view_z_list_mrn_gn";
        } else {
            $sql2 = "select * from view_z_list_mrn_gn where SDATE BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
        }

        $tb = "";

        $tb .= "<table id='example'  class='table table-bordered'>";

        $tb .= "<thead><tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";

        $tb .= "</tr></thead><tbody>";

        $temp1 = "ffcj";
        $temp2 = "";


        foreach ($conn->query($sql2) as $row) {


            $subsql = "select count(*) from view_z_list_mrn_gn where REF_NO = '" . $row['REF_NO'] . "'";
            $resul = $conn->query($subsql);
            $row4 = $resul->fetch();
            $temp2 = $row['REF_NO'];


            if ($temp1 != $temp2) {
                $tb .= "<tr>               
                           <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['REF_NO'] . "</td>
                          <td  rowspan=\"$row4[0]\" onclick=\"custno('$cuscode');\">" . $row['SDATE'] . "</td>
                           <td  rowspan=\"$row4[0]\"  onclick=\"custno('$cuscode');\">" . $row['JOB_NO'] . "</td>";


                $temp1 = $row['REF_NO'];
            }


            $tb .= "    <td>" . $row['STK_NO'] . "</td>
                           <td>" . $row['DESCRIPt'] . "</td>
                            <td>" . $row['QTY'] . "</td>
                            <td></td>
                             <td></td>
                              <td></td>
                        </tr>";
        }

        $tb .= "</tbody><tfoot>
              <tr>";
        $tb .= "<th>MRN NO</th>";
        $tb .= "<th>DATE</th>";
        $tb .= "<th>JB NO</th>";
        $tb .= "<th>Item Code</th>";
        $tb .= "<th>Item name</th>";
        $tb .= "<th>Requested Qty</th>";
        $tb .= "<th>Balance</th>";
        $tb .= "<th>Entered By</th>";
        $tb .= "<th>Time and date</th>";
        $tb .= "  </tr>
          </tfoot></table>";
    }

    $ResponseXML .= "<td><![CDATA[" . $tb . "]]></td>";
    $ResponseXML .= "<stname><![CDATA[" . $_GET['stname'] . "]]></stname>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}
?>
