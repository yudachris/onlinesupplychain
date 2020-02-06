
<h3><b>Current Week</b></h3>
<h3><?php echo $weekcount; ?> <small>of <b><?php echo $maxweek;?></b> weeks</small></h3>
<?php
$percentage = ceil(($weekcount/$maxweek)*100);

if($percentage == 100){
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-danger active' role='progressbar' aria-valuenow='".$weekcount."' aria-valuemin='0' aria-valuemax='".$maxweek."' style='width:".$percentage."%'>
      		".$percentage."% Progress (Final Week)
    		</div>
  			</div>";
}
else if($percentage > 74){
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-warning active' role='progressbar' aria-valuenow='".$weekcount."' aria-valuemin='0' aria-valuemax='".$maxweek."' style='width:".$percentage."%'>
      		".$percentage."% Progress
    		</div>
  			</div>";
}
else{
	echo "<div class='progress'>
    		<div class='progress-bar progress-bar-striped progress-bar-info active' role='progressbar' aria-valuenow='".$weekcount."' aria-valuemin='0' aria-valuemax='".$maxweek."' style='width:".$percentage."%'>
      		".$percentage."% Progress
    		</div>
  			</div>";
}
?>
