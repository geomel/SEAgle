<?php

$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project,version, graph WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = graph.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

echo "<table id='datatable_tabletools' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>Nodes</th>
					<th>Edges</th>
					<th>Diameter</th>
					<th>Clustering Coeficient</th>
				</tr>
			</thead>
		<tbody>";
	while($row = $rs->fetch_assoc())	
		  {
		  echo "<tr>";
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['nodes'] . "</td>";
		  echo "<td>" . $row['edges'] . "</td>";
		  echo "<td>" . $row['diameter'] . "</td>";
		  echo "<td>" . $row['cc'] . "</td>";
		  echo "</tr>";
		  }
echo "</tbody>
	  </table>";
	
?>
