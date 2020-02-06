
<script>
	$(document).ready(function(){

        setInterval(function(){
            $("#costpanel").load("../playerpartscontroller/cost_panel")
        },3000);
		setInterval(function(){
			$("#new_demand").load("../playerpartscontroller/incoming_demand");
		},3000);

		setInterval(function(){
			$("#weekpanel").load("../playerpartscontroller/week_count");
		},3000);

        setInterval(function(){
            $("#onhand").load("../playerpartscontroller/onhand_inventory");
        },3000);

        setInterval(function(){
            $("#intransit").load("../playerpartscontroller/intransits");
        },3000);

        setInterval(function(){
            $("#send-order").load("../playerpartscontroller/order_button");
        },3000);

        setInterval(function(){
            $("#send-deliver").load("../playerpartscontroller/deliver_button");
        },3000);

        setInterval(function(){
            $("#phase").load("../playerpartscontroller/phase");
        },3000);

	});
</script>
<div class="container">
	<div class="container-fluid">
		<ul class="nav nav-pills nav-justified">
		    <li class="active"><a data-toggle="pill" href="#menu1">Dashboard</a></li>
		    <li><a data-toggle="pill" href="#menu2">Statistic Details</a></li>
		    <li><a data-toggle="pill" href="#menu3">History</a></li>
            <li><a data-toggle="pill" href="#menu4">Session Details</a></li>
	    </ul>
	</div>
	<br>
	<div class="tab-content">

	<div id="menu1" class="tab-pane fade in active">
	<!-- Row 1 -->
    <div class="row">
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style='text-align: center;border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray'>
                <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <h3><b>Phase</b></h3>
                </div>
                </div>
                <div class="row" style="text-align: center;" id='phase'>
                
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <h4><b>Standby</b></h4>
                </div>

                </div>
        </div>
    	<div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1
        col-lg-3 col-sm-3 col-md-3 col-xs-3" id="weekpanel" style='text-align: center;border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray'>
        <h3><b>Current Week</b></h3>
        <h4><small><span class="glyphicon glyphicon-hourglass"></span> Loading....</small></h4>
        </div>
        <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1
        col-lg-4 col-sm-4 col-md-4 col-xs-4" id="costpanel" style='text-align: center;border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray'>
            <h3><b>Costs</b></h3>
            <h4><small><span class='glyphicon glyphicon-hourglass'></span> Loading....</small></h4>
        </div>
    </div>
    <!-- Row 2-->
    <br>
    <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3" style="text-align: center; border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray">
            <script type="text/javascript">
                            $(document).ready(function(){
                            $('form#order_input').on('submit',function(){
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
                            
                            $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               success:function(){
                                   alert("Your Demand Has Been Sent!");
                                   
                               }
                            });
                           return false; 
                        }); 
                        });
            </script>
    <h4><b>Your Placing Order to Supplier</b></h4>
    <form action='../player/order_input' id='order_input' method='post'>
    <div class="form-group">
    	<input type="number" class="form-control" name='ordertosupplier' placeholder="Input Your Order">
    </div>
    <div class="form-group" id='send-order'>
    	<input type="submit" class="btn btn-success" value="Send Order" disabled>
    </div>
    </form>
    </div>
    <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1
        col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;text-align: center;border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray;" id='onhand'>
            <h4><b>On-Hand Inventory</b></h4>
            <h3><span class="glyphicon glyphicon-hourglass"></span><small> Loading....</small></h3>
    </div>
    <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1
    col-lg-3 col-md-3 col-sm-3 col-xs-3" id="new_demand" style="text-align: center; border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray">
    <h4>Current Week's Customer's Demand</h4>
    <h3><span class="glyphicon glyphicon-hourglass"></span><small> Loading...</small></h3>
    </div>
    </div>
    <!-- Row 3--> 
   	<br>
    <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8" style="text-align: center;border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray;">

    	<div class="row" id="intransit">
    		<h4><b>Intransit Inventory (Delivery Lead Time)</b></h4>
    		<h3><span class="glyphicon glyphicon-hourglass"></span><small> Loading....</small></h3>
    	</div>
    	
    </div>
    <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-1
    col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border:double #eee 4px;border-radius: 10px;box-shadow: 5px 5px gray;">
    <h4><b>Deliver Goods to Customer</b></h4>
    <script type="text/javascript">
                            $(document).ready(function(){
                            $('form#form_deliv').on('submit',function(){
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
                            
                            $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               success:function(){
                                   alert("Your Goods Has Been Delivered!");
                                   
                               }
                            });
                           return false; 
                        }); 
                        });
            </script>
    <form id='form_deliv' action='../player/deliver_input' method='post'>
    <div class="form-group">
    	</span><input type='number' name='delivertocustomer' class='form-control' placeholder='Input Your Delivery Quantity'>
    </div>
    <div class='form-group' id='send-deliver'>
    	<input type='submit' class='btn btn-success' value='Deliver Goods' disabled>
    </div>
    </form>
    </div>
    </div>
    <!--END OF TAB DASHBOARD-->
    </div>

    <div id="menu2" class="tab-pane fade in">
    </div>

    <div id="menu3" class="tab-pane fade in">
    </div>

    <div id="menu4" class="tab-pane fade in">
    </div>

    </div>
</div>