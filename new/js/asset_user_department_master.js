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
    document.getElementById('ref').value = "";
    document.getElementById('userdept').value = "";
    document.getElementById('user').value = "";
    document.getElementById('uniq').value = "";
    
    getdt();
}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "asset_user_department_master_data.php";
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
        document.getElementById('ref').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById('uniq').value = XMLAddress1[0].childNodes[0].nodeValue;

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

    if (document.getElementById('userdept').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>User Department Not Entered</span></div>";
        return false;
    }


   
    var url = "asset_user_department_master_data.php";
    url = url + "?Command=" + "save_item";
    
   
    url = url + "&ref=" + document.getElementById('ref').value;
    url = url + "&userdept=" + document.getElementById('userdept').value;
    url = url + "&user=" + document.getElementById('user').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    
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
    if (document.getElementById('manualrefno_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Manual No  Not Entered</span></div>";
        return false;
    }

    var url = "asset_user_department_master_data.php";
    url = url + "?Command=" + "update";

    url = url + "&reference_no_Text=" + document.getElementById('reference_no_Text').value;
    url = url + "&date_txt=" + document.getElementById('date_txt').value;
    url = url + "&manualrefno_txt=" + document.getElementById('manualrefno_txt').value;
    url = url + "&pono_txt=" + document.getElementById('pono_txt').value;
    url = url + "&currencycode_txt=" + document.getElementById('currencycode_txt').value;
    url = url + "&exchange_txt=" + document.getElementById('exchange_txt').value;
    url = url + "&suppliercodeno_txt=" + document.getElementById('suppliercodeno_txt').value;
    url = url + "&costcenter_txt=" + document.getElementById('costcenter_txt').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&remarks_txt=" + document.getElementById('remarks_txt').value;
    url = url + "&tcomb_txt=" + document.getElementById('tcomb_txt').value;

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
    if (document.getElementById('manualrefno_txt').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Please select an added record</span></div>";
        return false;
    }

    var url = "asset_user_department_master_data.php";
    url = url + "?Command=" + "delete";
    url = url + "&reference_no_Text=" + document.getElementById('reference_no_Text').value;


    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function delete2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "deleted") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";

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

    var url = "asset_user_department_master_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

//    url = url + "&aodnumber=" + mid;
    url = url + "&reference_no_Text=" + document.getElementById('reference_no_Text').value;
    url = url + "&prod_discription=" + document.getElementById('prod_discription').value;
    url = url + "&p_quantity=" + document.getElementById('p_quantity').value;
    url = url + "&pur_price=" + document.getElementById('pur_price').value;
    url = url + "&p_discount=" + document.getElementById('p_discount').value;
    url = url + "&p_value=" + document.getElementById('p_value').value;
    url = url + "&p_taxcomb=" + document.getElementById('p_taxcomb').value;

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
              
        //document.getElementById('reference_no_Text').value;
        document.getElementById('prod_discription').value;
        document.getElementById('p_quantity').value;
        document.getElementById('pur_price').value;
        document.getElementById('p_discount').value;
        document.getElementById('p_value').value;
        document.getElementById('p_taxcomb').value;



    }
}


function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "asset_user_department_master_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&reference_no_Text=" + document.getElementById('reference_no_Text').value;
    
    url = url + "&id=" + id;
//   alert(url);

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

















