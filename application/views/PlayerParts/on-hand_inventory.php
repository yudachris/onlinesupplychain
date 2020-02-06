<div class='col-lg-7 col-md-7 col-sm-7 col-xs-6'>
    <h5><strong>Inventory</strong></h5>
    <h5 class='small'><?php echo $current_inv;?> / <strong><?php echo $max_inv;?> <span class='glyphicon glyphicon-gift'></span></strong></h5>
    <?php
$percentage = ceil(($current_inv/$max_inv)*100);
if($percentage == 100){
  echo "<div class='progress'>
        <div class='progress-bar progress-bar-striped progress-bar-danger active' role='progressbar' aria-valuenow='".$current_inv."' aria-valuemin='0' aria-valuemax='".$max_inv."' style='width:".$percentage."%'>
          ".$percentage."% (Max Capacity)
        </div>
        </div>";
}
else if($percentage > 74){
  echo "<div class='progress'>
        <div class='progress-bar progress-bar-striped progress-bar-warning active' role='progressbar' aria-valuenow='".$current_inv."' aria-valuemin='0' aria-valuemax='".$max_inv."' style='width:".$percentage."%'>
          ".$percentage."%
        </div>
        </div>";
}
else{
  echo "<div class='progress'>
        <div class='progress-bar progress-bar-striped progress-bar-info active' role='progressbar' aria-valuenow='".$current_inv."' aria-valuemin='0' aria-valuemax='".$max_inv."' style='width:".$percentage."%'>
          ".$percentage."%
        </div>
        </div>";
}


 ?>
</div>
<div class='col-lg-5 col-md-5 col-sm-5 col-xs-6'>
    <h5 class='smallest'><strong>Excessive</strong> Inventory </h5>
    <h5 style="color: red;"><?php echo $excess;?></h5>
</div>

