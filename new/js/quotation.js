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



function validation(id) {

    if (id === "ncp") {
        var input = document.getElementById(id).value;
        var str = input;
        var re = /^[a-zA-Z ]{0,30}$/;
        var patt = new RegExp(re);
        var res = patt.test(str);

        if (res) {

        } else {
            document.getElementById(id).value = input.substring(0, str.length - 1);
        }


    } else if (id === "tel") {
        var input = document.getElementById(id).value;
        var str = input;
        var re = /^\d+$/;
        var patt = new RegExp(re);
        var res = patt.test(str);

        if (res) {

        } else {
            document.getElementById(id).value = input.substring(0, str.length - 1);
        }
    } else if (id === "Name_of_Driver") {
        var input = document.getElementById(id).value;
        var str = input;
        var re = /^[a-zA-Z ]{0,30}$/;
        var patt = new RegExp(re);
        var res = patt.test(str);

        if (res) {

        } else {
            document.getElementById(id).value = input.substring(0, str.length - 1);
        }
    } else if (id === "QTY") {
        var input = document.getElementById(id).value;
        var str = input;
        var re = /^\d+$/;
        var patt = new RegExp(re);
        var res = patt.test(str);

        if (res) {

        } else {
            document.getElementById(id).value = input.substring(0, str.length - 1);
        }
    }


}



function filter() {
    var input = document.getElementById("inputText").value;

    var status = "";



    var str = input;
    var re = /^[a-zA-Z ]{0,30}$/;
    var patt = new RegExp(re);
    var res = patt.test(str);


    if (res) {
        status = "ok";
    } else {
        document.getElementById("inputText").value = input.substring(0, str.length - 1);
    }

    if (status === "ok") {
        // inputSearch(input);
    }

}

function csChange() {

    if (document.getElementById("customer").checked) {
        var id = document.getElementById('aodnumber').value;
        var split = id.split("/");
        var mid = split[0] + "/CUS/" + split[2];
        document.getElementById('aodnumber').value = mid;
    } else {
        var id = document.getElementById('aodnumber').value;
        var split = id.split("/");
        var mid = split[0] + "/SUP/" + split[2];
        document.getElementById('aodnumber').value = mid;
    }

}

function inputSearch(input) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }




    if (input === "") {

    } else {
        var cus_or_sup = "";


        if (document.getElementById("customer").checked) {
            cus_or_sup = "C";

        } else {
            cus_or_sup = "S";
        }

        input = input + "%";

        var url = "Manuel_AOD_data.php";
        url = url + "?Command=" + "getVendor";
        url = url + "&cus_or_sup=" + cus_or_sup;
        url = url + "&input=" + input;


        xmlHttp.onreadystatechange = assign_dt;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);


        // check();

    }

}


function check() {

    var url = "Manuel_AOD_print.php";

    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "checkvendor";
    url = url + "?inputText=" + document.getElementById('inputText').value;

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function assign_dt() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("contentlist");
        document.getElementById('contentlist').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("d1");
        document.getElementById('Address').value = XMLAddress1[0].childNodes[0].nodeValue;


    }

}

function pageNew() {
    location.reload();
}



function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }



    document.getElementById("Quotation_NO").value = "";
    document.getElementById("manual_ref").value = "";
    document.getElementById("ATTN").value = "";
    document.getElementById("CC").value = "";
    document.getElementById("TO").value = "";
    document.getElementById("FROM").value = "Tania Francis";
    var d = new Date();
//    document.getElementById("DATE").value = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
    document.getElementById("SUBJECT").value = "";
    document.getElementById("All_payment").value = "CRIMSON CS (PVT) LTD.";
    document.getElementById("Validity_of_quotation").value = "30 days";
    document.getElementById("Payment").value = "To be discussed and mutually agreed";
    document.getElementById("Delivery").value = "To be discussed and mutually agreed";
    document.getElementById("Remark").value = "Above prices are subject to taxes NBT (2%) + VAT (15%)";
    document.getElementById("Text_0").value = "Reference to the above, we are pleased to submit our quotation for your kind consideration.";
    document.getElementById("Text_1").value = "I trust the above is in order and should you require any further information or clarification please do not hesitate to contact the undersigned.";
    document.getElementById("Text_2").value = "While thanking you for the opportunity extended we look forward to a favourable response";
    document.getElementById("SVAT").checked = true;
    document.getElementById("update").value = "0";

