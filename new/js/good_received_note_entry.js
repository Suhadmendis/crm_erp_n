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
//     alert("1");
    document.getElementById('uniq').value = "";
    document.getElementById('reference_no').value = "";
    document.getElementById('date').value = "";
    document.getElementById('purchase_order_no').value = "";
    //document.getElementById('transport').value = "";
    document.getElementById('manual_no').value = "";
    document.getElementById('currency_code').value = "";
    document.getElementById('exchange_rate').value = "";
    document.getElementById('supplier_code').value = "";
    document.getElementById('location_code').value = "";
    document.getElementById('cost_centre').value = "";
    document.getElementById('remarks').value = "";
    document.getElementById('tax_combination').value = "";
    document.getElementById('local').checked = true;
    //document.getElementById('msg_box').innerHTML = "";
    getdt();
}


function getdt() {
 //alert("2");
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";
    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function assign_dt() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("reference_no");
        document.getElementById('reference_no').value = XMLAddress1[0].childNodes[0].nodeValue;
//
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById('uniq').value = XMLAddress1[0].childNodes[0].nodeValue;
        
      // alert("abc");
        document.getElementById('itemdetails').innerHTML = "<div id='getTable'>                            <table id='myTable' class='table table-bordered'>                                <thead>                                 <tr>                                        <th style='width:  5%;'>Rec No</th>                                        <th style='width: 10%;'>Product Code</th>                                        <th style='width: 10%;'>Product Description</th>                                        <th style='width: 10%;'>Quantity</th>                                        <th style='width: 10%;'>Purchase Price</th>                                        <th style='width: 10%;'>Local Price</th>                                        <th style='width: 10%;'>Discount</th>                                        <th style='width: 10%;'>import Exp</th>                                        <th style='width: 10%;'>Value</th>                                        <th style='width: 10%;'>Tax Combination</th>                                        <th style='width:  5%;'>Delete</th>                                    </tr>                                </thead>                                <tbody>                                    <tr>                                        <td>                                            <input type='text' placeholder='Rec No' id='rec_no' class='form-control input-sm'>                                        </td>                                        <td>                                            <input type='text' placeholder='Product Code'  id='product_code' class='form-control input-sm'>                                        </td>                                        <td>                                            <input  type='text' placeholder='Product Description'  id='product_description' class='form-control input-sm'>                                        </td>                                        <td>                                            <input  type='text' placeholder='Quantity'  id='quantity' class='form-control input-sm'>                                        </td>                                        <td>                                            <input  type='text' placeholder='Purchase Price'  id='purchase_price' class='form-control input-sm'>                                        </td>                                         <td>                                            <input type='text' placeholder='Local Price'  id='local_price' class='form-control input-sm'>                                        </td>                                         <td>                                            <input type='text' placeholder='Discount'  id='discount' class='form-control input-sm'>                                        </td>                                         <td>                                            <input type='text' placeholder='Import EXP'  id='import_exp' class='form-control input-sm'>                                        </td>                                        <td>                                            <input type='text' placeholder='value'  id='grn_value' class='form-control input-sm'>                                        </td>                                        <td>                                            <input type='text' placeholder='Tax Combination'  id='tax_combination_txt' class='form-control input-sm'>                                        </td>                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>                                    </tr>                                </tbody>                            </table>                        </div>";           }
//        document.getElementById('itemdetails').innerHTML = "";
    
}

function save_inv()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
//
//    if (document.getElementById('reference_no').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference NO  Not Entered</span></div>";
//        return false;
//    }
//    if (document.getElementById('date').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('purchase_order_no').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>purchase order No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('manual_no').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Manual No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('currency_code').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>currency code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('exchange_rate').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>exchange rate Not Selected</span></div>";
//        return false;
//    }
//    if (document.getElementById('supplier_code').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>supplier code Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('location_code').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>location code  Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('cost_centre').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>cost centre Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('remarks').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>remarks Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('tax_combination').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tax combination Not Enterd</span></div>";
//        return false;
//    }
    var shipping_method = "";

    if (document.getElementById("local").checked) {
        shipping_method = "LOCAL";
    } else {
        if (document.getElementById("sea").checked) {
            shipping_method = "SEA";
        } else {
            if (document.getElementById("air").checked) {
                shipping_method = "AIR";
            } else {
            }
        }
    }
    //alert(shipping_method);


    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&date=" + document.getElementById('date').value;
    url = url + "&purchase_order_no=" + document.getElementById('purchase_order_no').value;
    url = url + "&shipping_method=" + shipping_method;
    //url = url + "&transport=" + document.getElementById('transport').value;
    url = url + "&manual_no=" + document.getElementById('manual_no').value;
    url = url + "&currency_code=" + document.getElementById('currency_code').value;
    url = url + "&exchange_rate=" + document.getElementById('exchange_rate').value;
    url = url + "&supplier_code=" + document.getElementById('supplier_code').value;
    url = url + "&location_code=" + document.getElementById('location_code').value;
    url = url + "&cost_centre=" + document.getElementById('cost_centre').value;
    url = url + "&remarks=" + document.getElementById('remarks').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function salessaveresult() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function edit() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('reference_no').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reference NO  Not Entered</span></div>";
        return false;
    }

    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "update";
    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&date=" + document.getElementById('date').value;
    url = url + "&purchase_order_no=" + document.getElementById('purchase_order_no').value;
    //url = url + "&transport=" + document.getElementById('transport').value;
    url = url + "&manual_no=" + document.getElementById('manual_no').value;
    url = url + "&currency_code=" + document.getElementById('currency_code').value;
    url = url + "&exchange_rate=" + document.getElementById('exchange_rate').value;
    url = url + "&supplier_code=" + document.getElementById('supplier_code').value;
    url = url + "&location_code=" + document.getElementById('location_code').value;
    url = url + "&cost_centre=" + document.getElementById('cost_centre').value;
    url = url + "&remarks=" + document.getElementById('remarks').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination').value;
    xmlHttp.onreadystatechange = update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function update() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "update") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Updated</span></div>";
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function delete1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('reference_no').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Reference No  Not Entered</span></div>";
        return false;
    }

    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "delete";
    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function delete2() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "delete") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function add_tmp() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";


    url = url + "&reference_no=" + document.getElementById('reference_no').value;
    url = url + "&rec_no=" + document.getElementById('rec_no').value;
    url = url + "&product_code=" + document.getElementById('product_code').value;
    url = url + "&product_description=" + document.getElementById('product_description').value;
    url = url + "&quantity=" + document.getElementById('quantity').value;
    url = url + "&purchase_price=" + document.getElementById('purchase_price').value;
    url = url + "&local_price=" + document.getElementById('local_price').value;
    url = url + "&discount=" + document.getElementById('discount').value;
    url = url + "&import_exp=" + document.getElementById('import_exp').value;
    url = url + "&grn_value=" + document.getElementById('grn_value').value;
    url = url + "&tax_combination=" + document.getElementById('tax_combination_txt').value;
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


//        document.getElementById('Item_No').value = "";
//        document.getElementById('Sample_Description').value = "";
//        document.getElementById('Sample_Qty').value = "";



    }
}

function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "good_received_note_entry_data.php";
    url = url + "?Command=" + "removerow";

     url = url + "&uniq=" + document.getElementById('uniq').value;
//    url = url + "&sjrequestref=" + document.getElementById('sjrequestref_txt').value;
    url = url + "&id=" + id;
   // url = url + "&uniq=" + document.getElementById('uniq').value;


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









