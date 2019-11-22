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
    document.getElementById('vref_txt').value = "";
    document.getElementById('vehicle_no_txt').value = "";
    document.getElementById('vehicle_type_txt').value = "";
    document.getElementById('name_of_user_txt').value = "";
    document.getElementById('fuel_limit_ltr_txt').value = "";
    document.getElementById('fuel_limit_rupees_txt').value = "";
    document.getElementById('remarks_txt').value = "";
    document.getElementById('uniq').value = "";
    document.getElementById('msg_box').innerHTML = "";

    getdt();
}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "vehicle_master_data.php";
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
        document.getElementById('vref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

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

    if (document.getElementById('vehicle_no_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Vehicle Name  Not Entered</span></div>";
        return false;
    }

    var url = "vehicle_master_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&vref_txt=" + document.getElementById('vref_txt').value;
    url = url + "&vehicle_no_txt=" + document.getElementById('vehicle_no_txt').value;
    url = url + "&vehicle_type_txt=" + document.getElementById('vehicle_type_txt').value;
    url = url + "&name_of_user_txt=" + document.getElementById('name_of_user_txt').value;
    url = url + "&fuel_limit_ltr_txt=" + document.getElementById('fuel_limit_ltr_txt').value;
    url = url + "&fuel_limit_rupees_txt=" + document.getElementById('fuel_limit_rupees_txt').value;
    url = url + "&remarks_txt=" + document.getElementById('remarks_txt').value;

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
    if (document.getElementById('vehicle_no_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Vehicle Name  Not Entered</span></div>";
        return false;
    }

    var url = "vehicle_master_data.php";
    url = url + "?Command=" + "update";

    url = url + "&vref_txt=" + document.getElementById('vref_txt').value;
    url = url + "&vehicle_no_txt=" + document.getElementById('vehicle_no_txt').value;
    url = url + "&vehicle_type_txt=" + document.getElementById('vehicle_type_txt').value;
    url = url + "&name_of_user_txt=" + document.getElementById('name_of_user_txt').value;
    url = url + "&fuel_limit_ltr_txt=" + document.getElementById('fuel_limit_ltr_txt').value;
    url = url + "&fuel_limit_rupees_txt=" + document.getElementById('fuel_limit_rupees_txt').value;
    url = url + "&remarks_txt=" + document.getElementById('remarks_txt').value;

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
    if (document.getElementById('vehicle_no_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Vehicle Name  Not Entered</span></div>";
        return false;
    }

    var url = "vehicle_master_data.php";
    url = url + "?Command=" + "delete";

    url = url + "&vref_txt=" + document.getElementById('vref_txt').value;

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








