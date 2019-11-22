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


function print_inv(cdata) {

    var url = "gin_Print.php";
    url = url + "?tmp_no=" + document.getElementById('tmpno').value;
    url = url + "&action=" + cdata;

    window.open(url, '_blank');


}

function add_tmp() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if ((document.getElementById('tmpno').value != "")) {
        var qty = document.getElementById('qty').value;
        qty = parseFloat(qty);
//        var stkLvl = document.getElementById('stkLvl').value;
//        if ((qty > 0) && (qty < stkLvl)) {

        var url = "gin_data.php";
        url = url + "?Command=" + "setitem";
        url = url + "&Command1=" + "add_tmp";
        url = url + "&invno=" + document.getElementById('txt_entno').value;
        url = url + "&itemCode=" + document.getElementById('itemCode').value;
        url = url + "&itemDesc=" + document.getElementById('itemDesc').value;
        url = url + "&qty=" + qty;
        url = url + "&tmpno=" + document.getElementById('tmpno').value;

        xmlHttp.onreadystatechange = showarmyresultdel;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
//        } else {
//            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Insufficient Stock " + qty + " " + stkLvl + "</span></div>";
//        }


    }
}

function showarmyresultdel() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

//        alert(xmlHttp.responseText);

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
        document.getElementById('item_count').value = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('department').disabled = "true";

        document.getElementById('itemCode').value = "";
        document.getElementById('itemDesc').value = "";
        document.getElementById('qty').value = "";
        //   document.getElementById('stkLvl').value = "";

        document.getElementById('itemDesc').focus();
    }
}



function save_inv(status) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('tmpno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Not Selected</span></div>";
        return false;
    }


    var url = "gin_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&Command1=" + status;

    url = url + "&txt_entno=" + document.getElementById('txt_entno').value;
    url = url + "&txt_jobno=" + document.getElementById('txt_jobno').value;
    url = url + "&job_ref=" + document.getElementById('job_ref').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&txt_remarks=" + document.getElementById('txt_remarks').value;
    url = url + "&invdate=" + document.getElementById('invdate').value;
    url = url + "&from_dep=" + document.getElementById('department').value;
    url = url + "&to_dep=" + document.getElementById('department1').value;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
            print_inv('save');
        } else if (xmlHttp.responseText.startsWith("<div")) {
            document.getElementById('msg_box').innerHTML = xmlHttp.responseText;
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    document.getElementById('txt_entno').value = "";
    document.getElementById('txt_jobno').value = "";
    document.getElementById('svat').checked = true;
    document.getElementById('itemdetails').innerHTML = "";
    document.getElementById('msg_box').innerHTML = "";
    document.getElementById('itemCode').value = "";
    document.getElementById('itemDesc').value = "";
    document.getElementById('itemPrice').value = "";
    document.getElementById('qty').value = "";
    // document.getElementById('stkLvl').value = "";
    document.getElementById('txt_remarks').value = "";


    var url = "gin_data.php";
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

    }

}




function del_item(cdate) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "gin_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "del_item";
    url = url + "&itemCode=" + cdate;
    url = url + "&invno=" + document.getElementById('txt_entno').value;
    url = url + "&jobno=" + document.getElementById('txt_jobno').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    var vattype;
    if (document.getElementById('non').checked == true) {
        vattype = "non";
    }

    if (document.getElementById('svat').checked == true) {
        vattype = "svat";
    }
    url = url + "&vat=" + vattype;

    xmlHttp.onreadystatechange = showarmyresultdel;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}




function update_list(stname) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "gin_data.php";
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



function crnview(custno, stname)
{

    try {


        xmlHttp = GetXmlHttpObject();
        if (xmlHttp == null)
        {
            alert("Browser does not support HTTP Request");
            return;
        }
        var url = "gin_data.php";
        if (stname != "qttn") {

            url = url + "?Command=" + "pass_rec";
            url = url + "&refno=" + custno;
            url = url + "&stname=" + stname;
            xmlHttp.onreadystatechange = pass_rec_result;
        } else {

            url = url + "?Command=" + "pass_rec_qttn";
            url = url + "&refno=" + custno;
            url = url + "&stname=" + stname;
            xmlHttp.onreadystatechange = pass_rec_result_qttn;
        }

        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    } catch (err) {
        alert(err.message);
    }
}

