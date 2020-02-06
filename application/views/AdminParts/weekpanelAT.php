<div class='panel-heading'>
<h4>Week <?php echo $this_week." of <strong>".$final_week;?></strong></h4>
</div>
<div class='panel-body textcenter'>
	<h4>Game <strong>Progress</strong></h4>
	<?php
$percentage = ceil(($this_week/$final_week)*100);

if($percentage == 100){
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-danger active' role='progressbar' aria-valuenow='".$this_week."' aria-valuemin='0' aria-valuemax='".$final_week."' style='width:".$percentage."%'>
      		".$percentage."% Progress (Final Week)
    		</div>
  			</div>";
}
else if($percentage > 74){
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-warning active' role='progressbar' aria-valuenow='".$this_week."' aria-valuemin='0' aria-valuemax='".$final_week."' style='width:".$percentage."%'>
      		".$percentage."% Progress
    		</div>
  			</div>";
}
else{
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-info active' role='progressbar' aria-valuenow='".$this_week."' aria-valuemin='0' aria-valuemax='".$final_week."' style='width:".$percentage."%'>
      		".$percentage."% Progress
    		</div>
  			</div>";
}
?>
</div>