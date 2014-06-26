

<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Search Project";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id"=>"login", "class"=>"animated fadeInDown");
include("inc/header.php");
include("inc/scripts.php"); 

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<!--
<header id="header">
	

	<div id="logo-group">
		<span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SEANets"> </span>

		
	</div>

	<span id="login-header-space"> <span class="hidden-mobile">Need Help?</span> <a href="<?php echo APP_URL; ?>/registerr.php" class="btn btn-danger">See how it works</a> </span>
	

</header>

-->

<img src="img/seanets_logo_big.png" alt="SEANets" class="img-responsive center-block" width="600" height="200" >	

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		// $breadcrumbs["Home"] = "";
		// include("inc/ribbon.php");
	?>
	
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">

		<!-- row -->
		
		<div class="row">
						
							
			<div class="col-sm-12">
						
					<ul id="myTab1" class="nav nav-tabs bordered">
						<li class="active">
							<a href="#s1" data-toggle="tab">Search Git ProJects</a>
						</li>
						<li>
							<a href="#s2" data-toggle="tab">Instantly download and analyze a new project from a Git repository</a>
						</li>
						
						<!--
						<li>
							<a href="#s3" data-toggle="tab">Search History</a>
						</li>
							-->
						<li class="pull-right hidden-mobile">
							<a href="#" onclick="storeResults(0,9);"> <span class="note"><span id="results">  </span>About <span id="execsqltime"/> </span> </a>
						</li>
					</ul>
				
				<div id="myTabContent1" class="tab-content bg-color-white padding-10">
					<div class="tab-pane fade in active" id="s1">
						<h1> Search <span class="semi-bold" id="filtertext">Everything</span></h1>
						<br>
						<div class="input-group input-group-lg hidden-mobile">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Filter <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="#" id="f0" class="fa fa-check">&nbspEverything</a>
									</li>
									<li class="divider"></li>
									<li >
										<a href="#" id="f1">&nbspNodes</a>
									</li>
									<li>
										<a href="#" id="f2">&nbspEdges</a>
									</li>
									<li>
										<a href="#" id="f3">&nbspVersions</a>
									</li>
								</ul>
							</div>
							<input class="form-control input-large" type="text" placeholder="Search project..." id="search-project">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default" id="search-button">
									&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
								</button>
							</div>
						</div>
		
						<div id="search-res"></div>
		
				
						
						<div class="text-center">
							<hr>
							<ul class="pagination no-margin">
								<li class="prev disabled">
									<a href="javascript:void(0);">Previous</a>
								</li>
								<li class="active">
									<a href="javascript:void(0);">1</a>
								</li>
								<li>
									<a href="javascript:void(0);">2</a>
								</li>
								<li>
									<a href="javascript:void(0);">3</a>
								</li>
								<li>
									<a href="javascript:void(0);">4</a>
								</li>
								<li>
									<a href="javascript:void(0);">5</a>
								</li>
								<li class="next">
									<a href="javascript:void(0);">Next</a>
								</li>
							</ul>
							<br>
							<br>
							<br>
						</div>
		
					</div>	


				<div class="tab-pane fade" id="s2">
					<form class="smart-form">
						<h1>Enter Git Repository URL to <span class="semi-bold">Download and Analyze</span></h1>
						<p>
						<section style="margin-top: 20px;">
								<label class="input"> <i class="icon-prepend fa fa-question-circle"></i>
									<input type="text" id="gitpath" placeholder="eg. https://github.com/geomel/example-project.git">
									<b class="tooltip tooltip-top-left">
										<i class="fa fa-warning txt-color-teal"></i> 
										Enter a Git Repository URL to download and analyze it</b> 
								</label>
								
						</section>
								<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> DownLoading... please wait" class="btn btn-success btn-lg btn-block" onclick="runJava()">Download And Analyze
									<i style="margin-left: 10px" class="fa fa-download"></i>
								</button> 
					</form>
					
						<div id="server_data" class="text-info"> </div>
					
				</div>
		
				</div>
		
			</div>
		
		</div>
		
		<!-- end row -->
		

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
	//include("_/_searchScripts.php");
	
	
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	$(document).ready(function() {
			$("#f0").click(function(e){
				removeSelectedClass();
				$( "#f0" ).addClass( "fa fa-check" );
				$( "#filtertext" ).html('Everything');
				e.preventDefault();
			});
			$("#f1").click(function(e){
				removeSelectedClass();
				$( "#f1" ).addClass( "fa fa-check" );
				$( "#filtertext" ).html('Nodes');
				e.preventDefault();
			});
			$("#f2").click(function(e){
				removeSelectedClass();
				$( "#f2" ).addClass( "fa fa-check" );
				$( "#filtertext" ).html('Edges');
				e.preventDefault();
			});
			$("#f3").click(function(e){
				removeSelectedClass();
				$( "#f3" ).addClass( "fa fa-check" );
				$( "#filtertext" ).html('Versions');
				e.preventDefault();
			});
	
		
		$("#search-project").focus();	
		$("#search-res").load("_/php/_search.php");
		$("#execsqltime").load("_/php/_search.php #sqltime");
			$('#search-project').keyup(function(e) {
				$("#search-res").load("_/php/_search.php?val=" + $("#search-project").val(),function (text, statusText){
				$("#execsqltime").load("_/php/_search.php #sqltime");
					if (statusText === "success")
				{
					
				}
        });				
			  });
			$("#search-button").click(function(){
				$("#search-res").load("_/php/_search.php?val=" + $("#search-project").val());
			});	
		//	$( "$results" ).text()=$( "$numresults" ).text();
	})
	
 function removeSelectedClass(){
		$( "a" ).each(function( index ) {
				$( this ).removeClass( "fa fa-check" );
		});
} 

	function runJava(){
	gpath = $('#gitpath').val();
	$.ajax({ url: '_/php/_readServerLog.php?gitpath=' + gpath
	});
   setTimeout(function() {readServerLog(gpath);}, 2000);
	$('#downloadBtn').hide("slow");
	$('#gitpath').prop('disabled', true);
}

 function readServerLog(gpath){
/*
	if(show_hide_server_flag){
			$('#server_data').show("slow");
			show_hide_server_flag=0;
		} else{
			$('#server_data').hide("slow");
			show_hide_server_flag=1;
		}
	*/
	$.ajax({
        url: "../../seanets/"+gpath+".txt",
        dataType: 'text',
        success: function(text) {
         $("#server_data").html(text);
		 $("#server_data:contains(Finished!)").css("background","url(assets/css/img/done.png) right no-repeat #efefef")
			 setTimeout(readServerLog(gpath), 2000); // refresh every 2 seconds
        }
		
}).done(function() {
			$("#search-res").load("_/php/_search.php?val=" + "geomel");
		});
}	

</script>

<?php 
	//include footer
	include("inc/footer.php"); 
?>