<?php
session_start();

	if(isset($_GET['pid'])){
		include("_connections.php");
		$pid=$_GET['pid'];
		
		$project_sql = "SELECT * from project where (pid like '$pid' ) ";<?php
session_start();

	if(isset($_GET['pname'])){
	//	include("_connections.php");
		$pname=$_GET['pname'];
		$githubpath=$_GET['githubpath'];
		$versions=$_GET['versions'];
		
			$_SESSION["pname"] = $pname;
			$_SESSION["githubpath"] = $githubpath;
			$_SESSION["versions"] = $versions;
		
		
		$json_rest = file_get_contents('http://java.uom.gr:8080/seagle2/rs/metric/values/project/'. $pname); //gets project mertrics	
		$rest = json_decode($json_rest);
		$metrics = $rest->versions;
		
		
	// Parse Graph Based Metrics	
		foreach($metrics as $metric){
			$versions_array[] = $metric->name;
			
			$versions = $metric->metrics;
				foreach($versions as $vname){
					
					switch($vname->mnemonic){
						case "GRAPH_NODES":
							$nodes_array[] = $vname->value;
							break;
						case "GRAPH_EDGES":
							$edges_array[] = $vname->value;
							break;
						case "GRAPH_DIAMETER":
							$diameter_array[] = $vname->value;
							break;	
						case "GRAPH_CC":
							$cc_array[] = $vname->value;
							break;		
					}
					
				}
		}	
		

	
		$_SESSION["nodes"] = $nodes_array;
		$_SESSION["edges"] = $edges_array;
		$_SESSION["diameter"] = $diameter_array;
		$_SESSION["cc"] = $cc_array;
	
	/*
		$_SESSION["edgesToNew"] = $edgesToNew_array;
		$_SESSION["edgesBtwnExisting"] = $edgesBtwnExisting_array;
		$_SESSION["edgesBtwnNew"] = $edgesBtwnNew_array;
		$_SESSION["deletedEdges"] = $deletedEdges_array;
		$_SESSION["edgesToExisting"] = $edgesToExisting_array;
		
		*/
		
	//	$json_rest = file_get_contents('http://195.251.210.137:8080/seagle2/rs/metric/values/project/'. $pname); //gets project mertrics
	
		

		

		
		foreach($metrics as $metric){
			$versions = $metric->metrics;
				foreach($versions as $vname){
					// echo $vname->mnemonic;
					// echo " - ";
					// echo $vname->value . "<p>";
					switch($vname->mnemonic){
						case "AUTHOR_COUNT_VER":
							$authors_array[] = $vname->value;
							break;
						case "COM_COUNT_VER":
							$commits_array[] = $vname->value;
							break;
						case "MOD_FILE_COUNT_VER":
							$filesModified_array[] = $vname->value;
							break;	
						case "ADD_FILE_COUNT_VER":
							$filesAdded_array[] = $vname->value;
							break;	
						case "ADD_LINE_COUNT_VER":
							$linesAdded_array[] = $vname->value;
							break;	
						case "DEL_FILE_COUNT_VER":
							$filesDeleted_array[] = $vname->value;
							break;
						case "DEL_LINE_COUNT_VER":
							$linesDeleted_array[] = $vname->value;
							break;			
					}			
				}

		}	

	
	/*
		
			$authors_array[]=$row['authors'];
			$commits_array[]=$row['commits'];
			$filesAdded_array[]=$row['filesAdded'];
			$filesDeleted_array[]=$row['filesDeleted'];
			$filesModified_array[]=$row['filesModified'];
			$linesAdded_array[]=$row['linesAdded'];
			$linesDeleted_array[]=$row['linesDeleted'];
			$testFilesAdded_array[]=$row['testFilesAdded'];
			$testFilesModified_array[]=$row['testFilesModified'];
			
			*/
		$_SESSION["versions_array"] = $versions_array;
		$_SESSION["authors"] = $authors_array;
		$_SESSION["commits"] = $commits_array;
		$_SESSION["filesAdded"] = $filesAdded_array;
		$_SESSION["filesDeleted"] = $filesDeleted_array;
		$_SESSION["filesModified"] = $filesModified_array;
		$_SESSION["linesAdded"] = $linesAdded_array;
		$_SESSION["linesDeleted"] = $linesDeleted_array;
	//	$_SESSION["testFilesAdded"] = $testFilesAdded_array;
	//	$_SESSION["testFilesModified"] = $testFilesModified_array;
	
		$_SESSION["diameter"] = $diameter_array;
		
		/*
		$rs5->data_seek(0);
		while($row = $rs5->fetch_assoc()){
			$cbo_array[]=$row['cbo'];
			$lcom_array[]=$row['lcom'];
			$nom_array[]=$row['nom'];
			$nof_array[]=$row['nof'];
			$wmc_array[]=$row['wmc'];
		}
		$_SESSION["cbo"] = $cbo_array;
		$_SESSION["lcom"] = $lcom_array;
		$_SESSION["nom"] = $nom_array;
		$_SESSION["nof"] = $nof_array;
		$_SESSION["wmc"] = $wmc_array;
		
		*/
	
	}
	
	 header('Location: ../../dashboard.php');


?>
		$graph_sql = "SELECT * FROM project,version INNER JOIN graph WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = graph.vid ORDER BY version.date ASC";
		$version_sql = "SELECT version.name FROM version, project WHERE project.pid='$pid' AND project.pid=version.pid ORDER BY version.date ASC";
		$repository_sql = "SELECT * FROM project, version INNER JOIN repometric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = repometric.vid ORDER BY version.date ASC";
		$sourcecode_sql = "SELECT * FROM project, version INNER JOIN sourcemetric WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = sourcemetric.vid ORDER BY version.date ASC";
		
		$rs=$conn->query($project_sql);
		if($rs === false) {
			trigger_error('Wrong project data SQL query: ' . $project_sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $rs->num_rows;
		}
		// retrieve project data
		$rs->data_seek(0);
		while($row = $rs->fetch_assoc()){
			$_SESSION["pid"] = $row['pid'];
			$_SESSION["pname"] = $row['name'];
			$_SESSION["githubpath"] = $row['githubpath'];
			$_SESSION["versions"] = $row['versions'];
		}
		
		// retrieve graph data
		$rs2=$conn->query($graph_sql);
		if($rs2 === false) {
			trigger_error('Wrong graph data SQL query: ' . $graph_sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $rs2->num_rows;
		}
	
		$rs2->data_seek(0);
		while($row = $rs2->fetch_assoc()){
			$nodes_array[]=$row['nodes'];
			$edges_array[]=$row['edges'];
			$diameter_array[]=$row['diameter'];
			$cc_array[]=$row['cc'];
			$edgesToNew_array[] = $row['edgesToNew'];
			$edgesBtwnExisting_array[] = $row['edgesBtwnExisting'];
			$edgesBtwnNew_array[] = $row['edgesBtwnNew'];
			$deletedEdges_array[] = $row['deletedEdges'];
			$edgesToExisting_array[] = $row['edgesToExisting'];
			
		}
		$_SESSION["nodes"] = $nodes_array;
		$_SESSION["edges"] = $edges_array;
		$_SESSION["diameter"] = $diameter_array;
		$_SESSION["cc"] = $cc_array;
		$_SESSION["edgesToNew"] = $edgesToNew_array;
		$_SESSION["edgesBtwnExisting"] = $edgesBtwnExisting_array;
		$_SESSION["edgesBtwnNew"] = $edgesBtwnNew_array;
		$_SESSION["deletedEdges"] = $deletedEdges_array;
		$_SESSION["edgesToExisting"] = $edgesToExisting_array;
		
		
		
		//retrieve version data 
		$rs3=$conn->query($version_sql);
		if($rs3 === false) {
			trigger_error('Wrong graph data SQL query: ' . $version_sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $rs3->num_rows;
		}
	
		$rs3->data_seek(0);
		while($row = $rs3->fetch_assoc()){
			$versions_array[]=$row['name'];
		}
		$_SESSION["versions_array"] = $versions_array;
		
		
		// retrieve commiters activity
		$rs4=$conn->query($repository_sql);
		if($rs4 === false) {
			trigger_error('Wrong graph data SQL query: ' . $repository_sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $rs4->num_rows;
		}
	
		$rs4->data_seek(0);
		while($row = $rs4->fetch_assoc()){
			$authors_array[]=$row['authors'];
			$commits_array[]=$row['commits'];
			$filesAdded_array[]=$row['filesAdded'];
			$filesDeleted_array[]=$row['filesDeleted'];
			$filesModified_array[]=$row['filesModified'];
			$linesAdded_array[]=$row['linesAdded'];
			$linesDeleted_array[]=$row['linesDeleted'];
			$testFilesAdded_array[]=$row['testFilesAdded'];
			$testFilesModified_array[]=$row['testFilesModified'];
			
		}
		$_SESSION["authors"] = $authors_array;
		$_SESSION["commits"] = $commits_array;
		$_SESSION["filesAdded"] = $filesAdded_array;
		$_SESSION["filesDeleted"] = $filesDeleted_array;
		$_SESSION["filesModified"] = $filesModified_array;
		$_SESSION["linesAdded"] = $linesAdded_array;
		$_SESSION["linesDeleted"] = $linesDeleted_array;
		$_SESSION["testFilesAdded"] = $testFilesAdded_array;
		$_SESSION["testFilesModified"] = $testFilesModified_array;
		
		// retrieve source code metrics
		
		//retrieve version data 
		$rs5=$conn->query($sourcecode_sql);
		if($rs5 === false) {
			trigger_error('Wrong graph data SQL query: ' . $sourcecode_sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $rs5->num_rows;
		}
	
		$rs5->data_seek(0);
		while($row = $rs5->fetch_assoc()){
			$cbo_array[]=$row['cbo'];
			$lcom_array[]=$row['lcom'];
			$nom_array[]=$row['nom'];
			$nof_array[]=$row['nof'];
			$wmc_array[]=$row['wmc'];
		}
		$_SESSION["cbo"] = $cbo_array;
		$_SESSION["lcom"] = $lcom_array;
		$_SESSION["nom"] = $nom_array;
		$_SESSION["nof"] = $nof_array;
		$_SESSION["wmc"] = $wmc_array;
	
	}
	
	 header('Location: ../../dashboard.php');


?>