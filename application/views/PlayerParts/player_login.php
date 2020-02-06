                <div class='panel panel-primary'>
                <div class='panel-heading'>
                <h3 class='smallerbottom'>Player <strong>Login</strong></h3>
                <h5 class='smallerbottom'>Selected Game Session: <strong><?php echo $gamename; ?></strong></h5>
                <form action='../main/login_validation_p' method='post'  style='text-decoration: bold'>
                <div class='smallerbottom form-group'>
                    <label>Team</label>
                    <select id='sel_team' class='form-control smallerbottom' name='team_name'>
                        <?php
                        foreach($team_list as $tl){
                            if($tl->player_team === "X"){
                                echo "";
                            }
                            else{
                                echo "<option value='". $tl->player_team ."'>";
                                echo $tl->player_team;
                                echo "</option>"; 
                            }
                            
                        }
                        ?>
                    </select>
                </div>
                <div class='smallerbottom form-group'>
                    <label>Role</label>
                    <select name ='role' class='smallerbottom form-control'>
                        <option value="Retailer">Retailer</option>
                        <option value="Wholesaler">Wholesaler</option>
                        <option value="Distributor">Distributor</option>
                        <option value="Manufacturer">Manufacturer</option>
                    </select>
                </div>
                <div class='smallerbottom form-group'>
                    <label>Password</label>
                    <input type='password' name='password' class='form-control'>
                </div>
                <input type='hidden' name='gamename' value="<?php echo $gamename;?>">
                <input class='smallerbottom btn btn-default-custom'  style='color:black' type='submit' name='login_submit' value='Login'>
                </form>
                </div>
                </div>
                