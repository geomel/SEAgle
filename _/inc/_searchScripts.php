<script>
$(document).ready(function(){
	// $(".search-results clearfix").load("php/test.php");
	$('#search-project').keyup(function(e) {
		$(".search-results clearfix").load("php/_search.php?val=" + $("#search-project").val());
      });

	$("#search-button").click(function(){
		$(".search-results clearfix").load("php/_search.php?val=" + $("#search-project").val());
	});

});
</script>