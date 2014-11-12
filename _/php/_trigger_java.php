<?php
	$client = new SoapClient("http://se.uom.gr:8080/SeagleWS/SeagleWS?WSDL");

// 1. Sends gitPath and receives versions
		if(isset($_GET['gitpath'])){
		$gitPath = $_GET['gitpath'];
		$gitPathParam = array("gitPath"=>"$gitPath");
		$jsonResponse = $client->__soapCall('downloadProject', array($gitPathParam)); // tha epistrefei dedomena json to web service
		print_r($jsonResponse);
	}
	
// 2. Sends versions in JSON format	
	if(isset($_GET['ready2Analyze'])){
		$versions = $_GET['ready2Analyze'];
		$versionParams = array("versionsInJSONString"=>"$versions");
		$response = $client->__soapCall('analyzeVersions', array($versionParams)); // tha epistrefei null ?
	}
	
// 2. Sends the user email to be notified on completion		
	if(isset($_GET['mailnotification'])){
        $mailnotification = $_GET['mailnotification'];
        $mail_params = array("userMail"=>"$mailnotification");
        $client->__soapCall('setmail', array($mail_params));
    }


?>