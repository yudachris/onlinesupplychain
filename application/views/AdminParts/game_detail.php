<script type="text/javascript">
	$(document).ready(function(){
		$("#change_permission").click(function(){

			var change = $.ajax({
            url: "../gamecontroller/login_permit",
        	});
			change.done(function(){
				$("#detail-table").load('../adminpartscontroller/game_detailAT');
				alert("Login Permission Changed.");
			});

		});
	});
</script>
<table class='table table-hover'>
	<thead>
	<tr>
		<th>Details for Game Session [<?php echo $game_name;?>]</th>
	</tr>
	</thead>
	<tbody>
		<tr>
		<th>Facilitator:</th>
		<td><?php echo $facilitator; ?></td>
		</tr>	
		<tr>
		<th>Game Mode:</th>
		<td><?php echo $game_mode; ?></td>
		</tr>
		<tr>
		<th>Login Permission:</th>
		<td><?php echo $permission; ?></td>
		<td><button id='change_permission' class='btn btn-primary'><span class='glyphicon glyphicon-refresh'></span> Change</button></td>
		</tr>
		<tr>
		<th>
		<?php
			if($proceed_allowance === "ok" or $proceed_allowance === "no"){
				echo "Proceed to Next Turn/Week:";
			}
			else if($proceed_allowance ==="endok" or $proceed_allowance === "endno"){
				echo "Proceed to End Game Statistics:";
			}
		?>	 
		</th>
		<td id='allowance'><?php 
		if($proceed_allowance === "ok"){
			echo "Allowed";
		}
		else if($proceed_allowance ==="no"){
			echo "Not Allowed";
		}
		else if($proceed_allowance ==="endok"){
			echo "Allowed";
		}
		else if($proceed_allowance ==="endno"){
			echo "Not Allowed";
		}

		?></td>
		</tr>
	</tbody>
</table>