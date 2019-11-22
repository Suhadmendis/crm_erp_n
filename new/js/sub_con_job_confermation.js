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




function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    
    document.getElementById("supno").value= "";
    document.getElementById("uniq").value= "";
    document.getElementById("sname").value= "";
    document.getElementById("scon_num").value= "";
    document.getElementById("con_add").value= "";
    document.getElementById("scon_date").value= "";
    document.getElementById("spo_no").value= "";
    document.getElementById("jobno").value= "";
    document.getElementById("chq_fav").value= "";
    document.getElementById("nicno").value= "";
    document.getElementById("nic_isu_date").value= "";
    document.getElementById("busregno").value= "";
 
   getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = get_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function get_dt() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        document.getElementById("supno").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}




function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "save_item";
    
    url = url + "&supno=" + document.getElementById("supno").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;
    url = url + "&sname=" + document.getElementById("sname").value;
    url = url + "&scon_num=" + document.getElementById("scon_num").value;
    url = url + "&con_add=" + document.getElementById("con_add").value;
    url = url + "&scon_date=" + document.getElementById("scon_date").value;
    url = url + "&spo_no=" + document.getElementById("spo_no").value;
    url = url + "&jobno=" + document.getElementById("jobno").value;
    url = url + "&chq_fav=" + document.getElementById("chq_fav").value;
    url = url + "&nicno=" + document.getElementById("nicno").value;
    url = url + "&nic_isu_date=" + document.getElementById("nic_isu_date").value;
    url = url + "&busregno=" + document.getElementById("busregno").value;
    
    
    xmlHttp.onreadystatechange = added;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function added() {
    var XMLAddress1;
    if (xmlHttp.readyState === 4 || xmlHttp.readyState === "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";

            //document.getElementById('filup').style.visibility = "visible";
            $("#msg_box").hide().slideDown(200).delay(1500);
            $("#msg_box").slideUp(200);



        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function add_tmp() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

//    url = url + "&aodnumber=" + mid;supno
    url = url + "&supno=" + document.getElementById('supno').value;
    url = url + "&des_task=" + document.getElementById('des_task').value;
    url = url + "&qty1=" + document.getElementById('qty1').value;
    url = url + "&unit_price=" + document.getElementById('unit_price').value;
    url = url + "&total_value=" + document.getElementById('total_value').value;
    url = url + "&spec_remarks1=" + document.getElementById('spec_remarks1').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        document.getElementById('des_task').value = "";
        document.getElementById('qty1').value = "";
        document.getElementById('unit_price').value = "";
        document.getElementById('total_value').value = "";
        document.getElementById('spec_remarks1').value = "";
        
    }
}


function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&supno=" + document.getElementById('supno').value;
    url = url + "&id=" + id;
     // alert("remo 1 :" +id);

    xmlHttp.onreadystatechange = removeAdo;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function removeAdo() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

function add_tmp2() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "setitem2";
    url = url + "&Command1=" + "add_tmp2";

//    url = url + "&aodnumber=" + mid;
    url = url + "&supno=" + document.getElementById('supno').value;
    url = url + "&spono1=" + document.getElementById('spono1').value;
    url = url + "&cheqno1=" + document.getElementById('cheqno1').value;
    url = url + "&qty2=" + document.getElementById('qty2').value;
    url = url + "&unitprice2=" + document.getElementById('unitprice2').value;
    url = url + "&total=" + document.getElementById('total').value;
    url = url + "&spec_remarks2=" + document.getElementById('spec_remarks2').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    xmlHttp.onreadystatechange = aodtmp2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table2");
        document.getElementById('itemdetails2').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        document.getElementById('spono1').value = "";
        document.getElementById('cheqno1').value = "";
        document.getElementById('qty2').value = "";
        document.getElementById('unitprice2').value = "";
        document.getElementById('total').value = "";
        document.getElementById('spec_remarks2').value = "";
                
    }
}


function remove_tmp2(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "sub_con_job_confermation_data.php";
    url = url + "?Command=" + "removerow2";

    url = url + "&uniq=" + document.getElementById('uniq').value;
  // alert(url);
    url = url + "&supno=" + document.getElementById('supno').value;
    url = url + "&id=" + id;
//   alert("remo 2 :" +id);


    xmlHttp.onreadystatechange = removeAdo2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function removeAdo2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails2').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        

    }
}