function pass_rec_result_qttn()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmp_no");
        opener.document.form1.tmpno.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
        opener.document.form1.txt_entno.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
        opener.document.form1.item_count.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_DATE");
        opener.document.form1.invdate.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_remarks");
        opener.document.form1.txt_remarks.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department1")
        opener.document.getElementById("department").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department1");
        opener.document.getElementById("department1").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        window.opener.document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("msg");
        if (XMLAddress1[0].childNodes[0].nodeValue != "") {
            window.opener.document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + XMLAddress1[0].childNodes[0].nodeValue + "</span></div>";
        }
        self.close();
    }
}

function pass_rec_result()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
       // alert(xmlHttp.responseText);
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("stname");
        var stname = XMLAddress1[0].childNodes[0].nodeValue;

        if ((stname == "") || (stname == "mrn") || (stname == "mrnx") || (stname == "ming") || (stname == "ming_dsr") || (stname == "ming_req") || (stname == "isa") || (stname == "ginu") || (stname == "mrni") || (stname == "mrng") || (stname == "dp") || (stname == "fg")) {

            if ((stname != "ming_req")) {

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tmp_no");
                opener.document.form1.tmpno.value = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
                opener.document.form1.txt_entno.value = XMLAddress1[0].childNodes[0].nodeValue;

//                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
//                opener.document.form1.item_count.value = XMLAddress1[0].childNodes[0].nodeValue;

            } else {
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
                opener.document.form1.item_count_org.value = XMLAddress1[0].childNodes[0].nodeValue;
            }

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_JOBNO");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_DATE");
            opener.document.form1.invdate.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_remarks");
            opener.document.form1.txt_remarks.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department1")
            opener.document.getElementById("department").value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("department1");
            opener.document.getElementById("department1").value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
            window.opener.document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

            if (stname == "dp") {
                // console.log(xmlHttp.responseXML);
                
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("customer_name");      
                opener.document.getElementById("customer_name").value = XMLAddress1[0].childNodes[0].nodeValue;
                
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("customer_address");      
                opener.document.getElementById("customer_address").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("customer_po");      
                opener.document.getElementById("customer_po").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("manuel_aod");      
                opener.document.getElementById("manuel_aod").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("supplier_vendor_no");      
                opener.document.getElementById("supplier_vendor_no").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("vehicle");      
                opener.document.getElementById("vehicle").value = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("vehicleno");      
                opener.document.getElementById("vehicle_no").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("contact_person");      
                opener.document.getElementById("contact_person").value = XMLAddress1[0].childNodes[0].nodeValue;
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("job_num");      
                opener.document.getElementById("job_no").value = XMLAddress1[0].childNodes[0].nodeValue;
               


            }

            if ((stname == "mrnx")) {
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mat");
                window.opener.document.getElementById("mat").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("productname");
                opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;
            }
            if ((stname == "mrni")) {


                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("productname");
                opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;
            }
             if ((stname == "mrng")) {


                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("issue");
                opener.document.form1.issue.value = XMLAddress1[0].childNodes[0].nodeValue;


                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("MAN_REF");
                opener.document.form1.manuel_ref.value = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("PER_DES");
                opener.document.form1.Product.value = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("alocated");
                opener.document.form1.already_issued.value = XMLAddress1[0].childNodes[0].nodeValue;
                var allocate = XMLAddress1[0].childNodes[0].nodeValue;

                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Totalocated");
                opener.document.form1.total_allocated.value = XMLAddress1[0].childNodes[0].nodeValue;
                var tot_allocate = XMLAddress1[0].childNodes[0].nodeValue;

                var temp132 = tot_allocate - allocate;
                opener.document.form1.to_be_issued.value =  temp132.toFixed(4);


            }
            if ((stname == "fg")) {
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("jobQty");
                opener.document.form1.txt_jobQty.value = XMLAddress1[0].childNodes[0].nodeValue;
                var totqty = XMLAddress1[0].childNodes[0].nodeValue;

                 XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("txt_trfd");
                 var tr_qty = XMLAddress1[0].childNodes[0].nodeValue;
                opener.document.form1.txt_trfd.value = XMLAddress1[0].childNodes[0].nodeValue;

                // opener.document.form1.txt_trfd.value = "";
                opener.document.form1.txt_balTrfd.value = totqty-tr_qty;
            }
            if ((stname == "ming")) {
               
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("TYPE1");
                if (XMLAddress1[0].childNodes[0].nodeValue == "normal") {
                    opener.document.form1.svat.checked = true;
                } else {
                    opener.document.form1.non.checked = true;
                }
            }

        } else if ((stname == "pick_fg")) {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_JOBNO");
            opener.document.form1.job_no.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_NAME");
            opener.document.form1.customer_name.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_Address");
            opener.document.form1.customer_address.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_PO");
            opener.document.form1.customer_po.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("J_QTY");
            opener.document.form1.txt_FGQty.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("Dispatched");
            opener.document.form1.txt_trfd.value = XMLAddress1[0].childNodes[0].nodeValue;
            
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("BAL_TRA");
            opener.document.form1.txt_balTrfd.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
            opener.document.form1.item_count.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("STK_NO");
            opener.document.form1.itemCode.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("DESCRIPt");
            opener.document.form1.itemDesc.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("QTY");
            opener.document.form1.FGQty.value = XMLAddress1[0].childNodes[0].nodeValue;
            var totqty = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("TRF");
            opener.document.form1.trfd.value = XMLAddress1[0].childNodes[0].nodeValue;
            var trfqty = XMLAddress1[0].childNodes[0].nodeValue;
            
            opener.document.form1.balTrfd.value = totqty - trfqty;

           

        } else if ((stname == "job") || (stname == "jobi") || (stname == "jobg")) {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
            window.opener.document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

//            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
//            opener.document.form1.item_count.value = XMLAddress1[0].childNodes[0].nodeValue;


            if (stname == "job") {
                XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_JOBNO");
                opener.document.form1.job_ref.value = XMLAddress1[0].childNodes[0].nodeValue;

            }
        } else if ((stname == "pick_dp")) {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
            opener.document.form1.txt_minno.value = XMLAddress1[0].childNodes[0].nodeValue;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_no");
            opener.document.form1.itemCode.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("descript");
            opener.document.form1.itemDesc.value = XMLAddress1[0].childNodes[0].nodeValue;

            // XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_CODE");
            // opener.document.form1.c_code.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("CUS_NAME");
            opener.document.form1.c_name.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_ADD1");
            opener.document.form1.cus_address.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("QTY");
            opener.document.form1.qty.value = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("NAV");
            opener.document.getElementById("nav").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rate");
            opener.document.form1.itemPrice.value = XMLAddress1[0].childNodes[0].nodeValue;


            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("COSTING_REF");
            

            var obj = JSON.parse(XMLAddress1[0].childNodes[0].nodeValue);
         // console.log(obj.CostingRef);

            opener.document.form1.txt_costing.value = obj.CostingRef;

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("FG_REF");
            opener.document.form1.txt_fg.value = XMLAddress1[0].childNodes[0].nodeValue;
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("JOB_REF");
            opener.document.form1.txt_job.value = XMLAddress1[0].childNodes[0].nodeValue;

            
            

        } else if (stname == "pick_is") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("C_REFNO");
            opener.document.form1.txt_jobno.value = XMLAddress1[0].childNodes[0].nodeValue;

        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("msg");
        if (XMLAddress1[0].childNodes[0].nodeValue != "") {
            window.opener.document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + XMLAddress1[0].childNodes[0].nodeValue + "</span></div>";
        }
        self.close();    
    }
}


function pass_arn_result()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        alert(xmlHttp.responseText);

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("REFNO");
        opener.document.form1.orderno1.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("SUP_CODE");
        opener.document.form1.c_code.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("SUP_NAME");
        opener.document.form1.c_name.value = XMLAddress1[0].childNodes[0].nodeValue;

        //wait_2
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("count");
        opener.document.form1.arn_item_count.value = XMLAddress1[0].childNodes[0].nodeValue;

//        alert("count value "+opener.document.form1.count.value);

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        window.opener.document.getElementById('invdt').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        self.close();
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
    if (document.getElementById('txt_entno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Select Entry</span></div>";
        return false;
    }

    var url = "gin_data.php";
    url = url + "?Command=" + "del_inv";
    url = url + "&crnno=" + document.getElementById('txt_entno').value;
    url = url + "&tmpno=" + document.getElementById('tmpno').value;
    url = url + "&department=" + document.getElementById('department').value;
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

function setDepartment(arg) {
    document.getElementById(arg).disabled = "true";
}