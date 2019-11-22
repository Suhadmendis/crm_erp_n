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

function newent() {

    getdt();
}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_joborder_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function assign_dt() {
    document.getElementById('itemdetails').innerHTML = xmlHttp.responseText;
}



function custno(code, stname)
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "search_joborder_data.php";
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

        if (stname === "code") {
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('jcode').value = XMLAddress1[0].childNodes[0].nodeValue;

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
//         opener.document.form1.job_order_ref.value = XMLAddress1[0].childNodes[0].nodeValue;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.form1.date_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.form1.Quotation_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.form1.Costing_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername40");
            opener.document.form1.proCodeText.value = XMLAddress1[0].childNodes[0].nodeValue;
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername400");
            opener.document.form1.proNameText.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.form1.Job_Request_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername6");
            opener.document.form1.Manual_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
            opener.document.form1.Customer.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername77");
            opener.document.form1.cusTextName.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername8");
            opener.document.form1.new_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername9");
            opener.document.form1.repeat_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername10");
            opener.document.form1.Marketing_Ex.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername110");
            opener.document.form1.Marketing_name.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername11");
            opener.document.form1.Repeat_Previous_JBN_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername12");
            opener.document.form1.Product_Description.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername13");
            opener.document.form1.Instructions.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername14");
            opener.document.form1.Customer_PO_No.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername15");
            opener.document.form1.Job_Qty.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername16");
            opener.document.form1.Location.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername17");
            opener.document.form1.Sales_Price.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername18");
            opener.document.form1.Total_Value.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername19");
            opener.document.form1.length_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername20");
            opener.document.form1.width_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername21");
            opener.document.form1.No_of_Colors.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername22");
            opener.document.form1.No_of_Impressions.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername150");
            opener.document.form1.inkCode.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername151");
            opener.document.form1.inkDes.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername152");
            opener.document.form1.Ink_Was.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername153");
            opener.document.form1.all_pro.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername154");
            opener.document.form1.No_of_sides.value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername155");
            opener.document.form1.No_of_outs.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobtable");
            // window.opener.document.getElementById("beTable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mattable");
            window.opener.document.getElementById("mattable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "code_repeat") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
         //   alert(XMLAddress1[0].childNodes[0].nodeValue);
            opener.document.getElementById('Repeat_Previous_JBN_Ref').value = XMLAddress1[0].childNodes[0].nodeValue;

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
//        opener.document.form1.job_order_ref.value = XMLAddress1[0].childNodes[0].nodeValue;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername2");
            opener.document.form1.date_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername3");
            opener.document.form1.Quotation_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.form1.Costing_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername5");
            opener.document.form1.Job_Request_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername6");
            opener.document.form1.Manual_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
            opener.document.form1.Customer.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername8");
            opener.document.form1.new_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername9");
            opener.document.form1.repeat_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername10");
            opener.document.form1.Marketing_Ex.value = XMLAddress1[0].childNodes[0].nodeValue;

//            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername11");
//            opener.document.form1.Repeat_Previous_JBN_Ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername12");
            opener.document.form1.Product_Description.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername13");
            opener.document.form1.Instructions.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername14");
            opener.document.form1.Customer_PO_No.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername15");
            opener.document.form1.Job_Qty.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername16");
            opener.document.form1.Location.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername17");
            opener.document.form1.Sales_Price.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername18");
            opener.document.form1.Total_Value.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername19");
            opener.document.form1.length_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername20");
            opener.document.form1.width_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername21");
            opener.document.form1.No_of_Colors.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername22");
            opener.document.form1.No_of_Impressions.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mattable");
            window.opener.document.getElementById("mattable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        } else if (stname === "DEL_note") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
            opener.document.getElementById('jobno_txt').value = XMLAddress1[0].childNodes[0].nodeValue;

             XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername14");
            opener.document.form1.pono_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

              XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername4");
            opener.document.form1.costingref_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername7");
            opener.document.form1.cus_txt.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername023");
            opener.document.form1.addr_txt.value = XMLAddress1[0].childNodes[0].nodeValue;


        }else if (stname === "pickJOB") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("productname");
            opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mat");
            window.opener.document.getElementById("mat").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "mrn_ink") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

           

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("productname");
            opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername153");
            opener.document.form1.total_allocated.value = XMLAddress1[0].childNodes[0].nodeValue;
            
            var tot = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("alocated");
            opener.document.form1.already_issued.value = XMLAddress1[0].childNodes[0].nodeValue;
            var alocated = XMLAddress1[0].childNodes[0].nodeValue;
             
            opener.document.form1.to_be_issued.value = tot - alocated;


        } else if (stname === "mrn_ex") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("productname");
            opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mat");
            window.opener.document.getElementById("mat").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        } else if (stname === "dis_note") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("str_customername1");
            opener.document.form1.job_no.value = XMLAddress1[0].childNodes[0].nodeValue;

     

        }



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


    var url = "search_joborder_data.php";
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
