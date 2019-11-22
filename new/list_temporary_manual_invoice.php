<?php
session_start();
include_once './connection_sql.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />


        <title>Search Customer</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"/>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

                <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
                    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

                    <!-- Include Required Prerequisites -->
                    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
                    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

                    <!-- Include Date Range Picker -->
                    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
                    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

                    </head>

                    <style>
                        .button {

                            background-color: #4CAF50; /* Green */
                            border: none;
                            color: white;
                            padding: 8px 16px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 13px;
                            margin: 4px 2px;
                            -webkit-transition-duration: 0.4s; /* Safari */
                            transition-duration: 0.4s;
                            cursor: pointer;
                        }



                        .button2 {
                            background-color: #337ab7; 
                            color: white; 
                            border: 2px solid #337ab7;
                        }

                        .button2:hover {
                            background-color: #204d74;
                            color: white;
                            border: 2px solid #204d74;
                        }

                        #demo {
                            width: 420px;
                            heignth: 41px;
                            padding: 15px;
                            margin: 50px auto;
                        }

                    </style>



                    <body>

                        <div class="container">
                            <div class="col-md-3"><br>
                                    <div class="form-group"></div>

                                    <input type="checkbox" id="SVAT" onchange="csChange();" checked data-toggle="toggle">
                                        <label class="col-sm-4" for="exampleCheck1">SVAT</label>

                                        <div class="form-group"></div>
                                        <input type="checkbox" id="TAX" onchange="csChange();"  checked data-toggle="toggle">
                                            <label class="col-sm-4" for="exampleCheck1">TAX</label>

                                            <div class="form-group"></div>
                                            <input type="checkbox" id="Invoice" onchange="csChange();"  checked data-toggle="toggle">
                                                <label class="col-sm-4" for="exampleCheck1">Invoice</label>

                                                </div>
                                                <div class="col-md-3"><br>

                                                        <div class="form-group"></div>

                                                        <input type="checkbox" id="USD" onchange="csChange();" checked data-toggle="toggle">
                                                            <label class="col-sm-4" for="exampleCheck1">USD</label>

                                                            <div class="form-group"></div>
                                                            <input type="checkbox" id="LKR" onchange="csChange();"  checked data-toggle="toggle">
                                                                <label class="col-sm-4" for="exampleCheck1">LKR</label>

                                                                </div>
                                                                <br>
                                                                    <div class="col-md-3">

                                                                        <div class="form-group"></div>
                                                                        <div class="form-group-sm">
                                                                            <label for="exampleCheck1">From</label>
                                                                            <input onkeyup="csChange();" class="form-control" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d", mktime()) . " - 365 day")); ?>" type="text" id="sdate"></input><br>
                                                                                <label for="exampleCheck1">To</label>
                                                                                <input onkeyup="csChange();" class="form-control" value="<?php echo date('Y-m-d'); ?>" type="text" id="edate"></input><br>

                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <br>

                                                                                            <div class="form-group"></div>
                                                                                            <div class="form-group-sm">

                                                                                                <input class="button button2" type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">

                                                                                            </div>
                                                                                    </div>
                                                                                    </div>




                                                                                    <!--                                                                                <h2> DATE AND TIME RANGE PICKER EXAMPLE </h2>
                                                                                                                                                                    
                                                                                    
                                                                                                                                                                    <input type="text" id="demo" name="datefilter" value="" />-->


                                                                                    <br>

                                                                                        <div style="margin-left: 2%;margin-right: 2%;">
<!--                                                                                            <div id="getTable">

                                                                                            </div>-->
                                                                                        </div>
                                                                                                            <script>

                                                                                        var tableToExcel = (function() {
                                                                                                var uri = 'data:application/vnd.ms-excel;base64,'
                                                                                        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
 , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m,p) { return c[p]; }) }
