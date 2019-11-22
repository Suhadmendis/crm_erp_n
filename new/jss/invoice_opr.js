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

var wage = document.getElementById("house");
wage.addEventListener("keydown", function(e) {
  if (e.keyCode === 13) {
    //checks whether the pressed key is "Enter"
    add_tmp("add");
  }
});

function cal_amo() {
  document.getElementById("lc_amo").value =
    parseFloat(document.getElementById("txt_rate").value) *
    parseFloat(document.getElementById("os_amo").value);
}

function get_inv(cdata) {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "get_inv";
  url = url + "&refno=" + cdata;

  xmlHttp.onreadystatechange = showresultgetinv;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function showresultgetinv() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    document.getElementById("msg_box").innerHTML = "";

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb");
    document.getElementById("itemdetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobno");
    document.getElementById("txt_consolno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("taxa");
    document.getElementById("taxa").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("svat");
    document.getElementById("svat").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("gross");
    document.getElementById("gross").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("amount");
    document.getElementById("amount").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_entno");
    document.getElementById("txt_entno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgID");
    document.getElementById("csType").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgName");
    document.getElementById("csName").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgadd");
    document.getElementById("csAdd").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CusId");
    document.getElementById("shType").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CuName");
    document.getElementById("shName").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cuadd");
    document.getElementById("shAdd").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    $("#myModal_search").modal("hide");
  }
}

function add_tmp(cdata) {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "add_tmp";
  url = url + "&Command1=" + cdata;

  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&charg_code=" + document.getElementById("charg_code").value;
    url = url + "&description=" + document.getElementById("description").value;
  url = url + "&currency=" + document.getElementById("currency").value;
  url = url + "&os_amo=" + document.getElementById("os_amo").value;
  url = url + "&tax=" + document.getElementById("tax").value;

  url = url + "&creditor=" + document.getElementById("creditor").value;

  url = url + "&ex_rate=" + document.getElementById("txt_rate").value;
  url = url + "&lc_amo=" + document.getElementById("lc_amo").value;

  url = url + "&inv_type=" + document.getElementById("inv_type").value;
  url = url + "&console=" + document.getElementById("console").value;
  url = url + "&house=" + document.getElementById("house").value;


  xmlHttp.onreadystatechange = showresultaddtmp;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}



function setitem(c1, c2, c3, c4,c5,c6,c7,c8,c9,c10,c11,c12) {

    add_tmp(c12);

    loc ="del";

    document.getElementById("charg_code").value =c1;
    document.getElementById("description").value =c2;
      document.getElementById("tax").value=c3;
    
    document.getElementById("currency").value =c4;
    document.getElementById("os_amo").value =c5;
  document.getElementById("lc_amo").value=c6;

    document.getElementById("creditor").value=c7;

    document.getElementById("txt_rate").value=c8;


    document.getElementById("inv_type").value=c9;
    document.getElementById("console").value=c10;
    document.getElementById("house").value=c11;





}

function showresultaddtmp() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tb");
    document.getElementById("itemdetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tax");
    document.getElementById("taxa").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("svat");
    document.getElementById("svat").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tot");
    document.getElementById("gross").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("amo");
    document.getElementById("amount").value =
      XMLAddress1[0].childNodes[0].nodeValue;

if (loc=="add") {
    document.getElementById("charg_code").value = "";

    document.getElementById("os_amo").value = "";

  //  document.getElementById("creditor").value = "";

    document.getElementById("lc_amo").value = "";

    document.getElementById("description").value = "";
}
loc ="add";
    document.getElementById("charg_code").focus();

  }
}

