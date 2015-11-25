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
		<button type="button" class="btn btn-labeled btn-success btn-lg" data-toggle="modal" data-target="#ModalVideo">
			<i class="fa fa-video-camera"></i>
				Instructional Video
		</button>	
		<button type="button" id="postbtn" class="btn btn-labeled btn-success btn-lg" data-toggle="modal">
			<i class="fa fa-video-camera"></i>
				Post
		</button>
		<button type="button" class="btn btn-labeled btn-success btn-lg" data-toggle="modal" data-target="#ModalRelatedPaper">
			<i class="fa fa-book"></i>
			Related Papers			
		</button>	
		<button type="button" class="btn btn-labeled btn-primary btn-lg" data-toggle="modal" data-target="#ModalReview">
			<i class="fa-history"></i>
			User Feedback			
		</button>	
	<div id="" class="pull-right" style="margin-top:0px">
		<span > <a href="documentation/index.html" target="_blank"> Documentation</a> </span>
	</div>
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
			<div id="searchControls">
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
												<i></i>All Projects</label>
											<!-- <label class="radio">
												<input type="radio" name="results-filter" value="1">
												<i></i>Minimum Number of Versions</label>
												-->
											<label class="radio">
												<input type="radio" name="results-filter" value="2">
												<i></i>TimeLine</label>	
										</div>
												
								</section>
							
							</div>
						</form>	
					</div>
			</div>
	<div class='col-lg-6 col-lg-offset-3' id="wiz">						
							<div class='widget-body fuelux'>							
								<div class='wizard'>
									<ul class='steps'>
										<li data-target='#step1' class='active'>
											<span class='badge badge-info'>1</span>Select Versions<span class='chevron'></span>
										</li>
										<li data-target='#step2'>
											<span class='badge'>2</span>Email notification<span class='chevron'></span>
										</li>
										<li data-target='#step3'>
											<span class='badge'>3</span>Ready<span class='chevron'></span>
										</li>
									</ul>
									<div class='actions'>
										<button type='button' class='btn btn-sm btn-primary btn-prev'>
											<i class='fa fa-arrow-left'></i>Prev
										</button>
										<button type='button' class='btn btn-sm btn-success btn-next' data-last='Go!'>
											Next<i class='fa fa-arrow-right'></i>
										</button>
									</div>
								</div>					
								<div class='step-content'>
									<form class='form-horizontal' id='fuelux-wizard' method='post'>
										<div class='step-pane active' id='step1'>
											<h3><strong>Step 1 </strong> - Select the versions you wish to analyze</h3>
												<div id='checkVersions'> 
													<input type='checkbox' id='selectall' checked>ALL
													<div id="loading">
														<img src="img\loading_.gif" width="200" height="100"></img>
														
													</div>	 
												</div>
										</div>
										<div class='step-pane' id='step2'>
											<h3><strong>Step 2 </strong> - Email notification on completion(Optional)</h3>
												<div class='center-block'>
													<div id='mailnotification'>
														<div class='row'>
															<section class='col col-4'>
															<h4>Your request may take some time to complete.</h4><span style='margin-top:10px'> <p>Enter your email below if you like to be notified when the analysis will complete.</span>
																<p><label class='input'> <i class='icon-append fa fa-envelope-o'></i>
																	<input type='email' name='email' placeholder='E-mail' id='email'>
																</label>
															</section>
														</div>
													</div>
													 <a href='#' class='btn btn-success btn-large' id='analyzebtn' onclick=''><i class='fa fa-cloud-download'></i> Start Analysing ".$search_value." Now</a><p>
												</div>
												
										</div>		
										<div class='step-pane' id='step3'>
											<h3><strong>Step 3 </strong> Go!</h3>
 <button class="btn btn-xl btn-block btn-success" type="button" onclick="runJava()"><i class='fa fa-cloud-download'></i><h5>&nbsp Start Analysing Now</h5></a><p>											
										</div>
									</form>
								</div>
							</div>						
	</div>
					
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style="margin-left:30px;">							
								
									<span class="note"><span id="results">  </span> <span id="execsqltime" style="margin-top:10px;"/> </span>
									<div class='smart-timeline'>	
										<ul class='smart-timeline-list'>
											<div id="ajax-timeline"> </div>					
									</div>
								<div id="search-res"></div>	
									<div id="status" class="muted text-center">
										
									</div>
						</div>				
		</div>
		
	</div>
</div>	
		<div class="modal fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">SEAgle Instructional Video</h4>
					</div>
					<div class="modal-body">
						<iframe width="560" height="315" src="//www.youtube.com/embed/SQKUw3XNilc" frameborder="0" allowfullscreen></iframe>
					</div>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div class="modal fade" id="ModalReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">SEAgle User Feedback</h4>
					</div>
					<div class="modal-body">
						<iframe src="https://docs.google.com/forms/d/1YR0AfZLrbS_jrEc7tp9hR6Cj_YLyd0UyzhE-7IrVU5g/viewform?embedded=true" width="560" height="500" frameborder="0" marginheight="0" marginwidth="0">Φόρτωση...</iframe>
					</div>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="ModalRelatedPaper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel2">Related Paper and Recommended Citation</h4>
					</div>
					<div class="modal-body">
				<p><strong>A. Chatzigeorgiou and G. Melas,</strong> <em>"Trends in Object-Oriented Software Evolution: Investigating Network Properties",</em> 34th International Conference on Software Engineering (ICSE'2012), 
					New Ideas & Emerging Results track (NIER), Zurich, Switzerland, June 2-9, 2012. (Acceptance ratio: 17.7%, 26/147)
					<a href="assets/slides/ICSE2012.ppt">Presentation Slides</a></p>
					<p><strong>T. Chaikalis, G. Melas and A. Chatzigeorgiou,</strong><em> "SEANets: Software Evolution Analysis with Networks",</em> 28th IEEE International Conference on Software Maintenance (ICSM'2012), Tool Demonstration Track, Riva del Garda, Trento, Italy, September 23rd - 30th, 2012.
					<a href="assets/papers/ICSM_2012.pdf">Download pdf</a></p>
                <p>
                    <strong>T. Chaikalis, E.Ligu, G. Melas and A. Chatzigeorgiou, </strong>
                    “Seagle: Effortless Software Evolution Analysis”
                    , 30th International Conference on Software Maintenance and Evolution (ICSME’2014), Tool Demonstraction Track, 
                    Victoria, British Columbia, Canada, Sept. 28 – Oct. 3, 2014. <a href="assets/papers/ICSME_2014.pdf" target="_blank">
					Download pdf </a>
                </p>
                <p>   
                    @inproceedings{chaikalis_seagle:_2014, <br>
                    address = {Victoria, British Columbia, Canada},<br>
                    series = {Tool Demonstration Track},<br>
                    title = {Seagle: Effortless Software Evolution Analysis},<br>
                    author = {Chaikalis, Theodore and Melas, George and Ligu, Elvis and Chatzigeorgiou, Alexander},<br>
                    month = sept-oct,<br>
                    year = {2014}, <br>
                    pages = {581--584}
                    }
                </p>
            </div>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
<!-- ==========================CONTENT ENDS HERE ==========================
<div id='page-content'> </div>
  <ul id='pagination-demo' class='pagination-sm'></ul>
  
 -->  
<?php 
	include("inc/scripts.php"); 
?>

<script src="_/js/_index.js"></script>
<script type="text/javascript">
	setTimeout(function(){var a=document.createElement("script");
	var b=document.getElementsByTagName("script")[0];
	a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0030/6226.js?"+Math.floor(new Date().getTime()/3600000);
	a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>
