var loc = "add";

var wage = document.getElementById("itemPrice");
wage.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        add_tmp();
    }
});


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





function getno1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "getno";
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&sdate=" + document.getElementById('invdate').value;


    xmlHttp.onreadystatechange = assign_invno;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function add_tmp() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if ((document.getElementById('txt_entno').value != "")) {

        var url = "bank_deposit_data.php";
        url = url + "?Command=" + "add_tmp";
        url = url + "&invno=" + document.getElementById('txt_entno').value;
        url = url + "&itemCode=" + document.getElementById('txt_gl_code').value;
        url = url + "&itemDesc=" + document.getElementById('txt_gl_name').value;
        url = url + "&itemPrice=" + document.getElementById('itemPrice').value;

        url = url + "&tmpno=" + document.getElementById('tmpno').value;


        xmlHttp.onreadystatechange = showarmyresultdel;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);

    }  

}

function showarmyresultdel() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;



        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("subtot");
        document.getElementById('subtot').value = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('txt_gl_code').value = "";
        document.getElementById('txt_gl_name').value = "";
        document.getElementById('itemPrice').value = "";
        document.getElementById('txt_gl_name').focus();
    }
}

function update_cust_list(stname)
{   
	
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
			
		 
				var url="bank_deposit_data.php";			
		 
			 
			url=url+"?Command="+"search_chq";
			
			if (document.getElementById('cusno').value!=""){
				url=url+"&mstatus=cusno";
			} else if (document.getElementById('customername').value!=""){
				url=url+"&mstatus=customername";
			}
			
			url=url+"&cusno="+document.getElementById('cusno').value;
			url=url+"&customername="+document.getElementById('customername').value;
			url=url+"&stname="+stname;
			
					
			xmlHttp.onreadystatechange=showcustresult;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
		
	
}

function showcustresult()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
	 
		
		document.getElementById('filt_table').innerHTML=xmlHttp.responseText;
	}
}


function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    document.getElementById('msg_box').innerHTML = "";
    if (document.getElementById('tmpno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Not Selected</span></div>";
        return false;
    }
     
    if (document.getElementById('subtot1').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Amount Not Enterd</span></div>";
        return false;
    }
    if (document.getElementById('subtot').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Amount Not Enterd</span></div>";
        return false;
    }
    var a = document.getElementById('subtot1').value;
    a = a.replace(",", "");
    a = a.replace(",", "");
    a = a.replace(",", "");
    a = parseFloat(a);
    
    var b = document.getElementById('subtot').value;
    b = b.replace(",", "");
    b = b.replace(",", "");
    b = b.replace(",", "");
    
    b = parseFloat(b);
    if (a != b) {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Amount Mismatch</span></div>";
        return false;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&invno=" + document.getElementById('txt_entno').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&entrydate=" + document.getElementById('invdate').value;
    url = url + "&subtot=" + document.getElementById('subtot').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&txt_narration=" + document.getElementById('txt_narration').value;
    url = url + "&txt_payments=" + document.getElementById('subtot1').value;
    url = url + "&bank=" + document.getElementById('bank').value;
    url = url + "&currency=" + document.getElementById('currency').value;
    url = url + "&txt_rate=" + document.getElementById('txt_rate').value;
    xmlHttp.onreadystatechange = salessaveresult;
    
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function salessaveresult() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
             
            document.getElementById('filup').style.visibility = "visible";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function print_inv(cdata) {

    var url = "recepit_entry_print.php";
    url = url + "?tmp_no=" + document.getElementById('tmpno').value;
    url = url + "&action=" + cdata;

    window.open(url, '_blank');


}


function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    document.getElementById('txt_entno').value = "";
 
    document.getElementById('itemdetails').innerHTML = "";
document.getElementById('itemdetails1').innerHTML = "";

    document.getElementById('txt_heading').value = "";

    document.getElementById('subtot').value = "";
document.getElementById('subtot1').value = "";

    document.getElementById('txt_gl_code').value = "";
    document.getElementById('txt_gl_name').value = "";
    document.getElementById('itemPrice').value = "";


    document.getElementById('txt_narration').value = "";
     

    document.getElementById('msg_box').innerHTML = "";
    document.getElementById('filebox').innerHTML = "";
    document.getElementById('file-3').value = "";



    document.getElementById('filup').style.visibility = "hidden";

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "new_inv";

    xmlHttp.onreadystatechange = assign_invno;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function assign_invno() {



    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("invno");
        document.getElementById('txt_entno').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmpno");
        document.getElementById('tmpno').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dt");
        document.getElementById('invdate').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dt");
        document.getElementById('cheq_date').value = XMLAddress1[0].childNodes[0].nodeValue;
    }

}




function del_item(cdate) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "del_item";
    url = url + "&code=" + cdate;
    url = url + "&invno=" + document.getElementById('tmpno').value;
    ;
    xmlHttp.onreadystatechange = showarmyresultdel;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}




