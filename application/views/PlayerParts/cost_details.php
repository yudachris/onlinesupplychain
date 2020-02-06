<?php
$total = $cost->total_cost;
		echo "<table class='table table-hover' style='text-align:left;'>
				<thead>
					<tr>
						<th>Cost Elements</th>
						<th>Amount</th>
					</tr>
				</thead>
					
				<tbody>
				<tr>
						<td>Inventory Cost</td>
						<td>$ ".$cost->accum_inv."</td>
					</tr>
					<tr>
						<td>Excess Inventory Cost</td>
						<td>$ ".$cost->accum_ex."</td>
					</tr>
					<tr>
						<td>Backlog Cost</td>
						<td>$ ".$cost->accum_back."</td>
					</tr>
					<tr>
						<th>Total Cost</th>
						<th>$ ".$total."</th>
					</tr>
				</tbody>
			</table>";
		
	
?>