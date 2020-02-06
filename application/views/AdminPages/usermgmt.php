<body>
<div class='container'>
<div class='row'>
	<div class='col-lg-offset-3 col-lg-9'>
		<div class='page-header'>
		<h1><?php echo $user;?><small><h4><span class='glyphicon glyphicon-cog'></span> User Management</h4></small></h1>
		</div>
		
	</div>
</div>

<div class='row'>

<div class='col-lg-3'>
			<ul class="nav nav-pills nav-stacked">
	            <li class="active"><a data-toggle="tab" href="#data">
	                    Userdata</a></li>
	            <li><a data-toggle="tab" href="#modif">
	                    Change Password</a></li>
	            <?php
	            if($previllege === "administrator"){
	            	echo "<li><a data-toggle='tab' href='#newuser'>
	                    Add New User</a></li>";	
	            }
	            
	            ?>
	        </ul>
</div>

<div class='col-lg-6'>
	<div class="tab-content">
	            <div id="data" class="tab-pane active fade in">
	                
	            </div>
	            <div id="modif" class="tab-pane fade in">
	                <form method="post" action="../admin/change_password">
	                	<div class='row'>
	                		<div class='col-lg-8 col-md-8 col-sm-8'>
	                		<?php
	                		$username = $this->session->userdata('username');
	                		?>
	                			<div class='form-group'>
	                				<label>Username:</label>
	                				<input class='form-control' type='text' value="<?php echo $username;?>" disabled>
	                			</div>
	                			<input type='hidden' name='user_name' value="<?php echo $username;?>">
	                			<div class='form-group'>
	                				<label>Old Password:</label>
	                				<input class='form-control' type='password' name='old_pass'>
	                			</div>
	                			<div class='form-group'>
	                				<label>New Password:</label>
	                				<input class='form-control' type='password' name='new_pass'>
	                			</div>
	                			<div class='form-group'>
	                				<label>Confirm New Password:</label>
	                				<input class='form-control' type='password' name='conf_pass'>
	                			</div>
	                			<div class='form-group'>
	                				<button role='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Change Password</button>
	                			</div>
	                		</div>
	                	</div>
	                </form>
	            </div>
	            <?php
	            if($previllege === "administrator"){

	            	echo "<div id='newuser' class='tab-pane fade in'>
	                <form action='../admin/add_user' method='post'>
	                	<div class='row'>
	                		<div class='col-lg-8 col-md-8 col-sm-8'>
	                			<div class='form-group'>
	                				<label>Username:</label>
	                				<input class='form-control' type='text' name='username'>
	                			</div>
	                			<div class='form-group'>
	                				<label>Full Name:</label>
	                				<input class='form-control' type='text' name='full_name'>
	                			</div>
	                			<div class='form-group'>
	                				<label>Password:</label>
	                				<input class='form-control' type='password' name='new_pass'>
	                			</div>
	                			<div class='form-group'>
	                				<label>Confirm Password:</label>
	                				<input class='form-control' type='password' name='conf_pass'>
	                			</div>
	                			<div class='form-group'>
	                				<label><span class='glyphicon glyphicon-exclamation-sign'></span> Previllege:</label>
	                				<select class='form-control' name='previllege'>
	                					<option value=''>---- Select Previllege ----
	                					</option>
	                					<option value='administrator'>Administrator
	                					</option>
	                					<option value='facilitator'>Facilitator
	                					</option>
	                				</select>
	                			</div>
	                			<div class='form-group'>
	                				<button role='submit' class='btn btn-success'><span class='glyphicon glyphicon-plus-sign'></span> Add New User</button>
	                			</div>
	                		</div>
	                		
	                	</div>
	                </form>
	            </div>";

	            }
	            ?>
	        </div>
</div>

<div class='col-lg-3'>
	<?php echo validation_errors('<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>','</strong>
  </div>')?>
  	<?php

  	if($successmessage === "passchanged"){
  		echo '<div class="alert alert-success">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Password Changed!</strong>';
  	}
  	else if($successmessage === "change_pass_false"){
  		echo '<div class="alert alert-warning">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Wrong Password.</strong>';
  	}
  	else{
  		echo "";
  	}

  	?>
</div>

</div>
</div>