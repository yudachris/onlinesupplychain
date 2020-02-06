<style type="text/css">

@media(min-device-width:500px){
        .adj{
                padding-top: 13px;
                padding-bottom: 13px;
        }
}

</style>

<?php

if($phase_name === "order"){
        echo "<div class='panel-heading'>
            <h4>Current <strong>Phase</strong></h4>
            </div>
            <div class='panel-body top-line2'>
            <br>
            <h4><small><span class='glyphicon glyphicon-earphone'></span></small> <strong>Order</strong> Phase</h4>
            </div>";
}

else if($phase_name === "deliver"){
        echo "<div class='panel-heading'>
            <h4>Current <strong>Phase</strong></h4>
            </div>
            <div class='panel-body top-line2'>
            <br>
            <h4><small><span class='glyphicon glyphicon-plane'></span></small> <strong>Deliver</strong> Phase</h4>
            </div>";
}

else{
        echo "<div class='panel-heading'>
            <h4>Current <strong>Phase</strong></h4>
            </div>
            <div class='panel-body top-line2'>
            <br>
            <h4 class='adj'><small><span class='glyphicon glyphicon-tent'></span></small> <strong>Standby</strong></h4>
            </div>"; 
}

?>
