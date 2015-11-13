<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['pname']))
	header('Location: index.php');
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Correlation Analysis";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["composite"]["active"] = true;
//$page_nav["graphs"]["flot"]["active"] = true;
include("inc/nav.php");

?>

<?php

if(isset($_GET)){
	
	$f = $_GET['plotoptions'];
	$rs = $_GET['rs'];
	$field1 = $_GET['field1'];
	$field2 = $_GET['field2'];
	$cmd = "Rscript -e 'x <- \"".join(', ', $_SESSION[$f[0]])."\"; y <- \"".join(', ', $_SESSION[$f[1]])."\"; source(\"pearson_cor.r\")'";
	$pvalue = shell_exec($cmd);
	$pvalue = substr($pvalue, 3, strlen($pvalue));
	
}

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Composite Graphs"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><img src="img/network.png" width="40" height="30">&nbsp;&nbsp;Correlation Analysis</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<ul id="sparks" class="">
					<li class="sparks-info">
						<h5> Name <span class="txt-color-blue"><i class="fa fa-barcode" data-rel="bootstrap-tooltip" title="Versions"></i>&nbsp;&nbsp<?php echo $_SESSION["pname"]; ?></span></h5>
					</li>
					<li class="sparks-info">
						<h5> Versions <span class="txt-color-blue"><i class="fa fa-qrcode" data-rel="bootstrap-tooltip" title="Versions"></i>&nbsp;&nbsp<?php echo $_SESSION["versions"]; ?></span></h5>
					</li>
					<li class="sparks-info">
						<h5> Git path <span class="txt-color-purple"><i class="fa fa-code" data-rel="bootstrap-tooltip" title="Git Path"></i>&nbsp&nbsp<?php echo "<a href='".$_SESSION["githubpath"]."' target='_blank'>".$_SESSION["githubpath"]."</a>";?></span></h5>
					</li>
				</ul>
			</div>
		</div>
<div id="select_error" class='col-xs-12 col-sm-8 col-md-3 col-lg-3'> </div>	
<div class="row">
<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' >
<form id="plotoptions" method="GET" action="">	
<h3 class="text-muted">Select two options and &nbsp&nbsp<input type="submit" value="Plot" class='btn btn-success btn-lg'>  </h3>
<hr>
<h3>Graph Based Metrics</h3>
	<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox1" value="nodes" name="plotoptions[]"> Nodes
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox2" value="edges" name="plotoptions[]"> Edges
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox3" value="diameter" name="plotoptions[]"> Diameter
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox3" value="cc" name="plotoptions[]"> Clustering Coeficient
		</label>
<h3>Repository Metrics</h3>
	<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox1" value="authors" name="plotoptions[]"> Authors
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox2" value="commits" name="plotoptions[]"> Commits
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="linesAdded" name="plotoptions[]"> Lines Added
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="linesDeleted" name="plotoptions[]"> Lines Deleted
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="filesAdded" name="plotoptions[]"> Files Added
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="filesDeleted" name="plotoptions[]"> Files Deleted
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="filesModified" name="plotoptions[]"> Files Modified
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="testFilesAdded" name="plotoptions[]"> Test Files Added
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="testFilesModified" name="plotoptions[]"> Test Files Modified
			</label>
<h3>Source Code Metrics</h3>
	<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox1" value="cbo" name="plotoptions[]"> CBO
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox2" value="lcom" name="plotoptions[]"> LCOM
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="wmc" name="plotoptions[]"> WMC
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="nom" name="plotoptions[]"> NOM
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="nof" name="plotoptions[]"> NOF
			</label>
			<p>
			<input type="hidden" id="rsvalue" name="rs" value="" />
			<input type="hidden" id="field1" name="field1" value="" />
			<input type="hidden" id="field2" name="field2" value="" />
