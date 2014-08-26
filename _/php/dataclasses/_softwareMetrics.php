<?php

$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project, version INNER JOIN sourcemetric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = sourcemetric.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

echo "<table id='softMetricsTable' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>Number Of Methods</th>
					<th>Number Of Fields</th>
					<th>Coupling Between Objects</th>
					<th>Lack Of Cohesion Of Methods</th>
					<th>Weighted Method Complexity</th>
				</tr>
			</thead>
		<tbody>";
	while($row = $rs->fetch_assoc())	
		  {
		  echo "<tr>";
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['nom'] . "</td>";
		  echo "<td>" . $row['nof'] . "</td>";
		  echo "<td>" . $row['cbo'] . "</td>";
		  echo "<td>" . $row['lcom'] . "</td>";
		  echo "<td>" . $row['wmc'] . "</td>";
		  echo "</tr>";
		  }
echo "</tbody>
	  </table>";
	
?>
