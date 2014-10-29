<?php

include("_connections.php"); 
$sql = "SELECT * FROM project order by pid desc limit 1";
$rs=$conn->query($sql);
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

if(isset($_GET['reciever'])){
	$reciever = $_REQUEST['reciever'];
}
// multiple recipients
$to  = $reciever . ', '; // note the comma
$to .= 'geomel@gmail.com';

// subject
$subject = 'SEAgle Notification of Project Analysis Completion';

// message
while($row = $rs->fetch_assoc()){
$message = "
<html>
<body>
Dear researcher,
<p>
The analysis for the project you requested is now complete.<br>
You may view your results in the link below:<p>
<a href='http://se.uom.gr/seagle/_/php/_startProjectSession.php?pid=".$row['pid']."'>".$row['name']."</a>

<p>The SEAgle Team.


";
}
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

/* Additional headers
$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
*/
// Mail it
mail($to, $subject, $message, $headers);

?>