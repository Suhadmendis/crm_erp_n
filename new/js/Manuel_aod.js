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



    document.getElementById("customer").checked = true;

    document.getElementById("inputText").value = "";
    document.getElementById("Address").value = "";
    document.getElementById("ncp").value = "";
    document.getElementById("tel").value = "";



    document.getElementById("Name_of_Driver").value = "";
    document.getElementById("SO_No").value = "";

    getdt();

}

function getdt() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "Manuel_AOD_data.php";
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
            code = "MAOD/CUS/0000" + code;
        } else if (code.length === 2) {
            code = "MAOD/CUS/000" + code;
        } else if (code.length === 3) {
            code = "MAOD/CUS/00" + code;
        } else if (code.length === 4) {
            code = "MAOD/CUS/0" + code;
        }

        document.getElementById('aodnumber').value = code;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id3");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;

    }
}




function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('inputText').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Name Not Entered</span></div>";
        $("#msg_box").hide().slideDown(200).delay(2500);
        $("#msg_box").slideUp(200);

        return false;
    }



    var type = "";

    if (document.getElementById("customer").checked) {
        type = "CUSTOMER";

    } else {
        type = "SUPPLIER";
    }

// split and remove before zeros
    var id = document.getElementById('aodnumber').value;
    var split = id.split("/");
    var mid = parseInt(split[2]);
//

    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&inputText=" + document.getElementById('inputText').value;
    url = url + "&Address=" + document.getElementById('Address').value;
    url = url + "&ncp=" + document.getElementById('ncp').value;
    url = url + "&tel=" + document.getElementById('tel').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&aodnumber=" + mid;
    //url = url + "&mainid=" + mainid;
    url = url + "&tel=" + document.getElementById('tel').value;
    url = url + "&Date_of_Despatch=" + document.getElementById('Date_of_Despatch').value;
    url = url + "&nod=" + document.getElementById('Name_of_Driver').value;
    url = url + "&SO_No=" + document.getElementById('SO_No').value;
    url = url + "&type=" + type;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function salessaveresult() {
    var XMLAddress1;
    if (xmlHttp.readyState === 4 || xmlHttp.readyState === "complete") {
        var respo = xmlHttp.responseText;
       
        var id = respo.split(":");
        var code = id[1];

        if (id[0] === "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";

            if (code.length === 1) {
                code = "MAOD/"+id[2]+"/0000" + code;
            } else if (code.length === 2) {
                code = "MAOD/"+id[2]+"/000" + code;
            } else if (code.length === 3) {
                code = "MAOD/"+id[2]+"/00" + code;
            } else if (code.length === 4) {
                code = "MAOD/"+id[2]+"/0" + code;
            }

            document.getElementById('aodnumber').value = code;

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
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + id[0] + "</span></div>";
        }
    }
}









function print() {

    var url = "Manuel_AOD_print.php";
    url = url + "?aodnumber=" + document.getElementById('aodnumber').value;


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

// split and remove before zeros
    var id = document.getElementById('aodnumber').value;
    var split = id.split("/");
    var mid = parseInt(split[2]);
//


    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&aodnumber=" + mid;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&Customer_Order_number=" + document.getElementById('Customer_Order_number').value;
    url = url + "&Product_Des=" + document.getElementById('Product_Des').value;
    url = url + "&QTY=" + document.getElementById('QTY').value;

    xmlHttp.onreadystatechange = aodtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function aodtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        document.getElementById('Customer_Order_number').value = "";
        document.getElementById('Product_Des').value = "";
        document.getElementById('QTY').value = "";



    }
}


function remove_tmp(id) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
// split and remove before zeros
    var idd = document.getElementById('aodnumber').value;
    var split = idd.split("/");
    var mid = parseInt(split[2]);
//

    var url = "Manuel_AOD_data.php";
    url = url + "?Command=" + "removerow";

    url = url + "&aodnumber=" + mid;
    url = url + "&id=" + id;


    xmlHttp.onreadystatechange = removeAdo;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function removeAdo() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        document.getElementById('Customer_Order_number').value = "";
        document.getElementById('Product_Des').value = "";
        document.getElementById('QTY').value = "";



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