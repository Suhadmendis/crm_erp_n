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


function taxCal(event) {



    var qty = parseFloat(document.getElementById("QTY").value) || 0;
    var up = parseFloat(document.getElementById("Unit_Price").value) || 0;



    if (document.getElementById("Cuddrrency").value == "usd") {
        var tot = qty * up;
        var total = tot.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0];
        document.getElementById("Value").value = total;
    } else {
        var tot = qty * up;
        var total = tot.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0]
        document.getElementById("Value").value = total;
    }


    var x = event.which || event.keyCode;


    if (x === 13) {
        add_tmp();
    }


}

function calc(theform) {
    var num = theform.original.value, rounded = theform.rounded
    var with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]
    rounded.value = with2Decimals
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
    document.getElementById("Invoice_Number").value = "";
//    var d = new Date();
//    document.getElementById("Invoice_Date").value = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
    document.getElementById("Settlement_Due").value = "";
    document.getElementById("Customer_Order_No").value = "";
    document.getElementById("ouraodnumber").value = "";

    document.getElementById("NBT").value = "";
    document.getElementById("VAT").value = "";
    document.getElementById("Customer_Address").value = "";
    document.getElementById("Customer_Name").value = "";
    document.getElementById("itemdetails").hidden = true;
    document.getElementById("crate").disabled = true;



    getdt();
}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "temporary_manual_invoice_data.php";
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

        if (code.length === 1) {
            code = "ccs/Temp/19-0000" + code;
        } else if (code.length === 2) {
            code = "ccs/Temp/19-000" + code;
        } else if (code.length === 3) {
            code = "ccs/Temp/19-00" + code;
        } else if (code.length === 4) {
            code = "ccs/Temp/19-0" + code;
        }

        document.getElementById('Invoice_Number').value = code;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id3");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}

function curren() {

    if (document.getElementById("Cuddrrency").value === "usd") {
        document.getElementById("crate").disabled = false;
    } else {
        document.getElementById("crate").disabled = true;
    }
}


function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

//  if (document.getElementById('inputText').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Name Not Entered</span></div>";
//         $("#msg_box").hide().slideDown(200).delay(2500);
//            $("#msg_box").slideUp(200);
//
//        return false;
//    }


    var svatboo = "0";
    var vatboo = "0";
    var nbtboo = "0";

    var yes = "0";
    var no = "0";

    if (document.getElementById("svatboo").checked) {
        svatboo = "1";
    } else {
        vatboo = "1";
    }

    if (document.getElementById("nbtboo").checked) {
        nbtboo = "1";
    }

    if (document.getElementById("yes").checked) {
        yes = "1";
    } else {
        no = "1";
    }

    var curr = "";
    var rate = 0.00;
    if (document.getElementById("Cuddrrency").value === "usd") {
        curr = "USD";

        rate = parseFloat(document.getElementById("crate").value);
    } else {
        curr = "LKR";
        rate = 1;
    }



// split and remove before zeros
    var id = document.getElementById('Invoice_Number').value;
    var split = id.split("-");
    var mid = parseInt(split[1]);
