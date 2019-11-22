function GetXmlHttpObject()
	{
		var xmlHttp=null;	
		try
		 {
			 // Firefox, Opera 8.0+, Safari
			 xmlHttp=new XMLHttpRequest();			
		 }
		catch (e)
		 {
			 // Internet Explorer
			 try
			  {
				  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");				
			  }
			 catch (e)
			  {
				 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");			
			  }
		 }
		return xmlHttp;		
}


function keyset(key, e)
{	

   if(e.keyCode==13){
	document.getElementById(key).focus();
   }
}

function keychange(key)
{	

	document.getElementById(key).focus();
  
}

function got_focus(key)
{	
	document.getElementById(key).style.backgroundColor="#000066";
  
}

function lost_focus(key)
{	
	document.getElementById(key).style.backgroundColor="#000000";
  
}


function view_cashbook()
{
	
	
			var url="rep_cash_book.php";			
			url=url+"?dtfrom="+document.getElementById('dtfrom').value;
			
			
			//url=url+"&vat1="+document.getElementById('vat1').value;
			//url=url+"&vat2="+document.getElementById('vat2').value;
			//alert(url);
			window.open(url);
   
	
}


function chk_summery()
{

	document.getElementById("cmbtype").style.visibility="hidden";
	document.getElementById("cmbdev").style.visibility="visible";
	document.getElementById("cmbsummerytype").style.visibility="visible";
	document.getElementById("cashdis").style.visibility="hidden";
	document.getElementById("svat").style.visibility="hidden";
	
	document.getElementById("cmbRECtype").style.visibility="hidden";
	document.getElementById("cmbretchktype").style.visibility="hidden";


	
}

function chk_rec()
{

	document.getElementById("cmbtype").style.visibility="hidden";
	document.getElementById("cmbdev").style.visibility="visible";
	document.getElementById("cmbsummerytype").style.visibility="hidden";
	document.getElementById("cashdis").style.visibility="hidden";
	document.getElementById("svat").style.visibility="hidden";
	
	document.getElementById("cmbRECtype").style.visibility="visible";
	document.getElementById("cmbretchktype").style.visibility="visible";


	
}

function chk_sales()
{

	document.getElementById("cmbtype").style.visibility="hidden";
	document.getElementById("cmbdev").style.visibility="visible";
	document.getElementById("cmbsummerytype").style.visibility="hidden";
	document.getElementById("cashdis").style.visibility="hidden";
	document.getElementById("svat").style.visibility="visible";
	
	document.getElementById("cmbRECtype").style.visibility="hidden";
	document.getElementById("cmbretchktype").style.visibility="hidden";

/*	document.getElementById('type').innerHTML="";
	document.getElementById('dev').innerHTML="<select name='cmbdev' id='cmbdev' class='text_purchase3'><option value='All'>All</option><option value='Manual'>Van Sale</option><option value='Computer'>Office Sale</option></select>";
	document.getElementById('summery').innerHTML="";
	document.getElementById('cashdis').innerHTML="";
	document.getElementById('svat').innerHTML="<input type='checkbox' name='chk_svat' id='chk_svat' />SVAT";
	document.getElementById('rectype').innerHTML="";
	document.getElementById('chkrettype').innerHTML="";*/
	
	
}

function chk_return()
{
	document.getElementById("cmbtype").style.visibility="visible";
	document.getElementById("cmbdev").style.visibility="visible";
	document.getElementById("cmbsummerytype").style.visibility="hidden";
	document.getElementById("cashdis").style.visibility="visible";
	document.getElementById("svat").style.visibility="hidden";
	document.getElementById("cmbRECtype").style.visibility="hidden";
	document.getElementById("cmbretchktype").style.visibility="hidden";
	
/*	document.getElementById('type').innerHTML="<select name='cmbtype' id='cmbtype' class='text_purchase3'><option value='All'>All</option><option value='GRN'>GRN</option><option value='DGRN'>DGRN</option><option value='Credit Note'>Credit Note</option></select>";
	
	document.getElementById('dev').innerHTML="<select name='cmbdev' id='cmbdev' class='text_purchase3'><option value='All'>All</option><option value='Manual'>Van Sale</option><option value='Computer'>Office Sale</option></select>";
	document.getElementById('summery').innerHTML="";
	document.getElementById('cashdis').innerHTML="<input type='checkbox' name='chk_cash' id='chk_cash' />Cash Dis";
	document.getElementById('svat').innerHTML="";
	document.getElementById('rectype').innerHTML="";
	document.getElementById('chkrettype').innerHTML="";*/
	
	
}

function datehide()
{
	document.getElementById('dateto_name').innerHTML="";
	document.getElementById('dateto').innerHTML="";
}

function showtodate()
{
	document.getElementById('dateto_name').innerHTML="<input type='text'  class='label_purchase' value='To' disabled='disabled'/>";
	document.getElementById('dateto').innerHTML="<input type='text' size='20' name='dtto' id='dtto' value='' onfocus='load_calader('dtto')' class='text_purchase3'/>";
}

function tmp_crelimit()
{ 
	
	xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
			
			
			var url="search_custom_data.php";			
			url=url+"?Command="+"tmp_crelimit";
			url=url+"&Com_rep1="+document.getElementById('Com_rep1').value;
			url=url+"&txt_cuscode="+document.getElementById('txt_cuscode').value;
			url=url+"&cmbbrand1="+document.getElementById('cmbbrand1').value;
			url=url+"&txt_templimit="+document.getElementById('txt_templimit').value;
			//alert(url);
			
			if (document.getElementById('check1').checked==true)
			{
				var mcheck=1;
			} else {
				var mcheck=0;
			}
			url=url+"&check1="+mcheck;
			
				
			xmlHttp.onreadystatechange=result_tmp_crelimit;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
		
}

function result_tmp_crelimit()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		alert(xmlHttp.responseText);
	}
}


function update_bal(dtfrom)
{ 
	
	xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
			
			
			var url="rep_sales_summery_data.php";			
			url=url+"?Command="+"update_bal";
			url=url+"&dtfrom="+dtfrom;
			url=url+"&txtbf="+document.getElementById('txtbf').value;
			url=url+"&open_bal="+document.getElementById('open_bal').innerHTML;
			url=url+"&closing_bal="+document.getElementById('tot_sale').innerHTML;
			//alert(url);
			
			
				
			xmlHttp.onreadystatechange=result_update_bal;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
		
}

function result_update_bal()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		alert(xmlHttp.responseText);
	}
}

