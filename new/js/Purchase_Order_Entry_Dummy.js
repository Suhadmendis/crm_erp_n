
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
    document.getElementById('manual_no_Text').value = "";
    document.getElementById('code1').value = "";
    document.getElementById('date_txt').value = "";
    document.getElementById('currency_code').value = "";
    document.getElementById('exchange_rate_Text').value = "";
    document.getElementById('local').checked = true;
//    document.getElementById('radio2').checked = false;
//    document.getElementById('radio3').checked = false;
    document.getElementById('suppler_Text').value = "";
    document.getElementById('parame_components_Text').value = "";
    document.getElementById('cost_centre_Text').value = "";
    document.getElementById('consoalidate_cost_center').value = "";
    document.getElementById('remarks_Text').value = "";
    document.getElementById('non_Text').value = "";
    document.getElementById('Job_no_Text').value = "";
    document.getElementById('tax_combination').value = "";
    document.getElementById('non_tax_Text').value = "";
    document.getElementById('tax_combination').value = "";
    document.getElementById('total_discount_Text').value = "";
    document.getElementById('total_tax').value = "";
    document.getElementById('uniq').value = "";
    document.getElementById('msg_box').innerHTML  = "";
    uniq
    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Purchase_Order_Entry_Dummy_data.php";
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
//
//    if (document.getElementById('reference_no_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('manual_no_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Manual No Not Enterd</span></div>";
//        return false;
//    }
//     if (document.getElementById('code1').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Code  Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('date_txt').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('currency_code').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>LKR Not Selected</span></div>";
//        return false;
//    }
//    if (document.getElementById('exchange_rate_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Exchange Rate Not Enterd</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('suppler_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Suppler  Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('parame_components_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>PRME COMPONENTS Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('cost_centre_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Cost Centre Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('cost_centre_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Cost Centre Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('consoalidate_cost_center').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Consoalidate Cost Center Not Enterd</span></div>";
//        return false;
//    }
//    
//    if (document.getElementById('remarks_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Remarks Not Enterd</span></div>";
//        return false;
//    }
    
                                    //    if (document.getElementById('non_Text').value == "") {
                                    //        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Consoalidate Cost Center Not Enterd</span></div>";
                                    //        return false;
                                    //    }
    
//    if (document.getElementById('tax_combination').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tax Combination Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('non_tax_Text').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Non Tax Not Enterd</span></div>";
//        return false;
//    }
//    
    
    var url = "Purchase_Order_Entry_Dummy_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&reference_no=" + document.getElementById('reference_no_Text').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&manual_no=" + document.getElementById('manual_no_Text').value;
    url = url + "&code1=" + document.getElementById('code1').value;
    url = url + "&date=" + document.getElementById('date_txt').value;
    url = url + "&currency_code=" + document.getElementById('currency_code').value;
    url = url + "&exchange_rate=" + document.getElementById('exchange_rate_Text').value;
   
    
            var shipingMethod = "";
            if(document.getElementById('local').checked){
                shipingMethod='L';   
            }else{
                if(document.getElementById('sea').checked){
                shipingMethod='S';   
            }else{
                if(document.getElementById('air').checked){
                shipingMethod='A';     
            }
            else{
        }
      }
   }
    url = url + "&supplier=" + document.getElementById('suppler_Text').value;
    url = url + "&parame_components=" + document.getElementById('parame_components_Text').value;
    url = url + "&cost_centre=" + document.getElementById('cost_centre_Text').value;
    url = url + "&consoalidate_cost_center=" + document.getElementById('consoalidate_cost_center').value;
    url = url + "&remarks=" + document.getElementById('remarks_Text').value;
    url = url + "&non=" + document.getElementById('non_Text').value;
    url = url + "&job_no=" + document.getElementById('Job_no_Text').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination').value;
    url = url + "&non_tax=" + document.getElementById('non_tax_Text').value;
    url = url + "&total_discount=" + document.getElementById('total_discount_Text').value;
    url = url + "&total_tax=" + document.getElementById('total_tax').value;
    url = url + "&total_value=" + document.getElementById('total_value_Text').value;
    url = url + "&shipingMethod=" + shipingMethod;
    
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
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Reference No Not Entered</span></div>";
        return false;
    }

    var url = "Purchase_Order_Entry_Dummy_data.php";
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
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
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

    var url = "Purchase_Order_Entry_Dummy_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    
    url = url + "&reference_no=" + document.getElementById('reference_no_Text').value;
    url = url + "&rec_no=" + document.getElementById('rec_no_Text').value;
    url = url + "&product_de=" + document.getElementById('Product_Des_Text').value;
    url = url + "&quantity=" + document.getElementById('quantity_Text').value;
    url = url + "&parchase_price=" + document.getElementById('parchase_price_Text').value;
    url = url + "&discount=" + document.getElementById('discount_Text').value;
    url = url + "&value_s=" + document.getElementById('value_Text').value;
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

    var url = "Purchase_Order_Entry_Dummy_data.php";
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