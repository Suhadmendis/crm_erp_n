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
    document.getElementById('uniq').value = "";
    document.getElementById('reference_no').value = "";
    document.getElementById('manual_no').value = "";
    document.getElementById('po_requisition').value = "";
    document.getElementById('date').value = "";
    document.getElementById('currency_code').value = "";
    document.getElementById('exchange_rate').value = "";
    //document.getElementById('transport').value = "";
    document.getElementById('supplier').value = "";
    document.getElementById('cost_centre').value = "";
    document.getElementById('remarks').value = "";
    document.getElementById('tax_combination').value = "";
    document.getElementById('local').checked = true;
    
   
    
  
    getdt();
     
}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "purchase_order_entry_data.php";
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
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
        document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
//
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById('uniq').value = XMLAddress1[0].childNodes[0].nodeValue;
        
    }
}

function save_inv()
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
//    if (document.getElementById('reference_no').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference No  Not Entered</span></div>";
//        return false;
//    }
//
//
//    if (document.getElementById('manual_no').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Manual No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('po_requisition').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>po Requisition  Not Entered</span></div>";
//        return false;
//    }
//    if (document.getElementById('date').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('currency_code').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>currency code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('exchange_rate').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>exchange rate Not Selected</span></div>";
//        return false;
//    }
//    if (document.getElementById('supplier').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>supplier Not Enterd</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('cost_centre').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>cost centre Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('remarks').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>remarks Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('tax_combination').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tax combination  Not Enterd</span></div>";
//        return false;
//    }
    var shipping_method = "";
    if (document.getElementById("local").checked) {
        shipping_method = "LOCAL";
    } else {
        if (document.getElementById("sea").checked) {
            shipping_method = "SEA";
        } else {
            if (document.getElementById("air").checked) {
                shipping_method = "AIR";
            } else {
            }
        }
    }
    var url = "purchase_order_entry_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&manual_no=" + document.getElementById('manual_no').value;
    url = url + "&po_requisition=" + document.getElementById('po_requisition').value;
    url = url + "&date=" + document.getElementById('date').value;
    url = url + "&currency_code=" + document.getElementById('currency_code').value;
    url = url + "&exchange_rate=" + document.getElementById('exchange_rate').value;
    // url = url + "&transport=" + document.getElementById('transport').value;
    url = url + "&shipping_method=" + shipping_method;
    url = url + "&supplier=" + document.getElementById('supplier').value;
    url = url + "&cost_centre=" + document.getElementById('cost_centre').value;
    url = url + "&remarks=" + document.getElementById('remarks').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    
    xmlHttp.onreadystatechange = salessaveresult;
    
    
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
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


function edit() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('reference_no').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference NO  Not Entered</span></div>";
        return false;
    }

    var url = "purchase_order_entry_data.php";
    url = url + "?Command=" + "update";

    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&manual_no=" + document.getElementById('manual_no').value;
    url = url + "&po_requisition=" + document.getElementById('po_requisition').value;
    url = url + "&date=" + document.getElementById('date').value;
    url = url + "&currency_code=" + document.getElementById('currency_code').value;
    url = url + "&exchange_rate=" + document.getElementById('exchange_rate').value;
    //url = url + "&transport=" + document.getElementById('transport').value;
    url = url + "&supplier=" + document.getElementById('supplier').value;
    url = url + "&cost_centre=" + document.getElementById('cost_centre').value;
    url = url + "&remarks=" + document.getElementById('remarks').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination').value;

    xmlHttp.onreadystatechange = update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function update() {
 
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "update") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Updated</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
    
}


function delete1() {
   
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('reference_no').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Reference No  Not Entered</span></div>";
        return false;
    }

    var url = "purchase_order_entry_data.php";
    url = url + "?Command=" + "delete";

    url = url + "&reference_no=" + document.getElementById('reference_no').value;

    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function delete2() {
    
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "delete") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
    
}

function add_tmp() {
   
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
   
    var url = "purchase_order_entry_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    
    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&rec_no=" + document.getElementById('rec_no').value;
    url = url + "&product_code=" + document.getElementById('product_code').value;
    url = url + "&product_description=" + document.getElementById('product_description').value;
    url = url + "&req_bal=" + document.getElementById('req_bal').value;
    url = url + "&quantity=" + document.getElementById('quantity').value;
    url = url + "&purchase_price=" + document.getElementById('purchase_price').value;
    url = url + "&discount=" + document.getElementById('discount').value;
    url = url + "&po_value=" + document.getElementById('po_value').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination_Text').value;
//      alert(url);
    url = url + "&uniq=" + document.getElementById('uniq').value;
  
    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function aodtmp() {
    
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

//        document.getElementById('rec_no').value = "";
//        document.getElementById('product_code').value = "";
//        document.getElementById('product_description').value = "";
//        document.getElementById('req_bal').value = "";
//        document.getElementById('quantity').value = "";
//        document.getElementById('purchase_price').value = "";
//        document.getElementById('discount').value = "";
//        document.getElementById('po_value').value = "";
//        document.getElementById('tax_combination_Text').value = "";

    }
}

function remove_tmp(id) {
 
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "purchase_order_entry_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    
//    url = url + "&sjrequestref=" + document.getElementById('sjrequestref_txt').value;
    url = url + "&id=" + id;


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










