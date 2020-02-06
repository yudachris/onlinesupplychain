<style type="text/css">
  @media(max-device-width:1001px){
    table{
    font-size: 70%;
  }
  @media(max-device-width:768px){
    table{
    font-size: 60%;
  }
  }
</style> 
    <?php

    if($avail === "yes"){
        for ($x = 1; $x <= $teamlength; $x++) {
        $teamconv = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
            5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
            9 => 'I', 10 => 'J', 11 => 'K',
            12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');

        $p_team = $teamconv[$x];

        echo "<div class='row'>";
        echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
        echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'><h3>Team " . $p_team . "</h3></div>";
        echo "<div class='panel-body'>";
        echo "<table style='margin:0;' class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>
                            <th>Player ID</th>
                            <th>Inventory Usage</th>
                            <th>Excess Inventory</th>
                            <th>Current Backlog</th>
                            <th>Personal Cost</th>
                            <th>Login Status</th>
                            <th>Phase Status</th>
                        </tr>
                    </thead>
                    <tbody>";
               for($role=0;$role<=3;$role++){
                   echo "<tr>";                  
                   echo "<td>". $bigdata[$x-1][$role]->player_id . "</td>";
                   $percentage = number_format((($bigdata[$x-1][$role]->current_inventory/$bigdata[$x-1][$role]->inventory_cap)*100),1);
                   echo "<td>". $percentage . "%</td>";
                   echo "<td>". $bigdata[$x-1][$role]->excess_inventory . "</td>";
                   echo "<td>". $bigdata[$x-1][$role]->current_backlog . "</td>";
                   echo "<td>$". $bigdata[$x-1][$role]->total_cost . "</td>";
                   echo "<td>". $bigdata[$x-1][$role]->login . "</td>";
                   echo "<td>". $bigdata[$x-1][$role]->status . "</td>";
                   if($bigdata[$x-1][$role]->status === "delivered" or $bigdata[$x-1][$role]->status === "standby"){
                      echo "<td><img src='". base_url() ."images/green_light.png'></td>";
                   }
                   else{
                      echo "<td><img src='". base_url() ."images/red_light.png'></td>";
                   }
                   echo "</tr>";
                }
        echo "</tbody>
                </table>
                </div>
            </div>              
        </div>       
    </div>";
    }
    }
    else{
      echo "<h3>Currently no active game</h3>";
    }
    
    ?>

    
