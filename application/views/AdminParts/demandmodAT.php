<script type="text/javascript">
	$(document).ready(function(){
		$("form#mod-demand").on('submit', function(){
			var x = $("#weekcount").val();
			var z = $("#demamount").val();
			var y = confirm("Change Week "+x+" demand to "+z+"?\n\nNote: Changing demand will affect gameplay and players with future forecast ability.");
			if(y==true){
				
			}
			else{
				alert("Action canceled.");
				return false;
			}
		});
	});
</script>
<form id='mod-demand' method='post' action='../gamecontroller/modify_demand'>
<div class='form-group'>
<label>Period:</label>
<select class='form-control' name='week' id='weekcount'>
	<?php
	for($x=1;$x<=$turns;$x++){
		if($x <= $current_turn){
			echo "";
		}
		else{
			echo "
			<option value='". $x ."'>
			Week ". $x ."
			</option>
			";
		}
	}
	?>
</select>
</div>
<div class='form-group'>
<label>Amount</label>
<input id='demamount' name='amount' class='form-control' type='number' min='0' placeholder="Change demand to ..." required>
</div>
<button role='submit' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span> Modify</button>
</form>
