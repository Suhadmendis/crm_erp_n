<?php
//session_start();
?>
<script src="https://unpkg.com/vue"></script>
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Delivery Note / Packing List</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">


                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group-sm">

                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; NEW
                    </a>

                    <a  onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a>
                    <!-- <a  id="save_inv_top" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; SAVE
                    </a> -->

                 

                 

                    <a onclick="//delete1();" class="btn btn-danger btn-sm" disabled="disabled">
                        <span class="glyphicon glyphicon-trash"></span> &nbsp; DELETE
                    </a>

                    <a onclick="NewWindow('search_deliverynote.php?stname=code', 'mywin', '800', '700', 'yes', 'center');" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-search"></span> &nbsp; FIND
                    </a>

                    <a onclick="print();" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-print"></span> &nbsp; PRINT
                    </a>

            
                </div>
                <hr>
                <div id="msg_box" class="span12 text-center"></div>



                <div class="form-group"></div>
                <div class="form-group-sm">
                    <label class="col-sm-2" for="c_code">Reference</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Job Code"  id="refno" class="form-control  input-sm" disabled="">
                        <input type="text" placeholder="Job Code"  id="uniq" class="form-control hidden input-sm" disabled="">
                    </div>
                </div>
               
                <div class="form-group-sm">
                    <label class="col-sm-2" for="c_code">Customer</label>

                    <div class="col-sm-2">
                        <input type="text" placeholder="Customer" onchange="" id="cus_txt" class="form-control  input-sm">
                    </div>

                     <label class="col-sm-2" for="c_code">Date</label>

                    <div class="col-sm-2">
                        <input type="date" placeholder="Date" onchange="" id="date_txt" class="form-control  input-sm">
                    </div>


                    <div class="form-group"></div>
                    <div class="form-group-sm">
                        <label class="col-sm-2" for="c_code">Address</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Address" onchange="" id="addr_txt" class="form-control  input-sm">
                        </div>
                        
                        <label class="col-sm-2" for="c_code">Costing Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Costing Ref" onchange="" id="costingref_txt" class="form-control  input-sm">
                        </div>
                        <label class="col-sm-2" for="c_code">Dispatch Ref</label>
                        <div class="col-sm-2">
                            <input type="text" placeholder="Dispatch Ref" onchange="" id="dis_ref" class="form-control  input-sm">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    <div class="form-grou-sm">
                      <label class="col-sm-2" for="c_code">JB NO :</label>
                        <div class="col-sm-2 form-group-sm">
                            <input type="text" placeholder="JB NO :" id="jobno_txt" class="form-control  input-sm">
                        </div>
                    <div class="col-sm-1">
                        <a onfocus="this.blur()" onclick="NewWindow('search_joborder.php?stname=DEL_note', 'mywin', '800', '700', 'yes', 'center');
                                return false" href="">
                            <input type="button" class="btn btn-default" value="...">
                        </a>
                    </div>
                     <div class="col-sm-3"></div>
                     <label class="col-sm-2" for="c_code">PO No</label>
                        <div class="col-sm-2 form-group-sm">
                            <input type="text" placeholder="PO No" id="pono_txt" class="form-control  input-sm">
                        </div>
                    </div>

                 

                   
     

                 
                    

                </div>
        </form>


