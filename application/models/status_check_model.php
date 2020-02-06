<?php

class Status_check_model extends CI_model{
    
    public function check(){
        
        $this->db->where('username', $this->session->userdata('username'));
        $maker = $this->db->get('users')->result()[0]->name;

        $this->db->where('made_by', $maker);
        $this->db->from('game');
        $query = $this->db->count_all_results();
        
        return $query;    
        
    }

    public function check_credential(){

        $this->db->where('username', $this->session->userdata('username'));
        $status = $this->db->get('users')->result()[0]->status;
        if($status === "administrator"){
            return "administrator";
        }
        else{
            return "instructor";
        }

    }

    public function current_gamename(){
        $this->db->where('made_by', $this->session->userdata('name'));
        $games = $this->db->get('game')->result();
        if($games==null){
            $gamename = "";
        }
        else{
            $gamename = $games[0]->game_name;
        }

        return $gamename;
    }

    public function current_gamename_p(){
        $this->db->where('made_by', $this->session->userdata('name'));
        $gamename=$this->db->get('game')->result()[0]->game_name;

        return $gamename;
    }


    public function check_login(){

        if($this->session->userdata('is_logged_in') == null or $this->session->userdata('is_logged_in') == 1){
            redirect("main/home");
        }

    }
}

?>
