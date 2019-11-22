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

    document.getElementById("refno").value = "";
    document.getElementById("uniq").value = "";
    document.getElementById("reference").value = "";
    document.getElementById("mr_date").value = "";
    document.getElementById("dept").value = "";
    
    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "meal_reimbursement_data.php";
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
        document.getElementById("refno").value = XMLAddress1[0].childNodes[0].nodeValue;

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


    var url = "meal_reimbursement_data.php";
    url = url + "?Command=" + "save_item";
    
    url = url + "&refno=" + document.getElementById("refno").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;
    url = url + "&reference=" + document.getElementById("reference").value;
    url = url + "&mr_date=" + document.getElementById("mr_date").value;
    url = url + "&dept=" + document.getElementById("dept").value;
   
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

    var url = "meal_reimbursement_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

//    url = url + "&aodnumber=" + mid;
    url = url + "&refno=" + document.getElementById('refno').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&jobnum=" + document.getElementById('jobnum').value;
    url = url + "&mramount=" + document.getElementById('mramount').value;
    url = url + "&equli=" + document.getElementById('equli').value;
    url = url + "&ca_amount=" + document.getElementById('ca_amount').value;
    url = url + "&usage1=" + document.getElementById('usage1').value;
//    url = url + "&uniq22=" + document.getElementById('uniq').value;
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

    var url = "meal_reimbursement_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&refno=" + document.getElementById('refno').value;
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

function add_tmp2() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "meal_reimbursement_data.php";
    url = url + "?Command=" + "setitem2";
    url = url + "&Command1=" + "add_tmp2";

//    url = url + "&aodnumber=" + mid;
      url = url + "&refno=" + document.getElementById('refno').value;
    url = url + "&empno=" + document.getElementById('empno').value;
    url = url + "&empname=" + document.getElementById('empname').value;
    url = url + "&mreamb_amount=" + document.getElementById('mreamb_amount').value;
    url = url + "&out_td=" + document.getElementById('out_td').value;
    url = url + "&mr_remarks=" + document.getElementById('mr_remarks').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    xmlHttp.onreadystatechange = aodtmp2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails2').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
//        document.getElementById('empno').value = "";
//        document.getElementById('empname').value = "";
//        document.getElementById('out_td').value = "";
//        document.getElementById('mr_remarks').value = "";
//                
    }
}


function remove_tmp2(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "meal_reimbursement_data.php";
    url = url + "?Command=" + "removerow2";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&refno=" + document.getElementById('refno').value;
    url = url + "&id=" + id;
    alert(id);


    xmlHttp.onreadystatechange = removeAdo2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function removeAdo2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

         XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
         document.getElementById('itemdetails2').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

    }
}










