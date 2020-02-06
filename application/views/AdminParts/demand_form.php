<script type="text/javascript">
	$(document).ready(function(){
		$("form#preset_demands").on('submit',function(){

		var b = confirm("Are you sure?");
		if(b==true){
		$("#add_demand").attr('disabled',true).html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Saving...");
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
        
        var postdemand = $.ajax({
           url : url,
           type : type,
           data : data,
           
        });

        postdemand.done(function(){
        	$("#add_demand").html("<span class='glyphicon glyphicon-ok-circle'></span> Saved");
        	$("#finish_setting").attr('disabled',false);
        	alert("Demand successfully posted.");
        });

		}
		else{
			alert("Action canceled.");
		}
		
		return false;
		});
	});
</script>
<form id='preset_demands' action='../gamecontroller/save_preset_demand' method='post'>
<div class='panel panel-primary'>
<div class='panel-heading'><h5><strong>Preset Demand</strong> Input Field <button role='submit' id='add_demand' class='btn btn-success'>Save</button></h5></div>
<div class='panel-body' style='height:200px;overflow: auto;'>
	<?php
	for($x=1;$x<=$turn_quantity;$x++){

		echo "<div class='form-group'>
	<label>Demand Week ". $x ."</label>
	<input type='number' min='0' name='demand". $x ."' class='form-control' required>
	</div>";
		}
	?>
	<input type='hidden' name='num_of_turn' value="<?php echo $turn_quantity; ?>">
</div>
</div>
</form>