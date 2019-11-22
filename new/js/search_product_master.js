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

    var url = "search_product_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function custno(code,stname)
{
    // alert(code);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_product_master_data.php";
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
        if (stname === "main") {
            //alert( XMLAddress1[0].childNodes[0].nodeValue);
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        opener.document.getElementById('prod_ref').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
        opener.document.getElementById('prod_name').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
        opener.document.getElementById('prod_uom').value = XMLAddress1[0].childNodes[0].nodeValue;
        
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
        // opener.document.getElementById('group1').value = XMLAddress1[0].childNodes[0].nodeValue;
                
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
        // opener.document.getElementById('grp_type').value = XMLAddress1[0].childNodes[0].nodeValue;

        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
        // opener.document.getElementById('prod_length').value = XMLAddress1[0].childNodes[0].nodeValue;
        
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername6");
        // opener.document.getElementById('prod_width').value = XMLAddress1[0].childNodes[0].nodeValue;
        
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
        // opener.document.getElementById('prod_height').value = XMLAddress1[0].childNodes[0].nodeValue;
        
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername8");
        // opener.document.getElementById('w_inches').value = XMLAddress1[0].childNodes[0].nodeValue;

        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername9");
        // opener.document.getElementById('sqf').value = XMLAddress1[0].childNodes[0].nodeValue;
        
        // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername10");
        
        // if (XMLAddress1[0].childNodes[0].nodeValue === "I") {
        //     window.opener.document.getElementById('status').checked = false;
        // }else if (XMLAddress1[0].childNodes[0].nodeValue === "A"){
        //     window.opener.document.getElementById('status').checked = true;
        // }
        
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LC_1");
        opener.document.getElementById('LC_1').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LC_2");
        opener.document.getElementById('LC_2').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LC_3");
        opener.document.getElementById('LC_3').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LC_4");
        opener.document.getElementById('LC_4').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LN_1");
        opener.document.getElementById('LN_1').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LN_2");
        opener.document.getElementById('LN_2').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LN_3");
        opener.document.getElementById('LN_3').value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LN_4");
        opener.document.getElementById('LN_4').value = XMLAddress1[0].childNodes[0].nodeValue;



        window.opener.document.getElementById('up_flag').value = "UP";
        }

        if (stname === "costing") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('proCodeText').value = XMLAddress1[0].childNodes[0].nodeValue;
               
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('proNameText').value = XMLAddress1[0].childNodes[0].nodeValue;

        }
        if (stname === "dsr") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('itemCode').value = XMLAddress1[0].childNodes[0].nodeValue;
               
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('itemDesc').value = XMLAddress1[0].childNodes[0].nodeValue;

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


    var url = "search_product_master_data.php";
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