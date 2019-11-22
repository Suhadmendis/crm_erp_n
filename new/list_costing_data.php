<?php

session_start();



include_once './connection_sql.php';



if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";
//$sql2 = "select * from temporary_manual_invoice WHERE svatboo = '1' AND nbtboo = '0' AND no = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";

    if ($_GET['lkr'] == 1) {
        if ($_GET['usd'] == 1) {

            //same thing 40 time
            if ($_GET['invoice'] == 1) {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE svatboo = '1' OR no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                }
            } else {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND svatboo = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice limit 0";
                    }
                }
            }
        } else {



            if ($_GET['invoice'] == 1) {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND  Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND svatboo = '1' OR no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                }
            } else {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND no = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND no = '0' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'LKR' AND no = '0' AND svatboo = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice limit 0";
                    }
                }
            }
        }
    } else {
        if ($_GET['usd'] == 1) {

            if ($_GET['invoice'] == 1) {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND  Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND svatboo = '1' OR no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                }
            } else {
                if ($_GET['tax'] == 1) {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND no = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND no = '0' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    }
                } else {
                    if ($_GET['svat'] == 1) {
                        $sql2 = "select * from temporary_manual_invoice WHERE Currency = 'USD' AND no = '0' AND svatboo = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
                    } else {
                        $sql2 = "select * from temporary_manual_invoice limit 0";
                    }
                }
            }
        } else {
            $sql2 = "select * from temporary_manual_invoice limit 0";
        }
    }


//
//    if ($_GET['invoice'] == 1) {
//        if ($_GET['tax'] == 1) {
//            if ($_GET['svat'] == 1) {
//                $sql2 = "select * from temporary_manual_invoice WHERE Currency = '$curr' AND  Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            } else {
//                $sql2 = "select * from temporary_manual_invoice WHERE svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            }
//        } else {
//            if ($_GET['svat'] == 1) {
//                $sql2 = "select * from temporary_manual_invoice WHERE svatboo = '1' OR no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            } else {
//                $sql2 = "select * from temporary_manual_invoice WHERE no = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            }
//        }
//    } else {
//        if ($_GET['tax'] == 1) {
//            if ($_GET['svat'] == 1) {
//                $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            } else {
//                $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND svatboo = '0' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            }
//        } else {
//            if ($_GET['svat'] == 1) {
//                $sql2 = "select * from temporary_manual_invoice WHERE no = '0' AND svatboo = '1' AND Invoice_Date BETWEEN '" . $_GET['sdate'] . "' AND '" . $_GET['edate'] . "'";
//            } else {
//                $sql2 = "select * from temporary_manual_invoice limit 0";
//            }
//        }
//    }
    //main
    // $sql2 = "select `costing_information`.`ref_no` AS `ref_no`,`costing_cal`.`M_UC` AS `M_UC`,`costing_information`.`length` AS `length`,`costing_details`.`customer` AS `customer`,`costing_details`.`description` AS `description`,`costing_cal`.`M_TC` AS `M_TC`,`s_mas_details`.`s_descrip` AS `s_descrip`,`s_mas_details`.`value` AS `value`,`s_mas_details`.`s_item` AS `s_item`,`costing_information`.`tot_sq_inch` AS `tot_sq_inch`,`costing_information`.`no_of_ups` AS `no_of_ups`,`costing_information`.`width` AS `width`,`costing_information`.`tot_sqft` AS `tot_sqft`,`costing_information`.`foh_margin` AS `foh_margin`,`costing_information`.`color` AS `color`,`costing_information`.`no_of_imp` AS `no_of_imp`,`costing_information`.`sales_margin` AS `sales_margin`,`costing_information`.`waste` AS `waste`,`costing_information`.`no_of_outs` AS `no_of_outs`,`costing_information`.`commission_per_unit` AS `commission_per_unit`,`costing_information`.`rawWaste` AS `rawWaste`,`costing_cal`.`L_UC` AS `L_UC`,`costing_cal`.`L_TC` AS `L_TC`,`costing_cal`.`V_UC` AS `V_UC`,`costing_cal`.`V_TC` AS `V_TC`,`costing_cal`.`F_UC` AS `F_UC`,`costing_cal`.`F_TC` AS `F_TC`,`costing_cal`.`blank` AS `blank`,`costing_cal`.`TVC1` AS `TVC1`,`costing_cal`.`TMCVC1` AS `TMCVC1`,`costing_cal`.`TC1` AS `TC1`,`costing_cal`.`AM1` AS `AM1`,`costing_cal`.`SV1` AS `SV1`,`costing_cal`.`NP1` AS `NP1`,`costing_details`.`selling` AS `selling`,`costing_details`.`factory` AS `factory`,`costing_details`.`inkCost` AS `inkCost`,`costing_details`.`inkQty` AS `inkQty`,`costing_details`.`c_code` AS `c_code`,`costing_details`.`jobCost` AS `jobCost`,`costing_details`.`rawWaste` AS `wastage`,`costing_details`.`COST` AS `COST`,`costing_details`.`req_qty` AS `req_qty`,`costing_details`.`product_one` AS `product_one`,`costing_details`.`drf_no` AS `drf_no`,`costing_details`.`co_date` AS `co_date`,`s_mas_details`.`qty` AS `qty`,`costing_cal`.`CON3` AS `CON3`,`costing_cal`.`NP3` AS `NP3`,`costing_cal`.`CON2` AS `CON2`,`costing_cal`.`NP2` AS `NP2`,`costing_cal`.`SV2` AS `SV2`,`costing_cal`.`AM2` AS `AM2`,`costing_cal`.`TC2` AS `TC2`,`costing_cal`.`TMCVC2` AS `TMCVC2`,`costing_cal`.`TVC2` AS `TVC2`,`costing_cal`.`CON1` AS `CON1`,`costing_details`.`customerName` AS `customerName`,`costing_details`.`fl_job` AS `fl_job`,`costing_details`.`bodytable` AS `bodytable`,`costing_details`.`quono` AS `quono`,`costing_details`.`inkCode` AS `inkCode`,`costing_details`.`totsv` AS `totsv` from (((`costing_information` join `costing_cal` on((`costing_information`.`ref_no` = convert(`costing_cal`.`Cost_fer` using utf8)))) join `costing_details` on((convert(`costing_cal`.`Cost_fer` using utf8) = `costing_details`.`ref_no`))) join `s_mas_details` on((`costing_details`.`ref_no` = convert(`s_mas_details`.`costing_no` using utf8)))) order by `costing_information`.`ref_no`";
