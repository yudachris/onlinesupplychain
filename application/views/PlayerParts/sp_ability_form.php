<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_futfor_submit").click(function(){
			var x = $("#playerid").val();
			var y = confirm("Grant future forecast to "+x+"?");
			if(y == true){

			}
			else{
				return false;
			}
		});
	});
</script>

<form action='../player/buy_future_forecast' method='post'>
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
<div class='form-group'>
<?php
	if($status === "ok"){
		echo "<button role='submit' id='btn_futfor_submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok-sign'></span> Buy</button>";
	}
	else{
		echo "<button role='submit' id='btn_futfor_submit' class='btn btn-primary' disabled><span class='glyphicon glyphicon-ok-sign'></span> Buy</button>";
		echo "<br>";
		echo "<p>*Insufficient credit point.</p>";
	}
?>

</div>
</form>