return function(table, name) {
                                    if (!table.nodeType) table = document.getElementById(table)
                                    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                                    window.location.href = uri + base64(format(template, ctx))
                    }
                  })()
                                                                                        </script>






                                                                                        <table id="example" class="stripe row-border order-column" style="width:100%">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>First name</th>
                                                                                                    <th>Last name</th>
                                                                                                    <th>Position</th>
                                                                                                    <th>Office</th>
                                                                                                    <th>Age</th>
                                                                                                    <th>Start date</th>
                                                                                                    <th>Salary</th>
                                                                                                    <th>Extn.</th>
                                                                                                    <th>E-mail</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>Tiger</td>
                                                                                                    <td>Nixon</td>
                                                                                                    <td>System Architect</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>61</td>
                                                                                                    <td>2011/04/25</td>
                                                                                                    <td>$320,800</td>
                                                                                                    <td>5421</td>
                                                                                                    <td>t.nixon@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Garrett</td>
                                                                                                    <td>Winters</td>
                                                                                                    <td>Accountant</td>
                                                                                                    <td>Tokyo</td>
                                                                                                    <td>63</td>
                                                                                                    <td>2011/07/25</td>
                                                                                                    <td>$170,750</td>
                                                                                                    <td>8422</td>
                                                                                                    <td>g.winters@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Ashton</td>
                                                                                                    <td>Cox</td>
                                                                                                    <td>Junior Technical Author</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>66</td>
                                                                                                    <td>2009/01/12</td>
                                                                                                    <td>$86,000</td>
                                                                                                    <td>1562</td>
                                                                                                    <td>a.cox@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Cedric</td>
                                                                                                    <td>Kelly</td>
                                                                                                    <td>Senior Javascript Developer</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>22</td>
                                                                                                    <td>2012/03/29</td>
                                                                                                    <td>$433,060</td>
                                                                                                    <td>6224</td>
                                                                                                    <td>c.kelly@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Airi</td>
                                                                                                    <td>Satou</td>
                                                                                                    <td>Accountant</td>
                                                                                                    <td>Tokyo</td>
                                                                                                    <td>33</td>
                                                                                                    <td>2008/11/28</td>
                                                                                                    <td>$162,700</td>
                                                                                                    <td>5407</td>
                                                                                                    <td>a.satou@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Brielle</td>
                                                                                                    <td>Williamson</td>
                                                                                                    <td>Integration Specialist</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>61</td>
                                                                                                    <td>2012/12/02</td>
                                                                                                    <td>$372,000</td>
                                                                                                    <td>4804</td>
                                                                                                    <td>b.williamson@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Herrod</td>
                                                                                                    <td>Chandler</td>
                                                                                                    <td>Sales Assistant</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>59</td>
                                                                                                    <td>2012/08/06</td>
                                                                                                    <td>$137,500</td>
                                                                                                    <td>9608</td>
                                                                                                    <td>h.chandler@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Rhona</td>
                                                                                                    <td>Davidson</td>
                                                                                                    <td>Integration Specialist</td>
                                                                                                    <td>Tokyo</td>
                                                                                                    <td>55</td>
                                                                                                    <td>2010/10/14</td>
                                                                                                    <td>$327,900</td>
                                                                                                    <td>6200</td>
                                                                                                    <td>r.davidson@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Colleen</td>
                                                                                                    <td>Hurst</td>
                                                                                                    <td>Javascript Developer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>39</td>
                                                                                                    <td>2009/09/15</td>
                                                                                                    <td>$205,500</td>
                                                                                                    <td>2360</td>
                                                                                                    <td>c.hurst@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Sonya</td>
                                                                                                    <td>Frost</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>23</td>
                                                                                                    <td>2008/12/13</td>
                                                                                                    <td>$103,600</td>
                                                                                                    <td>1667</td>
                                                                                                    <td>s.frost@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jena</td>
                                                                                                    <td>Gaines</td>
                                                                                                    <td>Office Manager</td>
                                                                                                    <td>London</td>
                                                                                                    <td>30</td>
                                                                                                    <td>2008/12/19</td>
                                                                                                    <td>$90,560</td>
                                                                                                    <td>3814</td>
                                                                                                    <td>j.gaines@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Quinn</td>
                                                                                                    <td>Flynn</td>
                                                                                                    <td>Support Lead</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>22</td>
                                                                                                    <td>2013/03/03</td>
                                                                                                    <td>$342,000</td>
                                                                                                    <td>9497</td>
                                                                                                    <td>q.flynn@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Charde</td>
                                                                                                    <td>Marshall</td>
                                                                                                    <td>Regional Director</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>36</td>
                                                                                                    <td>2008/10/16</td>
                                                                                                    <td>$470,600</td>
                                                                                                    <td>6741</td>
                                                                                                    <td>c.marshall@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Haley</td>
                                                                                                    <td>Kennedy</td>
                                                                                                    <td>Senior Marketing Designer</td>
                                                                                                    <td>London</td>
                                                                                                    <td>43</td>
                                                                                                    <td>2012/12/18</td>
                                                                                                    <td>$313,500</td>
                                                                                                    <td>3597</td>
                                                                                                    <td>h.kennedy@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Tatyana</td>
                                                                                                    <td>Fitzpatrick</td>
                                                                                                    <td>Regional Director</td>
                                                                                                    <td>London</td>
                                                                                                    <td>19</td>
                                                                                                    <td>2010/03/17</td>
                                                                                                    <td>$385,750</td>
                                                                                                    <td>1965</td>
                                                                                                    <td>t.fitzpatrick@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Michael</td>
                                                                                                    <td>Silva</td>
                                                                                                    <td>Marketing Designer</td>
                                                                                                    <td>London</td>
                                                                                                    <td>66</td>
                                                                                                    <td>2012/11/27</td>
                                                                                                    <td>$198,500</td>
                                                                                                    <td>1581</td>
                                                                                                    <td>m.silva@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Paul</td>
                                                                                                    <td>Byrd</td>
                                                                                                    <td>Chief Financial Officer (CFO)</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>64</td>
                                                                                                    <td>2010/06/09</td>
                                                                                                    <td>$725,000</td>
                                                                                                    <td>3059</td>
                                                                                                    <td>p.byrd@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Gloria</td>
                                                                                                    <td>Little</td>
                                                                                                    <td>Systems Administrator</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>59</td>
                                                                                                    <td>2009/04/10</td>
                                                                                                    <td>$237,500</td>
                                                                                                    <td>1721</td>
                                                                                                    <td>g.little@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Bradley</td>
                                                                                                    <td>Greer</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>London</td>
                                                                                                    <td>41</td>
                                                                                                    <td>2012/10/13</td>
                                                                                                    <td>$132,000</td>
                                                                                                    <td>2558</td>
                                                                                                    <td>b.greer@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Dai</td>
                                                                                                    <td>Rios</td>
                                                                                                    <td>Personnel Lead</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>35</td>
                                                                                                    <td>2012/09/26</td>
                                                                                                    <td>$217,500</td>
                                                                                                    <td>2290</td>
                                                                                                    <td>d.rios@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jenette</td>
                                                                                                    <td>Caldwell</td>
                                                                                                    <td>Development Lead</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>30</td>
                                                                                                    <td>2011/09/03</td>
                                                                                                    <td>$345,000</td>
                                                                                                    <td>1937</td>
                                                                                                    <td>j.caldwell@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Yuri</td>
                                                                                                    <td>Berry</td>
                                                                                                    <td>Chief Marketing Officer (CMO)</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>40</td>
                                                                                                    <td>2009/06/25</td>
                                                                                                    <td>$675,000</td>
                                                                                                    <td>6154</td>
                                                                                                    <td>y.berry@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Caesar</td>
                                                                                                    <td>Vance</td>
                                                                                                    <td>Pre-Sales Support</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>21</td>
                                                                                                    <td>2011/12/12</td>
                                                                                                    <td>$106,450</td>
                                                                                                    <td>8330</td>
                                                                                                    <td>c.vance@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Doris</td>
                                                                                                    <td>Wilder</td>
                                                                                                    <td>Sales Assistant</td>
                                                                                                    <td>Sidney</td>
                                                                                                    <td>23</td>
                                                                                                    <td>2010/09/20</td>
                                                                                                    <td>$85,600</td>
                                                                                                    <td>3023</td>
                                                                                                    <td>d.wilder@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Angelica</td>
                                                                                                    <td>Ramos</td>
                                                                                                    <td>Chief Executive Officer (CEO)</td>
                                                                                                    <td>London</td>
                                                                                                    <td>47</td>
                                                                                                    <td>2009/10/09</td>
                                                                                                    <td>$1,200,000</td>
                                                                                                    <td>5797</td>
                                                                                                    <td>a.ramos@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Gavin</td>
                                                                                                    <td>Joyce</td>
                                                                                                    <td>Developer</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>42</td>
                                                                                                    <td>2010/12/22</td>
                                                                                                    <td>$92,575</td>
                                                                                                    <td>8822</td>
                                                                                                    <td>g.joyce@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jennifer</td>
                                                                                                    <td>Chang</td>
                                                                                                    <td>Regional Director</td>
                                                                                                    <td>Singapore</td>
                                                                                                    <td>28</td>
                                                                                                    <td>2010/11/14</td>
                                                                                                    <td>$357,650</td>
                                                                                                    <td>9239</td>
                                                                                                    <td>j.chang@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Brenden</td>
                                                                                                    <td>Wagner</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>28</td>
                                                                                                    <td>2011/06/07</td>
                                                                                                    <td>$206,850</td>
                                                                                                    <td>1314</td>
                                                                                                    <td>b.wagner@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Fiona</td>
                                                                                                    <td>Green</td>
                                                                                                    <td>Chief Operating Officer (COO)</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>48</td>
                                                                                                    <td>2010/03/11</td>
                                                                                                    <td>$850,000</td>
                                                                                                    <td>2947</td>
                                                                                                    <td>f.green@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Shou</td>
                                                                                                    <td>Itou</td>
                                                                                                    <td>Regional Marketing</td>
                                                                                                    <td>Tokyo</td>
                                                                                                    <td>20</td>
                                                                                                    <td>2011/08/14</td>
                                                                                                    <td>$163,000</td>
                                                                                                    <td>8899</td>
                                                                                                    <td>s.itou@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Michelle</td>
                                                                                                    <td>House</td>
                                                                                                    <td>Integration Specialist</td>
                                                                                                    <td>Sidney</td>
                                                                                                    <td>37</td>
                                                                                                    <td>2011/06/02</td>
                                                                                                    <td>$95,400</td>
                                                                                                    <td>2769</td>
                                                                                                    <td>m.house@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Suki</td>
                                                                                                    <td>Burks</td>
                                                                                                    <td>Developer</td>
                                                                                                    <td>London</td>
                                                                                                    <td>53</td>
                                                                                                    <td>2009/10/22</td>
                                                                                                    <td>$114,500</td>
                                                                                                    <td>6832</td>
                                                                                                    <td>s.burks@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Prescott</td>
                                                                                                    <td>Bartlett</td>
                                                                                                    <td>Technical Author</td>
                                                                                                    <td>London</td>
                                                                                                    <td>27</td>
                                                                                                    <td>2011/05/07</td>
                                                                                                    <td>$145,000</td>
                                                                                                    <td>3606</td>
                                                                                                    <td>p.bartlett@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Gavin</td>
                                                                                                    <td>Cortez</td>
                                                                                                    <td>Team Leader</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>22</td>
                                                                                                    <td>2008/10/26</td>
                                                                                                    <td>$235,500</td>
                                                                                                    <td>2860</td>
                                                                                                    <td>g.cortez@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Martena</td>
                                                                                                    <td>Mccray</td>
                                                                                                    <td>Post-Sales support</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>46</td>
                                                                                                    <td>2011/03/09</td>
                                                                                                    <td>$324,050</td>
                                                                                                    <td>8240</td>
                                                                                                    <td>m.mccray@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Unity</td>
                                                                                                    <td>Butler</td>
                                                                                                    <td>Marketing Designer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>47</td>
                                                                                                    <td>2009/12/09</td>
                                                                                                    <td>$85,675</td>
                                                                                                    <td>5384</td>
                                                                                                    <td>u.butler@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Howard</td>
                                                                                                    <td>Hatfield</td>
                                                                                                    <td>Office Manager</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>51</td>
                                                                                                    <td>2008/12/16</td>
                                                                                                    <td>$164,500</td>
                                                                                                    <td>7031</td>
                                                                                                    <td>h.hatfield@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Hope</td>
                                                                                                    <td>Fuentes</td>
                                                                                                    <td>Secretary</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>41</td>
                                                                                                    <td>2010/02/12</td>
                                                                                                    <td>$109,850</td>
                                                                                                    <td>6318</td>
                                                                                                    <td>h.fuentes@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Vivian</td>
                                                                                                    <td>Harrell</td>
                                                                                                    <td>Financial Controller</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>62</td>
                                                                                                    <td>2009/02/14</td>
                                                                                                    <td>$452,500</td>
                                                                                                    <td>9422</td>
                                                                                                    <td>v.harrell@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Timothy</td>
                                                                                                    <td>Mooney</td>
                                                                                                    <td>Office Manager</td>
                                                                                                    <td>London</td>
                                                                                                    <td>37</td>
                                                                                                    <td>2008/12/11</td>
                                                                                                    <td>$136,200</td>
                                                                                                    <td>7580</td>
                                                                                                    <td>t.mooney@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jackson</td>
                                                                                                    <td>Bradshaw</td>
                                                                                                    <td>Director</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>65</td>
                                                                                                    <td>2008/09/26</td>
                                                                                                    <td>$645,750</td>
                                                                                                    <td>1042</td>
                                                                                                    <td>j.bradshaw@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Olivia</td>
                                                                                                    <td>Liang</td>
                                                                                                    <td>Support Engineer</td>
                                                                                                    <td>Singapore</td>
                                                                                                    <td>64</td>
                                                                                                    <td>2011/02/03</td>
                                                                                                    <td>$234,500</td>
                                                                                                    <td>2120</td>
                                                                                                    <td>o.liang@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Bruno</td>
                                                                                                    <td>Nash</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>London</td>
                                                                                                    <td>38</td>
                                                                                                    <td>2011/05/03</td>
                                                                                                    <td>$163,500</td>
                                                                                                    <td>6222</td>
                                                                                                    <td>b.nash@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Sakura</td>
                                                                                                    <td>Yamamoto</td>
                                                                                                    <td>Support Engineer</td>
                                                                                                    <td>Tokyo</td>
                                                                                                    <td>37</td>
                                                                                                    <td>2009/08/19</td>
                                                                                                    <td>$139,575</td>
                                                                                                    <td>9383</td>
                                                                                                    <td>s.yamamoto@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Thor</td>
                                                                                                    <td>Walton</td>
                                                                                                    <td>Developer</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>61</td>
                                                                                                    <td>2013/08/11</td>
                                                                                                    <td>$98,540</td>
                                                                                                    <td>8327</td>
                                                                                                    <td>t.walton@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Finn</td>
                                                                                                    <td>Camacho</td>
                                                                                                    <td>Support Engineer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>47</td>
                                                                                                    <td>2009/07/07</td>
                                                                                                    <td>$87,500</td>
                                                                                                    <td>2927</td>
                                                                                                    <td>f.camacho@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Serge</td>
                                                                                                    <td>Baldwin</td>
                                                                                                    <td>Data Coordinator</td>
                                                                                                    <td>Singapore</td>
                                                                                                    <td>64</td>
                                                                                                    <td>2012/04/09</td>
                                                                                                    <td>$138,575</td>
                                                                                                    <td>8352</td>
                                                                                                    <td>s.baldwin@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Zenaida</td>
                                                                                                    <td>Frank</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>63</td>
                                                                                                    <td>2010/01/04</td>
                                                                                                    <td>$125,250</td>
                                                                                                    <td>7439</td>
                                                                                                    <td>z.frank@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Zorita</td>
                                                                                                    <td>Serrano</td>
                                                                                                    <td>Software Engineer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>56</td>
                                                                                                    <td>2012/06/01</td>
                                                                                                    <td>$115,000</td>
                                                                                                    <td>4389</td>
                                                                                                    <td>z.serrano@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jennifer</td>
                                                                                                    <td>Acosta</td>
                                                                                                    <td>Junior Javascript Developer</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>43</td>
                                                                                                    <td>2013/02/01</td>
                                                                                                    <td>$75,650</td>
                                                                                                    <td>3431</td>
                                                                                                    <td>j.acosta@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Cara</td>
                                                                                                    <td>Stevens</td>
                                                                                                    <td>Sales Assistant</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>46</td>
                                                                                                    <td>2011/12/06</td>
                                                                                                    <td>$145,600</td>
                                                                                                    <td>3990</td>
                                                                                                    <td>c.stevens@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Hermione</td>
                                                                                                    <td>Butler</td>
                                                                                                    <td>Regional Director</td>
                                                                                                    <td>London</td>
                                                                                                    <td>47</td>
                                                                                                    <td>2011/03/21</td>
                                                                                                    <td>$356,250</td>
                                                                                                    <td>1016</td>
                                                                                                    <td>h.butler@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Lael</td>
                                                                                                    <td>Greer</td>
                                                                                                    <td>Systems Administrator</td>
                                                                                                    <td>London</td>
                                                                                                    <td>21</td>
                                                                                                    <td>2009/02/27</td>
                                                                                                    <td>$103,500</td>
                                                                                                    <td>6733</td>
                                                                                                    <td>l.greer@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Jonas</td>
                                                                                                    <td>Alexander</td>
                                                                                                    <td>Developer</td>
                                                                                                    <td>San Francisco</td>
                                                                                                    <td>30</td>
                                                                                                    <td>2010/07/14</td>
                                                                                                    <td>$86,500</td>
                                                                                                    <td>8196</td>
                                                                                                    <td>j.alexander@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Shad</td>
                                                                                                    <td>Decker</td>
                                                                                                    <td>Regional Director</td>
                                                                                                    <td>Edinburgh</td>
                                                                                                    <td>51</td>
                                                                                                    <td>2008/11/13</td>
                                                                                                    <td>$183,000</td>
                                                                                                    <td>6373</td>
                                                                                                    <td>s.decker@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Michael</td>
                                                                                                    <td>Bruce</td>
                                                                                                    <td>Javascript Developer</td>
                                                                                                    <td>Singapore</td>
                                                                                                    <td>29</td>
                                                                                                    <td>2011/06/27</td>
                                                                                                    <td>$183,000</td>
                                                                                                    <td>5384</td>
                                                                                                    <td>m.bruce@datatables.net</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Donna</td>
                                                                                                    <td>Snider</td>
                                                                                                    <td>Customer Support</td>
                                                                                                    <td>New York</td>
                                                                                                    <td>27</td>
                                                                                                    <td>2011/01/25</td>
                                                                                                    <td>$112,000</td>
                                                                                                    <td>4226</td>
                                                                                                    <td>d.snider@datatables.net</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                                <tr>
                                                                                                    <th>First name</th>
                                                                                                    <th>Last name</th>
                                                                                                    <th>Position</th>
                                                                                                    <th>Office</th>
                                                                                                    <th>Age</th>
                                                                                                    <th>Start date</th>
                                                                                                    <th>Salary</th>
                                                                                                    <th>Extn.</th>
                                                                                                    <th>E-mail</th>
                                                                                                </tr>
                                                                                            </tfoot>
                                                                                        </table>                 


                                                                                        <script>

                                                                                                                    $(document).ready(function() {
                                                                                                            // Setup - add a text input to each footer cell
                                                                                                            $('#example tfoot th').each(function (i) {
                                                                                                            var title = $('#example thead th').eq($(this).index()).text();
                                                                                                            $(this).html('<input type="text" placeholder="Search ' + title + '" data-index="' + i + '" />');
                                                                                                            });
                                                                                                            // DataTable
                                                                                                            var table = $('#example').DataTable({
                                                                                                            scrollY:        "300px",
                                                                                                                    scrollX:        true,
                                                                                                                    scrollCollapse: true,
                                                                                                                    paging:         false,
                                                                                                                    fixedColumns:   true
                                                                                                            });
                                                                                                            // Filter event handler
                                                                                                            $(table.table().container()).on('keyup', 'tfoot input', function () {
                                                                                                            table
                                                                                                                    .column($(this).data('index'))
                                                                                                                    .search(this.value)
                                                                                                                    .draw();
                                                                                                            });
                                                                                                            });
                                                                                        </script>




                                                                                        </body>
                                                                                        </html>
                                                                                        <script language="JavaScript" src="js/list_temporary_manual_invoice.js"></script>
                                                                                        <script>csChange();</script>

                                                                                        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                                                                                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                                                                                        <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
                                                                                        
