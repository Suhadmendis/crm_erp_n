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


function jobsumm() {
  var url = "report_jobsumm.php";
  url = url + "?dtfrom=" + document.getElementById("dtfrom").value;
  url = url + "&dtto=" + document.getElementById("dtto").value;
  url = url + "&form=SEA";
  if (document.getElementById("import").checked == true) {
    url = url + "&type=SIMP";
  }
  if (document.getElementById("export").checked == true) {
    url = url + "&type=SEXP";
  }
  if (document.getElementById("all").checked == true) {
    url = url + "&type=all";
  }

  window.open(url, "_blank");
}

function add_tmp_cont() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  if (document.getElementById("tmpno1").value != "") {

    var url = "sea_job_data.php";
    url = url + "?Command=" + "setcont";
    url = url + "&Command1=" + "add_tmp";

    url = url + "&contno=" + document.getElementById("cntno").value;
    url = url + "&conttype=" + document.getElementById("cnttype").value;
    url = url + "&mode=" + document.getElementById("cntmode").value;
    url = url + "&sealno=" + document.getElementById("cntseal").value;
    url = url + "&packtype=" + document.getElementById("cntpkg").value;
    url = url + "&noofpkg=" + document.getElementById("cntpkgn").value;
    url = url + "&netwegt=" + document.getElementById("cntnetw").value;
    url = url + "&grosswegt=" + document.getElementById("cntgross").value;
    url = url + "&cmb=" + document.getElementById("cntcbm").value;
    url = url + "&sealisse=" + document.getElementById("cntseali").value;
    url = url + "&tmpno=" + document.getElementById("tmpno1").value;
    xmlHttp.onreadystatechange = add_tmp_cont_result;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  }
}

function del_item_cont(cdate) {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "sea_job_data.php";
  url = url + "?Command=" + "setcont";
  url = url + "&Command1=" + "del_item";
  url = url + "&contno=" + cdate;
  url = url + "&tmpno=" + document.getElementById("tmpno1").value;

  xmlHttp.onreadystatechange = add_tmp_cont_result;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function add_tmp_cont_result() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    //        alert(xmlHttp.responseText);

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("contdt").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;

    document.getElementById("cntno").value = "";
    document.getElementById("cnttype").value = "";
    document.getElementById("cntmode").value = "";
    document.getElementById("cntseal").value = "";
    document.getElementById("cntpkg").value = "";
    document.getElementById("cntpkgn").value = "";
    document.getElementById("cntnetw").value = "";
    document.getElementById("cntgross").value = "";
    document.getElementById("cntcbm").value = "";
    document.getElementById("cntseali").value = "";
  }
}

