<?php
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
		  echo "</tr>";
		  }
	}	  
echo "</tbody>
	  </table>";
	
?>