//
    var date = (document.getElementById('Invoice_Date').value).split("-");
    var day = date[2] + "-" + date[1] + "-" + date[0];


    var url = "temporary_manual_invoice_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&Invoice_Number=" + mid;
    url = url + "&Invoice_Date=" + day;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&Settlement_Due=" + document.getElementById('Settlement_Due').value;
    url = url + "&Customer_Order_No=" + document.getElementById('Customer_Order_No').value;
    url = url + "&ouraodnumber=" + document.getElementById('ouraodnumber').value;
    url = url + "&Currency=" + curr;
    url = url + "&Advance=" + document.getElementById('Advance').value;
    url = url + "&NBT=" + document.getElementById('NBT').value;
    url = url + "&VAT=" + document.getElementById('VAT').value;
    url = url + "&SVAT=" + document.getElementById('SVAT').value;
    url = url + "&Customer_Address=" + document.getElementById("Customer_Address").value;
    url = url + "&Customer_Name=" + document.getElementById("Customer_Name").value;
    url = url + "&svatboo=" + svatboo;
    url = url + "&vatboo=" + vatboo;
    url = url + "&nbtboo=" + nbtboo;
    url = url + "&yes=" + yes;
    url = url + "&no=" + no;
    url = url + "&rate=" + rate;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function salessaveresult() {
    var XMLAddress1;
    if (xmlHttp.readyState === 4 || xmlHttp.readyState === "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";

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









function print() {

    var svatboo = "0";
    var vatboo = "0";
    var nbtboo = "0";

    var yes = "0";
    var no = "0";


    if (document.getElementById("svatboo").checked) {
        svatboo = "1";
    } else {
        vatboo = "1";
    }

    if (document.getElementById("nbtboo").checked) {
        nbtboo = "1";
    }

    if (document.getElementById("yes").checked) {
        yes = "1";
    } else {
        no = "1";
    }


    var rate = 0.00;
    if (document.getElementById("Cuddrrency").value === "usd") {


        rate = parseFloat(document.getElementById("crate").value);
    } else {

        rate = 1;
    }

// split and remove before zeros
    var id = document.getElementById('Invoice_Number').value;
    var split = id.split("-");
    var mid = parseInt(split[1]);
//


    var url = "temporary_manual_invoice_print.php";
    url = url + "?Invoice_Number=" + mid;

    url = url + "&svatboo=" + svatboo;
    url = url + "&vatboo=" + vatboo;
    url = url + "&nbtboo=" + nbtboo;
    url = url + "&yes=" + yes;
    url = url + "&no=" + no;
    url = url + "&rate=" + rate;

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

    var svatboo = "0";
    var vatboo = "0";
    var nbtboo = "0";

    var yes = "0";
    var no = "0";

    if (document.getElementById("svatboo").checked) {
        svatboo = "1";
    } else {
        vatboo = "1";
    }

    if (document.getElementById("nbtboo").checked) {
        nbtboo = "1";
    }

    if (document.getElementById("yes").checked) {
        yes = "1";
    } else {
        no = "1";
    }


    var rate = 0.00;
    if (document.getElementById("Cuddrrency").value === "usd") {


        rate = parseFloat(document.getElementById("crate").value);
    } else {

        rate = 1;
    }





// split and remove before zeros
    var id = document.getElementById('Invoice_Number').value;
    var split = id.split("-");
    var mid = parseInt(split[1]);
//


    var qty = parseFloat(document.getElementById("QTY").value) || 0;
    var up = parseFloat(document.getElementById("Unit_Price").value) || 0;


//apply without unwanted "  " eg:-  "shfnidaguai igad gdiug adiug ado"
    var des = document.getElementById('Description').value;
    des = des.toString();


    var count = 0;

    if (des.charAt(0) === '"') {
        ++count;
    }


    if (des.charAt(des.length - 1) === '"') {
        ++count;
    }



    if (count === 2) {
        if (des.charAt(0) === '"') {
            des = des.substring(1);
        }


        if (des.charAt(des.length - 1) === '"') {
            des = des.substring(0, des.length - 1);
        }
    }


    for (var i = 0; i < 50; i++) {
        des = des.replace("#", "7k7f7d8j8u8");
        des = des.replace("&", "7k7f788j8u8");
        des = des.replace("+", "7k7g788j8u8");



    }


    var url = "temporary_manual_invoice_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&Invoice_Number=" + mid;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&QTY=" + document.getElementById('QTY').value;
    url = url + "&Advance=" + document.getElementById('Advance').value;
    url = url + "&Description=" + des;
    url = url + "&Unit_Price=" + document.getElementById('Unit_Price').value;
    url = url + "&Value=" + qty * up;
    url = url + "&svatboo=" + svatboo;
    url = url + "&vatboo=" + vatboo;
    url = url + "&nbtboo=" + nbtboo;
    url = url + "&yes=" + yes;
    url = url + "&no=" + no;
    url = url + "&rate=" + rate;

    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        document.getElementById('QTY').value = "";
        document.getElementById('Description').value = "";
        document.getElementById('Unit_Price').value = "";
        document.getElementById('Value').value = "";


        document.getElementById("QTY").focus();



    }
}


function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }


// split and remove before zeros
    var mainid = document.getElementById('Invoice_Number').value;
    var split = mainid.split("-");
    var mid = parseInt(split[1]);
//
    var svatboo = "0";
    var vatboo = "0";
    var nbtboo = "0";

    var yes = "0";
    var no = "0";

    if (document.getElementById("svatboo").checked) {
        svatboo = "1";
    } else {
        vatboo = "1";
    }

    if (document.getElementById("nbtboo").checked) {
        nbtboo = "1";
    }

    if (document.getElementById("yes").checked) {
        yes = "1";
    } else {
        no = "1";
    }


    var rate = 0.00;
    if (document.getElementById("Cuddrrency").value === "usd") {


        rate = parseFloat(document.getElementById("crate").value);
    } else {

        rate = 1;
    }


    var url = "temporary_manual_invoice_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&Invoice_Number=" + mid;
    url = url + "&id=" + id;
    url = url + "&Advance=" + document.getElementById('Advance').value;
    url = url + "&svatboo=" + svatboo;
    url = url + "&vatboo=" + vatboo;
    url = url + "&nbtboo=" + nbtboo;
    url = url + "&yes=" + yes;
    url = url + "&no=" + no;
    url = url + "&rate=" + rate;
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

function delete1() {

    // split and remove before zeros
    var id = document.getElementById('Invoice_Number').value;
    var split = id.split("-");
    var mid = parseInt(split[1]);
//
    var url = "temporary_manual_invoice_data.php";
    url = url + "?Command=" + "delete";

    url = url + "&Invoice_Number=" + mid;

    xmlHttp.onreadystatechange = deleteentry;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function deleteentry() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Deleted") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Deleted</span></div>";

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function vatdisable() {
    document.getElementById("svatboo").disabled = true;
    document.getElementById("vatboo").disabled = true;
    document.getElementById("nbtboo").disabled = true;
    document.getElementById("yes").disabled = true;
    document.getElementById("no").disabled = true;

    document.getElementById("itemdetails").hidden = false;
}

function vattdiable() {
    if (document.getElementById("no").checked) {
        document.getElementById("vatboo").checked = true;
        document.getElementById("svatboo").disabled = true;
    } else {
        document.getElementById("svatboo").disabled = false;
    }

}


var input = document.getElementById("addaod");
input.addEventListener("keyup", function (event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        addAod();
    }
});



function addAod() {

    if (document.getElementById("addaod").value != "") {
        var aod = document.getElementById("addaod").value;
        document.getElementById("addaod").value = "";

        if (document.getElementById("ouraodnumber").value != "") {
            var aodval = document.getElementById("ouraodnumber").value;
            document.getElementById("ouraodnumber").value = aodval + ", " + aod;
        } else {

            document.getElementById("ouraodnumber").value = aod;
        }


    }



}
