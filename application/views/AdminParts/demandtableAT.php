<div style="height: 220px;overflow: auto;margin-bottom: 30px;">
<h4>Preset <strong>Demand</strong></h4>
<table class='table table-hover'>
<thead>
	<tr>
		<th>Periods</th>
		<th>Amount</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
	<?php
		foreach($demands as $dm){
			if($dm->turn_count == $current_turn){
				$button = "<button class='btn btn-primary' id='btn_editdem' data-toggle='modal' data-target='#editdem' disabled><span class='glyphicon glyphicon-edit'></span></button>";
			}
			else{
				$button = "<button title='Edit Value' class='btn btn-primary' id='btn_editdem' data-toggle='modal' data-target='#editdem'><span class='glyphicon glyphicon-edit'></span></button>";
			}
			echo "
			<tr>
			<td>Week ". $dm->turn_count ."</td>
			<td><strong>". $dm->amount ."</strong> Unit(s)</td>
			<td>". $button ."</td>
			</tr>
			";
		}
	?>
</tbody>
</table>
</div>