</form>
<hr>
</div>							
							
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
							<div class='well well-sm well-light padding-50'>
								<h4 class='txt-color-green'><?php if(isset($f)){ echo $field1. " VS "; } ?> <span> <?php echo $field2; ?></span> <a href='javascript:void(0);' class='pull-right txt-color-green'></a></h4>
								<br>
									<div id="rvalues"> </div>
									<div id="plots">
								<?php
									if(isset($f)){
										echo "correlation coefficient = ". $rs."<br>";
										echo "p-value = ". $pvalue;
										if($pvalue<=0.01)
											echo " <span class='text-muted'>(Correlation is significant at the 0.01 level)</span>";
										else if($pvalue<=0.05)
											echo " <span class='text-muted'>(Correlation is significant at the 0.05 level)</span>";
										else
											echo " <span class='text-muted'>(Correlation is not statistically significant)</span>";
										// echo "<strong>".$f[0]. "</strong>: ".join(', ', $_SESSION[$f[0]]);
										// echo "<p><strong>".$f[1]. "</strong>: ".join(', ', $_SESSION[$f[1]]);
										 echo "<p><div class='sparkline' 
											data-sparkline-type='compositeline' 
											data-sparkline-spotradius-top='5' 
											data-sparkline-color-top='#3a6965' 
											data-sparkline-line-width-top='3' 
											data-sparkline-color-bottom='#2b5c59' 
											data-sparkline-spot-color='#2b5c59' 
											data-sparkline-minspot-color-top='#97bfbf' 
											data-sparkline-maxspot-color-top='#c2cccc' 
											data-sparkline-highlightline-color-top='#cce8e4' 
											data-sparkline-highlightspot-color-top='#9dbdb9' 
											data-sparkline-width='96%' 
											data-sparkline-height='78px' 
											data-sparkline-line-val='[".join(', ', $_SESSION[$f[0]])."]'
											data-sparkline-bar-val='[".join(', ', $_SESSION[$f[1]])."]'>
										</div> ";
																				
									}
								?>


									</div>
							</div>
						</div>
						<div class="row">	
							<div class='col-xs-12 col-sm-8 col-md-6 col-lg-8' style="margin-top: 50px; margin-left:10px;">
								<?php	
										if(isset($f)){	
											echo "<table id='datatable_tabletools' class='table table-striped table-hover' >
													<thead>
														<tr>
															<th>Version</th>
															<th>".$f[1]."</th>
															<th>".$f[0]."</th>
														</tr>
													</thead>
												<tbody>";
											foreach ($_SESSION[$f[1]] as $key=>$value){
												  echo "<tr>";
												  echo "<td>" . $_SESSION["versions_array"][$key] . "</td>";
												  echo "<td>" . $value . "</td>";
												  echo "<td>" . $_SESSION[$f[0]][$key] . "</td>";
												  echo "</tr>";
												}	
												  
											echo "</tbody>
											  </table>";
										}	  
								?>		
							</div>	
						</div>				
</div>							
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>	

<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables-cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColReorder.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/FixedColumns.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ZeroClipboard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/media/js/TableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/DT_bootstrap.js"></script>
<script>
		var nodes = new Array();
		var edges = new Array();
		var diameter = new Array();
		var cc = new Array();
		var authors = new Array();
		var commits = new Array();
		var linesAdded = new Array();
		var linesDeleted = new Array();
		var filesAdded = new Array();
		var filesDeleted = new Array();
		var filesModified = new Array();
		var testFilesAdded = new Array();
		var testFilesModified = new Array();
		var cbo = new Array();
		var lcom = new Array();
		var wmc = new Array();
		var nom = new Array();
		var nof = new Array();
		var fieldArrays = new Array();