//    document.getElementById("version").hidden = true;
    document.getElementById("ver_con").hidden = true;
$('#savebtn').fadeIn(500);
//    var doc = new jsPDF();
    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "quotation_data.php";
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

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id2");

        var code = XMLAddress1[0].childNodes[0].nodeValue;
        document.getElementById('Quotation_NO').value = code;

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

    var version = 0;
    if (document.getElementById('version').checked) {
        version = 1;
    }


    var svat = 0;
    var vat = 0;
    var nbt = 0;


    if (document.getElementById("SVAT").checked) {
        svat = 1;
    }

    if (document.getElementById("VAT").checked) {
        vat = 1;
    }

    if (document.getElementById("NBT").checked) {
        nbt = 1;
    }




    var url = "quotation_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&Quotation_NO=" + document.getElementById('Quotation_NO').value;
    url = url + "&manual_ref=" + document.getElementById('manual_ref').value;
    url = url + "&ATTN=" + document.getElementById('ATTN').value;
    url = url + "&CC=" + document.getElementById('CC').value;
    url = url + "&TO=" + document.getElementById('TO').value;
    url = url + "&FROM=" + document.getElementById('FROM').value;
    url = url + "&DATE=" + document.getElementById('DATE').value;
    url = url + "&SUBJECT=" + document.getElementById('SUBJECT').value;
    url = url + "&All_payment=" + document.getElementById('All_payment').value;
    url = url + "&Validity_of_quotation=" + document.getElementById('Validity_of_quotation').value;
    url = url + "&Payment=" + document.getElementById('Payment').value;
    url = url + "&Delivery=" + document.getElementById('Delivery').value;
    url = url + "&Remark=" + document.getElementById('Remark').value;
    url = url + "&Text_0=" + document.getElementById('Text_0').value;
    url = url + "&Text_1=" + document.getElementById('Text_1').value;
    url = url + "&Text_2=" + document.getElementById('Text_2').value;

    url = url + "&svat=" + document.getElementById('SVAT').value;
    url = url + "&vat=" + document.getElementById('VAT').value;
    url = url + "&nbt=" + document.getElementById('NBT').value;

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&update=" + document.getElementById('update').value;
    url = url + "&version=" + version;


    xmlHttp.onreadystatechange = saveQ;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function saveQ() {
    var XMLAddress1;
    if (xmlHttp.readyState === 4 || xmlHttp.readyState === "complete") {

        if (xmlHttp.responseText == "Saved") {
           
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
            document.getElementById('savebtn').disabled;


     $('#savebtn').fadeOut(500);



            //document.getElementById('filup').style.visibility = "visible";
            $("#msg_box").hide().slideDown(200).delay(1500);
            $("#msg_box").slideUp(200);
//
//          
//
//            setTimeout(function () {
//
//                pageNew();
//
//            }, 2000);



        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
            
         
        }
    }
}









function print(format) {

    var botpanel = 0;
    var remarkpanel = 0;
    var VNpanel = 0;

    if (document.getElementById("botpanel").checked) {
        botpanel = 1;
    }
    if (document.getElementById("remarkpanel").checked) {
        remarkpanel = 1;
    }
    if (document.getElementById("VNpanel").checked) {
        VNpanel = 1;
    }



    var url = "quotation_print.php";

//    if (format === "p1") {
//        
//    } else if (format === "p2") {
//        url = "quotation_print_1.php";
//    } else if (format === "p3") {
//        url = "quotation_print_2.php";
//    } else if (format === "p4") {
//        url = "quotation_print_3.php";
//    }





    url = url + "?Quotation_NO=" + document.getElementById('Quotation_NO').value;
    url = url + "&botpanel=" + botpanel;
    url = url + "&remarkpanel=" + remarkpanel;
    url = url + "&VNpanel=" + VNpanel;
    url = url + "&format=" + format;

    window.open(url, '_blank');

}


