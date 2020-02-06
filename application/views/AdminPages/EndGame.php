<?php
?>
	<style type="text/css">
	div.container{
		font-family: 'Poppins', sans-serif;
	}
	.print{
		display:none;
	}
	@media print{
		div.container{
			page-break-after: always;
			margin-top: 30px;
		}
		.noprint{
			display: none;
			}
		.print{
			display: block;
		}
		.panel-heading{
			text-align: center;
		}

	}
	</style>
    <div class="container">
    <div class='print'>
    		<h4 style="text-align: center">Online Supply Chain Simulation Game</h4>
    		<h1 style="text-align: center">Game <strong>Report</strong></h1>
    		<table class='table' style="width: 300px;">
    		<thead>
    		<tr>
    			<td>Date</td>
    			<td><?php echo date("d/m/Y")?></td>
    		</tr>
    		</thead>
    		<tr>
    			<td>Game Session</td>
    			<td><?php echo $gamename;?></td>
    		</tr>
    		<tr>
    			<td>Facilitator</td>
    			<td><?php print_r($this->session->userdata('name'))?></td>
    		</tr>
    		</table>
    </div>
        <div class="page-header noprint" style="margin-top: 0;">
        	<div class='row'>
        			<div style="padding-top: 25px;" class='col-lg-6 col-md-6 col-sm-6 col-xs-3'>
        			<button id='printbutton' class='btn btn-primary' onclick="print()"><span class='glyphicon glyphicon-print'></span> Print</button>
        			</div>
        			<div style="text-align: right;" class='col-lg-6 col-md-6 col-sm-6 col-xs-9'>
        			<h3><span class="glyphicon glyphicon-tasks"></span> End Game<strong>
                    Statistics</strong></h3>
        			</div>
        	</div>
        </div>
    <div class='row'>
    <h4 class='noprint' style="margin-top: 0;">Game Session <span class='glyphicon glyphicon-chevron-right'></span> <strong><?php echo $gamename;?></strong></h4>		
    	<div class='col-lg-7 col-md-7 col-sm-7'>
    		<div class='panel panel-primary'>
		    	<div class='panel-heading'>
		    	<h4><span class='glyphicon glyphicon-king'></span> Leaderboards</h4>
		    	</div>
		    	<div class='panel-body'>
		    		<table class='table table-hover'>
						<thead>
							<tr>
								<th></th>
								<th>Rank</th>
								<th>Team Name</th>
								<th>Total Cost</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x=1;
							foreach($teams as $tm){
								if($x==1){
									$suffix = "<span class='glyphicon glyphicon-star'></span>";
								}
								else{
									$suffix ="";
								}
								echo "
								<tr>
								<td>". $suffix ."</td>
								<td>". $x ."</td>
								<td>Team ". $tm->team_code ."</td>
								<td><strong>$". $tm->total_cost ."</strong></td>
								</tr>
								";
								$x=$x+1;
							}
							?>
						</tbody>
					</table>
		    	</div>
	    	</div>
    	</div>
    	<div class='col-lg-5 col-md-5 col-sm-5'>
    		<div class='panel panel-primary'>
		    	<div class='panel-heading'>
		    	<h4><span class='glyphicon glyphicon-king'></span> Best Players</h4>
		    	</div>
		    	<div class='panel-body'>
		    		<table class='table table-hover'>
		    			<thead>
		    				<tr>
		    					<th>Category</th>
		    					<th>Winner</th>
		    					<th>Total Cost</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr>
		    					<td>Best Retailer</td>
		    					<td>
		    					<?php
		    						foreach($best_ret as $b1){
		    							echo $b1->player_id."<br>";
		    						}
		    					?>
		    					</td>
		    					<td><strong>$<?php echo $best_retailer_cost; ?></stron></td>
		    				</tr>
		    				<tr>
		    					<td>Best Wholesaler</td>
		    					<td>
		    						<?php
		    						foreach($best_who as $b2){
		    							echo $b2->player_id."<br>";
		    						}
		    						?>
		    					</td>
		    					<td><strong>$<?php echo $best_wholesaler_cost; ?></strong></td>
		    				</tr>
		    				<tr>
		    					<td>Best Distributor</td>
		    					<td>
		    						<?php
		    						foreach($best_dis as $b3){
		    							echo $b3->player_id."<br>";
		    						}
		    					?>
		    					</td>
		    					<td><strong>$<?php echo $best_distributor_cost; ?></strong></td>
		    				</tr>
		    				<tr>
		    					<td>Best Manufacturer</td>
		    					<td>
		    						<?php
		    						foreach($best_man as $b4){
		    							echo $b4->player_id."<br>";
		    						}
		    					?>
		    					</td>
		    					<td><strong>$<?php echo $best_manufacturer_cost; ?></strong></td>
		    				</tr>	
		    			</tbody>
		    		</table>
		    	</div>
	    	</div>   		
    	</div>
    </div>
    </div>
    <script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>
        		<script src="<?php echo base_url(); ?>js/jquery.canvasjs.min.js"></script> 
    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#p_team").on('change',function(){
    			var qwe = $("#p_team").val();
    			if(qwe === ''){
    				$("#graphs").html("<br><br><h1 style='text-align:center;'>No Team Selected</h1>");
    			}
    			else{
    				$.post('../adminpartscontroller/detailed_statistic', { teamname:frm_team.p_team.value },
    				function(data){
    					$("#graphs").empty().append(data);
    				});
    			}
    		});

    		$("#p_team").on('change', function(){
    			var xyz = $("#p_team").val();
    			$("#detail-title").html("Team "+xyz);
    		});
    	});
    </script>
    <div class='container' style="min-height: 500px;margin-bottom: 40px;">
    	<div class='print'>
    		<h1 id='detail-title' style="text-align: center"></h1>
    	</div>
	    <div class='page-header noprint'>
	    <h3 style="text-align: right;"><span class='glyphicon glyphicon-equalizer'></span> <strong>Detailed</strong> Statistics</h3>
	    </div>
	    <div class='row'>
	    	<div class='col-lg-3 col-md-3 col-sm-3'>
	    	<form name='frm_team' class='noprint'>
	    		<div class='form-group'>
	    			<label>Team</label>
	    			<select id='p_team' name='p_team' class='form-control'>
	    				<option value=''>-- Select Team --</option>
	    				<?php
						foreach($team_sum as $ts){
							echo "
							<option value='". $ts->team_code ."'>Team ". $ts->team_code ."</option>
							";
						}
						?>
	    			</select>
	    		</div>
	    	</form>
	    	</div>
	    	<div class='col-lg-9 col-md-9 col-sm-9' id='graphs'>
	    	<br><br>
	    		<h1 style='text-align: center;'>No Team Selected</h1>
	    	</div>
	    </div>
    </div>
</body>
</html>