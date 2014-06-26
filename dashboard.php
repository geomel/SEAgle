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

$page_title = "Dashboard";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["dashboard"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		include("inc/ribbon.php");
	?>

<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard </h1>
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
	
				<!-- row -->
		<div class="row">
				<article class="col-sm-12">
					<!-- new widget -->
			<div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
			<h2 style="color:green; margin-top:20px"><span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>Software As A Network:</h2>	
				<section id="widget-grid" class="">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
						<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2999" data-widget-editbutton="false">
							<header style="margin-bottom:0px; margin-right:0px">
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Network Properties</h2>
						</header>
							<div class="show-stat-microcharts" style="margin-bottom:0px">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Nodes </h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["nodes"]);?>
														</div>
													</li>
												</ul>	
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Edges </h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["edges"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Diameter </h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["diameter"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Clustering Coeficient </h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["cc"]);?>
														</div>
													</li>
												</ul>
											</div>
								</div>								
							</div>
						</article>	

			<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3000" data-widget-editbutton="false">
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
										include ("_/php/dataclasses/san/_tableData.php"); 
									?>
								</div>
							</div>
						</div>	
				</article>
					
				</section>
							
								
							
							<h2 style="color:green; margin-top:30px"><span class="widget-icon"> <i class="fa fa-exchange"></i> </span>Commiters Activity:</h2>
								<section id="widget-grid" class="">
								<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
									<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3999" data-widget-editbutton="false">
										<header style="margin-bottom:0px; margin-right:0px">
										<span class="widget-icon"> <i class="fa fa-table"></i> </span>
										<h2>Development Activity</h2>
									</header>
								<div class="show-stat-microcharts" style="margin-bottom:0px">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5>Number Of Authors / Version</h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="transparent" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["authors"]);?>
														</div>
													</li>
												</ul>	
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Number Of Commits / Version</h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="transparent" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["commits"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Lines Added / Version</h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="transparent" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["linesAdded"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Lines Deleted / Version</h5>
														<div class="sparkline txt-color-green" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="transparent" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["linesDeleted"]);?>
														</div>
													</li>
												</ul>
											</div>
										
										
								</div>
								</article>
								</section>
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3000" data-widget-editbutton="false">
						
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
										include ("_/php/dataclasses/san/_commitersData.php"); 
									?>
								</div>
							</div>
						</div>	
				</article>
					<h2 style="color:green;"><span class="widget-icon"> <i class="fa fa-code"></i> </span>Software Metrics:</h2>	
							<section id="widget-grid" class="">
								<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
									<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3999" data-widget-editbutton="false">
										<header style="margin-bottom:0px; margin-right:0px">
											<span class="widget-icon"> <i class="fa fa-table"></i> </span>
											<h2>Metrics</h2>
										</header>						
								<div class="show-stat-microcharts" style="margin-bottom: 30px">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Number Of Methods </h5>
														<div class="sparkline txt-color-red" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["nom"]);?>
														</div>
													</li>
												</ul>	
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Number Of Fields </h5>
													<div class="sparkline txt-color-red" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["nof"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Coupling Between Objects </h5>
														<div class="sparkline txt-color-red" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["cbo"]);?>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
												<ul id="sparks" class="">
													<li class="sparks-info">
														<h5> Lack Of Cohesion Of Methods </h5>
														<div class="sparkline txt-color-red" data-sparkline-type="line" data-sparkline-width="180px" data-fill-color="" data-sparkline-spotradius="3" data-sparkline-height="40px">
															<?php echo join(', ', $_SESSION["lcom"]);?>
														</div>
													</li>
												</ul>
											</div>
										
								</div>

								<!-- end content -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3020" data-widget-editbutton="false">
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
												include ("_/php/dataclasses/san/_softwareMetrics.php"); 
											?>
										</div>
									</div>
					</div>	
				</article>
			
				

				</article>
			</div>
	</div>
			<!-- end row -->
	
	<div class='row'>
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<div class='well well-sm'>
					<!-- Timeline Content -->
					<div class='smart-timeline'>
						<ul class='smart-timeline-list'>
			<?php		
				include("_/php/_connections.php");
						$sql = "SELECT * FROM timeline, project WHERE project.pid=timeline.pid ORDER BY date DESC";

						$rs=$conn->query($sql);
						if($rs === false) {
						  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
						} else {
						  $rows_returned = $rs->num_rows;
						}
						$rs->data_seek(0);

						while($row = $rs->fetch_assoc()){	

						echo "<li>
								<div class='smart-timeline-icon bg-color-greenDark'>
									<i class='fa fa-bar-chart-o'></i>
								</div>
								<div class='smart-timeline-time'>
									<small>".$row['date']."</small>
								</div>
								<div class='smart-timeline-content'>
									<p>
										<strong class='txt-color-greenDark'>".$row['title']."</strong>
									</p>
									<p>
										<a href='_/php/_startProjectSession.php?pid=".$row['pid']."' onclick='storeResults(\"".$row['name']."\",\"".$row['pid']."\");'  class='btn btn-xs btn-primary'><i class='fa fa-file'></i>&nbsp;&nbsp". $row['name'] ."</a>
									</p>
								</div>
							</li>";
						}					
			?>
							<li class='text-center'>
								<a href='javascript:void(0)' class='btn btn-sm btn-default'><i class='fa fa-arrow-down text-muted'></i> LOAD MORE</a>
							</li>
						</ul>
					</div>
					<!-- END Timeline Content -->
				</div>		
			</div>		
	</div>

	
	
	
	
	
	
	
	
</div>	
	
<?php 
	//include required scripts 
	include("inc/scripts.php"); 
?>


<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.js"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- Full Calendar -->
		<!-- PAGE RELATED PLUGIN(S) -->
		<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables-cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColReorder.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/FixedColumns.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ColVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/ZeroClipboard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/media/js/TableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/DT_bootstrap.js"></script>

<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		 refreshTimeLine();
		 
		 
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
		
			/* TABLE TOOLS */
		$('#commitersMetricsTable').dataTable({
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
		
		$('#softMetricsTable').dataTable({
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
	
	function refreshTimeLine(){
        $('#ajax-timeline').load('_/php/_timeline.php', function(){		
           // setTimeout(refreshTimeLine, 5000);
        });
		
    }
</script>		


<?php 
	//include footer
	include("inc/footer.php"); 
?>
	