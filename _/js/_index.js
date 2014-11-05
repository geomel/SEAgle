function refreshTimeLine(){
        $('#ajax-timeline').load('_/php/_timeline.php', function(){		
        });
    }
	
	$(document).ready(function() {
		
		$('#ajax-timeline').hide();
		
		$("input:radio[name=results-filter]").click(function() {
			var value = $(this).val();
			switch (value) {
					case("0"):
						$('#ajax-timeline').hide();
						$("#search-project").attr("placeholder", "Search project or enter git repository (e.g. https://git-repo.com/user/example-project.git)");
						$('#search-res').show();
						$("#search-project").removeAttr("disabled");
						$("#search-project").focus();	
						$("#search-res").load("_/php/_search.php");
						$("#execsqltime").load("_/php/_search.php #sqltime");		
						break;
					case("1"):
						$('#ajax-timeline').hide();
						$("#search-project").removeAttr("disabled");
						$("#search-project").attr("placeholder", "Enter the minimum number of versions a project must have (e.g. 20)");
						$("#search-project").focus();		
						break;	
                    case ("2"):
						$('#search-res').hide();
						refreshTimeLine();
						$("#execsqltime").load("_/php/_search.php #sqltime");
                        $('#ajax-timeline').show();
						$("#search-project").attr("disabled", "disabled"); 
						$('#mailnotification').hide();
                        break;
					}	
		});
			
				
		$('#mailnotification').hide();		
			
		$("#search-project").focus();	
		
	//	$("#execsqltime").load("_/php/_search.php #sqltime");
		$('#search-project').keypress(function(e) {
			if(e.which == 13) {
				$('#search-res').show();
				$('#mailnotification').hide();
				if($('input:radio[name=results-filter]:checked').val()=="1")
					$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val() + "&flag=1");
				else{	
					$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val()  + "&flag=0",function (text, statusText){
					$("#execsqltime").load("_/php/_search.php #sqltime");
					});
				}			
					}	
			  });
			$("#search-button").click(function(){
				$('#search-res').show();
				$('#mailnotification').hide();
				$("#search-res").load("_/php/_search.php?search_value=" + $("#search-project").val()+"&filter_flag=0",function (text, statusText){
					$("#execsqltime").load("_/php/_search.php #sqltime");
						});	
			});	
		
		$("#mailbtn").click(function(e) {
			$('#mailnotification').hide();
			document.getElementById("execsqltime").innerHTML = "Thank You.<p>A notification email will be sent when the proccess will complete at: " + $('#email').val() ;
            $.ajax({ url: '_/php/_sendmail.php?reciever=' + $('#email').val() });
		});	

	})


	function runJava(){
        openSocket();
		$('#mailnotification').show();
		$('#analyzebtn').hide();
		$('#search-res').hide();
		gpath = $('#search-project').val();
        reciever_email = $('#email').val();
     //   alert('_/php/_trigger_java.php?gitpath=' + gpath + '&reciever=' + reciever_email);
		$.ajax({ url: '_/php/_trigger_java.php?gitpath=' + gpath + '&reciever=' + reciever_email,
		data: {
               
			   },
		success: function(result) { // trims json data from server to be valid
		   result = result.slice(34);
		   var json = JSON.stringify(eval("(" + result ));
		   json = JSON.parse(json);
		   var $grouplist = $('#checkVersions');
		   $.each(json, function() {
				$('<label class="checkbox"><input type="checkbox" class="check" name="check[]" checked="checked" value=\''+this.id+'\'><i></i>' + 
				this.date + "   " + this.name + '</label>').appendTo($grouplist);
			});		
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
    

 function readServerLog(gpath){
/*
	if(show_hide_server_flag){
			$('#server_data').show("slow");
			show_hide_server_flag=0;
		} else{
			$('#server_data').hide("slow");
			show_hide_server_flag=1;
		}
	*/
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
        writeResponse("The analysis for the project you requested, is now complete.<p><p>You may view it by pressing the 'Show Timeline' option above.");
		//setTimeout($.ajax({ url: '_/php/_sendmail.php?reciever=' + $('#email').val() }), 4000);
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