function removeRow(id) {
    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "remove";


    url = url + "&id=" + id;

    xmlHttp.onreadystatechange = remove;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function remove() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Deleted") {

            var aodnumber = document.getElementById("aodnumber").value;
            updateTable(aodnumber);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function getTab() {
    alert("gsfhh");
    var aodnubmer = document.getElementById("aodnumber").value;

    updateTable(aodnubmer);

}

function add_tmp() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }



    var svat = 0;
    var vat = 0;
    var nbt = 0;


    if (document.getElementById("SVAT").checked) {
        svat = 1;
    }

    if (document.getElementById("VAT").checked) {
        vat = 1;
    }

    if (document.getElementById("NBT").checked) {
        nbt = 1;
    }


var des = document.getElementById('Description').value;

   for (var i = 0; i < 50; i++) {
        des = des.replace("#", "7k7f7d8j8u8");
        des = des.replace("&", "7k7f788j8u8");
        des = des.replace("+", "7k7g788j8u8");

    }


    var url = "quotation_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&Quotation_NO=" + document.getElementById('Quotation_NO').value;
    url = url + "&Location=" + document.getElementById('Location').value;
    url = url + "&Item_Name=" + document.getElementById('Item_Name').value;
    url = url + "&Description=" + des;
    url = url + "&QTY=" + document.getElementById('Qty').value;
    url = url + "&Unit_Price=" + document.getElementById('Unit_Price').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    //viraj edit
    url = url + "&tbl_remark=" + document.getElementById('tbl_remark').value;
    

    url = url + "&svat=" + svat;
    url = url + "&vat=" + vat;
    url = url + "&nbt=" + nbt;

//
//    if (uniq==null) {
//        url = url + "&ret=" + "not";
//        url = url + "&uniq=" + document.getElementById('uniq').value;
//    }else{
//        
//        url = url + "&ret=" + "ret";
//        url = url + "&uniq=" + uniq;
//    }
//    

    xmlHttp.onreadystatechange = quotation;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function quotation() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


//        document.getElementById('Customer_Order_number').value = "";
//        document.getElementById('Product_Des').value = "";
//        document.getElementById('QTY').value = "";



    }
}


function remove_tmp(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "quotation_data.php";
    url = url + "?Command=" + "removerow";
    url = url + "&Quotation_NO=" + document.getElementById('Quotation_NO').value;
    url = url + "&id=" + id;
    url = url + "&uniq=" + document.getElementById('uniq').value;

//    if (uniq==null) {
//        
//    }else{
//        url = url + "&uniq=" + uniq;
//    }

    xmlHttp.onreadystatechange = removeQ;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function removeQ() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


//        document.getElementById('Customer_Order_number').value = "";
//        document.getElementById('Product_Des').value = "";
//        document.getElementById('QTY').value = "";



    }
}



function updateTable(aodnumber) {

//    var aodnumber = document.getElementById("aodnumber").value

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "updateTable";
    url = url + "&aodnumber=" + aodnumber;



    xmlHttp.onreadystatechange = update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);






}
;

function update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rows");

        document.getElementById("getTable").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;




    }

}


function email()
{
    alert("fd");
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "quotation_data.php";
    url = url + "?Command=" + "email";
    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Sucess") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Sending Message</span></div>";
            $("#msg_box").hide().slideDown(400).delay(2000);
            $("#msg_box").slideUp(400);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function vatFun(element) {

//    if (element==="SVAT") {
//        document.getElementById("VAT").checked = false;
//    }else{
//        document.getElementById("SVAT").checked = false;
//    }

}


function taxCal(event) {



    var x = event.which || event.keyCode;


    if (x === 13) {
        add_tmp();
    }


}