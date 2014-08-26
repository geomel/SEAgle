<?php

$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project, version INNER JOIN repometric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = repometric.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

echo "<table id='commitersMetricsTable' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>Authors</th>
					<th>Commits</th>
					<th>Lines Added</th>
					<th>Lines Deleted </th>
				</tr>
			</thead>
		<tbody>";
	while($row = $rs->fetch_assoc())	
		  {
		  echo "<tr>";
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['authors'] . "</td>";
		  echo "<td>" . $row['commits'] . "</td>";
		  echo "<td>" . $row['linesAdded'] . "</td>";
		  echo "<td>" . $row['linesDeleted'] . "</td>";
		  echo "</tr>";
		  }
echo "</tbody>
	  </table>";
	
?>
