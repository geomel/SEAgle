<?php
	$client = new SoapClient("http://se.uom.gr:8080/SeagleWS/SeagleWS?WSDL");

	if(isset($_GET['gitpath'])){
		$gitPath = $_GET['gitpath'];
	//	$gitPath = "https://github.com/socrata-cookbooks/java.git";
		echo $gitPath;
		$params = array("gitPath"=>"$gitPath");
		$client->__soapCall('analyze', array($params));	
	}
	else{
		echo "path not set!";
	}
?>