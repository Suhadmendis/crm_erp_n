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
    document.getElementById("txt_aircode").value = "";
    document.getElementById("txt_airname").value = "";
    document.getElementById("txt_country").value = "";
    document.getElementById("txt_town").value = "";
    document.getElementById("txt_other").value = "";
    
    document.getElementById("msg_box").innerHTML="";

    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Airport_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function assign_dt() {
    document.getElementById('itemdetails').innerHTML = xmlHttp.responseText;
}


function getbycode(cdata) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Airport_data.php";
    url = url + "?Command=" + "getdt";

    url = url + "&ls=" + cdata;

    url = url + "&txt_aircode=" + document.getElementById('txt_aircode').value;

    url = url + "&txt_airname=" + document.getElementById('txt_airname').value;
    url = url + "&txt_country=" + document.getElementById('txt_country').value;
    url = url + "&txt_town=" + document.getElementById('txt_town').value;
    url = url + "&txt_other=" + document.getElementById('txt_other').value;

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function getbyname() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Airport_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "name";

    url = url + "&txt_aircode=" + document.getElementById('txt_aircode').value;
    url = url + "&txt_airname=" + document.getElementById('txt_airname').value;
    url = url + "&txt_country=" + document.getElementById('txt_country').value;
    url = url + "&txt_town=" + document.getElementById('txt_town').value;
    url = url + "&txt_other=" + document.getElementById('txt_other').value;

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function getcode(cdate) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Airport_data.php";
    url = url + "?Command=" + "getcode";
    url = url + "&code=" + cdate;

    xmlHttp.onreadystatechange = assign_data;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function assign_data() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("code");
        document.getElementById('txt_aircode').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("port");
        document.getElementById('txt_airname').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("country");
        document.getElementById('txt_country').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("town");
        document.getElementById('txt_town').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("other");
        document.getElementById('txt_other').value = XMLAddress1[0].childNodes[0].nodeValue;


        window.scrollTo(0, 0);
    }
}


function del_item() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Airport_data.php";
    url = url + "?Command=" + "del_item";

    url = url + "&txt_aircode=" + document.getElementById('txt_aircode').value;
    
    xmlHttp.onreadystatechange = del;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function del() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "del") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";
            newent();
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('txt_aircode').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Airport Code Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_airname').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Airport Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('txt_country').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Country Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_town').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Town Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_other').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Other Not Enterd</span></div>";
        return false;
    }


    var url = "Airport_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&txt_aircode=" + document.getElementById('txt_aircode').value;
    url = url + "&txt_airname=" + document.getElementById('txt_airname').value;
    url = url + "&txt_country=" + document.getElementById('txt_country').value;
    url = url + "&txt_town=" + document.getElementById('txt_town').value;
    url = url + "&txt_other=" + document.getElementById('txt_other').value;



    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
            newent();
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

