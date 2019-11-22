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

function custno(code, stname) {
    // alert(stname);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_overheads_data.php";
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

        if (stname === "lab") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("des");
            opener.document.form1.description_text.value = XMLAddress1[0].childNodes[0].nodeValue;


        } else if (stname === "foh") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("des");
            opener.document.form1.description_text.value = XMLAddress1[0].childNodes[0].nodeValue;



        } else if (stname === "var_o_h") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.reference_no_Text.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("des");
            opener.document.form1.description_text.value = XMLAddress1[0].childNodes[0].nodeValue;


        } 



        self.close();
    }
}

function update_cust_list(stname)
{

//alert(stname);

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "search_overheads_data.php";
    url = url + "?Command=" + "search_custom";



    if (stname === "PORN") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&dateText=" + document.getElementById('dateText').value;

    } else if (stname === "POED") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&job_no=" + document.getElementById('job_no').value;

    } else if (stname === "SIVE") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_no').value;
        url = url + "&currency_code=" + document.getElementById('currency_code').value;

    } else if (stname === "GRN") {

        url = url + "&reference_no=" + document.getElementById('reference_no').value;
        url = url + "&manual_no=" + document.getElementById('manual_ref_no').value;
        url = url + "&dateText=" + document.getElementById('dateText').value;

    } else if (stname === "PRNTR") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "POSER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SUBCONTRACTOR") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "PAYMENTVOUCHER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "GRNNOTE") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "GRNRECEIVED") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    }

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
