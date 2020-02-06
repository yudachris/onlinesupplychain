<?php
?>
<script>
                function switch1(){
                    var stat = document.getElementById("pl_log_switch").innerHTML;
                    if(stat === "Player Login Restricted"){                      
                        document.getElementById("pl_log_switch").className="btn btn-success";
                        document.getElementById("pl_log_switch").innerHTML="Player Login Allowed";
                        
                    }
                    else{
                        document.getElementById("pl_log_switch").className="btn btn-danger";
                        document.getElementById("pl_log_switch").innerHTML="Player Login Restricted";
                    }
                }                
</script>
<script>
$(document).ready(function(){

   
   setInterval(function(){
      
      $("#current_stat").load("../adminpartscontroller/stat_dashboard");
        
   },1000);
   
   setInterval(function(){
        $("#weekpanel").load("../adminpartscontroller/week_panel");
   },1000);

   setInterval(function(){
        $("#next_panel").load("../adminpartscontroller/next_button");
   },1000);

   setInterval(function(){
        $("#demand_input").load("../adminpartscontroller/demand_input");
   },1000);   

   setInterval(function(){
        $("#realtime_demand").load("../adminpartscontroller/realtime_demand_tab");
   },1000); 

   setInterval(function(){
        $("#previous_demand").load("../adminpartscontroller/previous_demand_tab");
   },1000); 
});
</script>
<div class="container">

    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4
        col-lg-3 col-sm-3 col-md-3 col-xs-3" id="weekpanel" style="box-shadow: 5px 5px gray;text-align: center;border:double #eee 4px;border-radius: 10px;">
        <h3><b>Current Week</b></h3>
        <h3><span class="glyphicon glyphicon-hourglass"></span><small> Loading....</small></h3>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" id="next_panel" style="text-align: center;padding-top: 50px;padding-bottom: 20px;">
        <button class="btn btn-default" id="next_turn" disabled>
        <span class="glyphicon glyphicon-plus-sign"></span> Next Turn</button>
        </div>
    </div>

      <br> 
    <div class="row">
    <!-- Start of Pills selection -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#menu1">Statistics</a></li>
    <li><a data-toggle="pill" href="#menu2">Controls</a></li>
    <li><a data-toggle="pill" href="#menu3">Demands</a></li>
    <li><a data-toggle="pill" href="#menu4">Game Details</a></li>
    </ul>
    </div>
    <!-- End of Pills selection -->
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <div class="tab-content">
    <div id="menu1" style="height:375px;overflow: auto;" class="tab-pane fade in active">
     <div class="page-header">
         <h3>Current Statistics</h3>
     </div>
    <div class="col-lg-12" style="padding:20px;height:250px;
              border:double #eee 4px;border-radius: 10px;overflow:auto;">
        <div id="current_stat">
            <h4><span class='glyphicon glyphicon-hourglass'></span> Loading Tables...</h4>
        </div>
    </div>
    </div>
    <div id="menu2" style="height:350px;overflow: auto;" class="tab-pane fade">
      <div class="page-header"><h3>Controls</h3></div>
      <div class="col-lg-12">
      <div class="row">
      <div class="col-lg-6">
      <h4><b>Login Permit</b></h4>
        <?php
            if($p_login === "allow"){

                echo "<div id='pl_log_switch' onclick='switch1()'class='btn btn-success'>Player Login Allowed</div>";
            }
            else{

                echo "<div id='pl_log_switch' onclick='switch1()'class='btn btn-danger'>Player Login Restricted</div>";
            }
        ?>
      </div>
      </div>          
                   
        </div>     
    </div>

    <div id="menu3" style="height:350px;overflow: auto;" class="tab-pane fade">
      <div class="page-header"><h3>Demands</h3></div>
      <div class="col-lg-6">       
      <div class="row">
          <div class="col-lg-12">
          <h4>Current Active Demand</h4>
              <div id="realtime_demand" style="height:100px;">
              
              </div>
          </div>         
      </div>
      <div class="row">
      <div class="col-lg-8" >
      <script type="text/javascript">
  $(document).ready(function(){
                           $('form#d_input').on('submit',function(){
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
                            
                            $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               success:function(){
                                   alert("Your Demand Has Been Sent!");
                                   $("#input").val("");
                               }
                            });
                           return false; 
                        }); 
                        });
        </script>
                  
  <form action="../gamecontroller/customer_demand" method="post" id="d_input">
  <div class="form-group">
        <input class="form-control" type="number" name="d_amount" placeholder="Input Your Demand">
    </div>
    <div class="form-group" id="demand_input">
        <input type="submit" class="btn btn-success" value="Send Demand" disabled>
    </div>
</form>
      </div> 
      </div>         
      </div>
      <div class="col-lg-6" style="height:300px;">
          <h4>Previous Demands</h4>
              <div id="previous_demand" style="height:150px; overflow: auto;">
              
              </div>
          </div>
      </div>


    <div id="menu4" style="height:350px;overflow: auto;" class="tab-pane fade">
      <div class="page-header">
      <h3>Game Details</h3>
      
      </div>
    </div>
  </div>
    </div>
    </div>

</div>