<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gamecontroller extends CI_Controller {
    
    public function play_pause(){

    $this->load->model('status_check_model');
    $gamename = $this->status_check_model->current_gamename();

    $this->db->where('game_name',$gamename);
    $current_turn = $this->db->get('game')->result()[0]->current_turn;


    $this->db->where('game_name',$gamename);
    $stat = $this->db->get('game')->result()[0]->status;
    if($stat === "play"){
        $data = array('status' => "pause");
        $this->db->where('game_name',$gamename);
        $this->db->update('game',$data);
    }
    else{
        $data =  array('status' => "play");
        $this->db->where('game_name',$gamename);
            $this->db->update('game', $data);
    }

    $this->db->where('game_name',$gamename);
    $stat_after = $this->db->get('game')->result()[0]->status;
    if($current_turn == 1 && $stat_after =="play"){
        $data_update = array(
            'status' => "order");
        $this->db->where('game_name',$gamename);
        $this->db->update('player',$data_update);
    }

        
    }
    
    public function change_playerlogin(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $player_id=$this->input->post('playerid');
        $status = $this->input->post('status');

        $dataupdate = array(
            'login' => $status);
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $this->db->update('player',$dataupdate);
    }

    public function change_playerphase(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $player_id=$this->input->post('playerid');
        $status = $this->input->post('phase');

        $dataupdate = array(
            'status' => $status);
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $this->db->update('player',$dataupdate);
    }

    public function login_permit(){


        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $stat = $this->db->get('game')->result()[0]->login_permit;

        if($stat === "allow"){
            $data = array('login_permit' => 'restrict');
            $this->db->where('game_name',$gamename);
            $this->db->update('game', $data);
        }
        else{
            $data = array('login_permit' => 'allow');
            $this->db->where('game_name',$gamename);
            $this->db->update('game', $data);
        }
    }

    public function add_turn(){

        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        
        $this->load->model('goods_movement');
        //MOVE GOODS
        $this->goods_movement->admin_movement($gamename);
        //CALCULATE COSTS     
        $this->goods_movement->cost_calculation($gamename);
        //POST STATISTICS
        $this->goods_movement->update_team($gamename);
        

        $this->db->where('game_name', $gamename);
        $res = $this->db->get('game')->result();
        $final = $res[0]->end_turn;
        $now = $res[0]->current_turn;

        if($final == $now){
            $data2 = array(
            'status' => 'not ready');
            $this->db->where('game_name',$gamename);
            $this->db->update('team',$data2);

            $data3 = array(
                'status' => 'standby');
            $this->db->where('game_name', $gamename);
            $this->db->update('player', $data3);
        }
        else{
            $data2 = array(
            'status' => 'not ready');
            $this->db->where('game_name',$gamename);
            $this->db->update('team',$data2);

            $data3 = array(
                'status' => 'order');
            $this->db->where('game_name', $gamename);
            $this->db->update('player', $data3);

            $then = $now + 1;

            $data = array(
                'current_turn' => $then);
            $this->db->where('game_name',$gamename);
            $this->db->update('game',$data);

            $this->db->where('game_name',$gamename);
            $mode = $this->db->get('game')->result()[0]->mode;
            if($mode === "auto"){
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $then);
            $next_demand = $this->db->get('preset_demand')->result()[0]->amount;

            $old = array('status'=>"old");
            $this->db->where('game_name',$gamename);
            $this->db->where('from', "customer");
            $this->db->update('demand', $old);

            $insertion = array(
                'game_name' => $gamename,
                'from' => "customer",
                'turn_count' => $then,
                'amount' => $next_demand,
                'status' => "new"
                ); 
            $this->db->insert('demand', $insertion);
            }
        }

    }

    public function customer_demand(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $data_init = array(
            'status' => "old");
        $this->db->where('from',"customer");
        $this->db->where('game_name', $gamename);
        $this->db->update('demand',$data_init);

        $this->db->where('game_name',$gamename);
        $turn = $this->db->get('game')->result()[0]->current_turn;
        $demand = $this->input->post('d_amount');
        $data = array(
            'game_name'=>$gamename,
            'from' => "customer",
            'turn_count'=> $turn,
            'amount' => $demand,
            'status' => "new"
            );

        $this->db->insert('demand',$data);

    }
    
    public function stopgame(){

        
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $this->db->delete('game');
        $this->db->where('game_name',$gamename);
        $this->db->delete('shipping_delay');
        $this->db->where('game_name',$gamename);
        $this->db->delete('player');
        $this->db->where('game_name',$gamename);
        $this->db->delete('team');
        $this->db->where('game_name',$gamename);
        $this->db->delete('demand');
        $this->db->where('game_name',$gamename);
        $this->db->delete('statistics');
        $this->db->where('game_name',$gamename);
        $this->db->delete('cost');
        $this->db->where('game_name',$gamename);
        $this->db->delete('preset_demand');
        redirect('admin/adminhome');
        
    }

    public function save_preset_demand(){
        $username = $this->session->userdata('username');
        $this->db->where('username',$username);
        $this->db->delete('preset_demand_temp');
        $turn_count = $this->input->post('num_of_turn');
        for($x=1;$x<=$turn_count;$x++){
            $name = 'demand'.$x;
            $demand = $this->input->post($name);
            $insertion = array(
                'username' => $username,
                'turn_count' => $x,
                'amount' => $demand);
            $this->db->insert('preset_demand_temp',$insertion);
        }
        
    }

    public function modify_demand(){
        $weekcount = $this->input->post('week');
        $amount = $this->input->post('amount');
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();

        $update = array('amount'=>$amount);
        $this->db->where('game_name',$gamename);
        $this->db->where('turn_count',$weekcount);
        $this->db->update('preset_demand', $update);

        redirect('admin/dashboard');
    }

    public function initiatedemand(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $turncount = $this->db->get('game')->result()[0]->current_turn;
        $this->db->where('game_name',$gamename);
        $this->db->where('turn_count', $turncount);
        $amount = $this->db->get('preset_demand')->result()[0]->amount;

        $insertion = array(
            'game_name' => $gamename,
            'from' => "customer",
            'turn_count' =>$turncount,
            'amount' => $amount,
            'status' => "new");

        $this->db->insert('demand',$insertion);
    }

}

?>
