<style type="text/css">
	.footer{
		display: inline-block;
		background-color: black;
		color:white;
		height: 130px;
		padding-top: 25px;
		padding-bottom: 25px;
		margin-top: 50px;
		width: 100vw;
		<?php
			if(!$pageException == NULL){
				if($pageException === 'comphistory'){
					echo "
					position:absolute;
					left:0;
					bottom:0;
					";
				}
				// elseif ($pageException === 'playerhome'){
				// 	echo "
				// 	position:fixed;
				// 	left:0;
				// 	bottom:0;
				// 	";
				// }
			}
		?>
		
	}
	a.copyright{
		color:gray;
	}
</style>
<footer class="footer noprint">
      <div class='container-fluid text-center noprint'>
		<p><strong>Supply Chain</strong> Simulation</p>
		<p>&copy; 2016
		<?php
		if(date("Y") > 2016){
			echo 
			" - ".date("Y");
			
		} 
		else if(date("Y") <= 2016){
			echo " ";	
		}
		?>
		<a class='copyright' href='https://id.linkedin.com/in/yehudachristian93'>Yehuda Christian</a>, All rights reserved.
		</p>
	</div>
  </footer>
</body>
</html>
