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
	
	
	function GetXmlHttpObject1()
	{
		var xmlHttp1=null;
		try
		 {
			 // Firefox, Opera 8.0+, Safari
			 xmlHttp1=new XMLHttpRequest();
		 }
		catch (e)
		 {
			 // Internet Explorer
			 try
			  {
				  xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
			  }
			 catch (e)
			  {
				 xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
			  }
		 }
		return xmlHttp1;
	}
	
	
function GetXmlHttpObject2()
	{
		var xmlHttp2=null;
		try
		 {
			 // Firefox, Opera 8.0+, Safari
			 xmlHttp2=new XMLHttpRequest();
		 }
		catch (e)
		 {
			 // Internet Explorer
			 try
			  {
				  xmlHttp2=new ActiveXObject("Msxml2.XMLHTTP");
			  }
			 catch (e)
			  {
				 xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");
			  }
		 }
		return xmlHttp2;
	}


function search_visit()
{
	
	if(document.getElementById('nic').value=="")
	{				
		document.getElementById("errormsg").innerHTML="Please Enter NIC";
		document.getElementById("nic").focus();
		return false;
	}
	else
	{
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request");
			return;
		} 		
			
		//var url="save_insert_data.php";	
		var url="insert_visit1.php";
		url=url+"?Command="+"search_visit_details";	
		url=url+"&nic="+document.getElementById('nic').value;
		
		xmlHttp.onreadystatechange=show_visits_data;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);	
	}
		
}


function search_visit_d()
{
	xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request");
			return;
		} 		
			
		//var url="save_insert_data.php";	
		var url="insert_visit1.php";
		url=url+"?Command="+"search_visit_details";	
		if(document.getElementById('nic').value!="")
		{
			url=url+"&nic="+document.getElementById('nic').value;
		
			xmlHttp.onreadystatechange=show_visits_data;
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);	

		}


		
}


