<?php ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#invcap").change(function(){
            $("#onhand").attr("max",$("#invcap").val());
            $("#onhand").attr("placeholder", 'Maximum on-hand is: '+$("#invcap").val());
        });
    });
</script>
<div class="container">

    <div class="page-header" style="text-align: right;">
        <h1>Start New Game
            <small> 
                <span class="glyphicon glyphicon-cog"></span> Custom Settings</small></h1>
    </div>
    <!--    setting form    !-->
    <?php echo form_open('../admin/setting_validation'); 
    echo validation_errors();
    ?>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
            <div class="page-header">
                <h3>General Setting</h3>
            </div>          
        </div>
        <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3
             col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="page-header">
                <h3>Item Setting</h3>
            </div>
        </div>
    </div>
    <div class="row">        
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">            
            <div class="form-group">
                <label>Game Name:</label>
                <input class="form-control" type="text" name="g_name" placeholder="Set Game Name">
            </div>
            <div class="form-group">
                <label>Game Password:</label>
                <input class="form-control" type="text" name="g_pass">
            </div>           
            <div class="form-group">
                <label>Number of Teams:</label>
                <input class='form-control' name='g_team' min='1' max='15' placeholder='Maximum 15 Teams'>
            </div>
            <div class="form-group">
                <label>Number of Turns:</label>
                <input type="number" min="1" class="form-control" name="g_turn">
            </div>
            <div class="form-group">
                <label>Starting Credit:</label>
                <input  type="number" class="form-control" name="g_credit" min='0'>
            </div>
            <div class="form-group">
                <label>Inventory Cost:</label>
                <input  type="number" class="form-control" name="g_invcost" min="0">
            </div>           
            
        </div>
            <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
                <div class="form-group">
                <label>Excess Inventory Cost:</label>
                <input  type="number" class="form-control" name="g_exinvcost" min="0">
            </div>
                <div class="form-group">
                <label>Backlog Cost:</label>
                <input  type="number" class="form-control" name="g_backcost" min="0">
            </div>
                <div class="form-group">
                    <label>Initial Inventory Capacity:</label>
                    <input type="number" id='invcap' class="form-control" name="init_inv_cap" min="1">
                </div>
                <div class="form-group">
                    <label>Initial On-Hand Inventory:</label>
                    <input type="number" id='onhand' class="form-control" name="init_inv_lev" min="1">
                </div>          
                <div class="form-group">
                    <label>Supply Lead Time:</label>
                    <input class='form-control' type='number' min='1' max='5' name='lead_time' placeholder='Maximum 5 Lead Times'>
                </div>
                <div class="form-group">
                    <label>Initial In-transit Inventory Level:</label>
                    <input type="number" class="form-control" name="lt_inv_lev" min="1">
                </div>
            </div>           
            
            <!--TABEL ITEMS-->   
        <div id="itemHolder" class="col-md-6 col-sm-6 col-xs-6 col-lg-6">          
            <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price 
                            <a href='../admin/game_management' target='_blank'><br>(<span class='glyphicon glyphicon-wrench'></span> edit prices)</a>
                            </th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($items as $it){
                            if($it->good_id === "G3"){
                                echo "";
                            }
                            else{
                                echo "<tr>
                            <td>". $it->good_name ."</td>
                            <td>". $it->price ."</td>
                            <td>
                            <div class='form-group'>
                                <select class='form-control' name='availability". $it->good_id ."'>
                                    <option value='Available'>Available</option>
                                    <option value='Unavailable'>Unavailable</option>
                                </select>
                            </div>
                            </td>
                            </tr>";
                                }
                        }
                        ?>
                    </tbody>
                    </table>
        </div>
    </div>
    <br>
    <div class="row" style='margin-bottom: 20px;'>
        <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-4
             col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <button role="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-ok-circle"></span>
                 Finish Your Setting</button>        
        </div>
    </div>
    <?php echo form_close(); ?>
</div>