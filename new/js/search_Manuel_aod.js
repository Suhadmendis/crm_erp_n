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


function update_aod_list()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_Manuel_AOD_data.php";
    url = url + "?Command=" + "search_aod";
    url = url + "&maod=" + document.getElementById("maod").value;
    url = url + "&date=" + document.getElementById("date").value;
    url = url + "&customer=" + document.getElementById("customer").value;
    url = url + "&name=" + document.getElementById("name").value;
    url = url + "&item=" + document.getElementById("item").value;
    url = url + "&qty=" + document.getElementById("qty").value;

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


function custno(code,stname)
{

    if (stname === "dis_note") {
        
    }else{
        secureFields();    
    }
    
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_Manuel_AOD_data.php";
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

        if (stname === "dis_note") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str8");


          var cussup = "";

            if (XMLAddress1[0].childNodes[0].nodeValue === "CUSTOMER") {

                // opener.document.form1.customer.checked = true;
                cussup = "CUS";
            } else {
                // opener.document.form1.suppler.checked = true;
                cussup = "SUP";
            }
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            var code = XMLAddress1[0].childNodes[0].nodeValue;

            if (code.length === 1) {
                code = "MAOD/" + cussup + "/0000" + code;
            } else if (code.length === 2) {
                code = "MAOD/" + cussup + "/000" + code;
            } else if (code.length === 3) {
                code = "MAOD/" + cussup + "/00" + code;
            } else if (code.length === 4) {
                code = "MAOD/" + cussup + "/0" + code;
            }


            opener.document.form1.manuel_aod.value = code;
            updateTable(XMLAddress1[0].childNodes[0].nodeValue);


        }else{

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str1");
            opener.document.form1.inputText.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str2");
            opener.document.form1.Address.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str3");
            opener.document.form1.ncp.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str4");
            opener.document.form1.tel.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str5");
            opener.document.form1.Date_of_Despatch.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str6");
            opener.document.form1.Name_of_Driver.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str7");
            opener.document.form1.SO_No.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str8");

            var cussup = "";

            if (XMLAddress1[0].childNodes[0].nodeValue === "CUSTOMER") {

                opener.document.form1.customer.checked = true;
                cussup = "CUS";
            } else {
                opener.document.form1.suppler.checked = true;
                cussup = "SUP";
            }
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            var code = XMLAddress1[0].childNodes[0].nodeValue;

            if (code.length === 1) {
                code = "MAOD/" + cussup + "/0000" + code;
            } else if (code.length === 2) {
                code = "MAOD/" + cussup + "/000" + code;
            } else if (code.length === 3) {
                code = "MAOD/" + cussup + "/00" + code;
            } else if (code.length === 4) {
                code = "MAOD/" + cussup + "/0" + code;
            }


            opener.document.form1.aodnumber.value = code;
            updateTable(XMLAddress1[0].childNodes[0].nodeValue);

        }

        setTimeout(function () {
            self.close();
        }, 250);
    }
}

function secureFields() {
    window.opener.document.getElementById("savebtn").style.display = "none";
}


function updateTable(aodnumber) {
//    var aodnumber = document.getElementById("aodnumber").value

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_Manuel_AOD_data.php";
    url = url + "?Command=" + "updateTable";
    url = url + "&aodnumber=" + aodnumber;



    xmlHttp.onreadystatechange = update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);






}
;

function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");
        opener.document.getElementById("getTable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;




    }

}

