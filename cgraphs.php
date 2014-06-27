<?php
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

$page_title = "Composite Diagrams";

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
				<h1 class="page-title txt-color-blueDark"><img src="img/network.png" width="40" height="30">&nbsp;&nbsp;Correlation Diagrams</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<ul id="sparks" class="">
					<li class="sparks-info">
						<h5> Name <span class="txt-color-blue"><i class="fa fa-barcode" data-rel="bootstrap-tooltip" title="Versions"></i>&nbsp;&nbsp<?php echo $_SESSION["pname"]; ?></span></h5>
					</li>
					<li class="sparks-info">
						<h5> Versions <span class="txt-color-blue"><i class="fa fa-barcode" data-rel="bootstrap-tooltip" title="Versions"></i>&nbsp;&nbsp<?php echo $_SESSION["versions"]; ?></span></h5>
					</li>
					<li class="sparks-info">
						<h5> Git path <span class="txt-color-purple"><i class="fa fa-code" data-rel="bootstrap-tooltip" title="Git Path"></i>&nbsp&nbsp<?php echo "<a href='".$_SESSION["githubpath"]."'>".$_SESSION["githubpath"]."</a>";?></span></h5>
					</li>
				</ul>
			</div>
		</div>
<div id="select_error"> </div>	
<div class="row">
<div class='col-xs-6 col-sm-4 col-md-4 col-lg-4' >
<form id="options">	
<a href='#' class='btn btn-success btn-large' id='replot'><i class='fa fa-cloud-download'></i>Replot</a>
<h3>Graph Metrics</h3>
	<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox1" value="nodes"> Nodes
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox2" value="edges"> Edges
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox3" value="diameter"> Diameter
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" id="inlineCheckbox3" value="cc"> Clustering Coeficient
		</label>
<h3>Development Metrics</h3>
	<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox1" value="authors"> Authors
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox2" value="commits"> Commits
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="linesAdded"> Lines Added
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="linesDeleted"> Lines Deleted
			</label>
<h3>Software Metrics</h3>
	<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox1" value="cbo"> CBO
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox2" value="lcom"> LCOM
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="wmc"> WMC
			</label>
			<label class="checkbox-inline">
			  <input type="checkbox" id="inlineCheckbox3" value="nom"> NOM
			</label>
			<p>
</form>
</div>							
							
						<div class='col-xs-6 col-sm-8 col-md-8 col-lg-8' >
							<div class='well well-sm well-light padding-50'>
								<h4 class='txt-color-green'>Composite <span class='semi-bold'>Chart</span> <a href='javascript:void(0);' class='pull-right txt-color-green'><i class='fa fa-refresh'></i></a></h4>
								<br>
									<div id="plots"> </div>
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
<script>
		var nodes = new Array();
		var edges = new Array();
		var diameter = new Array();
		var cc = new Array();
		var authors = new Array();
		var commits = new Array();
		var linesAdded = new Array();
		var linesDeleted = new Array();
		var cbo = new Array();
		var lcom = new Array();
		var wmc = new Array();
		var nom = new Array();
		var fieldArrays = new Array();
		
$(document).on('click', '#replot', function(e) {
				e.preventDefault();
				 var checkedBoxes = $("#options input:checked");
				if(checkedBoxes.length>2){ // if nothing selected
					$('#select_error').show();
					$('#select_error').html("<div class='alert alert-error'>"+
					"<a class='close' data-dismiss='alert'>x</a> <h4>More than two options Selected</h4>"+
					"<p>Select two options and press replot</p></div>");
					return;	
				}else{
					 var values = [];
					$('#options input:checked').each(function() {
						values.push(this.value);
					});
					drawPlot(values[0], values[1]);
				}
			});

$(document).ready(function() {
	$(document).ajaxStop(function(){
		
		});
	});	
	
	function drawPlot(field1, field2){
				fieldArrays = [];
				php2Js(field1);
				php2Js(field2);
				var correlationValue = mathUtils.getPearsonsCorrelation(fieldArrays[0], fieldArrays[1]);
				var rsquaredValue = linearRegression(fieldArrays[0], fieldArrays[1]);
				alert(correlationValue);
				alert(rsquaredValue.r2);
				$("#plots").html("");
				$("#plots").load("_/php/_combine_graphs.php?f1="+field1+"&f2="+field2);
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
