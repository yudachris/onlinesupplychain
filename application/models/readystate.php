<?php
class Readystate extends CI_Model{

	public function check_status($gamename){

        $this->db->where('game_name',$gamename);
        $current = $this->db->get('game')->result()[0]->current_turn;
        $this->db->where('game_name',$gamename);
        $max = $this->db->get('game')->result()[0]->end_turn;

        if($current === $max){
            $this->db->where('game_name',$gamename);
            $this->db->where('status',"ready");
            $this->db->from('team');
            $ready = $this->db->count_all_results();
            
            $this->db->where('game_name',$gamename);
            $this->db->from('team');
            $all = $this->db->count_all_results();
            
            if($ready === $all){
                $stat = "endok";
                
            }
            else{
                $stat = "endno";
                
            }
        }
        else{
            $this->db->where('game_name',$gamename);
            $this->db->where('status',"ready");
            $this->db->from('team');
            $ready = $this->db->count_all_results();
            
            $this->db->where('game_name',$gamename);
            $this->db->from('team');
            $all = $this->db->count_all_results();
            
            if($ready === $all){
                $stat = "ok";
                
            }
            else{
                $stat = "no";
                
            }
	}

	return $stat;

}
}
?>