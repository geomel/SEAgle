<?php
/*
$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project, version INNER JOIN sourcemetric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = sourcemetric.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);
*/
echo "<table id='softMetricsTable' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>Lines of Code</th>
					<th>Number Of Methods</th>
					<th>Number Of Fields</th>
					<th>Coupling Between Objects</th>
					<th>Lack Of Cohesion Of Methods</th>
					<th>Weighted Method Complexity</th>
					<th>Weight Of Class</th>
					<th>Tight Class Cohesion</th>
					<th>Number Of Public Attributes</th>
					<th>Number Of Accessor Methods</th>
				</tr>
			</thead>
		<tbody>";
	foreach($_SESSION["versions_array"] as $key => $value) {	
		  {
		  echo "<tr>";
		  echo "<td>" . $_SESSION["versions_array"][$key] . "</td>";
		  echo "<td>" . $_SESSION["loc"][$key] . "</td>";
		  echo "<td>" . $_SESSION["nom"][$key] . "</td>";
		  echo "<td>" . $_SESSION["nof"][$key] . "</td>";
		  echo "<td>" . round($_SESSION["cbo"][$key],3) . "</td>";
		  echo "<td>" . round($_SESSION["lcom"][$key],3) . "</td>";
		  echo "<td>" . round($_SESSION["wmc"][$key],3) . "</td>";
		  echo "<td>" . round($_SESSION["woc"][$key],3) . "</td>"; 
		  echo "<td>" . round($_SESSION["tcc"][$key],3) . "</td>";
		  echo "<td>" . $_SESSION["nopa"][$key] . "</td>";
		   echo "<td>" . $_SESSION["noam"][$key] . "</td>";
		  echo "</tr>";
		  }
	}	  
echo "</tbody>
	  </table>";
	
?>

