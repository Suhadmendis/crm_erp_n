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

    var url = "search_ink_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function custno(code, stname)
{



    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_ink_master_data.php";
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
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_code");
            opener.document.getElementById('inkref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GROUP2");
            opener.document.getElementById('avgcostpl_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GROUP3");
            opener.document.getElementById('sqft_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("DESCRIPT");
            opener.document.getElementById('description').value = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "pre_ink") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_code");
            opener.document.form1.inkCode.value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GROUP2");
            var avgCost = XMLAddress1[0].childNodes[0].nodeValue;
            avgCost = parseFloat(avgCost);

            opener.document.form1.inkAvg.value = avgCost;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GROUP3");
            var capacity = XMLAddress1[0].childNodes[0].nodeValue;

            opener.document.form1.inkCap.value = capacity;


            var effSqFt = opener.document.form1.effSqFt.value;

            effSqFt = parseFloat(effSqFt);
            capacity = parseFloat(capacity);
            var inkQty = effSqFt / capacity;
            inkQty = inkQty.toFixed(2);

             opener.document.form1.inkQty.value = inkQty;

            var inkCost = avgCost * inkQty;
            inkCost = inkCost.toFixed(2);

             opener.document.form1.inkTotCost.value = inkCost;

            //new mica
            var totSqftTxt = opener.document.form1.totSqftTxt.value;
            var colorTxt = opener.document.form1.colorTxt.value;
            var sidesText = opener.document.form1.sidesText.value;





            var wasteTxt = parseFloat(opener.document.form1.wasteTxt.value);
            var inkCap = opener.document.form1.inkCap.value;

            var temp1 = totSqftTxt * colorTxt * sidesText;
            var temp2 = temp1 / 100;

            wasteTxt = wasteTxt + 100;
            var temp3 = temp2 * wasteTxt;

            var temp3 = temp3 / inkCap;
            var tempshow = temp3.toFixed(4);

            opener.document.form1.inkQty.value = tempshow;
            opener.document.form1.inkQtyShow.value = temp3.toFixed(2);

            var temp4 = avgCost * temp3;

            opener.document.form1.inkTotCost.value = temp4.toFixed(4);
            opener.document.form1.inkTotCostShow.value = temp4.toFixed(2);

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

    var url = "search_ink_master_data.php";
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