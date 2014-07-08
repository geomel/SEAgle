<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
// require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Welcome To SEAgle";

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
        <div class="navbar-collapse navbar-right collapse">
			 <a href='javascript:void(0)' class='btn btn-sm btn-default' id="showTimeline" style="margin-top:10px; margin-right:20px"><i class='fa fa-arrow-down text-muted'></i> TIMELINE OVERVIEW</a>	
						<!-- Timeline Content -->
						<div class='smart-timeline'>	
							<ul class='smart-timeline-list'>
								<div id="ajax-timeline"> </div>					
						</div>
					<!-- END Timeline Content -->		
        </div><!--/.navbar-collapse -->
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<a href="index.php"><img src="img/seanets_logo_big.png" alt="SEAgle" class="img-responsive center-block" width="450" height="200" style="padding-top:100px; margin-bottom:0px;"></a>	
	</div>
</div>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
	
		
	?>

	<!-- MAIN CONTENT -->
	<div id="content" style="padding: 30px;" >	
		<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="input-group input-group-lg">
						<input type="text" class="form-control input-large"  placeholder="Search project or enter git repository (e.g. https://git-repo.com/user/example-project.git)" id="search-project" /> 
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default" id="search-button">
									&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
							</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-4 -->
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style="margin-left:30px;">	
								<span class="note"><span id="results">  </span>About <span id="execsqltime" style="margin-top:10px;"/> </span>
							<div id="search-res"></div>	
								<div id="status" class="font-lg text-success text-center"> </div>	
								<div id="mailnotification">
									<form id="order-form" class="smart-form" novalidate="novalidate" style="margin-top:30px;">
										<div class="row">
											<section class="col col-4">
											<h4>Your request may take some time to complete.</h4><span style="margin-top:10px"> You may enter your email below if you like to be notified when the analysis will complete.</span>
												<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
													<input type="email" name="email" placeholder="E-mail" id="email">
													<button class="btn btn-primary" id="mailbtn">
														Submit
													</button>
												</label>
											</section>
										</div>	
									</form>
								</div>
						</div>	
		
		</div>
		
	</div>
		
</div>
		

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
					 refreshTimeLine();
					 $('#ajax-timeline').toggle("slow");
				});
				
			$('#mailnotification').hide();	
			
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
		
		$("#mailbtn").click(function(e) {
			$.ajax({ url: '_/php/_sendmail.php?reciever=' + $('#email').val() });
			$('#mailnotification').hide();
			$('#search-res').show();
			document.getElementById("search-res").innerHTML = "Thank You.<p>A mail will be sent when the proccess will complete at: " + $('#email').val() ;
			
		});		
	})
	
 function removeSelectedClass(){
		$( "a" ).each(function( index ) {
				$( this ).removeClass( "fa fa-check" );
		});
} 

	function runJava(){
        openSocket();
		$('#mailnotification').show();
		$('#analyzebtn').hide();
		$('#search-res').hide();
		gpath = $('#search-project').val();
		$.ajax({ url: '_/php/_trigger_java.php?gitpath=' + gpath}); 
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
        url: "http://se.uom.gr/seagle/logs/"+gpath+".txt",
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

	
	
	
	
var webSocket;

//PRIN NA KALESEIS TO WEB SERVICE PREPEI NA ANOIKSEIS TO SOCKET KALWNTAS THN openSocket().

//AFOU TELEIOSEI H ANALYSH PREPEI NA KALESEIS THN closeSocket()

function openSocket() {
    // Ensures only one connection is open at a time
    if (webSocket !== undefined && webSocket.readyState !== WebSocket.CLOSED) {
        writeResponse("WebSocket is already opened.");
        return;
    }
    // Create a new instance of the websocket
    webSocket = new WebSocket("ws://se.uom.gr:8080/seanetsweb/loggerSocket");

    /**
     * Binds functions to the listeners for the websocket.
     */
    webSocket.onopen = function(event) {
        // For reasons I can't determine, onopen gets called twice
        // and the first time event.data is undefined.
        // Leave a comment if you know the answer.
        if (event.data === undefined)
            return;

        writeResponse(event.data);
    };

    webSocket.onmessage = function(event) {
		if(event.data=="Finished!"){
			writeResponse(event.data);
			closeSocket();
		}else
			writeResponse(event.data);	
    };

    webSocket.onclose = function(event) {
        writeResponse("Analysis is complete");
    };
}

/**
 * Sends the value of the text input to the server
 */
function send(text) {
    webSocket.send(text);
}

function closeSocket() {
    webSocket.close();
}

function writeResponse(text) {
    document.getElementById("status").innerHTML = "<br/>" + text;
}	
	
	
</script>

<?php 
	//include footer
	include("inc/footer.php"); 
?>