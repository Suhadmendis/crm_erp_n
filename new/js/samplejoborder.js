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
    
    document.getElementById('sjrequestno_txt').value = "";
    document.getElementById('sjbref_txt').value = "";
    document.getElementById('date_txt').value = "";
    document.getElementById('customer_txt').value = "";
    document.getElementById('mkex_txt').value = "";
    document.getElementById('msg_box').innerHTML = "";
    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "samplejoborder_data.php";
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
        document.getElementById('sjbref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
    }
}

function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    document.getElementById('msg_box').innerHTML = "";
    if (document.getElementById('sjrequestno_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Code Not Enterd</span></div>";
        return false;
    }
   // split and remove before zeros
    var id = document.getElementById('sjrequestref_txt').value;
    var split = id.split("/");
    var mid = parseInt(split[1]);
//

    var url = "samplejoborder_data.php";
    url = url + "?Command=" + "save_item";

url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&sjrequestref=" + document.getElementById('sjrequestno_txt').value;
    url = url + "&sjbref=" + document.getElementById('sjbref_txt').value;
    url = url + "&date_in=" + document.getElementById('date_txt').value;
    url = url + "&customer=" + document.getElementById('customer_txt').value;
    url = url + "&mkex=" + document.getElementById('mkex_txt').value;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
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

    document.getElementById('msg_box').innerHTML = "";

    if (document.getElementById('tid_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Item Code Not Enterd</span></div>";
        return false;
    }


    var url = "samplejoborder_data.php";
    url = url + "?Command=" + "update";


    url = url + "&tid=" + document.getElementById('tid_txt').value;
    url = url + "&lcno=" + document.getElementById('lcno_txt').value;
    url = url + "&bankdate=" + document.getElementById('bankdate_txt').value;
    url = url + "&spname=" + document.getElementById('spname_txt').value;
    url = url + "&fc=" + document.getElementById('fc_txt').value;
    url = url + "&fcrate=" + document.getElementById('fcrate_txt').value;
    url = url + "&fcamt=" + document.getElementById('fcamt_txt').value;
    url = url + "&slramt=" + document.getElementById('slramt_txt').value;
    url = url + "&expdate=" + document.getElementById('expdate_txt').value;
    url = url + "&fcbalance=" + document.getElementById('fcbalance_txt').value;


    xmlHttp.onreadystatechange = update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "update") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Updated</span></div>";

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

    var url = "samplejoborder_data.php";
    url = url + "?Command=" + "delete";


    url = url + "&tid=" + document.getElementById('tid_txt').value;
    document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Item Code Not Enterd</span></div>";

    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


//    xmlHttp.open("GET", url, true);
//    xmlHttp.send(null);
}

function delete2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "delete") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Deleted</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function cancel() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('tid_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Please enter an added record</span></div>";
        return false;
    }

    var url = "samplejoborder_data.php";
    url = url + "?Command=" + "cancel";


    url = url + "&tid=" + document.getElementById('tid_txt').value;

    xmlHttp.onreadystatechange = cancel2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function cancel2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "canceled") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Canceled</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}














