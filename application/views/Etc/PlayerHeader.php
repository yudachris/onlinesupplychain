<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">   
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/mycustom.css"> 
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>      
        <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        
        <title><?php echo $title; ?></title>
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
                    <ul class="nav navbar-nav">
                       <li><a>Phase: <strong></strong></a></li>  
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php
                    if($spability==="yes"){
                        echo "<li><a href='#'>Special <strong>Ability</strong></a></li>";
                    }
                    else{
                        echo "";
                    }
                    ?>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-cog"></span>
                                Options <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a><span class='glyphicon glyphicon-list'></span> Complete History</a></li>
                                <li><a href='<?php echo base_url() . "main/player_logout" ?>'>
                                        <span class="glyphicon glyphicon-log-out"></span> 
                                        Logout</a>
                                </li>
                            </ul>
                    </li>
                        
                        
                    </ul>
                </div>              
            </div>
        </nav>