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
$(document).ready(function() {
			
	});	
$("#replot").click(function(){
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
function drawPlot(field1, field2){
				$("#plots").html("");
				$("#plots").load("_/php/_combine_graphs.php?f1="+field1+"&f2="+field2);
}	
</script>
