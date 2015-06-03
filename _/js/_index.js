var url = "http://195.251.210.137:8080/seagle2/rs/";	

var resultHTML = "";
	
	$(document).ready(function() {
		$('#wiz').hide();
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
						// $("#search-res").load("_/php/_search.php");
						getAllProjects(0); // 0 means show all projects pressed
						$("#execsqltime").load("_/php/_search.php #sqltime");	
						console.log("case 0 triggered");
						break;
					case("1"):
						$('#ajax-timeline').hide();
						$("#search-project").removeAttr("disabled");
						$("#search-project").attr("placeholder", "Enter the minimum number of versions a project must have (e.g. 20)");
						$("#search-project").focus();		
						break;	
                    case ("2"):
						$('#search-res').hide();
					//	refreshTimeLine();
					//	$("#execsqltime").load("_/php/_search.php #sqltime");
						getAllProjects(1); // 1 means show timeline pressed
                        $('#ajax-timeline').show();
						$("#search-project").attr("disabled", "disabled"); 
                        break;
					}	
		});
			
			
		$("#search-project").focus();	

		$('#search-project').keypress(function (e) {
			var url = "http://195.251.210.137:8080/seagle2/rs/";
			$('#search-res').show();
			if(e.which == 13){	
				if($('#search-project').val()!=""){	
					if ($('#search-project').val().toLowerCase().indexOf(".git") >= 0) // if is a git url
					   url+='project/?purl=';
					else
						url+='project/';		
						$.ajax({
							datatype: "json",
							url: url + $('#search-project').val(),
							success: function(response) {
									resultHTML = "<h1 class='font-md'> Search Results for <span class='semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >(1 results) </span></small></h1><p> ";
									displayAllData(response.name, response.url, response.versionCount);
									$('div#search-res').html(resultHTML);
							},
							error:function (er_response) {
								resultHTML = "<h1 class='font-md'> Search Results for <span class='semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >(0 results) </span></small></h1><p> ";
								displayError(er_response.status, er_response.message );
								$('div#search-res').html(resultHTML);
							}	
						});
				}
			}	
		});
	
			$("#search-button").click(function(){
				$('#search-res').show();
			//	$('#mailnotification').hide();
				$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val()+"&filter_flag=0",function (text, statusText){
					$("#execsqltime").load("_/php/_search.php #sqltime");
						});	
			});	
		
		$("#mailbtn").click(function(e) {
		//	$('#mailnotification').hide();
		//	document.getElementById("execsqltime").innerHTML = "Thank You.<p>A notification email will be sent when the proccess will complete at: " + $('#email').val() ;
            $.ajax({ url: '_/php/_sendmail.php?reciever=' + $('#email').val() });
		});	

	})
	
	
	
