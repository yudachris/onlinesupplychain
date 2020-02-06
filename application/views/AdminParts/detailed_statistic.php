<script type="text/javascript">
$(document).ready(function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Team <?php echo $team_code; ?> Cost Distribution"
		},
		exportFileName: "Pie Chart",
		exportEnabled: true,
                animationEnabled: true,
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "{legendText}: <strong>{y}%</strong>",
			indexLabel: "{label} {y}%",
			dataPoints: [
				{  y: <?php echo $retailer_percent ?>, legendText: "<?php echo $team_code;?>-Retailer", exploded: true, label: "<?php echo $team_code;?>-Retailer" },
				{  y: <?php echo $wholesaler_percent ?>, legendText: "<?php echo $team_code;?>-Wholesaler", label: "<?php echo $team_code;?>-Wholesaler" },
				{  y: <?php echo $distributor_percent ?>, legendText: "<?php echo $team_code;?>-Distributor", label: "<?php echo $team_code;?>-Distributor" },
				{  y: <?php echo $manufacturer_percent ?>, legendText: "<?php echo $team_code;?>-Manufacturer", label: "<?php echo $team_code;?>-Manufacturer"}				
			]
	}
	]
	});
	chart.render();
});
</script>
<div id='chartContainer' style="height:300px;">

</div>
<div class='row'>
	<div class='col-lg-12'>
	<div class='page-header'>
	<h4><strong>Cost Details</strong></h4>
	</div>
	<table class='table table-hover'>
	<thead>
		<tr>
			<th>Player ID</th>
			<th>Inventory Cost</th>
			<th>Excess Inventory Cost</th>
			<th>Backlog Cost</th>
			<th>Total Cost</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($cost as $c){
			echo "
			<tr>
				<td>". $c->player_id ."</td>
				<td>$". $c->accum_inv ."</td>
				<td>$". $c->accum_ex ."</td>
				<td>$". $c->accum_back ."</td>
				<td><strong>$". $c->total_cost."</strong></td>
			</tr>
			";
		}
		?>
	</tbody>
	</table>
	<h4 style="text-align: right;"><span class='glyphicon glyphicon-exclamation-sign'></span> Team <?php echo $team_code; ?> Total Cost: <strong>$<?php echo $total_cost;?></strong></h4>
	</div>
</div>