<script type="text/javascript">
	$(document).ready(function(){
    $("#next_turn").click(function(){
    	$("#next_turn").attr("disabled", true);
    	$("#next_turn").removeClass("btn btn-primary");
    	$("#next_turn").addClass("btn btn-warning");	
    	$("#next_turn").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...");
      $.ajax({
            url: "../gamecontroller/add_turn",
        });
   });
});

</script>

<?php
	
	if($next_turn === "ok"){
		echo "<button class='btn btn-primary' id='next_turn'>
        <span class='glyphicon glyphicon-plus-sign'></span> Next Turn</button>";
	}
	else if($next_turn === "end"){
		echo "<button class='btn btn-danger' id='next_turn' disabled>
        <span class='glyphicon glyphicon-ban-circle'></span> Final Turn Reached</button>";
	}
	else{

		echo "<button class='btn btn-default' id='next_turn' disabled>
        <span class='glyphicon glyphicon-plus-sign'></span> Next Turn</button>";
	}
	

?>

