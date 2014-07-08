<?php
//initilize the page
require_once("inc/init.php");
$page_title = "Welcome To SEAgle";
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id"=>"login", "class"=>"animated fadeInDown");
include("inc/header.php");

?>
        <div class="navbar-collapse navbar-right collapse">
			 <a href='javascript:void(0)' class='btn btn-sm btn-default' id="showTimeline" style="margin-top:10px; margin-right:20px"><i class='fa fa-arrow-down text-muted'></i> TIMELINE OVERVIEW</a>	
						<!-- Timeline Content -->
						<div class='smart-timeline'>	
							<ul class='smart-timeline-list'>
								<div id="ajax-timeline"> </div>					
						</div>
					<!-- END Timeline Content -->		
        </div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<a href="index.php"><img src="img/seanets_logo_big.png" alt="SEAgle" class="img-responsive center-block" width="450" height="200" style="padding-top:100px; margin-bottom:0px;"></a>	
	</div>
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
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-4 -->
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style="margin-left:30px;">	
								<span class="note"><span id="results">  </span>About <span id="execsqltime" style="margin-top:10px;"/> </span>
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
		

<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	include("inc/scripts.php"); 
?>

<script src="_/js/_index.js"></script>

<?php 
	include("inc/footer.php"); 
?>