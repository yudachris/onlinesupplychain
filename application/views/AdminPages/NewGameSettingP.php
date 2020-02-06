<script type="text/javascript">
	$(document).ready(function(){
		$("form#quantity_form").on('submit',function(){
		var x = $("#turn_gen").val();
		var y = confirm("Your have set the turn amount to: "+x+"\nAre you sure?");
		if(y==true){
		$("#field_generator").attr('disabled',true);
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
        	var t = $("#turn_gen").val();
        	$("#demandfield").empty().append(data);
        	$("#turn").val(t);
        	$("#turn_gen").attr('disabled',true);
        	
        });

		}
		else{
			alert("Action canceled.");
			$("#turn_gen").val('');
		}
		
		return false;
		});
	});
	$(document).ready(function(){
		$("#invcap").change(function(){
			$("#onhand").attr("max",$("#invcap").val());
			$("#onhand").attr("placeholder", 'Maximum on-hand is: '+$("#invcap").val());
		});
	});
</script>
<style type="text/css">
	a:hover{
		text-decoration: none;	
	}
</style>
<div class='container'>
<div class='page-header' style='text-align: right;'>
<h2>New Game with <strong>Preset Demand</strong><small>
	<span class="glyphicon glyphicon-cog"></span> Custom Settings
</small></h2>
</div>
	<div class='row'>
		<div class='col-lg-7'>
			<div class='panel panel-default'>
				<div class='panel-heading'><h5><strong>General</strong> Setting</h5></div>
				<div class='panel-body'>
					<div class='row'>
						<div class='col-lg-6 col-md-6 col-sm-6 col-lg-offset-3'>
							<!-- DEMAND INPUT GENERATOR -->
							<form id='quantity_form' action='../adminpartscontroller/presetfield' method='post'>
								<div class='form-group'>
								<label>Number of Week/Turn</label>
								<input id='turn_gen' class='form-control' type='number' min='0' name='turn_quantity' required>
								</div>
								<button id='field_generator' role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-cog'></span> Generate Field</button>
							</form>
						</div>					
					</div>
					<!-- GAME PARAMETER INPUT FORM-->
					<form id='game_param' action='../admin/setting_validationP' method='post'>
					<div class='row'>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<div class='form-group'>
							<label>Game Name</label>
							<input class='form-control' type='text' name='g_name' required>
							</div>
							<div class='form-group'>
							<label>Password</label>
							<input class='form-control' type='text' name='g_pass' required>
							</div>
							<div class='form-group'>
							<label>Number of Teams</label>
							<input class='form-control' type='number' name='g_teams' min='1' max='15' placeholder='Maximum 15 Teams' required>
							</div>
							<div class='form-group'>
							<label>Difficulty</label>
							<select name='g_diff' class='form-control'>
								<option value='adv'>Advance</option>
								<option value='bgn'>Beginner</option>
							</select>
							</div>
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<div class='form-group'>
							<label>Number of Week/Turns</label>
							<input class='form-control' type='number' name='g_turn' id='turn' readonly required>
							</div>
							<div class='form-group'>
							<label>Starting Credit</label>
							<input class='form-control' type='number' name='g_credit' min='0' required>
							</div>
							<div class='form-group'>
							<label>Supply Lead Time</label>
							<input class='form-control' type='number' name='g_leadtime' min='1' max='5' placeholder="Maximum 5 Lead Times" required>
							</div>
						</div>
					</div>
					<div class='row'>
					<div class='page-header' style='padding-left:20px;'>
					<h5><strong>Cost</strong> and <strong>Inventory</strong> Setting</h5>
					</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<div class='form-group'>
							<label>Inventory Cost</label>
							<input class='form-control' type='number' min='0' name='g_invcost' required>
							</div>
							<div class='form-group'>
							<label>Excess Inventory Cost</label>
							<input class='form-control' type='number' min='0' name='g_excost' required>
							</div>
							<div class='form-group'>
							<label>Backlog Cost</label>
							<input class='form-control' type='number' min='0' name='g_bcost' required>
							</div>
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<div class='form-group'>
							<label>Initial Inventory Capacity</label>
							<input class='form-control' type='number' min='0' id='invcap' name='g_invcap' required>
							</div>
							<div class='form-group'>
							<label>Initial On-Hand Inventory</label>
							<input class='form-control' type='number' min='0' max='0' id='onhand' name='g_onhand' required>
							</div>
							<div class='form-group'>
							<label>Initial In-transit Inventory</label>
							<input class='form-control' type='number' min='0' name='g_intransit' required>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
		<div class='col-lg-5'>
		<!-- DEMAND INPUT FIELD -->
		<div  id='demandfield'>
		<div>
			<div class='panel panel-primary'>
				<div class='panel-heading'><h5><strong>Preset Demand</strong> Input Field</h5></div>
				<div class='panel-body' style='height:200px;overflow: auto;'>
				
				</div>
			</div>
			</div>
		</div>
			<div class='panel panel-primary'>
				<div class='panel-heading'><strong>Item</strong> Settings</div>
				<div class='panel-body'>
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
						?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div style="text-align: center;margin-bottom: 30px;">
				<button id='finish_setting' class='btn btn-default btn-lg' disabled><span class='glyphicon glyphicon-play-circle'></span> Finish Your Setting</button>
		</div>
	</form>
</div>
</html>