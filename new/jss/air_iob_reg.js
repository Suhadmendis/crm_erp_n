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

function add_tmp_flr() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  if (document.getElementById("tmpno").value != "") {
    var url = "air_job_reg_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&itemCode=" + document.getElementById("flrNo").value;
    url = url + "&flrflNo=" + document.getElementById("flrflNo").value;
    url = url + "&flrEtd=" + document.getElementById("flrEtd").value;
    url = url + "&flrFrom=" + document.getElementById("flrFrom").value;
    url = url + "&flrTo=" + document.getElementById("flrTo").value;
    url = url + "&flrEta=" + document.getElementById("flrEta").value;
    url = url + "&tmpno=" + document.getElementById("tmpno").value;
    xmlHttp.onreadystatechange = add_tmp_flr_result;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  }
}

function del_item_flr(cdate) {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "air_job_reg_data.php";
  url = url + "?Command=" + "setitem";
  url = url + "&Command1=" + "del_item";
  url = url + "&itemCode=" + cdate;
  url = url + "&tmpno=" + document.getElementById("tmpno").value;

  xmlHttp.onreadystatechange = add_tmp_flr_result;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function add_tmp_flr_result() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    //        alert(xmlHttp.responseText);

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("flightRouteDetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

    document.getElementById("flrNo").value = "";
    document.getElementById("flrflNo").value = "";
    document.getElementById("flrEtd").value = "";
    document.getElementById("flrFrom").value = "";
    document.getElementById("flrTo").value = "";
    document.getElementById("flrEta").value = "";

    document.getElementById("flrNo").focus();
  }
}

function add_tmp_weight() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  if (document.getElementById("tmpno1").value != "") {
    var url = "air_job_reg_data.php";
    url = url + "?Command=" + "setweight";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&itemCode=" + document.getElementById("pkgType").value;
    url = url + "&pkgQty=" + document.getElementById("pkgQty").value;
    url = url + "&grossWeight=" + document.getElementById("grossWeight").value;
    url = url + "&chblWeight=" + document.getElementById("chblWeight").value;
    url = url + "&cbm=" + document.getElementById("cbm").value;
    url = url + "&chrgeRate=" + document.getElementById("chrgeRate").value;
    url = url + "&chrgeTotal=" + document.getElementById("chrgeTotal").value;
    url = url + "&tmpno=" + document.getElementById("tmpno1").value;
    xmlHttp.onreadystatechange = add_tmp_weight_result;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  }
}

