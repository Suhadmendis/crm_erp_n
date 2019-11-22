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

//$(document).ready(function () {
//    $("#sdate").datepicker({
//        format: 'yyyy-mm-dd'
//    });
//});


function new_inv() {

}

function csChange() {

    var SVAT = "0";
    var TAX = "0";
    var Invoice = "0";

    var usd = "0";
    var lkr = "0";


    if (document.getElementById("SVAT").checked) {
        SVAT = "1";
    }
    if (document.getElementById("TAX").checked) {
        TAX = "1";
    }
    if (document.getElementById("Invoice").checked) {
        Invoice = "1";
    }

    if (document.getElementById("USD").checked) {
        usd = "1";
    } else {
        usd = "0";
    }

    if (document.getElementById("LKR").checked) {
        lkr = "1";
    } else {
        lkr = "0";
    }


//alert(SVAT+" "+TAX+" "+Invoice+" ");

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "list_costing_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    url = url + "&sdate=" + document.getElementById("sdate").value;
    url = url + "&edate=" + document.getElementById("edate").value;
    url = url + "&svat=" + SVAT;
    url = url + "&tax=" + TAX;
    url = url + "&invoice=" + Invoice;

    url = url + "&usd=" + usd;
    url = url + "&lkr=" + lkr;



    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function assign_dt() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("td");
        document.getElementById('getTable').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
    }
}