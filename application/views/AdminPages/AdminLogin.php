
    <style>
    .bg1{
        background-image:url(<?php echo base_url()?>images/admin-background.jpg);
    }
    label,h3,h4{
        color:white;
    }
    
    a:hover{
        text-decoration: none;
    }
    </style>
    <body class='bg1'>
    <div class='container'>
    <a href='<?php echo base_url()?>'><h4><span class='glyphicon glyphicon-home'></span> Home</h4></a>
    </div>
    <div class="container" style="padding-top: 120px;padding-bottom: 150px;">       
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 
                 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                <h3><span class='glyphicon glyphicon-user'></span> <strong>Facilitator</strong> Login</h3>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-4  col-md-4 col-sm-4
                 col-sm-offset-4 col-md-offset-4 col-lg-offset-4"
                 >
                <?php
                echo form_open('main/login_validation');
                ?>
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name ="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <input class="btn btn-default-custom" type="submit" value="Login">
                
                <?php
                echo form_close();
                echo "<br>";
                echo validation_errors('<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>','</strong>
                    </div>');
                ?>
                
            </div>
            
        </div>
      </div>
</body>
</html>