<!--                                                                                            <script>
                                                                                                        $('#demo').daterangepicker({
                                                                                                        "showISOWeekNumbers": true,
                                                                                                                "timePicker": true,
                                                                                                                "autoUpdateInput": true,
                                                                                                                "locale": {
                                                                                                                "cancelLabel": 'Clear',
                                                                                                                        "format": "MMMM DD, YYYY @ h:mm A",
                                                                                                                        "separator": " - ",
                                                                                                                        "applyLabel": "Apply",
                                                                                                                        "cancelLabel": "Cancel",
                                                                                                                        "fromLabel": "From",
                                                                                                                        "toLabel": "To",
                                                                                                                        "customRangeLabel": "Custom",
                                                                                                                        "weekLabel": "W",
                                                                                                                        "daysOfWeek": [
                                                                                                                                "Su",
                                                                                                                                "Mo",
                                                                                                                                "Tu",
                                                                                                                                "We",
                                                                                                                                "Th",
                                                                                                                                "Fr",
                                                                                                                                "Sa"
                                                                                                                        ],
                                                                                                                        "monthNames": [
                                                                                                                                "January",
                                                                                                                                "February",
                                                                                                                                "March",
                                                                                                                                "April",
                                                                                                                                "May",
                                                                                                                                "June",
                                                                                                                                "July",
                                                                                                                                "August",
                                                                                                                                "September",
                                                                                                                                "October",
                                                                                                                                "November",
                                                                                                                                "December"
                                                                                                                        ],
                                                                                                                        "firstDay": 1
                                                                                                                },
                                                                                                                "linkedCalendars": true,
                                                                                                                "showCustomRangeLabel": false,
                                                                                                                "startDate": 1,
                                                                                                                "endDate": "December 31, 2016 @ h:mm A",
                                                                                                                "opens": "center"
                                                                                                        });
                                                                                            </script>-->