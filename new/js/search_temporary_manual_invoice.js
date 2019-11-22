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


function custno(code)
{


// split and remove before zeros

    var split = code.split("-");
    var mid = parseInt(split[1]);
//


    secureFields();
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_temporary_manual_invoice_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + mid;

//opener.document.location.reload();

    xmlHttp.onreadystatechange = passcusresult_quot;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str1");
        opener.document.form1.Invoice_Date.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str2");
        opener.document.form1.Settlement_Due.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str3");
        opener.document.form1.Customer_Order_No.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str4");
        opener.document.form1.ouraodnumber.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str5");
        if (XMLAddress1[0].childNodes[0].nodeValue == "LKR") {
            opener.document.getElementById("Cuddrrency").selectedIndex = 0;
        } else {
            opener.document.getElementById("Cuddrrency").selectedIndex = 1;
        }

//        opener.document.form1.Currency.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str6");
        opener.document.form1.NBT.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str7");
        opener.document.form1.VAT.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str16");
        opener.document.form1.Advance.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str11");
        opener.document.form1.Customer_Name.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str12");
        opener.document.form1.Customer_Address.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str13");
        opener.document.form1.SVAT.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str14");
        if (XMLAddress1[0].childNodes[0].nodeValue === "1") {
            window.opener.document.getElementById("no").checked = true;
        } else {
            window.opener.document.getElementById("yes").checked = true;
        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str15");
        opener.document.form1.crate.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str8");
        if (XMLAddress1[0].childNodes[0].nodeValue === "1") {
            window.opener.document.getElementById("svatboo").checked = true;
        } else {
            window.opener.document.getElementById("vatboo").checked = true;
        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str9");
        if (XMLAddress1[0].childNodes[0].nodeValue === "1") {
            window.opener.document.getElementById("vatboo").checked = true;
        } else {
            window.opener.document.getElementById("svatboo").checked = true;
        }


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str10");
        if (XMLAddress1[0].childNodes[0].nodeValue === "1") {
            window.opener.document.getElementById("nbtboo").checked = true;
        } else {
            window.opener.document.getElementById("nbtboo").checked = false;
        }



        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        var code = XMLAddress1[0].childNodes[0].nodeValue;

        if (code.length === 1) {
            code = "ccs/Temp/19-0000" + code;
        } else if (code.length === 2) {
            code = "ccs/Temp/19-000" + code;
        } else if (code.length === 3) {
            code = "ccs/Temp/19-00" + code;
        } else if (code.length === 4) {
            code = "ccs/Temp/19-0" + code;
        }

        opener.document.form1.Invoice_Number.value = code;
        updateTable(XMLAddress1[0].childNodes[0].nodeValue);



        setTimeout(function () {
            self.close();
        }, 250);
    }
}

function secureFields() {
    window.opener.document.getElementById("savebtn").style.display = "none";
}


function updateTable(invno) {
//    var aodnumber = document.getElementById("aodnumber").value

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_temporary_manual_invoice_data.php";
    url = url + "?Command=" + "updateTable";
    url = url + "&Invoice_Number=" + invno;



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
        window.opener.document.getElementById("itemdetails").hidden = false;


        window.opener.document.getElementById("yes").disabled = true;
        window.opener.document.getElementById("no").disabled = true;

        window.opener.document.getElementById("svatboo").disabled = true;
        window.opener.document.getElementById("vatboo").disabled = true;
        window.opener.document.getElementById("nbtboo").disabled = true;




    }

}

