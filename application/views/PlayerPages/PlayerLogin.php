<?php
?>
<body>
    <div class="container">       
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 
                 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                <h3><span class="glyphicon glyphicon-knight"></span><b>
                     Player Login</b></h3>
                
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-4  col-md-4 col-sm-4
                 col-sm-offset-4 col-md-offset-4 col-lg-offset-4"
                 >
                <?php
                echo form_open('main/login_validation_p');
                ?>
                <input type='hidden' name='gamename' value="<?php echo $game_name;?>">
                <div class="form-group">
                    <label>Team</label>
                    <select id="sel_team" class="form-control" name="team_name">
                        <?php
                        foreach($team_list as $tl){
                            echo "<option value='". $tl->player_team ."'>";
                            echo $tl->player_team;
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name ="role" class="form-control">
                        <option value="Retailer">Retailer</option>
                        <option value="Wholesaler">Wholesaler</option>
                        <option value="Distributor">Distributor</option>
                        <option value="Manufacturer">Manufacturer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <input class="btn btn-default" type="submit" name="login_submit" value="Login">
                
                <?php
                echo form_close();
                echo "<br>";
                echo validation_errors();
                ?>
            </div>         
        </div>
      </div>
</body>