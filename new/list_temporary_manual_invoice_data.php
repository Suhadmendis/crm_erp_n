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







    $tb = "";
    $tb .= "<table id='testTable'  class='table table-bordered'>";


    $tb .= "<thead><tr>";

    $tb .= "<th>Invoice_Number</th>";
    $tb .= "<th>Date</th>";
    $tb .= "<th>Customer Name</th>";
    $tb .= "<th>Tax Type</th>";
    $tb .= "<th style='width: 150px;'>System Invoice Generated (Y/N)</th>";
    $tb .= "<th style='width: 150px;'>System Invoice Number</th>";
    $tb .= "<th style='width: 300px;'>Item</th>";
    $tb .= "<th style='width: 180px;'>Value</th>";


    $tb .= "</tr></thead><tbody>";

    foreach ($conn->query($sql2) as $row) {
        $cuscode = $row['Invoice_Number'];
        $code = $row['Invoice_Number'];
        $sql3 = "select * from temporary_manual_invoice_table where Invoice_Number = '" . $row['Invoice_Number'] . "'";


        $sql4 = "select count(Invoice_Number) from temporary_manual_invoice_table where Invoice_Number = '" . $row['Invoice_Number'] . "'";
        $resul = $conn->query($sql4);
        $row4 = $resul->fetch();




        if (strlen($cuscode) == 1) {
            $cuscode = "ccs/Temp/19-0000" . $cuscode;
        } else if (strlen($cuscode) == 2) {
            $cuscode = "ccs/Temp/19-000" . $cuscode;
        } else if (strlen($cuscode) == 3) {
            $cuscode = "ccs/Temp/19-00" . $cuscode;
        } else if (strlen($cuscode) == 4) {
            $cuscode = "ccs/Temp/19-0" . $cuscode;
        }


        $taxStetus = "";


        if ($row['no'] == 1) {
            if ($row['svatboo'] == 1) {
                if ($row['nbtboo'] == 1) {
                    $taxStetus = "INVOICE";
                } else {
                    $taxStetus = "INVOICE";
                }
            } else {
                if ($row['nbtboo'] == 1) {
                    $taxStetus = "INVOICE";
                } else {
                    $taxStetus = "INVOICE";
                }
            }
        } else {
            if ($row['svatboo'] == 1) {
                if ($row['nbtboo'] == 1) {
                    $taxStetus = "SVAT INVOICE";
                } else {
                    $taxStetus = "SVAT INVOICE";
                }
            } else {
                if ($row['nbtboo'] == 1) {
                    $taxStetus = "TAX INVOICE";
                } else {
                    $taxStetus = "TAX INVOICE";
                }
            }
        }







        if ($row4[0] == 0) {
            $tb .= "<tr>               
                               <td rowspan=\"1\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Invoice_Date'] . "</a></td>
                               <td rowspan=\"1\" onclick=\"custno('$code');\">" . $row['Customer_Name'] . "</a></td>                              
                               <td rowspan=\"1\" onclick=\"custno('$code');\">'$taxStetus'</a></td>                              
                               <td rowspan=\"1\" onclick=\"custno('$code');\"></a></td>                              
                               <td rowspan=\"1\" onclick=\"custno('$code');\"></a></td>                              
                             ";
        } else {
            $tb .= "<tr>               
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">$cuscode</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Invoice_Date'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">" . $row['Customer_Name'] . "</a></td>
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\">$taxStetus</a></td>                              
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\"></a></td>                              
                               <td rowspan=\"$row4[0]\" onclick=\"custno('$code');\"></a></td>                              
                              ";
        }



        foreach ($conn->query($sql3) as $row1) {

            $valwithtax = 00.00;
            $inv_name = "";

            $valwithtax = $row1['Unit_Price'] * $row1['QTY'];

            if ($row['svatboo'] == 1) {
                //tot price

                if ($row['nbtboo'] == 1) {


                    $inv_name = "";
                } else {


                    $inv_name = "";
                }
            } else {
                if ($row['nbtboo'] == 1) {
                    $tempval = $valwithtax;
                    $valwithtax = $valwithtax / 100 * 2;
                    $valwithtax = $valwithtax + $tempval;

                    $tempval = $valwithtax;
                    $valwithtax = $valwithtax / 100 * 15;
                    $valwithtax = $valwithtax + $tempval;
                    $inv_name = "+ NBT + VAT";
                } else {



                    $tempval = $valwithtax;
                    $valwithtax = $valwithtax / 100 * 15;
                    $valwithtax = $valwithtax + $tempval;

                    $inv_name = "+ VAT";
                }
            }


            // It's a string from a DB

            $valwithtax = number_format((float) $valwithtax, 2, '.', '');




            if ($row1['Description'] == "") {
                $tb .= " <td onclick=\"custno('$code');\">&nbsp;</td>
                              <td onclick=\"custno('$code');\">&nbsp;</td>
                             
                            </tr>";
            } else {
                $tb .= " <td onclick=\"custno('$code');\">" . $row1['Description'] . "</a></td>
                              <td onclick=\"custno('$code');\">" . $valwithtax . " " . $inv_name . "</a></td>
                             
                            </tr>";
            }
        }
    }
    $tb .= "</tbody></table>";




    $ResponseXML .= "<td><![CDATA[" . $tb . "]]></td>";
    $ResponseXML .= "</new>";


    echo $ResponseXML;
}
?>
