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

    getdt();
}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_meal_reimbursement_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function assign_dt() {
    document.getElementById('itemdetails').innerHTML = xmlHttp.responseText;
}







function custno(code)
{
    //alert(code);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_meal_reimbursement_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;

    xmlHttp.onreadystatechange = passcusresult_quot;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        opener.document.form1.refno.value = XMLAddress1[0].childNodes[0].nodeValue;
        var id = XMLAddress1[0].childNodes[0].nodeValue;
        
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
        opener.document.form1.reference.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
        opener.document.form1.mr_date.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
        opener.document.form1.dept.value = XMLAddress1[0].childNodes[0].nodeValue;
        
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dpt_name");
        opener.document.form1.depst_name.value = XMLAddress1[0].childNodes[0].nodeValue;
//        alert()

        updateTable(id);
         // updateTable2(id);
         setTimeout(function () {
            self.close();
        }, 350);
    }
}

function update_cust_list(stname)
{


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "search_meal_reimbursement_data.php";
    url = url + "?Command=" + "search_custom";




    url = url + "&cusno=" + document.getElementById('cusno').value;
    url = url + "&customername1=" + document.getElementById('customername1').value;
    url = url + "&customername2=" + document.getElementById('customername2').value;
   
    url = url + "&stname=" + stname;


    xmlHttp.onreadystatechange = showcustresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;

    }
}
function updateTable(id) {


//    alert(stname + " : " + id);
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        var url = "search_meal_reimbursement_data.php";
        url = url + "?Command=" + "updateTable";

        url = url + "&reference_no=" + id;
        alert("1"+id);
        xmlHttp.onreadystatechange = update;
//      
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    }
}
//function updateTable2(id) {
//
//
////    alert(stname + " : " + id);
//    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
//    {
//
//        var url = "search_meal_reimbursement_data.php";
//        url = url + "?Command=" + "updateTable2";
//
//        url = url + "&reference_no=" + id;
//         alert("2"+id);
//
//        xmlHttp.onreadystatechange = update2;
//        xmlHttp.open("GET", url, true);
//        xmlHttp.send(null);
//    }
//}

function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");
        opener.document.getElementById("itemdetails").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows2");
        opener.document.getElementById("itemdetails2").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
//         window.opener.document.getElementById("itemdetails").hidden = false;
//         
        

    }
}
//function update2() {
//    var XMLAddress1;
//
//    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
//    {
//        alert("sajfsaufhu");
////         XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");
//      
//          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows2");
//          opener.document.getElementById("getTable1").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
//         window.opener.document.getElementById("itemdetails2").hidden = false;
//
//    }
//}
