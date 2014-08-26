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

$page_title = "Graph Based Metrics";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["graphs"]["sub"]["san"]["active"] = true;
//$page_nav["graphs"]["flot"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Metrics"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><img src="img/network.png" width="40" height="30">&nbsp;&nbsp;Graph Based Metrics</h1>
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

		<!-- widget grid -->
<section id="widget-grid" class="">

			<!-- row -->
	<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3000" data-widget-editbutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
		
						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"
		
						-->
						<header style="margin-bottom:13px; margin-right:18px">
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Network Properties</h2>
		
						</header>
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body no-padding">
								<div class="widget-body-toolbar">
		
								</div>
								<div class="widget-body" style="margin-left:30px;">
									<?php
										include("_/php/_connections.php");
										include ("_/php/dataclasses/_graphBasedMetrics.php"); 
									?>
								</div>
							</div>
				</article>
	
			</div>

			<div class="row">
			
				<div id="charts_area">
				
				</div>
				
			</div>			
		</div>

			<!-- end row -->

			<!-- row -->
		

	</div>	

</section>
		<!-- end widget grid -->

	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>


<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.fillbetween.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.orderBar.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.pie.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.categories.js"></script>

<!-- Datatable scripts -->

		<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables-cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColReorder.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/FixedColumns.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ZeroClipboard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/media/js/TableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/DT_bootstrap.js"></script>


