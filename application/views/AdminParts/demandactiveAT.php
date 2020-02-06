<script type="text/javascript">
	$(document).ready(function(){
		$("#initiate").click(function(){
			$.ajax({
            url: "../gamecontroller/initiatedemand",
        });
			$("#demand-active").load('../adminpartscontroller/demandactiveAT');
			alert('Demand Initiated.');
		});
	});
</script>
<?php
	if($active ==="no"){
		echo "<h5>There's <strong>no active demand</strong> currently.</h5>";
		echo "<button id='initiate' class='btn btn-success'>Initiate Demand</button>";
	}
	else{
		echo "
			<h4><strong>(Week ". $active->turn_count .")</strong></h4>
			<h4>". $active->amount ." <span class='glyphicon glyphicon-gift'></span></h4>
		";
	}
?>

