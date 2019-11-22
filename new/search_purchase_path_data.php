<?php

session_start();



include_once './connection_sql.php';

if ($_GET["Command"] == "pass_quot") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $stname = $_GET["stname"];
    $ResponseXML = "";
    $ResponseXML .= "<new>";

    if ($stname == "PORN") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from po_requisition_note_dummy where reference_no =  '" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['reference_no'];
        $name = $row['date'];
        $adress = $row['manual_no'];
        $date_of_birth = $row['remarks'];
        $uniq = $row['uniq'];

        $ResponseXML .= "<id><![CDATA[$no]]></id>";
        $ResponseXML .= "<name><![CDATA[$name]]></name>";
        $ResponseXML .= "<adress><![CDATA[$adress]]></adress>";
        $ResponseXML .= "<date_of_birth><![CDATA[$date_of_birth]]></date_of_birth>";
        $ResponseXML .= "<id><![CDATA[$no]]></id>";
        $ResponseXML .= "<id><![CDATA[$uniq]]></id>";

        // $sql1 = "Select * from po_requisition_note_dummy_table where uniq =  '" . $uniq . "'";
        //     $result2 = $conn->query($sql1);
        //     $row2 = $result2->fetch();
        //     $tamp_reference_no = $row2['reference_no'];
        //     $tamp_rec_no = $row2['rec_no'];
        //     $tamp_reproduct_code = $row2['product_code'];
        //     $temp_qty = $row2['qty'];
        //     $temp_uniq = $row2['uniq'];
        //    $ResponseXML .= "<id><![CDATA[$tamp_reference_no]]></id>";
        //    $ResponseXML .= "<name><![CDATA[$tamp_rec_no]]></name>";
        //    $ResponseXML .= "<adress><![CDATA[$tamp_reproduct_code]]></adress>";
        //    $ResponseXML .= "<date_of_birth><![CDATA[$temp_qty]]></date_of_birth>";
        //    $ResponseXML .= "<id><![CDATA[$temp_uniq]]></id>";
    } else if ($stname == "POED") {

        $cuscode = $_GET["custno"];

        $sql = "Select * from purchase_order_entry_dummy where reference_no =  '" . $cuscode . "'";

        $result = $conn->query($sql);
        $row = $result->fetch();

        $reference_no = $row['reference_no'];
        $manual_no = $row['manual_no'];
        $code1 = $row['code1'];
        $date = $row['date'];
        $currency_code = $row['currency_code'];
        $exchange_rate = $row['exchange_rate'];
        $taransport = $row['taransport'];
        $supplier = $row['supplier'];
        $parame_components = $row['parame_components'];
        $cost_centre = $row['cost_centre'];
        $consoalidate_cost_center = $row['consoalidate_cost_center'];
        $remarks = $row['remarks'];
        $non = $row['non'];
        $job_no = $row['job_no'];
        $tax_combination = $row['tax_combination'];
        $non_tax = $row['non_tax'];
        $total_discount = $row['total_discount'];
        $total_tax = $row['total_tax'];
        $total_value = $row['total_value'];

        $ResponseXML .= "<reference_no><![CDATA[$reference_no]]></reference_no>";
        $ResponseXML .= "<manual_no><![CDATA[$manual_no]]></manual_no>";
        $ResponseXML .= "<code1><![CDATA[$code1]]></code1>";
        $ResponseXML .= "<date><![CDATA[$date]]></date>";
        $ResponseXML .= "<currency_code><![CDATA[$currency_code]]></currency_code>";
        $ResponseXML .= "<exchange_rate><![CDATA[ $exchange_rate]]></exchange_rate>";
        $ResponseXML .= "<taransport><![CDATA[$taransport]]></taransport>";
        $ResponseXML .= "<supplier><![CDATA[$supplier]]></supplier>";
        $ResponseXML .= "<parame_components><![CDATA[$parame_components]]></parame_components>";
        $ResponseXML .= "<cost_centre><![CDATA[$cost_centre]]></cost_centre>";
        $ResponseXML .= "<consoalidate_cost_center><![CDATA[$consoalidate_cost_center]]></consoalidate_cost_center>";
        $ResponseXML .= "<remarks><![CDATA[$remarks]]></remarks>";
        $ResponseXML .= "<non><![CDATA[$non]]></non>";
        $ResponseXML .= "<job_no><![CDATA[$job_no]]></job_no>";
        $ResponseXML .= "<tax_combination><![CDATA[$tax_combination]]></tax_combination>";
        $ResponseXML .= "<non_tax><![CDATA[$non_tax]]></non_tax>";
        $ResponseXML .= "<total_discount><![CDATA[$total_discount]]></total_discount>";
        $ResponseXML .= "<total_tax><![CDATA[$total_tax]]></total_tax>";
        $ResponseXML .= "<total_value><![CDATA[$total_value]]></total_value>";
    } else if ($stname == "SIVE") {

        $cuscode = $_GET["custno"];

        $sql = "Select * from service_invoice where reference_no =  '" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $reference_no = $row['reference_no'];
        $date = $row['date'];
        $dummy_po_no = $row['dummy_po_no'];
        $currency_code = $row['currency_code'];
        $currency_rate = $row['currency_rate'];
        $manual_no = $row['manual_no'];
        $suppler_code = $row['suppler_code'];
        $katuwana_pvt = $row['katuwana_pvt'];
        $net_amount = $row['net_amount'];
        $tax_combination_code = $row['tax_combination_code'];
        $consoalidate_cost = $row['consoalidate_cost'];
        $tax_amount = $row['tax_amount'];
        $total_credt_amount = $row['total_credt_amount'];
        $balance_amount_to_be_alocated = $row['balance_amount_to_be_alocated'];
        $remarks = $row['remarks'];

        $ResponseXML .= "<reference_no><![CDATA[$reference_no]]></reference_no>";
        $ResponseXML .= "<date><![CDATA[$date]]></date>";
        $ResponseXML .= "<dummy_po_no><![CDATA[$dummy_po_no]]></dummy_po_no>";
        $ResponseXML .= "<currency_code><![CDATA[$currency_code]]></currency_code>";
        $ResponseXML .= "<currency_rate><![CDATA[$currency_rate]]></currency_rate>";
        $ResponseXML .= "<manual_no><![CDATA[$manual_no]]></manual_no>";
        $ResponseXML .= "<suppler_code><![CDATA[$suppler_code]]></suppler_code>";
        $ResponseXML .= "<katuwana_pvt><![CDATA[$katuwana_pvt]]></katuwana_pvt>";
        $ResponseXML .= "<net_amount><![CDATA[$net_amount]]></net_amount>";
        $ResponseXML .= "<tax_combination_code><![CDATA[$tax_combination_code]]></tax_combination_code>";
        $ResponseXML .= "<consoalidate_cost><![CDATA[$consoalidate_cost]]></consoalidate_cost>";
        $ResponseXML .= "<tax_amount><![CDATA[$tax_amount]]></tax_amount>";
        $ResponseXML .= "<total_credt_amount><![CDATA[$total_credt_amount]]></total_credt_amount>";
        $ResponseXML .= "<balance_amount_to_be_alocated><![CDATA[$balance_amount_to_be_alocated]]></balance_amount_to_be_alocated>";
        $ResponseXML .= "<remarks><![CDATA[$remarks]]></remarks>";
    } else if ($stname == "GRN") {

        $cuscode = $_GET["custno"];
        $sql = "SELECT * from good_received_note_entry where reference_no='" . $cuscode . "'";
        $result = $conn->query($sql);
        $row = $result->fetch();

        $reference_nos = $row['reference_no'];
        $date = $row['date'];
        $purchase_order_no = $row['purchase_order_no'];
        $manual_ref_no = $row['manual_no'];
        $currency_codes = $row['currency_code'];
        $dexchange_rates = $row['exchange_rate'];
        $suppler_codes = $row['supplier_code'];
        $consoalidate_cost_centers = $row['consoalidate_cost_center'];
        $cost_centres = $row['cost_centre'];
        $textfileds = $row['textfiled'];
        $remarkss = $row['remarks'];
        $textfiled2s = $row['textfiled2'];
        $tax_combination_codes = $row['tax_combination_code'];
        $textfiled3s = $row['textfiled3'];
        $total_discounts = $row['total_discount'];
        $total_taxs = $row['total_tax'];
        $total_values = $row['total_value'];

        $ResponseXML .= "<reference_no><![CDATA[$reference_nos]]></reference_no>";
        $ResponseXML .= "<date><![CDATA[$date]]></date>";
        $ResponseXML .= "<purchase_order_no><![CDATA[$purchase_order_no]]></purchase_order_no>";
        $ResponseXML .= "<manual_ref_no><![CDATA[$manual_ref_no]]></manual_ref_no>";
        $ResponseXML .= "<currency_code><![CDATA[$currency_codes]]></currency_code>";
        $ResponseXML .= "<dexchange_rate><![CDATA[$dexchange_rates]]></dexchange_rate>";
        $ResponseXML .= "<suppler_codes><![CDATA[$suppler_codes]]></suppler_codes>";
        $ResponseXML .= "<consoalidate_cost_center><![CDATA[$consoalidate_cost_centers]]></consoalidate_cost_center>";
        $ResponseXML .= "<cost_centre><![CDATA[$cost_centres]]></cost_centre>";
        $ResponseXML .= "<textfiled><![CDATA[$textfileds]]></textfiled>";
        $ResponseXML .= "<remarks><![CDATA[$remarkss]]></remarks>";
        $ResponseXML .= "<textfiled2><![CDATA[$textfiled2s]]></textfiled2>";
        $ResponseXML .= "<tax_combination_code><![CDATA[$tax_combination_codes]]></tax_combination_code>";
        $ResponseXML .= "<textfiled3><![CDATA[$textfiled3s]]></textfiled3>";
        $ResponseXML .= "<total_discount><![CDATA[$total_discounts]]></total_discount>";
        $ResponseXML .= "<total_tax><![CDATA[$total_taxs]]></total_tax>";
        $ResponseXML .= "<total_value><![CDATA[$total_values]]></total_value>";
    } else if ($stname == "PRNTR") {

        $cuscode = $_GET["custno"];
        $sql = "select * from po_requistion_note where reference_no= '" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<reference_no><![CDATA[" . $row['reference_no'] . "]]></reference_no>";
            $ResponseXML .= "<manual_no><![CDATA[" . $row['manual_no'] . "]]></manual_no>";
            $ResponseXML .= "<remarks><![CDATA[" . $row['remarks'] . "]]></remarks>";
            $ResponseXML .= "<date><![CDATA[" . $row['date'] . "]]></date>";
            $ResponseXML .= "<job_no><![CDATA[" . $row['job_no'] . "]]></job_no>";
            $ResponseXML .= "<dummy><![CDATA[" . $row['dummy'] . "]]></dummy>";
        }
    } else if ($stname == "POSER") {

        $cuscode = $_GET["custno"];

        $sql = "select * from purchase_order_entry where reference_no= '" . $cuscode . "'";

        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {

            $ResponseXML .= "<reference_no><![CDATA[" . $row['reference_no'] . "]]></reference_no>";
            $ResponseXML .= "<manual_no><![CDATA[" . $row['manual_no'] . "]]></manual_no>";
            $ResponseXML .= "<po_requisition><![CDATA[" . $row['po_requisition'] . "]]></po_requisition>";
            $ResponseXML .= "<date><![CDATA[" . $row['date'] . "]]></date>";
            $ResponseXML .= "<currency_code><![CDATA[" . $row['currency_code'] . "]]></currency_code>";
            $ResponseXML .= "<exchange_rate><![CDATA[" . $row['exchange_rate'] . "]]></exchange_rate>";
            // $ResponseXML .= "<transport><![CDATA[" . $row['transport'] . "]]></transport>";
            $ResponseXML .= "<supplier><![CDATA[" . $row['supplier'] . "]]></supplier>";
            $ResponseXML .= "<cost_centre><![CDATA[" . $row['cost_centre'] . "]]></cost_centre>";
            $ResponseXML .= "<remarks><![CDATA[" . $row['remarks'] . "]]></remarks>";
            $ResponseXML .= "<tax_combination><![CDATA[" . $row['tax_combination'] . "]]></tax_combination>";
        }
    } else if ($stname == "SUBCONTRACTOR") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from subcontractordtls where reference_no= '" . $cuscode . "'";

        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {

            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['reference_no'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['scdate'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['scpono'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['tax'] . "]]></str_customername4>";
            $ResponseXML .= "<str_customername5><![CDATA[" . $row['account'] . "]]></str_customername5>";
            $ResponseXML .= "<str_customername6><![CDATA[" . $row['remarks'] . "]]></str_customername6>";
        }
    } else if ($stname == "PAYMENTVOUCHER") {

        $cuscode = $_GET["custno"];
        $sql = "Select * from paymentvoucher where reference_no = '" . $cuscode . "'";

        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {

            $ResponseXML .= "<id><![CDATA[" . $row['reference_no'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['pvdate'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['currencycode'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['manualno'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['supliercode'] . "]]></str_customername4>";
            $ResponseXML .= "<str_customername5><![CDATA[" . $row['payee'] . "]]></str_customername5>";
            $ResponseXML .= "<str_customername6><![CDATA[" . $row['cash_bankaccount'] . "]]></str_customername6>";
            $ResponseXML .= "<str_customername7><![CDATA[" . $row['remarks'] . "]]></str_customername7>";
        }
    } else if ($stname == "GRNNOTE") {

        $cuscode = $_GET["custno"];
        $sql = "select * from good_return_note_entry where reference_no= '" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<reference_no><![CDATA[" . $row['reference_no'] . "]]></reference_no>";
            $ResponseXML .= "<manual_no><![CDATA[" . $row['manual_no'] . "]]></manual_no>";
            $ResponseXML .= "<date><![CDATA[" . $row['date'] . "]]></date>";
            $ResponseXML .= "<currency_code><![CDATA[" . $row['currency_code'] . "]]></currency_code>";
            $ResponseXML .= "<exchange_rate><![CDATA[" . $row['exchange_rate'] . "]]></exchange_rate>";
            $ResponseXML .= "<supplier><![CDATA[" . $row['supplier'] . "]]></supplier>";
            $ResponseXML .= "<location_code><![CDATA[" . $row['location_code'] . "]]></location_code>";
            $ResponseXML .= "<cost_centre><![CDATA[" . $row['cost_centre'] . "]]></cost_centre>";
            $ResponseXML .= "<remarks><![CDATA[" . $row['remarks'] . "]]></remarks>";
        }
    } else if ($stname == "GRNRECEIVED") {

        $cuscode = $_GET["custno"];
        $sql = "select * from good_received_note_ent where reference_no= '" . $cuscode . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {

            $ResponseXML .= "<reference_no><![CDATA[" . $row['reference_no'] . "]]></reference_no>";
            $ResponseXML .= "<date><![CDATA[" . $row['date'] . "]]></date>";
            $ResponseXML .= "<purchase_order_no><![CDATA[" . $row['purchase_order_no'] . "]]></purchase_order_no>";
            // $ResponseXML .= "<transport><![CDATA[" . $row['transport'] . "]]></transport>";
            $ResponseXML .= "<manual_no><![CDATA[" . $row['manual_no'] . "]]></manual_no>";
            $ResponseXML .= "<currency_code><![CDATA[" . $row['currency_code'] . "]]></currency_code>";
            $ResponseXML .= "<exchange_rate><![CDATA[" . $row['exchange_rate'] . "]]></exchange_rate>";
            $ResponseXML .= "<supplier_code><![CDATA[" . $row['supplier_code'] . "]]></supplier_code>";
            $ResponseXML .= "<location_code><![CDATA[" . $row['location_code'] . "]]></location_code>";
            $ResponseXML .= "<cost_centre><![CDATA[" . $row['cost_centre'] . "]]></cost_centre>";
            $ResponseXML .= "<remarks><![CDATA[" . $row['remarks'] . "]]></remarks>";
            $ResponseXML .= "<tax_combination><![CDATA[" . $row['tax_combination'] . "]]></tax_combination>";
        }
    } else if ($stname == "GRNDETAILS") {

        $cuscode = $_GET["custno"];

        $sql = "Select * from grndetails where referenceno ='" . $cuscode . "' and cancel='0'";

        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            $ResponseXML .= "<id><![CDATA[" . $row['referenceno'] . "]]></id>";
            $ResponseXML .= "<str_customername1><![CDATA[" . $row['grndate'] . "]]></str_customername1>";
            $ResponseXML .= "<str_customername2><![CDATA[" . $row['manualrefno'] . "]]></str_customername2>";
            $ResponseXML .= "<str_customername3><![CDATA[" . $row['purchasingorderno'] . "]]></str_customername3>";
            $ResponseXML .= "<str_customername4><![CDATA[" . $row['currencycode'] . "]]></str_customername4>";
            $ResponseXML .= "<str_customername5><![CDATA[" . $row['exchange'] . "]]></str_customername5>";
            $ResponseXML .= "<str_customername6><![CDATA[" . $row['suppliercode'] . "]]></str_customername6>";
            $ResponseXML .= "<str_customername7><![CDATA[" . $row['costcenter'] . "]]></str_customername7>";
            $ResponseXML .= "<str_customername8><![CDATA[" . $row['remarks'] . "]]></str_customername8>";
            $ResponseXML .= "<str_customername9><![CDATA[" . $row['textcombination'] . "]]></str_customername9>";
        }
    }

    $ResponseXML .= "<stname><![CDATA[$stname]]></stname>";
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "updateTable") {

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $stname = $_GET["stname"];
    $ResponseXML = "";
    $ResponseXML .= "<new>";

    if ($stname == "PORN") {

        $sql = "SELECT * FROM po_requisition_note_dummy_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 20%;'>Rec No.</th>
                                        <th style='width: 50%;'>Product Code</th>
                                        <th style='width: 20%;'>Qty</th>
                                        <th style='width: 15%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>                                                                           
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM po_requisition_note_dummy_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {
            $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
//   
    } else if ($stname == "") {
        
    } else if ($stname == "") {
        
    } else if ($stname == "") {
        
    } else if ($stname == "") {
        
    } else if ($stname == "PRNTR") {

        $sql = "SELECT * FROM po_requistion_note_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 10%;'>Rec No</th>
                                        <th style='width: 20%;'>Product Code</th>
                                        <th style='width: 40%;'>Product Description</th>
                                        <th style='width: 20%;'>Quantity</th>
                                        <th style='width: 10%;'>UOM</th>
                                        <th style='width: 10%;'>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                       <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='UOM'  id='umo' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

                                </tr>";

        $sql1 = "SELECT * FROM po_requistion_note_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['umo'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "POSER") {

        $sql = "SELECT * FROM purchase_order_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                           <th style='width: 10%;'>Rec No</th>
                                           <th style='width: 10%;'>Product Code</th>
                                           <th style='width: 10%;'>Product Description</th>
                                           <th style='width: 10%;'>Req.Bal</th>
                                           <th style='width: 10%;'>Quantity</th>
                                           <th style='width: 10%;'>Purchase Price</th>
                                           <th style='width: 10%;'>Discount</th>
                                           <th style='width: 10%;'>Value</th>
                                           <th style='width: 10%;'>Tax Combination</th>
                                           <th style='width: 10%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                     <td>
                                         <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Req_Bal'  id='req_bal' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                         <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='po_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_Text' class='form-control input-sm'>
                                        </td>
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>

   
                                </tr>";

        $sql1 = "SELECT * FROM purchase_order_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['req_bal'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['po_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "GRNRECEIVED") {

        $sql = "SELECT * FROM good_received_note_ent_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 5%;'>Rec No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Local Price</th>
                                    <th style='width: 10%;'>Discount</th>
                                    <th style='width: 10%;'>import Exp</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 10%;'>Tax Combination</th>
                                    <th style='width: 5%;'>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Local Price'  id='local_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Import EXP'  id='import_exp' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='value'  id='grn_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Combination'  id='tax_combination_txt' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";

        $sql1 = "SELECT * FROM good_received_note_ent_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['local_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['import_exp'] . "</td><td>" . $row2['grn_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    } else if ($stname == "GRNNOTE") {

        $sql = "SELECT * FROM good_return_note_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                    <th style='width: 10%;'>Rec No</th>
                                    <th style='width: 10%;'>GRN No</th>
                                    <th style='width: 10%;'>Product Code</th>
                                    <th style='width: 10%;'>Product Description</th>
                                    <th style='width: 10%;'>Quantity</th>
                                    <th style='width: 10%;'>Purchase Price</th>
                                    <th style='width: 10%;'>Local Price</th>
                                    <th style='width: 10%;'>Discount%</th>
                                    <th style='width: 10%;'>Value</th>
                                    <th style='width: 5%;'>Tax Combination</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>
                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='GRN No'  id='grn_no' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Local Price'  id='local_price' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Value'  id='grn_value' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Tax Combination'  id='tax_combination_text' class='form-control input-sm'>
                                        </td>
                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";

        $sql1 = "SELECT * FROM good_return_note_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

            $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['grn_no'] . "</td><td>" . $row2['product_code'] . "</td><td>" . $row2['product_description'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['purchase_price'] . "</td><td>" . $row2['local_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['grn_value'] . "</td><td>" . $row2['tax_combination'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    }else if ($stname == "POED") {

        $sql = "SELECT * FROM purchase_order_entry_dummy_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 15%;'>Quantity</th>
                                        <th style='width: 15%;'>parchase Price</th>
                                        <th style='width: 15%;'>Discount %</th>
                                        <th style='width: 15%;'>Value</th>
                                        <th style='width: 12%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                   <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='parchase Price'  id='parchase_price_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount %'  id='discount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='value_Text' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM purchase_order_entry_dummy_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

             $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_de'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['parchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['value_s'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    }else if ($stname == "GRN") {

        $sql = "SELECT * FROM good_received_note_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Product Description</th>
                                        <th style='width: 10%;'>Quantity</th>
                                        <th style='width: 10%;'>parchase Price</th>
                                        <th style='width: 10%;'>Discount %</th>
                                        <th style='width: 15%;'>Value</th>
                                        <th style='width: 15%;'>Tax Combination Code</th>
                                        <th style='width: 12%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Product Description'  id='Product_Des_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Quantity'  id='quantity_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='parchase Price'  id='parchase_price_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Discount %'  id='discount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Value'  id='value_Text' class='form-control input-sm'>
                                        </td> 
                                        <td>
                                            <input  type='text' placeholder='Tax Combination Code'  id='tax_combination_code_Text' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM good_received_note_entry_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

              $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['product_de'] . "</td><td>" . $row2['quantity'] . "</td><td>" . $row2['parchase_price'] . "</td><td>" . $row2['discount'] . "</td><td>" . $row2['value_s'] ."</td><td>" . $row2['tax_combination_code'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    }else if ($stname == "SIVE") {

        $sql = "SELECT * FROM service_invoice_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        $rows .= "<br><table id='myTable' class='table table-bordered'>
                                    <thead>
                                        <tr>
                                        <th style='width: 10%;'>Rec No.</th>
                                        <th style='width: 30%;'>Account Name</th>
                                        <th style='width: 10%;'>Apply Tax</th>
                                        <th style='width: 10%;'>Allocated Amount</th>
                                        <th style='width: 10%;'>Tax Amount</th>
                                        <th style='width: 10%;'>Total Amount</th>
                                        <th style='width: 10%;'>Job No</th>
                                        <th style='width: 15%;'>Remarks</th>
                                        <th style='width: 12%;'></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>
                                            <input type='text' placeholder='Rec No.' id='rec_no_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input type='text' placeholder='Account Name'  id='account_name_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Apply Tax'  id='apply_tax_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Allocated Amount'  id='allocated_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Tax Amount'  id='tax_amount_Text' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Total Amount'  id='total_Amount_Tax' class='form-control input-sm'>
                                        </td>
                                        <td>
                                            <input  type='text' placeholder='Job No'  id='job_no_Text' class='form-control input-sm'>
                                        </td> 
                                        <td>
                                            <input  type='text' placeholder='Remarks'  id='remarks_Text2' class='form-control input-sm'>
                                        </td> 
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>
                                </tr>";

        $sql1 = "SELECT * FROM service_invoice_table WHERE reference_no = '" . $_GET['reference_no'] . "'";
        foreach ($conn->query($sql1) as $row2) {

             $rows .= "<tr><td>" . $row2['rec_no'] . "</td><td>" . $row2['account_name'] . "</td><td>" . $row2['apply_tax'] . "</td><td>" . $row2['allocated_amount'] . "</td><td>" . $row2['tax_amount'] . "</td><td>" . $row2['total_amount'] . "</td><td>" . $row2['job_no'] . "</td><td>" . $row2['remark'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
        }

        $rows .= "   </table>";
        $ResponseXML .= "<rows><![CDATA[" . $rows . "]]></rows>";
    }
    $ResponseXML .= "</new>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {

    $stname = $_GET["stname"];
    $ResponseXML = "";
    if ($stname == "POED") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                  <th>Reference No</th>
                    <th>manual No</th>
                    <th>Job No</th>
                </tr>";
        $sql = "Select * from purchase_order_entry_dummy where reference_no<> ''";
        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['job_no'] != "") {
            $sql .= " and job_no like '%" . $_GET['job_no'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['job_no'] . "</a></td>                           
                            </tr>";
        }
    } else if ($stname == "PORN") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Manual No</th>
                    <th>Remarks</th>
                </tr>";
        $sql = "Select * from po_requisition_note_dummy where reference_no<> ''";
        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['dateText'] != "") {
            $sql .= " and date like '%" . $_GET['dateText'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['remarks'] . "</a></td>                           
                            </tr>";
        }
    } else if ($stname == "SIVE") {


        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Currency Code</th>
                    <th>Manual No</th>
                    <th>Date</th>
                </tr>";

        $sql = "Select * from service_invoice where reference_no<> ''";

        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['currency_code'] != "") {
            $sql .= " and currency_code like '%" . $_GET['currency_code'] . "%'";
        }

        $sql .= " ORDER BY reference_no limit 50 ";

        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['currency_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                            </tr>";
        }
    } else if ($stname == "GRN") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                   <th>Reference No</th>
                    <th>Date</th>
                    <th>Currency Code</th>
                    <th>Manual Ref No</th>
                    <th>Exchange Rate</th>
                </tr>";

        $sql = "Select * from good_received_note_entry where reference_no<> ''";

        if ($_GET['reference_no'] != "") {
            $sql .= " and reference_no like '%" . $_GET['reference_no'] . "%'";
        }
        if ($_GET['manual_no'] != "") {
            $sql .= " and manual_no like '%" . $_GET['manual_no'] . "%'";
        }
        if ($_GET['dateText'] != "") {
            $sql .= " and date like '%" . $_GET['dateText'] . "%'";
        }

        $sql .= " ORDER BY reference_no limit 50 ";

        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['date'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['manual_ref_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['currency_code'] . "</a></td>
                              <td onclick=\"custno('$cuscode');\">" . $row['exchange_rate'] . "</a></td>

                              
                            </tr>";
        }
    } else if ($stname == "PRNTR") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference NO</th>
                    <th>Manual No</th>
                    <th>Remarks</th>    
                </tr>";
        $sql = "Select * from po_requistion_note where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and remarks like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['remarks'] . "</a></td>
                               
                            </tr>";
        }
    } else if ($stname == "POSER") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Manual No</th>
                    <th>po Requisition</th>
                    
                </tr>";
        $sql = "Select * from purchase_order_entry where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and po_requisition like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['po_requisition'] . "</a></td>
                               
                            </tr>";
        }
    } else if ($stname == "SUBCONTRACTOR") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                    <th>Reference No.</th>
                    <th>Date.</th>
                    <th>SC PO No.</th>
                </tr>";
        $sql = "Select * from subcontractordtls where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and scdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and scpono like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " and cancel = '0' ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['scpono'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "PAYMENTVOUCHER") {
        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                  <th>Ref No.</th>
                  <th>Date.</th>
                  <th>Currency Code</th>
                </tr>";
        $sql = "Select * from paymentvoucher where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and pvdate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and currencycode like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];
            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['pvdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['currencycode'] . "</a></td>
                         </tr>";
        }
    } else if ($stname == "GRNNOTE") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Manual No</th>
                    <th>Date</th>   
                </tr>";
        $sql = "Select * from good_return_note_entry where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and manual_no like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and date like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manual_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>                             
                            </tr>";
        }
    } else if ($stname == "GRNRECEIVED") {

        $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th>Reference No</th>
                    <th>Date</th>
                    <th>Purchase Order No</th>        
                </tr>";
        $sql = "Select * from good_received_note_ent where reference_no<> ''";
        if ($_GET['cusno'] != "") {
            $sql .= " and reference_no like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET[''] != "customername1") {
            $sql .= " and date like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and purchase_order_no like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " ORDER BY reference_no limit 50";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['reference_no'];
            $stname = $_GET["stname"];

            $ResponseXML .= "<tr>               
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['reference_no'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['date'] . "</a></td>
                               <td onclick=\"custno('$cuscode', '$stname');\">" . $row['purchase_order_no'] . "</a></td>                              
                            </tr>";
        }
    } else if ($stname == "GRNDETAILS") {

        $ResponseXML .= "<table class=\"table table-bordered\">
                <tr>
                   <th>Ref No.</th>
                   <th>Manual No.</th>
                    <th>Date</th>
                </tr>";

        $sql = "Select * from grndetails where referenceno<> ''";

        if ($_GET['cusno'] != "") {
            $sql .= " and referenceno like '%" . $_GET['cusno'] . "%'";
        }
        if ($_GET['customername1'] != "") {
            $sql .= " and grndate like '%" . $_GET['customername1'] . "%'";
        }
        if ($_GET['customername2'] != "") {
            $sql .= " and manualrefno like '%" . $_GET['customername2'] . "%'";
        }
        $sql .= " and cancel = '0' ORDER BY referenceno limit 50 ";
        foreach ($conn->query($sql) as $row) {
            $cuscode = $row['referenceno'];

            $stname = $_GET["stname"];

            $ResponseXML .= "<tr> 
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['referenceno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['grndate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['manualrefno'] . "</a></td>
                         </tr>";
        }
    }
    $ResponseXML .= "   </table>";
    echo $ResponseXML;
}
?>
