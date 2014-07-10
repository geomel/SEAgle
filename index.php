<?php
//initilize the page
require_once("inc/init.php");
$page_title = "Welcome To SEAgle";
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id"=>"login", "class"=>"animated fadeInDown");
include("inc/header.php");

?>
	<div style="padding:20px;">	
		<button type="button" class="btn btn-labeled btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-video-camera"></i>
				Instructional Video
		</button>	
	</div>	
	<div class="col-lg-6 col-lg-offset-3">
		<a href="index.php"><img src="img/seanets_logo_big.png" alt="SEAgle" class="img-responsive center-block" width="450" height="200" style="padding-top:20px; margin-bottom:20px;"></a>	
	</div>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
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
						
					</div><!-- /input-group -->
				</div><!-- /.col-lg-4 -->
				<div class="col-lg-6 col-lg-offset-3">
					<form class="smart-form" >	
						<div class="ell">
								<section style="margin-top:10px;">
										<div class="inline-group" style="margin-left:5px;">
											<label class="radio">
												<input type="radio" name="results-filter"  value="0">
												<i></i>Show All Projects</label>
											<label class="radio">
												<input type="radio" name="results-filter" value="1">
												<i></i>Minimum Number of Versions</label>
											<label class="radio">
												<input type="radio" name="results-filter" value="2">
												<i></i>Show TimeLine</label>	
										</div>		
								</section>
							
							</div>
						</form>	
					</div>	
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style="margin-left:30px;">	
								<span class="note"><span id="results">  </span> <span id="execsqltime" style="margin-top:10px;"/> </span>
								<div class='smart-timeline'>	
									<ul class='smart-timeline-list'>
										<div id="ajax-timeline"> </div>					
								</div>
							<div id="search-res"></div>	
								<div id="status" class="font-lg text-success text-center">
									
								</div>	
								<div id="mailnotification">
									<form id="order-form" class="smart-form" novalidate="novalidate" style="margin-top:30px;">
										<div class="row">
											<section class="col col-4">
											<h4>Your request may take some time to complete.</h4><span style="margin-top:10px"> You may enter your email below if you like to be notified when the analysis will complete.</span>
												<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
													<input type="email" name="email" placeholder="E-mail" id="email">
													<button class="btn btn-primary btn-large" id="mailbtn">
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
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">SEAgle Instructional Video</h4>
					</div>
					<div class="modal-body">
						<iframe width="560" height="315" src="//www.youtube.com/embed/ALqPT9IsTrQ" frameborder="0" allowfullscreen></iframe>
					</div>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	include("inc/scripts.php"); 
?>

<script src="_/js/_index.js"></script>
