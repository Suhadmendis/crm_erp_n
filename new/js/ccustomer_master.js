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

    document.getElementById("ref_id").value = "";
    document.getElementById("uniq").value = "";
    document.getElementById("name").value = "";
    document.getElementById("tel").value = "";
    document.getElementById("website").value = "";
    document.getElementById("addr").value = "";
    document.getElementById("mobile").value = "";
    document.getElementById("email").value = "";
    document.getElementById("idno").value = "";
    document.getElementById("faxno").value = "";
    document.getElementById("dob").value = "";
    document.getElementById("ac_code").value = "";
    document.getElementById("g_l_ac").value = "";
    document.getElementById("adv_ac_code").value = "";
    document.getElementById("con_person").value = "";
    document.getElementById("con_tel").value = "";
    document.getElementById("con_addr").value = "";
    document.getElementById("con_mobile").value = "";
    document.getElementById("con_fax").value = "";
    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "ccustomer_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";
    url = url + "&CAT=" + document.getElementById("vendor").value;

    xmlHttp.onreadystatechange = get_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function get_dt() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        document.getElementById("ref_id").value = XMLAddress1[0].childNodes[0].nodeValue;

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
    
    if (document.getElementById('name').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Customer Name  Not Entered</span></div>";
        return false;
    }
    var url = "ccustomer_master_data.php";
    url = url + "?Command=" + "save_content";

    url = url + "&ref_id=" + document.getElementById("ref_id").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;
    url = url + "&name=" + document.getElementById("name").value;
    url = url + "&tel=" + document.getElementById("tel").value;
    url = url + "&website=" + document.getElementById("website").value;
    url = url + "&addr=" + document.getElementById("addr").value;
    url = url + "&mobile=" + document.getElementById("mobile").value;
    url = url + "&email=" + document.getElementById("email").value;
    url = url + "&idno=" + document.getElementById("idno").value;
    url = url + "&faxno=" + document.getElementById("faxno").value;
    url = url + "&dob=" + document.getElementById("dob").value;
    url = url + "&ac_code=" + document.getElementById("ac_code").value;
    url = url + "&g_l_ac=" + document.getElementById("g_l_ac").value;
    url = url + "&adv_ac_code=" + document.getElementById("adv_ac_code").value;
    url = url + "&con_person=" + document.getElementById("con_person").value;
    url = url + "&con_tel=" + document.getElementById("con_tel").value;
    url = url + "&con_addr=" + document.getElementById("con_addr").value;
    url = url + "&con_mobile=" + document.getElementById("con_mobile").value;
    url = url + "&con_fax=" + document.getElementById("con_fax").value;
    url = url + "&vendor=" + document.getElementById("vendor").value;



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

function delete1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "ccustomer_master_data.php";
    url = url + "?Command=" + "delete";


    url = url + "&ref_id=" + document.getElementById('ref_id').value;

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
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}









