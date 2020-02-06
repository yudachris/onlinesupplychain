		<style type="text/css">
		@media(max-device-width:460px){
			.smaller{
				font-size: 140%;
			}
            .smallerbottom{
                font-size: 80%;
            }
        }
        li.new{
            	background-color: white;
            	border-radius: 5px;
            }
        </style>
        <script type="text/javascript">
        	$(document).ready(function(){
        		$(".new").click(function(){
        			$("#loginform").empty();
        		});
        	});
        </script>
		<h2 class='smaller'>Select <strong>Game Session</strong><br>
		<small>
			<?php
				$z=0;
				foreach($game as $g){
					$z=$z+1;
				}

				if($z==0){
					echo "There is currently <strong>no</strong> active game session.";
				}
				else if($z==1){
					echo "There is currently <strong>1 active</strong> game session.";
				}
				else{
					echo "There are currently <strong>". $z ." active</strong> game sessions.";
				}
			?> 
		</small></h2>
		<div class='row'>
		<div class='col-lg-3 col-md-3 col-sm-3' style="margin-bottom: 30px;">
		   <ul class='nav nav-pills nav-stacked'>
		   <?php
		   		$x=1;
		   		foreach($game as $g){
		   			if($x==1){
		   				$dsa='active';
		   			}
		   			else{
		   				$dsa='';
		   			}
		   			echo "<li class='". $dsa ." new'><a data-toggle='pill' href='#menu". $x ."'><span class='glyphicon glyphicon-chevron-right'></span>
		   			". $g->game_name ."</a></li>";
		   			$x=$x+1;
		   		}
		    	
		    ?>
		   </ul>
	    </div>

	    	
	    	<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
	    	<div class='tab-content'>
	    		<?php 
	    		$y=1;
	    		foreach($game as $g){
	    			echo "<script>
                        $(document).ready(function(){
                           $('form#form". $y ."').on('submit',function(){
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
                            
                            var posting = $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               
                            });

                            posting.done(function(data){
                            	$('#loginform').empty().append(data);
                            });
                            
                           return false; 
                        }); 
                        });   
                    </script>";

                    if($g->login_permit==='allow'){
                    	$login = "Allowed";
                    }
                    else{
                    	$login ="Restricted";
                    }
                    if($y==1){
                    	$asd='active';
                    }
                    else{
                    	$asd='';
                    }
	    			echo 	"<div id='menu". $y ."' style='height:375px;overflow: auto;' 
	    					class='tab-pane fade in ".$asd."'>
	    					<div class='panel panel-primary'>
	    					<div class='panel-heading'>
	    					<div class='page-header'>
	    					<h3 class='smallerbottom'><strong>". $g->game_name ."</strong></h3>
	    					</div>
	    					<h4 class='smallerbottom'>Facilitator: <strong>". $g->made_by ."</strong></h4>
	    					<h4 class='smallerbottom'>Login Permission: <strong>". $login ."</strong></h4>
	    					<br>
	    					<form action='../main/player_login' id='form". $y ."' method='post'>
	    					<input type='hidden' name='gamename' value='". $g->game_name ."'>
	    					<button class='btn btn-success-custom smallerbottom' role='submit'>
	    					<span class='glyphicon glyphicon-play-circle'></span>
	    					 Play This Game</button>
	    					 </form>
	    					</div>
	    					</div>
	    					</div>";
	    			$y=$y+1;
	    		}
	    		?>
	    	</div>	    	
	   		</div>
	   		<div class='col-lg-4 col-md-4 col-sm-4 col-xs-7' id='loginform'>

	   		</div>
		</div>