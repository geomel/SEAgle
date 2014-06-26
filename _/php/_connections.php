<?php

$DBServer = '195.251.210.147';
$DBUser   = 'teohaik';
$DBPass   = '28!dec@00';
$DBName   = 'seanetsdb';	

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
 
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

?>