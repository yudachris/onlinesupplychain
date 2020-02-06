
<table class='table table-hover'>
	<thead>
		<tr>
			<th>Week Count</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php
foreach($history as $his){
	echo "<tr>
	<td>Week ". $his->turn_count ."</td>
	<td>". $his->amount ."</td>
	</tr>";
}
?>
	</tbody>
</table>