<style type="text/css">
	.trs{
		text-align: center;
		margin-left: 33%;
		width: 200px;
	}
	.arrow{
		margin-top:-17px;
	}
</style>
<h4><strong>Turn <?php echo $current_turn;?></strong></h4>
<div class='trs'>
<div class='panel panel-success'>
	<div class='panel-heading'>
		<p><strong>Your Supplier</strong></p>
	</div>
</div>
<div class='arrow'>
<span class='glyphicon glyphicon-arrow-down'></span>
</div>
<!--LEADTIME-->
<?php
	if($length==0){
		echo "";
	}
	else{
		for($x=$length-1;$x>=0;$x--){
			$arriving = $current_turn+$x+1;
			echo "<div class='panel panel-primary'>
					<div class='panel-heading'>
						<p>Arrive on week ".$arriving."</p>
						<p><strong>".$intransit[$x]->amount."</strong> <span class='glyphicon glyphicon-gift'></span></p>
					</div>
				</div>
				<div class='arrow'>
				<span class='glyphicon glyphicon-arrow-down'></span>
				</div>";
		}
	}
?>
<!--END OF LEADTIME-->
<!--YOU-->
<div class='panel panel-success'>
	<div class='panel-heading'>
		<p><strong>Your Inventory</strong></p>
	</div>
</div>
<!--END OF YOU-->
</div>