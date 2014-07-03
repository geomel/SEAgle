<?php
	$client = new SoapClient("http://localhost:8080/SeanetsWS/SeanetsWS?WSDL");

	if(isset($_GET['gitpath'])){
		$gitPath = $_GET['gitpath'];
		echo $gitPath;
		$params = array("gitPath"=>"$gitPath");
		$client->__soapCall('analyze', array($params));	
	}
	else{
		echo "path not set!";
	}
?>