function show_visits_data()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	//	alert(xmlHttp.responseText);
		
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("nic");		
		var val=XMLAddress1[0].childNodes[0].nodeValue;
		
	//	alert(val);
		if(val=="Invalied")
		{			
			cleartext();
			document.getElementById("errormsg").innerHTML="Invalied NIC Number";
		}
		else
		{
	//		alert("ok");
			
			document.getElementById("errormsg").innerHTML="";			
			
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("name");						
			document.getElementById('name').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("address");						
			document.getElementById('address').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("refno");						
			document.getElementById('refno').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("notes");						
			document.getElementById('notes').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tel");				
			document.getElementById('telno').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("action");						
			document.getElementById('action').value= XMLAddress1[0].childNodes[0].nodeValue;
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ol");	
		
			if(XMLAddress1[0].childNodes[0].nodeValue>0)
			{
				
				document.getElementById('0l').checked= true;
			}
			else
			{
				document.getElementById('0l').checked= false;
			}
		
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("al");			
			if(XMLAddress1[0].childNodes[0].nodeValue>0)
			{
				
				document.getElementById('al').checked= true;
			}
			else
			{
				document.getElementById('al').checked= false;
			}
			
			XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("gr");			
			if(XMLAddress1[0].childNodes[0].nodeValue>0)
			{
				
				document.getElementById('graduat').checked= true;
			}
			else
			{
				document.getElementById('graduat').checked= false;
			}
			
			
			/*XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");			
			if(XMLAddress1[0].childNodes[0].nodeValue!="")
			{
				
				var opt = document.createElement("option");
				XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");			
				opt.text=XMLAddress1[0].childNodes[0].nodeValue.toUpperCase();
				XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");			
				opt.value=XMLAddress1[0].childNodes[0].nodeValue.toUpperCase();
				document.getElementById("department").options.add(opt);				
				document.getElementById("department").options[(document.getElementById("department").length-1)].selected = true;
				
			}
			*/
			
			
				XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");		
				//alert(XMLAddress1[0].childNodes[0].nodeValue)
				if(XMLAddress1[0].childNodes[0].nodeValue!="")
				{				
					var opt = document.createElement("department");	
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");						
					opt.text=XMLAddress1[0].childNodes[0].nodeValue;
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department");	
					var ins=XMLAddress1[0].childNodes[0].nodeValue;
					opt.value=XMLAddress1[0].childNodes[0].nodeValue;
					
					for(var loop=0;loop <document.getElementById("department").length;loop++ )
					{//alert("loop ="+document.getElementById("seat").options[loop].value +"  "+"ins ="+ins);
						if(document.getElementById("department").options[loop].value==ins)
						{
							document.getElementById("department").options[loop].selected = true;
							break;
						}
						

					}
					
				}
				
				
				
			
			//XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dropseat");						
			//document.getElementById("print_seat").innerHTML= XMLAddress1[0].childNodes[0].nodeValue;
			
			//XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dropreason");						
			//document.getElementById("print_reason").innerHTML= XMLAddress1[0].childNodes[0].nodeValue;
			
			
			
		//	get_seat(val);
		//	get_reason(val);
			

			
				XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("seat");		
				//alert(XMLAddress1[0].childNodes[0].nodeValue)
				if(XMLAddress1[0].childNodes[0].nodeValue!="")
				{				
					var opt = document.createElement("option");	
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("seat");						
					opt.text=XMLAddress1[0].childNodes[0].nodeValue;
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sid");	
					var ins=XMLAddress1[0].childNodes[0].nodeValue;
					opt.value=XMLAddress1[0].childNodes[0].nodeValue;
					
					for(var loop=0;loop <document.getElementById("seat").length;loop++ )
					{//alert("loop ="+document.getElementById("seat").options[loop].value +"  "+"ins ="+ins);
						if(document.getElementById("seat").options[loop].value==ins)
						{
							document.getElementById("seat").options[loop].selected = true;
							break;
						}
						

					}
					
				}
				
				
				
				
				
				XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reasons");		
			//	alert(XMLAddress1[0].childNodes[0].nodeValue)
				if(XMLAddress1[0].childNodes[0].nodeValue!="")
				{				
					var opt = document.createElement("option");	
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reasons");						
					opt.text=XMLAddress1[0].childNodes[0].nodeValue;
					
					XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rid");	
					var ins=XMLAddress1[0].childNodes[0].nodeValue;
					opt.value=XMLAddress1[0].childNodes[0].nodeValue;
					
					for(var loop=0;loop <document.getElementById("reason").length;loop++ )
					{//alert("loop ="+document.getElementById("reason").options[loop].value +"  "+"ins ="+ins);
						if(document.getElementById("reason").options[loop].value==ins)
						{
							document.getElementById("reason").options[loop].selected = true;
							break;
						}
						

					}
					
				}				
			
			
		}
	}
}


function get_seat(val)
{
//	alert(val);
	xmlHttp1=GetXmlHttpObject1();
	if (xmlHttp1==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	} 		
			
		
	var url="drop_seat.php";
	url=url+"?Command="+"drop_seat";	
	url=url+"&nic="+document.getElementById('nic').value;
		
	xmlHttp1.onreadystatechange=show_drop_seat;
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);	
}


function show_drop_seat()
{
	var XMLAddress1;
	
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
	{ 
	//	alert(xmlHttp1.responseText);
		document.getElementById("print_seat").innerHTML=xmlHttp1.responseText;
	}
}

function get_reason(val)
{
	//alert(val);
	xmlHttp2=GetXmlHttpObject2();
	if (xmlHttp1==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	} 		
			
		
	var url="drop_reason.php";
	url=url+"?Command="+"drop_reason";	
	url=url+"&nic="+document.getElementById('nic').value;
		
	xmlHttp2.onreadystatechange=show_drop_reason;
	xmlHttp2.open("GET",url,true);
	xmlHttp2.send(null);	
}