function getAllProjects(flag){

	$.ajax({
			dataType:"json",
			url: url +'project',
		success: function(response) {		
		resultHTML = "<h1 class='font-md'> Search Results for <span class='semi-bold'>Projects</span><small class='text-danger'> &nbsp;&nbsp;<span id='numresults' >( " + response.projects.length + " results) </span></small></h1><p> ";
		for (var i = 0; i < response.projects.length; i++) {
			var project = response.projects[i];
			if(flag==0)  // 0 means show all projects pressed
				displayAllData(project.name, project.url, project.versionCount);
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


function displayAllData(pname, purl, pversions){
	 resultHTML += 	"<h3><i class='fa fa-barcode'></i>&nbsp;&nbsp;<u><a href='_/php/_startProjectSession.php?pid=10' onclick='storeResults(\"" + pname + "\",\"" + purl + "\");'>" + pname + "</a></u>&nbsp;&nbsp;<a href='javascript:void(0);'></a></h3>" +
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
	
function displayError(status, message){
	resultHTML += 	"<h3><i class='fa fa-ban'></i>&nbsp;&nbsp;<u>" + status + "</u></h3>" +
					"<div class='url text-error'>" +
					"<i class='fa fa-code'></i> <b>Server Response:&nbsp </b>" + message + "</div>";			 							
	
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
				"<a href='_/php/_startProjectSession.php?pid=10' onclick='storeResults(\"" + pname +"\",\"" + purl + "\");'  class='btn btn-xs btn-primary'><i class='fa fa-file'></i>&nbsp;&nbsp" + pname + "</a>" +
				"<br>" + pversions + " Versions" +
			"</p>" +
		"</div>" +
	"</li>";

}	

function refreshTimeLine(){
        $('#ajax-timeline').load('_/php/_timeline.php', function(){		
        });
    }

	
	function runWizard(){
		$('#wiz').show();
		$('#searchControls').hide();
		$('#loading').show();
		getVersions();
	}

	function getVersions(){
       // openSocket();
	//	$('#mailnotification').show();
		$('#analyzebtn').hide();
		$('#search-res').hide();
		gpath = $('#search-project').val();
        reciever_email = $('#email').val();
     //   alert('_/php/_trigger_java.php?gitpath=' + gpath + '&reciever=' + reciever_email);
		$.ajax({ url: '_/php/_trigger_java.php?gitpath=' + gpath ,
		data: {
               
			   },
		success: function(result) { // trims json data from server to be valid
		   result = result.slice(34);
		   var json = JSON.stringify(eval("(" + result ));
		   json = JSON.parse(json);
		   $('#checkVersions').show();
		   var $grouplist = $('#checkVersions');
		   $.each(json, function() {
				$('<label class="checkbox"><input type="checkbox" class="check" name="check[]" checked="checked" value=\''+this.id+'\'><i></i>(' + 
				this.date + ")   " + this.name + '</label>').appendTo($grouplist);
				});		
			},
		complete: function() {
			
			$('#loading').hide();
		
		}
		});
}

	function runJava(){
        openSocket();
		gpath = $('#search-project').val();
        reciever_email = $('#email').val();
		var versions_json={};
		var version = [];
		versions_json =  $("#checkVersions input:checkbox:checked").map(function(){
			 version.push($(this).val());
		});	
	
		jsonSelectedVeriosns = JSON.stringify(version);
		
		$.ajax({ url: '_/php/_trigger_java.php?ready2Analyze=' +  jsonSelectedVeriosns,
		data: {
               
			   },
		success: function(result) { 
		   	
		}
		});
}

    $('#selectall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.check').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.check').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
/*
 function readServerLog(gpath){
	$.ajax({
        url: "http://se.uom.gr/seagle/logs/"+gpath+".txt",
        dataType: 'text',
        success: function(text) {
         $("#server_data").html(text);
		 $("#server_data:contains(Finished!)").css("background","url(assets/css/img/done.png) right no-repeat #efefef")
			 setTimeout(readServerLog(gpath), 4000); // refresh every 4 seconds
        }
		
	}).done(function() {
			$("#search-res").load("_/php/_search.php?val=" + "geomel");
		});
	}	
*/
	
var webSocket;

function openSocket() {
    // Ensures only one connection is open at a time
    if (webSocket !== undefined && webSocket.readyState !== WebSocket.CLOSED) {
        writeResponse("WebSocket is already opened.");
        return;
    }
    // Create a new instance of the websocket
    webSocket = new WebSocket("ws://se.uom.gr:8080/seanetsweb/loggerSocket");

    /**
     * Binds functions to the listeners for the websocket.
     */
    webSocket.onopen = function(event) {
        // For reasons I can't determine, onopen gets called twice
        // and the first time event.data is undefined.
        // Leave a comment if you know the answer.
        if (event.data === undefined)
            return;

        writeResponse(event.data);
    };

    webSocket.onmessage = function(event) {
		if(event.data=="Finished!"){
			writeResponse(event.data);
			closeSocket();
		}else
			writeResponse(event.data);	
    };

    webSocket.onclose = function(event) {
        writeResponse("The analysis for the project you requested, is now complete.");
		// refreshTimeline();
		
		$.ajax({ url: '_/php/_trigger_java.php?mailnotification=' + $('#email').val() + '00' + $("#search-project").val() ,
		data: {
               
			   },
		success: function(result) { 
					$('#ajax-timeline').load('_/php/_timeline.php', function(){		
				});
				$('#wiz').hide();
				$('#searchControls').show();
				$('#ajax-timeline').show();
			}
		});
    };
}

/**
 * Sends the value of the text input to the server
 */
function send(text) {
    webSocket.send(text);
}

function closeSocket() {
    webSocket.close();
}

function writeResponse(text) {
    document.getElementById("status").innerHTML = "<br/>" + text;
}	


 //$.ajax({ url: '_/php/_sendmail.php?reciever=' + $('#email').val() });

