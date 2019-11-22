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


function custno(code, stname)
{



    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_quotation_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;
    url = url + "&stname=" + stname;

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


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;


        if (stname === "quotation") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.Quotation_NO.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str1");
            opener.document.form1.ATTN.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str0");
            opener.document.form1.manual_ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str2");
            opener.document.form1.CC.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str3");
            opener.document.form1.TO.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str4");
            opener.document.form1.FROM.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str5");
            opener.document.form1.DATE.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str6");
            opener.document.form1.SUBJECT.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str7");
            opener.document.form1.All_payment.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str8");
            opener.document.form1.Validity_of_quotation.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str9");
            opener.document.form1.Payment.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str10");
            opener.document.form1.Delivery.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str11");
            opener.document.form1.Remark.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str12");
            opener.document.form1.Text_1.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str13");
            opener.document.form1.Text_2.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str14");
//        opener.document.form1.Invoice_Date.value = XMLAddress1[0].childNodes[0].nodeValue;

//       opener.document.form1.ver_con.hidden = false;
            window.opener.document.getElementById("ver_con").hidden = false;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
            opener.document.form1.uniq.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("update");
            opener.document.form1.update.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("table");
            window.opener.document.getElementById("itemdetails").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        }

        if (stname === "job_rec") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.form1.quotation_id.value = XMLAddress1[0].childNodes[0].nodeValue;
        }

        if (stname === "REPEAT") {
//            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
//            opener.document.form1.Quotation_NO.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str1");
            opener.document.form1.ATTN.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str0");
            opener.document.form1.manual_ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str2");
            opener.document.form1.CC.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str3");
            opener.document.form1.TO.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str4");
            opener.document.form1.FROM.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str5");
            opener.document.form1.DATE.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str6");
            opener.document.form1.SUBJECT.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str7");
            opener.document.form1.All_payment.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str8");
            opener.document.form1.Validity_of_quotation.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str9");
            opener.document.form1.Payment.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str10");
            opener.document.form1.Delivery.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str11");
            opener.document.form1.Remark.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str12");
            opener.document.form1.Text_1.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str13");
            opener.document.form1.Text_2.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str14");
//        opener.document.form1.Invoice_Date.value = XMLAddress1[0].childNodes[0].nodeValue;

//       opener.document.form1.ver_con.hidden = false;
            window.opener.document.getElementById("ver_con").hidden = true;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("table");
            window.opener.document.getElementById("itemdetails").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        }

        window.opener.document.getElementById("savebtn").style.display = "block";

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

    var url = "search_proforma_invoice_data.php";
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