//huge loading area.............................................................

    $tempDeleteSql = "delete from costing_list_var_oh";
    $conn->exec($tempDeleteSql);
    $tempDeleteSql = "delete from costing_list_fixed_oh";
    $conn->exec($tempDeleteSql);
    $tempDeleteSql = "delete from costing_list_labour";
    $conn->exec($tempDeleteSql);


    $sql = "select * from var_oh_details where type = 'v'";
    foreach ($conn->query($sql) as $row) {
        
        $sql = "insert into costing_list_var_oh (item_no, s_item, value, s_descrip, costing_no, type, value_1, unitcost) values 
                ('" . $row["item_no"] . "','" . $row["s_item"] . "','" . $row["value"] . "','" . $row["s_descrip"] . "','" . $row["costing_no"] . "','" . $_POST["type"] . "','" . $row["value_1"] . "','" . $row["unitcost"] . "')";
        $conn->exec($sql);
    }
    
    $sql = "select * from var_oh_details where type = 'f'";
    foreach ($conn->query($sql) as $row) {
        
        $sql = "insert into costing_list_fixed_oh (item_no, s_item, value, s_descrip, costing_no, type, value_1, unitcost) values 
                ('" . $row["item_no"] . "','" . $row["s_item"] . "','" . $row["value"] . "','" . $row["s_descrip"] . "','" . $row["costing_no"] . "','" . $_POST["type"] . "','" . $row["value_1"] . "','" . $row["unitcost"] . "')";
        $conn->exec($sql);
    }
    
    $sql = "select * from var_oh_details where type = 'd'";
    foreach ($conn->query($sql) as $row) {
        
        $sql = "insert into costing_list_labour  (item_no, s_item, value, s_descrip, costing_no, type, value_1, unitcost) values 
                ('" . $row["item_no"] . "','" . $row["s_item"] . "','" . $row["value"] . "','" . $row["s_descrip"] . "','" . $row["costing_no"] . "','" . $_POST["type"] . "','" . $row["value_1"] . "','" . $row["unitcost"] . "')";
        $conn->exec($sql);
    }
    
