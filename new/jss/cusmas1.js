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
    document.getElementById("txt_clvatno").value = "";
    document.getElementById("txt_clsvatno").value = "";
    document.getElementById("txt_clbankname").value = "";
    document.getElementById("txt_claddress").value = "";
    document.getElementById("txt_claccno").value = "";
    document.getElementById("txt_clswiftcode").value = "";
    document.getElementById("txt_clbeneficiary").value = "";
    document.getElementById("txt_uclbankname").value = "";
    document.getElementById("txt_ucladdress").value = "";
    document.getElementById("txt_uclaccno").value = "";
    document.getElementById("txt_uclswiftcode").value = "";
    document.getElementById("txt_uclbeneficiary").value = "";
    document.getElementById("group").value = "";
    document.getElementById("txt_scac").value = "";
    document.getElementById("checkvat").checked = false;
    document.getElementById("checksvat").checked = false;
    document.getElementById("chexporter").checked = false;
    document.getElementById("chconsignee").checked = false;
    document.getElementById("chnotify").checked = false;
    document.getElementById("chagent").checked = false;
    document.getElementById("chcarrier").checked = false;
    document.getElementById("chbroker").checked = false;
    document.getElementById("chffowerd").checked = false;
    document.getElementById("chactive").checked = false;
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

    var url = "cusmas1_data.php";
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

    var url = "cusmas1_data.php";
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
    url = url + "&stname=" + 'mas';
    xmlHttp.onreadystatechange = showitemresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function showitemresult() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        document.getElementById('itemdetails').innerHTML = xmlHttp.responseText;
    }

//    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("x");
//    opener.document.form1.txt_cladnewad.value = XMLAddress1[0].childNodes[0].nodeValue;
}

//function getcode12(code)
//{
//    xmlHttp = GetXmlHttpObject();
//    if (xmlHttp == null)
//    {
//        alert("Browser does not support HTTP Request");
//        return;
//    }
//    var url = "cusmas1_data.php";
//    url = url + "?Command=" + "pass_quot";
//    url = url + "&custno=" + code;
//
//
//    xmlHttp.onreadystatechange = passcusresult_quot;
//
//    xmlHttp.open("GET", url, true);
//    xmlHttp.send(null);
//
//
//}


function getcode(cdata, cdata1, cdata2, cdata3, cdata4) {


    document.getElementById('txt_clidnew').value = cdata;
    document.getElementById('txt_clnamenew').value = cdata1;
    document.getElementById('txt_cladnewad').value = cdata2;
    document.getElementById('txt_clmailnew').value = cdata3;
    document.getElementById('txt_clbankname').value = cdata4;
    window.scrollTo(0, 0);
}


//function getcode12(cdata, cdata1, cdata2, cdata3, cdata4, cdata5, cdata6, cdata7, cdata8, cdata9, cdata10, cdata11, cdata12, cdata13, cdata14, cdata15, cdata16, cdata17, cdata18, cdata19, cdata20, cdata21, cdata22, cdata23, cdata24, cdata25, cdata26, cdata27, cdata28, cdata29, cdata30) {
//
//
//    document.getElementById('txt_clidnew').value = cdata;
//    document.getElementById('txt_clnamenew').value = cdata1;
//    document.getElementById('txt_cladnewad').value = cdata2;
//    document.getElementById('txt_clcontactnew').value = cdata3;
//    document.getElementById('txt_clmailnew').value = cdata4;
//
//    document.getElementById('c_code').value = cdata5;
//    document.getElementById('txt_c_code').value = cdata6;
//    document.getElementById('txt_clvatno').value = cdata7;
//    document.getElementById('txt_clsvatno').value = cdata8;
//    document.getElementById('txt_clbankname').value = cdata9;
//
//    document.getElementById('txt_claddress').value = cdata10;
//    document.getElementById('txt_claccno').value = cdata11;
//    document.getElementById('txt_clswiftcode').value = cdata12;
//    document.getElementById('txt_clbeneficiary').value = cdata13;
//    document.getElementById('txt_uclbankname').value = cdata14;
//
//    document.getElementById('txt_ucladdress').value = cdata15;
//    document.getElementById('txt_uclaccno').value = cdata16;
//    document.getElementById('txt_uclswiftcode').value = cdata17;
//    document.getElementById('txt_uclbeneficiary').value = cdata18;
//    document.getElementById('group').value = cdata19;
//    document.getElementById('txt_scac').value = cdata20;
//
//    document.getElementById('chexporter').checked = cdata21;
//    document.getElementById('chconsignee').checked = cdata22;
//    document.getElementById('chnotify').checked = cdata23;
//    document.getElementById('chagent').checked = cdata24;
//
//    document.getElementById('chcarrier').checked = cdata25;
//    document.getElementById('chbroker').checked = cdata26;
//    document.getElementById('chffowerd').checked = cdata27;
//    document.getElementById('chactive').checked = cdata28;
//    document.getElementById('checkvat').checked = cdata29;
//    document.getElementById('checksvat').checked = cdata30;
//
//    window.scrollTo(0, 0);
//}

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



