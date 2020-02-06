<?php

if($pst_dlv === "nodata"){
	echo "
	<h4 class='smallest'>No Data</h4>
	";
}
else{
	echo "
	<h4 class='smallest'>(Week ". $weekcount .")</h4>
	<h4>".$pst_dlv."</h4>
	";
}

?>
