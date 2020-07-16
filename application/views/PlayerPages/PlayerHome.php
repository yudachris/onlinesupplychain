<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
	<meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">   
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/mycustom.css">
        <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'> 
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.canvasjs.min.js"></script>        
        <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $("#graph").load('../playerpartscontroller/costChart');
                $("#week_panel").load('../playerpartscontroller/week_count');
                $("#cost_panel").load('../playerpartscontroller/cost_panel');
                $("#phase_panel").load('../playerpartscontroller/phase');
                $("#ord_post").load('../playerpartscontroller/posted_order');
                $("#dlv_post").load('../playerpartscontroller/posted_deliver');
                $("#incoming").load('../playerpartscontroller/incoming_supply');
                $("#onhand_inv").load('../playerpartscontroller/onhand_inventory');
                $("#cust_demand").load('../playerpartscontroller/incoming_demand');
                $("#backlog").load('../playerpartscontroller/backlog_panel');


                setInterval(function(){
                    $("#cust_demand").load('../playerpartscontroller/incoming_demand');
                },10000);
                $("#btngrcs").click(function(){
                     $("#graph").load('../playerpartscontroller/costChart');
                });
                $("#btngrinv").click(function(){
                     $("#graph").load('../playerpartscontroller/inventoryChart');
                });
                $("#btngrsp").click(function(){
                    $("#graph").load('../playerpartscontroller/supdemChart');
                });
                $("#dlv_btn").click(function(){
                    $("#dlv_form").load('../playerpartscontroller/deliver_form');
                });
                $("#ord_btn").click(function(){
                    $("#ord_form").load('../playerpartscontroller/order_form');
                }); 
                $("#ord_his_btn").click(function(){
                    $("#ord_history").load('../playerpartscontroller/orderhistory');
                });
                $("#dlv_his_btn").click(function(){
                    $("#dlv_history").load('../playerpartscontroller/deliveryhistory');
                });
                $("#bkl_his_btn").click(function(){
                    $("#bkl_history").load('../playerpartscontroller/backloghistory');
                });
                $("#btn_nxt_incoming").click(function(){
                   $("#lt_diagram").load('../playerpartscontroller/intransits'); 
                });    

                $("#refresh_page").click(function(){
                        $("#refresh_page").attr('disabled',true).removeClass('btn-success').addClass('btn-warning');           
                        $("#graph").load('../playerpartscontroller/costChart');
                        $("#btngrinv").removeClass('active');
                        $("#btngrsp").removeClass('active');
                        $("#btngrcs").addClass('active');
                        $("#cost_panel").load('../playerpartscontroller/cost_panel');
                        $("#phase_panel").load('../playerpartscontroller/phase');
                        $("#ord_post").load('../playerpartscontroller/posted_order');
                        $("#dlv_post").load('../playerpartscontroller/posted_deliver');
                        $("#incoming").load('../playerpartscontroller/incoming_supply');
                        $("#onhand_inv").load('../playerpartscontroller/onhand_inventory');
                        $("#cust_demand").load('../playerpartscontroller/incoming_demand');
                        $("#week_panel").load('../playerpartscontroller/week_count');
                         $("#backlog").load('../playerpartscontroller/backlog_panel');
                        setTimeout(function(){
                            $("#refresh_page").attr('disabled', false).removeClass('btn-warning').addClass('btn-success');
                        },10000)           
                });

                $("#toggle_graphs").click(function(){
                    $("#graphs_body").toggle(1000);
                });
            });


        </script>	
        <style type="text/css"> 
        .panel-body{
            font-family: 'Poppins', sans-serif;   
        }
        .panel-heading{
            font-family: 'Poppins', sans-serif;
        }
        .top-line{
            margin-bottom: 5px;
        }
        .top-line2{
            min-height: 110px;
            
        }
        .tm{
            text-align: center;
        }
        .customfont{
            font-family: 'Poppins', sans-serif;
        }
        @media(max-device-width: 400px){
            h1,h2,h3,h4,h5,p{
                font-size: 95%;
                
            }
        }
        @media(max-device-width: 768px){
            .small{
                font-size: 80%;
            }
            .smaller{
                font-size: 70%;
            }
            .smallest{
                font-size: 65%;
            }
            .smallest2{
                font-size: 60%;
            }
            .minim{
                margin-left: -20px;
            }
        }
        body{
            background-image: url(<?php echo base_url();?>images/blue-background.jpg);
            position:relative;
        }
        .panel-body{
            background-color: #dde0da;
        }

        .spability{
            background-color: black;
            color:gray;
        }
        </style>
