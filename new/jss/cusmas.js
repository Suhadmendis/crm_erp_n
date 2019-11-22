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

function newent() {
    document.getElementById("txt_ccode").value = "";
    document.getElementById("txt_cname").value = "";
    document.getElementById("txt_clidnew").value = "";
    document.getElementById("txt_clnamenew").value = "";
    document.getElementById("txt_cladnewad").value = "";
    document.getElementById("txt_clcontactnew").value = "";
    document.getElementById("txt_clmailnew").value = "";
    document.getElementById("c_code").value = "";
    document.getElementById("txt_c_code").value = "";
    document.getElementById("chexporter").value = "";
    document.getElementById("chconsignee").value = "";
    document.getElementById("chnotify").value = "";
    document.getElementById("chagent").value = "";
    document.getElementById("chcarrier").value = "";
    document.getElementById("chbroker").value = "";
    document.getElementById("chffowerd").value = "";
    document.getElementById("chactive").value = "";
    document.getElementById("txt_clvatno").value = "";
    document.getElementById("txt_clsvatno").value = "";
    document.getElementById("txt_clbankname").value = "";
    document.getElementById("txt_claddress").value = "";
    document.getElementById("txt_claccno").value = "";
    document.getElementById("txt_clswiftcode").value = "";
    document.getElementById("txt_clbeneficiary").value = "";
    document.getElementById("txt_clbankname").value = "";
    document.getElementById("txt_claddress").value = "";
    document.getElementById("txt_claccno").value = "";
    document.getElementById("txt_clswiftcode").value = "";
    document.getElementById("txt_clbeneficiary").value = "";
    document.getElementById("group").value = "";
    document.getElementById("txt_scac").value = "";

    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "cusmas1_data.php";
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

    var url = "cusmas_data.php";
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

    var url = "cusmas_data.php";
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


function update_list(stname) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "cusmas1_data.php";
    url = url + "?Command=" + "update_list";
    url = url + "&txt_ccode=" + document.getElementById('txt_ccode').value;
    url = url + "&txt_cname=" + document.getElementById('txt_cname').value;
    url = url + "&stname=" + stname;

    xmlHttp.onreadystatechange = showitemresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function showitemresult()
{
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById('itemdetails').innerHTML = xmlHttp.responseText;
    }
}

function getcode(cdata, cdata1, cdata2, cdata3, cdata4) {


    document.getElementById('txt_clidnew').value = cdata;
    document.getElementById('txt_clnamenew').value = cdata1;
    document.getElementById('txt_cladnewad').value = cdata2;
    document.getElementById('txt_clmailnew').value = cdata3;
    document.getElementById('txt_clbankname').value = cdata4;

    window.scrollTo(0,0);
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



function custno(custno, stname)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_custom_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + escape(custno);
    url = url + "&stname=" + stname;
    url = url + "&cur=" + document.getElementById('cur').value;




    xmlHttp.onreadystatechange = passcusresult_quot;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        // alert(xmlHttp.responseText);


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        opener.document.form1.c_code.value = XMLAddress1[0].childNodes[0].nodeValue;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername");
        opener.document.form1.c_name.value = XMLAddress1[0].childNodes[0].nodeValue;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;



        if ((stname == "rec") || (stname == "cont")) {
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb");
            window.opener.document.getElementById('invdt').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("count");
            opener.document.form1.count.value = XMLAddress1[0].childNodes[0].nodeValue;

            if (stname == "cont") {

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb1");
                window.opener.document.getElementById('invdt1').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("count1");
                opener.document.form1.count1.value = XMLAddress1[0].childNodes[0].nodeValue;

            }

        }


        if ((stname == "inv")) {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("add");
            opener.document.form1.cus_address.value = XMLAddress1[0].childNodes[0].nodeValue;

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

function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('txt_clidnew').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Client ID Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clnamenew').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Client Name Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('txt_cladnewad').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Address Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clvatno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>VAT Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_c_code').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>C.Code Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('c_code').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>C.Name Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clsvatno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>SVAT Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clmailnew').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clbankname').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_claddress').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_claccno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clswiftcode').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_clbeneficiary').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_uclbankname').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_ucladdress').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_uclaccno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_uclswiftcode').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_uclbeneficiary').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('group').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_scac').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Mail Not Enterd</span></div>";
        return false;
    }


    var url = "cusmas1_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&txt_clidnew=" + document.getElementById('txt_clidnew').value;
    url = url + "&txt_clnamenew=" + document.getElementById('txt_clnamenew').value;
    url = url + "&txt_cladnewad=" + document.getElementById('txt_cladnewad').value;
    url = url + "&txt_clvatno=" + document.getElementById('txt_clvatno').value;
    url = url + "&txt_c_code=" + document.getElementById('txt_c_code').value;
    url = url + "&c_code=" + document.getElementById('c_code').value;
    url = url + "&txt_clsvatno=" + document.getElementById('txt_clsvatno').value;
    url = url + "&txt_clmailnew=" + document.getElementById('txt_clmailnew').value;
    url = url + "&txt_clbankname=" + document.getElementById('txt_clbankname').value;
    url = url + "&txt_claddress=" + document.getElementById('txt_claddress').value;
    url = url + "&txt_claccno=" + document.getElementById('txt_claccno').value;
    url = url + "&txt_clswiftcode=" + document.getElementById('txt_clswiftcode').value;
    url = url + "&txt_clbeneficiary=" + document.getElementById('txt_clbeneficiary').value;
    url = url + "&txt_uclbankname=" + document.getElementById('txt_uclbankname').value;
    url = url + "&txt_ucladdress=" + document.getElementById('txt_ucladdress').value;
    url = url + "&txt_uclaccno=" + document.getElementById('txt_uclaccno').value;
    url = url + "&txt_uclswiftcode=" + document.getElementById('txt_uclswiftcode').value;
    url = url + "&txt_uclbeneficiary=" + document.getElementById('txt_clmailnew').value;
    url = url + "&group=" + document.getElementById('group').value;
    url = url + "&txt_scac=" + document.getElementById('txt_scac').value;

    url = url + "&chexporter=" + document.getElementById('chexporter').checked;
    url = url + "&chconsignee=" + document.getElementById('chconsignee').checked;
    url = url + "&chnotify=" + document.getElementById('chnotify').checked;
    url = url + "&chagent=" + document.getElementById('chagent').checked;
    url = url + "&chcarrier=" + document.getElementById('chcarrier').checked;
    url = url + "&chbroker=" + document.getElementById('chbroker').checked;
    url = url + "&chffowerd=" + document.getElementById('chffowerd').checked;
    url = url + "&chactive=" + document.getElementById('chactive').checked;

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
function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;
    }
}
