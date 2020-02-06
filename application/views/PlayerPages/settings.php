 <!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">   
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/footer.css">
        <link href='https://fonts.googleapis.com/css?family=Josefin+Sans:700' rel='stylesheet' type='text/css'> 
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>      
        <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>js/gamescript.js"></script>
        <script src="<?php echo base_url(); ?>js/waitingroom.js"></script>
        <style type="text/css">
        .panel-body{
            background-color: #e1eae9;
        }
        .shadow{
            text-shadow: 2px 2px 5px black;
        }
        .item{
            height:100px;
            width: 100px;
            border: solid gray 2px;
            border-radius: 10px;
        }
        .item-text{
            text-shadow: 2px 2px 5px black;
            font-family: 'Josefin Sans', sans-serif;
        }
        div.modal{
            font-family: 'Josefin Sans', sans-serif;
        }
        @media(max-device-width:440px) and (orientation:portrait){
            table{
            font-size: 50%;
            }
            .item-text{
            text-shadow: 2px 2px 5px black;
            font-family: 'Josefin Sans', sans-serif;
            }
        
        }
        </style>
    </head>
    <body style="background-image: url(<?php echo base_url()?>images/settings_background.png)">
    <div class='container'>
    <div class='page-header' style="text-align: right;">
    	<h1>Team Setting</h1>
    </div>

    <div class='row'>
        <div class='col-lg-12'>
        <div class='panel panel-default'>
            <div class='panel-body'>
            <div class='row' style='margin-bottom: 10px;'>
                <div class='col-lg-3'>
                <h3>Team <strong><?php echo $team;?></strong> | <a href="../main/player_logout"><button class='btn btn-danger'><span class='glyphicon glyphicon-off'></span> Logout</button></a></h3>
                </div>
                <div class='col-lg-3 col-lg-offset-6'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                    <h4>Credit | <strong class='shadow'><?php echo $credit_amount;?> pts.</strong></h4>
                    </div>
                </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-8'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'><h5>Team <strong>Parameter</strong></h5></div>
                        <div class='panel-body' id='param-table'>
                            <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Player ID</th>
                                    <th>Inventory Capacity</th>
                                    <th>Leadtime</th>
                                    <?php
                                    if($mode === "auto"){
                                        echo "<th  style='text-align:center;'>Forecast Ability</th>";
                                    }
                                    else{
                                        echo "";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($player as $pl){
                                        echo "<tr>";
                                        echo "
                                            <td>". $pl->player_id ."</td>
                                            <td><strong>". $pl->inventory_cap ."</strong> Unit(s)</td>
                                            <td><strong>". $pl->leadtime ."</strong> Leadtime(s)</td>
                                        ";
                                        if($mode === "auto"){
                                            if($pl->spability === "no"){
                                                $spability = "<span class='glyphicon glyphicon-remove-circle'></span>";
                                            }
                                            else{
                                                $spability = "<span class='glyphicon glyphicon-ok-circle'></span>";
                                            }
                                            echo "<td  style='text-align:center;'>". $spability ."</td>";
                                        }
                                        else{
                                            echo "";
                                        }
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='col-lg-4'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                        <h5>Configuration <strong>Item</strong></h5>
                        </div>
                        <div class='panel-body' style="height:300px; overflow: auto;">
                            <?php
                            if($inv_ex_av === "Available"){
                                echo "
                                    <div class='panel panel-primary'>
                                        <div class='panel-heading'>
                                            <div class='row'>
                                                <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                                                <img class='item' src='".base_url()."images/warehouse.jpg'>
                                                </div>
                                                <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7 item-text'>
                                                <h5>Inventory Expansion</h5>
                                                <h5>".$inv_ex_price." pts/Capacity Unit</h5>
                                                <button id='btn_inv_ex' class='btn btn-success' data-toggle='modal' data-target='#item-expansion'><span class='glyphicon glyphicon-shopping-cart'></span> Buy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                            else{
                                echo "";
                            }
                            if($lt_dec_av === "Available"){
                                echo "
                                    <div class='panel panel-primary'>
                                        <div class='panel-heading'>
                                            <div class='row'>
                                                <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                                                <img class='item' src='".base_url()."images/leadtime.jpg'>
                                                </div>
                                                <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7 item-text'>
                                                <h5>Leadtime Decrease</h5>
                                                <h5>".$lt_dec_price." pts/Leadtime</h5>
                                                <button id='btn_lt_dec' data-toggle='modal' data-target='#item-ltdecrease' class='btn btn-success'><span class='glyphicon glyphicon-shopping-cart'></span> Buy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                            else{
                                echo "";
                            }
                            

                            if($fut_for_av === "Available"){
                                echo "
                                    <div class='panel panel-primary'>
                                        <div class='panel-heading'>
                                            <div class='row'>
                                                <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                                                <img class='item' src='".base_url()."images/forecast.jpg'>
                                                </div>
                                                <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7 item-text'>
                                                <h5>Future Forecast</h5>
                                                <h5>".$fut_for_price." pts (1 per Player)</h5>
                                                <button id='btn_fut_for' data-toggle='modal' data-target='#item-forecast' class='btn btn-success'><span class='glyphicon glyphicon-shopping-cart'></span> Buy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                            else{
                            echo "";
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>    
            </div>
            <div class='row'>        
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4'>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#finish_set").click(function(){
                        var y = confirm("Finish with your configuration?\n\nNote: You will not be able to do any further configuration after finishing.");
                        if(y==true){

                        }
                        else{
                            return false;
                        }
                    });
                });
            </script>
            <a href="../player/finish_setting"><button id='finish_set' class='btn btn-lg btn-success'><span class='glyphicon glyphicon-ok-circle'></span> Finish Configuration</button></a>
            </div>
    </div>
            </div>
        </div>
        </div>
    </div>

    
    </div>
<!-- SCRIPT FOR PURCHASE -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn_inv_ex").click(function(){
                $("#inv_exp_frm").load('../playerpartscontroller/inventory_expansion_frm');
            });
            $("#btn_fut_for").click(function(){
                $("#fut_for_frm").load('../playerpartscontroller/spability_frm');
            });
            $("#btn_lt_dec").click(function(){
                $("#lt_dec_frm").load('../playerpartscontroller/lt_decrease_frm');
            });
        });
    </script>

