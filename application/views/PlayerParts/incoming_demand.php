<?php
	if($new_demand === "no"){
		echo "<h4 class='smallest2'><strong>No New Demand</strong> from Your Customer</h4>";
	}
	else{
		echo "
		<h4 class='smallest2'>(Week ". $new_demand->turn_count .")</h4>
		<h4><strong>". $new_demand->amount ."</strong> <span class='glyphicon glyphicon-envelope'></span></h4>
		";
	}
?>

