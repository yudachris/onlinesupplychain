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
        <script src="<?php echo base_url(); ?>js/gamescript.js"></script>
        
        <title><?php echo $title; ?></title>
        
    </head>
    <body>
    <div class='container'>
        <div class='page-header' style='text-align: right;'>
        <h1><span class='glyphicon glyphicon-cog'></span> New Game Setting Summary</h1>
        </div>
    <div class='row'>
        <div class='col-lg-4 col-md-4 col-sm-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'><h4>Game <strong>Parameters</strong></h4></div>
            <div class='panel-body'>
              <table class='table table-hover'>
              <thead>
              <tr>
                  <td>Facilitator</td>
                  <td><?php echo $fac_name; ?></td>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td>Game Name</td>
                  <td><?php echo $g_name; ?></td>
              </tr>
              <tr>
                  <td>Game Password</td>
                  <td><?php echo $g_pass; ?></td>  
              </tr>
              <tr>
                  <td>Number of Teams</td>
                  <td><?php echo $g_teams; ?> Team(s)</td>  
              </tr>
              <tr>
                  <td>Number of Week/Turns</td>
                  <td><?php echo $g_turn; ?> Turns</td>  
              </tr>
              <tr>
                  <td>Starting Credit</td>
                  <td><?php echo $g_credit; ?> pts.</td>  
              </tr>
              <tr>
                  <td>Supply Lead Time</td>
                  <td><?php echo $g_leadtime; ?> Leadtime(s)</td>  
              </tr>
              </tbody>
              </table>  
            </div>
        </div>
        </div>
        <div class='col-lg-4 col-md-4 col-sm-4'>
            <div class='row'>
                <div class='col-lg-12 col-md-12 col-sm-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'><h4>Cost <strong>Parameters</strong></h4></div>
                        <div class='panel-body'>
                          <table class='table table-hover'>
                          <thead>
                          <tr>
                              <td>Inventory Cost</td>
                              <td>$ <?php echo $g_invcost; ?></td>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>Excessive Inventory Cost</td>
                              <td>$ <?php echo $g_excost; ?></td>
                          </tr>
                          <tr>
                              <td>Backlog Cost</td>
                              <td>$ <?php echo $g_bcost; ?></td>  
                          </tr>
                          </tbody>
                          </table>  
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 col-md-12 col-sm-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'><h4>Inventory <strong>Parameters</strong></h4></div>
                        <div class='panel-body'>
                          <table class='table table-hover'>
                          <thead>
                          <tr>
                              <td>Initial Inventory Capacity</td>
                              <td><?php echo $g_invcap; ?> unit(s)</td>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>Initial On-Hand Inventory</td>
                              <td><?php echo $g_onhand; ?> unit(s)</td>
                          </tr>
                          <tr>
                              <td>Initial In-transit Inventory</td>
                              <td><?php echo $g_intransit; ?> unit(s)</td>  
                          </tr>
                          </tbody>
                          </table>  
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class='col-lg-4 col-md-4 col-sm-4'>
        <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12'>
            <div class='panel panel-default'>
                        <div class='panel-heading'><h4>Item <strong>Settings</strong></h4></div>
                        <div class='panel-body'>
                          <table class='table table-hover'>
                          <thead>
                            <tr>
                              <th>Item Name</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Leadtime Decrease</td>
                              <td><?php echo $G1;?></td>
                            </tr>
                            <tr>
                              <td>Inventory Expansion</td>
                              <td><?php echo $G2;?></td>
                            </tr>
                          </tbody>
                          </table>  
                        </div>
                    </div>
                    </div>
        </div>
        <div class='row'>
            <div class='col-lg-6 col-md-6 col-sm-6'>
            <a href="<?php echo base_url();?>admin/resetting"><button class='btn btn-warning'><span class='glyphicon glyphicon-refresh'></span> Reset Setting</button></a>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6'>
              <form action="<?php echo base_url();?>admin/startgame" method='post'>
                  <input type='hidden' name='g_name' value="<?php echo $g_name; ?>">
                  <input type='hidden' name='g_pass' value="<?php echo $g_pass; ?>">
                  <input type='hidden' name='g_teams' value="<?php echo $g_teams;?>">
                  <input type='hidden' name='g_turn' value="<?php echo $g_turn;?>">
                  <input type='hidden' name='g_credit' value="<?php echo $g_credit;?>">
                  <input type='hidden' name='g_leadtime' value="<?php echo $g_leadtime;?>">
                  <input type='hidden' name='g_invcost' value="<?php echo $g_invcost;?>">
                  <input type='hidden' name='g_excost' value="<?php echo $g_excost;?>">
                  <input type='hidden' name='g_bcost' value="<?php echo $g_bcost;?>">
                  <input type='hidden' name='g_invcap' value="<?php echo $g_invcap;?>">
                  <input type='hidden' name='g_onhand' value="<?php echo $g_onhand;?>">
                  <input type='hidden' name='g_intransit' value="<?php echo $g_intransit;?>">
                  <input type='hidden' name='G1' value="<?php echo $G1;?>">
                  <input type='hidden' name='G2' value="<?php echo $G2;?>">
                  <button role='submit' class='btn btn-success btn-lg'><span class='glyphicon glyphicon-play-circle'></span> Start Game</button>
              </form>
            </div>
        </div>
        </div>
    </div>
    </body>
</html>