function new_inv() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  document.getElementById("charg_code").value = "";
  document.getElementById("os_amo").value = "";
  document.getElementById("creditor").value = "";
  document.getElementById("txt_rate").value = "1";
  document.getElementById("lc_amo").value = "";
  document.getElementById("itemdetails").innerHTML = "";
  document.getElementById("msg_box").innerHTML = "";
  document.getElementById("tmpno").value = "";
  document.getElementById("txt_entno").value = "";

  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "new_inv";
  url = url + "&jobno=" + document.getElementById("txt_consolno").value;
  url = url + "&type=" + document.getElementById("txt_type").value;
  url = url + "&txt_houseno=" + document.getElementById("txt_houseno").value;

  xmlHttp.onreadystatechange = showresultnew;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function showresultnew() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgID");
    document.getElementById("csType").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgName");
    document.getElementById("csName").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OVAgadd");
    document.getElementById("csAdd").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CusId");
    document.getElementById("shType").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CuName");
    document.getElementById("shName").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cuadd");
    document.getElementById("shAdd").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobdate");
    document.getElementById("job_date").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("inv_tb");
    document.getElementById("inv_box").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function save_inv() {
  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "save_item";

  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&txt_consolno=" + document.getElementById("txt_consolno").value;
  url = url + "&crndate=" + document.getElementById("invdate").value;
  url = url + "&txt_houseno=" + document.getElementById("txt_houseno").value;
  url = url + "&txt_type=" + document.getElementById("txt_type").value;

  url = url + "&shType=" + document.getElementById("shType").value;
  url = url + "&shName=" + document.getElementById("shName").value;
  url = url + "&shAdd=" + document.getElementById("shAdd").value;

  url = url + "&csType=" + document.getElementById("csType").value;
  url = url + "&csName=" + document.getElementById("csName").value;
  url = url + "&csAdd=" + document.getElementById("csAdd").value;

  url = url + "&svat=" + document.getElementById("svat").value;
  url = url + "&amount=" + document.getElementById("amount").value;
  url = url + "&taxa=" + document.getElementById("taxa").value;
  url = url + "&gross=" + document.getElementById("gross").value;

  xmlHttp.onreadystatechange = showresultsave;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function post() {
  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "post";

  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&txt_consolno=" + document.getElementById("txt_consolno").value;
  url = url + "&crndate=" + document.getElementById("invdate").value;
  url = url + "&txt_houseno=" + document.getElementById("txt_houseno").value;
  url = url + "&txt_type=" + document.getElementById("txt_type").value;

  xmlHttp.onreadystatechange = showresultsave;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function post1() {
  var url = "invoice_opr_data.php";
  url = url + "?Command=" + "save_item";

  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&txt_consolno=" + document.getElementById("txt_consolno").value;
  url = url + "&crndate=" + document.getElementById("invdate").value;
  url = url + "&txt_houseno=" + document.getElementById("txt_houseno").value;
  url = url + "&txt_type=" + document.getElementById("txt_type").value;

  url = url + "&shType=" + document.getElementById("shType").value;
  url = url + "&shName=" + document.getElementById("shName").value;
  url = url + "&shAdd=" + document.getElementById("shAdd").value;

  url = url + "&csType=" + document.getElementById("csType").value;
  url = url + "&csName=" + document.getElementById("csName").value;
  url = url + "&csAdd=" + document.getElementById("csAdd").value;

  xmlHttp.onreadystatechange = showresultsave;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function showresultsave() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    document.getElementById("msg_box").innerHTML =
      "<div class='alert alert-warning' role='alert'><span class='center-block'>" +
      xmlHttp.responseText +
      "</span></div>";
  }
}

function search() {
  $("#myModal_search").modal("show");
  search_cos("");
}

function search_cos(cdata) {
  var url = "costing_data.php";
  url = url + "?Command=" + "search_cos";

  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&txt_consolno=" + document.getElementById("txt_consolno").value;
  url = url + "&crndate=" + document.getElementById("invdate").value;
  url = url + "&mtype=" + cdata;

  url = url + "&jobno=" + document.getElementById("jobno").value;
  url = url + "&costnum=" + document.getElementById("costnum").value;
  url = url + "&invoiceno=" + document.getElementById("invoiceno").value;
  url = url + "&creditor=" + document.getElementById("creditor").value;

  xmlHttp.onreadystatechange = showresultsearch;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function showresultsearch() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    document.getElementById("search_res").innerHTML = xmlHttp.responseText;
  }
}


function print_me(cdata,cdata1) {
  var url = "invoice_opr_print.php";
  url = url + "?tmp_no=" + cdata;
  url = url + "&action=" + cdata1;

  window.open(url, '_blank');

}