</head>
<body>
	<nav class="navbar navbar-default">
            <div class="container-fluid">                               
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NavCol">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" style="cursor: pointer;">                            
                        <span class="glyphicon glyphicon-user"></span>
                                <?php
                                echo "  ";
                                print_r($this->session->userdata('username'));
                                ?></a>
                </div>
                <div class="collapse navbar-collapse" id="NavCol">
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-cog"></span>
                                Options <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>player/complete_history"><span class='glyphicon glyphicon-list'></span> Complete History</a></li>
                                <li><a href="<?php echo base_url();?>player/complete_statistic"><span class='glyphicon glyphicon-tasks'></span> Complete Statistics</a></li>
                                <li class='disabled' title='Coming Soon..'><a href="#"><span class='glyphicon glyphicon-question-sign'></span> User Guide</a></li>
                                <li><a href="<?php echo base_url();?>main/player_logout">
                                        <span class="glyphicon glyphicon-log-out"></span> 
                                        Logout</a>
                                </li>
                            </ul>
                    </li>
                        
                        
                    </ul>
                </div>              
            </div>
        </nav>
    <!-- LINE 1 -->
	<div class='container'>
	<div class='row'>
		<div class='col-lg-5 col-md-5 col-sm-5 col-xs-4'>
		<div class='panel panel-primary tm top-line' id='cost_panel'>
            <h2><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h2>
        </div>
		</div>
		<div class='col-lg-2 col-md-2 col-sm-2 col-xs-4'>
		<div class='panel panel-primary tm top-line'>
        <div class='panel-heading'>
        <h4><strong>Week</strong> <button style="margin-bottom: -10px;margin-top: -5px;" title='Refresh' id='refresh_page' class='btn btn-success'><span class='glyphicon glyphicon-refresh'></span></button></h4>
        </div>
        <div class='panel-body top-line2' id='week_panel'>
            <h2><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h2>
        </div>      
        </div>
		</div>
		<div class='col-lg-5 col-md-5 col-sm-5 col-xs-4'>
		<div class='panel panel-primary tm top-line' id='phase_panel'>
            <h2><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h2>
        </div>
		</div>
	</div>
    </div>
    <!-- LINE 2 -->
    <div class='container'>
	<div class='row'>
		<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
		<div class='panel panel-primary tm'>
        <div class='panel-heading'>
        <h4><button id='toggle_graphs' class='btn btn-primary'><span class='glyphicon glyphicon-eye-open'></span> Show/Hide</button> Player <strong>Statistics</strong></h4>
        </div>
            <div class='panel-body' id='graphs_body'>
            <div class='row'>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <h4 class='smallest customfont'><span class='glyphicon glyphicon-tasks'></span> Your <strong>Performance</strong></h4>
                        <ul class="nav nav-pills nav-stacked">
                        <li class="active smallest" id='btngrcs'><a data-toggle="pill" href="#">
                        <span class='glyphicon glyphicon-chevron-right'></span> Cost</a></li>
                        <li class='smallest' id='btngrinv'><a data-toggle="pill" href="#">
                        <span class='glyphicon glyphicon-chevron-right'></span> Inventories</a></li>
                        <li class='smallest' id='btngrsp'><a data-toggle="pill" href="#">
                        <span class='glyphicon glyphicon-chevron-right'></span> Supply vs Demand</a></li>  
                        </ul>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                            <div class='panel panel-primary tm'>
                        <div class='panel-heading'>
                            <h4 class='smallest'>Posted <strong>Order</strong></h4>
                        </div>
                        <div class='panel-body' id='ord_post'>
                            
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-7'>
                    <div id='graph'>
                    </div>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-2'>
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class='panel panel-danger'>
                            <div class='panel-heading'>
                            <h4 class='smallest'><span class='glyphicon glyphicon-warning-sign'></span> <strong>Backlog</strong></h4>
                            </div>
                            <div class='panel-body' id='backlog'>

                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            <h4 class='smallest'>Dispatched <strong>Delivery</strong></h4>
                        </div>
                        <div class='panel-body' id='dlv_post'>
                            
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
		</div>
	</div>
    </div>
    <!-- LINE 3 -->
    <div class='container'>
	<div class='row'>
		<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
		  <div class='row'>
          <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
            <div class='btn-group-vertical'>
            <!-- ORDER PART -->
              <button type='button' id='ord_btn' class='btn btn-default' data-toggle='modal' data-target='#orders'><h5 class='smallest'>
              <span class='glyphicon glyphicon-earphone'></span> Order</h5></button>
              <div class='modal fade' id='orders' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Order</strong> Product</h4>
                    </div>
                    <div class='modal-body' id='ord_form'>
                       <!-- ORDER FORM -->
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>
            <!-- ORDER HISTORY PART -->
              <button type='button' id='ord_his_btn' class='btn btn-default' data-toggle='modal' data-target='#orderh'><h5 class='smallest'>
              <span class='glyphicon glyphicon-calendar'></span> Order History</h5></button>
              <div class='modal fade' id='orderh' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Order</strong> History</h4>
                    </div>
                    <div class='modal-body' style='height: 200px; overflow: auto;' id='ord_history'>
                       <!-- ORDER HISTORY -->
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>
            <!-- LEAD TIME PART -->
              <button id='btn_nxt_incoming' type='button' class='btn btn-default' data-toggle='modal' data-target='#view_lt'><h5 class='smallest' style='margin:1px;'>
              <span class='glyphicon glyphicon-arrow-right'></span> Next Incoming <br>Supplies</h5></button>
              <div class='modal fade' id='view_lt' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><span class='glyphicon glyphicon-road'></span> Supplies on The Way [<?php print_r($this->session->userdata('username'))?>]</h4>
                    </div>
                    <div class='modal-body' id='lt_diagram'>
                       <!-- Leadtime Diagram -->
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <style type="text/css">
          .bottom-line{
            min-height: 140px;
          }
          </style>
          <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
          <div class='panel panel-primary tm'>
                    <div class='panel-heading'>
                    <h5 class='small'>Incoming <strong>Supply</strong></h5>
                    </div>
                    <div class='panel-body bottom-line' id='incoming'>
                    
                    </div>
            </div>
            </div>
          </div>
		</div>
		<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
		<div class='panel panel-primary tm'>
            <div class='panel-heading'>
            <h4 style="margin-bottom: 0px;"><span class='glyphicon glyphicon-equalizer'></span> On-<strong>Hand</strong></h4>
            </div>
            <div class='panel-body bottom-line'>
            <div class='row' id='onhand_inv'>
                
            </div>
            </div>
        </div>
		</div>
		<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
		  <div class='row'>
          <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <div style='margin-bottom: 2px;' class='panel panel-primary tm'>
                    <div class='panel-heading'>
                    <h5 class='small'>Customer <strong>Demand</strong></h5>
                    </div>
                    <div class='panel-body bottom-line' id='cust_demand'>
                    
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        setTimeout(function(){
                            $("#btn-spability").attr('disabled',false).html("<span class='glyphicon glyphicon-star'></span> Forecast <strong>Ability</strong>");
                        },5000);
                        //special ability
                        $("#btn-spability").click(function(){
                            $("#spability-content").html("<h2 style='text-align:center;'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Forecasting....</h2>");
                            setTimeout(function(){
                                $("#btn-spability").attr('disabled', true).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Forecast Ability [Cooldown]");
                            },100);
                            setTimeout(function(){
                                $("#spability-content").load('../player/future_forecast');
                            },3000);
                            setTimeout(function(){
                                $("#btn-spability").attr('disabled',false).html("<span class='glyphicon glyphicon-star'></span> Forecast <strong>Ability</strong>");
                            },18000);
                        });
                    });
                </script>
                <?php
                    if($spability==="yes"){
                        echo "<button class='btn btn-warning' id='btn-spability' style='cursor:pointer;' data-toggle='modal' data-target='#spability' disabled><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Forecast Ability [Cooldown]</button>";
                    }
                    else{
                        echo "";
                    }
                    ?> 
                <?php
                    if($spability ==="yes"){
                        echo "<div class='spability modal fade' id='spability' role='dialog'>
                              <div class='modal-dialog'>
                                <div class='spability modal-content'>
                                <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  <h4 class='modal-title' style='text-align:center;'><span class='glyphicon glyphicon-eye-open'></span></h4>
                                </div>
                                <div id='spability-content' class='modal-body' style='height:200px;overflow: auto;'>
                                    <h2 style='text-align:center;'><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Forecasting....</h2>
                                </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                </div>
                                </div>
                              </div>
                            </div>";
                    }
                    else{
                        echo "";
                    }
                ?>
          </div>
          <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 minim'>
          <div class='btn-group-vertical'>
            <!--DELIVER PART-->
            <button id='dlv_btn' class='btn btn-default' data-toggle='modal' data-target='#delivers'><h5 class='smallest2'>
            <span class='glyphicon glyphicon-plane'></span> Deliver</h5></button>
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
                <!--DELIVER HISTORY PART-->
            <button id='dlv_his_btn' class='btn btn-default' data-toggle='modal' data-target='#deliverh'><h5 class='smallest2'>
            <span class='glyphicon glyphicon-calendar'></span> Delivery History</h5></button>
            <div class='modal fade' id='deliverh' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Deliver</strong> History</h4>
                    </div>
                    <div class='modal-body' id='dlv_history' style='min-height:200px ; max-height: 200px;overflow: auto;'>
                        
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>
                <!--BACKLOG HISTORY PART-->
            <button id='bkl_his_btn' class='btn btn-default' data-toggle='modal' data-target='#backlogh'><h5 class='smallest2'>
            <span class='glyphicon glyphicon-warning-sign'></span> Backlog History</h5></button>
            <div class='modal fade' id='backlogh' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Backlog</strong> History</h4>
                    </div>
                    <div class='modal-body' id='bkl_history' style='min-height:200px ; max-height: 200px;overflow: auto;'>
                        
                    </div>
                    <div class='modal-footer'>
                    <p><span class='glyphicon glyphicon-exclamation-sign'></span> Backlogs are cummulative.</p>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>
          </div>
          </div>
          </div>

          </div>
		</div>
	</div>