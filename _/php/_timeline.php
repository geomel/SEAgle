<?php 
session_start();
include("_connections.php");
$sql = "SELECT * FROM timeline, project WHERE project.pid=timeline.pid ORDER BY date DESC";

$rs=$conn->query($sql);
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

while($row = $rs->fetch_assoc()){	

echo "<li>
		<div class='smart-timeline-icon bg-color-greenDark'>
			<i class='fa fa-bar-chart-o'></i>
		</div>
		<div class='smart-timeline-time'>
			<small>".$row['date']."</small>
		</div>
		<div class='smart-timeline-content'>
			<p>
				<strong class='txt-color-greenDark'>".$row['title']."</strong>
			</p>
			<p>
				<a href='_/php/_startProjectSession.php?pid=".$row['pid']."' onclick='storeResults(\"".$row['name']."\",\"".$row['pid']."\");'  class='btn btn-xs btn-primary'><i class='fa fa-file'></i>&nbsp;&nbsp". $row['name'] ."</a>
			</p>
		</div>
	</li>";
}	
include_once("../../lib/config.php"); 
include_once("../../inc/scripts.php"); 


?>	