function show_drop_reason()
{
	
	var XMLAddress1;
	
	if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
	{ 
		alert(xmlHttp2.responseText);
		document.getElementById("print_reason").innerHTML=xmlHttp2.responseText;
	}
}


function clearform()
	{	
		setTimeout("location.reload(true);",3000);
	}


function getOptions(object,txt)
{

	var x=object;
	
//	XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_house_type");	
//	var txt=XMLAddress1[0].childNodes[0].nodeValue;
	
	var val=txt;
	
	for (i=0;i<x.length;i++)
	  {
		  if(x.options[i].text==val)
		  {
			// alert(x.options[i].value)
			// alert("Same");
			  x.options[x.options[i].value].selected = true;	//selected Value
			  x.remove(x.selectedIndex);						//remove selected Value
		  }
		 
	  }//End For Loop
	  
}

function ClearDropDown(object,txt)
{
	var x=object;
	var val=txt;
	
	for (i=0;i<x.length;i++)
	  {		 	  	
		  if(x.options[i].text=="")
		  {		  	 
			  x.options[i].selected = true;	//selected Value		 
			
		  }
		 
	  }//End For Loop
}


function get_value()
{
	if(document.getElementById('nic').value=="")
		{
			document.getElementById("errormessage").innerHTML="Please Enter NIC";
			document.getElementById("nic").focus();
			return false;
		}
		else if(document.getElementById('name').value=="")
		{
			document.getElementById("errormessage").innerHTML="Please Enter Name";
			document.getElementById("name").focus();
			return false;
		}
		else
		{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
					
			var url="save_insert_data1.php";		
			url=url+"?Command="+"savedata";	
			;
			url=url+"&name="+document.getElementById('name').value;
			url=url+"&nic="+document.getElementById('nic').value;
			url=url+"&address="+document.getElementById('address').value;
			url=url+"&seat="+document.getElementById('seat').value;
			url=url+"&reason="+document.getElementById('reason').value;
			
			if(document.getElementById('department1').value!="")
			{
				url=url+"&department="+document.getElementById('department1').value;
			}
			else
			{
				url=url+"&department="+document.getElementById('department').value;
			}
			
			url=url+"&refno="+document.getElementById('refno').value;
			url=url+"&action="+document.getElementById('action').value;
			
			if(document.getElementById('0l').checked==true)
			{
				url=url+"&0l="+1;				
			}
			else
			{
				url=url+"&0l="+0;
			}
			if(document.getElementById('al').checked==true)
			{
				url=url+"&al="+1;
			}
			else
			{
				url=url+"&al="+0;
			}
			
			if(document.getElementById('graduat').checked==true)
			{
				url=url+"&graduat="+1;
			}
			else
			{
				url=url+"&graduat="+0;
			}
			
		/*	if(document.getElementById('job').checked==true)
			{
				url=url+"&job="+1;
			}
			else
			{
				url=url+"&job="+0;
			}
			
			
			
			url=url+"&institute="+document.getElementById('institute').value;
			url=url+"&post="+document.getElementById('post').value;*/
			url=url+"&notes="+document.getElementById('notes').value;
			url=url+"&telno="+document.getElementById('telno').value;
		//	alert(url);
			xmlHttp.onreadystatechange=save_details;		
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null)
		}
}


	
		function save_details()
	{
		var XMLAddress1;

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			alert(xmlHttp.responseText);
		//	document.getElementById("errormessage").innerHTML=xmlHttp.responseText;	
			setTimeout("location.reload(true);",500);
		}
	}
	
	
	function InsertDataupdate(serid)
	{
		
		//	alert(document.getElementById('0l').checked);
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
					
			var url="save_insert_data1.php";	
			
			url=url+"?Command="+"updatesavedata";				
			url=url+"&serid="+serid;			
			url=url+"&name="+document.getElementById('name').value;
			url=url+"&nic="+document.getElementById('nic').value;
			url=url+"&address="+document.getElementById('address').value;
			url=url+"&seat="+document.getElementById('seat').value;
			url=url+"&reason="+document.getElementById('reason').value;
			url=url+"&department="+document.getElementById('department').value;
			
			url=url+"&refno="+document.getElementById('refno').value;
			url=url+"&action="+document.getElementById('action').value;
			if(document.getElementById('0l').checked==true)
			{
				url=url+"&0l="+1;
			}
			else
			{
				url=url+"&0l="+0;
			}
			if(document.getElementById('al').checked==true)
			{
				url=url+"&al="+1;
			}
			else
			{
				url=url+"&al="+0;
			}
			if(document.getElementById('graduat').checked==true)
			{
				url=url+"&graduat="+1;
			}
			else
			{
				url=url+"&graduat="+0;
			}
		/*	
			if(document.getElementById('job').checked==true)
			{
				url=url+"&job="+1;
			}
			else
			{
				url=url+"&job="+0;
			}
			
			
		
			url=url+"&institute="+document.getElementById('institute').value;
			url=url+"&post="+document.getElementById('post').value;
			*/
				url=url+"&notes="+document.getElementById('notes').value;
			xmlHttp.onreadystatechange=save_result;		
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null)
		
	}
	
	function save_result()
{
	var XMLAddress1;

	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 	
		alert(xmlHttp.responseText);		
		//document.getElementById("").innerHTML=xmlHttp.responseText;	
		//location.href ="insert_data.php";
		
		
	}
}


