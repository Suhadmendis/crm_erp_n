<?php

/** Include path * */
set_include_path(get_include_path() . PATH_SEPARATOR . 'PHPExcel/Classes/');
include 'PHPExcel/IOFactory.php';

include_once("connection_sql.php");

header('Content-Type: text/xml');


$columns = array("A", "Z");

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["file-3"]["name"]);
// unlink($target_file);
if (move_uploaded_file($_FILES["file-3"]["tmp_name"], $target_file)) {

}

$objPHPExcel = PHPExcel_IOFactory::load($target_file);
$objPHPExcel->setActiveSheetIndexByName("Sheet1");
$worksheet = $objPHPExcel->getActiveSheet();

$ResponseXML = "";
$ResponseXML .= "<salesdetails>";
$sql = "select * from costing_allocation";
foreach ($conn->query($sql) as $row) {

    $cellCus = $worksheet->getCell($row['customer'])->getValue();
    $cell1 = $worksheet->getCell($row['product_one'])->getValue();
    $cell2 = $worksheet->getCell($row['length'])->getValue();
    $cell3 = $worksheet->getCell($row['req_qty'])->getValue();
    $cell4 = $worksheet->getCell($row['waste'])->getValue();
    $cell4 = $cell4 * 100;
    $cell5 = $worksheet->getCell($row['color'])->getValue();
    $cell6 = $worksheet->getCell($row['no_of_outs'])->getValue();

    $cell7 = $worksheet->getCell($row['no_of_impre'])->getCalculatedValue();
    $cell8 = $worksheet->getCell($row['foh_margin'])->getCalculatedValue();
    $cell8 = $cell8 * 100;
    $cell9 = $worksheet->getCell($row['sales_margin'])->getCalculatedValue();
    $cell9 = $cell9 * 100;
    $cell10 = $worksheet->getCell($row['commision_per_unit'])->getCalculatedValue();
    $cell11 = $worksheet->getCell($row['width'])->getValue();

    $cell12 = $worksheet->getCell($row['no_of_ups'])->getValue();
    $cellDesc = $worksheet->getCell($row['description'])->getValue();
    $measType = $worksheet->getCell('C14')->getValue();

    $sal_com = $worksheet->getCell('M239')->getCalculatedValue();

    $sal_pri_after_com = $worksheet->getCell('M240')->getCalculatedValue();



//    Measurement Table
//    1'' = 25.4mm
//    1'' = 2.54cm
//    12'' = 1Feet
//    36'' = 1Yard
//    39'' = 1Mtr
//
//    Measurement Type Converstion Divide / Multiply Value
//    Mm Inches Divide 25.4
//    CM Inches Divide 2.54
//    Feet Inches Multiply 12
//    Yard Inches Multiply 36
//    Meter Inches Multiply 39



    if ($measType == "Mm") {
        $cell2 = $cell2 / 25.4;
        $cell11 = $cell11 / 25.4;
    } else if ($measType == "CM") {
        $cell2 = $cell2 / 2.54;
        $cell11 = $cell11 / 2.54;
    } else if ($measType == "Feet") {
        $cell2 = $cell2 * 12;
        $cell11 = $cell11 * 12;
    } else if ($measType == "Yard") {
        $cell2 = $cell2 * 36;
        $cell11 = $cell11 * 36;
    } else if ($measType == "Meter") {
        $cell2 = $cell2 * 39;
        $cell11 = $cell11 * 39;
    }











    $cellsides = $worksheet->getCell('H13')->getValue();


    $totalCost = $worksheet->getCell("M161")->getCalculatedValue();
    $rawCost = $worksheet->getCell("M160")->getCalculatedValue();
    $rawWaste = $worksheet->getCell("M160")->getCalculatedValue();
    $totCPU = $worksheet->getCell("M232")->getCalculatedValue();

    $ntpro = $worksheet->getCell("M235")->getCalculatedValue();
    $ntpromar = $worksheet->getCell("M236")->getCalculatedValue();
    if ($rawWaste == "") {
        $rawWaste = 0;
    }

    //from front
    $inkQtym = $_POST["inkQtym"];
    $inkTotCostm = $_POST["inkTotCostm"];

    $sellingPrice = $worksheet->getCell("M238")->getCalculatedValue();
   


    $netmargin = $worksheet->getCell("M236")->getCalculatedValue();
    $netmargin = number_format($netmargin, 4, ".", "");






    $jobCost = $totalCost - $rawCost;
    $TotalJobCost = $totalCost * $cell3;
}


