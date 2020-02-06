<script type="text/javascript">
	$(document).ready(function(){

		$("#order-form").on('submit',function(){
			var x = $("#ord_amount").val();
			var y = confirm("Your Order Is: "+x+"\nAre you sure?");
			if(y==true){

			}
			else{
				alert('Action Canceled.');
				return false;
			}
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
<h3><span class='glyphicon glyphicon-earphone'></span> Order Phase | Order Form</h3>
<p>Order to your <strong>Supplier (<?php echo $supplier; ?>)</strong> in order to increase your <strong>inventory level</strong>. Inventory is used to fulfill demands from your <strong>Customer (<?php echo $customer; ?>)</strong> and your backlogs as well.</p>
<form id='order-form' action='../player/order_input' method='post'>
			<div class='form-group'>
			<label><h4><strong>Order Amount</strong></h4></label>
			<input id='ord_amount' class='form-control' name='ordertosupplier' type='number' min='0' required>
			</div>
			<div class='form-group'>
			<button role='submit' type='submit' class='btn btn-success'>Order Now</button>
			</div>
</form>
</div>
</div>