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

        <script type="text/javascript">

        $(document).ready(function(){

        	$("#selections").load("../playerpartscontroller/session_selection");

        	$("#refresh").click(function(){
        		$("#selections").load("../playerpartscontroller/session_selection");
        	});


        });
        </script>
        <style type="text/css">
        a:hover{
            text-decoration: none;
        }
        body{
            background-image: url(<?php echo base_url()?>images/containeryard.jpg);
        }
        @media(max-device-width:460px){
            .smaller1{
                font-size: 90%;
            }
        }
        </style>
    </head>
    <body>
<div class='container-fluid'>
<div class='container'>
    <div class='row'>
    <div class='col-lg-4 smaller1' style='padding: 40px'>
    <a href="<?php echo base_url();?>"><span class='glyphicon glyphicon-home'></span> Back Home</a><strong style='color:white;'> | </strong>
    <a id='refresh' href='#'><span class='glyphicon glyphicon-refresh'></span> Refresh</a>
    </div>
    <div class='col-lg-8'>
    <div class='page-header' style='color:white'>
	<h1 class='smaller' style='text-align: right;'><strong>Game Session</strong> Selections</h1>
    </div>
	</div>
    </div>
</div>
    <div class='container' style='color: white'>
    <?php echo validation_errors('<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>','</strong>
  </div>');?>
	<div id='selections'>
			<br><br>
			<h1><span class='glyphicon glyphicon-hourglass'></span> Loading...</h1>
			
	</div>
    </div>
</div>
</body>
</html>