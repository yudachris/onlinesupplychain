<script type='text/javascript'>
	$(document).ready(function(){
		$("#dlv_btn").click(function(){
                    $("#dlv_form").load('../playerpartscontroller/deliver_form');
                });
	});
</script>
<?php
$role = $this->session->userdata('role');
if($role=='Retailer'){
	$supplier = "Wholesaler";
	$customer = "Customer";
}
else if($role=='Wholesaler'){
	$supplier = "Distributor";
	$customer = "Retailer";
}
else if($role=='Distributor'){
	$supplier = "Manufacturer";
	$customer = "Wholesaler";
}
else if($role=='Manufacturer'){
	$supplier = "Raw Material Vendor";
	$customer = "Distributor";
}
?>
<style type="text/css">
	.mid{
		text-align: center;
	}
</style>
<div class='row'>
<div class='mid col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3'>
<h3><span class='glyphicon glyphicon-plane'></span> Deliver Phase</h3>
<p>Deliver goods to your <strong>customer (<?php echo $customer; ?>)</strong> to fulfill their <strong>demand</strong> and <strong> redeem your backlogs</strong> as well. Delivery amount is limited according your customer's demand and your inventory level.</p>
<p><span class='glyphicon glyphicon-exclamation-sign'></span> Delivery can only be done after you receive customer demand.</p>
<button id='dlv_btn' class='btn btn-lg btn-success' data-toggle='modal' data-target='#delivers'>Delivery Form</h5></button>
</div>
</div>

<!--MODALS-->
<div class='modal fade' id='delivers' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Deliver</strong> Product</h4>
                    </div>
                    <div class='modal-body' id='dlv_form'>
                       <!-- DELIVERY FORM -->
                    </div>
                    <div class='modal-footer'>
                        <h5><span class='glyphicon glyphicon-exclamation-sign'></span> Note: Unfulfilled demands will be considered as backlog.</h5>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>