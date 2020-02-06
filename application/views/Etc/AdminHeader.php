<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">   
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/mycustom.css"> 
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'> 
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>      
        <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>js/gamescript.js"></script>
        <style type="text/css">
            html,body{
                height:100%;
            }
            .container{
                min-height: 75%;
               
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#stop_game").click(function(){
                    var y = confirm("Stopping the game will erase current game's parameters.\n\nProceed and stop game?");
                    if(y==true){

                    }
                    else{
                       return false; 
                    }
                    
                });
            });
        </script>
        
        <title><?php echo $title; ?></title>
        
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid ">                               
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NavCol">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" style="cursor: pointer;">                            
                        SC.Simulation</a>
                </div>
                <div class="collapse navbar-collapse" id="NavCol">
                    <ul class="nav navbar-nav">
                       <li><a href="<?php echo base_url(); ?>admin/adminhome">
                                    <span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-play-circle"></span>
                                The Game <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">
                                    <span class="glyphicon glyphicon-chevron-right"></span> New Game
                                </li>
                                    <?php
                                        if($availability == 0){
                                            echo "<li class='disabled' title='Coming Soon..'><a href='#'>
                                        <span class='glyphicon glyphicon-new-window'></span>
                                         New Game</a>
                                    </li>
                                    <li class='disabled' title='Coming Soon..'><a href='#'>
                                        <span class='glyphicon glyphicon-edit'></span> New Custom Game</a>
                                    </li>
                                    <li><a href='". base_url() ."admin/newgamepreset'>
                                        <span class='glyphicon glyphicon-hdd'></span> New Custom Game with Preset Demand</a>
                                    </li>";
                                        }
                                        else{
                                            echo "<li class='disabled'><a>
                                        <span class='glyphicon glyphicon-new-window'></span>
                                         New Game</a>
                                    </li>
                                    <li class='disabled'><a>
                                        <span class='glyphicon glyphicon-edit'></span> New Custom Game</a>
                                    </li>
                                    <li class='disabled'><a>
                                        <span class='glyphicon glyphicon-hdd'></span> New Game with Preset Demand</a>
                                    </li>";
                                        }
                                    ?>
                                    
                                        
                                        <li class="divider"></li>

                                <li class="dropdown-header">
                                    <span class="glyphicon glyphicon-chevron-right"></span> Progressing Game
                                </li>
                                        <?php
                                        if($availability == 1){
                                            echo "<li><a href='". base_url() ."admin/dashboard'>
                                                <span class='glyphicon glyphicon-transfer'></span>
                                        Game on Progress</a></li>";
                                        }
                                        else{
                                            echo "<li class='disabled'><a href='#'>
                                                <span class='glyphicon glyphicon-transfer'></span>
                                        Game on Progress</a></li>";
                                        }
                                        ?>
                                    <?php
                                        if($availability == 1){
                                            echo "<li>
                                            <a href='". base_url() ."admin/playermgmt'><span class='glyphicon glyphicon-user'></span> 
                                                Player Management</a>
                                        </li>";
                                        }
                                        else{
                                            echo "<li class='disabled'><a href='#'><span class='glyphicon glyphicon-user'></span> 
                                                Player Management</a></li>";
                                        }
                                    ?> 
                                                       
                                <?php
                                        if($availability == 1){
                                            echo "<li id='stop_game'><a href='". base_url() ."gamecontroller/stopgame'>
                                        <span class='glyphicon glyphicon-stop'></span>
                                        Stop & Delete Game</a></li>";
                                        }
                                        else{
                                            echo "<li class='disabled'><a href='#'>
                                        <span class='glyphicon glyphicon-stop'></span>
                                        Stop & Delete Game</a></li>";
                                        }
                                        ?>
                            </ul>
                        </li>                           
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-cog"></span>
                                Settings <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">
                                    <span class="glyphicon glyphicon-chevron-right"></span>User Settings
                                </li>
                                <li>
                                    <a href="../admin/user_management">
                                        Manage User Data</a>
                                </li> 
                                <li class="divider"></li>
                                <li class="dropdown-header">
                                    <span class="glyphicon glyphicon-chevron-right"></span>Game Settings
                                </li>
                                <li>
                                    <a href="../admin/game_management">
                                        Game Management</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-paperclip"></span>
                                Utility <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url();?>main/coming_soon">
                                        <span class="glyphicon glyphicon-question-sign"></span> 
                                        Administrator Guide
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a><span class="glyphicon glyphicon-user"></span>
                                <?php
                                echo "  ";
                                print_r($this->session->userdata('username'));
                                ?></a></li>
                        <li><a href='<?php echo base_url() . "main/logout" ?>'>
                                <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>              
            </div>
        </nav>
        
        
        