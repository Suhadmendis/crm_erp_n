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




function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    document.getElementById("se_ref").value = "";
    document.getElementById("nic").value = "";
    document.getElementById("se_name").value = "";
    document.getElementById("addr").value = "";
    document.getElementById("mobile").value = "";
    document.getElementById("email").value = "";
    document.getElementById("uniq").value = "";


    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sales_executive_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = get_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function get_dt() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        document.getElementById("se_ref").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}




function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "sales_executive_master_data.php";
    url = url + "?Command=" + "save_content";

    url = url + "&se_ref=" + document.getElementById("se_ref").value;
    url = url + "&nic=" + document.getElementById("nic").value;
    url = url + "&se_name=" + document.getElementById("se_name").value;
    url = url + "&addr=" + document.getElementById("addr").value;
    url = url + "&mobile=" + document.getElementById("mobile").value;
    url = url + "&email=" + document.getElementById("email").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;


    xmlHttp.onreadystatechange = added;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function added() {
    var XMLAddress1;
    if (xmlHttp.readyState === 4 || xmlHttp.readyState === "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";

            //document.getElementById('filup').style.visibility = "visible";
            $("#msg_box").hide().slideDown(200).delay(1500);
            $("#msg_box").slideUp(200);



        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

