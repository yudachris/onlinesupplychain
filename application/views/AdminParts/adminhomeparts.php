<?php


if($game === "exists"){
		if($game_data->login_permit==="allow"){
		$permit = "Allowed";
		}
		else{
			$permit ="Restricted";
		}
	echo "<div class='row'>
		<div class='col-lg-4'>
			<h3>Currently Active Game</h3>
			<table class='table'>
				<tr>
				<th>Game Name:</th>
				<td>". $game_data->game_name ."</td>
				</tr>
				<tr>
				<th>Current Week:</th>
				<td>Week ". $game_data->current_turn ." of ". $game_data->end_turn ."</td>
				</tr>
				<tr>
				<th>Login Permission:</th>
				<td>". $permit ."</td>
				</tr>
			</table>
		</div>
		<div class='col-lg-8'>
			<h3>Realtime Statistics</h3>
			<div style='padding:20px;height:350px;
              border:double #eee 4px;border-radius: 10px;overflow:auto;'>
			<table class='table table-striped'>
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Total Cost</th>
                    <th>Credit Balance</th>                 
                </tr>
            </thead>
            <tbody>";
                
                foreach($team as $t){
                    
                    echo "<tr>";
                    echo "<td><b>". $t->team_code ."</b></td>";
                    echo "<td>$". $t->total_cost ."</td>";
                    echo "<td>$". $t->team_credit ."</td>";
                                    
                    echo "</tr>";
                    
                }
                
            echo "</tbody>
        </table>
</div>
		</div>
	</div>";
}
else{
	echo "<div class='row'>
		<div class='col-lg-7'>
			<h3>There is no game on progress currently.</h3>
			<br>
			<ul class='nav nav-pills'>
			<li class='dropdown active'>
			    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Create Game Now
			    <span class='caret'></span></a>
			    <ul class='dropdown-menu'>
					<li class='disabled' title='coming soon..'><a href='#'>
                       <span class='glyphicon glyphicon-new-window'></span> New Game</a>
                    </li>
                    <li><a href='". base_url() ."admin/newgamecustom'>
                    	<span class='glyphicon glyphicon-edit'></span> New Custom Game</a>
                    </li>               
                    <li><a href='". base_url() ."admin/newgamepreset'>
                    	<span class='glyphicon glyphicon-hdd'></span> New Game with Preset Demand</a>
                    </li>
			    </ul>
			</li>
			</ul>
		</div>
	</div>";
}
?>

