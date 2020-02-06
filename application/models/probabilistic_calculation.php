<?php
class Probabilistic_calculation extends CI_Model{

	public function trigger_events(){
		$i = rand(1,4);
		if($i == 4){
			$status = 'disaster';
		}
		else{
			$status = 'normal';
		}
		return $status;
	}


}

?>