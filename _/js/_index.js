	

var url = "http://java.uom.gr:8080/seagle2/rs/";


var resultHTML = "";
	
	$(document).ready(function() {
	
		$('#wiz').hide();
		$('#project_analysis').hide();
		$('#ajax-timeline').hide();
		$('#loading').hide();
		$("input:radio[name=results-filter]").click(function() {
			var value = $(this).val();
			switch (value) {
					case("0"):
						$('#ajax-timeline').hide();
						$("#search-project").attr("placeholder", "Search project or enter git repository (e.g. https://git-repo.com/user/example-project.git)");
						$('#search-res').show();
						$("#search-project").removeAttr("disabled");
						$("#search-project").focus();	
						getAllProjects(0); // 0 means show all projects pressed
						break;
					case("1"):
						$('#ajax-timeline').hide();
						$("#search-project").removeAttr("disabled");
						$("#search-project").attr("placeholder", "Enter the minimum number of versions a project must have (e.g. 20)");
						$("#search-project").focus();		
						break;	
                    case ("2"):
						$('#search-res').hide();
						getAllProjects(1); // 1 means show timeline pressed
                        $('#ajax-timeline').show();
						$("#search-project").attr("disabled", "disabled"); 
                        break;
					}	
		});
						
		$("#search-project").focus();	
		$('#search-project').keypress(function (e) {
			if(e.which == 13){	
				searchQuery();
			}	
		});
	
		$("#search-button").click(function(){
			searchQuery();
		});	
		
	})
	
	
function searchQuery(){ // query based searching by url or project name

	var url = "http://java.uom.gr:8080/seagle2/rs/";

	var isgit=0;
	$('#search-res').show();
	if($('#search-project').val()!=""){	
					if ($('#search-project').val().toLowerCase().indexOf(".git") >= 0){ // if is a git url
					   url+='project?purl='; 
					   isgit=1;;
					} 
					else
						url+='project/';								
						$.ajax({
							datatype: "json",
							url: url + $('#search-project').val(),
							success: function(response) {								
									for (var i=0; i<=response.projects.length; i++) {
										resultHTML = "<h1 class='font-md'> Search Results for <span class='semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >(" + response.projects.length +" results) </span></small></h1><p> ";
										if(response.projects.length > 0){
											displaySearchResults(response.projects[i].name, response.projects[i].url, response.projects[i].versionCount);
											$('div#search-res').html(resultHTML);
										} else if(isgit){
												runWizard();
										}										
									}	
							},
							error:function (er_response) {
								resultHTML = "<h1 class='font-md'> Server Responded as: <span class='semi-bold'></span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >(0 results) </span></small></h1><p> ";
								displayError(er_response.status, er_response.message );
								$('div#search-res').html(resultHTML);
							}	
						});
				}
}	
	
function getAllProjects(flag){ 

	$.ajax({
			dataType:"json",
			url: url +'project',
		success: function(response) {		
		resultHTML = "<h1 class='font-md'> Search Results for <span class='semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >( " + response.projects.length + " results) </span></small></h1><p> ";
		for (var i = 0; i < response.projects.length; i++) {
			var project = response.projects[i];
			if(flag==0)  // 0 means show all projects pressed
					displaySearchResults(project.name, project.url, project.versionCount);
			else
				displayTimeLine (project.analyzed, project.name, project.url, project.versionCount);
		}
		 $('div#search-res').html(resultHTML);
		 $('div#ajax-timeline').html(resultHTML);
		},
			error:function (er_response) {
				console.log("On error: " + JSON.stringify(er_response))
			}								
		});
		

}	


function displaySearchResults(pname, purl, pversions){
	$('#project_analysis').hide();
	$('#completion_message').hide();
	 resultHTML += 	"<h3><i class='fa fa-barcode'></i>&nbsp;&nbsp;<u><a href='_/php/_startProjectSession.php?pname=" + pname + "&githubpath=" + purl + "&versions=" + pversions + "' onclick='storeResults(\"" + pname + "\",\"" + purl + "\");'>" + pname + "</a></u>&nbsp;&nbsp;<a href='javascript:void(0);'></a></h3>" +
					"<div class='url text-success'>" +
					"<i class='fa fa-code'></i> <b>Git URL:&nbsp </b> <a href='" + purl + "' target='_blank'>" + purl + "&nbsp;&nbsp;</a>" +
					"</div>" + 		
					"<p style='margin-bottom: 20px'>" +					
						"<div>" + 
							"<p class='note'>" +
								"<i class='fa fa-qrcode'></i> <b>Versions:&nbsp </b>" + pversions  + "&nbsp;&nbsp;" +								
								"</p></p>" +
						"</div>";
}
	
function displayTimeLine (pdate, pname, purl, pversions){
	resultHTML += "<li>"+
		"<div class='smart-timeline-icon bg-color-greenDark'>" +
			"<i class='fa fa-bar-chart-o'></i>" +
		"</div>" +
		"<div class='smart-timeline-time'>" +
			"<small>"+ pdate +"</small>" +
		"</div>" +
		"<div class='smart-timeline-content'>" +
			"<p>" +
				"<strong class='txt-color-greenDark'>" + pname +"</strong>" +
			"</p>" +
			"<p>" +
				"<a href='_/php/_startProjectSession.php?pname=" + pname + "&githubpath=" + purl + "&versions=" + pversions + "' onclick='storeResults(\"" + pname +"\",\"" + purl + "\");'  class='btn btn-xs btn-primary'><i class='fa fa-file'></i>&nbsp;&nbsp" + pname + "</a>" +
				"<br>" + pversions + " Versions" +
			"</p>" +
		"</div>" +
	"</li>";

}
	
	function runWizard(){
		$('#search-res').hide();
		$('#mailnotification').show();
		$('#project_analysis').show();
		
	}
	
	
	$("#triggerProjectAnalysis").click(function(){
			purl = $('#search-project').val();
			reciever_email = $('#email').val();
			if(reciever_email == "")
				reciever_email="geomel@gmail.com";
				$('#triggerProjectAnalysis').hide();
				$('#loading').show();
				$('#project_analysis').hide();
			$.post("http://java.uom.gr:8080/seagle2/rs/project/analysis?purl=" + purl + "&requestorEmail=" + reciever_email, function(data, status){
					$('#loading').hide();
					$( "#completion_message" ).html("<p><h4>The analysis of the project has started and will complete shortly.</h4>");
			});
		});
	
	

