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

    var url = "search_deliverynote_data.php";
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
    var url = "search_deliverynote_data.php";
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
        
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_code");
        opener.document.getElementById('refno').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cus_txt");
        opener.document.getElementById('cus_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("addr_txt");
        opener.document.getElementById('addr_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
            
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("costingref_txt");
        opener.document.getElementById('costingref_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

         XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sdate");
        opener.document.getElementById('date_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("pono_txt");
        opener.document.getElementById('pono_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobno_txt");
        opener.document.getElementById('jobno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;
        
         XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dis_ref");
        opener.document.getElementById('dis_ref').value = XMLAddress1[0].childNodes[0].nodeValue;

       


        var table = "<table class='table table-bordered'>";
          table = table + "<thead>";
          table = table + "<tr>";

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("h1");
            table = table + "<th>"+XMLAddress1[0].childNodes[0].nodeValue+"</th>";
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("h2");
            table = table + "<th>"+XMLAddress1[0].childNodes[0].nodeValue+"</th>";
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("h3");
            table = table + "<th>"+XMLAddress1[0].childNodes[0].nodeValue+"</th>";
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("h4");
            table = table + "<th>"+XMLAddress1[0].childNodes[0].nodeValue+"</th>";
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("h5");
            table = table + "<th>"+XMLAddress1[0].childNodes[0].nodeValue+"</th>";


          

          table = table + "</tr>";
          table = table + "</thead>";
          table = table + "<tbody>";
         
        
var obj;
 XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jTable");

 // console.log(XMLAddress1[1].childNodes[0].nodeValue);
        for (var i = 0; i < XMLAddress1.length; i++) {
            

        // obj = JSON.parse(XMLAddress1[i]);

        obj = JSON.parse(XMLAddress1[i].childNodes[0].nodeValue);
// console.log(obj);
            table = table + "<tr>";
            table = table + "<td>"+obj.h1+"</td>";
            table = table + "<td>"+obj.h2+"</td>";
            table = table + "<td>"+obj.h3+"</td>";
            table = table + "<td>"+obj.h4+"</td>";
            table = table + "<td>"+obj.h5+"</td>";
            table = table + "</tr>";



        }

          table = table + "</tbody>";
          table = table + "</table>";
    
   
        
        opener.document.getElementById('app').innerHTML = table;

        // alert(XMLAddress1[0].childNodes[0].length);

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

    var url = "search_deliverynote_data.php";
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