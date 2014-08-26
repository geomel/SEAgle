<?php

include("_connections.php");

if(isset($_GET['search_value'])){
	$search_value = $_REQUEST['search_value'];
	// $flag = $_REQUEST['flag'];
	 $flag = 1;
}

$git_flag = false;

if(isset($search_value)){
	if (strpos($search_value,'.git')) 
		$git_flag = true;
			if($flag=="1")
				// $sql = "select * from project where(versions >= '$search_value') ORDER BY versions ASC";	
				$sql = "select * from project where(name like '%$search_value%' OR versions like '%$search_value%' OR githubpath like '%$search_value%') ORDER BY name ASC";
			else
				$sql = "select * from project where(name like '%$search_value%' OR versions like '%$search_value%' OR githubpath like '%$search_value%') ORDER BY name ASC";			
}
else{
	$sql = "SELECT * FROM project";	
}
$msc=microtime(true);
$rs=$conn->query($sql);
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}
$rs->data_seek(0);
echo  "<h1 class='font-md'> Search Results for <span class=''semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >( ". $rows_returned ." results) </span></small></h1><p>";
if($rows_returned!=0){		
while($row = $rs->fetch_assoc()){
	echo "<h3><i class='fa fa-barcode'></i>&nbsp;&nbsp;<u><a href='_/php/_startProjectSession.php?pid=".$row['pid']."' onclick='storeResults(\"".$row['name']."\",\"".$row['pid']."\");'>". $row['name'] ."</a></u>&nbsp;&nbsp;<a href='javascript:void(0);'></a></h3>";
			echo "<div class='url text-success'>
					<i class='fa fa-code'></i> <b>Git URL:&nbsp </b> <a href='".$row['githubpath']."' target='_blank'>". $row['githubpath'] ."&nbsp;&nbsp;</a>
					</div>		
					<p style='margin-bottom: 20px'>
		<div>
			<p class='note'>
									<i class='fa fa-qrcode'></i> <b>Versions:&nbsp </b>". $row['versions'] ."&nbsp;&nbsp;								
								</p></p>
		</div>";
	/*	
			$pid = $row['pid'];	
			$sql2 = "SELECT * FROM project,version INNER JOIN graph WHERE project.pid='$pid' AND project.pid=version.pid AND version.vid = graph.vid";
			$rs2=$conn->query($sql2);
			$rs2->data_seek(0);
	
	while($row2 = $rs2->fetch_assoc()){
				$nodes_array[]=$row2['nodes'];
				$edges_array[]=$row2['edges'];
				$diameter_array[]=$row2['diameter'];
				$cc_array[]=$row2['cc'];
			}		
				echo"</div><p style='margin-top: 20px'>
										<div class='show-stat-microcharts'>
											<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
												<ul id='sparks' class=''>
													<li class='sparks-info'>
														<h5> Nodes </h5>
														<div class='sparkline' data-sparkline-type='line' data-sparkline-width='140px' data-sparkline-height='40px'>".
															join(', ', $nodes_array)."
														</div>
													</li>
												</ul>	
											</div>
											<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
												<ul id='sparks' class=''>
													<li class='sparks-info'>
														<h5> Edges </h5>
														<div class='sparkline' data-sparkline-type='line' data-sparkline-width='140px' data-sparkline-height='40px'>".
															join(', ', $edges_array)."
														</div>
													</li>
												</ul>
											</div>
											<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
												<ul id='sparks' class=''>
													<li class='sparks-info'>
														<h5> Diameter </h5>
														<div class='sparkline' data-sparkline-type='line' data-sparkline-width='140px' data-sparkline-height='40px'>".
															join(', ', $diameter_array)."
														</div>
													</li>
												</ul>
											</div>
											<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
												<ul id='sparks' class=''>
													<li class='sparks-info'>
														<h5> Clustering Coeficient </h5>
														<div class='sparkline' data-sparkline-type='line' data-sparkline-width='140px' data-sparkline-height='40px'>".
															join(', ', $cc_array)."
														</div>
													</li>
												</ul>
											</div>
										</div>	
										<p style='margin-bottom: 20px' class='divider'>
										</div>";
										unset($nodes_array);
										unset($edges_array);
										unset($diameter_array);
										unset($cc_array);
	echo "<hr>"	;	

*/	
	}
}else{
	if($git_flag==true)
		echo 	"<div class='center-block'>
					 <h3>This git url does not exist in our database. Analyse this project now?</h3>
					 <a href='#' class='btn btn-success btn-large' id='analyzebtn' onclick='runJava()'><i class='fa fa-cloud-download'></i> Start Analysing ".$search_value." Now</a><p>
				</div>
				";
	else
		echo "<h3>No data found. Try a different query</h3>";
		
	
}	
$msc=microtime(true)-$msc;
$msc = round($msc, 4);
echo "<span style='visibility:hidden;'> <span id='sqltime'>". $msc." seconds </span></span>";

include_once("../../lib/config.php"); 
include_once("../../inc/scripts.php"); 

?>	
	
		
								
		
								
								
										
							
		
		
		
		
		
		
		
		
		
		
					