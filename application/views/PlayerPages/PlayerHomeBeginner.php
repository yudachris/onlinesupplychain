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
        <script type='text/javascript'>
            $(document).ready(function(){
                $("#workspace").load('../playerpartscontroller/workspace');
                $("#week_panel").load('../playerpartscontroller/week_count');
                $("#cost_panel").load('../playerpartscontroller/cost_panel');
                $("#phase_panel").load('../playerpartscontroller/phase');

                $("#inc_btn").click(function(){
                    $("#cust_demand").load('../playerpartscontroller/incoming_demand');
                });
                $("#transits_btn").click(function(){
                    $("#transits_pane").load('../playerpartscontroller/transits_bgn');
                });
                $("#inv_btn").click(function(){
                    $("#onhand_inv").load('../playerpartscontroller/onhand_inventory');
                });
                $("#bkl_btn").click(function(){
                    $("#backlog").load('../playerpartscontroller/backlog_panel');
                });
                $("#bkl_his_btn").click(function(){
                    $("#bkl_history").load('../playerpartscontroller/backloghistory');
                });
                 $("#ord_his_btn").click(function(){
                    $("#ord_history").load('../playerpartscontroller/orderhistory');
                });
                $("#dlv_his_btn").click(function(){
                    $("#dlv_history").load('../playerpartscontroller/deliveryhistory');
                });
            });
        </script>
        <style>
        .topline{
                padding-top:1px;
                padding-bottom:1px;
        }
        @media(max-device-width: 740px){
            h1,h2,h3,h4,h5,p{
                font-size: 95%;
                
            }
        }
        </style>
</head>
<body>  
        <nav class="navbar navbar-default" style=''>
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
        <!--ACTUAL PAGE -->
        <div class='container-fluid'>
                <div class='row'>
                        <div style='text-align: center;' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                        <div class='panel panel-success' id='cost_panel'>
                        <div class='topline panel-heading'>
                        <h4><strong>Cost</strong></h4>
                        </div>
                        <div class='panel-body'>
                        <h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h4>
                        </div>
                        </div>
                        </div>
                        <div style='text-align: center;' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                        <div class='panel panel-success'>
                        <div class='panel-heading'>
                        <h4><strong>Week</strong><a href="<?php echo base_url();?>player/select_diff"><button style="margin-left:5px;" class='btn btn-primary'><span class='glyphicon glyphicon-refresh'></span></button></a></h4>
                        </div>
                        <div class='panel-body' id='week_panel'>
                        <h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h>
                        </div>
                        </div>
                        </div>
                        <div style='text-align: center;' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                        <div class='panel panel-success' id='phase_panel'>
                        <div class='topline panel-heading'>
                        <h4>Current <strong>Phase</strong></h4>
                        </div>
                        <div class='panel-body'>
                        <h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span></h4>
                        </div>
                        </div>
                        </div>
                </div>
        </div>
        <!--WORKPLACE-->
<div class='container-fluid'>
        <div class='row'>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <!--WORKPLACE-->
                <div class='panel panel-success'>
                <div class='topline panel-heading'>
                <h3><center><strong>Workspace</strong></center></h3>
                </div>
                <div class='panel-body' style="min-height:280px;">
                    <div class='container-fluid' id='workspace'>
                            
                    </div>
                </div>
                </div>
        </div>
        </div>
</div>
 <!--STATISTICS-->
<div class='container-fluid'>
<style type="text/css">
        @media(max-device-width:480px){
            .util{
            font-size: 50%;
        }
    }
    </style>
    <div class='row'>
    <div class='col-lg-2 col-md-2 col-sm-3 col-xs-3'>
    <h4 class='util'><strong>Utilities</strong> <span class='glyphicon glyphicon-chevron-right'></span></h4>
    </div>
    <div class='col-lg-10 col-md-10 col-sm-9 col-xs-9'>
        <div class='btn-group'>
            
            <button id='inc_btn'  data-toggle='modal' data-target='#inc_panel' class='util btn btn-danger'>Customer Demand</button>
            <button id='inv_btn'  data-toggle='modal' data-target='#inv_panel' class='util btn btn-success'>Inventory</button>
            <button id='bkl_btn' data-toggle='modal' data-target='#bkl_panel' class='util btn btn-success'>Backlog</button>
            <button id='transits_btn' data-toggle='modal' data-target='#transits' class='util btn btn-success'>Transits/Leadtime</button>           
            <button id='ord_his_btn' data-toggle='modal' data-target='#orderh' class='util btn btn-success'>Order History</button>         
            <button id='dlv_his_btn' data-toggle='modal' data-target='#deliverh' class='util btn btn-success'>Deliver History</button>
            <button id='bkl_his_btn'  data-toggle='modal' data-target='#backlogh' class='util btn btn-success'>Backlog History</button>
        </div>
    </div>
    </div>
</div>
<!--INCOMING DEMAND-->
            <div class='modal fade' id='inc_panel' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><span class='glyphicon glyphicon-envelope'></span> <strong>Incoming Demand</strong></h4>
                    </div>
                    <div class='modal-body' style='padding-top:12%;text-align:center;min-height:200px ; max-height: 200px;overflow: auto;'>
                        <div id="cust_demand">
                        </div>
                    </div>
                    <div class='modal-footer'>
                    <p><span class='glyphicon glyphicon-exclamation-sign'></span> This is your customer's demand. Fulfill this demand, or otherwise you will get your backlog increased.</p>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
            </div>
<!--INVENTORY-->
            <div class='modal fade' id='inv_panel' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><span class='glyphicon glyphicon-equalizer'></span> <strong>Inventory Levels</strong></h4>
                    </div>
                    <div class='modal-body' style='padding-top:12%;text-align:center;min-height:200px ; max-height: 200px;overflow: auto;'>
                        <div class='row' id='onhand_inv'>
                
                        </div>
                    </div>
                    <div class='modal-footer'>
                    <p><span class='glyphicon glyphicon-exclamation-sign'></span> You <strong>increase</strong> the inventory level by ordering and receiving goods and you <strong>decrease</strong> the inventory level when you deliver it to your customer.</p>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
            </div>
<!--BACKLOG-->
            <div class='modal fade' id='bkl_panel' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><span class='glyphicon glyphicon-warning-sign'></span> <strong>Backlog</strong></h4>
                    </div>
                    <div class='modal-body' style='text-align:center;padding-top:12%;min-height:200px ; max-height: 200px;overflow: auto;'>
                        <div id='backlog'>
                        
                        </div>
                        <strong>Backlogs</strong>
                    </div>
                    <div class='modal-footer'>
                    <p><span class='glyphicon glyphicon-exclamation-sign'></span> You <strong>increase</strong> backlog if you deliver less goods than ordered amount by your customer.</p>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
            </div>
<!--TRANSIT/LEADTIME-->
            <div class='modal fade' id='transits' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Transits/Delivery Leadtime</strong></h4>
                    </div>
                    <div class='modal-body' style='height: 200px; overflow: auto;' id='transits_pane'>
                       
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
            </div>
<!--ORDER HISTORY-->
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
<!--DELIVER HISTORY-->
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
<!--BACKLOG-->
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
</body>
</html>