function del_item_weight(cdate) {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "air_job_reg_data.php";
  url = url + "?Command=" + "setweight";
  url = url + "&Command1=" + "del_item";
  url = url + "&itemCode=" + cdate;
  url = url + "&tmpno=" + document.getElementById("tmpno").value;

  xmlHttp.onreadystatechange = add_tmp_weight_result;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function add_tmp_weight_result() {
  var XMLAddress1;
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    //        alert(xmlHttp.responseText);

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("weightDetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

    document.getElementById("pkgType").options[0].selected = true;

    document.getElementById("pkgQty").value = "";
    document.getElementById("grossWeight").value = "";
    document.getElementById("chblWeight").value = "";
    document.getElementById("cbm").value = "";
    document.getElementById("chrgeRate").value = "";
    document.getElementById("chrgeTotal").value = "";

    document.getElementById("pkgType").focus();
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

  var url = "air_job_reg_data.php";
  url = url + "?Command=" + "save_item";

  url = url + "&txt_entno=" + document.getElementById("txt_entno").value;
  url = url + "&tmpno=" + document.getElementById("tmpno").value;

  url = url + "&invdate=" + document.getElementById("invdate").value;

  url = url + "&master_AWBL1=" + document.getElementById("master_AWBL1").value;
  url = url + "&master_AWBL2=" + document.getElementById("master_AWBL2").value;
  url = url + "&la_code=" + document.getElementById("la_code").value;
  url = url + "&la_name=" + document.getElementById("la_name").value;
  url = url + "&flightNo=" + document.getElementById("flightNo").value;
  url = url + "&airLine=" + document.getElementById("airLine").value;
  url = url + "&fa_code=" + document.getElementById("fa_code").value;
  url = url + "&fa_name=" + document.getElementById("fa_name").value;
  url =
    url + "&masterLoadCode=" + document.getElementById("masterLoadCodea").value;
  url =
    url +
    "&masterLoadDetails=" +
    document.getElementById("masterLoadDetailsa").value;
  url = url + "&loadDate=" + document.getElementById("loadDate").value;
  url =
    url +
    "&masterUnloadCode=" +
    document.getElementById("masterUnloadCodea").value;
  url =
    url +
    "&masterUnloadDetails=" +
    document.getElementById("masterUnloadDetailsa").value;
  url = url + "&unloadDate=" + document.getElementById("unloadDate").value;
  url = url + "&masterPCE=" + document.getElementById("masterPCE").value;
  url = url + "&masterPC=" + document.getElementById("masterPC").value;

  if (document.getElementById("import").checked == true) {
    url = url + "&flag=AIRIM";
  }
  if (document.getElementById("export").checked == true) {
    url = url + "&flag=AIREX";
  }

  xmlHttp.onreadystatechange = salessaveresult;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function setWtVal(cdata) {
  if (cdata == "master") {
    if (document.getElementById("masterPP").checked == true) {
      document.getElementById("masterPCE").value = "CIF";
    } else if (document.getElementById("masterCO").checked == true) {
      document.getElementById("masterPCE").value = "FOB";
    } else {
      document.getElementById("masterPCE").value = "EXW";
    }
  }
}

function setOther(cdata) {
  if (cdata == "master") {
    if (document.getElementById("masterPPD").checked == true) {
      document.getElementById("masterPC").value = "PPD";
    } else if (document.getElementById("masterCOL").checked == true) {
      document.getElementById("masterPC").value = "COL";
    }
  }
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
  window.location.assign("home.php?url=air_job");
}

function new_inv1() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  document.getElementById("txt_entno").value = "";
  document.getElementById("master_AWBL1").value = "";
  document.getElementById("master_AWBL2").value = "";
  document.getElementById("msg_box").innerHTML = "";
  document.getElementById("flightRouteDetails").innerHTML = "";
  document.getElementById("weightDetails").innerHTML = "";
  document.getElementById("la_code").value = "";
  document.getElementById("la_name").value = "";
  document.getElementById("flightNo").value = "";
  document.getElementById("airLine").value = "";
  document.getElementById("fa_code").value = "";
  document.getElementById("fa_name").value = "";
  document.getElementById("masterLoadCodea").value = "";
  document.getElementById("masterLoadDetailsa").value = "";
  document.getElementById("loadDate").value = "";
  document.getElementById("masterUnloadCodea").value = "";
  document.getElementById("masterUnloadDetailsa").value = "";
  document.getElementById("unloadDate").value = "";
  document.getElementById("masterPP").checked = true;
  document.getElementById("masterPPD").checked = true;
  document.getElementById("masterPCE").value = "CIF";
  document.getElementById("masterPC").value = "PPD";

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
    document.getElementById("txt_entno").value =
      XMLAddress1[0].childNodes[0].nodeValue;
    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
    document.getElementById("tmpno").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dt");
    document.getElementById("invdate").value =
      XMLAddress1[0].childNodes[0].nodeValue;
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

    var url = "air_job_reg_data.php";
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

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mawb1");
    document.form1.master_AWBL1.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mawb2");
    document.form1.master_AWBL2.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LoAg");
    document.form1.la_code.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("LoAgDes");
    document.form1.la_name.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Fno");
    document.getElementById("flightNo").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("AirLine");
    document.form1.airLine.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("FoAg");
    document.form1.fa_code.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("FoAgDes");
    document.getElementById("fa_name").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlcLoad");
    document.form1.masterLoadCodea.value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlcLdes");
    document.form1.masterLoadDetailsa.value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("DepDate");

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlcUnload");
    document.form1.masterUnloadCodea.value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlcUdes");
    document.form1.masterUnloadDetailsa.value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ETA");
    document.form1.unloadDate.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("WtVal");
    document.form1.masterPCE.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("WtOther");
    document.form1.masterPC.value = XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
    document.getElementById("flightRouteDetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

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

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("flag");
    if (XMLAddress1[0].childNodes[0].nodeValue == "AIRIM") {
      document.getElementById("import").checked = true;
    }
    if (XMLAddress1[0].childNodes[0].nodeValue == "AIREX") {
      document.getElementById("export").checked = true;
    }
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

    var url = "air_job_reg_data.php";
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
    document.getElementById("houseLoadCodea").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceLoadDes");
    document.getElementById("houseLoadDetailsa").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceUnload");
    document.getElementById("houseUnloadCodea").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PlceUnloadDes");
    document.getElementById("houseUnloadDetailsa").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Etd");
    document.getElementById("etdDate").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Eta");
    document.getElementById("etaDate").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("SLMAN");
    document.getElementById("salesman").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("nofpkg");
    document.getElementById("noOfPkgs").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("accinfo");
    document.getElementById("accInfo").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dofgood");
    document.getElementById("goodsDesc").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ocharge");
    document.getElementById("otherCharges").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("MneDeail");
    document.getElementById("manifestDetails").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table1");
    document.getElementById("weightDetails").innerHTML =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno1");
    document.getElementById("tmpno1").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("hblno");
    document.getElementById("houseAwbNo").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Prfdiliverd");
    document.getElementById("prfDlvrd").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("recby");
    document.getElementById("recBy").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("recon");
    document.getElementById("receivedDate").value =
      XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function view() {
  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }

  var url = "air_job_reg_data.php";
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
    url = url + "&type=AIRIM";
  }
  if (document.getElementById("export").checked == true) {
    url = url + "&type=AIREX";
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
  document.getElementById("houseLoadCodea").value = "";
  document.getElementById("houseLoadDetailsa").value = "";
  document.getElementById("houseUnloadCodea").value = "";
  document.getElementById("houseUnloadDetailsa").value = "";
  document.getElementById("etdDate").value = "";
  document.getElementById("etaDate").value = "";
  document.getElementById("salesman").value = "";
  document.getElementById("noOfPkgs").value = "";
  document.getElementById("accInfo").value = "";
  document.getElementById("goodsDesc").value = "";
  document.getElementById("otherCharges").value = "";
  document.getElementById("manifestDetails").value = "";
  document.getElementById("weightDetails").innerHTML = "";
  document.getElementById("tmpno1").value = "";
  document.getElementById("houseAwbNo").value = "";
  document.getElementById("prfDlvrd").value = "";
  document.getElementById("recBy").value = "";
  document.getElementById("receivedDate").value = "";
  document.getElementById("msg_box").innerHTML = "";
  var url = "air_job_reg_data.php";
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

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("etdDate");
    document.getElementById("etdDate").value =
      XMLAddress1[0].childNodes[0].nodeValue;

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("etaDate");
    document.getElementById("etaDate").value =
      XMLAddress1[0].childNodes[0].nodeValue;
  }
}

function save_hbl() {
  var url = "air_job_reg_data.php";
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
    params + "&houseLoadCode=" + document.getElementById("houseLoadCodea").value;
  params =
    params +
    "&houseLoadDetails=" +
    document.getElementById("houseLoadDetailsa").value;
  params =
    params +
    "&houseUnloadCode=" +
    document.getElementById("houseUnloadCodea").value;
  params =
    params +
    "&houseUnloadDetails=" +
    document.getElementById("houseUnloadDetailsa").value;
  params = params + "&etdDate=" + document.getElementById("etdDate").value;
  params = params + "&etaDate=" + document.getElementById("etaDate").value;
  params = params + "&salesman=" + document.getElementById("salesman").value;
  params = params + "&noOfPkgs=" + document.getElementById("noOfPkgs").value;
  params = params + "&accInfo=" + document.getElementById("accInfo").value;
  params =
    params +
    "&goodsDesc=" +
    encodeURI(document.getElementById("goodsDesc").value);
  params =
    params + "&otherCharges=" + document.getElementById("otherCharges").value;
  params =
    params +
    "&manifestDetails=" +
    document.getElementById("manifestDetails").value;

  params = params + "&tmpno1=" + document.getElementById("tmpno1").value;
  params =
    params + "&houseAwbNo=" + document.getElementById("houseAwbNo").value;
  params = params + "&prfDlvrd=" + document.getElementById("prfDlvrd").value;
  params = params + "&recBy=" + document.getElementById("recBy").value;
  params =
    params + "&receivedDate=" + document.getElementById("receivedDate").value;

  params = params + "&housePCE=" + document.getElementById("housePCE").value;
  params = params + "&housePC=" + document.getElementById("housePC").value;
  params = params + "&carriage=" + document.getElementById("carriage").value;
  params = params + "&customs=" + document.getElementById("customs").value;
  params = params + "&currency=" + document.getElementById("currency").value;
  params = params + "&txt_rate=" + document.getElementById("txt_rate").value;

  if (document.getElementById("import").checked == true) {
    params = params + "&flag=AIRIM";
  }
  if (document.getElementById("export").checked == true) {
    params = params + "&flag=AIREX";
  }

  xmlHttp.open("POST", url, true);

  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.setRequestHeader("Content-length", params.length);
  xmlHttp.setRequestHeader("Connection", "close");

  xmlHttp.onreadystatechange = salessaveresult;

  xmlHttp.send(params);
}

function print_dn() {
  var url = "air_job_reg_dn_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;

  window.open(url, "_blank");
}


function print_hbl() {
  var url = "air_job_reg_hawbl_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;
  url = url + "&tmp_no1=" + document.getElementById("tmpno1").value;
  window.open(url, "_blank");
}


function print_mn() {
  var url = "air_job_reg_mn_print.php";
  url = url + "?tmp_no=" + document.getElementById("tmpno").value;

  window.open(url, "_blank");
}

function jobsumm() {
  var url = "report_jobsumm.php";
  url = url + "?dtfrom=" + document.getElementById("dtfrom").value;
  url = url + "&dtto=" + document.getElementById("dtto").value;
  url = url + "&form=AIR";
  if (document.getElementById("import").checked == true) {
    url = url + "&type=AIRIM";
  }
  if (document.getElementById("export").checked == true) {
    url = url + "&type=AIREX";
  }
  if (document.getElementById("all").checked == true) {
    url = url + "&type=all";
  }

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
