function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0 + , Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
//Internet Explorer
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




function custno(custno, stname)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_supplier_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + custno;
    url = url + "&stname=" + stname;
    xmlHttp.onreadystatechange = passcusresult_quot;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}


function passcusresult_quot()
{
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        stname = XMLAddress1[0].childNodes[0].nodeValue;
        if (stname == "sup_mas"){
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("s_code");
            opener.document.form1.sup_code.value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("add");
            opener.document.form1.add.value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("name");
            opener.document.form1.sup_name.value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tel");
            opener.document.form1.tel.value = XMLAddress1[0].childNodes[0].nodeValue;
        }
self.close();
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


    var url = "search_custom_data.php";
    url = url + "?Command=" + "search_custom";
    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    } else if (document.getElementById('customername').value != "") {
        url = url + "&mstatus=customername";
    }

    url = url + "&cusno=" + document.getElementById('cusno').value;
    url = url + "&customername=" + document.getElementById('customername').value;
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
