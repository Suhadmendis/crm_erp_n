

new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue.js!',
    H1: 'Style',
    H2: 'Size',
    H3: 'Qty',
    H4: 'Remark',
    H5: 'Box / Packet No',
    H6: 'Hello Vue.js!'
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

function newent() {
    document.getElementById('refno').value = "";
    document.getElementById('uniq').value = "";
    document.getElementById('cus_txt').value = "";
    document.getElementById('date_txt').value = "";
    document.getElementById('addr_txt').value = "";
    document.getElementById('costingref_txt').value = "";
    document.getElementById('jobno_txt').value = "";
    document.getElementById('pono_txt').value = "";
    document.getElementById('msg_box').innerHTML = "";
    getdt();

}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "deliverynote_data.php";
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

      XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
      document.getElementById('refno').value = XMLAddress1[0].childNodes[0].nodeValue;

      XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
      document.getElementById('uniq').value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}




$('#save_inv_top').click( function() {
  var oTable = document.getElementById("matttable");


  var rowLength = oTable.rows.length;


  var tableArray = table("matttable");
  console.log(tableArray);


});

function save_inv()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
     if (document.getElementById('refno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Factry Name  Not Entered</span></div>";
        return false;
    }
var Jtable = "";

  
      var table = $('#myTable').tableToJSON();
      
       Jtable = JSON.stringify(table);  
  

 
    var url = "deliverynote_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&refno=" + document.getElementById("refno").value;
    url = url + "&cus_txt=" + document.getElementById("cus_txt").value;
    url = url + "&addr_txt=" + document.getElementById("addr_txt").value;
    url = url + "&costingref_txt=" + document.getElementById("costingref_txt").value;
    url = url + "&jobno_txt=" + document.getElementById("jobno_txt").value;
    url = url + "&pono_txt=" + document.getElementById("pono_txt").value;
    url = url + "&date=" + document.getElementById("date_txt").value;
    url = url + "&dis_ref=" + document.getElementById("dis_ref").value;
    url = url + "&H1=" + document.getElementById("H1").value;
    url = url + "&H2=" + document.getElementById("H2").value;
    url = url + "&H3=" + document.getElementById("H3").value;
    url = url + "&H4=" + document.getElementById("H4").value;
    url = url + "&H5=" + document.getElementById("H5").value;

    url = url + "&Jtable=" + Jtable;
 

  
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

    if (document.getElementById('jcode').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>RegNo Not Entered</span></div>";
        return false;
    }

     if (document.getElementById('Location').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Location Not Entered</span></div>";
        return false;
    }


     if (document.getElementById('Costing_Ref').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Costing Ref Not Entered</span></div>";
        return false;
    }
     if (document.getElementById('Job_Request_Ref').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Job Request Ref Not Entered</span></div>";
        return false;
    }
     if (document.getElementById('Customer').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Customer Not Entered</span></div>";
        return false;
    }
     if (document.getElementById('Marketing_Ex').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Marketing Ex Not Entered</span></div>";
        return false;
    }
     if (document.getElementById('Job_Qty').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Job Qty Not Entered</span></div>";
        return false;
    }
     if (document.getElementById('Sales_Price').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Sales Price Not Entered</span></div>";
        return false;
    }

     if (document.getElementById('Total_Value').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Total Value Not Entered</span></div>";
        return false;
    }

     var url = "deliverynote_data.php";
    url = url + "?Command=" + "update";

    url = url + "&jcode=" + document.getElementById("jcode").value;
    url = url + "&joborderref=" + document.getElementById("job_order_ref").value;
    url = url + "&jdate=" + document.getElementById("date_txt").value;
    url = url + "&QuotationRef=" + document.getElementById("Quotation_Ref").value;
    url = url + "&CostingRef=" + document.getElementById("Costing_Ref").value;
    url = url + "&JobRequestRef=" + document.getElementById("Job_Request_Ref").value;
    url = url + "&ManualRef=" + document.getElementById("Manual_Ref").value;
    url = url + "&Customer=" + document.getElementById("Customer").value;
    url = url + "&jnew=" + document.getElementById("new_txt").value;
    url = url + "&jrepeat=" + document.getElementById("repeat_txt").value;
    url = url + "&MarketingEx=" + document.getElementById("Marketing_Ex").value;
    url = url + "&RepeatPreviousJBNRef=" + document.getElementById("Repeat_Previous_JBN_Ref").value;
    url = url + "&ProductDescription=" + document.getElementById("Product_Description").value;
    url = url + "&Instructions=" + document.getElementById("Instructions").value;
    url = url + "&CustomerPONo=" + document.getElementById("Customer_PO_No").value;
    url = url + "&JobQty=" + document.getElementById("Job_Qty").value;
    url = url + "&Location=" + document.getElementById("Location").value;
    url = url + "&SalesPrice=" + document.getElementById("Sales_Price").value;
    url = url + "&TotalValue=" + document.getElementById("Total_Value").value;
    url = url + "&jlength=" + document.getElementById("length_txt").value;
    url = url + "&jwidth=" + document.getElementById("width_txt").value;
    url = url + "&NoofColors=" + document.getElementById("No_of_Colors").value;
    url = url + "&NoofImpressions=" + document.getElementById("No_of_Impressions").value;
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


function cancel() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('RecNo').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Please select an added record</span></div>";
        return false;
    }

    var url = "studentregistration_data.php";
    url = url + "?Command=" + "cancel";


    url = url + "&RecNo=" + document.getElementById('RecNo').value;

    xmlHttp.onreadystatechange = cancel2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function cancel2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "canceled") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Canceled</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function print() {
    var url = "delivery_note_print.php";
    url = url + "?refno=" + document.getElementById('refno').value;
    window.open(url, "_blank");

}


