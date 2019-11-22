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

    document.getElementById("arf_no").value = "";
    document.getElementById("reqdate").value = "";
    document.getElementById("dep").value = "";
    document.getElementById("reqby").value = "";
    document.getElementById("amount_w").value = "";
    document.getElementById("ex_settle").value = "";
    document.getElementById("t_amount").value = "";
    document.getElementById("c_favor").value = "";
    document.getElementById("customer_code").value = "";
    document.getElementById("customer_name").value = "";
    document.getElementById("jobnos").value = "";
    document.getElementById("uniq").value = "";


    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "advance_requests_fuel_data.php";
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
        document.getElementById("arf_no").value = XMLAddress1[0].childNodes[0].nodeValue;

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

//    var url = "temporary_manual_invoice_data.php";
//    url = url + "?Command=" + "save_item";
//
//
//    url = url + "&ouraodnumber=" + document.getElementById('ouraodnumber').value;


    var url = "advance_requests_fuel_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&arf_no=" + document.getElementById("arf_no").value;
    url = url + "&reqdate=" + document.getElementById("reqdate").value;
    url = url + "&dep=" + document.getElementById("dep").value;
    url = url + "&reqby=" + document.getElementById("reqby").value;
    url = url + "&amount_w=" + document.getElementById("amount_w").value;
    url = url + "&ex_settle=" + document.getElementById("ex_settle").value;
    url = url + "&t_amount=" + document.getElementById("t_amount").value;
    url = url + "&c_favor=" + document.getElementById("c_favor").value;
    url = url + "&customer_code=" + document.getElementById("customer_code").value;
    url = url + "&customer_name=" + document.getElementById("customer_name").value;
    url = url + "&jobnos=" + document.getElementById("jobnos").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;
    // url = url + "&user=" + "dev";

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

function add_tmp() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "advance_requests_fuel_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

//    url = url + "&aodnumber=" + mid;
    url = url + "&arf_no=" + document.getElementById('arf_no').value;
    url = url + "&vnumber=" + document.getElementById('vnumber').value;
    url = url + "&jb=" + document.getElementById('jb').value;
    url = url + "&rate_arf=" + document.getElementById('rate_arf').value;
    url = url + "&ltrs=" + document.getElementById('ltrs').value;
    url = url + "&amount_arf=" + document.getElementById('amount_arf').value;
    url = url + "&totalkms=" + document.getElementById('totalkms').value;
    url = url + "&avg_fe=" + document.getElementById('avg_fe').value;
    url = url + "&remarks_arf=" + document.getElementById('remarks_arf').value;
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
        document.getElementById('vnumber').value = "";
        document.getElementById('jb').value = "";
        document.getElementById('rate_arf').value = "";
        document.getElementById('ltrs').value = "";
        document.getElementById('amount_arf').value = "";
        document.getElementById('totalkms').value = "";
        document.getElementById('avg_fe').value = "";
        document.getElementById('remarks_arf').value = "";



    }
}


function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "advance_requests_fuel_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&arf_no=" + document.getElementById('arf_no').value;
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