<br><br><br>
<div class="Container" id="app">

        
            
                <table id="inputheader" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20%;"><input v-model="H1" id="H1"></th>
                            <th style="width: 20%;"><input v-model="H2" id="H2"></th>
                            <th style="width: 10%;"><input v-model="H3" id="H3"></th>
                            <th style="width: 50%;"><input v-model="H4" id="H4"></th>
                            <th style="width: 20%;"><input v-model="H5" id="H5"></th>
                        </tr>
                    </thead>
                   

                </table>

             
          


        <div id="beTable">
            <div id="getTable">
                <table id="myTable" class="table table-bordered" contenteditable>
                    <thead>
                        <tr>
                            <th style="width: 20%;" contenteditable="false">{{H1}}</th>
                            <th style="width: 20%;" contenteditable="false">{{H2}}</th>
                            <th style="width: 10%;" contenteditable="false">{{H3}}</th>
                            <th style="width: 30%;" contenteditable="false">{{H4}}</th>
                            <th style="width: 20%;" contenteditable="false">{{H5}}</th>
                            <th style="width: 50%;" onclick="addRow();" >+</th>
                        </tr>
                    </thead>
                   

                </table>

              </div>
          </div>

                    <div class="form-group"></div>
                    <div class="form-grou-sm">
                      <label class="col-sm-2" for="c_code"></label>
                        <div class="col-sm-2 form-group-sm">
                          
                        </div>
                    <div class="col-sm-1">
                       
                    </div>
                     <div class="col-sm-3"></div>
                     <label class="col-sm-2" for="c_code">Total Qty</label>
                        <div class="col-sm-2 form-group-sm">
                            <input type="text" id="totQty" class="form-control  input-sm">
                        </div>
                    </div>




</div>



        <div class="row">
            <div class="col-md-8" id="mattable">

            </div>


        </div>
    </div>

</section>
<script src="js/deliverynote.js"></script>

<script type="text/javascript">
/*! table-to-json - v0.13.0 - Daniel White */
!function(a){"use strict";a.fn.tableToJSON=function(b){var c={ignoreColumns:[],onlyColumns:null,ignoreHiddenRows:!0,ignoreEmptyRows:!1,headings:null,allowHTML:!1,includeRowId:!1,textDataOverride:"data-override",extractor:null,textExtractor:null};b=a.extend(c,b);var d=function(a){return void 0!==a&&null!==a},e=function(a){return void 0!==a&&a.length>0},f=function(c){return d(b.onlyColumns)?-1===a.inArray(c,b.onlyColumns):-1!==a.inArray(c,b.ignoreColumns)},g=function(b,c){var f={},g=0;return a.each(c,function(a,c){g<b.length&&d(c)&&(e(b[g])&&(f[b[g]]=c),g++)}),f},h=function(c,d,e){var f,g=a(d),h=b.extractor||b.textExtractor,i=g.attr(b.textDataOverride);return null===h||e?a.trim(i||(b.allowHTML?g.html():d.textContent||g.text())||""):a.isFunction(h)?(f=i||h(c,g),"string"==typeof f?a.trim(f):f):"object"==typeof h&&a.isFunction(h[c])?(f=i||h[c](c,g),"string"==typeof f?a.trim(f):f):a.trim(i||(b.allowHTML?g.html():d.textContent||g.text())||"")},i=function(c,d){var e=[],f=b.includeRowId,g="boolean"==typeof f?f:"string"==typeof f,i="string"==typeof f==!0?f:"rowId";return g&&void 0===a(c).attr("id")&&e.push(i),a(c).children("td,th").each(function(a,b){e.push(h(a,b,d))}),e},j=function(a){var c=a.find("tr:first").first();return d(b.headings)?b.headings:i(c,!0)};return function(c,e){var i,j,k,l,m,n,o,p=[],q=0,r=[];return c.children("tbody,*").children("tr").each(function(c,e){if(c>0||d(b.headings)){var f=b.includeRowId,g="boolean"==typeof f?f:"string"==typeof f;n=a(e);var r=n.find("td").length===n.find("td:empty").length;!n.is(":visible")&&b.ignoreHiddenRows||r&&b.ignoreEmptyRows||n.data("ignore")&&"false"!==n.data("ignore")||(q=0,p[c]||(p[c]=[]),g&&(q+=1,void 0!==n.attr("id")?p[c].push(n.attr("id")):p[c].push("")),n.children().each(function(){for(o=a(this);p[c][q];)q++;if(o.filter("[rowspan]").length)for(k=parseInt(o.attr("rowspan"),10)-1,m=h(q,o),i=1;i<=k;i++)p[c+i]||(p[c+i]=[]),p[c+i][q]=m;if(o.filter("[colspan]").length)for(k=parseInt(o.attr("colspan"),10)-1,m=h(q,o),i=1;i<=k;i++)if(o.filter("[rowspan]").length)for(l=parseInt(o.attr("rowspan"),10),j=0;j<l;j++)p[c+j][q+i]=m;else p[c][q+i]=m;m=p[c][q]||h(q,o),d(m)&&(p[c][q]=m),q++}))}}),a.each(p,function(c,h){if(d(h)){var i=d(b.onlyColumns)||b.ignoreColumns.length?a.grep(h,function(a,b){return!f(b)}):h,j=d(b.headings)?e:a.grep(e,function(a,b){return!f(b)});m=g(j,i),r[r.length]=m}}),r}(this,j(this))}}(jQuery);
</script>

