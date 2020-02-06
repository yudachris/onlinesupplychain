<?php ?>
<script type="text/javascript">

    $(document).ready(function() {

            $("#realtime").load("../adminpartscontroller/playermgmttab");      
    });

    $(document).ready(function(){
        $("#tab-refresh1").click(function(){
            $("#realtime").load("../adminpartscontroller/playermgmttab"); 
        });
    });
</script>
<style type="text/css">
    a:hover{
        text-decoration: none;
    }
</style>

<body>

    <div class='container'>
    <div class='page-header' style='text-align: right;'>
    <h2><strong>Player</strong> Management</h2>
    </div>
    <div class='row'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <ul class="nav nav-pills nav-stacked">
        <li class="active"><a data-toggle="pill" href="#menu1">Player Status</a></li>
        <li><a data-toggle="pill" href="#menu2">Player Controls</a></li> 
        </ul>
        </div>
        <!-- TAB CONTENT -->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
            <h2>Player <strong>Status</strong> <a href='#'><button id='tab-refresh1' class='btn btn-default'><span class='glyphicon glyphicon-refresh'></span> Refresh</button></a></h2>
            <div id="realtime">           
                <h3><span class="glyphicon glyphicon-hourglass"></span> Loading tables....</h3>  
            </div> 
        </div>
        <div id="menu2" class="tab-pane fade in">
            <h2>Player <strong>Control</strong></h2>
            <p><span class='glyphicon glyphicon-exclamation-sign'></span> Use for <strong>login</strong> or <strong>phase problems</strong> only.</p>
            <div class='panel panel-success'>
                <div class='panel-heading'><h3>Login <strong>Control</strong></h3></div>
                <div class='panel-body'>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('form#control-login').on('submit',function(){
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
                                   alert("Status Has Changed!");
                                   $("#input").val("");
                               }
                            });
                           return false; 
                        }); 
                    });
                </script>
                    <form id='control-login' action='../gamecontroller/change_playerlogin' method='post'>
                        <div class='row'>
                            <div class='col-lg-5'>
                            <div class='form-group'>
                            <label>Player ID:</label>
                                <select class='form-control' name='playerid'>
                                    <?php
                                    foreach($players as $pl){
                                        if($pl->player_id === "customer"){
                                            echo "";
                                        }
                                        else{
                                        echo "<option value='". $pl->player_id ."'>". $pl->player_id ."
                                                </option>";
                                            }
                                    }
                                    ?>                                    
                                </select>
                            </div>
                            </div>
                            <div class='col-lg-4'>
                            <label>Set Login To:</label>
                                <select class='form-control' name='status'>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </div>
                            <div class='col-lg-3'>
                            <br>
                                <button role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class='panel panel-success'>
                <div class='panel-heading'><h3>Phase <strong>Control</strong></h3></div>
                <div class='panel-body'>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('form#control-phase').on('submit',function(){
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
                                   alert("Status Has Changed!");
                                   $("#input").val("");
                               }
                            });
                           return false; 
                        }); 
                    });
                </script>
                    <form id='control-phase' action='../gamecontroller/change_playerphase' method='post'>
                    <div class='row'>
                            <div class='col-lg-5'>
                            <div class='form-group'>
                            <label>Player ID:</label>
                                <select class='form-control' name='playerid'>
                                    <?php
                                    foreach($players as $pl){
                                        if($pl->player_id === "customer"){
                                            echo "";
                                        }
                                        else{
                                        echo "<option value='". $pl->player_id ."'>". $pl->player_id ."
                                                </option>";
                                            }
                                    }
                                    ?>                                    
                                </select>
                            </div>
                            </div>
                            <div class='col-lg-4'>
                            <label>Set Login To:</label>
                                <select class='form-control' name='phase'>
                                    <option value='order'>Order</option>
                                    <option value='deliver'>Deliver</option>
                                    <option value='standby'>Standby</option>
                                </select>
                            </div>
                            <div class='col-lg-3'>
                            <br>
                                <button role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>       
    </div>
</body>
