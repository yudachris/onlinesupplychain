<style type="text/css">
	.textcenter{
		text-align: center;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#weekpanel").load('../adminpartscontroller/weekpanelAT');
		$("#statistic-table").load('../adminpartscontroller/stattableAT');
		$("#demand-table").load('../adminpartscontroller/demandtableAT');
		$("#demand-active").load('../adminpartscontroller/demandactiveAT');
		$("#detail-table").load('../adminpartscontroller/game_detailAT');

		//add turn button
		$("#addturn").click(function(){
			var p = $("#allowance").html();
			if(p==="Not Allowed"){
				alert("Cannot move to the next turn.");
			}
			else{
				var y = confirm("Moving to the next turn?");
			if(y==true){
				$("#addturn").removeClass("btn-primary").addClass("btn-warning").attr("disabled",true).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Next Turn");
				var loading = $.ajax({
            	url: "../gamecontroller/add_turn",
        		});
        		loading.done(function(){
        			window.location.replace("<?php echo base_url();?>admin/dashboard");
        		});
			}
			else{
				alert("Turn movement canceled.");
			}
			}
			
		});

		//endgame button
		$("#endgamestat").click(function(){
			var p = $("#allowance").html();
			if(p === "Not Allowed"){
				alert("Cannot proceed to End Game Statistics.");
			}
			else{
				var y = confirm("Finish Game and View Final Statistics?");
				if(y==true){
				$("#endgamestat").attr("disabled",true).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Next Turn");
				var loading = $.ajax({
            	url: "../gamecontroller/add_turn",
        		});
        		loading.done(function(){
        			window.location.replace("<?php echo base_url();?>admin/end_statistics");
        		});
				}
				else{
					return false;
				}
			}
		});

		$("#btn_editdem").click(function(){
			$("#demand-modifier").load('../adminpartscontroller/demandmodAT');
		});
		$("#li1").click(function(){
			$("#detail-table").load('../adminpartscontroller/game_detailAT');
		});
		$("#li2").click(function(){
			$("#statistic-table").load('../adminpartscontroller/stattableAT');
		});
		$("#li3").click(function(){
			$("#demand-table").load('../adminpartscontroller/demandtableAT');
			$("#demand-modifier").load('../adminpartscontroller/demandmodAT');
			$("#demand-active").load('../adminpartscontroller/demandactiveAT');
		});
	});
