<script type="text/javascript">
	$(document).ready(function(){
		$("#order-form").on('submit',function(){
			var x = $("#ord_amount").val();
			var y = confirm("Your Order Is: "+x+"\nAre you sure?");
			if(y==true){
				$("#submit_order").attr('disabled',true).removeClass('btn-success').addClass('btn-warning').html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Please Wait...");
				var that = $(this),
		        url= that.attr('action'),
		        type = that.attr('method'),
		        data = {};
		        
		        that.find('[name]').each(function(index, value){
		            var that = $(this),
		            name = that.attr('name'),
		            value = that.val();
		            
		            data[name] = value;
		        });
		        
		        var posting = $.ajax({
		           url : url,
		           type : type,
		           data : data,
		           
		        });
		        posting.done(function(){
		        	$("#ord_amount").attr('disabled',true).attr('placeholder', "Order Sent.");
		        	$("#submit_order").removeClass('btn-warning').addClass('btn-success').html("<span class='glyphicon glyphicon-ok-circle'></span> Ordered</button>");
		        	$("#phase_panel").load('../playerpartscontroller/phase');
                	$("#ord_post").load('../playerpartscontroller/posted_order');
		        	alert('Product Successfuly Ordered!\nYou can now proceed to deliver product.');
		        });
		       
		        return false;
			}
			else{
				return false;
			}
		});
	});
</script>

<?php

	if($status==="ok"){
		echo "
		<form id='order-form' action='../player/order_input' method='post'>
		<div class='form-group'>
		<label>Amount for Order:</label>
		<input name='ordertosupplier' id='ord_amount' class='form-control' type='number' min='0' placeholder='Input your placing order...' required>
		</div>
		<button id='submit_order' role='submit' class='btn btn-success'><span class='glyphicon glyphicon-earphone'></span> Order</button>
		</form>
		";
	}
	else{
		echo "
		<form action='../player/order_input' method='post'>
		<div class='form-group'>
		<label>Amount for Order:</label>
		<input disabled class='form-control' type='number' min='0' placeholder='Posting Order will be available in [Order Phase]...' required>
		</div>
		<button disabled role='submit' class='btn btn-success'><span class='glyphicon glyphicon-earphone'></span> Order</button>
		</form>
		";
	}

?>