$(document).ready(function() {
	 
		 //------------------------ DATATABLE TOOLS --------------------------
		 /* Add the events etc before DataTables hides a column */
		$("#datatable_fixed_column thead input").keyup(function() {
			oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $("thead input").index(this)));
		});

		$("#datatable_fixed_column thead input").each(function(i) {
			this.initVal = this.value;
		});
		$("#datatable_fixed_column thead input").focus(function() {
			if (this.className == "search_init") {
				this.className = "";
				this.value = "";
			}
		});
		$("#datatable_fixed_column thead input").blur(function(i) {
			if (this.value == "") {
				this.className = "search_init";
				this.value = this.initVal;
			}
		});		
		

		var oTable = $('#datatable_fixed_column').dataTable({
			"sDom" : "<'dt-top-row'><'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			//"sDom" : "t<'row dt-wrapper'<'col-sm-6'i><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'>>",
			"oLanguage" : {
				"sSearch" : "Search all columns:"
			},
			"bSortCellsTop" : true
		});		
		


		/*
		 * COL ORDER
		 */
		$('#datatable_col_reorder').dataTable({
			"sPaginationType" : "bootstrap",
			"sDom" : "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			"fnInitComplete" : function(oSettings, json) {
				$('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns <i class="icon-arrow-down"></i>');
			}
		});
		
		/* END COL ORDER */

		/* TABLE TOOLS */
		$('#datatable_tabletools').dataTable({
			"sDom" : "<'dt-top-row'Tlf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
			"oTableTools" : {
				"aButtons" : ["copy", "print", {
					"sExtends" : "collection",
					"sButtonText" : 'Save <span class="caret" />',
					"aButtons" : ["csv", "xls", "pdf"]
				}],
				"sSwfPath" : "<?php echo ASSETS_URL; ?>/js/plugin/datatables/media/swf/copy_csv_xls_pdf.swf"
			},
			"fnInitComplete" : function(oSettings, json) {
				$(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function() {
					$(this).addClass('btn-sm btn-default');
				});
			}
		});
	});	
		
$( "#plotoptions" ).on('submit', function(e) { 
				var arr = [];
				 var checkedBoxes = $("#plotoptions input:checked").each(function(){
					arr.push($(this).val());
				});
				if(checkedBoxes.length>2){ // if nothing selected
					$('#select_error').show();
					$('#select_error').html("<div class='alert alert-error'>"+
					"<a class='close' data-dismiss='alert'>x</a> <h4>More than two options Selected</h4>"+
					"<p>Select two options and press Plot</p></div>");
					return false;	
				}else if (checkedBoxes.length<2){	
					$('#select_error').show();
						$('#select_error').html("<div class='alert alert-error'>"+
						"<a class='close' data-dismiss='alert'>x</a> <h4>Less than two options Selected</h4>"+
						"<p>Select two options and press Plot</p></div>");
						return false;	
				}else{
						var rs = calculateR(arr[0], arr[1]);
						$("#field1").val(arr[1]);
						$("#field2").val(arr[0]);
						$("#rsvalue").val(rs);
						
					}
			});

	function calculateR(f1, f2){
				fieldArrays = [];
				php2Js(f1);
				php2Js(f2);
				var correlationValue = mathUtils.getPearsonsCorrelation(fieldArrays[0], fieldArrays[1]);
				// var rsquaredValue = linearRegression(fieldArrays[0], fieldArrays[1]);
				// alert(correlationValue);
				return correlationValue.toFixed(4);;
			//	$("#plots").html("");
			//	$("#plots").load("_/php/_combine_graphs.php?f1="+field1+"&f2="+field2);
}