function getcode12(custno, stname)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "cusmas1_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + escape(custno);
    url = url + "&stname=" + stname;
    xmlHttp.onreadystatechange = getcodepre;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function getcodepre() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_1");
        document.getElementById('txt_clidnew').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_2");
        document.getElementById('txt_clnamenew').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_3");
        document.getElementById('txt_cladnewad').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_4");
        document.getElementById('txt_clcontactnew').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_5");
        document.getElementById('txt_clmailnew').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_6");
        document.getElementById('c_code').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_7");
        document.getElementById('txt_c_code').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_8");
        document.getElementById('txt_clvatno').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_9");
        document.getElementById('txt_clsvatno').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_10");
        document.getElementById('txt_clbankname').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_11");
        document.getElementById('txt_claddress').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_12");
        document.getElementById('txt_claccno').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_13");
        document.getElementById('txt_clswiftcode').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_14");
        document.getElementById('txt_clbeneficiary').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_15");
        document.getElementById('txt_uclbankname').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_16");
        document.getElementById('txt_ucladdress').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_17");
        document.getElementById('txt_uclaccno').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_18");
        document.getElementById('txt_uclswiftcode').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_19");
        document.getElementById('txt_uclbeneficiary').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_20");
        document.getElementById('group').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_21");
        document.getElementById('txt_scac').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch1");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chexporter').checked = true;
        } else {
            document.getElementById('chexporter').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch2");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chconsignee').checked = true;
        } else {
            document.getElementById('chconsignee').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch3");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chnotify').checked = true;
        } else {
            document.getElementById('chnotify').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch4");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chagent').checked = true;
        } else {
            document.getElementById('chagent').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch5");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chcarrier').checked = true;
        } else {
            document.getElementById('chcarrier').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch6");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chbroker').checked = true;
        } else {
            document.getElementById('chbroker').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch7");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chffowerd').checked = true;
        } else {
            document.getElementById('chffowerd').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch8");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('chactive').checked = true;
        } else {
            document.getElementById('chactive').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch9");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('checkvat').checked = true;
        } else {
            document.getElementById('checkvat').checked = false;
        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ch10");
        if (XMLAddress1[0].childNodes[0].nodeValue == '1') {
            document.getElementById('checksvat').checked = true;
        } else {
            document.getElementById('checksvat').checked = false;
        }

    }
}


function passcusresult_quot()
{
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
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
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Client Name Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('c_code').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>C.Code Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('txt_c_code').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>C.Name Not Enterd</span></div>";
        return false;
    }



    var url = "cusmas1_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&txt_clidnew=" + document.getElementById("txt_clidnew").value;
    url = url + "&txt_clnamenew=" + document.getElementById("txt_clnamenew").value;
    url = url + "&txt_cladnewad=" + document.getElementById("txt_cladnewad").value;
    url = url + "&txt_clcontactnew=" + document.getElementById("txt_clcontactnew").value;
    url = url + "&txt_clmailnew=" + document.getElementById("txt_clmailnew").value;
    url = url + "&c_code=" + document.getElementById("c_code").value;
    url = url + "&txt_c_code=" + document.getElementById("txt_c_code").value;
    url = url + "&txt_clvatno=" + document.getElementById("txt_clvatno").value;
    url = url + "&txt_clsvatno=" + document.getElementById("txt_clsvatno").value;
    url = url + "&txt_clbankname=" + document.getElementById("txt_clbankname").value;
    url = url + "&txt_claddress=" + document.getElementById("txt_claddress").value;
    url = url + "&txt_claccno=" + document.getElementById("txt_claccno").value;
    url = url + "&txt_clswiftcode=" + document.getElementById("txt_clswiftcode").value;
    url = url + "&txt_clbeneficiary=" + document.getElementById("txt_clbeneficiary").value;
    url = url + "&txt_uclbankname=" + document.getElementById("txt_uclbankname").value;
    url = url + "&txt_ucladdress=" + document.getElementById("txt_ucladdress").value;
    url = url + "&txt_uclaccno=" + document.getElementById("txt_uclaccno").value;
    url = url + "&txt_uclswiftcode=" + document.getElementById("txt_uclswiftcode").value;
    url = url + "&txt_uclbeneficiary=" + document.getElementById("txt_uclbeneficiary").value;
    url = url + "&group=" + document.getElementById("group").value;
    url = url + "&txt_scac=" + document.getElementById("txt_scac").value;
    if (document.getElementById('chexporter').checked == true) {
        url = url + "&chexporter" + "=1";
    }
    if (document.getElementById('chconsignee').checked == true) {
        url = url + "&chconsignee" + "=1";
    }
    if (document.getElementById('chnotify').checked == true) {
        url = url + "&chnotify" + "=1";
    }
    if (document.getElementById('chagent').checked == true) {
        url = url + "&chagent" + "=1";
    }
    if (document.getElementById('chcarrier').checked == true) {
        url = url + "&chcarrier" + "=1";
    }
    if (document.getElementById('chbroker').checked == true) {
        url = url + "&chbroker" + "=1";
    }
    if (document.getElementById('chffowerd').checked == true) {
        url = url + "&chffowerd" + "=1";
    }
    if (document.getElementById('chactive').checked == true) {
        url = url + "&chactive" + "=1";
    }
    if (document.getElementById('checkvat').checked == true) {
        url = url + "&checkvat" + "=1";
    }
    if (document.getElementById('checksvat').checked == true) {
        url = url + "&checksvat" + "=1";
    }

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
