<script type="text/javascript">
	$(document).ready(function(){
		$("#submit_expansion").click(function(){
			var x = $("#playerid").val();
			var z = $("#amount").val();
			var y = confirm("Expand "+x+"'s inventory capacity by "+z+"?");
			if(y == true){

			}
			else{
				return false;
			}
		});
	});
</script>
<form id='inventory_expansion_form' action='../player/buy_expansion' method='post'>
<div class='form-group' style='width: 50%;'>
	<label><strong>Target</strong> Team Member</label>
	<select name='player_id' id='playerid' class='form-control'>
		<?php
			foreach($members  as $mem){
				echo "<option value='". $mem->player_id ."'>";
				echo $mem->player_id;
				echo "</option>";
			}
		?>
	</select>
</div>
<div class='form-group' style='width: 50%;'>
	<label>Amount of <strong>Expansion</strong></label>
	<input name='amount' id='amount' class='form-control' type='number' min='0' max="<?php echo $max;?>" placeholder="Maximum expansion amount: <?php echo $max;?>">
</div>
<div class='form-group'>
	<button id='submit_expansion' role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok-circle'></span> Buy</button>
</div>
</form>