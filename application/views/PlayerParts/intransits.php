<?php
if($length == 1){
	echo "
	<h4 style='text-align:center;'>No supply is on the way</h4>
	";
}
else{
	
	for($x=1;$x<$length;$x++){
		$arrival = $current_turn +$x+1;
		echo "
		<div class='panel panel-success' style='text-align:center;'>
			<div class='panel-heading'><h4>Arrive on <strong>Week ". $arrival ."</strong></h4></div>
			<div class='panel-body' style='background-color: white;'>
				<h4><span class='glyphicon glyphicon-send'></span> ". $intransit[$x]->amount ."</h4>
			</div>
		</div>
		";
	}

}


?>
