/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    var url = "search_sample_job_path_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;
    url = url + "&stname=" + stname;

    xmlHttp.onreadystatechange = passcusresult_quot;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function passcusresult_quot() {

    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;


        if (stname === "SAMPLE_JOB_REQUEST_NOTE") {

            //  alert("SAMPLE_JOB_REQUEST_NOTE");
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('sjrequestref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;
            //alert(id);

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('c_code').value = XMLAddress1[0].childNodes[0].nodeValue;
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("customer_name");
            opener.document.getElementById('c_name').value = XMLAddress1[0].childNodes[0].nodeValue;
          
            
            

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('mkex_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "SAMPLE_JOB_ORDER") {


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('SJRequestNo').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('sjbref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('customer_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('mkex_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);


        } else if (stname === "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('sjbno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('sjbmrnref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('sjbminref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('manualref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.getElementById('remark_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);

        } else if (stname === "SAMPLE_JOB_TRANSFER") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('samplejobtransno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('customer_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);
           // alert("abc " + id);

        } else if (stname === "SAMPLE_DELIVERY_NOTE_DATA") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('sampletransnote_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('aod_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('customer_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            updateTable(stname, id);
            // alert("SAMPLE_DELIVERY_NOTE_DATA " + id);

        } else if (stname === "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('sjb_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            var id = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.getElementById('sjbmrn_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.getElementById('manualref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.getElementById('remark_txt').value = XMLAddress1[0].childNodes[0].nodeValue;


            updateTable(stname, id);
            // alert("SAMPLE_DELIVERY_NOTE_DATA " + id);

        }

        setTimeout(function () {
            self.close();
        }, 350);
    }
}


function updateTable(stname, id) {


//    alert(stname + " : " + id);
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        var url = "search_sample_job_path_data.php";
        url = url + "?Command=" + "updateTable";


        if (stname === "SAMPLE_JOB_REQUEST_NOTE") {

            url = url + "&reference_no=" + id;

        } else if (stname === "SAMPLE_JOB_ORDER") {

            url = url + "&reference_no=" + id;
//             alert("Hi baby"+id);
        } else if (stname === "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

            url = url + "&reference_no=" + id;

        } else if (stname === "SAMPLE_JOB_TRANSFER") {

            url = url + "&reference_no=" + id;
        } else if (stname === "SAMPLE_DELIVERY_NOTE_DATA") {

            url = url + "&reference_no=" + id;
            // alert("Hi baby" + id);
        }else if (stname === "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

            url = url + "&reference_no=" + id;
            //alert("Hi baby oler" + id);
        }

        url = url + "&stname=" + stname;
        xmlHttp.onreadystatechange = update;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    }
}
function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");
//        alert(XMLAddress1);
        opener.document.getElementById("getTable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        window.opener.document.getElementById("itemdetails").hidden = false;

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


    var url = "search_sample_job_path_data.php";
    url = url + "?Command=" + "search_custom";



    if (stname === "SAMPLE_JOB_REQUEST_NOTE") {

        //alert("SAMPLE_JOB_REQUEST_NOTE");
        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SAMPLE_JOB_ORDER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SAMPLE_JOBMATERIAL_ISSUE_NOTE") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SAMPLE_JOB_TRANSFER") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    } else if (stname === "SAMPLE_DELIVERY_NOTE_DATA") {

        url = url + "&cusno=" + document.getElementById('cusno').value;
        url = url + "&customername1=" + document.getElementById('customername1').value;
        url = url + "&customername2=" + document.getElementById('customername2').value;

    }else if (stname === "SAMPLE_JOBMATERIAL_REQUEST_NOTE") {

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