function change_jobs()
{
	
	if(document.getElementById('job').checked==true)
	{
		
		document.getElementById('tb_job').style.visibility='visible';
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request");
			return;
		} 		
					
		var url="save_insert_data1.php";		
		url=url+"?Command="+"changejob";	
		url=url+"&nic="+document.getElementById('nic').value;
		
		xmlHttp.onreadystatechange=prints_job;		
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null)
	}
	else
	{
		
		
	//	document.getElementById('institute').value="";
	//	document.getElementById('post').value="";
		document.getElementById('tb_job').style.visibility='hidden';
		
	}
}


function prints_job()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	
	//	alert(xmlHttp.responseText);
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("institute");				
		document.getElementById('institute').value= XMLAddress1[0].childNodes[0].nodeValue;
				
				
		XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("post");				
		document.getElementById('post').value= XMLAddress1[0].childNodes[0].nodeValue;
	}
}

function onloadfun()
{
	
	get_seat("");
	get_reason("");
}

function cleartext()
{
	
		document.getElementById('name').value="";
		document.getElementById('address').value="";
		document.getElementById('department1').value="";
		document.getElementById('refno').value="";
		document.getElementById('action').value="";
		document.getElementById('notes').value="";
		
		ClearDropDown(document.getElementById('seat'),"");
		ClearDropDown(document.getElementById('reason'),"");
		ClearDropDown(document.getElementById('department'),"");
		
		document.getElementById('0l').checked=false;
		document.getElementById('al').checked=false;
		document.getElementById('graduat').checked=false;
}

function poppup()
{
	
		url="add_new_reason.php";
		window.open(url,'Personal Details','height=50,width=510,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no');	
		
}

function add_new_reason()
{
	if(document.getElementById('txtreason').value=="")
	{		
		document.getElementById("error").innerHTML="Please Enter Reason";
	}
	else
	{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			{
				alert ("Browser does not support HTTP Request");
				return;
			} 		
							
			var url="save_reason_data.php";		
			url=url+"?Command="+"new_reason";	
			url=url+"&txtreason="+document.getElementById('txtreason').value;
				
			xmlHttp.onreadystatechange=result_reason;		
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null)
	}


}

function result_reason()
{
	var XMLAddress1;
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	//	alert(xmlHttp.responseText);
	
	//setTimeout("location.reload(true);",1000);
	window.close();
	
	
	}
}


