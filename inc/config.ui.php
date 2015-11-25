<?php

$breadcrumbs = array(
	$_SESSION['pname']	=> APP_URL
);


$page_nav = array(
	"dashboard" => array(
		"title" => "Dashboard",
		"url" => APP_URL."/dashboard.php",
		"icon" => "fa-home"
	),
	"graphs" => array(
		"title" => "Metrics",
		"icon" => "fa-bar-chart-o",
		"sub" => array(
			"san" => array(
				"title" => "Graph Based Metrics",
				"url" => APP_URL."/gbm.php"
			),
			"ca" => array(
				"title" => "Repository Metrics",
				"url" => APP_URL."/ca.php"
			),
			"sm" => array(
				"title" => "Source Code Metrics",
				"url" => APP_URL."/sm.php"
			)
		)
	),
	"codeSMells" => array(
                "title" => "Code Smells",
                "url" => APP_URL."/codeSmells.php",
				"icon" => "fa-fire-extinguisher"
	),
	   "composite" => array(
                "title" => "Correlation Analysis",
                "url" => APP_URL."/cgraphs.php",
				"icon" => "fa-random"
	),
);


//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
?>