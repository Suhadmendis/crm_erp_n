
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
    document.getElementById('reference_no').value = "";
    ;
    document.getElementById('addition').checked = true;
//    document.getElementById('date').value = "";
    document.getElementById('manual_no').value = "";
//    document.getElementById('location_code').value = "";
//    document.getElementById('location_code2').value = "";
//    document.getElementById('cost_center').value = "";
//    document.getElementById('cost_center2').value = "";
    document.getElementById('remarks').value = "";
//    document.getElementById('reason').value = "";
//    document.getElementById('reason2').value = "";


    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "adjustments_addition_deduction_data.php";
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
//        var id  = XMLAddress1[0].childNodes[0].nodeValue;
        document.form1.reference_no.value = XMLAddress1[0].childNodes[0].nodeValue;

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
    var url = "adjustments_addition_deduction_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    var shipingMethod = "";
    if (document.getElementById('addition').checked) {
        addition = '1';
        if(addition ===1){
            addition = '1';
        }else{
             deduction = '0';
//             alert("efwe");
        }       
    } else {
        if (document.getElementById('deduction').checked) {
            deduction = '1';
             if(deduction ===1){
            addition = '1';
        }else{
             addition = '0';
//             alert("efwe");
          }
        } else {             
        }
    }

    url = url + "&addition=" + addition;
    url = url + "&deduction=" + deduction;
    url = url + "&date=" + document.getElementById('date').value;
    url = url + "&manual_no=" + document.getElementById('manual_no').value;
//    url = url + "&location_code=" + document.getElementById('location_code').value;
//    url = url + "&location_code2=" + document.getElementById('location_code2').value;
//    url = url + "&cost_center=" + document.getElementById('cost_center').value;
//    url = url + "&cost_center2=" + document.getElementById('cost_center2').value;
    url = url + "&remarks=" + document.getElementById('remarks').value;
//    url = url + "&reason=" + document.getElementById('reason').value;
//    url = url + "&reason2=" + document.getElementById('reason2').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

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
    if (document.getElementById('reference_no').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Reference No Entered</span></div>";
        $("#msg_box").hide().slideDown(400).delay(2000);
        $("#msg_box").slideUp(400);
        return false;
    }

    var url = "adjustments_addition_deduction_data.php";
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
    var url = "adjustments_addition_deduction_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&rec_no=" + document.getElementById('rec_no').value;
    url = url + "&product_code=" + document.getElementById('product_code').value;
    url = url + "&product_Des=" + document.getElementById('Product_Des').value;
//    alert(url);
    url = url + "&qty_on_hand=" + document.getElementById('qty_on_hand').value;
    url = url + "&quantity=" + document.getElementById('quantity').value;
    url = url + "&rate=" + document.getElementById('rate').value;
    url = url + "&reason=" + document.getElementById('reason').value;
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

    var url = "adjustments_addition_deduction_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
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