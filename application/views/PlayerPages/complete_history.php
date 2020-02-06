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
        <style type="text/css">
        div.panel-heading{
            text-align: center;
        }
        div.panel-body{
            height:300px;
            overflow: auto;
        }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#ord_history").load('../playerpartscontroller/orderhistory');
                 $("#dlv_history").load('../playerpartscontroller/deliveryhistory');
                 $("#bkl_history").load('../playerpartscontroller/backloghistory');
            });
        </script>
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
<div class='container'>
    <div class='page-header' style="text-align: right;">
        <h3><strong><?php print_r($this->session->userdata('username')); ?></strong> History</h3>
    </div>
</div>
<div class='container'>
<div class='row'>
    <div class='col-lg-4 col-md-4'>
    <!-- Order History -->
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <h4><strong>Order</strong> History</h4>
        </div>
        <div class='panel-body' id='ord_history'>
        </div>
    </div>
    </div>
    <div class='col-lg-4 col-md-4'>
    <!-- Delivery History -->
    <div class='panel panel-default'>
        <div class='panel-heading'>
        <h4><strong>Delivery</strong> History</h4>
        </div>
        <div class='panel-body' id='dlv_history'>
        </div>
    </div>
    </div>
    <div class='col-lg-4 col-md-4'>
    <!-- Backlog History -->
    <div class='panel panel-default'>
        <div class='panel-heading'>
        <h4><strong>Backlog</strong> History</h4>
        </div>
        <div class='panel-body' id='bkl_history'>
        </div>
    </div>
    </div>
</div>
</div>
</body>
</html>