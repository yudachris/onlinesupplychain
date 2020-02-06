<?php

$index = count($intransit)-1;

$next_supply = $intransit[$index]->amount;

?>

<h4 class='smallest2'>(Next Week)</h4>
<h4><strong><?php echo $next_supply; ?></strong> <span class='glyphicon glyphicon-gift'></span></h4>