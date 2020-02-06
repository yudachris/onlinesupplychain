<a href="<?php echo base_url();?>admin/playermgmt" target="_blank">Manage Players <span class='glyphicon glyphicon-chevron-right'></span></a>
<table class='table table-hover'>
	<thead>
		<tr>
			<th>Rank</th>
			<th>Team Name</th>
			<th>Total Cost</th>
			<th>Team Credits</th>
			<th>Setting Status</th>
			<th>Ready Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x=1;
		foreach($teams as $tm){
			if($tm->status==="ready"){
				$stat="<span class='glyphicon glyphicon-ok-sign'></span>";
			}
			else{
				$stat="<span class='glyphicon glyphicon-remove-sign'></span>";
			}

			if($tm->setting==="set"){
				$setstat="<span class='glyphicon glyphicon-ok-sign'></span>";
			}
			else{
				$setstat="<span class='glyphicon glyphicon-remove-sign'></span>";
			}
			echo "
			<tr>
			<td>". $x ."</td>
			<td>". $tm->team_code ."</td>
			<td>$". $tm->total_cost ."</td>
			<td>". $tm->team_credit ." pts.</td>
			<td>". $setstat ."</td>
			<td>". $stat ."</td>
			</tr>
			";
			$x=$x+1;
		}
		?>
	</tbody>
</table>