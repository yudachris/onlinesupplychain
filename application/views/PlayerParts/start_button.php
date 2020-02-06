
<?php

if($status==="ok"){
    echo "<button class='btn btn-success-custom btn-lg'>
    <span class='glyphicon glyphicon-play-circle'></span> START
</button>";
}
else{
   echo  "<button class='btn btn-danger btn-lg' disabled>
    <span class='glyphicon glyphicon-play-circle'></span> START
</button>";
}

?>

