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




function new_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

//    document.getElementById("rate_ref").value = "";
//    document.getElementById("uniq").value = "";
//    document.getElementById("ratecodename").value = "";
//    document.getElementById("r_vat").value = "";
//    document.getElementById("r_nbt").value = "";

// window.setInterval(function(){
  
// }, 1000);
    getdt();

}

function getdt() {
    // alert("ds");
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "ledger_indicator_data.php";
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



        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("json");

        var table = document.getElementById("LED_T");
// console.log(table);
        for (var i = 0; i < XMLAddress1.length; i++) {
            
            var row = table.insertRow(1);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            var cell5 = row.insertCell(5);
            var cell6 = row.insertCell(6);
            var cell7 = row.insertCell(7);
            var cell8 = row.insertCell(8);


            var array = XMLAddress1[i].childNodes[0].nodeValue;

            var ar = JSON.parse(array);
//            alert(ar[1]);


            cell0.innerHTML = ar[0];
            cell1.innerHTML = ar[1];
            cell2.innerHTML = ar[2];
            cell3.innerHTML = ar[3];
            cell4.innerHTML = ar[4];
            cell5.innerHTML = ar[5];
            cell6.innerHTML = ar[6];
            cell7.innerHTML = ar[7];
            cell8.innerHTML = ar[8];


        }

        // setTimeout(function () {

        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);
        //     table.deleteRow(1);

        // }, 2000);



//      table.deleteRow(2);
//      table.deleteRow(3);
//      table.deleteRow(4);
//      table.deleteRow(5);
//      table.deleteRow(6);
//      table.deleteRow(7);
//      table.deleteRow(8);
//      table.deleteRow(9);
//      table.deleteRow(10);


    }
}















