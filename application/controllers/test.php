<?php

class Test extends CI_Controller{

	public function testing(){

		$this->load->model('probabilistic_calculation');
		$i = $this->probabilistic_calculation->trigger_events();
		$demand = 10;
		if($i == 'disaster'){
			echo "Demand: ".$demand." + 10 Tambahan";
		}
		else{
			echo "Demand: ".$demand;
		}
	}

	public function addon(){

		$team_a = array(10,11,12,13);
		print_r();
		die();

		for($i=0;$i<$team_a;$i++){
			print("HAI");
		}

	}

}


?>