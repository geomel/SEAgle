<?php
session_start();

	if(isset($_GET['pname'])){
	//	include("_connections.php");
		$pname=$_GET['pname'];
		$githubpath=$_GET['githubpath'];
		$versions=$_GET['versions'];
		
			$_SESSION["pname"] = $pname;
			$_SESSION["githubpath"] = $githubpath;
			$_SESSION["versions"] = $versions;
		
		
		$json_rest = file_get_contents('http://java.uom.gr:8080/seagle2/rs/metric/values/project/'. $pname); //gets project metrics	
	//	$json_rest = file_get_contents('http://195.251.210.146:8080/seagle2/rs/metric/values/project/'. $pname); //gets project metrics	
		$rest = json_decode($json_rest);
		$metrics = $rest->versions;
		
		
	// Parse Graph Based Metrics	
		foreach($metrics as $metric){
			$versions_array[] = $metric->name;
			
			$versions = $metric->metrics;
				foreach($versions as $vname){
					
					switch($vname->mnemonic){
						case "NODES":
							$nodes_array[] = $vname->value;
							break;
						case "EDGES":
							$edges_array[] = $vname->value;
							break;
						case "GRAPH_DIAMETER":
							$diameter_array[] = $vname->value;
							break;	
						case "CLUSTERING_COEFFICIENT":
							$cc_array[] = $vname->value;
							break;
						case "DENSITY":
							$density_array[] = $vname->value;
							break;			
					}
					
				}
		}	
		

		$_SESSION["versions_array"] = $versions_array;
	
		$_SESSION["nodes"] = $nodes_array;
		$_SESSION["edges"] = $edges_array;
		$_SESSION["diameter"] = $diameter_array;
		$_SESSION["cc"] = $cc_array;
		$_SESSION["density"] = $density_array;
	

	// Parse Repository Metrics		
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
		
	// Parse source code metrics
	
		foreach($metrics as $metric){
			$versions = $metric->metrics;
				foreach($versions as $vname){
					// echo $vname->mnemonic;
					// echo " - ";
					// echo $vname->value . "<p>";
					switch($vname->mnemonic){
						case "CBO":
							$cbo_array[] = $vname->value;
							break;
						case "LCOM2":
							$lcom_array[] = $vname->value;
							break;
						case "NOM":
							$nom_array[] = $vname->value;
							break;
						case "NOF":
							$nof_array[] = $vname->value;
							break;
						case "LOC":
							$loc_array[] = $vname->value;
							break;	
						case "WMC":
							$wmc_array[] = $vname->value;
							break;		
					}
				}
		}	
		
		/*
		$rs5->data_seek(0);
		while($row = $rs5->fetch_assoc()){
			$cbo_array[]=$row['cbo'];
			$lcom_array[]=$row['lcom'];
			$nom_array[]=$row['nom'];
			$nof_array[]=$row['nof'];
			$wmc_array[]=$row['wmc'];
		}
		*/
		$_SESSION["cbo"] = $cbo_array;
		$_SESSION["lcom"] = $lcom_array;
		$_SESSION["nom"] = $nom_array;
		$_SESSION["nof"] = $nof_array;
		$_SESSION["wmc"] = $wmc_array;
		$_SESSION["loc"] = $loc_array;
		
		
	
	}
	
	 header('Location: ../../dashboard.php');


?>