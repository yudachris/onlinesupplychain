<?php
class Game_dynamics extends CI_Model{
	
	public function new_demand($team, $role,$team_con,$gamename){

        $this->db->where('game_name', $gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;
		
		if($role === "Retailer"){
            $customer = "customer";
        }
        else if($role === "Wholesaler"){
            $customer = $team."-Retailer";          
        }
        else if($role === "Distributor"){
        	$customer = $team."-Wholesaler";
        }
        else if($role === "Manufacturer") {
        	$customer = $team."-Distributor";
        }
            
            $this->db->where('game_name',$gamename);
        	$this->db->where('from',$customer);
            $this->db->where('turn_count', $current_turn);
            $this->db->where('status',"new");
            $hasil = $this->db->get('demand')->result();

            if($hasil ==null){
                return "no";
            }
            else{
            	return $hasil[0];           	            
            }
	}

    public function check_ordered($team, $gamename){

        
        $this->db->where('player_team',$team);
        $this->db->where('status', "ordered");
        $this->db->where('game_name', $gamename);
        $this->db->from('player');
        if($this->db->count_all_results() == 4){
            $status = "ok";
        }
        else{
            $status ="no";
        }
        return $status;

    }

    public function check_delivered($team, $gamename){

        $this->db->where('player_team',$team);
        $this->db->where('status', "delivered");
        $this->db->where('game_name', $gamename);
        $this->db->from('player');
        if($this->db->count_all_results() == 4){
            $status = "ok";
        }
        else{
            $status ="no";
        }
        return $status;

    }

    public function max_delivery($gamename, $playerid,$role,$team){
        $this->db->where('game_name', $gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;
        if($role === "Retailer"){
            $customer = "customer";
        }
        else if($role === "Wholesaler"){
            $customer = $team."-Retailer";
        }
        else if($role === "Distributor"){
            $customer = $team."-Wholesaler";
        }
        else if($role === "Manufacturer"){
            $customer = $team."-Distributor";
        }

            $this->db->where('game_name',$gamename);
            $this->db->where('from',$customer);
            $this->db->where('turn_count', $current_turn);
            $this->db->where('status',"new");
            $hasil = $this->db->get('demand')->result();

            if($hasil == null){
                return "nodemand";
            }
            else{
                $demand = $hasil[0]->amount;
                $this->db->where('game_name',$gamename);
                $this->db->where('player_id',$playerid);
                $result = $this->db->get('player')->result()[0];
                $onhand = $result->current_inventory;
                $excess = $result->excess_inventory;
                $backlog = $result->current_backlog;
                if($onhand+$excess > $demand+$backlog){
                    return $demand+$backlog;
                }   
                else if($onhand+$excess < $demand+$backlog){
                    return $onhand+$excess;
                }   
                else if($onhand+$excess = $demand+$backlog){
                    return $demand+$backlog;
                }                     
            }

    }

    public function decrease_inventory($supply){

        $player_id = $this->session->userdata('username');
        $gamename = $this->session->userdata('gamename');
        $this->db->where('player_id',$player_id);
        $this->db->where('game_name',$gamename);
        $result = $this->db->get('player')->result()[0];
        $onhand = $result->current_inventory;
        $excess = $result->excess_inventory;
        $capacity = $result->inventory_cap;

        if($supply < $excess){
            $inventory_now = $onhand;
            $excess_now = $excess-$supply;
        }
        else if($supply > $excess){
            $excess_now = 0;
            $supply = $supply-$excess;
            $inventory_now = $onhand-$supply;
        }
        else if($supply == 0){
            $excess_now = $excess;
            $inventory_now = $onhand;
        }

        $data = array(
            'current_inventory' => $inventory_now,
            'excess_inventory' => $excess_now);
        $this->db->where('player_id', $player_id);
        $this->db->where('game_name', $gamename);
        $this->db->update('player', $data);

    }

    public function getCustomer($team,$role){

        if($role === "Retailer"){
            $customer = "customer";
        }
        else if($role === "Wholesaler"){
            $customer = $team."-Retailer";
        }
        else if($role === "Distributor"){
            $customer = $team."-Wholesaler";
        }
        else if($role === "Manufacturer"){
            $customer = $team."-Distributor";
        }

        return $customer;

    }

    public function calculate_backlog($gamename, $username,$supply,$customer){
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id', $username);
        $backlog = $this->db->get('player')->result()[0]->current_backlog;

        $this->db->where('game_name',$gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;

        $this->db->where('game_name',$gamename);
        $this->db->where('from', $customer);
        $this->db->where('status', "new");
        $demand = $this->db->get('demand')->result()[0]->amount;

        $curr_backlog = $backlog + ($demand - $supply);

        $update = array('current_backlog' => $curr_backlog);
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$username);
        $this->db->update('player',$update);

        $insert = array('game_name' => $gamename,
                        'player_id' => $username,
                        'turn_count' => $current_turn,
                        'amount' => $curr_backlog);
        $this->db->insert('backlogs',$insert);
    }

    public function login_check(){
        if($this->session->userdata('is_logged_in') == 1){
            $this->db->where('game_name', $this->session->userdata('gamename'));
            $this->db->where('player_id', $this->session->userdata('username'));
            $log_stat = $this->db->get('player')->result()[0]->login;
            if($log_stat === "set"){
                redirect('player/setting_page');
            }
            else{
                return true;
            }
        }
        else{
            redirect('main/selectgamesession');
        }
    }

    public function login_check2(){
        if($this->session->userdata('is_logged_in') == 1){
            $this->db->where('game_name', $this->session->userdata('gamename'));
            $this->db->where('player_id', $this->session->userdata('username'));
            $log_stat = $this->db->get('player')->result()[0]->login;
            if($log_stat === "set"){
                return true;
            }
            else{
                redirect('player/waitingroom');
            }
        }
        else{
            redirect('main/selectgamesession');
        }
    }

    public function ready_check(){
        $this->db->where('game_name',$this->session->userdata('gamename'));
        $this->db->where('player_team', $this->session->userdata('team'));
        $this->db->where('login', 'yes');
        $this->db->from('player');
        $amount = $this->db->count_all_results();

        if($amount == 4){
            return true;
        }
        else{
            redirect('player/waitingroom');
        }
    }
}


?>