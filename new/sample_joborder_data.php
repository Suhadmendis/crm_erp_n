<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

function generateId($id, $ref, $switch) {

    if ($switch == "pre") {
        $temp = substr($id, strlen($ref));
        $id = (int) $temp;

        return $id;
    } else if ($switch == "post") {

        $temp = substr("0000000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT jordcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();

    $post = generateId($row['jordcode'], "SJO/", "post");
    $uniq = uniqid();

    $ResponseXML .= "<id><![CDATA[$post]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "delete from samplejoborder where SJRequestNo = '" . $_GET['sjrequestref'] . "'";
        $result = $conn->query($sql);
       
        $sql = "SELECT jordcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['jordcode'];
      
         $sql = "Insert into samplejoborder(SJRequestNo,sjbref,jodate,customer,mkex)values 
           ('" . $_GET['sjrequestref'] . "','" . $_GET['sjbref'] . "','" . $_GET['date_in'] . "','" . $_GET['customer'] . "','" . $_GET['mkex'] . "')";

        $result = $conn->query($sql);
           
        
        
         $sql2 = "select * from samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";


        foreach ($conn->query($sql2) as $row) {
           
                $sql = "Insert into samplejobreqnote_table(itemno,des,qty,jrid)values 
             ('" . $row['itemno'] . "','" . $row['des'] . "','" . $row['qty'] . "','" . $no . "')";

            $result = $conn->query($sql);
        }

        foreach ($conn->query($sql2) as $row) {

            $sql = "DELETE FROM samplejobreqnote_table_temp where jrid = '" . $_GET['sjrequestref'] . "' and uniq = '" . $_GET['uniq'] . "'";

            $result = $conn->query($sql);
        }


        
        
        
        $no2 = $no + 1;
        $sql = "update invpara set jordcode = $no2 where jordcode = $no";
        $result = $conn->query($sql);
        
        
        
        
        

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {

    $sql = "update samplejoborder set sjbref = '" . $_GET['sjbref'] . "',jodate = '" . $_GET['date_in'] . "',customer = '" . $_GET['customer'] . "',mkex = '" . $_GET['mkex'] . "'  where SJRequestNo = '" . $_GET['sjrequestref'] . "'";
    $result = $conn->query($sql);
    echo "update";
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from samplejoborder where SJRequestNo = '" . $_GET['sjrequestref'] . "'";
    $result = $conn->query($sql);
    echo "Deleted";
}


if ($_GET["Command"] == "cancel") {

    $sql = "update sponcer set Cancel = '1'   where SponID = '" . $_GET['SponID'] . "'";
    $result = $conn->query($sql);


    echo "canceled";
}

if ($_GET["Command"] == "setitem") {

     header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into samplejobreqnote_table_temp(itemno,des,qty,uniq,jrid)values 
     ('" . $_GET['itemno'] . "','" . $_GET['SampleDescription'] . "','" . $_GET['SampleQty'] . "','" . $_GET['uniq'] . "','" . $_GET['jrid'] . "')";

        $result = $conn->query($sql);
    }

    
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>Item No.</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample Qty</th>
                                    <th style='width: 5%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='Item No.' id='itemno' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Sample Description'  id='SampleDescription' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Sample Qty'  id='SampleQty' class='form-control input-sm'>
                                    </td>
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM samplejoborder_table_temp WHERE jrid = '" . $_GET['jrid'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemno'] . "</td><td>" . $row2['des'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


   $ResponseXML .= "</tbody></table>";


$ResponseXML .= "   </table>]]></sales_table>";

    $ResponseXML .= "</salesdetails>";



    echo $ResponseXML;
}



if ($_GET["Command"] == "removerow") {
 header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from samplejobreqnote_table_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);


       $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th style='width: 10%;'>dsfg</th>
                                    <th style='width: 70%;'>Sample Description</th>
                                    <th style='width: 15%;'>Sample Qty</th>
                                    <th style='width: 5%;'>Add/Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    <td>
                                        <input type='text' placeholder='Item No.' id='itemno' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input type='text' placeholder='Sample Description'  id='SampleDescription' class='form-control input-sm'>
                                    </td>
                                    <td>
                                        <input  type='text' placeholder='Sample Qty'  id='SampleQty' class='form-control input-sm'>
                                    </td>
                                    <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";
       

 $sql1 = "SELECT * FROM samplejoborder_table_temp WHERE jrid = '" . $_GET['jrid'] . "' and uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['itemno'] . "</td><td>" . $row2['des'] . "</td><td>" . $row2['qty'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }


   $ResponseXML .= "</tbody></table>";


$ResponseXML .= "   </table>]]></sales_table>";

    $ResponseXML .= "</salesdetails>";



    echo $ResponseXML;
}




?>