<div class='modal fade' id='item-expansion' role='dialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'>&times;</button>
      <h4 class='modal-title'>Item <strong>Purchase</strong></h4>
    </div>
    <div class='modal-body'>
        <img class='item' src="<?php echo base_url();?>images/warehouse.jpg">
        <h4>Inventory Expansion</h4>
        <div id='inv_exp_frm'>
        <!-- INVENTORY EXPANSION FORM -->
        </div>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
    </div>
    </div>
  </div>
</div>
<div class='modal fade' id='item-ltdecrease' role='dialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'>&times;</button>
      <h4 class='modal-title'>Item <strong>Purchase</strong></h4>
    </div>
    <div class='modal-body'>
        <img class='item' src="<?php echo base_url();?>images/leadtime.jpg">
        <h4>Leadtime Decrease</h4>
        <div id='lt_dec_frm'>
        <!-- LEADTIME DECREASE FORM -->
    </div>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
    </div>
    </div>
  </div>
</div>
<div class='modal fade' id='item-forecast' role='dialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'>&times;</button>
      <h4 class='modal-title'>Item <strong>Purchase</strong></h4>
    </div>
    <div class='modal-body'>
    <img class='item' src="<?php echo base_url();?>images/forecast.jpg">
    <h4>Future Forecast</h4>
    <div id='fut_for_frm'>
        <!-- FUTURE FORECAST FORM -->
    </div>   
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
    </div>
    </div>
  </div>
</div>
</body>
</html>
