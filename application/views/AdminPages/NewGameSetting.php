<?php
?>
<div class="container">
    
    <div class="page-header">
        <h1>Start New Game
            <small> 
                <span class="glyphicon glyphicon-cog"></span> Settings</small></h1>
    </div>
<!--    setting form-->
<?php echo form_open('admin/setting_validation');?>
    <div class="row">
        <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1
             col-md-5 col-sm-5 col-xs-5 col-lg-5">
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
                <select class="form-control" name="g_team">
                    <?php 
                    for ($x=1; $x<=15; $x++){
                        echo "<option value='" . $x . "'>";
                        echo $x;
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Number of Turns:</label>
                <input type="text" class="form-control" name="g_turn" placeholder="Input numbers only">
            </div>
            <div class="form-group">
                <label>Starting Credit:</label>
                <input  type="text" class="form-control" name="g_credit" placeholder="Input numbers only">
            </div>
            <input type="submit" name="submit_setting" class="btn btn-success" value="Finish">
        </div>
    </div>
<?php echo form_close();?>
    
</div>