function save_inv() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  if (document.getElementById("tmpno").value == "") {
    document.getElementById("msg_box").innerHTML =
    "<div class='alert alert-warning' role='alert'><span class='center-block'>New Not Selected</span></div>";
    return false;
  }
  if (document.getElementById("txt_entno").value == "") {
    document.getElementById("msg_box").innerHTML =
    "<div class='alert alert-warning' role='alert'><span class='center-block'>New Not Selected</span></div>";
    return false;
  }

  var url = "sea_job_data.php";
  url = url + "?Command=" + "save_item";

  url = url + "&txt_entno=" + document.getElementById("txt_entno").value;
  url = url + "&tmpno=" + document.getElementById("tmpno").value;
  url = url + "&carrier=" + document.getElementById("carrier").value;
  url = url + "&carrercode=" + document.getElementById("carrercode").value;
  url =
  url + "&masterLoadCode=" + document.getElementById("masterLoadCode").value;
  url =
  url +
  "&masterLoadDetails=" +
  document.getElementById("masterLoadDetails").value;

  url =
  url + "&masterLoadCode=" + document.getElementById("masterLoadCode").value;
  url =
  url +
  "&masterLoadDetails=" +
  document.getElementById("masterLoadDetails").value;
  url =
  url +
  "&masterUnloadCode=" +
  document.getElementById("masterUnloadCode").value;
  url =
  url +
  "&masterUnloadDetails=" +
  document.getElementById("masterUnloadDetails").value;

  url = url + "&eta=" + document.getElementById("eta").value;
  url = url + "&depdate=" + document.getElementById("depdate").value;

  url = url + "&mastblno=" + document.getElementById("mastblno").value;
  url = url + "&voyageno=" + document.getElementById("voyageno").value;
  url = url + "&mastsn=" + document.getElementById("mastsn").value;
  url = url + "&vessel_name=" + document.getElementById("vessel_name").value;

  url = url + "&mastshipper=" + document.getElementById("mastshipper").value;
  url = url + "&mastsno=" + document.getElementById("mastsno").value;
  url = url + "&Consolidated_Cargo=" + document.getElementById("salesman1").value;

  xmlHttp.onreadystatechange = salessaveresult;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function salessaveresult() {
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

function new_inv() {
  window.location.assign("home.php?url=sea_imp");
}

function new_inv1() {

  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  document.getElementById("txt_entno").value = "";
  document.getElementById("mastblno").value = "";

  document.getElementById("msg_box").innerHTML = "";
  document.getElementById("carrier").value = "";
  document.getElementById("carrercode").value = "";

  document.getElementById("mastshipper").value = "";
  document.getElementById("mastsno").value = "";
  document.getElementById("vessel_name").value = "";
  document.getElementById("voyageno").value = "";
  document.getElementById("mastsn").value = "";
  document.getElementById("masterLoadCode").value = "";
  document.getElementById("masterLoadDetails").value = "";

  document.getElementById("masterUnloadCode").value = "";
  document.getElementById("masterUnloadDetails").value = "";

  document.getElementById("contdt").innerHTML = "";
  document.getElementById("filebox").innerHTML = "";
  document.getElementById("file-3").value = "";
  document.getElementById("filup").style.visibility = "hidden";

  var url = "air_job_reg_data.php";
  url = url + "?Command=" + "new_inv";
  xmlHttp.onreadystatechange = assign_invno;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function assign_invno() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("invno");
    document.getElementById("txt_entno").value = XMLAddress1[0].childNodes[0].nodeValue;
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dt");
    // document.getElementById("invdate").value = XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function crnview(custno, stname) {
  try {
    document.getElementById("newInv").value = "new";

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
      alert("Browser does not support HTTP Request");
      return;
    }

    var url = "sea_job_data.php";
    url = url + "?Command=" + "pass_rec";
    url = url + "&refno=" + custno;
    url = url + "&stname=" + stname;

    xmlHttp.onreadystatechange = pass_rec_result;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch (err) {
    alert(err.message);
  }
}

function pass_rec_result() {
  var XMLAddress1;

  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    // alert(xmlHttp.responseText);

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
    document.form1.txt_entno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmp_no");
    document.form1.tmpno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("VoyageNo");
    document.form1.voyageno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("VoyageNo");
    document.form1.voyageno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("DepDate");
    document.form1.depdate.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ETA");
    document.form1.eta.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mawb1");
    document.form1.mastblno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("MsSerial");
    document.form1.mastsn.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("MasterShipper");
    document.form1.mastshipper.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("carrier");
    document.form1.carrier.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("carrercode");
    document.form1.carrercode.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("vessel_name");
    document.form1.vessel_name.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("plcdepature");
    document.form1.masterLoadDetails.value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Depcode");
    document.form1.masterLoadCode.value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("plcdestin");
    document.form1.masterUnloadDetails.value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Descode");
    document.form1.masterUnloadCode.value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("MastSNo");
    document.form1.mastsno.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table1");
    document.getElementById("consol_det").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;


    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtcost");
    document.getElementById("cos").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtinvoiced");
    document.getElementById("inv").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txtprofit");
    document.getElementById("pro").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;


  }
}

function load_hbl(cdata, cdata1) {
  try {
    document.getElementById("newInv").value = "new";

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
      alert("Browser does not support HTTP Request");
      return;
    }

    var url = "sea_job_data.php";
    url = url + "?Command=" + "load_hbl";
    url = url + "&jobno=" + cdata;
    url = url + "&hblno=" + cdata1;

    xmlHttp.onreadystatechange = pass_hbl_result;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch (err) {
    alert(err.message);
  }
}

