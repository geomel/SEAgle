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
					<th>Nodes</th>
					<th>Edges</th>
					<th>Diameter</th>
					<th>Density</th>
					<th>Clustering Coeficient</th>
				</tr>
			</thead>
		<tbody>";	  
	 foreach($_SESSION["nodes"] as $key => $value) {
		  echo "<tr>";
		  echo "<td>" . $_SESSION["versions_array"][$key] . "</td>";
		  echo "<td>" . $_SESSION["nodes"][$key] . "</td>";
		  echo "<td>" . $_SESSION["edges"][$key] . "</td>";
		  echo "<td>" . round($_SESSION["diameter"][$key],3) . "</td>";
		  echo "<td>" . round($_SESSION["density"][$key], 3) . "</td>";
		  echo "<td>" . round($_SESSION["cc"][$key],3) . "</td>";
		  echo "</tr>";
		}  	  
echo "</tbody>
	  </table>";
 
?>