function crnview(custno, stname)
{
    try {


        xmlHttp = GetXmlHttpObject();
        if (xmlHttp == null)
        {
            alert("Browser does not support HTTP Request");
            return;
        }

        var url = "bank_deposit_data.php";
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

function pass_rec_result()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmp_no");
        opener.document.form1.tmpno.value = XMLAddress1[0].childNodes[0].nodeValue;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
        opener.document.form1.txt_entno.value = XMLAddress1[0].childNodes[0].nodeValue;
 

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_DATE");
        opener.document.form1.invdate.value = XMLAddress1[0].childNodes[0].nodeValue;



          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_DATE");
        opener.document.form1.invdate.value = XMLAddress1[0].childNodes[0].nodeValue;

   XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("subtot");
        opener.document.form1.subtot.value = XMLAddress1[0].childNodes[0].nodeValue;


          XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("subtot1");
        opener.document.form1.subtot1.value = XMLAddress1[0].childNodes[0].nodeValue;



        


 
       
 
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_narration");
        opener.document.form1.txt_narration.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("BANK");
        opener.document.form1.bank.value = XMLAddress1[0].childNodes[0].nodeValue;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        window.opener.document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table1");
        window.opener.document.getElementById('itemdetails1').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

  


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("msg");
        if (XMLAddress1[0].childNodes[0].nodeValue != "") {
            window.opener.document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + XMLAddress1[0].childNodes[0].nodeValue + "</span></div>";
        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("filebox");
        window.opener.document.getElementById('filebox').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        window.opener.document.getElementById('filup').style.visibility = "visible";



        self.close();
    }
}

function settext() {

}

function update_list(stname) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "update_list";
    url = url + "&refno=" + document.getElementById('cusno').value;
    url = url + "&cusname=" + document.getElementById('customername').value;
    url = url + "&stname=" + stname;

    xmlHttp.onreadystatechange = showitemresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function showitemresult()
{
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;
    }
}



function cancel_inv() {
    $('#myModal_c').modal('hide');

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    document.getElementById('msg_box').innerHTML = "";
    
    if (document.getElementById('subtot1').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Select Entry</span></div>";
        return false;
    }

    var a = document.getElementById('subtot1').value;
    a = a.replace(",", "");
    a = a.replace(",", "");
    a = a.replace(",", "");
    a = parseFloat(a);
    
    var b = document.getElementById('subtot').value;
    b = b.replace(",", "");
    b = b.replace(",", "");
    b = b.replace(",", "");
    b = parseFloat(b);
    if (a != b) {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'></span></div>";
        return false;
    }
    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "del_inv";
    url = url + "&crnno=" + document.getElementById('txt_entno').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    xmlHttp.onreadystatechange = cancel_result;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function cancel_result() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {


        if (xmlHttp.responseText == "ok") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Cancelled</span></div>";
            setTimeout(function () {
                window.location.reload(1);
            }, 3000);
        } else {
            if (xmlHttp.responseText != "") {
                document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
            }
        }
    }
}




function setcheq()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "setcheq";
    url = url + "&Command1=add";
    url = url + "&txt_entno=" + document.getElementById('txt_entno').value;
    url = url + "&chqno=" + document.getElementById('chqno').value;

    myString = document.getElementById("txt_narration").value;
    myString = myString.replace(/[\r\n]/g, "<br/>");
    myString = myString.replace(/\s/g, "&nbsp;");
    myString = myString.replace(/'/g, "''");
    myString = myString.replace(/&/g, "~");

    url = url + "&TXT_HEADING=" + myString;
    url = url + "&chqdate=" + document.getElementById('chqdate').value;

    myString = document.getElementById("narration").value;
    myString = myString.replace(/[\r\n]/g, "<br/>");
    myString = myString.replace(/\s/g, "&nbsp;");
    myString = myString.replace(/'/g, "''");
    myString = myString.replace(/&/g, "~");
    url = url + "&narration=" + myString;
    url = url + "&bank=" + document.getElementById('bankc').value;
    url = url + "&chqamt=" + document.getElementById('chqamt').value;
    url = url + "&id=" + document.getElementById('id').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    xmlHttp.onreadystatechange = setcheq_result2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function setcheq_result2()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {



        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("chq_table");
        document.getElementById('itemdetails1').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("totamt");
        document.getElementById('subtot1').value = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('chqno').value = "";
        document.getElementById('chqdate').value = "";
        document.getElementById('narration').value = "";
        document.getElementById('bankc').value = "";
        document.getElementById('chqamt').value = "";
        document.getElementById('id').value = "0";


    }
}


function del_item2(accno1) {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "bank_deposit_data.php";
    url = url + "?Command=" + "setcheq";
    url = url + "&Command1=del";
    url = url + "&accno1=" + accno1;
    url = url + "&txt_entno=" + document.getElementById('txt_entno').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    xmlHttp.onreadystatechange = setcheq_result2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}



function chqno(custno, stname)
{   
			//alert(stname);
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
			
			if (stname=="bankdepo"){
				var url="bank_deposit_data.php";			
				url=url+"?Command="+"pass_chqno";
				url=url+"&id="+custno;
							
				//alert(url);
				xmlHttp.onreadystatechange=passcusresult_depochqno;
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
			}
}

function passcusresult_depochqno()
{
	
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		//alert(xmlHttp.responseText);
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cheque_no");	
		opener.document.form1.chqno.value=XMLAddress1[0].childNodes[0].nodeValue;
		
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("che_date");	
		opener.document.form1.chqdate.value=XMLAddress1[0].childNodes[0].nodeValue;
		
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");	
		opener.document.form1.id.value=XMLAddress1[0].childNodes[0].nodeValue;
		
				
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("che_amount");	
		opener.document.form1.chqamt.value=XMLAddress1[0].childNodes[0].nodeValue;
		
		 
		
		self.close();
	}
}
