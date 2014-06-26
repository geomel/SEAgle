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

$page_title = "The Team";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["team"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["The Team"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<!-- Bread crumb is created dynamically -->
		<!-- row -->
		<div class="row">
		
			<!-- col -->
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-file-o"></i> The team</h1>
			</div>
			<!-- end col -->
		
			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<!-- sparks 
				<ul id="sparks">
					<li class="sparks-info">
						<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
					<li class="sparks-info">
						<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
					<li class="sparks-info">
						<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
						<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
				</ul>
			 end sparks -->
			</div>
			<!-- end col -->
		
		</div>
		<!-- end row -->
		
		<!-- row -->
		
		<div class="row">
		
			<div class="col-sm-12">
		
		
					<div class="well well-sm">
		
						<div class="row">
		
							<div class="col-sm-12 col-md-12 col-lg-6">
								<div class="well well-light well-sm no-margin no-padding">
		
									<div class="row">
		
										<div class="col-sm-12">
											<div id="myCarousel" class="carousel fade profile-carousel">
												<div class="air air-bottom-right padding-10">
													<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm">Google Scholar</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Website</a>
												</div>
												<div class="air air-top-left padding-10">
													<h4 class="txt-color-white font-md"></h4>
												</div>
												<ol class="carousel-indicators">
													<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
													<li data-target="#myCarousel" data-slide-to="1" class=""></li>
													<li data-target="#myCarousel" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner">
													<!-- Slide 1 -->
													<div class="item active">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s1.jpg" alt="">
													</div>
													<!-- Slide 2 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s2.jpg" alt="">
													</div>
													<!-- Slide 3 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/m3.jpg" alt="">
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-sm-12">
		
											<div class="row">
		
												<div class="col-sm-3 profile-pic">
													<img src="<?php echo ASSETS_URL; ?>/img/avatars/alexander.jpg">
													
												</div>
												<div class="col-sm-6">
													<h1>Alexander <span class="semi-bold">Chatzigeorgiou</span>
													<br>
													<small> Associate Professor, Lab Head</small></h1>
		
													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;(<span class="txt-color-darken">2310</span>) <span class="txt-color-darken">891</span> - <span class="txt-color-darken">886</span>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:achat@uom.edu.gr">achat@uom.edu.gr</a>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">achat</span>
															</p>
														</li>
													</ul>
													<br>
												</div>	
													<div class="col-sm-12" style="padding:20px;">
														<p class="font-md">
															<i>Short CV</i>
														</p>
														<p>
			
															Alexander Chatzigeorgiou is an associate professor of software engineering in 
															the Department of Applied Informatics at the University of Macedonia, Thessaloniki, Greece. 
															He received the Diploma in Electrical Engineering and the PhD degree in Computer
			
														</p>
													</div>
													<br>
													<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>
													<br>
													<br>
		
												
									
		
											</div>
		
										</div>
		
									</div>
		
									<div class="row">
		

		
									</div>
									<!-- end row -->
		
								</div>
		
							</div><!-- ------------------------------------------------ END PROFILE CARD 1 ----------------------------------------------------->
							
							
							<div class="col-sm-12 col-md-12 col-lg-6">
								<div class="well well-light well-sm no-margin no-padding">
		
									<div class="row">
		
										<div class="col-sm-12">
											<div id="myCarousel" class="carousel fade profile-carousel">
												<div class="air air-bottom-right padding-10">
													<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm">Google Scholar</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Website</a>
												</div>
												<div class="air air-top-left padding-10">
													<h4 class="txt-color-white font-md"></h4>
												</div>
												<ol class="carousel-indicators">
													<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
													<li data-target="#myCarousel" data-slide-to="1" class=""></li>
													<li data-target="#myCarousel" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner">
													<!-- Slide 1 -->
													<div class="item active">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s1.jpg" alt="">
													</div>
													<!-- Slide 2 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s2.jpg" alt="">
													</div>
													<!-- Slide 3 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/m3.jpg" alt="">
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-sm-12">
		
											<div class="row">
		
												<div class="col-sm-3 profile-pic">
													<img src="<?php echo ASSETS_URL; ?>/img/avatars/teo.jpg">
												</div>
												<div class="col-sm-6">
													<h1>Theodore <span class="semi-bold">Chaikalis</span>
													<br>
													<small>PhD Candidate</small></h1>
		
													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;(<span class="txt-color-darken">2310</span>) <span class="txt-color-darken">891</span> - <span class="txt-color-darken">886</span>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:achat@uom.edu.gr">teohaik@gmail.com</a>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">achat</span>
															</p>
														</li>
													</ul>
													<br>
												</div>	
													<div class="col-sm-12" style="padding:20px;">
														<p class="font-md">
															<i>Short CV</i>
														</p>
														<p>
			
															Theodore Chaikalis received the B.Sc. and M.Sc. degrees in Applied Informatics from the University of Macedonia, 
															in 2007 and 2009, respectively. He is currently working toward the Ph.D. degree in the Department of Applied Informatics at the University...
			
														</p>
													</div>
													<br>
													<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>
													<br>
													<br>
		
												
									
		
											</div>
		
										</div>
		
									</div>
		
									<div class="row">
		

		
									</div>
									<!-- end row -->
		
								</div><!-- -------------------------------------------------------------- END PROFILE CARD 2 ----------------------------------------------------------------------->
							</div>	
							<div class="col-sm-12 col-md-12 col-lg-6">
								<div class="well well-light well-sm no-margin no-padding">
		
									<div class="row">
		
										<div class="col-sm-12">
											<div id="myCarousel" class="carousel fade profile-carousel">
												<div class="air air-bottom-right padding-10">
													<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm">Google Scholar</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Website</a>
												</div>
												<div class="air air-top-left padding-10">
													<h4 class="txt-color-white font-md"></h4>
												</div>
												<ol class="carousel-indicators">
													<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
													<li data-target="#myCarousel" data-slide-to="1" class=""></li>
													<li data-target="#myCarousel" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner">
													<!-- Slide 1 -->
													<div class="item active">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s1.jpg" alt="">
													</div>
													<!-- Slide 2 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s2.jpg" alt="">
													</div>
													<!-- Slide 3 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/m3.jpg" alt="">
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-sm-12">
		
											<div class="row">
		
												<div class="col-sm-3 profile-pic">
													<img src="<?php echo ASSETS_URL; ?>/img/avatars/giorgos.jpg">
												</div>
												<div class="col-sm-6">
													<h1>Giorgos <span class="semi-bold">Melas</span>
													<br>
													<small> PhD Candidate</small></h1>
		
													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;(<span class="txt-color-darken">2310</span>) <span class="txt-color-darken">891</span> - <span class="txt-color-darken">886</span>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:achat@uom.edu.gr">geomel@gmail.com</a>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">achat</span>
															</p>
														</li>
													</ul>
													<br>
												</div>	
													<div class="col-sm-12" style="padding:20px;">
														<p class="font-md">
															<i>Short CV</i>
														</p>
														<p>
			
															Giorgos Melas is currently working towards his PhD...
			
														</p>
													</div>
													<br>
													<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>
													<br>
													<br>
		
												
									
		
											</div>
		
										</div>
		
									</div>
		
									<div class="row">
		

		
									</div>
									<!-- end row -->
		
								</div>
		
							</div><!-- ---------------------------------------------------------------------------------END PROFILE CARD 3 ---------------------------------------------------------->
							
							<div class="col-sm-12 col-md-12 col-lg-6">
								<div class="well well-light well-sm no-margin no-padding">
		
									<div class="row">
		
										<div class="col-sm-12">
											<div id="myCarousel" class="carousel fade profile-carousel">
												<div class="air air-bottom-right padding-10">
													<a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm">Google Scholar</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Website</a>
												</div>
												<div class="air air-top-left padding-10">
													<h4 class="txt-color-white font-md"></h4>
												</div>
												<ol class="carousel-indicators">
													<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
													<li data-target="#myCarousel" data-slide-to="1" class=""></li>
													<li data-target="#myCarousel" data-slide-to="2" class=""></li>
												</ol>
												<div class="carousel-inner">
													<!-- Slide 1 -->
													<div class="item active">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s1.jpg" alt="">
													</div>
													<!-- Slide 2 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/s2.jpg" alt="">
													</div>
													<!-- Slide 3 -->
													<div class="item">
														<img src="<?php echo ASSETS_URL; ?>/img/demo/m3.jpg" alt="">
													</div>
												</div>
											</div>
										</div>
		
										<div class="col-sm-12">
		
											<div class="row">
		
												<div class="col-sm-3 profile-pic">
													<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png">
												</div>
												<div class="col-sm-6">
													<h1>Elvis <span class="semi-bold">Lingu</span>
													<br>
													<small> Master of Science</small></h1>
		
													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;(<span class="txt-color-darken">2310</span>) <span class="txt-color-darken">891</span> - <span class="txt-color-darken">886</span>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:achat@uom.edu.gr">elvis_ligu@hotmail.com</a>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">achat</span>
															</p>
														</li>
													</ul>
													<br>
												</div>	
													<div class="col-sm-12" style="padding:20px;">
														<p class="font-md">
															<i>Short CV</i>
														</p>
														<p>
			
															Elvis is a postgraduate student. His research interests include software repository mining, 
															service oriented architectures, software reusability and software testing
			
														</p>
													</div>
													<br>
													<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>
													<br>
													<br>
		
												
									
		
											</div>
		
										</div>
		
									</div>
		
									<div class="row">
		

		
									</div>
									<!-- end row -->
		
								</div>
		
							</div> <!-- --------------------------------------------- END POFILE CARD 4 ----------------------------------------------------------------->
		
							</div>
							
		
		
							</div>
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

<script>

	$(document).ready(function() {
		// PAGE RELATED SCRIPTS
	})

</script>

<?php 
	//include footer
	include("inc/footer.php"); 
?>