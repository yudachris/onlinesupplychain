  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:700' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function(){
    $("#title").fadeIn(2000);
  });
</script> 
<style type='text/css'>
#title{
  display:none;
}
.container-fluid-custom{
    padding-top: 70px;
    padding-bottom: 70px;
}

.btn-dev-custom{
    background-color: white;
    border:solid #3399ff;
    color:#3399ff;
}

.btn-dev-custom:hover{
    border:solid gray;
    color: gray;
}

.bg1,.bg2,.bg3,.bg5{
  font-family: 'Poppins', sans-serif;
    word-spacing: 5px;
    letter-spacing: 1.5px;
}

.bg1{

    background-color: #0066ff;
    background-image: url(<?php echo base_url(); ?>images/containeryard.jpg);
}

@media(min-device-height:410px) and (orientation:landscape){
  .bg1,.bg2,.bg3,.bg5{

    min-height: 680px;
  }
  .main-title-text{
  color:white;
  margin-top: 190px;
  }
}
@media(max-device-height:400px) and (orientation:landscape){
  .main-title-text{
  color:white;
  margin-top: 40px;
  margin-bottom: 75px;
  }
}

@media(min-device-width:150px) and (orientation:portrait){
  .main-title-text{
  color:white;
  margin-top: 100px;
  margin-bottom: 100px;
  }
}

@media(min-device-height:730px){
  .bg1,.bg2,.bg3,.bg5{

    min-height: 100vh;
  }
}

.bg2{

    background-color: #ffcc00;

}

.bg3{

    background-color: #ff9999;
}

.bg4{

    background-color: white;
    
}

.bg5{

    background-color: #4080ed;
}

a:hover{
    text-decoration: none;
}

.img-sq-custom{

    height: 200px;
    width:200px;
    margin-bottom: 40px;
}
h2{
    margin-bottom: 30px;
}
.main-title{
    font-size: 300%;
    color: white;
    font-family: 'Josefin Sans', sans-serif;
    text-shadow: 4px 4px 10px black;
}

</style>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">SC.Simulation</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#first">HOME</a></li>
        <li><a href="#thegame">THE GAME</a></li> 
        <li><a href="#demun">DEMAND UNCERTAINTY</a></li>  
        <li><a href="#bullef">BULLWHIP EFFECT</a></li>        
        <li><a href="#playnow"><span class='glyphicon glyphicon-play-circle'></span> PLAY NOW</a></li>  
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
                <li><a href='<?php echo base_url()?>main/admin_login'><span class='glyphicon glyphicon-user'></span> FACILITATOR LOGIN</a></li>
                <li><a href='#the_dev'><span class='glyphicon glyphicon-tasks'></span> ABOUT DEVELOPER</a></li>
          </ul>
        </li>      
      </ul>
    </div>
  </div>
</nav>
<div class='container-fluid container-fluid-custom text-center bg1' id='first'>
<div id='title' class='container main-title-text'>
<div class='page-header'>
<h1 class='main-title'>Online Supply Chain</h1>
</div>
<h1 class='main-title'>Simulation Game</h1>
<br>
<a href='<?php echo base_url()?>main/selectgamesession'><button class='btn btn-success-custom btn-lg'><span class='glyphicon glyphicon-play-circle'></span> Play</button></a>
</div>
</div>

<div class='container-fluid container-fluid-custom text-center bg5' id='thegame'>
    <h2><strong>Supply Chain</strong> Simulation Game</h2>
    <img class='img-circle img-sq-custom' src="<?php echo base_url();?>images/supply-chain.jpg">
    <div class='row '>
    <div class='col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3'>
   <h4 > Supply chain simulation game is just like its name. It simulates how a supply chain works in a distribution network. This game is made based on MIT's BeerGame which let you learn about <strong>Demand Uncertainty</strong> and <strong>Bullwhip Effect</strong>. Even so, there are many things added so it will increase player's experience on playing this game.</h4>
  <h4><a style="color:blue;" href='<?php echo base_url()?>main/selectgamesession'>Experience it now!</a></h4>
    </div>
    </div>
</div>

<div class='container-fluid container-fluid-custom text-center bg2' id='demun'>

    <h2>Demand <strong>Uncertainty</strong></h2>
    <img class='img-circle img-sq-custom' src="<?php echo base_url();?>images/uncertainty.jpg">
    <div class='row'>
    <div class='col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3'>
    <br>
    <h4><strong>Demand uncertainty</strong> means your business has difficulty accurately projecting customer demand in the future. This poses a significant challenge because it makes inventory hard to control and manage.</h4>
    </div>
    </div>
</div>

<div class='container-fluid container-fluid-custom text-center bg3' id='bullef'>

    <h2><strong>Bullwhip</strong> Effect</h2>
    <img class='img-circle img-sq-custom' src="<?php echo base_url();?>images/bullwhip-effect.jpg">
    <div class='row'>
    <div class='col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3'>
    <h4>The <strong>bullwhip effect</strong> is a distribution channel phenomenon in which forecasts yield supply chain inefficiencies. It refers to increasing swings in inventory in response to shifts in customer demand as you move further up the supply chain.<h4>
    </div>
    </div>
</div>

<div class='container-fluid container-fluid-custom text-center bg4' id='playnow'>
<img class='img-sq-custom img-circle' src='<?php echo base_url()?>images/SCM-1.jpg'> 
<h3>Come, <strong>play</strong> a session.</h3>
<br>
<a href='<?php echo base_url()?>main/selectgamesession'>
<button class='btn btn-success-custom btn-lg'><span class='glyphicon glyphicon-play-circle'></span> Play Now</button>
</a>
</div>

<!--<div id='the_dev' class='container-fluid container-fluid-custom text-center bg5'>

    <a href='<?php echo base_url()?>main/about_developer'><button class='btn btn-dev-custom btn-lg'>About the <strong>Developer</strong></button></a>

</div>-->