//php to Javascript array Variables
	
		

 function php2Js(flag){
	
	switch(flag) {
			case "nodes":
				<?php foreach($_SESSION['nodes'] as $key=>$value){
					echo "nodes[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(nodes);
				break;
			case "edges":
				<?php foreach($_SESSION['edges'] as $key=>$value){
					echo "edges[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(edges);
				break;
			case "diameter":
				<?php foreach($_SESSION['diameter'] as $key=>$value){
					echo "diameter[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(diameter);
				break;	
			case "cc":
				<?php foreach($_SESSION['cc'] as $key=>$value){
					echo "cc[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(cc);
				break;	
			case "authors":
				<?php foreach($_SESSION['authors'] as $key=>$value){
					echo "authors[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(authors);
				break;	
			case "commits":
				<?php foreach($_SESSION['commits'] as $key=>$value){
					echo "commits[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(commits);
				break;	
			case "linesAdded":
				<?php foreach($_SESSION['linesAdded'] as $key=>$value){
					echo "linesAdded[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(linesAdded);
				break;	
			case "linesDeleted":
				<?php foreach($_SESSION['linesDeleted'] as $key=>$value){
					echo "linesDeleted[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(linesDeleted);
				break;
			case "filesAdded":
				<?php foreach($_SESSION['filesAdded'] as $key=>$value){
					echo "filesAdded[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(filesAdded);
				break;
			case "filesDeleted":
				<?php foreach($_SESSION['filesDeleted'] as $key=>$value){
					echo "filesDeleted[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(filesDeleted);
				break;
			case "filesModified":
				<?php foreach($_SESSION['filesModified'] as $key=>$value){
					echo "filesModified[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(filesModified);
				break;
			case "testFilesAdded":
				<?php foreach($_SESSION['testFilesAdded'] as $key=>$value){
					echo "testFilesAdded[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(testFilesAdded);
				break;
			case "testFilesModified":
				<?php foreach($_SESSION['testFilesModified'] as $key=>$value){
					echo "testFilesModified[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(testFilesModified);
				break;		
			case "cbo":
				<?php foreach($_SESSION['cbo'] as $key=>$value){
					echo "cbo[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(cbo);
				break;	
			case "lcom":
				<?php foreach($_SESSION['lcom'] as $key=>$value){
					echo "lcom[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(lcom);
				break;		
			case "wmc":
				<?php foreach($_SESSION['wmc'] as $key=>$value){
					echo "wmc[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(wmc);
				break;	
			case "nom":
				<?php foreach($_SESSION['nom'] as $key=>$value){
					echo "nom[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(nom);
				break;
			case "nof":
				<?php foreach($_SESSION['nof'] as $key=>$value){
					echo "nof[".$key."]=".$value.";";
				} ?>
				fieldArrays.push(nof);
				break;	
	}
}

var mathUtils = {};
 
mathUtils.getPearsonsCorrelation = function(x, y) 
{
	var shortestArrayLength = 0;
	if(x.length == y.length)
	{
		shortestArrayLength = x.length;
	}
	else if(x.length > y.length)
	{
		shortestArrayLength = y.length;
		console.error('x has more items in it, the last ' + (x.length - shortestArrayLength) + ' item(s) will be ignored');
	}
	else
	{
		shortestArrayLength = x.length;
		console.error('y has more items in it, the last ' + (y.length - shortestArrayLength) + ' item(s) will be ignored');
	}
 
	var xy = [];
	var x2 = [];
	var y2 = [];
 
	for(var i=0; i<shortestArrayLength; i++)
	{
		xy.push(x[i] * y[i]);
		x2.push(x[i] * x[i]);
		y2.push(y[i] * y[i]);
	}
 
	var sum_x = 0;
	var sum_y = 0;
	var sum_xy = 0;
	var sum_x2 = 0;
	var sum_y2 = 0;
 
	for(var i=0; i<shortestArrayLength; i++)
	{
		sum_x += x[i];
		sum_y += y[i];
		sum_xy += xy[i];
		sum_x2 += x2[i];
		sum_y2 += y2[i];
	}
 
	var step1 = (shortestArrayLength * sum_xy) - (sum_x * sum_y);
	var step2 = (shortestArrayLength * sum_x2) - (sum_x * sum_x);
	var step3 = (shortestArrayLength * sum_y2) - (sum_y * sum_y);
	var step4 = Math.sqrt(step2 * step3);
	var answer = step1 / step4;
 
	return answer;
}

function linearRegression(y,x){
		var lr = {};
		var n = y.length;
		var sum_x = 0;
		var sum_y = 0;
		var sum_xy = 0;
		var sum_xx = 0;
		var sum_yy = 0;
		
		for (var i = 0; i < y.length; i++) {
			
			sum_x += x[i];
			sum_y += y[i];
			sum_xy += (x[i]*y[i]);
			sum_xx += (x[i]*x[i]);
			sum_yy += (y[i]*y[i]);
		} 
		
		lr['slope'] = (n * sum_xy - sum_x * sum_y) / (n*sum_xx - sum_x * sum_x);
		lr['intercept'] = (sum_y - lr.slope * sum_x)/n;
		lr['r2'] = Math.pow((n*sum_xy - sum_x*sum_y)/Math.sqrt((n*sum_xx-sum_x*sum_x)*(n*sum_yy-sum_y*sum_y)),2);
		
		return lr;
}


	
</script>
