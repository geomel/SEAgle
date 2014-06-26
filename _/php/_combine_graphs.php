<?php
session_start();

if(isset($_GET['f1']) && isset($_GET['f2'])){
	$f1 = $_GET['f1'];
	$f2 = $_GET['f2'];
}	
if(isset($f1) && isset($f2)){
 echo "<strong>".$f1. "</strong>: ".join(', ', $_SESSION[$f1]);
 echo "<p><strong>".$f2. "</strong>: ".join(', ', $_SESSION[$f2]);
 echo "<div class='sparkline' 
	data-sparkline-type='compositeline' 
	data-sparkline-spotradius-top='5' 
	data-sparkline-color-top='#3a6965' 
	data-sparkline-line-width-top='3' 
	data-sparkline-color-bottom='#2b5c59' 
	data-sparkline-spot-color='#2b5c59' 
	data-sparkline-minspot-color-top='#97bfbf' 
	data-sparkline-maxspot-color-top='#c2cccc' 
	data-sparkline-highlightline-color-top='#cce8e4' 
	data-sparkline-highlightspot-color-top='#9dbdb9' 
	data-sparkline-width='96%' 
	data-sparkline-height='78px' 
	data-sparkline-line-val='[".join(', ', $_SESSION[$f1])."]'
	data-sparkline-bar-val='[".join(', ', $_SESSION[$f2])."]'>
</div> ";	

include_once("../../lib/config.php"); 
include_once("../../inc/scripts.php"); 
}
?>