<?php
if($diff=='bgn'){
    echo "";
}
else{
    echo "<script type='text/javascript' src='". base_url() ."js/deliver_form_adv.js'></script>";
}
?>
<?php

if($status==="ok"){
    echo "
        <form id='deliv-form' action='../player/deliver_input' method='post'>
        <div class='form-group'>
        <label>Amount for Delivery:</label>
        <input id='del_amount' class='form-control' name='delivertocustomer' type='number' min='0' max='". $max_deliver ."' placeholder='Input amount for delivery... (Max amount: ". $max_deliver .")' required>
        </div>
        <button id='submit_deliv' role='submit' class='btn btn-success'><span class='glyphicon glyphicon-plane'></span> Deliver</button>
        </form>
    ";
}
else if($status ==="yet"){
    echo "
    <form action='' method='post'>
    <div class='form-group'>
    <label>Amount for Delivery:</label>
    <input disabled class='form-control' type='number' min='0' placeholder='Please wait for your customer's order.' required>
    </div>
    <button disabled role='submit' class='btn btn-success'><span class='glyphicon glyphicon-plane'></span> Deliver</button>
    </form>
    "; 
}
else{

    echo "
    <form action='' method='post'>
    <div class='form-group'>
    <label>Amount for Delivery:</label>
    <input disabled class='form-control' type='number' min='0' placeholder='Delivery will be available in [Deliver Phase]' required>
    </div>
    <button disabled role='submit' class='btn btn-success'><span class='glyphicon glyphicon-plane'></span> Deliver</button>
    </form>
    ";
}

?>