$validation = "";
$validationcolor = 0;
$readR = "";

$msg = "<br><div class='col-sm-12'>
<table class='table table-striped'>
<tr class='success'>
        <td colspan='9'><b>Material Cost</b></td>

</tr>
<tr class='success'>
        <th style='width: 120px;'>Item Description</th>
        <th style='width: 10px;'>Item Code</th>
        <th style='width: 10px;'>Item Qty Per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>WAC of Item</th>
        <th style='width: 10px;'>Total Item Qty for the Job</th>
        <th style='width: 5px;'>Wastage Qty</th>
        <th style='width: 5px;'>Wastage Value</th>
</tr>";
$subCell = "";
$UCtot1 = 0.00;
$totC1 = 0.00;
$valicount = 0;
$TOT_cost_per_U = 0.00;
for ($index = 21; $index < (20 + 61); $index++) {
    $i = "A" . $index;
    $subCell = $worksheet->getCell($i)->getValue();
    if ($subCell == "i") {
        $i = "M" . $index;
        $subCellCost = $worksheet->getCell($i)->getCalculatedValue();
        $i = "J" . $index;
        $subCell1 = $worksheet->getCell($i)->getValue();
        $subCell1 = trim($subCell1);
        $i = "K" . $index;
        $subCell2 = $worksheet->getCell($i)->getCalculatedValue();

        $i = "N" . $index;
        $wasqtyCell2 = $worksheet->getCell($i)->getCalculatedValue();
        if ($wasqtyCell2 == null) {
          $wasqtyCell2 = 0;
        }

        $i = "O" . $index;
        $wasValueCell2 = $worksheet->getCell($i)->getCalculatedValue();
        if ($wasValueCell2 == null) {
          $wasValueCell2 = 0;
        }

        $i = "P" . $index;
        $getDesCell2 = $worksheet->getCell($i)->getValue();


        $sqlvali = "select STK_NO from s_rawmas where STK_NO = '" . $subCell1 . "'";

        $rowval = $conn->query($sqlvali)->fetch();
        if ($rowval["STK_NO"] == "") {
            $readE = $readE . "<br>" . $subCell1;
            $valicount = $valicount + 1;
            $validationcolor = $validationcolor + 1;
        }



        $sql = "select acc_cost, DESCRIPT, STK_NO from s_rawmas where STK_NO = '" . $subCell1 . "'";
        $rowItem = $conn->query($sql)->fetch();

        $itemDes = "";
        if ($getDesCell2 == "GD") {
            $i = "B" . $index;
            $itemDes = $worksheet->getCell($i)->getValue();
        } else {
            $itemDes = $rowItem["DESCRIPT"];
        }


        $UCtot1 = $subCellCost + $UCtot1;
        $totC1 = $subCellCost * $subCell2 + $totC1;


        $totmatunit = $subCellCost * $cell3;
        $temp012 = $subCellCost * $cell3;
        $temp013 = $subCell2 * $cell3;

        $mattemp013 = $mattemp013 + $subCell2;
        $mattemp014 = $mattemp014 + $subCellCost;


        $mattemp015 = $mattemp015 + $temp012 + $wasValueCell2;
        $mattemp016 = $mattemp016 + $wasqtyCell2;

        $mattemp017 = $mattemp017 + $wasValueCell2;

        $mattemp018 = $wasValueCell2 / $cell3;


        $bulkInsert[] = "('" . $itemDes . "','" . $subCell1 . "','" . $subCell2 . "','" . $_POST["refno"] . "','i', $subCellCost + $mattemp018, $temp012 + $wasValueCell2,$temp013 + $wasqtyCell2 , $wasqtyCell2, $wasValueCell2)";

        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $itemDes . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $subCell1 . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2, 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCellCost + $mattemp018, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($temp012 + $wasValueCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rowItem["acc_cost"], 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($temp013 + $wasqtyCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($wasqtyCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($wasValueCell2, 2, ".", ",") . "</td>";
        $msg .= "</tr>";

        $TOT_cost_per_U = $TOT_cost_per_U + $subCellCost + $mattemp018;
    }
}

if ($valicount == 0) {

}


if ($valicount == 1) {
    $validation .= "1 Error in Materials <br> ";
    $validation .= $readE."<br>";
} else {
   if ($valicount == 0) {
        $validation .= "No Errors in Materials <br> ";
    } else {
        $validation .= $valicount . " Errors in Materials <br> ";
        $validation .= $readE."<br>";
    }
}



$msg .= "<tr>";
$msg .= "<td style = 'width: 120px;text-align: left;'><b>INK Cost</b></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($inkQtym / $cell3, 2) . "</td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($inkTotCostm / $cell3, 2) . "</td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($inkTotCostm, 2) . "</td>";
$msg .= "<td style = 'width: 10px;text-align: left;'></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . $inkQtym . "</td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td style = 'width: 120px;text-align: left;'><b>Wastage</b></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'></td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rawWaste, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($rawWaste * $cell3, 2, ".", ",") . "</td>";
$msg .= "</tr>";

//$totuc = $rawWaste * $cell3;
//$temp1ink = $inkTotCostm / $cell3;
//$pootemp1 = $rawWaste * $cell3;
//$temp2ink = $totmatunit + $inkTotCostm + $pootemp1;
//$temp4 = $rawWaste * $cell3;

$mattemp0010110 = $inkQtym / $cell3;
$mattemp0010110 = $mattemp013 + $mattemp0010110;

// $mattemp0010110 = $mattemp0010110 + $TOT_cost_per_U;

$mattemp0010111 = $inkTotCostm / $cell3;
$mattemp0010111 = $mattemp0010111 + $rawWaste + $mattemp018 + $TOT_cost_per_U;

$temp43 = $rawWaste * $cell3;
$mattemp0010112 = $mattemp015 + $inkTotCostm + $temp43;

$msg .= "<tr style='background-color: burlywood;'>";
$msg .= "<td style = 'width: 120px;text-align: left;'>Total Cost</td>";
$msg .= "<td style = 'width: 10px;text-align: left;'></td>";
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010110, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010111, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010112, 2, ".", ",") . "</td>";
$msg .= "<td ></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp016, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp017, 2, ".", ",") . "</td>";

$msg .= "</tr>";
$msg .= "<tr>";


$msg .= "</tr>";

$temp222 = $UCtot1 + $rawWaste;


$sql = "delete from costing_cal_temp where Cost_fer = '" . $_POST['refno'] . "'";
$conn->exec($sql);

$sql1212 = "insert into costing_cal_temp (Cost_fer, M_UC,M_TC) values ('" . $_POST["refno"] . "','" . number_format($mattemp0010111, 2, ".", ",") . "','" . number_format($mattemp0010112, 2, ".", ",") . "')";
$conn->exec($sql1212);


$totC1 = $totC1 + $inkTotCostm;

//exit($bulkInsert1);
$readE = "";

$msg .= "<tr class='success'>
            <td colspan='9'><b>Labour</b></td>
        </tr>
    <tr class='success'>
        <th style='width: 120px;'>Labour</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Item Qty per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>Hours</th>
        <th style='width: 10px;'>Total Labour Hours For job</th>
        <th style='width: 10px;'></th>
        <th style='width: 10px;'></th>
        </tr>";
$subCell = "";

$UCtot2 = 0.00;
$totC2 = 0.00;
$valicount = 0;
for ($index = 164; $index < (185); $index++) {
    $i = "A" . $index;
    $subCell = $worksheet->getCell($i)->getValue();
    if ($subCell == "d") {
        $i = "B" . $index;
        $subCell = $worksheet->getCell($i)->getValue();
        $i = "J" . $index;
        $subCell1 = $worksheet->getCell($i)->getValue();
        $subCell1 = trim($subCell1);
        $i = "K" . $index;
        $subCell2 = $worksheet->getCell($i)->getCalculatedValue();

//         $subCell2 = $subCell2 * $cell3;


        $i = "M" . $index;
        $Unitcost = $worksheet->getCell($i)->getCalculatedValue();


        $i = "L" . $index;
        $subCellHours = $worksheet->getCell($i)->getValue();
        if ($subCellHours == "") {
            $subCellHours = 0;
        }

        //validation

        $sqlvali = "select STK_NO from labour_mas where STK_NO = '" . $subCell1 . "'";

        $rowval = $conn->query($sqlvali)->fetch();
        if ($rowval["STK_NO"] == "") {
            $readE = $readE . "<br>" . $subCell1;
            $valicount = $valicount + 1;
            $validationcolor = $validationcolor + 1;
        }





        //$rowItem["STK_NO"];
        ////////////

        $sql = "select acc_cost, DESCRIPT, STK_NO from labour_mas where STK_NO = '" . $subCell1 . "'";
        $rowItem = $conn->query($sql)->fetch();

        //hours to be saved

        $UCtot2 = $UCtot2 + $Unitcost;
        $totC2 = $totC2 + $subCell2 * $Unitcost;


        $temp5896 = $Unitcost * $cell3;
        $labtemp00101 = $labtemp00101 + $temp5896;

        $temp5897 = $subCell2 * $cell3;
        $labtemp00103 = $labtemp00103 + $temp5897;

        $labtemp00102 = $labtemp00102 + $Unitcost;

        $bulkInsert[] = "('" . $rowItem["DESCRIPT"] . "','" . $subCell1 . "','" . $subCell2 . "','" . $_POST["refno"] . "','d', $Unitcost, $temp5896,$subCell2 * $cell3,null,null)";

        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowItem["DESCRIPT"] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $subCell1 . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($Unitcost, 2, ".", ",") . "</td>";

        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($temp5896, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $subCellHours . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2 * $cell3, 2, ".", ",") . "</td>";
        $msg .= "</tr>";
    }
}
if ($valicount == 0) {

}
if ($valicount == 1) {
    $validation .= "1 Error in Labour <br> ";
    $validation .= $readE."<br>";
} else {
   if ($valicount == 0) {
        $validation .= "No Errors in Labour <br> ";
    } else {
        $validation .= $valicount . " Errors in Labour <br> ";
        $validation .= $readE."<br>";
    }
}


$msg .= "<tr style='background-color: burlywood;'>";
$msg .= "<td style = 'width: 120px;text-align: left;'>Total Cost</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00102, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00101, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00103, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";





$sql1212 = "update costing_cal_temp set L_UC = '" . number_format($labtemp00102, 2, ".", ",") . "' , L_TC = '" . number_format($labtemp00101, 2, ".", ",") . "'";
$conn->exec($sql1212);

$readE = "";


$msg .= "<tr class='success'>
        <td colspan='9'><b>Variable Over Head Cost</b></td>

</tr>
    <tr class='success'>
        <th style='width: 120px;'>VOH Description</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Item Qty per Unit</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>Total Units for Job</th>
                <th style='width: 10px;'></th>
        <th style='width: 10px;'></th>
        </tr>";

$subCell = "";

$UCtot3 = 0.00;
$totC3 = 0.00;
$valicount = 0;
for ($index = 189; $index < (214); $index++) {
    $i = "A" . $index;
    $subCell = $worksheet->getCell($i)->getValue();
    if ($subCell == "v") {
        $i = "B" . $index;
        $subCell = $worksheet->getCell($i)->getValue();
        $i = "J" . $index;
        $subCell1 = $worksheet->getCell($i)->getValue();
        $subCell1 = trim($subCell1);
        $i = "K" . $index;
        $subCell2 = $worksheet->getCell($i)->getCalculatedValue();



        //validation

        $sqlvali = "select STK_NO from voh_mas where STK_NO = '" . $subCell1 . "'";

        $rowval = $conn->query($sqlvali)->fetch();
        if ($rowval["STK_NO"] == "") {
            $readE = $readE . "<br>" . $subCell1;
            $valicount = $valicount + 1;
            $validationcolor = $validationcolor + 1;
        }

        //$rowItem["STK_NO"];
        ////////////


        $sql = "select acc_cost, DESCRIPT, STK_NO from voh_mas where STK_NO = '" . $subCell1 . "'";
        $rowItem = $conn->query($sql)->fetch();

        $i = "M" . $index;
        $Unitcost = $worksheet->getCell($i)->getCalculatedValue();


        $UCtot3 = $UCtot3 + $Unitcost;
        $totC3 = $totC3 + $subCell2 * $Unitcost;



        $vartemp465001 = $Unitcost + $vartemp465001;
        $temp79862 = $cell3 * $Unitcost;
        $vartemp465002 = $temp79862 + $vartemp465002;

        $temp79863 = $subCell2 * $cell3;
        $vartemp465003 = $temp79863 + $vartemp465003;

        $bulkInsert[] = "('" . $rowItem["DESCRIPT"] . "','" . $subCell1 . "','" . $subCell2 . "','" . $_POST["refno"] . "','v', '" . $Unitcost . "',$cell3 * $Unitcost,'" . $subCell2 * $cell3 . "',null,null)";

        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowItem["DESCRIPT"] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $subCell1 . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($Unitcost, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($cell3 * $Unitcost, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'></td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2 * $cell3, 2, ".", ",") . "</td>";

        $msg .= "</tr>";
    }
}


if ($valicount == 1) {
    $validation .= "1 Error in Variable Over Head <br> ";
    $validation .= $readE."<br>";
} else {
    if ($valicount == 0) {
        $validation .= "No Errors in Variable Over Head <br> ";
    } else {
        $validation .= $valicount . " Errors in Variable Over Head <br> ";
        $validation .= $readE."<br>";
    }
}


$msg .= "<tr style='background-color: burlywood;'>";
$msg .= "<td style = 'width: 120px;text-align: left;'>Total Cost</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($vartemp465001, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($vartemp465002, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($vartemp465003, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";





$sql1212 = "update costing_cal_temp set V_UC = '" . number_format($UCtot3, 2, ".", ",") . "' , V_TC = '" . number_format($totC3, 2, ".", ",") . "'";
$conn->exec($sql1212);



$readE = "";

$msg .= "<tr class='success'>
        <td colspan='9'><b>Fixed Over Head Cost</b></td>

</tr>
    <tr class='success'>
        <th style='width: 120px;'>FOH Description</th>
        <th style='width: 10px;'>Code</th>
        <th style='width: 10px;'>Qty</th>
        <th style='width: 10px;'>Cost For One Unit</th>
        <th style='width: 10px;'>Total Cost for the Job</th>
        <th style='width: 10px;'>&nbsp;</th>
        <th style='width: 10px;'>Total Units for Job</th>
                <th style='width: 10px;'></th>
        <th style='width: 10px;'></th>
        </tr>";

$subCell = "";

$UCtot4 = 0.00;
$totC4 = 0.00;
$valicount = 0;
for ($index = 222; $index < (228); $index++) {
    $i = "A" . $index;
    $subCell = $worksheet->getCell($i)->getValue();
    if ($subCell == "f") {
        $i = "B" . $index;
        $subCell = $worksheet->getCell($i)->getValue();
        $i = "J" . $index;
        $subCell1 = $worksheet->getCell($i)->getValue();
        $subCell1 = trim($subCell1);

        $i = "K" . $index;
        $qty = $worksheet->getCell($i)->getCalculatedValue();


        //validation

        $sqlvali = "select STK_NO from foh_mas where STK_NO = '" . $subCell1 . "'";

        $rowval = $conn->query($sqlvali)->fetch();
        if ($rowval["STK_NO"] == "") {
            $readE = $readE . "<br>" . $subCell1;
            $valicount = $valicount + 1;
            $validationcolor = $validationcolor + 1;
        }

        //$rowItem["STK_NO"];
        ////////////



        $sql = "select acc_cost, DESCRIPT, STK_NO from foh_mas where STK_NO = '" . $subCell1 . "'";
        $rowItem = $conn->query($sql)->fetch();



        $i = "M" . $index;
        $subCell2 = $worksheet->getCell($i)->getCalculatedValue();


        $UCtot4 = $UCtot4 + $subCell2;
        $totC4 = $totC4 + $subCell2 * $qty;


        $fixtemp8967001 = $fixtemp8967001 + $subCell2;
        $temp78023 = $subCell2 * $cell3;
        $fixtemp8967002 = $fixtemp8967002 + $temp78023;

        $temp78024 = $qty * $cell3;
        $fixtemp8967003 = $fixtemp8967003 + $temp78024;

        $bulkInsert[] = "('" . $rowItem["DESCRIPT"] . "','" . $subCell1 . "','" . $qty . "','" . $_POST["refno"] . "','f', '" . $subCell2 . "', $subCell2 * $cell3,'" . $qty * $cell3 . "',null,null)";
        $msg .= "<tr>";
        $msg .= "<td style = 'width: 120px;text-align: left;'>" . $rowItem["DESCRIPT"] . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . $subCell1 . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($qty, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($subCell2 * $cell3, 2, ".", ",") . "</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>&nbsp;</td>";
        $msg .= "<td style = 'width: 10px;text-align: left;'>" . number_format($qty * $cell3, 2, ".", ",") . "</td>";
        $msg .= "</tr>";
    }
}


if ($valicount == 0) {

}
if ($valicount == 1) {
    $validation .= "1 Error in Fixed Over Head <br> ";
    $validation .= $readE."<br>";

} else {
    if ($valicount == 0) {
        $validation .= "No Errors in Fixed Over Head <br> ";
        $validation .= $readE."<br>";
    } else {
        $validation .= $valicount . " Errors in Fixed Over Head <br> ";
        $validation .= $readE."<br>";
    }
}



$msg .= "<tr style='background-color: burlywood;'>";
$msg .= "<td style = 'width: 120px;text-align: left;'>Total Cost</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($fixtemp8967001, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($fixtemp8967002, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($fixtemp8967003, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";


$sql1212 = "update costing_cal_temp set F_UC = '" . number_format($fixtemp8967001, 2, ".", ",") . "' , F_TC = '" . number_format($fixtemp8967002, 2, ".", ",") . "'";
$conn->exec($sql1212);


//Dn reload

$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";


// DO NOT DELETE THIS TR
//$msg .= "<tr>";
//$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Tech View</td>";
//
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010111, 2, ".", ",") . "</td>";
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010112, 2, ".", ",") . "</td>";
//
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00102, 2, ".", ",") . "</td>";
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00101, 2, ".", ",") . "</td>";
//
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($vartemp465001, 2, ".", ",") . "</td>";
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($vartemp465002, 2, ".", ",") . "</td>";
//
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($fixtemp8967001, 2, ".", ",") . "</td>";
//$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($fixtemp8967002, 2, ".", ",") . "</td>";
//
//$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$msg .= "<tr class='success'>";
$msg .= "<td colspan='3' style = 'width: 120px;text-align: center;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'><b>For One Unit</b></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'><b>Total Job Qty</b></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";


$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total VC  ( except Material Cost )</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00102 + $vartemp465001, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($labtemp00101 + $vartemp465002, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";
    

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total MC + VC</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010111 + $labtemp00102 + $vartemp465001, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010112 + $labtemp00101 + $vartemp465002, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Total Cost</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010111 + $labtemp00102 + $vartemp465001 + $fixtemp8967001, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($mattemp0010112 + $labtemp00101 + $vartemp465002 + $fixtemp8967002, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";

$tvc1 = $labtemp00102 + $vartemp465001;
$tvc2 = $labtemp00101 + $vartemp465002;

$TMCVC1 = $mattemp0010111 + $labtemp00102 + $vartemp465001;
$TMCVC2 = $mattemp0010112 + $labtemp00101 + $vartemp465002;

$sql1212 = "update costing_cal_temp set TVC1 = '" . $tvc1 . "' ,TVC2 = '" . $tvc2 . "' , TMCVC1 = '" . $TMCVC1 . "', TMCVC2 = '" . $TMCVC2 . "'";
$conn->exec($sql1212);



$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3'  style = 'width: 120px;text-align: center;'>Approved Margin</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . $cell9 . "%</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";



$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Before Sales Commission</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sellingPrice, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sellingPrice * $cell3, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";

//
//$ResponseXML .= "<sal_com><![CDATA[" . number_format($sal_com, 2, ".", "") . "]]></sal_com>";
//
//$ResponseXML .= "<sal_pri_after_com><![CDATA[" . number_format($sal_pri_after_com, 2, ".", "") . "]]></sal_pri_after_com>";




$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Sales Commission</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sal_com, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sal_com * $cell3, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";


$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Sales Price After Sales Commission</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sal_pri_after_com, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($sal_pri_after_com * $cell3, 2, ".", ",") . "</td>";

$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";

$sql1212 = "update costing_cal_temp set SPAS1 = '" . $sal_pri_after_com . "' ,SPAS2 = '" . $sal_pri_after_com * $cell3 . "'";
$conn->exec($sql1212);



$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$temp032 = $sellingPrice * $cell3;

$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Net Proft / Marign</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($ntpro, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($ntpro * $cell3, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($ntpromar*100, 2, ".", ",") . "%</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";

$msg .= "<tr>";
$msg .= "<td>&nbsp;</td>";
$msg .= "</tr>";

$totmvmcu = $mattemp0010111 + $labtemp00102 + $vartemp465001;
$totmvmc = $totC1 + $totC2 + $totC3;

$forcal = $sellingPrice * $cell3;

$contri = $sellingPrice - $totmvmcu;
$contrii = $contri / $sellingPrice;
$contrii = $contrii * 100;




$msg .= "<tr>";
$msg .= "<td class='success' colspan='3' style = 'width: 120px;text-align: center;'>Contribution / Margin</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($contri, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($temp032 - $TMCVC2, 2, ".", ",") . "</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'>" . number_format($contrii, 2, ".", ",") . " %</td>";
$msg .= "<td style = 'width: 120px;text-align: left;'></td>";
$msg .= "</tr>";



$TC1 = $mattemp0010111 + $labtemp00102 + $vartemp465001 + $fixtemp8967001;
$TC2 = $mattemp0010112 + $labtemp00101 + $vartemp465002 + $fixtemp8967002;




$sql1212 = "update costing_cal_temp set TC1 = '" . $TC1 . "' ,TC2 = '" . $TC2 . "' , AM1 = '" . $cell9 . "', AM2 = '" . null . "', SV1 = '" . $sellingPrice . "',SV2 = '" . number_format($sellingPrice * $cell3, 4, ".", ",") . "', NP1 = '" . number_format($totC4, 4, ".", ",") . "' ,NP2 = '" . number_format($totC4, 4, ".", ",") . "' , CON1 = '" . number_format($totC4, 4, ".", ",") . "', CON2 = '" . number_format($totC4, 4, ".", ",") . "'";
$conn->exec($sql1212);



$sql1212 = "update costing_cal_temp set NP1 = '" . $ntpro . "' ,NP2 = '" . $ntpro * $cell3 . "' ,NP3 = '" . $ntpromar . "' , CON1 = '" . $contri . "', CON2 = '" . number_format($forcal - $totmvmc, 4, ".", ",") . "', CON3 = '" . number_format($contrii, 4, ".", ",") . "'";
$conn->exec($sql1212);

$sql1212 = "update costing_cal_temp set SC1 = '" . $sal_com . "' ,SC2 = '" . $sal_com * $cell3 . "'";
$conn->exec($sql1212);







$msg .= "</table></div>";



$ResponseXML .= "<itemList><![CDATA[" . $msg . "]]></itemList>";
$sql = "delete from tmp_subitem where tmpno = '" . $_POST["refno"] . "'";
$conn->exec($sql);

if (count($bulkInsert) > 0) {

    $sql = "insert into tmp_subitem (s_descrip, s_item, qty, tmpno, type, value, unitcost, total_the_job, wqty, wv) values " . implode(',', $bulkInsert);
    // echo $sql;
    $conn->exec($sql);
}

$sql = "select NAME from vendor where CODE = '$cellCus'";
$row = $conn->query($sql)->fetch();


//some cal
//$cell7 = $cell7 / $cell12;

$ResponseXML .= "<cus><![CDATA[" . $cellCus . "]]></cus>";
$ResponseXML .= "<cusName><![CDATA[" . $row["NAME"] . "]]></cusName>";
$ResponseXML .= "<product><![CDATA[" . $cell1 . "]]></product>";
$ResponseXML .= "<length><![CDATA[" . $cell2 . "]]></length>";
$ResponseXML .= "<qty><![CDATA[" . $cell3 . "]]></qty>";
$ResponseXML .= "<waste><![CDATA[" . $cell4 . "]]></waste>";
$ResponseXML .= "<color><![CDATA[" . $cell5 . "]]></color>";
$ResponseXML .= "<noofouts><![CDATA[" . $cell6 . "]]></noofouts>";
$ResponseXML .= "<noofups><![CDATA[" . $cell12 . "]]></noofups>";
$ResponseXML .= "<noofimpre><![CDATA[" . $cell7 . "]]></noofimpre>";
$ResponseXML .= "<fohmargin><![CDATA[" . $cell8 . "]]></fohmargin>";
$ResponseXML .= "<salesmargin><![CDATA[" . $cell9 . "]]></salesmargin>";
$ResponseXML .= "<commisionperunit><![CDATA[" . $cell10 . "]]></commisionperunit>";
$ResponseXML .= "<width><![CDATA[" . $cell11 . "]]></width>";

$sql = "select DESCRIPT from s_rawmas where STK_NO = '$cell1'";
$row = $conn->query($sql)->fetch();

//$ResponseXML .= "<description><![CDATA[" . $row["DESCRIPT"] . "]]></description>";
$ResponseXML .= "<description><![CDATA[" . $cellDesc . "]]></description>";
$ResponseXML .= "<measType><![CDATA[" . $measType . "]]></measType>";
$ResponseXML .= "<cellsides><![CDATA[" . $cellsides . "]]></cellsides>";
$ResponseXML .= "<totalCost><![CDATA[" . $totalCost . "]]></totalCost>";
$ResponseXML .= "<rawWaste><![CDATA[" . number_format($rawWaste, 2, ".", ",") . "]]></rawWaste>";
$ResponseXML .= "<jobCost><![CDATA[" . number_format($TotalJobCost, 2, ".", ",") . "]]></jobCost>";
$ResponseXML .= "<sellingPrice><![CDATA[" . $sal_pri_after_com . "]]></sellingPrice>";
$ResponseXML .= "<totCPU><![CDATA[" . $totCPU . "]]></totCPU>";

$totSqIn = $cell2 * $cell11 * $cell3;
$totSqFt = $totSqIn / 144;

$effSqFt = $totSqFt * $cell5 * (1 + $cell4);

$ResponseXML .= "<totSqIn><![CDATA[" . $totSqIn . "]]></totSqIn>";
$ResponseXML .= "<totSqFt><![CDATA[" . number_format($totSqFt, 2, ".", "") . "]]></totSqFt>";
$ResponseXML .= "<effSqFt><![CDATA[" . number_format($effSqFt, 2, ".", "") . "]]></effSqFt>";

$ResponseXML .= "<val><![CDATA[" . $validation . "]]></val>";
$ResponseXML .= "<valcolor><![CDATA[" . $validationcolor . "]]></valcolor>";


//
//$ResponseXML .= "<sal_com><![CDATA[" . number_format($sal_com, 2, ".", "") . "]]></sal_com>";
//
//$ResponseXML .= "<sal_pri_after_com><![CDATA[" . number_format($sal_pri_after_com, 2, ".", "") . "]]></sal_pri_after_com>";

$ResponseXML .= "</salesdetails>";

echo $ResponseXML;
?>