<script type="text/javascript">
	// PAGE RELATED SCRIPTS

	/* chart colors default */
	var $chrt_border_color = "#efefef";
	var $chrt_grid_color = "#DDD"
	var $chrt_main = "#E24913";
	/* red       */
	var $chrt_second = "#6595b4";
	/* blue      */
	var $chrt_third = "#FF9F01";
	/* orange    */
	var $chrt_fourth = "#7e9d3a";
	/* green     */
	var $chrt_fifth = "#BD362F";
	/* dark red  */
	var $chrt_mono = "#000";
	
	
	//php to Javascript array Variables
		//var versionsArray = new Array();
		var	nodesArray = new Array();
		var	edgesArray = new Array();
		var	diameterArray = new Array();
		var	ccArray = new Array();
		var	versionsArray = new Array();
		var edgesToNew = new Array();
		var edgesBtwnExisting = new Array();
		var edgesBtwnNew = new Array();
		var deletedEdges = new Array();
		var edgesToExisting = new Array();

 function php2Js(){
	<?php
			
			foreach($_SESSION['nodes'] as $key=>$value){
				echo "nodesArray[".$key."]=".$value.";";
			}
			foreach($_SESSION['edges'] as $key=>$value){
				echo "edgesArray[".$key."]=".$value.";";
			}
			foreach($_SESSION['diameter'] as $key=>$value){
				echo "diameterArray[".$key."]=".$value.";";
			}
			foreach($_SESSION['cc'] as $key=>$value){
				echo "ccArray[".$key."]=".$value.";";
			}
			foreach($_SESSION['edgesToNew'] as $key=>$value){
				echo "edgesToNew[".$key."]=".$value.";";
			}
			foreach($_SESSION['edgesBtwnExisting'] as $key=>$value){
				echo "edgesBtwnExisting[".$key."]=".$value.";";
			}
			foreach($_SESSION['edgesBtwnNew'] as $key=>$value){
				echo "edgesBtwnNew[".$key."]=".$value.";";
			}
			foreach($_SESSION['deletedEdges'] as $key=>$value){
				echo "deletedEdges[".$key."]=".$value.";";
			}			
			foreach($_SESSION['edgesToExisting'] as $key=>$value){
				echo "edgesToExisting[".$key."]=".$value.";";
			}
			$js_array = json_encode($_SESSION['versions_array']);
			echo "versions_array = ". $js_array . ";\n";
	?>
 }
  function createJSTableDataForGraphs(networkData){
		var j = 0;
		csvData ="";
	tableData = new Array(<?php echo count($_SESSION["versions_array"]) ?>);
	for (i = 0; i < tableData.length; ++i)
		tableData [i] = new Array(2);
	for(i=0; i<tableData.length;i++){
			tableData[j][0] = versions_array[i];
			tableData[j][1] = networkData[i];
			csvData += tableData[j][0] + "," + tableData[j][1] + "\n";
			j++;
	}	
		// networkPropertiesOverTime();
 }
 
 function addCharts(chartid, title, drawgraphid){

		var content = " <article class='col-xs-12 col-sm-12 col-md-12 col-lg-12'> " +
					  "	<div class='jarviswidget' id='wid-id-"+chartid+"' data-widget-editbutton='false'> " +
					  "	<header>" +
					  "		<span class='widget-icon'> <i class='fa fa-bar-chart-o'></i> </span>" +
					  "		<h2>"+title+"</h2> " +
					  "	</header> " +
					  "	<div> " +
					  "		<div class='jarviswidget-editbox'> " +
					  "		</div> " +
					  "		<div class='widget-body no-padding'> " +
					  "			<div id='"+drawgraphid+"' class='chart'></div> " +
					  "		</div> " +
					  "	</div> " +
					  "	</div> " +
					  "	</article>	";
			$( "#charts_area" ).append(content);		  

	}	
 function drawLinePlot(flag, ydata){
			// var d=tableData
			
			var options = {
				xaxis : {
					mode : "categories",
					tickLength : 10
				},
				series : {
					lines : {
						show : true,
						lineWidth : 2,
						fill : true,
						fillColor : {
							colors : [{
								opacity : 0.2
							}, {
								opacity : 0.15
							}]
						}
					},
					points: { show: true },
					shadowSize : 2
				},
				selection : {
					mode : "x"
				},
				grid : {
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				tooltip : true,
				tooltipOpts : {
					content : "<span>%y</span> "+ydata,
					
					defaultTheme : false
				},
				colors : [$chrt_second],

			};
				switch(flag) {
						case "1":
							var nodes_plot = $.plot($("#nodeschart"), [tableData], options);
							break;
						case "2":
							var edges_plot = $.plot($("#edgeschart"), [tableData], options);
							break;
						case "3":
							var diameter_plot = $.plot($("#diameterchart"), [tableData], options);
							break;	
						case "4":
							var cc_plot = $.plot($("#ccchart"), [tableData], options);
							break;
						case "5":
							var e2n_plot = $.plot($("#edgesToNewchart"), [tableData], options);
							break;
						case "6":
							var ebtwne_plot = $.plot($("#edgesBtwnExistingchart"), [tableData], options);
							break;
						case "7":
							var ebtwnn_plot = $.plot($("#edgesBtwnNewchart"), [tableData], options);
							break;	
						case "8":
							var e2e_plot = $.plot($("#edgesToExistingchart"), [tableData], options);
							break;		
						case "9":
							var del_plot = $.plot($("#deletedEdgeschart"), [tableData], options);
							break;
				}
			
			
			
		
 }
$(document).ready(function() {

		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		pageSetUp();
		php2Js();
		
		createJSTableDataForGraphs(nodesArray);
		addCharts("001","Nodes Over Time", "nodeschart");
		drawLinePlot("1", "nodes");
		createJSTableDataForGraphs(edgesArray);
		addCharts("002","Edges Over Time", "edgeschart");
		drawLinePlot("2", "edges");
		createJSTableDataForGraphs(diameterArray);
		addCharts("003","Diameter Over TIme", "diameterchart");
		drawLinePlot("3", "diameter");
		createJSTableDataForGraphs(ccArray);
		addCharts("004","Clustering Coefficient Over TIme", "ccchart");
		drawLinePlot("4", "cc");
		createJSTableDataForGraphs(edgesToNew);
		addCharts("005", "Edges To New Nodes", "edgesToNewchart");
		drawLinePlot("5", "edges");
		createJSTableDataForGraphs(edgesBtwnExisting);
		addCharts("006","Edges Between Existing Nodes", "edgesBtwnExistingchart");
		drawLinePlot("6", "edges");
		createJSTableDataForGraphs(edgesBtwnNew);
		addCharts("007","Edges Between New Nodes", "edgesBtwnNewchart");
		drawLinePlot("7", "edges");
		createJSTableDataForGraphs(edgesToExisting);
		addCharts("008","Edges To Existing Nodes", "edgesToExistingchart");
		drawLinePlot("8", "edges");
		createJSTableDataForGraphs(deletedEdges);
		addCharts("009","Deleted Edges", "deletedEdgeschart");
		drawLinePlot("9", "edges");
		
		
		/* sales chart */


		/* end sales chart */

		/* Sin chart */

		if ($("#sin-chart").length) {
			var sin = [], cos = [];
			for (var i = 0; i < 16; i += 0.5) {
				sin.push([i, Math.sin(i)]);
				cos.push([i, Math.cos(i)]);
			}

			var plot = $.plot($("#sin-chart"), [{
				data : sin,
				label : "sin(x)"
			}, {
				data : cos,
				label : "cos(x)"
			}], {
				series : {
					lines : {
						show : true
					},
					points : {
						show : true
					}
				},
				grid : {
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				tooltip : true,
				tooltipOpts : {
					//content : "Value <b>$x</b> Value <span>$y</span>",
					defaultTheme : false
				},
				colors : [$chrt_second, $chrt_fourth],
				yaxis : {
					min : -1.1,
					max : 1.1
				},
				xaxis : {
					min : 0,
					max : 15
				}
			});

			$("#sin-chart").bind("plotclick", function(event, pos, item) {
				if (item) {
					$("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
					plot.highlight(item.series, item.datapoint);
				}
			});
		}

		/* end sin chart */

		/* bar chart */

		if ($("#bar-chart").length) {

			var data1 = [];
			for (var i = 0; i <= 12; i += 1)
				data1.push([i, parseInt(Math.random() * 30)]);

			var data2 = [];
			for (var i = 0; i <= 12; i += 1)
				data2.push([i, parseInt(Math.random() * 30)]);

			var data3 = [];
			for (var i = 0; i <= 12; i += 1)
				data3.push([i, parseInt(Math.random() * 30)]);

			var ds = new Array();

			ds.push({
				data : data1,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 1,
				}
			});
			ds.push({
				data : data2,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 2
				}
			});
			ds.push({
				data : data3,
				bars : {
					show : true,
					barWidth : 0.2,
					order : 3
				}
			});

			//Display graph
			$.plot($("#bar-chart"), ds, {
				colors : [$chrt_second, $chrt_fourth, "#666", "#BBB"],
				grid : {
					show : true,
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				legend : true,
				tooltip : true,
				tooltipOpts : {
					content : "<b>%x</b> = <span>%y</span>",
					defaultTheme : false
				}

			});

		}

		/* end bar chart */

		/* bar-chart-h */
		if ($("#bar-chart-h").length) {
			//Display horizontal graph
			var d1_h = [];
			for (var i = 0; i <= 3; i += 1)
				d1_h.push([parseInt(Math.random() * 30), i]);

			var d2_h = [];
			for (var i = 0; i <= 3; i += 1)
				d2_h.push([parseInt(Math.random() * 30), i]);

			var d3_h = [];
			for (var i = 0; i <= 3; i += 1)
				d3_h.push([parseInt(Math.random() * 30), i]);

			var ds_h = new Array();
			ds_h.push({
				data : d1_h,
				bars : {
					horizontal : true,
					show : true,
					barWidth : 0.2,
					order : 1,
				}
			});
			ds_h.push({
				data : d2_h,
				bars : {
					horizontal : true,
					show : true,
					barWidth : 0.2,
					order : 2
				}
			});
			ds_h.push({
				data : d3_h,
				bars : {
					horizontal : true,
					show : true,
					barWidth : 0.2,
					order : 3
				}
			});

			// display graph
			$.plot($("#bar-chart-h"), ds_h, {
				colors : [$chrt_second, $chrt_fourth, "#666", "#BBB"],
				grid : {
					show : true,
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				legend : true,
				tooltip : true,
				tooltipOpts : {
					content : "<b>%x</b> = <span>%y</span>",
					defaultTheme : false
				}
			});

		}

		/* end bar-chart-h

		 /* fill chart */

		if ($("#fill-chart").length) {
			var males = {
				'15%' : [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6], [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9], [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]],
				'90%' : [[2, 96.8], [3, 105.2], [4, 113.9], [5, 120.8], [6, 127.0], [7, 133.1], [8, 139.1], [9, 143.9], [10, 151.3], [11, 161.1], [12, 164.8], [13, 173.5], [14, 179.0], [15, 182.0], [16, 186.9], [17, 185.2], [18, 186.3], [19, 186.6]],
				'25%' : [[2, 89.2], [3, 94.9], [4, 104.4], [5, 111.4], [6, 117.5], [7, 120.2], [8, 127.1], [9, 132.9], [10, 136.8], [11, 144.4], [12, 149.5], [13, 154.1], [14, 163.1], [15, 169.2], [16, 170.4], [17, 171.2], [18, 172.4], [19, 170.8]],
				'10%' : [[2, 86.9], [3, 92.6], [4, 99.9], [5, 107.0], [6, 114.0], [7, 113.5], [8, 123.6], [9, 129.2], [10, 133.0], [11, 140.6], [12, 145.2], [13, 149.7], [14, 158.4], [15, 163.5], [16, 166.9], [17, 167.5], [18, 167.1], [19, 165.3]],
				'mean' : [[2, 91.9], [3, 98.5], [4, 107.1], [5, 114.4], [6, 120.6], [7, 124.7], [8, 131.1], [9, 136.8], [10, 142.3], [11, 150.0], [12, 154.7], [13, 161.9], [14, 168.7], [15, 173.6], [16, 175.9], [17, 176.6], [18, 176.8], [19, 176.7]],
				'75%' : [[2, 94.5], [3, 102.1], [4, 110.8], [5, 117.9], [6, 124.0], [7, 129.3], [8, 134.6], [9, 141.4], [10, 147.0], [11, 156.1], [12, 160.3], [13, 168.3], [14, 174.7], [15, 178.0], [16, 180.2], [17, 181.7], [18, 181.3], [19, 182.5]],
				'85%' : [[2, 96.2], [3, 103.8], [4, 111.8], [5, 119.6], [6, 125.6], [7, 131.5], [8, 138.0], [9, 143.3], [10, 149.3], [11, 159.8], [12, 162.5], [13, 171.3], [14, 177.5], [15, 180.2], [16, 183.8], [17, 183.4], [18, 183.5], [19, 185.5]],
				'50%' : [[2, 91.9], [3, 98.2], [4, 106.8], [5, 114.6], [6, 120.8], [7, 125.2], [8, 130.3], [9, 137.1], [10, 141.5], [11, 149.4], [12, 153.9], [13, 162.2], [14, 169.0], [15, 174.8], [16, 176.0], [17, 176.8], [18, 176.4], [19, 177.4]]
			};

			var females = {
				'15%' : [[2, 84.8], [3, 93.7], [4, 100.6], [5, 105.8], [6, 113.3], [7, 119.3], [8, 124.3], [9, 131.4], [10, 136.9], [11, 143.8], [12, 149.4], [13, 151.2], [14, 152.3], [15, 155.9], [16, 154.7], [17, 157.0], [18, 156.1], [19, 155.4]],
				'90%' : [[2, 95.6], [3, 104.1], [4, 111.9], [5, 119.6], [6, 127.6], [7, 133.1], [8, 138.7], [9, 147.1], [10, 152.8], [11, 161.3], [12, 166.6], [13, 167.9], [14, 169.3], [15, 170.1], [16, 172.4], [17, 169.2], [18, 171.1], [19, 172.4]],
				'25%' : [[2, 87.2], [3, 95.9], [4, 101.9], [5, 107.4], [6, 114.8], [7, 121.4], [8, 126.8], [9, 133.4], [10, 138.6], [11, 146.2], [12, 152.0], [13, 153.8], [14, 155.7], [15, 158.4], [16, 157.0], [17, 158.5], [18, 158.4], [19, 158.1]],
				'10%' : [[2, 84.0], [3, 91.9], [4, 99.2], [5, 105.2], [6, 112.7], [7, 118.0], [8, 123.3], [9, 130.2], [10, 135.0], [11, 141.1], [12, 148.3], [13, 150.0], [14, 150.7], [15, 154.3], [16, 153.6], [17, 155.6], [18, 154.7], [19, 153.1]],
				'mean' : [[2, 90.2], [3, 98.3], [4, 105.2], [5, 112.2], [6, 119.0], [7, 125.8], [8, 131.3], [9, 138.6], [10, 144.2], [11, 151.3], [12, 156.7], [13, 158.6], [14, 160.5], [15, 162.1], [16, 162.9], [17, 162.2], [18, 163.0], [19, 163.1]],
				'75%' : [[2, 93.2], [3, 101.5], [4, 107.9], [5, 116.6], [6, 122.8], [7, 129.3], [8, 135.2], [9, 143.7], [10, 148.7], [11, 156.9], [12, 160.8], [13, 163.0], [14, 165.0], [15, 165.8], [16, 168.7], [17, 166.2], [18, 167.6], [19, 168.0]],
				'85%' : [[2, 94.5], [3, 102.8], [4, 110.4], [5, 119.0], [6, 125.7], [7, 131.5], [8, 137.9], [9, 146.0], [10, 151.3], [11, 159.9], [12, 164.0], [13, 166.5], [14, 167.5], [15, 168.5], [16, 171.5], [17, 168.0], [18, 169.8], [19, 170.3]],
				'50%' : [[2, 90.2], [3, 98.1], [4, 105.2], [5, 111.7], [6, 118.2], [7, 125.6], [8, 130.5], [9, 138.3], [10, 143.7], [11, 151.4], [12, 156.7], [13, 157.7], [14, 161.0], [15, 162.0], [16, 162.8], [17, 162.2], [18, 162.8], [19, 163.3]]
			};

			var dataset = [{
				label : 'female mean',
				data : females['mean'],
				lines : {
					show : true
				},
				color : "rgb(255,50,50)"
			}, {
				id : 'f15%',
				data : females['15%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : false
				},
				color : "rgb(255,50,50)"
			}, {
				id : 'f25%',
				data : females['25%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.2
				},
				color : "rgb(255,50,50)",
				fillBetween : 'f15%'
			}, {
				id : 'f50%',
				data : females['50%'],
				lines : {
					show : true,
					lineWidth : 0.5,
					fill : 0.4,
					shadowSize : 0
				},
				color : "rgb(255,50,50)",
				fillBetween : 'f25%'
			}, {
				id : 'f75%',
				data : females['75%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.4
				},
				color : "rgb(255,50,50)",
				fillBetween : 'f50%'
			}, {
				id : 'f85%',
				data : females['85%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.2
				},
				color : "rgb(255,50,50)",
				fillBetween : 'f75%'
			}, {
				label : 'male mean',
				data : males['mean'],
				lines : {
					show : true
				},
				color : "rgb(50,50,255)"
			}, {
				id : 'm15%',
				data : males['15%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : false
				},
				color : "rgb(50,50,255)"
			}, {
				id : 'm25%',
				data : males['25%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.2
				},
				color : "rgb(50,50,255)",
				fillBetween : 'm15%'
			}, {
				id : 'm50%',
				data : males['50%'],
				lines : {
					show : true,
					lineWidth : 0.5,
					fill : 0.4,
					shadowSize : 0
				},
				color : "rgb(50,50,255)",
				fillBetween : 'm25%'
			}, {
				id : 'm75%',
				data : males['75%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.4
				},
				color : "rgb(50,50,255)",
				fillBetween : 'm50%'
			}, {
				id : 'm85%',
				data : males['85%'],
				lines : {
					show : true,
					lineWidth : 0,
					fill : 0.2
				},
				color : "rgb(50,50,255)",
				fillBetween : 'm75%'
			}]

			$.plot($("#fill-chart"), dataset, {

				xaxis : {
					tickDecimals : 0
				},

				yaxis : {
					tickFormatter : function(v) {
						return v + " cm";
					}
				},

			});
		}

		/* end fill chart */

		/* pie chart */

		if ($('#pie-chart').length) {

			var data_pie = [];
			var series = Math.floor(Math.random() * 10) + 1;
			for (var i = 0; i < series; i++) {
				data_pie[i] = {
					label : "Series" + (i + 1),
					data : Math.floor(Math.random() * 100) + 1
				}
			}

			$.plot($("#pie-chart"), data_pie, {
				series : {
					pie : {
						show : true,
						innerRadius : 0.5,
						radius : 1,
						label : {
							show : false,
							radius : 2 / 3,
							formatter : function(label, series) {
								return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
							},
							threshold : 0.1
						}
					}
				},
				legend : {
					show : true,
					noColumns : 1, // number of colums in legend table
					labelFormatter : null, // fn: string -> string
					labelBoxBorderColor : "#000", // border color for the little label boxes
					container : null, // container (as jQuery object) to put legend in, null means default on top of graph
					position : "ne", // position of default legend container within plot
					margin : [5, 10], // distance from grid edge to default legend container within plot
					backgroundColor : "#efefef", // null means auto-detect
					backgroundOpacity : 1 // set to 0 to avoid background
				},
				grid : {
					hoverable : true,
					clickable : true
				},
			});

		}

		/* end pie chart */

		/* site stats chart */

		if ($("#site-stats").length) {

			var pageviews = [[1, 75], [3, 87], [4, 93], [5, 127], [6, 116], [7, 137], [8, 135], [9, 130], [10, 167], [11, 169], [12, 179], [13, 185], [14, 176], [15, 180], [16, 174], [17, 193], [18, 186], [19, 177], [20, 153], [21, 149], [22, 130], [23, 100], [24, 50]];
			var visitors = [[1, 65], [3, 50], [4, 73], [5, 100], [6, 95], [7, 103], [8, 111], [9, 97], [10, 125], [11, 100], [12, 95], [13, 141], [14, 126], [15, 131], [16, 146], [17, 158], [18, 160], [19, 151], [20, 125], [21, 110], [22, 100], [23, 85], [24, 37]];
			//console.log(pageviews)
			var plot = $.plot($("#site-stats"), [{
				data : pageviews,
				label : "Your pageviews"
			}, {
				data : visitors,
				label : "Site visitors"
			}], {
				series : {
					lines : {
						show : true,
						lineWidth : 1,
						fill : true,
						fillColor : {
							colors : [{
								opacity : 0.1
							}, {
								opacity : 0.15
							}]
						}
					},
					points : {
						show : true
					},
					shadowSize : 0
				},
				xaxis : {
					mode : "time",
					tickLength : 10
				},

				yaxes : [{
					min : 20,
					tickLength : 5
				}],
				grid : {
					hoverable : true,
					clickable : true,
					tickColor : $chrt_border_color,
					borderWidth : 0,
					borderColor : $chrt_border_color,
				},
				tooltip : true,
				tooltipOpts : {
					content : "%s for <b>%x:00 hrs</b> was %y",
					dateFormat : "%y-%0m-%0d",
					defaultTheme : false
				},
				colors : [$chrt_main, $chrt_second],
				xaxis : {
					ticks : 15,
					tickDecimals : 2
				},
				yaxis : {
					ticks : 15,
					tickDecimals : 0
				},
			});

		}

		/* end site stats */

		/* updating chart */

		if ($('#updating-chart').length) {

			// For the demo we use generated data, but normally it would be coming from the server
			var data = [], totalPoints = 200;
			function getRandomData() {
				if (data.length > 0)
					data = data.slice(1);

				// do a random walk
				while (data.length < totalPoints) {
					var prev = data.length > 0 ? data[data.length - 1] : 50;
					var y = prev + Math.random() * 10 - 5;
					if (y < 0)
						y = 0;
					if (y > 100)
						y = 100;
					data.push(y);
				}

				// zip the generated y values with the x values
				var res = [];
				for (var i = 0; i < data.length; ++i)
					res.push([i, data[i]])
				return res;
			}

			// setup control widget
			var updateInterval = 1000;
			$("#updating-chart").val(updateInterval).change(function() {
				var v = $(this).val();
				if (v && !isNaN(+v)) {
					updateInterval = +v;
					if (updateInterval < 1)
						updateInterval = 1;
					if (updateInterval > 2000)
						updateInterval = 2000;
					$(this).val("" + updateInterval);
				}
			});

			// setup plot
			var options = {
				yaxis : {
					min : 0,
					max : 100
				},
				xaxis : {
					min : 0,
					max : 100
				},
				colors : [$chrt_fourth],
				series : {
					lines : {
						lineWidth : 1,
						fill : true,
						fillColor : {
							colors : [{
								opacity : 0.4
							}, {
								opacity : 0
							}]
						},
						steps : false

					}
				}
			};
			var plot = $.plot($("#updating-chart"), [getRandomData()], options);

			function update() {
				plot.setData([getRandomData()]);
				// since the axes don't change, we don't need to call plot.setupGrid()
				plot.draw();

				setTimeout(update, updateInterval);
			}

			update();

		}

		/*end updating chart*/

	});

	/* end flot charts */

</script>


<!-- DataTable Scripts -->

<script type="text/javascript">

	$(document).ready(function() {
		
		/*
		 * BASIC
		 */
		$('#dt_basic').dataTable({
			"sPaginationType" : "bootstrap_full"
		});

		/* END BASIC */

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
			"aaSorting": [],
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

	/* END TABLE TOOLS */
	})

	
	
	function  networkPropertiesOverTime(){
		   var plot2 = $.jqplot ('nodes_time', [nodesArray], {
		  
			animate: true,
			 
			 animateReplot: true,
			  title: "Nodes Over Time",

			  axesDefaults: {
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			  },
			
			  axes: {
				xaxis: {
				  label: "Versions",
				  pad: 0,
				  tickOptions:{
					 formatString:'V%.0f'
				  } 
				},
				yaxis: {
				  label: "Nodes"
				}
			  },
			  highlighter: {
				show: true,
				sizeAdjust: 10
			  }
			});
}
</script>

<?php 
	//include footer
	include("inc/footer.php"); 
?>