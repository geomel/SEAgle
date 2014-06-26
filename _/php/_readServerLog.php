<?php
$gitpath_argument = $_REQUEST['gitpath'];
shell_exec("java -jar ServerLog.jar"." ". $gitpath_argument);
?>