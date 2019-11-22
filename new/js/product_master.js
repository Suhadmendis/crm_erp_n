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

    document.getElementById("prod_ref").value = "";
    document.getElementById("up_flag").value = "New";
    document.getElementById("uniq").value = "";
    document.getElementById("prod_name").value = "";
    document.getElementById("prod_uom").value = "";
    document.getElementById("group1").value = "";
    document.getElementById("grp_type").value = "";
    document.getElementById("prod_length").value = "";
    document.getElementById("prod_width").value = "";
    document.getElementById("prod_height").value = "";
    document.getElementById("w_inches").value = "";
    document.getElementById("sqf").value = "";
    document.getElementById("LC_1").value = "";
    document.getElementById("LC_2").value = "";
    document.getElementById("LC_3").value = "";
    document.getElementById("LC_4").value = "";
    document.getElementById("LN_1").value = "";
    document.getElementById("LN_2").value = "";
    document.getElementById("LN_3").value = "";
    document.getElementById("LN_4").value = "";
    document.getElementById('status').checked = false;
    


    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "product_master_data.php";
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
        document.getElementById("prod_ref").value = XMLAddress1[0].childNodes[0].nodeValue;

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
     var status = "I";

    if (document.getElementById('status').checked) {
        status = "A";

    }

//    var url = "temporary_manual_invoice_data.php";
//    url = url + "?Command=" + "save_item";
//
//
//    url = url + "&ouraodnumber=" + document.getElementById('ouraodnumber').value;
    var url = "product_master_data.php";
    url = url + "?Command=" + "save_content";
    
    url = url + "&prod_ref=" + document.getElementById("prod_ref").value ;
    url = url + "&uniq=" + document.getElementById("uniq").value ;
    url = url + "&prod_name=" + document.getElementById("prod_name").value ;
    url = url + "&prod_uom=" + document.getElementById("prod_uom").value ;
    url = url + "&group1=" + document.getElementById("group1").value ;
    url = url + "&grp_type=" + document.getElementById("grp_type").value ;
    url = url + "&prod_length=" + document.getElementById("prod_length").value ;
    url = url + "&prod_width=" + document.getElementById("prod_width").value ;
    url = url + "&prod_height=" + document.getElementById("prod_height").value;
    url = url + "&w_inches=" + document.getElementById("w_inches").value;
    url = url + "&sqf=" + document.getElementById("sqf").value;
    url = url + "&up_flag=" + document.getElementById("up_flag").value;

    url = url + "&LC_1=" + document.getElementById("LC_1").value;
    url = url + "&LC_2=" + document.getElementById("LC_2").value;
    url = url + "&LC_3=" + document.getElementById("LC_3").value;
    url = url + "&LC_4=" + document.getElementById("LC_4").value;
    
    url = url + "&status=" + status;
   
    
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

    var url = "product_master_data.php";
    url = url + "?Command=" + "delete";


    url = url + "&prod_ref=" + document.getElementById('prod_ref').value;

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