<script type="text/javascript">
 /**
 * table-to-json
 * jQuery plugin that reads an HTML table and returns a javascript object representing the values and columns of the table
 *
 * @author Daniel White
 * @copyright Daniel White 2017
 * @license MIT <https://github.com/lightswitch05/table-to-json/blob/master/MIT-LICENSE>
 * @link https://github.com/lightswitch05/table-to-json
 * @module table-to-json
 * @version 0.13.0
 */
(function( $ ) {
  'use strict';

  $.fn.tableToJSON = function(opts) {

    // Set options
    var defaults = {
      ignoreColumns: [],
      onlyColumns: null,
      ignoreHiddenRows: true,
      ignoreEmptyRows: false,
      headings: null,
      allowHTML: false,
      includeRowId: false,
      textDataOverride: 'data-override',
      extractor: null,
      textExtractor: null
    };
    opts = $.extend(defaults, opts);

    var notNull = function(value) {
      return value !== undefined && value !== null;
    };
    
    var notEmpty = function(value) {
      return value !== undefined && value.length > 0;
    };
    
    var ignoredColumn = function(index) {
      if( notNull(opts.onlyColumns) ) {
        return $.inArray(index, opts.onlyColumns) === -1;
      }
      return $.inArray(index, opts.ignoreColumns) !== -1;
    };

    var arraysToHash = function(keys, values) {
      var result = {}, index = 0;
      $.each(values, function(i, value) {
        // when ignoring columns, the header option still starts
        // with the first defined column
        if ( index < keys.length && notNull(value) ) {
          if (notEmpty(keys[index])){
            result[ keys[index] ] = value;
          }
          index++;
        }
      });
      return result;
    };

    var cellValues = function(cellIndex, cell, isHeader) {
      var $cell = $(cell),
        // extractor
        extractor = opts.extractor || opts.textExtractor,
        override = $cell.attr(opts.textDataOverride),
        value;
      // don't use extractor for header cells
      if ( extractor === null || isHeader ) {
        return $.trim( override || ( opts.allowHTML ? $cell.html() : cell.textContent || $cell.text() ) || '' );
      } else {
        // overall extractor function
        if ( $.isFunction(extractor) ) {
          value = override || extractor(cellIndex, $cell);
          return typeof value === 'string' ? $.trim( value ) : value;
        } else if ( typeof extractor === 'object' && $.isFunction( extractor[cellIndex] ) ) {
          value = override || extractor[cellIndex](cellIndex, $cell);
          return typeof value === 'string' ? $.trim( value ) : value;
        }
      }
      // fallback
      return $.trim( override || ( opts.allowHTML ? $cell.html() : cell.textContent || $cell.text() ) || '' );
    };

    var rowValues = function(row, isHeader) {
      var result = [];
      var includeRowId = opts.includeRowId;
      var useRowId = (typeof includeRowId === 'boolean') ? includeRowId : (typeof includeRowId === 'string') ? true : false;
      var rowIdName = (typeof includeRowId === 'string') === true ? includeRowId : 'rowId';
      if (useRowId) {
        if (typeof $(row).attr('id') === 'undefined') {
          result.push(rowIdName);
        }
      }
      $(row).children('td,th').each(function(cellIndex, cell) {
        result.push( cellValues(cellIndex, cell, isHeader) );
      });
      return result;
    };

    var getHeadings = function(table) {
      var firstRow = table.find('tr:first').first();
      return notNull(opts.headings) ? opts.headings : rowValues(firstRow, true);
    };

    var construct = function(table, headings) {
      var i, j, len, len2, txt, $row, $cell,
        tmpArray = [], cellIndex = 0, result = [];
      table.children('tbody,*').children('tr').each(function(rowIndex, row) {
        if( rowIndex > 0 || notNull(opts.headings) ) {
          var includeRowId = opts.includeRowId;
          var useRowId = (typeof includeRowId === 'boolean') ? includeRowId : (typeof includeRowId === 'string') ? true : false;

          $row = $(row);

          var isEmpty = ($row.find('td').length === $row.find('td:empty').length) ? true : false;

          if( ( $row.is(':visible') || !opts.ignoreHiddenRows ) && ( !isEmpty || !opts.ignoreEmptyRows ) && ( !$row.data('ignore') || $row.data('ignore') === 'false' ) ) {
            cellIndex = 0;
            if (!tmpArray[rowIndex]) {
              tmpArray[rowIndex] = [];
            }
            if (useRowId) {
              cellIndex = cellIndex + 1;
              if (typeof $row.attr('id') !== 'undefined') {
                tmpArray[rowIndex].push($row.attr('id'));
              } else {
                tmpArray[rowIndex].push('');
              }
            }

            $row.children().each(function(){
              $cell = $(this);
              // skip column if already defined
              while (tmpArray[rowIndex][cellIndex]) { cellIndex++; }

              // process rowspans
              if ($cell.filter('[rowspan]').length) {
                len = parseInt( $cell.attr('rowspan'), 10) - 1;
                txt = cellValues(cellIndex, $cell);
                for (i = 1; i <= len; i++) {
                  if (!tmpArray[rowIndex + i]) { tmpArray[rowIndex + i] = []; }
                  tmpArray[rowIndex + i][cellIndex] = txt;
                }
              }
              // process colspans
              if ($cell.filter('[colspan]').length) {
                len = parseInt( $cell.attr('colspan'), 10) - 1;
                txt = cellValues(cellIndex, $cell);
                for (i = 1; i <= len; i++) {
                  // cell has both col and row spans
                  if ($cell.filter('[rowspan]').length) {
                    len2 = parseInt( $cell.attr('rowspan'), 10);
                    for (j = 0; j < len2; j++) {
                      tmpArray[rowIndex + j][cellIndex + i] = txt;
                    }
                  } else {
                    tmpArray[rowIndex][cellIndex + i] = txt;
                  }
                }
              }

              txt = tmpArray[rowIndex][cellIndex] || cellValues(cellIndex, $cell);
              if (notNull(txt)) {
                tmpArray[rowIndex][cellIndex] = txt;
              }
              cellIndex++;
            });
          }
        }
      });
      $.each(tmpArray, function( i, row ){
        if (notNull(row)) {
          // remove ignoredColumns / add onlyColumns
          var newRow = notNull(opts.onlyColumns) || opts.ignoreColumns.length ?
            $.grep(row, function(v, index){ return !ignoredColumn(index); }) : row,

            // remove ignoredColumns / add onlyColumns if headings is not defined
            newHeadings = notNull(opts.headings) ? headings :
              $.grep(headings, function(v, index){ return !ignoredColumn(index); });

          txt = arraysToHash(newHeadings, newRow);
          result[result.length] = txt;
        }
      });
      return result;
    };

    // Run
    var headings = getHeadings(this);
    return construct(this, headings);
  };
})( jQuery );

</script>


<script>newent();</script>
