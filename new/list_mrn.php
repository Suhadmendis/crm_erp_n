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

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                                        height: 41px;
                                        padding: 15px;
                                        margin: 50px auto;
                                    }

                                </style>



                                <body>
                                    <?php
                                    $stname = "";
                                    if (isset($_GET["stname"])) {
                                        $stname = $_GET["stname"];
                                    }
                                    ?>
                                    <div class="container">


                                        <div class="col-md-2">
                                            <br>

                                                <div class="form-group"></div>
                                                <div class="form-group-sm">

                                                    <input class="button button2" type="button" onclick="tableToExcel('example', 'W3C Example Table')" value="Export to Excel">

                                                </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="row">
                                                <br>
                                                    <form id="form" name="form" class="form-inline">
                                                        
                                                        <div class="form-group">

                                                            <div class="col-md-6">
                                                                <label for="startDate">Start Date</label>
                                                                <input id="startDate" onchange="<?php echo "csChange('$stname');"; ?>" name="startDate" type="text" class="form-control" />
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="endDate">End Date</label>
                                                                <input id="endDate" onchange="<?php echo "csChange('$stname');"; ?>" name="endDate" type="text" class="form-control" />
                                                            </div>
                                                           
                                                        </div>
                                                    </form>

                                            </div>
                                        </div>




                                    </div>




                                    <!--                                                                                <h2> DATE AND TIME RANGE PICKER EXAMPLE </h2>
                                                                                                                    
                                    
                                                                                                                    <input type="text" id="demo" name="datefilter" value="" />-->


                                    <br>

                                        <div style="margin-left: 2%;margin-right: 2%;">
                                            <div id="getTable">

                                            </div>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                                        <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>


                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>






                                        <script>

                                                        var bindDateRangeValidation = function (f, s, e) {
                                                            if (!(f instanceof jQuery)) {
                                                                console.log("Not passing a jQuery object");
                                                            }

                                                            var jqForm = f,
                                                                    startDateId = s,
                                                                    endDateId = e;

                                                            var checkDateRange = function (startDate, endDate) {
                                                                var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
                                                                return isValid;
                                                            }

                                                            var bindValidator = function () {
                                                                var bstpValidate = jqForm.data('bootstrapValidator');
                                                                var validateFields = {
                                                                    startDate: {
                                                                        validators: {
                                                                            notEmpty: {message: 'This field is required.'},
                                                                            callback: {
                                                                                message: 'Start Date must less than or equal to End Date.',
                                                                                callback: function (startDate, validator, $field) {
                                                                                    return checkDateRange(startDate, $('#' + endDateId).val())
                                                                                }
                                                                            }
                                                                        }
                                                                    },
                                                                    endDate: {
                                                                        validators: {
                                                                            notEmpty: {message: 'This field is required.'},
                                                                            callback: {
                                                                                message: 'End Date must greater than or equal to Start Date.',
                                                                                callback: function (endDate, validator, $field) {
                                                                                    return checkDateRange($('#' + startDateId).val(), endDate);
                                                                                }
                                                                            }
                                                                        }
                                                                    },
                                                                    customize: {
                                                                        validators: {
                                                                            customize: {message: 'customize.'}
                                                                        }
                                                                    }
                                                                }
                                                                if (!bstpValidate) {
                                                                    jqForm.bootstrapValidator({
                                                                        excluded: [':disabled'],
                                                                    })
                                                                }

                                                                jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
                                                                jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);

                                                            };

                                                            var hookValidatorEvt = function () {
                                                                var dateBlur = function (e, bundleDateId, action) {
                                                                    jqForm.bootstrapValidator('revalidateField', e.target.id);
                                                                }

                                                                $('#' + startDateId).on("dp.change dp.update blur", function (e) {
                                                                    $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
                                                                    dateBlur(e, endDateId);
                                                                });

                                                                $('#' + endDateId).on("dp.change dp.update blur", function (e) {
                                                                    $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
                                                                    dateBlur(e, startDateId);
                                                                });
                                                            }

                                                            bindValidator();
                                                            hookValidatorEvt();
                                                        };


                                                        $(function () {
                                                            var sd = new Date(), ed = new Date();

                                                            $('#startDate').datetimepicker({
                                                                pickTime: false,
                                                                format: "YYYY/MM/DD",
                                                                defaultDate: sd,
                                                                maxDate: ed
                                                            });

                                                            $('#endDate').datetimepicker({
                                                                pickTime: false,
                                                                format: "YYYY/MM/DD",
                                                                defaultDate: ed,
                                                                minDate: sd
                                                            });

                                                            //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
                                                            bindDateRangeValidation($("#form"), 'startDate', 'endDate');
                                                        });
                                        </script>



                                        <script>
                                            $(document).ready(function () {
                                                // Setup - add a text input to each footer cell
                                                $('#example tfoot th').each(function (i) {
                                                    var title = $('#example thead th').eq($(this).index()).text();
                                                    $(this).html('<input type="text" placeholder="Search ' + title + '" data-index="' + i + '" />');
                                                });

                                                // DataTable
                                                var table = $('#example').DataTable({
                                                    scrollY: "300px",
                                                    scrollX: true,
                                                    scrollCollapse: true,
                                                    paging: false,
                                                    fixedColumns: true
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




                                        <!--
                                        <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
                                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
                                        <script src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js" type="text/javascript"></script>-->


                                        <script>

                                                    var tableToExcel = (function() {
                                                    var uri = 'data:application/vnd.ms-excel;base64,'
                                                            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
return function(table, name) {
if (!table.nodeType) table = document.getElementById(table)
var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
window.location.href = uri + base64(format(template, ctx))
}
})()
                                        </script>

                                </body>
                                </html>
                                <script language="JavaScript" src="js/list_mrn.js"></script>

                                <?php echo "<script>csChange('$stname');</script>"; ?>
              
