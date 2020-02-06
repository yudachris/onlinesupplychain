

<?php
?>
<body>
<script>
    $(document).ready(function(){

        setTimeout(function(){
            $("#onhand").load("../playerpartscontroller/onhand_inventory");
            $("#costpanel").load("../playerpartscontroller/cost_panel");
            $("#deliveryhistory").load("../playerpartscontroller/deliveryhistory");
            $("#orderhistory").load("../playerpartscontroller/orderhistory");
            $("#weekpanel").load("../playerpartscontroller/week_count");
        },3000);

        $("#reload-dashboard").click(function(){
            $("#costpanel").load("../playerpartscontroller/cost_panel");
            $("#onhand").load("../playerpartscontroller/onhand_inventory");
        });

        $("#reload-supplier").click(function(){
            $("#order_input").load("../playerpartscontroller/order_form");
            $("#intransit").load("../playerpartscontroller/intransits");
        });

        $("#reload-customer").click(function(){
            $("#deliver_input").load("../playerpartscontroller/deliver_form");
            $("#new_demand").load("../playerpartscontroller/incoming_demand");
            $("#backlog").load("../playerpartscontroller/backlog_panel");
        });

        setInterval(function(){
            $("#weekpanel").load("../playerpartscontroller/week_count");
        },15000);

        setInterval(function(){
            $("#phase").load("../playerpartscontroller/phase");
        },3000);

    });

    //form submission
    //order
    $(document).ready(function(){
        $('form#order_input').on('submit',function(){
            var order = $("#order-field").val();
            if(order>0){
                var r = confirm("Your Placing Order is: "+order+"\nAre You Sure?");
            if(r==true){
                $("#orbutton").attr("disabled", true);
            $("#orbutton").removeClass("btn btn-success");
            $("#orbutton").addClass("btn btn-warning"); 
            $("#orbutton").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");
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
        
        var command = $.ajax({
           url : url,
           type : type,
           data : data,
           
        });
        command.done(function(){
            $("#orbutton").removeClass("btn btn-warning");
            $("#orbutton").addClass("btn btn-success");
            $("#orbutton").html("<strong>Order Sent!</strong>");
            $("#orderhistory").load("../playerpartscontroller/orderhistory");
            $("#order-field").val('');
            $("#order-field").attr("disabled",true);
            alert("Your Demand Has Been Sent!");
        });
            
       return false;
            } 
            else{
               $("#order-field").val('');
               return false; 
            }
            }
            else{
                alert("Your can't order a negative value.")
                return false;
            }
    });
    });


    //deliver
    $(document).ready(function(){
        $('form#deliver_input').on('submit',function(){
            var delivery = $("#deliverdrop").val();
            var r = confirm("Your delivery is: "+delivery+"\nAre you sure?");
            if(r==true){
                    $("#delbutton").attr("disabled", true);
                    $("#delbutton").removeClass("btn btn-success");
                    $("#delbutton").addClass("btn btn-warning"); 
                    $("#delbutton").html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Processing...");
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
                
                var command2 = $.ajax({
                   url : url,
                   type : type,
                   data : data,
                   
                });
                command2.done(function(){
                    $("#delbutton").removeClass("btn btn-warning");
                    $("#delbutton").addClass("btn btn-success");
                    $("#delbutton").html("<strong>Goods Sent!</strong>");
                    $("#deliverdrop").attr("disabled",true);
                    $("#deliverdrop").val('');
                    $("#deliveryhistory").load("../playerpartscontroller/deliveryhistory");
                    alert("Your Goods Has Been Sent!");
                });
            }
            else{
                $("#deliverdrop").val('');
                return false;
            }

       return false; 
    }); 
    });
</script>
<style type="text/css">
    .panel-heading{

        font-size: 125%;
    }
    .text-normal{
        text-align: left;
    }
    .besarkan{
        font-size: 150%;
    }
</style>

