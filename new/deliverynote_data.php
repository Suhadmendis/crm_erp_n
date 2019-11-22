<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT deln FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['deln'];

    $tmpinvno = "000000" . $row["deln"];
    $lenth = strlen($tmpinvno);
    $no = trim("DELN/") . substr($tmpinvno, $lenth - 7);


    $uniq = uniqid();

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from delivery_note where REF_NO = '" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        $sql = "Insert into delivery_note(REF_NO,cus_txt,addr_txt,costingref_txt,jobno_txt,pono_txt,H1,H2,H3,H4,H5,sdate,dis_ref)values
                        ('" . $_GET['refno'] . "','" . $_GET['cus_txt'] . "','" . $_GET['addr_txt'] . "','" . $_GET['costingref_txt'] . "','" . $_GET['jobno_txt'] . "','" . $_GET['pono_txt'] . "','" . $_GET['H1'] . "','" . $_GET['H2'] . "','" . $_GET['H3'] . "','" . $_GET['H4'] . "','" . $_GET['H5'] . "','" . $_GET['date'] . "','" . $_GET['dis_ref'] . "')";
        $result = $conn->query($sql);
        
            $tableAry = json_decode($_GET['Jtable'],true);
            
            $size = sizeof(json_decode($_GET['Jtable'],true));
            

            for ($i=0; $i < $size ; $i++) { 
                $tableArysub = $tableAry[i];
                $sql = "Insert into delivery_note_table(REF_NO,H1,H2,H3,H4,H5)values
                        ('" . $_GET['refno'] . "','" . $tableAry[$i][$_GET['H1']] . "','" . $tableAry[$i][$_GET['H2']] . "','" . $tableAry[$i][$_GET['H3']] . "','" .$tableAry[$i][$_GET['H4']] . "','" .$tableAry[$i][$_GET['H5']] . "')";
                $result = $conn->query($sql);
// echo $sql;
            }



        $sql = "SELECT deln FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['deln'];
        $no2 = $no + 1;
        $sql = "update invpara set deln = $no2 where deln = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "update") {
    try {
        $sql = "update joborder set joborderref = '" . $_GET['joborderref'] . "',jobdate = '" . $_GET['joborderref'] . "',QuotationRef = '" . $_GET['QuotationRef'] . "',CostingRef = '" . $_GET['CostingRef'] . "',JobRequestRef = '" . $_GET['JobRequestRef'] . "',ManualRef = '" . $_GET['ManualRef'] . "',Customer = '" . $_GET['Customer'] . "',jobnew = '" . $_GET['jnew'] . "',MarketingEx = '" . $_GET['MarketingEx'] . "',RepeatPreviousJBNRef = '" . $_GET['RepeatPreviousJBNRef'] . "',ProductDescription = '" . $_GET['ProductDescription'] . "',Instructions = '" . $_GET['Instructions'] . "',CustomerPONo = '" . $_GET['CustomerPONo'] . "',JobQty = '" . $_GET['JobQty'] . "',Location = '" . $_GET['Location'] . "',SalesPrice = '" . $_GET['SalesPrice'] . "',TotalValue = '" . $_GET['TotalValue'] . "',joblength = '" . $_GET['jlength'] . "',jobwidth = '" . $_GET['jwidth'] . "',NoofColors = '" . $_GET['NoofColors'] . "',NoofImp = '" . $_GET['NoofImpressions'] . "'  where jid = '" . $_GET['jcode'] . "'";
        $result = $conn->query($sql);
        echo "Updated";
    } catch (Exception $e) {
        $conn->rollBack();
    }
}


if ($_GET["Command"] == "delete") {

    "delete from joborder where jid = '" . $_GET['jcode'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}


if ($_GET["Command"] == "cancel") {

    $sql = "update studentregistration set Cancel = '1'   where RecNo = '" . $_GET['RecNo'] . "'";
    $result = $conn->query($sql);
    echo "canceled";
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {



        if ($_GET["Command1"] == "add_tmp") {



            $sql = "Insert into joborder_table_temp(jcode,style,size,qty,remark,uniq)values
     ('" . $_GET['jcode'] . "','" . $_GET['style'] . "','" . $_GET['size'] . "','" . $_GET['qty'] . "','" . $_GET['remark'] . "','" . $_GET['uniq'] . "')";

            $result = $conn->query($sql);
        }

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>

                                  <th style='width: 20%;'>Style</th>
                                  <th style='width: 20%;'>Size</th>
                                  <th style='width: 10%;'>Qty</th>
                                  <th style='width: 50%;'>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type='text' placeholder='Style' id='style' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Size'  id='size' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Remark'  id='remark' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";
        $sql1 = "SELECT * FROM joborder_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['style'] . "</td><td>" . $row2['size'] . "</td><td>" . $row2['qty'] . "</td><td>" . $row2['remark'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]>";

        $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>

                                  <th style='width: 20%;'>Style</th>
                                  <th style='width: 20%;'>Size</th>
                                  <th style='width: 10%;'>Qty</th>
                                  <th style='width: 50%;'>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type='text' placeholder='Style' id='style' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Size'  id='size' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Qty'  id='qty' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Remark'  id='remark' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";
        $sql1 = "SELECT * FROM joborder_table_temp where uniq = '" . $_GET['uniq'] . "'";

        $qty = 0.00;
        foreach ($conn->query($sql1) as $row2) {

            $ResponseXML .= "<tr><td>" . $row2['style'] . "</td><td>" . $row2['size'] . "</td><td>" . $row2['qty'] . "</td><td>" . $row2['remark'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
       
            $qty = $qty + $row2['qty'];

        }

        $ResponseXML .= "</tbody></table>";
        $ResponseXML .= "</table>]]>";
        $ResponseXML .= "</sales_table>";
            
            // $ResponseXML .= "<qty><![CDATA[$qty]]></qty>";

        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}


?>
