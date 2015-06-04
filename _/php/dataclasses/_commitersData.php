<?php

/*
$pid=$_SESSION["pid"];

$sql = "SELECT * FROM project, version INNER JOIN repometric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = repometric.vid ORDER BY version.date ASC";

$rs=$conn->query($sql);
 
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);

*/

echo "<table id='commitersMetricsTable' class='table table-striped table-hover' >
			<thead>
				<tr>
					<th>Version</th>
					<th>Authors</th>
					<th>Commits</th>
					<th>Lines Added</th>
					<th>Lines Deleted </th>
					<th>Files Added</th>
                    <th>Files Modified</th>
					<th>Files Deleted </th>
				</tr>
			</thead>
		<tbody>";
		
		
		/*
		
			$_SESSION["versions_array"] = $versions_array;
			$_SESSION["authors"] = $authors_array;
			$_SESSION["commits"] = $commits_array;
			$_SESSION["filesAdded"] = $filesAdded_array;
			$_SESSION["filesDeleted"] = $filesDeleted_array;
			$_SESSION["filesModified"] = $filesModified_array;
			$_SESSION["linesAdded"] = $linesAdded_array;
			$_SESSION["linesDeleted"] = $linesDeleted_array;
		
		*/
    foreach($_SESSION["authors"] as $key => $value) {
		  echo "<tr>";
		  echo "<td>" . $_SESSION["versions_array"][$key] . "</td>";
		  echo "<td>" . $_SESSION["authors"][$key] . "</td>";
		  echo "<td>" . $_SESSION["commits"][$key] . "</td>";
		  echo "<td>" . $_SESSION["linesAdded"][$key] . "</td>";
		  echo "<td>" . $_SESSION["linesDeleted"][$key] . "</td>";
		  echo "<td>" . $_SESSION["filesAdded"][$key] . "</td>";
          echo "<td>" . $_SESSION["filesModified"][$key] . "</td>";
		  echo "<td>" . $_SESSION["filesDeleted"][$key] . "</td>";
		  echo "</tr>";
		}  
		  
echo "</tbody>
	  </table>";
	
?>
