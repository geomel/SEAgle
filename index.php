<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
// require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Welcome To SEANets";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id"=>"login", "class"=>"animated fadeInDown");
include("inc/header.php");
 
//include left panel (navigation)
//follow the tree in inc/config.ui.php



?>

<img src="img/seanets_logo_big.png" alt="SEANets" class="img-responsive center-block" width="600" height="200" >	
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
	
		
	?>

	<!-- MAIN CONTENT -->
	<div id="content" style="padding: 30px;">	
		<div class="row">
		<h1> Search <span class="semi-bold" id="filtertext">Everything</span></h1>
				
						<div class="input-group input-group-lg hidden-mobile">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Filter <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="="javascript:void(0)" id="f0" class="fa fa-check">&nbspEverything</a>
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
							<input class="form-control input-large" type="text" placeholder="Search project or enter git repository (e.g. https://git-repo.com/user/example-project.git)" id="search-project">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default" id="search-button">
									&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
								</button>
							</div>
						</div>
						<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9'>	
	
							<div id="search-res"></div>		
						</div>	
				
				<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3'>	
							
								<!-- Timeline Content -->
								<div class='smart-timeline'>
									<ul class='smart-timeline-list'>
										<div id="ajax-timeline"> </div>
										<li class='text-center'>
											<a href='javascript:void(0)' class='btn btn-sm btn-default' id="showTimeline"><i class='fa fa-arrow-down text-muted'></i> TIMELINE OVERVIEW</a>
										</li>
									</ul>
								</div>
								<!-- END Timeline Content -->
							
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
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	function refreshTimeLine(){
        $('#ajax-timeline').load('_/php/_timeline.php', function(){		
           // setTimeout(refreshTimeLine, 5000);
        });
    }

	$(document).ready(function() {
			$('#ajax-timeline').hide();
				$('#showTimeline').click(function() {
					 $('#ajax-timeline').toggle("slow");
				});
			
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
		refreshTimeLine();
			$('#search-project').keypress(function(e) {
				if(e.which == 13) {
					$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val()+"&filter_flag=0",function (text, statusText){
					$("#execsqltime").load("_/php/_search.php #sqltime");
						});	
			}	
			  });
			$("#search-button").click(function(){
				$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val()+"&filter_flag=0",function (text, statusText){
					$("#execsqltime").load("_/php/_search.php #sqltime");
						});	
			});	
		
		$("#analyzebtnn").click(function(e) {
			$.SmartMessageBox({
				title : "Notification Email",
				content : "Your query will take some time to download and analyze your project. Please enter your email address to inform you when the process will complete.",
				buttons : "[Cancel][Submit]",
				input : "text",
				placeholder : "johndoe@example.com"
			}, function(ButtonPress, Value) {
				if (ButtonPress == "Cancel") {
					alert("Are you sure you want to cancel that? :(");	
					e.preventDefault();
				}
	
				Value1 = Value.toUpperCase();
				ValueOriginal = Value;
				$.SmartMessageBox({
					title : "Hey! <strong>" + Value1 + ",</strong>",
					content : "And now please provide your password:",
					buttons : "[Login]",
					input : "password",
					placeholder : "Password"
				}, function(ButtonPress, Value) {
					alert("Username: " + ValueOriginal + " and your password is: " + Value);
				});
			});
	
			e.preventDefault();
		});		
	})
	
 function removeSelectedClass(){
		$( "a" ).each(function( index ) {
				$( this ).removeClass( "fa fa-check" );
		});
} 

	function runJava(){
		alert("run");
		gpath = $('#gitpath').val();
		alert("_/php/_trigger_java.php?gitpath=" + gpath);
		$.ajax({ url: '_/php/_trigger_java.php?gitpath=' + gpath
		});
	   setTimeout(function() {readServerLog(gpath.split("/").pop().slice(0,-4).toLowerCase())}, 2000); //trim and lowercase string
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
        url: "http://195.251.210.146/seanets/"+gpath+".txt",
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