var loc = "add";

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

var wage = document.getElementById("pre_col");
wage.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        add_tmp('add');
    }
});



function cal_amo() {
    var vat = 0;
    document.getElementById('tax_amo').value = 0;
    if (document.getElementById('tax').value == "VAT") {

        vat = parseFloat(document.getElementById('os_amo').value) * parseFloat((document.getElementById('rate').value / 100));
        document.getElementById('tax_amo').value = vat;

    }

    document.getElementById('lc_amo').value = parseFloat(document.getElementById('txt_rate').value) * (parseFloat(vat) + parseFloat(document.getElementById('os_amo').value));

}


function get_cos(cdata) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "costing_data.php";
    url = url + "?Command=" + "get_cos";
    url = url + "&refno=" + cdata;

    xmlHttp.onreadystatechange = showresultgetcos;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}



function showresultgetcos() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        document.getElementById('msg_box').innerHTML = "";

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb1");
        document.getElementById('itemdetails1').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb2");
        document.getElementById('itemdetails3').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb3");
        document.getElementById('itemdetails2').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;




        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobno");
        document.getElementById('txt_consolno').value = XMLAddress1[0].childNodes[0].nodeValue;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtcost");
        document.getElementById('txtcost').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtinvoiced");
        document.getElementById('txtinvoiced').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtprofit");
        document.getElementById('txtprofit').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("os_amo");
        document.getElementById('os_amo_a').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("lc_amo");
        document.getElementById('lc_amo_a').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
        document.getElementById('tmpno').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_entno");
        document.getElementById('txt_entno').value = XMLAddress1[0].childNodes[0].nodeValue;
         $('#myModal_search').modal('hide');
    }
}


function add_tmp(cdata) {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    var vat = 0;
    document.getElementById('tax_amo').value = 0;
    if (document.getElementById('tax').value == "VAT") {

        vat = parseFloat(document.getElementById('os_amo').value) * parseFloat((document.getElementById('rate').value / 100));
        document.getElementById('tax_amo').value = vat;

    }

    document.getElementById('lc_amo').value = parseFloat(document.getElementById('txt_rate').value) * (parseFloat(vat) + parseFloat(document.getElementById('os_amo').value));


    var url = "costing_data.php";
    url = url + "?Command=" + "add_tmp";
    url = url + "&Command1=" + cdata;


    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&charg_code=" + document.getElementById('charg_code').value;
    url = url + "&currency=" + document.getElementById('currency').value;
    url = url + "&os_amo=" + document.getElementById('os_amo').value;
    url = url + "&tax=" + document.getElementById('tax').value;
    url = url + "&rate=" + document.getElementById('rate').value;
    url = url + "&tax_amo=" + document.getElementById('tax_amo').value;
    url = url + "&creditor=" + document.getElementById('creditor').value;
    url = url + "&invo=" + document.getElementById('invo').value;
    url = url + "&invo_date=" + document.getElementById('invo_date').value;
    url = url + "&ex_rate=" + document.getElementById('txt_rate').value;
    url = url + "&lc_amo=" + document.getElementById('lc_amo').value;
    url = url + "&pre_col=" + document.getElementById('pre_col').value;
    url = url + "&gst_amo=" + document.getElementById('gst_amo').value;



    xmlHttp.onreadystatechange = showresultaddtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function setitem(c1, c2, c3, c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14) {

    add_tmp(c14);

    loc ="del";

    document.getElementById('charg_code').value=c1;
    document.getElementById('currency').value=c2;
    document.getElementById('os_amo').value=c3;
    document.getElementById('tax').value=c4;
    document.getElementById('rate').value=c5;
    document.getElementById('tax_amo').value=c6;
    document.getElementById('creditor').value=c7;
    document.getElementById('invo').value=c8;
    document.getElementById('invo_date').value=c9;

    document.getElementById('gst_amo').value=c10;
    document.getElementById('txt_rate').value=c11;
    document.getElementById('lc_amo').value=c12;
    document.getElementById('pre_col').value=c13;





}

function showresultaddtmp() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

if (loc == "add") {
        document.getElementById('charg_code').value = "";

        document.getElementById('os_amo').value = "";


        document.getElementById('tax_amo').value = "";
        document.getElementById('creditor').value = "";
        document.getElementById('invo').value = "";

        document.getElementById('lc_amo').value = "";
        document.getElementById('pre_col').value = "";
        document.getElementById('gst_amo').value = "";

}
        document.getElementById('charg_code').focus();
loc ="add";
    }
}


function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    document.getElementById('charg_code').value = "";

    document.getElementById('os_amo').value = "";


    document.getElementById('tax_amo').value = "";
    document.getElementById('creditor').value = "";
    document.getElementById('invo').value = "";

    document.getElementById('txt_rate').value = "1";
    document.getElementById('lc_amo').value = "";
    document.getElementById('pre_col').value = "";
    document.getElementById('gst_amo').value = "";

    document.getElementById('itemdetails').innerHTML = "";


    document.getElementById('itemdetails1').innerHTML = "";


    document.getElementById('itemdetails3').innerHTML = "";
    document.getElementById('msg_box').innerHTML = "";



    document.getElementById('txtcost').value = "";


    document.getElementById('txtinvoiced').value = "";


    document.getElementById('txtprofit').value = "";


    document.getElementById('os_amo_a').value = "";


    document.getElementById('lc_amo_a').value = "";


    document.getElementById('tmpno').value = "";


    document.getElementById('txt_entno').value = "";


    var url = "costing_data.php";
    url = url + "?Command=" + "new_inv";
    url = url + "&jobno=" + document.getElementById('txt_consolno').value;


    xmlHttp.onreadystatechange = showresultnew;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showresultnew() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("invno");
        document.getElementById('txt_entno').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
        document.getElementById('tmpno').value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}


function save_inv() {

    var url = "costing_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&txt_consolno=" + document.getElementById('txt_consolno').value;
    url = url + "&crndate=" + document.getElementById('invdate').value;

    xmlHttp.onreadystatechange = showresultsave;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showresultsave() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      if (xmlHttp.responseText == "Saved") {
        document.getElementById("msg_box").innerHTML =
          "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
        //            print_inv('save');
      } else {
        document.getElementById("msg_box").innerHTML =
          "<div class='alert alert-warning' role='alert'><span class='center-block'>" +
          xmlHttp.responseText +
          "</span></div>";
      }
    }
}


function search() {
    $('#myModal_search').modal('show');
    search_cos('');
}




function search_cos(cdata) {

    var url = "costing_data.php";
    url = url + "?Command=" + "search_cos";

    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&txt_consolno=" + document.getElementById('txt_consolno').value;
    url = url + "&crndate=" + document.getElementById('invdate').value;
    url = url + "&mtype=" + cdata;

    url = url + "&jobno=" + document.getElementById('jobno').value;
    url = url + "&costnum=" + document.getElementById('costnum').value;
    url = url + "&invoiceno=" + document.getElementById('invoiceno').value;
    url = url + "&creditor=" + document.getElementById('creditor').value;


    xmlHttp.onreadystatechange = showresultsearch;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showresultsearch() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        document.getElementById('search_res').innerHTML = xmlHttp.responseText;


    }
}