function pass_hbl_result() {
  var XMLAddress1;

  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    document.getElementById("msg_box").innerHTML = "";

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Exporter");
    document.getElementById("exprCode").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Consignee");
    document.getElementById("consCode").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("NotyParty");
    document.getElementById("nPartyCode").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ExName");
    document.getElementById("exprName").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ConName");
    document.getElementById("consName").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Notname");
    document.getElementById("nPartyName").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ExprtAdd");
    document.getElementById("exprDetails").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ConsignAdd");
    document.getElementById("consDetails").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("NotyfyAdd");
    document.getElementById("nPartyDetails").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceLoad");
    document.getElementById("houseLoadCode").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceLoadDes");
    document.getElementById("houseLoadDetails").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceUnload");
    document.getElementById("houseUnloadCode").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceUnloadDes");
    document.getElementById("houseUnloadDetails").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("SLMAN");
    document.getElementById("salesman").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("contdt").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno1");
    document.getElementById("tmpno1").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("hblno");
    document.getElementById("houseAwbNo").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("OSerialN");
    document.getElementById("airLine").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Marks");
    document.getElementById("marks").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Description");
    document.getElementById("descrpit").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GNofPkg");
    document.getElementById("noOfPkgs").value =
    XMLAddress1[0].childNodes[0].nodeValue;


    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("GrossMas");
    document.getElementById("Grossmas").value =
    XMLAddress1[0].childNodes[0].nodeValue;


    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CBM");
    document.getElementById("tcbm").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("TypeofPkg");
    document.getElementById("typeofkg").value =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("DOExpry");
    document.getElementById("houseUnloadDate").value =
    XMLAddress1[0].childNodes[0].nodeValue;



  }
}

