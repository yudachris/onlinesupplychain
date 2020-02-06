<script type="text/javascript">
	$(document).ready(function(){
		
		$("#playerid").on('change',function(){
			$.post('../playerpartscontroller/lt_decrease_input', { player_id:trigger_form.player_id.value },
				function(result){
					$("#inputfield").empty().append(result);
				});
				var pl = $("#playerid").val();
				$("#hidden_input").val(pl);
					
		});

		$("#submit_lt_dec").click(function(){
			var x = $("#playerid").val();
			var z = $("#amount").val();
			var y = confirm("Decrease "+x+"'s leadtime by "+z+" leadtime(s)?");
			if(y == true){

			}
			else{
				return false;
			}
		});
	});
</script>
<form name='trigger_form'>
<div class='form-group' style='width: 50%;'>
	<label><strong>Target</strong> Team Member</label>
	<select name='player_id' id='playerid' class='form-control'>
		<option value=''>-- Choose Player --</option>
		<?php
			foreach($members  as $mem){
				echo "<option value='". $mem->player_id ."'>";
				echo $mem->player_id;
				echo "</option>";
			}
		?>
	</select>
</div>
</form>
<form action='../player/buy_decrease_lt' method='post'>
<input type='hidden' id='hidden_input' name='player_ids' value=''>
<div class='form-group' id='inputfield' style="width: 50%;">
	<label>Reduce Leadtime By</label>
	<input class='form-control' type='number' placeholder='Choose Player' disabled> 
</div>
<div class='form-group'>
	<button id='submit_lt_dec' role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok-circle'></span> Buy</button>
</div>
</form>