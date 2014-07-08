<?php
if(isset($_GET['reciever'])){
	$reciever = $_REQUEST['reciever'];
}
// multiple recipients
$to  = $reciever . ', '; // note the comma
$to .= 'geomel@gmail.com';

// subject
$subject = 'SEAgle Notification of Prohect Analysis Completion';

// message
$message = "
<html>
<head>
  <title>SEAGle</title>
</head>
<body>
Dear researcher,
<p>
The analysis for the project you requested is now complete.<br>
You may view your results in the link below.
<a href='_/php/_startProjectSession.php?pid=".$row['pid'].">". $row['name'] ."</a>
<p><p>

The SEAgle Team.
</body>
</html>
";

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