</script>
<div class='container'>
	<div class='row'>
		<div class='col-lg-4 col-md-4 col-sm-4'>

								<div class='panel panel-primary'>
								<div class='panel-heading'>
								<h4><strong>Active</strong> Demand</h4>
								</div>
								<div class='panel-body' id='demand-active' style="text-align: center;">

								</div>
								</div>
								
		</div>
		<div class='col-lg-4 col-md-4 col-sm-4'>
			<div class='panel panel-primary textcenter' id='weekpanel'>
			
			</div>
		</div>
		<div class='col-lg-4 col-md-4 col-sm-4'>
			<?php
				if($next_btn_avail === "endno" or $next_btn_avail === "endok"){
					echo "
						<button id='endgamestat' class='btn btn-warning btn-lg'><span class='glyphicon glyphicon-tasks'></span> End Game</button>
					";
				}
				else{
					echo "
						<button id='addturn' class='btn btn-primary btn-lg'><span class='glyphicon glyphicon-plus-sign'></span> Next Turn</button>
					";
				}
			?>
			
		</div>
	</div>

	<div class='row'>
		<div class='col-lg-3 col-md-3 col-sm-3'>
			<ul class="nav nav-pills nav-stacked">
			    <li class="active" id='li1'><a data-toggle="pill" href="#menu1">Game Details</a></li>
			    <li id='li3'><a data-toggle="pill" href="#menu3">Demands</a></li>
			    <li id='li2'><a data-toggle="pill" href="#menu2"><strong>Overall</strong> Statistics</a></li>
			    <li id='li3'><a data-toggle="pill" href="#menu4"><strong>Detailed</strong> Statistics</a></li>
		    </ul>
		</div>
		<div class='col-lg-9 col-md-9 col-sm-9'>
		<div class='tab-content'>
			<div id="menu1" class="tab-pane fade in active">
				<div class='row'>
					<div class='col-lg-12 col-md-12 col-sm-12'>
					<div class='panel panel-primary'>
						<div class='panel-heading' style='text-align: right;'>
						Game <strong>Details</strong>
						</div>
						<div class='panel-body' id='detail-table'>
						
						</div>
					</div>
					</div>
				</div>
			</div>	
			<!-- Menu 2-->
			<div id="menu2" class="tab-pane fade in">
				<div class='row'>
					<div class='col-lg-12 col-md-12 col-sm-12'>
					<div class='panel panel-primary'>
						<div class='panel-heading' style='text-align: right;'>
						Team <strong>Overall</strong> Statistics
						</div>
						<div class='panel-body' id='statistic-table' style='max-height: 300px; overflow: auto;'>

						</div>
					</div>
					</div>
				</div>
			</div>
			<!-- Menu 3-->
			<div id="menu3" class="tab-pane fade in">
				<div class='row'>
					<div class='col-lg-12 col-md-12 col-sm-12'>
					<div class='panel panel-primary'>
						<div class='panel-heading' style='text-align: right;'>
						<strong>Manage</strong> Demands
						</div>
						<div class='panel-body' style='max-height: 310px; overflow: auto;'>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12' id='demand-table'>

								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12'>
								<p><span class='glyphicon glyphicon-exclamation-sign'></span> Current week's demand cannot be edited.</p>
								<div class='modal fade' id='editdem' role='dialog'>
				                  <div class='modal-dialog'>
				                    <div class='modal-content'>
				                    <div class='modal-header'>
				                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
				                      <h4 class='modal-title'><strong>Edit</strong> Demand</h4>
				                    </div>
				                    <div class='modal-body' id='demand-modifier'>
				                       <!-- EDIT DEMAND -->
				                    </div>
				                    <div class='modal-footer'>
				                    	<h5><span class='glyphicon glyphicon-exclamation-sign'></span>Editing preset demand will affect the game <br>and players with future forecast ability.</h5>
				                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				                    </div>
				                    </div>
				                  </div>
				                </div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			<!--MENU 4-->
			<div id='menu4' class='tab-pane fade in'>
			<div class='row'>
				<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
				 <script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>
        		<script src="<?php echo base_url(); ?>js/jquery.canvasjs.min.js"></script> 
					<div class='panel panel-primary'>
						<div class='panel-heading' style='text-align: right;'><strong>Detailed</strong> Statistics</div>
						<div class='panel-body'>
						<div class='row'>
							<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'>
								<script type="text/javascript">
									$(document).ready(function(){
										$("form#stat_detail").on('submit',function(){
										
										var that = $(this),
								        url= that.attr('action'),
								        type = that.attr('method'),
								        data = {};
								        
								        that.find('[name]').each(function(index, value){
								            var that = $(this),
								            name = that.attr('name'),
								            value = that.val();
								            data[name] = value;
								        });
								        
								        var generator = $.ajax({
								           url : url,
								           type : type,
								           data : data,
								           
								        });
								        generator.done(function(data){
								        	
								        	$("#graph1").empty().append(data);       	
								        	
								        });
										return false;
										});
										$("#team_name").on('change',function(){
											var g = $("#team_name").val();
											if(g==="no"){
												$("#statist_sub").attr('disabled',true);
											}
											else{
												$("#statist_sub").attr('disabled',false);
											}
										});
									});
								</script>
								<form id='stat_detail' action='../adminpartscontroller/detailed_statistic' method='post'>
								<div class='form-group'>
								<select id='team_name' class='form-control' name='teamname'>
										<option value='no'>-- Select Team --</option>
									<?php
									foreach($team_sum as $ts){
										echo "
										<option value='". $ts->team_code ."'>Team ". $ts->team_code ."</option>
										";
									}
									?>
								</select>
								</div>
								<div class='form-group'>
								<button id='statist_sub' class='btn btn-success' role='submit' disabled>See Statistics</button>
								</div>
								</form>
							</div>
							<div class='col-lg-9 col-md-9 col-sm-9 col-xs-12' style='min-height: 270px; overflow: auto;' id='graph1'>
							
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
				
			</div>
		</div>
		</div>
	</div>
</div>
</body>
</html>