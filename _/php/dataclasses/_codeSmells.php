<?php
/*
$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project,version, graph WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = graph.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);
*/
echo "<table id='datatable_tabletools' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>God Class</th>
					<th>Data Class</th>
					<th>Feature Envy</th>
				</tr>
			</thead>
		<tbody>";	  
	 foreach($_SESSION["smellVersions"] as $key => $value) {
		  echo "<tr>";
		  echo "<td>" . $_SESSION["smellVersions"][$key] . "</td>";
		  echo "<td>" . $_SESSION["godClass"][$key] . "</td>";
		  echo "<td>" . $_SESSION["dataClass"][$key] . "</td>";
		  echo "<td>" . $_SESSION["featureEnvy"][$key] . "</td>";
		  echo "</tr>";
		}  	  
echo "</tbody>
	  </table>";
 
?>