<div class='container'>
    <div class='row'>
        <div class="container-fluid">
            <ul class="nav nav-pills nav-justified">
                <li id='reload-supplier'><a data-toggle="pill" href="#menu2"><span></span><span class='glyphicon glyphicon-chevron-left'></span> Supplier</a></li>
                <li id='reload-dashboard' class="active"><a data-toggle="pill" href="#menu1">Dashboard</a></li>
                <li id='reload-customer'><a data-toggle="pill" href="#menu3">Customer <span class='glyphicon glyphicon-chevron-right'></span></a></li>
            </ul>
        </div>
    </div>
    <br>
    <!-- TAB CONTENT -->
    <div class='tab-content'>
    <!-- TAB DASHBOARD -->
        <div id='menu1' class='tab-pane fade in active'>
            <div class='row text-center'>
                <div class='col-lg-3'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>Game <strong>Phase</strong></div>
                        <div class='panel-body' id='phase'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</div>
                    </div>
                </div>
                <div class='col-lg-offset-1 col-lg-4'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>Current <strong>Week</strong></div>
                        <div class='panel-body' id='weekpanel'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</div>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'><strong>Cost</strong> Rules</div>
                        <div class='panel-body'>
                            <table class='table'>
                                <thead>
                                <tr>
                                    <th>Inventory Cost</th>
                                    <td>$ <?php echo $cost_rule->inventory_cost;?></td>
                                </tr>
                                <tr>
                                    <th>Excessive Cost</th>
                                    <td>$ <?php echo $cost_rule->excess_cost;?></td>
                                </tr>
                                </thead>
                                <tr>
                                    <th>Backlog Cost</th>
                                    <td>$ <?php echo $cost_rule->backlog_cost;?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row text-center'>
                <div class='col-lg-4'>
                    <div class='panel panel-warning'>
                        <div class='panel-heading'><strong>Accummulated</strong> Cost</div>
                        <div class='panel-body text-normal' id='costpanel'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</div>
                    </div>
                </div>

                <div class='col-lg-8'>
                    <div class='panel panel-primary'>
                            <div class='panel-heading'>Your<strong> Inventory</strong></div>
                            <div class='panel-body' id='onhand'>
                                <div class='row'>
                                    <div class='col-lg-7'>
                                        <div class='panel panel-primary'>
                                        <div class='panel-heading'><strong>On-Hand</strong> Inventory</div>
                                        <div class='panel-body'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</div>
                                        </div>
                                    </div>
                                    <div class='col-lg-5'>
                                        <div class='panel panel-warning'>
                                        <div class='panel-heading'><strong>Excessive</strong> Inventory</div>
                                        <div class='panel-body'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    <!-- TAB SUPPLIER -->
        <div id='menu2' class='tab-pane fade in'>
            <div class='row'>
                <div class='col-lg-4 col-md-4 col-sm-4'>
                    <div class='panel panel-success text-center'>
                        <div class='panel-heading'>Placing <strong>Order</strong> to Supplier</div>
                        <div class='panel-body'>
                            <form action='../player/order_input' id='order_input' method='post'>

                            </form>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-lg-offset-2 col-md-offset-2 col-sm-offset-2'>
                    <div class='panel panel-default'>
                        
                        <div class='panel-heading text-center'>Order <strong>History</strong></div>
                        <div class='panel-body' id='orderhistory' style='height:210px;max-height: 210px; overflow: auto'>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 col-md-12 col-sm-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading text-center'>Supply <strong>Lead Time</strong> (Intransit Inventory)</div>
                        <div class='panel-body' id='intransit'>
                            <span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...
                        </div>
                        <div class='panel-heading text-center' style='color:black;'>
                        <span class='glyphicon glyphicon-chevron-left'></span> Your <strong>Supplier</strong><<--->>Your <strong>Inventory</strong> <span class='glyphicon glyphicon-chevron-right'></span></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- TAB CUSTOMER -->
        <div id='menu3' class='tab-pane fade in'><div class='row'>
                <div class='col-lg-6 col-md-6 col-sm-6'>
                    <div class='panel panel-default'>
                        <script type="text/javascript">
                            
                        </script>
                        <div class='panel-heading text-center'>Delivery <strong>History</strong></div>
                        <div class='panel-body' id='deliveryhistory'style='height:420px;max-height: 420px; overflow: auto'></div>
                    </div>
                </div>
                <div class='col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-4 col-md-4 col-sm-4'>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-primary text-center'>
                            <div class='panel-heading'><strong>This Week</strong> Demand</div>
                            <div class='panel-body' id='new_demand'>
                                <span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-12'>
                        <div class='panel panel-danger text-center'>
                            <div class='panel-heading'><strong>Backlog</strong> (Back Orders)</div>
                            <div class='panel-body' id='backlog'>
                                <span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-12'>
                    <div class='panel panel-success text-center'>
                        <div class='panel-heading'>Deliver <strong>Goods</strong> to Customer</div>
                        <div class='panel-body'>
                            <form id='deliver_input' action='../player/deliver_input' method='post'>

                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>

