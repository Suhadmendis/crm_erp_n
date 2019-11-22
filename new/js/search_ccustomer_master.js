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

    var url = "search_ccustomer_master_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function custno(code,stname)
{
    //alert(code);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "search_ccustomer_master_data.php";
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
        //alert( XMLAddress1[0].childNodes[0].nodeValue);
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("obj");
        var obj = JSON.parse(XMLAddress1[0].childNodes[0].nodeValue);
        console.log(JSON.parse(XMLAddress1[0].childNodes[0].nodeValue));
        
        opener.document.getElementById("addr").value = obj.ADD1;
        // opener.document.getElementById("").value = obj.ADD2;
        // opener.document.getElementById("").value = obj.ADD3;
        // opener.document.getElementById("").value = obj.AltMessage;
        // opener.document.getElementById("").value = obj.CAT;
        // opener.document.getElementById("").value = obj.CODE;
        opener.document.getElementById("con_tel").value = obj.CONT;
        // opener.document.getElementById("").value = obj.CUR_BAL;
        opener.document.getElementById("dob").value = obj.DateOfB;
        opener.document.getElementById("adv_ac_code").value = obj.DebAdvAcc;
        opener.document.getElementById("ac_code").value = obj.DebCntAcc;
        opener.document.getElementById("email").value = obj.EMAIL;
        opener.document.getElementById("faxno").value = obj.FAX;
        opener.document.getElementById("name").value = obj.NAME;
        // opener.document.getElementById("").value = obj.OPBAL;
        // opener.document.getElementById("").value = obj.OPDATE;
        // opener.document.getElementById("").value = obj.Over_DUE_IG_Date;
        // opener.document.getElementById("").value = obj.PEN;
        // opener.document.getElementById("").value = obj.PEN0;
        // opener.document.getElementById("").value = obj.PENDA;
        // opener.document.getElementById("").value = obj.RET_CHEQ;
        // opener.document.getElementById("").value = obj.SupAdvAcc;
        // opener.document.getElementById("").value = obj.SupCntAcc;
        opener.document.getElementById("tel").value = obj.TELE1;
        opener.document.getElementById("mobile").value = obj.TELE2;
        // opener.document.getElementById("").value = obj.acno;
        // opener.document.getElementById("").value = obj.area;
        // opener.document.getElementById("").value = obj.bank_gr_date;
        // opener.document.getElementById("").value = obj.blacklist;
        // opener.document.getElementById("").value = obj.cLIMIT;
        // opener.document.getElementById("").value = obj.chk_bangr;
        // opener.document.getElementById("").value = obj.commoncode;
        // opener.document.getElementById("").value = obj.crprd;
        // opener.document.getElementById("").value = obj.cus_type;
        // opener.document.getElementById("").value = obj.field1;
        // opener.document.getElementById("").value = obj.hide_ost;
        opener.document.getElementById("idno").value = obj.id;
        // opener.document.getElementById("").value = obj.incdays;
        opener.document.getElementById("con_tel").value = obj.mob1;
        // opener.document.getElementById("").value = obj.mob2;
        // opener.document.getElementById("").value = obj.mob3;
        // opener.document.getElementById("").value = obj.note;
        // opener.document.getElementById("").value = obj.o90;
        // opener.document.getElementById("").value = obj.pen2;
        // opener.document.getElementById("").value = obj.provi;
        // opener.document.getElementById("").value = obj.remark;
        // opener.document.getElementById("").value = obj.rep;
        // opener.document.getElementById("").value = obj.svatno;
        // opener.document.getElementById("").value = obj.temp_limit;
        // opener.document.getElementById("").value = obj.tmp_no;
        // opener.document.getElementById("").value = obj.vatno;

       

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


    var url = "search_ccustomer_master_data.php";
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