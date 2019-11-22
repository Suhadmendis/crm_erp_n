
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

function newent() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    document.getElementById('reference_no_Text').value = "";;
    document.getElementById('date_Text').value = "";
    document.getElementById('dummy_po_no_Text').value = "";
    document.getElementById('currency_code_Text').value = "";
    document.getElementById('currency_rate_Text').value = "";
    document.getElementById('manual_no_Text').value = "";
    document.getElementById('suppler_code_Text').value = "";
    document.getElementById('katuwana_enterPrises_Text').value = "";
    document.getElementById('net_amount_Text').value = "";
    document.getElementById('tax_combination_code_Text').value = "";
    document.getElementById('consoalidate_cost_center_Text').value = "";
    document.getElementById('tax_amount_Text').value = "";
    document.getElementById('total_credt_amount_Text').value = "";
    document.getElementById('balance_amount_to_be_alocated').value = "";
    document.getElementById('remarks_Text').value = "";
    document.getElementById('msg_box').innerHTML  = "";

    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sarvice_invoice_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function assign_dt() {
   
     var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
    document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;
   
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
    document.form1.uniq.value = XMLAddress1[0].childNodes[0].nodeValue;
    }
}
function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

//    if (document.getElementById('reference_no_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('date_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date Not Enterd</span></div>";
//        return false;
//    }
//     if (document.getElementById('dummy_po_no_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Dummy PO No Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('currency_code_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Currency Code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('currency_rate_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Currency Rate Not Selected</span></div>";
//        return false;
//    }
//    if (document.getElementById('manual_no_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Manual No Rate Not Enterd</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('suppler_code_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Suppler Code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('katuwana_enterPrises_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Katuwana EnterPrises Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('net_amount_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Net Amount Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('tax_combination_code_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tax Combination Code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('consoalidate_cost_center_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Consoalidate Cost Center Not Enterd</span></div>";
//        return false;
//    }
//    
//    if (document.getElementById('tax_amount_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tax Amount Not Enterd</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('total_credt_amount_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Total Credt Amount Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('balance_amount_to_be_alocated').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Balance Amount To Be Alocated Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('balance_amount_to_be_alocated').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Balance Amount To Be Alocated Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('remarks_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Remarks Not Enterd</span></div>";
//        return false;
//    }
//    
    
    var url = "sarvice_invoice_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&reference_no=" + document.getElementById('reference_no_Text').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&date=" + document.getElementById('date_Text').value;
    url = url + "&dummy_po_no=" + document.getElementById('dummy_po_no_Text').value;
    url = url + "&currency_code=" + document.getElementById('currency_code_Text').value;
    url = url + "&currency_rate=" + document.getElementById('currency_rate_Text').value;
    url = url + "&manual_no=" + document.getElementById('manual_no_Text').value;
    url = url + "&suppler_code=" + document.getElementById('suppler_code_Text').value;
    url = url + "&katuwana_pvt=" + document.getElementById('katuwana_enterPrises_Text').value;
    url = url + "&net_amount=" + document.getElementById('net_amount_Text').value;
    url = url + "&tax_combination_code=" + document.getElementById('tax_combination_code_Text').value;
    url = url + "&consoalidate_cost=" + document.getElementById('consoalidate_cost_center_Text').value;
    url = url + "&tax_amount=" + document.getElementById('tax_amount_Text').value;
    url = url + "&total_credt_amount=" + document.getElementById('total_credt_amount_Text').value;
    url = url + "&balance_amount_to_be_alocated=" + document.getElementById('balance_amount_to_be_alocated').value;
    url = url + "&remarks=" + document.getElementById('remarks_Text').value;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function delete1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('reference_no_Text').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Vehicle Name  Not Entered</span></div>";
        return false;
    }

    var url = "sarvice_invoice_data.php";
    url = url + "?Command=" + "delete";

    url = url + "&reference_no_Text=" + document.getElementById('reference_no_Text').value;

    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function delete2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "delete") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function add_tmp() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sarvice_invoice_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    
    url = url + "&reference_no=" + document.getElementById('reference_no_Text').value;
    url = url + "&rec_no=" + document.getElementById('rec_no_Text').value;
    url = url + "&account_name=" + document.getElementById('account_name_Text').value;
    url = url + "&apply_tax=" + document.getElementById('apply_tax_Text').value;
    url = url + "&allocated_amount=" + document.getElementById('allocated_amount_Text').value;
    url = url + "&tax_amount=" + document.getElementById('tax_amount_Text').value;
    url = url + "&total_Amount=" + document.getElementById('total_Amount_Tax').value;
    url = url + "&job_no=" + document.getElementById('job_no_Text').value;
    url = url + "&remark=" + document.getElementById('remarks_Text2').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
//    alert(url);
    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

    }
}

function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sarvice_invoice_data.php";
    url = url + "?Command=" + "removerow";

     url = url + "&uniq=" + document.getElementById('uniq').value;
//    url = url + "&sjrequestref=" + document.getElementById('sjrequestref_txt').value;
      url = url + "&id=" + id;
   // url = url + "&uniq=" + document.getElementById('uniq').value;


    xmlHttp.onreadystatechange = removeAdo;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function removeAdo() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

    }
}