function view() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "sea_job_data.php";
  url = url + "?Command=" + "view";
  url = url + "&dtfrom=" + document.getElementById("dtfrom").value;
  url = url + "&dtto=" + document.getElementById("dtto").value;

  url = url + "&jobno=" + document.getElementById("jobno").value;
  url = url + "&agent=" + document.getElementById("agent").value;
  url = url + "&masterbl=" + document.getElementById("masterbl").value;
  url = url + "&flight=" + document.getElementById("flight").value;

  url = url + "&hjobno=" + document.getElementById("hjobno").value;
  url = url + "&house=" + document.getElementById("house").value;
  url = url + "&shipper=" + document.getElementById("shipper").value;
  url = url + "&consignee=" + document.getElementById("consignee").value;
  url = url + "&port=" + document.getElementById("port").value;
  url = url + "&date=" + document.getElementById("date").value;
  url = url + "&chweight=" + document.getElementById("chweight").value;
  url = url + "&carton=" + document.getElementById("carton").value;
  url = url + "&salsman=" + document.getElementById("salsman").value;
  url = url + "&limit=" + document.getElementById("limit").value;

  if (document.getElementById("import").checked == true) {
    url = url + "&type=SIMP";
  }
  if (document.getElementById("export").checked == true) {
    url = url + "&type=SEXP";
  }
  if (document.getElementById("all").checked == true) {
    url = url + "&type=all";
  }
  document.getElementById("itemdetails").innerHTML = "";
  document.getElementById("itemdetails1").innerHTML = "";
  xmlHttp.onreadystatechange = viewResult;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function viewResult() {
  var XMLAddress1;

  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("itemdetails").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table1");
    document.getElementById("itemdetails1").innerHTML =
    XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function add_new_hbl() {
  document.getElementById("exprCode").value = "";
  document.getElementById("consCode").value = "";
  document.getElementById("nPartyCode").value = "";
  document.getElementById("exprName").value = "";
  document.getElementById("consName").value = "";
  document.getElementById("nPartyName").value = "";
  document.getElementById("exprDetails").value = "";
  document.getElementById("consDetails").value = "";
  document.getElementById("nPartyDetails").value = "";
  document.getElementById("houseLoadCode").value = "";
  document.getElementById("houseLoadDetails").value = "";
  document.getElementById("houseUnloadCode").value = "";
  document.getElementById("houseUnloadDetails").value = "";

  document.getElementById("salesman").value = "";
  document.getElementById("noOfPkgs").value = "";

  document.getElementById("tmpno1").value = "";
  document.getElementById("houseAwbNo").value = "";
  document.getElementById("contdt").innerHTML = "";
  document.getElementById("msg_box").innerHTML = "";

  document.getElementById("airLine").value = "";
  document.getElementById("marks").value = "";
  document.getElementById("descrpit").value = "";

  var url = "sea_job_data.php";
  url = url + "?Command=" + "new_hbl";
  url = url + "&jobno=" + document.getElementById("txt_entno").value;

  xmlHttp.onreadystatechange = viewResult_addhbl;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function viewResult_addhbl() {
  var XMLAddress1;

  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno1");
    document.getElementById("tmpno1").value =
    XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function save_hbl() {
  var url = "sea_job_data.php";
  var params = "Command=" + "save_hbl";
  params = params + "&jobno=" + document.getElementById("txt_entno").value;

  params = params + "&exprCode=" + document.getElementById("exprCode").value;
  params = params + "&consCode=" + document.getElementById("consCode").value;
  params =
  params + "&nPartyCode=" + document.getElementById("nPartyCode").value;
  params = params + "&exprName=" + document.getElementById("exprName").value;
  params = params + "&consName=" + document.getElementById("consName").value;
  params =
  params + "&nPartyName=" + document.getElementById("nPartyName").value;
  params =
  params + "&exprDetails=" + document.getElementById("exprDetails").value;
  params =
  params + "&consDetails=" + document.getElementById("consDetails").value;
  params =
  params + "&nPartyDetails=" + document.getElementById("nPartyDetails").value;

  params =
  params + "&houseLoadCode=" + document.getElementById("houseLoadCode").value;
  params =
  params +
  "&houseLoadDetails=" +
  document.getElementById("houseLoadDetails").value;
  params =
  params +
  "&houseUnloadCode=" +
  document.getElementById("houseUnloadCode").value;
  params =
  params +
  "&houseUnloadDate=" +
  document.getElementById("houseUnloadDate").value;
  params =
  params +
  "&houseUnloadDetails=" +
  document.getElementById("houseUnloadDetails").value;

  params = params + "&salesman=" + document.getElementById("salesman").value;

  params = params + "&tmpno1=" + document.getElementById("tmpno1").value;
  params =
  params + "&houseAwbNo=" + document.getElementById("houseAwbNo").value;
  params = params + "&noOfPkgs=" + document.getElementById("noOfPkgs").value;
  params = params + "&descrpit=" + document.getElementById("descrpit").value;
  params = params + "&marks=" + document.getElementById("marks").value;

  params = params + "&typeofkg=" + document.getElementById("typeofkg").value;
  params = params + "&NofSale=" + document.getElementById("NofSale").value;
  params = params + "&Grossmas=" + document.getElementById("Grossmas").value;
  params = params + "&tcbm=" + document.getElementById("tcbm").value;
  params = params + "&GserialN=" + document.getElementById("GserialN").value;
  params = params + "&airLine=" + document.getElementById("airLine").value;



  if (document.getElementById("man").checked==true) {
    params = params + "&manu=1";
  } else {
    params = params + "&manu=0";
  }

  xmlHttp.open("POST", url, true);

  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.setRequestHeader("Content-length", params.length);
  xmlHttp.setRequestHeader("Connection", "close");

  xmlHttp.onreadystatechange = salessaveresult;

  xmlHttp.send(params);
}

function print_dn() {
  var url = "sea_job_reg_dn_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;

  window.open(url, "_blank");
}
function print_an() {
  var url = "sea_job_an_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;
  url = url + "&tmp_no1=" + document.getElementById("tmpno1").value;
  window.open(url, "_blank");
}

function print_mn() {
  var url = "sea_job_mn_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;

  window.open(url, "_blank");
}

function costing() {
  var url =
  "home.php?url=costing&jobno=" + document.getElementById("txt_entno").value;
  window.open(url, "_blank");
}

function invoice() {
  var url =
  "home.php?url=inv_opr&jobno=" + document.getElementById("txt_entno").value;
  url = url + "&inv_type=";

  if (document.getElementById("con").checked == true) {
    url = url + "CON";
    url = url + "&house_no=";
  } else {
    url = url + "HUS";
    url = url + "&house_no=" + document.getElementById("houseAwbNo").value;
  }

  window.open(url, "_blank");
}


function print_xml() {
  var url = "sea_job_xml_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;

  window.open(url, "_blank");
}
