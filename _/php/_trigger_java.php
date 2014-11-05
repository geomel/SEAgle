<?php
	$client = new SoapClient("http://se.uom.gr:8080/SeagleWS/SeagleWS?WSDL");


    if(isset($_GET['reciever'])){
        $reciever = $_GET['reciever'];
        $mail_params = array("userMail"=>"$reciever");
        $client->__soapCall('setmail', array($mail_params));
    }
/*
	if(isset($_GET['gitpath'])){
		$gitPath = $_GET['gitpath'];
	//	$gitPath = "https://github.com/socrata-cookbooks/java.git";
		echo $gitPath;
		$params = array("gitPath"=>"$gitPath");
		$client->__soapCall('analyze', array($params)); // tha epistrefei dedomena json to web service
	}
	else{
		echo "path not set!";
	}
	
*/
	if(isset($_GET['gitpath'])){
		$gitPath = $_GET['gitpath'];
		$params = array("gitPath"=>"$gitPath");
		$jsonResponse = $client->__soapCall('downloadProject', array($params)); // tha epistrefei dedomena json to web service
		print_r($jsonResponse);
	}
	else{
		return "path not set!";
	}
	
	// setVersions, 
	//downloadProject, stelno gitpath gia na paro ta json
?>