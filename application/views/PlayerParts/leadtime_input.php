<?php

if($max > 0){
	echo "

	<label>Reduce Leadtime By</label>
	<input class='form-control' id='amount' name='amount' placeholder='Maximum reduction: ".$max."' type='number' min='0' max='".$max."'>

	";
}
else{
	echo "

	<label>Reduce Leadtime By</label>
	<input class='form-control' id='amount' name='amount' placeholder='Maximum reduction: ".$max."' type='number' min='0' max='".$max."' disabled>
	<br>
	<p>*Insufficient credit or minimum leadtime reached.</p>
	";
}

?>