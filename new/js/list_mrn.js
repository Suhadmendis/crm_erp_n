javascript:void(document.oncontextmenu=null);
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
//
//$(document).ready(function () {
//    $("#sdate").datepicker({
//        format: 'yyyy-mm-dd'
//    });
//});
//

function new_inv() {

}

function csChange(stname) {

  
  
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "list_mrn_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";
    
    var stdate = document.getElementById("startDate").value;    
    var enddate = document.getElementById("endDate").value;    
    
   
  
    
    url = url + "&sdate=" + stdate;
    url = url + "&edate=" + enddate;
    
    
    url = url + "&stname=" + stname;



    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function assign_dt() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


 XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;

       // if (stname === "mrn") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("td");
            document.getElementById('getTable').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        //}



        
    }
}