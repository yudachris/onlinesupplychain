<script type="text/javascript">
	$(document).ready(function(){
		$("#cost_detail").load('../playerpartscontroller/cost_detail');
	});
</script>
<style type="text/css">
	@media(max-device-width:1440px){
		.costbtn{
			font-size: 75%;
			font-family: 'Poppins', sans-serif;
		}
	}
	@media(max-device-width:700px){
		.costbtn{
			font-size: 40%;
			font-family: 'Poppins', sans-serif;
		}
	}
</style>
<?php
$total = $cost->total_cost;
?>
            <div class='panel-heading'>
            <h4>Total <strong>Cost</strong></h4>
            </div>
            <div class='panel-body top-line2'>
            <h4><small><span class='glyphicon glyphicon-usd'></span></small> <strong><?php echo $total;?></strong> 
            <small>
            <div class='btn-group-vertical'>
            <button data-toggle='modal' data-target='#cost_details' title='Cost Details' class='btn btn-primary costbtn'><span class='glyphicon glyphicon-search'></span> Cost Details</button>
            <button title='Cost Rules' class='btn btn-primary costbtn' data-toggle='modal' data-target='#cost_rule'><span class='glyphicon glyphicon-list-alt'></span> Cost Rules</button>
            </div>
            </small></h4>
			</div>
<div class='modal fade' id='cost_details' role='dialog'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'><strong>Cost</strong> Details</h4>
                    </div>
                    <div class='modal-body' id='cost_detail'>
                        
                    </div>
                    <div class='modal-footer'>
                    <h5><span class='glyphicon glyphicon-exclamation-sign'></span> Costs are calculated every change of week.</h5>
                      <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                  </div>
                </div>


                        <div class='modal fade' id='cost_rule' role='dialog'>
                          <div class='modal-dialog'>
                            <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'><strong>Cost</strong> Rules</h4>
                            </div>
                            <div class='modal-body'>
                                <table class='table'>
                                <thead>
                                <tr>
                                    <th>Inventory Cost</th>
                                    <td>$ <?php echo $cost_rule->inventory_cost;?></td>
                                </tr>
                                <tr>
                                    <th>Excessive Inventory Cost</th>
                                    <td>$ <?php echo $cost_rule->excess_cost;?></td>
                                </tr>
                                </thead>
                                <tr>
                                    <th>Backlog Cost</th>
                                    <td>$ <?php echo $cost_rule->backlog_cost;?></td>
                                </tr>
                                </table>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            </div>
                            </div>
                          </div>
                        </div>