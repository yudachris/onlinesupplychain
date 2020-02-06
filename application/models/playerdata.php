<?php
class Playerdata extends CI_Model{
    
    public function getData($var){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        return $this->db->get('player')->result();
     
    }
    
    public function getTeamlength(){
       
      
	   	$this->db->where('made_by', $this->session->userdata('name') );
	   	if($this->db->get('game')->result()==null){
	   		$length = 0;
	   	}
	   	else{
	   		$this->db->where('made_by', $this->session->userdata('name') );
	   		$gamename = $this->db->get('game')->result()[0]->game_name;
	   		$this->db->where('game_name', $gamename);
	   		$this->db->from('team');
	    	$length = $this->db->count_all_results(); 
	   	}
   
       return $length;
    }
 
 	public function getStat_summary(){
 		$this->db->where('game_name', $this->session->userdata('gamename'));
 		$this->db->where('player_id',$this->session->userdata('username'));
 		$this->db->get('player');
 		return "ok";

 	}   
}
?>
