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


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_sales_executive_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function custno(code, stname)
{
    //alert(code);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_sales_executive_master_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;
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
        var stname = XMLAddress1[0].childNodes[0].nodeValue;

        if (stname === "code") {
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('se_ref').value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('nic').value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('se_name').value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('addr').value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('mobile').value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.getElementById('email').value = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "job_rec") {
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('Marketing_Ex').value = XMLAddress1[0].childNodes[0].nodeValue;
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('Marketing_name').value = XMLAddress1[0].childNodes[0].nodeValue;
            
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


    var url = "search_sales_executive_master_data.php";
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