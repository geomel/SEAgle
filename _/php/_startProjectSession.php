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
		
		
		$json_rest_metrics = file_get_contents('http://java.uom.gr:8080/seagle2/rs/metric/values/project/'. $pname); //gets project metrics	
		$json_rest_smells = file_get_contents('http://java.uom.gr:8080/seagle2/rs/project/smells/summary/'. $pname); //gets project metrics	
	//	$json_rest = file_get_contents('http://195.251.210.146:8080/seagle2/rs/metric/values/project/'. $pname); //gets project metrics	
		$rest_metrics = json_decode($json_rest_metrics);
		$rest_smells = json_decode($json_rest_smells);
		
		$metrics = $rest_metrics->versions;
		
		
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
						case "WOC":
							$woc_array[] = $vname->value;
							break;
						case "TCC":
							$tcc_array[] = $vname->value;
							break;	
						case "NOPA":
							$nopa_array[] = $vname->value;
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
		$_SESSION["woc"] = $woc_array;
		$_SESSION["tcc"] = $tcc_array;
		$_SESSION["nopa"] = $nopa_array;
		
		
	
	
	$versions = $rest_smells->versions;
		
		
	// Parse Source Code Smells	
		foreach($versions as $v){	
			$smellVersions_array[] = $v->name;
				$versions = $v->smells;
			foreach($versions as $vname){	
					switch($vname->smellName){
						case "God Class":
							$godClass_array[] = $vname->quantity;
							break;
						case "Data Class":
							$dataClass_array[] = $vname->quantity;
							break;
						case "Feature Envy":
							$featureEnvy_array[] = $vname->quantity;
							break;	
					}					
				}
		}	
		
		
		$_SESSION["smellVersions"] = $smellVersions_array;
		$_SESSION["godClass"] = $godClass_array;
		$_SESSION["dataClass"] = $dataClass_array;
		$_SESSION["featureEnvy"] = $featureEnvy_array;
		
	
	}
	
	
	
	 header('Location: ../../dashboard.php');


?>