<?php session_start(); 

include('connection.php');
				
$sql="SELECT * FROM invpara";
$result=mysql_query($sql, $dbinv);
$row = mysql_fetch_array($result);
if ($row["master_dev"]=="1"){
	$_SESSION["dev"]="0";
}


if ($_SESSION["dev"]!=""){
?>
<?php date_default_timezone_set('Asia/Colombo'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Debit Note - AP</title>
<?php
	if ($_SESSION["dev"]=="0"){ 
		echo "<link media=\"screen\" rel=\"stylesheet\" type=\"text/css\" href=\"css/admin_min.css\"  />";
	} else if ($_SESSION["dev"]=="1"){ 
		echo "<link media=\"screen\" rel=\"stylesheet\" type=\"text/css\" href=\"css/admin_min1.css\"  />";
	}	
?>	
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->


<script language="JavaScript" src="js/crn.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
<!--[if !IE]>end head<![endif]-->
		
<!--[if !IE]>start content<![endif]-->
<div id="content">
			
			
			
			
			
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
				<div class="inner">
					
	<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Debit Note - AP</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
												<!--[if !IE]>start dashboard menu<![endif]-->
												<ul class="dashboard_menu">
													<li><a class="d2" onClick="new_crn();" ><span>New</span></a></li>
													
										            <li><a class="d4" onClick="save_crn();"><span>Save</span></a></li>
													<li><a class="d5" onClick="delete_crn();" ><span>Cancel</span></a></li>
													<li><a class="d6" onClick="print_inv();"><span>Print</span></a></li>
													<li><a href="#" class="d12" onClick="openGL();"><span>Chk GL</span></a></li>
													<li><a class="d8" onclick="close_form();"><span>Close</span></a></li>
													
													
												</ul>
												<!--[if !IE]>end dashboard menu<![endif]-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>				
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
					  <!--[if !IE]>end title wrapper<![endif]-->
					  <!--[if !IE]>start section content<![endif]-->
		 
		      <!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper1">
							
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
										
												
												
											
													<!--[if !IE]>start fieldset<![endif]-->
													
														<!--[if !IE]>start forms<![endif]-->
														
														
														
														<?php
				include('ap_crn_details.php');
			?>
													
														
														
													
														<!--[if !IE]>end forms<![endif]-->
														
													
													<!--[if !IE]>end fieldset<![endif]-->
													
													
													
													
											
												<!--[if !IE]>end forms<![endif]-->	
												
												<!--[if !IE]>start system messages<![endif]-->												<!--[if !IE]>end system messages<![endif]-->
														
												
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					
					
					
						
				</div>
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]--><!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>
		<!--[if !IE]>end content<![endif]-->
		
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
	<!--[if !IE]>start footer<![endif]-->
	
	<!--[if !IE]>end footer<![endif]-->
	
</body>

<script type="text/javascript">
/*! table-to-json - v0.13.0 - Daniel White */
!function(a){"use strict";a.fn.tableToJSON=function(b){var c={ignoreColumns:[],onlyColumns:null,ignoreHiddenRows:!0,ignoreEmptyRows:!1,headings:null,allowHTML:!1,includeRowId:!1,textDataOverride:"data-override",extractor:null,textExtractor:null};b=a.extend(c,b);var d=function(a){return void 0!==a&&null!==a},e=function(a){return void 0!==a&&a.length>0},f=function(c){return d(b.onlyColumns)?-1===a.inArray(c,b.onlyColumns):-1!==a.inArray(c,b.ignoreColumns)},g=function(b,c){var f={},g=0;return a.each(c,function(a,c){g<b.length&&d(c)&&(e(b[g])&&(f[b[g]]=c),g++)}),f},h=function(c,d,e){var f,g=a(d),h=b.extractor||b.textExtractor,i=g.attr(b.textDataOverride);return null===h||e?a.trim(i||(b.allowHTML?g.html():d.textContent||g.text())||""):a.isFunction(h)?(f=i||h(c,g),"string"==typeof f?a.trim(f):f):"object"==typeof h&&a.isFunction(h[c])?(f=i||h[c](c,g),"string"==typeof f?a.trim(f):f):a.trim(i||(b.allowHTML?g.html():d.textContent||g.text())||"")},i=function(c,d){var e=[],f=b.includeRowId,g="boolean"==typeof f?f:"string"==typeof f,i="string"==typeof f==!0?f:"rowId";return g&&void 0===a(c).attr("id")&&e.push(i),a(c).children("td,th").each(function(a,b){e.push(h(a,b,d))}),e},j=function(a){var c=a.find("tr:first").first();return d(b.headings)?b.headings:i(c,!0)};return function(c,e){var i,j,k,l,m,n,o,p=[],q=0,r=[];return c.children("tbody,*").children("tr").each(function(c,e){if(c>0||d(b.headings)){var f=b.includeRowId,g="boolean"==typeof f?f:"string"==typeof f;n=a(e);var r=n.find("td").length===n.find("td:empty").length;!n.is(":visible")&&b.ignoreHiddenRows||r&&b.ignoreEmptyRows||n.data("ignore")&&"false"!==n.data("ignore")||(q=0,p[c]||(p[c]=[]),g&&(q+=1,void 0!==n.attr("id")?p[c].push(n.attr("id")):p[c].push("")),n.children().each(function(){for(o=a(this);p[c][q];)q++;if(o.filter("[rowspan]").length)for(k=parseInt(o.attr("rowspan"),10)-1,m=h(q,o),i=1;i<=k;i++)p[c+i]||(p[c+i]=[]),p[c+i][q]=m;if(o.filter("[colspan]").length)for(k=parseInt(o.attr("colspan"),10)-1,m=h(q,o),i=1;i<=k;i++)if(o.filter("[rowspan]").length)for(l=parseInt(o.attr("rowspan"),10),j=0;j<l;j++)p[c+j][q+i]=m;else p[c][q+i]=m;m=p[c][q]||h(q,o),d(m)&&(p[c][q]=m),q++}))}}),a.each(p,function(c,h){if(d(h)){var i=d(b.onlyColumns)||b.ignoreColumns.length?a.grep(h,function(a,b){return!f(b)}):h,j=d(b.headings)?e:a.grep(e,function(a,b){return!f(b)});m=g(j,i),r[r.length]=m}}),r}(this,j(this))}}(jQuery);
</script>

<script src="js/table_json.js"></script>
</html>
<?php
} else {
	echo "Invalied User !!!"; 
}



?>