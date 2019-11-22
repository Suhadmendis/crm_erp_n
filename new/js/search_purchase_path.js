function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function keyset(key, e) {

    if (e.keyCode == 13) {
        document.getElementById(key).focus();
    }
}

function got_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000066";

}

function lost_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000000";

}

function custno(code, stname) {
    // alert(stname);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_purchase_path_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;
    url = url + "&stname=" + stname;


    xmlHttp.onreadystatechange = passcusresult_quot;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;

        if (stname === "PORN") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("name");
            opener.document.form1.date_of_birth_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("adress");
            opener.document.form1.manual_no.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date_of_birth");
            opener.document.form1.remarks_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "POED") {

            //alert("POED");
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.form1.manual_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("code1");
            opener.document.form1.code1.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.form1.date_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.form1.currency_code.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("exchange_rate");
            opener.document.form1.exchange_rate_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("taransport");
//        opener.document.form1.exchange_rate_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date_of_birth");
//        opener.document.form1.remarks_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
//        
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("supplier");
            opener.document.form1.suppler_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("parame_components");
            opener.document.form1.parame_components_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cost_centre");
            opener.document.form1.cost_centre_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("consoalidate_cost_center");
            opener.document.form1.consoalidate_cost_center.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.form1.remarks_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("non");
            opener.document.form1.non_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("job_no");
            opener.document.form1.Job_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_combination");
            opener.document.form1.tax_combination.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("non_tax");
            opener.document.form1.non_tax_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_discount");
            opener.document.form1.total_discount_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_tax");
            opener.document.form1.total_tax.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_value");
            opener.document.form1.total_value_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "SIVE") {

            //alert("SIVE");    
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.form1.date_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dummy_po_no");
            opener.document.form1.dummy_po_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.form1.currency_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_rate");
            opener.document.form1.currency_rate_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.form1.manual_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("suppler_code");
            opener.document.form1.suppler_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("katuwana_pvt");
            opener.document.form1.katuwana_enterPrises_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("net_amount");
            opener.document.form1.net_amount_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_combination_code");
            opener.document.form1.tax_combination_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("consoalidate_cost");
            opener.document.form1.consoalidate_cost_center_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_amount");
            opener.document.form1.tax_amount_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_credt_amount");
            opener.document.form1.total_credt_amount_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("balance_amount_to_be_alocated");
            opener.document.form1.balance_amount_to_be_alocated.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.form1.remarks_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "GRN") {

            //alert("GRN"); 
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.form1.date_txt.value = XMLAddress1[0].childNodes[0].nodeValue;
////      
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("purchase_order_no");
            opener.document.form1.purchase_order_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_ref_no");
            opener.document.form1.manual_ref_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
//
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.form1.currency_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
//
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dexchange_rate");
            opener.document.form1.exchange_rate_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("suppler_codes");
            opener.document.form1.suppler_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("consoalidate_cost_center");
            opener.document.form1.consoalidate_cost_center.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cost_centre");
            opener.document.form1.cost_centre_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("textfiled");
            opener.document.form1.textfiled_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.form1.remarks_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("textfiled2");
            opener.document.form1.textfiled2_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_combination_code");
            opener.document.form1.tax_combination_code_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("textfiled3");
            opener.document.form1.textfiled3_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_discount");
            opener.document.form1.total_discount_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_tax");
            opener.document.form1.total_tax_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("total_value");
            opener.document.form1.total_value_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "PRNTR") {

            //alert("PRNTR");    
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.getElementById('manual_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.getElementById('remarks').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.getElementById('date').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("job_no");
            opener.document.getElementById('job_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dummy");
            opener.document.getElementById('dummy').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);


        } else if (stname === "POSER") {

            // alert("POSER");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.getElementById('manual_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("po_requisition");
            opener.document.getElementById('po_requisition').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.getElementById('date').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.getElementById('currency_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("exchange_rate");
            opener.document.getElementById('exchange_rate').value = XMLAddress1[0].childNodes[0].nodeValue;

//          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("transport");
//         opener.document.getElementById('transport').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("supplier");
            opener.document.getElementById('supplier').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cost_centre");
            opener.document.getElementById('cost_centre').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.getElementById('remarks').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_combination");
            opener.document.getElementById('tax_combination').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "SUBCONTRACTOR") {

            //alert("SUBCONTRACTOR");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('reference_no_Text').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('scpono_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('tax_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('account_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.getElementById('remarks_txt').value = XMLAddress1[0].childNodes[0].nodeValue;


        } else if (stname === "PAYMENTVOUCHER") {

            // alert("PAYMENTVOUCHER");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('refno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('pvdate_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('currencycode_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('manualno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('supliercode_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.getElementById('payee_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername6");
            opener.document.getElementById('cash_bankac_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
            opener.document.getElementById('remarks_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "GRNNOTE") {

            // alert("PAYMENTVOUCHER");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.getElementById('manual_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.getElementById('date').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.getElementById('currency_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("exchange_rate");
            opener.document.getElementById('exchange_rate').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("supplier");
            opener.document.getElementById('supplier').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("location_code");
            opener.document.getElementById('location_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cost_centre");
            opener.document.getElementById('cost_centre').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.getElementById('remarks').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "GRNRECEIVED") {

            // alert("PAYMENTVOUCHER");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
            opener.document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("date");
            opener.document.getElementById('date').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("purchase_order_no");
            opener.document.getElementById('purchase_order_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manual_no");
            opener.document.getElementById('manual_no').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("currency_code");
            opener.document.getElementById('currency_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("exchange_rate");
            opener.document.getElementById('exchange_rate').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("supplier_code");
            opener.document.getElementById('supplier_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("location_code");
            opener.document.getElementById('location_code').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cost_centre");
            opener.document.getElementById('cost_centre').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("remarks");
            opener.document.getElementById('remarks').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax_combination");
            opener.document.getElementById('tax_combination').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "GRNDETAILS") {

            // alert("GRNDETAILS");

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('reference_no_Text').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('manualrefno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('pono_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('currencycode_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.getElementById('exchange_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername6");
            opener.document.getElementById('suppliercodeno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
            opener.document.getElementById('costcenter_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername8");
            opener.document.getElementById('remarks_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername9");
            opener.document.getElementById('tcomb_txt').value = XMLAddress1[0].childNodes[0].nodeValue;



        }
        setTimeout(function () {
            self.close();
        }, 350);


    }
}
//new 
function updateTable(stname, id) {


//    alert(stname + " : " + id);
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        var url = "search_purchase_path_data.php";
        url = url + "?Command=" + "updateTable";


        if (stname === "PORN") {

            url = url + "&reference_no=" + id;
//           
        } else if (stname === "POSER") {

            url = url + "&reference_no=" + id;

        } else if (stname === "POED") {

            url = url + "&reference_no=" + id;
        } else if (stname === "GRN") {

            url = url + "&reference_no=" + id;

        } else if (stname === "SIVE") {

            url = url + "&reference_no=" + id;

        } else if (stname === "PRNTR") {
//            alert("PRNTR wada");
            url = url + "&reference_no=" + id;
//            alert("hi baby" + url);

        } else if (stname === "") {
//            alert("PRNTR wada");
            url = url + "&reference_no=" + id;
//            alert("hi baby" + url);

        } else if (stname === "GRNRECEIVED") {
//            alert("PRNTR wada");
            url = url + "&reference_no=" + id;
//            alert("hi baby" + url);

        } else if (stname === "GRNNOTE") {
//            alert("PRNTR wada");
            url = url + "&reference_no=" + id;
           // alert("hi baby" + url);

        } else if (stname === "") {
//            alert("PRNTR wada");
            url = url + "&reference_no=" + id;
//            alert("hi baby" + url);

        }

        url = url + "&stname=" + stname;
        xmlHttp.onreadystatechange = update;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    }
}
function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");
//        alert(XMLAddress1);
        opener.document.getElementById("getTable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        window.opener.document.getElementById("itemdetails").hidden = false;

    }
}

function update_cust_list(stname) {

//alert(stname);

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "search_purchase_path_data.php";
    url = url + "?Command=" + "search_custom";



    if (stname === "PORN") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&dateText=" + document.getElementById('dateText').value;

    } else if (stname === "POED") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&job_no=" + document.getElementById('job_no').value;

    } else if (stname === "SIVE") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&currency_code=" + document.getElementById('currency_code').value;

    } else if (stname === "GRN") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_ref_no').value;
        url = url + "&dateText=" + document.getElementById('dateText').value;

    } else if (stname === "PRNTR") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "POSER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SUBCONTRACTOR") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "PAYMENTVOUCHER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "GRNNOTE") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "GRNRECEIVED") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "GRNDETAILS") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    }

    url = url + "&stname=" + stname;
    xmlHttp.onreadystatechange = showcustresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}






function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;

    }
}
