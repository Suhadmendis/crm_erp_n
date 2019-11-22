

new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue.js!'
  }
})
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
    document.getElementById('jcode').value = "";

//    document.getElementById('date_txt').value = "";
    document.getElementById('Quotation_Ref').value = "";
    document.getElementById('Costing_Ref').value = "";
    document.getElementById('Job_Request_Ref').value = "";
    document.getElementById('Manual_Ref').value = "";
    document.getElementById('Customer').value = "";
    document.getElementById('new_txt').checked = true;
    document.getElementById('repeat_txt').checked = false;
    document.getElementById('Marketing_Ex').value = "";
    document.getElementById('Repeat_Previous_JBN_Ref').value = "";
    document.getElementById('Product_Description').value = "";
    document.getElementById('Instructions').value = "";
    document.getElementById('Customer_PO_No').value = "";
    document.getElementById('Job_Qty').value = "";
    document.getElementById('Location').value = "";
    document.getElementById('Sales_Price').value = "";
    document.getElementById('Total_Value').value = "";
    document.getElementById('length_txt').value = "";
    document.getElementById('width_txt').value = "";
    document.getElementById('No_of_Colors').value = "";
    document.getElementById('No_of_Impressions').value = "";
    document.getElementById('msg_box').innerHTML = "";
    getdt();

}


function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "joborder_data.php";
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
      document.getElementById('jcode').value = XMLAddress1[0].childNodes[0].nodeValue;

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

var radioNew = "0";
var radioRep = "1";

    if (document.getElementById("new_txt").checked) {
        radioNew = "1";
    }

    if (document.getElementById("repeat_txt").checked) {
        radioRep = "1";
    }


//////////////////////////////////////////////////////////
    var oTable = document.getElementById("matttable");
    var rowLength = oTable.rows.length;
    var tableArray = table("matttable");
    console.log(tableArray);
//////////////////////////////////////////////////////////
    var oTable1 = document.getElementById("labtable");
    var rowLength1 = oTable.rows.length;
    var tableArray1 = table("labtable");
//////////////////////////////////////////////////////////




    var url = "joborder_data.php";
    url = url + "?Command=" + "save_item";
    url = url + "&jcode=" + document.getElementById("jcode").value;

    url = url + "&jdate=" + document.getElementById("date_txt").value;
    url = url + "&QuotationRef=" + document.getElementById("Quotation_Ref").value;
    url = url + "&CostingRef=" + document.getElementById("Costing_Ref").value;
    url = url + "&JobRequestRef=" + document.getElementById("Job_Request_Ref").value;
    url = url + "&ManualRef=" + document.getElementById("Manual_Ref").value;
    url = url + "&Customer=" + document.getElementById("Customer").value;
    url = url + "&uniq=" + document.getElementById("uniq").value;
    url = url + "&jnew=" + radioNew;
    url = url + "&jrepeat=" + radioRep;
    url = url + "&MarketingEx=" + document.getElementById("Marketing_Ex").value;
    url = url + "&RepeatPreviousJBNRef=" + document.getElementById("Repeat_Previous_JBN_Ref").value;

    var pro_des = document.getElementById("Product_Description").value;
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");
    pro_des = pro_des.replace("'", " FT");

    url = url + "&ProductDescription=" + pro_des;
    url = url + "&Instructions=" + document.getElementById("Instructions").value;
    url = url + "&CustomerPONo=" + document.getElementById("Customer_PO_No").value;
    url = url + "&JobQty=" + document.getElementById("Job_Qty").value;
    url = url + "&Location=" + document.getElementById("Location").value;
    url = url + "&SalesPrice=" + document.getElementById("Sales_Price").value;
    url = url + "&TotalValue=" + document.getElementById("Total_Value").value;
    url = url + "&jlength=" + document.getElementById("length_txt").value;
    url = url + "&jwidth=" + document.getElementById("width_txt").value;
    url = url + "&NoofColors=" + document.getElementById("No_of_Colors").value;
    url = url + "&Noofsides=" + document.getElementById("No_of_sides").value;
    url = url + "&Noofouts=" + document.getElementById("No_of_outs").value;
    url = url + "&NoofImpressions=" + document.getElementById("No_of_Impressions").value;





    url = url + "&inkCode=" + document.getElementById("inkCode").value;
    url = url + "&inkDes=" + document.getElementById("inkDes").value;
    url = url + "&Ink_Was=" + document.getElementById("Ink_Was").value;
    url = url + "&all_pro=" + document.getElementById("all_pro").value;

    url = url + "&No_of_sides=" + document.getElementById("No_of_sides").value;
    url = url + "&No_of_outs=" + document.getElementById("No_of_outs").value;

    url = url + "&tableArray=" + tableArray;
    url = url + "&rowLength=" + rowLength;
    url = url + "&tableArray1=" + tableArray1;
    url = url + "&rowLength1=" + rowLength1;

  

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

     var url = "joborder_data.php";
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
    var url = "job_order_print.php";
    url = url + "?Command=" + "save";
    url = url + "&REF_NO=" + document.getElementById('jcode').value;
    window.open(url, "_blank");
}


function delete1() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "joborder_data.php";
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
    var url = "joborder_data.php";
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

function inkCal() {

    var num1 = parseFloat(document.getElementById("Ink_Was").value) || 0;
    var num2 = parseFloat(document.getElementById("allocation_Pro").value) || 0;

    if (num1 > num2 || num1 < 0) {
        document.getElementById("Ink_Was").value = "";
    }else{
        var temp = num2 - num1;
        document.getElementById("all_pro").value = temp.toFixed(4);
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



var tableString_temp = tableString.replace("&amp;", "and");
    return tableString_temp;

}
