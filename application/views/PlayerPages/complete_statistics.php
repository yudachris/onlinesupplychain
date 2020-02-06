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
                $("#graph1").load('../playerpartscontroller/costChart');
                $("#graph2").load('../playerpartscontroller/inventoryChart');
                $("#graph3").load('../playerpartscontroller/supdemChart');
                });
        </script>
        <style type="text/css">
                .page-header{
                font-family: 'Poppins', sans-serif;
                text-align: right;
                }
                .pop{
                font-family: 'Poppins', sans-serif;   
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
                    <li><a href="<?php echo base_url(); ?>player/select_diff">Back to Game Module</a></li>
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
</body>
<div class='container'>
        <div class='page-header'>
        <h3><strong><?php print_r($this->session->userdata('username')); ?></strong> Statistics</h3>
        </div>
        <div class='container'>
        <h4 class='pop' style="text-align: right;">[Until Week <?php echo $current_turn-1; ?>]</h4>
        </div>
        <!-- Cost Statistics -->
        <div class='container-fluid'>
        <div class='row'>
                <h3 class='pop'><strong>Cost</strong> Statistics</h3>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                <?php
                    $total = $cost->total_cost;
                            echo "<table class='table table-hover pop' style='text-align:left;'>
                                    <thead>
                                        <tr>
                                            <th>Cost Elements</th>
                                            <th>Amount (Cummulative)</th>
                                        </tr>
                                    </thead>
                                        
                                    <tbody>
                                    <tr>
                                            <td>Inventory Cost</td>
                                            <td>$ ".$cost->accum_inv."</td>
                                        </tr>
                                        <tr>
                                            <td>Excess Inventory Cost</td>
                                            <td>$ ".$cost->accum_ex."</td>
                                        </tr>
                                        <tr>
                                            <td>Backlog Cost</td>
                                            <td>$ ".$cost->accum_back."</td>
                                        </tr>
                                        <tr>
                                            <th>Total Cost</th>
                                            <th>$ ".$total."</th>
                                        </tr>
                                    </tbody>
                                </table>";
                            
                        
                    ?>
                </div>
                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12' id='graph1'>
                    
                </div>
        </div>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                <h3 class='pop'><strong>Inventory</strong> Statistics</h3>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                    <table class='table table-hover pop'>
                    <thead>
                        <tr>
                            <th>Elements</th>
                            <th>Value (Current)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Inventory</td>
                            <td><strong><?php echo $cost->current_inventory; ?></strong> Unit(s)</td>
                        </tr>
                        <tr>
                            <td>Excessive Inventory</td>
                            <td><strong><?php echo $cost->excess_inventory; ?></strong> Unit(s)</td>
                        </tr>
                        <tr>
                            <td>Backlog</td>
                            <td><strong><?php echo $cost->current_backlog; ?></strong> Unit(s)</td>
                        </tr>                       
                    </tbody>
                    </table>
                </div>
                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12' id='graph2'>
                    
                </div>
            </div>
        </div>
        <div class='container-fluid' style="margin-bottom: 20px;">
            <div class='row'>
                <h3 class='pop'>Supply <strong>vs</strong> Demand</h3>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='graph3'>
                    
                </div>
            </div>
        </div>
</div>
</html>