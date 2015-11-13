<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">


		<title> <?php echo $page_title != "" ? $page_title." - " : ""; ?> Effortless Software Evolution Analysis</title>
		<meta name="description" content="Effortless Software Evolution Analysis for java based projects that live in git repositories">
		<meta name="author" content="uom">
		
			
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/font-awesome.min.css">

		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/production.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/skins.css">
		<?php

			if ($page_css) {
				foreach ($page_css as $css) {
					echo '<link rel="stylesheet" type="text/css" media="screen" href="'.ASSETS_URL.'/css/'.$css.'">';
				}
			}
		?>

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/demo.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

	
		<link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
	</head>
	<body 
		<?php 
			if ($page_body_prop) {
				foreach ($page_body_prop as $prop_name => $value) {
					echo $prop_name.'="'.$value.'" ';
				}
			}

		?>
	>	
		<?php
			if (!$no_main_header) {

		?>	
				<header id="header">
					<div id="logo-group">
					<span id="logo"><a href="sess_destroy.php"><img src="<?php echo ASSETS_URL; ?>/img/seanets_logo_big.png"></a> </span>
	
					</div>
					<div id="project-context">
						
						<span class="label">Projects:</span>
						<span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Recent Visited projects <i class="fa fa-angle-down"></i></span>						
						<ul class="dropdown-menu">		
								<div id="recent-projects" style="padding:10px;">
									
								</div>
								<li class="divider"></li>			
								<li><a href="#" onclick="sessionStorage.clear(); location.reload();"><i class="fa fa-power-off"></i> Clear List</a></li>	
						</ul>		
					</div>
					<!-- end projects dropdown -->
					<!-- pulled right: nav area -->
					<div class="pull-right">

						<!-- collapse menu button -->
						<div id="hide-menu" class="btn-header pull-right">
							<span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
						</div>
						<!-- end collapse menu -->
						<!-- fullscreen button -->
						<div id="fullscreen" class="btn-header transparent pull-right">
							<span> <a href="javascript:void(0);" onclick="launchFullscreen(document.documentElement);" title="Full Screen"><i class="fa fa-fullscreen"></i></a> </span>
						</div>
						<div id="" class="pull-right" style="margin-top:20px">
							<span > <a href="documentation/index.html" target="blank"> Documentation</a> </span>
						</div>
					</div>
				</header>
		<?php
			}
		?>