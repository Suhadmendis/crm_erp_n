<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT jobcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['jobcode'];

    $tmpinvno = "000000" . $row["jobcode"];
    $lenth = strlen($tmpinvno);
    $no = trim("JBN/") . substr($tmpinvno, $lenth - 7);


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

        $sql = "delete from joborder where jid = '" . $_GET['jcode'] . "'";
        $result = $conn->query($sql);

        $sql = "Insert into joborder(jid,joborderref,jobdate,QuotationRef,CostingRef,JobRequestRef,ManualRef,Customer,jobnew,jrepeat,MarketingEx,RepeatPreviousJBNRef,ProductDescription,Instructions,CustomerPONo,JobQty,Location,SalesPrice,TotalValue,joblength,jobwidth,NoofColors,NoofImp,trf_qty)values
                        ('" . $_GET['jcode'] . "','" . $_GET['joborderref'] . "','" . $_GET['jdate'] . "','" . $_GET['QuotationRef'] . "','" . $_GET['CostingRef'] . "','" . $_GET['JobRequestRef'] . "','" . $_GET['ManualRef'] . "','" . $_GET['Customer'] . "','" . $_GET['jnew'] . "','" . $_GET['jrepeat'] . "','" . $_GET['MarketingEx'] . "','" . $_GET['RepeatPreviousJBNRef'] . "','" . $_GET['ProductDescription'] . "','" . $_GET['Instructions'] . "','" . $_GET['CustomerPONo'] . "','" . $_GET['JobQty'] . "','" . $_GET['Location'] . "','" . $_GET['SalesPrice'] . "','" . $_GET['TotalValue'] . "','" . $_GET['jlength'] . "','" . $_GET['jwidth'] . "','" . $_GET['NoofColors'] . "','" . $_GET['NoofImpressions'] . "','" . 0 . "')";
        $result = $conn->query($sql);




        $sql2 = "SELECT * FROM joborder_table_temp where uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {

            $sql = "Insert into joborder_table(jcode,style,size,qty,remark,uniq)values
             ('" . $row['jcode'] . "','" . $row['style'] . "','" . $row['size'] . "','" . $row['qty'] . "','" . $row['remark'] . "','" . $row['uniq'] . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM joborder_table_temp where uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }



                $tableArray = $_GET['tableArray'];
                $arrElement = explode("R%T", $tableArray);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);

                $var1 = 0;

                for ($x = 1; $x < $_GET['rowLength']; $x++) {
                    $sql = "Insert into joborder_mat_table_temp (item_code, item_name, tot_qty, was_qty, qty, jcode)values
        			         ('" . $arrElement[$var1] . "','" . $arrElement[$var1+1] . "', '" . $arrElement[$var1+2] . "','" . $arrElement[$var1+3] . "','" . $arrElement[$var1+4] . "','" . $_GET['jcode'] . "') ";
                    $result = $conn->query($sql);
                    $var1 = $var1 + 6;
                }


                $tableArray = $_GET['tableArray1'];
                $arrElement = explode("R%T", $tableArray);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                array_shift($arrElement);
                // array_shift($arrElement);

                $var1 = 0;

                for ($x = 0; $x < $_GET['rowLength1']; $x++) {
                    $sql = "Insert into joborder_lab_table_temp (item_code, item_name, lab_h, adjust, tot_lab_h, jcode)values
                       ('" . $arrElement[$var1] . "','" . $arrElement[$var1+1] . "', '" . $arrElement[$var1+2] . "','" . $arrElement[$var1+3] . "','" . $arrElement[$var1+4] . "','" . $_GET['jcode'] . "') ";
                    $result = $conn->query($sql);
                    $var1 = $var1 + 5;
                }



        $sql = "SELECT jobcode FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['jobcode'];
        $no2 = $no + 1;
        $sql = "update invpara set jobcode = $no2 where jobcode = $no";
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
