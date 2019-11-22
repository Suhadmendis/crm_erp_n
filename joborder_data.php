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

    
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from joborder where jid = '" . $_GET['jcode'] . "'";
        $result = $conn->query($sql);

    $sql = "Insert into joborder(jid,joborderref,jobdate,QuotationRef,CostingRef,JobRequestRef,ManualRef,Customer,jobnew,jrepeat,MarketingEx,RepeatPreviousJBNRef,ProductDescription,Instructions,CustomerPONo,JobQty,Location,SalesPrice,TotalValue,joblength,jobwidth,NoofColors,NoofImp)values 
                        ('" . $_GET['jcode'] . "','" . $_GET['joborderref'] . "','" . $_GET['jdate'] . "','" . $_GET['QuotationRef'] . "','" . $_GET['CostingRef'] . "','" . $_GET['JobRequestRef'] . "','" . $_GET['ManualRef'] . "','" . $_GET['Customer'] . "','" . $_GET['jnew'] . "','" . $_GET['jrepeat'] . "','" . $_GET['MarketingEx'] . "','" . $_GET['RepeatPreviousJBNRef'] . "','" . $_GET['ProductDescription'] . "','" . $_GET['Instructions'] . "','" . $_GET['CustomerPONo'] . "','" . $_GET['JobQty'] . "','" . $_GET['Location'] . "','" . $_GET['SalesPrice'] . "','" . $_GET['TotalValue'] . "','" . $_GET['jlength'] . "','" . $_GET['jwidth'] . "','" . $_GET['NoofColors'] . "','" . $_GET['NoofImpressions'] . "')";
        $result = $conn->query($sql);

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
?>
