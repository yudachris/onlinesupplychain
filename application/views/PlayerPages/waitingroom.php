<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">   
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/mycustom.css"> 
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>      
        <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>js/gamescript.js"></script>
        <script src="<?php echo base_url(); ?>js/waitingroom.js"></script>
        <style type="text/css">
        div.stat-box{
            border:solid gray 1px;
            border-radius: 10px;
        }
        th{
            font-size: 120%;
            text-shadow: 5px 5px 10px black;
        }
        .panel-heading{
            text-align: center;
        }
        .panel-body{
            text-align: center;
            min-height: 75px;
        }
        @media(max-device-width:445px){
            .readypanel{
                font-size: 75%;
            }
            th{
                font-size: 90%;
            }
            td{
                font-size: 80%;
            }
        }
        @media(max-device-width:320px){
            .readypanel{
                font-size: 50%;
            }
            .readybody{
                font-size: 70%;
            }
        }
        </style>
    </head>
    <body style='background: url(<?php echo base_url()?>images/loadcrane.jpg); background-repeat: no-repeat;'>
            <div class="container">
            <div class='row'>
                <div class='col-lg-4' style='padding: 30px'>
                <a href='../main/player_logout'>
                <button class='btn btn-logout-custom'>
                <span class='glyphicon glyphicon-off'></span> Logout
                </button></a>
                </div>
                <div class='col-lg-8'>
                <div class="page-header" style='text-align: right;'>
                <h2><small><?php print_r($this->session->userdata('username'));?></small> <strong>Waiting</strong> Room</h2>
            </div>
                </div>
            </div>
            
            <div class='row'>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-8'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                <table class='table' style="margin-bottom: 0;">
                        <thead>
                        <tr>
                        <th>Game Name</th>
                        <td><?php echo $gamedata->game_name; ?></td>
                        </tr>
                        </thead>
                        <tr>
                        <th>Game Instructor</th>
                        <td><?php echo $gamedata->made_by; ?></td>
                        </tr>
                        <tr>
                        <th>Your Role</th>
                        <td><?php echo $this->session->userdata('role'); ?></td>
                        </tr>
                </table>
                </div>
                </div>
                </div>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            <h4>Team <strong><?php print_r($this->session->userdata('team')); ?></strong></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style='margin:10px;'>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <div class='panel-group'>
                <div class='panel panel-primary'>
                    <div class="readypanel panel-heading"><strong>Retailer</strong> Status</div>
                    <div id='Retailer' class="readybody panel-body"><h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</h4></div>
                </div>
                <div class='panel panel-primary'>
                    <div class="readypanel panel-heading"><strong>Wholesaler</strong> Status</div>
                    <div id='Wholesaler' class="readybody panel-body"><h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</h4></div>
                </div>
                </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                <div class='panel-group'>
                <div class='panel panel-primary'>
                    <div class="readypanel panel-heading"><strong>Distributor</strong> Status</div>
                    <div id='Distributor' class="readybody panel-body"><h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</h4></div>
                </div>
                <div class='panel panel-primary'>
                    <div class="readypanel panel-heading"><strong>Manufacturer</strong> Status</div>
                    <div id='Manufacturer' class="readybody panel-body"><h4><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</h4></div>
                </div>
                </div>
                </div>

                
            </div>
            
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 
                 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                    <center>
                        <a id="start" href="<?php echo base_url();?>player/select_diff">
                            <button class='btn btn-danger btn-lg' disabled>
                            <span class='glyphicon glyphicon-play-circle'></span> START
                            </button>              
                        </a>
                    </center> 
                </div>                   
            </div>
        </div>   
    </body>
</html>