function delete1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "deliverynote_data.php";
    url = url + "?Command=" + "delete";


    url = url + "&jcode=" + document.getElementById('jcode').value;

    xmlHttp.onreadystatechange = delete2;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function delete2() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "delete") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function close_form()
{
    self.close();
}



function slider(side){

    if (side==="for") {
        alert("1");
    }else{
        alert("2");
    }

}


function upload(cdata) {

    var files = $('#file-3')[0].files; //where files would be the id of your multi file input
//or use document.getElementById('files').files;
//alert(files.length);
    for (var i = 0, f; f = files[i]; i++) {
        var name = document.getElementById('file-3');
        var alpha = name.files[i];
        console.log(alpha.name);
        var data = new FormData();

        var refno =  document.getElementById('jcode').value;
        alert(refno);
        data.append('file', alpha);
        data.append('type', cdata);
        data.append('refno', refno);
        $.ajax({
            url: 'upfile.php',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (msg) {
                alert(msg);

            }
        });
    }
}



function add_tmp() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "deliverynote_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

    url = url + "&jcode=" + document.getElementById("jcode").value;
    url = url + "&style=" + document.getElementById('style').value;
    url = url + "&size=" + document.getElementById('size').value;
    url = url + "&qty=" + document.getElementById('qty').value;
    url = url + "&remark=" + document.getElementById('remark').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('beTable').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


    }
}

function myfun(x) {

    var vari = "tot" + x.rowIndex;

    var num1 = parseFloat(document.getElementById("wqty" + x.rowIndex).innerHTML) || 0;
    var num2 = parseFloat(document.getElementById("temp" + x.rowIndex).innerHTML) || 0;

    var num3 = parseFloat(document.getElementById("wow" + x.rowIndex).innerHTML) || 0;
    var tot = num3 + num1;
    if (num1 <= num2) {

        document.getElementById(vari).innerHTML = tot.toFixed(2);
    } else {
alert("Maximum Wastage Qty " + num2.toFixed(2));
        document.getElementById("wqty" + x.rowIndex).innerHTML = 0;
    }


}

function myfun2(x) {

    var vari = "num3" + x.rowIndex;

    var num1 = parseFloat(document.getElementById("num1" + x.rowIndex).innerHTML) || 0;
    var num2 = parseFloat(document.getElementById("num2" + x.rowIndex).innerHTML) || 0;

    var num3 = parseFloat(document.getElementById("num3" + x.rowIndex).innerHTML) || 0;
    var tot = num1 - num2;
    if (num1 >= num2) {

        document.getElementById(vari).innerHTML = tot.toFixed(2);
    } else {
alert("Adjustment " + num1.toFixed(2));
        document.getElementById("num2" + x.rowIndex).innerHTML = "";
    }


}


function table(tableId) {


    var oTable = document.getElementById(tableId);


    var rowLength = oTable.rows.length;
    var myarray = new Array(rowLength);
    var tableString = "";

    for (i = 0; i < rowLength; i++) {


        var oCells = oTable.rows.item(i).cells;

        var cellLength = oCells.length;
        myarray[i] = new Array(cellLength);

        for (var j = 0; j < cellLength; j++) {
            myarray[i][j] = oCells[j].innerHTML;
            tableString = tableString + oCells[j].innerHTML + "R%T";
        }
    }
//2D array
//    return myarray;
    return tableString;

}


function addRow() {
   
  var table = document.getElementById("myTable");

  var row = table.insertRow(table.length);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  

  cell1.innerHTML = "";
  cell2.innerHTML = "";
  cell3.innerHTML = "";
  cell4.innerHTML = "";
  cell5.innerHTML = "";
  cell6.innerHTML = '<input type="button" value="-" onclick="deleteRow(this)">';

   qtyTot();
}

function deleteRow(r) {
    
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("myTable").deleteRow(i);

qtyTot();
}


function qtyTot() {

    var table = $('#myTable').tableToJSON();
    console.log(table);
    var  qtyTot = 0.00;
    var tempqty = 0.00;
    for (var i = table.length - 1; i >= 0; i--) {
          
          tempqty = parseFloat(table[i].Qty) || 0;
        qtyTot = tempqty + qtyTot;
    }

        document.getElementById("totQty").value = qtyTot;

}