//..............................................................................

    $sql2 = "select * from costing_details limit 1";

    $tb = "";
    $tb .= "<table id='testTable'  class='table-bordered' width='5600'>";


    $tb .= "<thead>";

    $tb .= "<tr><th rowspan='2' width='200'>Costing Ref</th>";
    $tb .= "<th rowspan='2' width='200'>Date</th>";
    $tb .= "<th rowspan='2' width='200'>Customer Name</th>";
    $tb .= "<th rowspan='2' width='200'>Factory</th>";
    $tb .= "<th rowspan='2' width='200'>Product</th>";
    $tb .= "<th rowspan='2' width='200'>Qty</th>";
    $tb .= "<th colspan='3' width='600'>Raw Materials</th>";
    $tb .= "<th colspan='2' width='400'>Wastage</th>";
    $tb .= "<th colspan='3' width='600'>Labour</th>";
    $tb .= "<th colspan='3' width='600'>Variable Cost</th>";
    $tb .= "<th colspan='3' width='600'>FOH</th>";
    $tb .= "<th rowspan='2' width='200'>Total VC</th>";
    $tb .= "<th rowspan='2' width='200'>Contribution</th>";
    $tb .= "<th rowspan='2' width='200'>Total Cost</th>";
    $tb .= "<th rowspan='2' width='200'>Sales Price</th>";
    $tb .= "<th rowspan='2' width='200'>Commision</th>";
    $tb .= "<th rowspan='2' width='200'>Net Profit</th>";
    $tb .= "<th rowspan='2' width='200'>Contribution%</th>";
    $tb .= "<th rowspan='2' width='200'>NP%</th></tr>";


    $tb .= "<tr><th>Item Name</th>";
    $tb .= "<th>Total Qty</th>";
    $tb .= "<th>Total Cost</th>";
    $tb .= "<th>%</th>";
    $tb .= "<th>Cost</th>";
    $tb .= "<th>Item Name</th>";
    $tb .= "<th>Total Qty</th>";
    $tb .= "<th>Total Cost</th>";
    $tb .= "<th>Item Name</th>";
    $tb .= "<th>Total Qty</th>";
    $tb .= "<th>Total Cost</th>";
    $tb .= "<th>Item Name</th>";
    $tb .= "<th>Total Qty</th>";
    $tb .= "<th>Total Cost</th></tr>";





    $tb .= "</thead><tbody>";




    foreach ($conn->query($sql2) as $row) {
        $cuscode = $row['ref_no'];



        $tb .= "<tr>
         <td>" . $row['ref_no'] . "</td>
         <td>" . $row['co_date'] . "</td>
         <td>" . $row['customer'] . "</td>
         <td>" . $row['factory'] . "</td>
         <td>" . $row['description'] . "</td>
         <td>" . $row['req_qty'] . "</td>
             
         <td>" . $row['s_item'] . "</td>
         <td>" . $row['qty'] . "</td>
         <td>" . $row['value'] . "</td>
             
         <td>wasss" . $row['ref_no'] . "</td>
         <td>wasss" . $row['ref_no'] . "</td>";

        $tb .= " <td>" . $row['item2'] . "</td>
         <td>" . $row['des2'] . "</td>
         <td>" . $row['value_1'] . "</td>";



        $tb .= " <td>" . $row['item2'] . "</td>
         <td>" . $row['des2'] . "</td>
         <td>" . $row['value_1'] . "</td>";

        $tb .= " <td>" . $row['item2'] . "</td>
         <td>" . $row['des2'] . "</td>
         <td>" . $row['value_1'] . "</td>";






        $tb .= "<td>" . $row['TVC1'] . "</td>
         <td>" . $row['CON1'] . "</td>
         <td>" . $row['TC1'] . "</td>
         <td>" . $row['ref_no'] . "</td>
         <td>" . $row['ref_no'] . "</td>
         <td>" . $row['NP1'] . "</td>
         <td>" . $row['ref_no'] . "</td>
         <td>" . $row['ref_no'] . "</td>
         


         </tr>";
    }


    $tb .= "</tbody></table>";




    $ResponseXML .= "<td><![CDATA[" . $tb . "]]></td>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}
?>
