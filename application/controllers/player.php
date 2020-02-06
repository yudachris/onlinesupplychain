<?php
class Player extends CI_Controller {
    
    public function waitingroom() {
        $this->load->model('game_dynamics');
        $this->game_dynamics->login_check();
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $data['gamedata'] = $this->db->get('game')->result()[0];
        $data['title']=$this->session->userdata('username') . " - Waiting Room";
        $this->load->view('PlayerPages/waitingroom',$data);
        $this->load->view('Etc/Footer');
    }

    public function select_diff(){
        $gamename = $this->session->userdata('gamename');
        $this->db->where('game_name', $gamename);
        $diff = $this->db->get('game')->result()[0]->difficulty;
        if($diff == "adv"){
            redirect('player/playerhome');
        }
        else{
            redirect('player/playerhome_b');
        }
    }

    public function playerhome() {
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');
        $this->load->model('game_dynamics');
        $this->game_dynamics->login_check();
        $this->game_dynamics->ready_check();
        $this->db->where('game_name', $gamename);
        $this->db->where('player_id', $player_id);
        $data['spability'] =  $this->db->get('player')->result()[0]->spability;
        
        $this->db->where('game_name',$gamename);
        $data['cost_rule'] = $this->db->get('cost')->result()[0];
        $data['title'] = $this->session->userdata('username') . " - Game Module";
        $this->load->view('PlayerPages/PlayerHome', $data);
        $this->load->view('Etc/Footer');
    }

    public function playerhome_b(){

        $data['title'] = "Beginner Module";
        $this->load->view('PlayerPages/PlayerHomeBeginner',$data);
        $this->load->view('Etc/Footer');

    }

    public function future_forecast(){
        $gamename = $this->session->userdata('gamename');
        $this->db->where('game_name', $gamename);
        $fromgame = $this->db->get('game')->result();
        $current_turn = $fromgame[0]->current_turn;
        $end_turn = $fromgame[0]->end_turn;
        $indicator = $end_turn-1;
        if($current_turn < $indicator){
            $future1 = $current_turn+1;
            $future2 = $current_turn+2;
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $future1);
            $res1 = $this->db->get('preset_demand')->result()[0];
            $data['next1'] = array('turn_count' => $res1->turn_count,
                                    'amount' => $res1->amount);
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $future2);
            $res2 = $this->db->get('preset_demand')->result()[0];
            $data['next2'] = array('turn_count' => $res2->turn_count,
                                    'amount' => $res2->amount);
        }
        else if($current_turn == $indicator){
            $future1 = $current_turn+1;
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $future1);
            $res1 = $this->db->get('preset_demand')->result()[0];
            $data['next1'] = array('turn_count' => $res1->turn_count,
                                    'amount' => $res1->amount);
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $indicator);
            $dummy = $this->db->get('preset_demand')->result()[0]->amount;
            $dummy_amount = floor(($dummy*3)-floor($dummy/2));
            $data['next2'] = array('turn_count' => $current_turn+2,
                                    'amount' => $dummy_amount);
        }
        else if($current_turn == $end_turn){
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $indicator);
            $dummy = $this->db->get('preset_demand')->result()[0]->amount;
            $dummy_amount = floor(($dummy*3)-floor($dummy/2));
            $data['next1'] = array('turn_count' => $current_turn+1,
                                    'amount' => $dummy_amount);
            $this->db->where('game_name', $gamename);
            $this->db->where('turn_count', $end_turn);
            $dummy = $this->db->get('preset_demand')->result()[0]->amount;
            $dummy_amount = floor(($dummy*3)-floor($dummy/2));
            $data['next2'] = array('turn_count' => $current_turn+2,
                                    'amount' => $dummy_amount);
        }
        $this->load->view('PlayerPages/future_forecast',$data);
    }

    public function complete_statistic(){
        $this->load->model('game_dynamics');
        $this->game_dynamics->login_check();
        $data['title'] = "Player's Statistics";
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');

        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $data['cost'] = $this->db->get('player')->result()[0];

        $this->db->where('game_name', $gamename);
        $data['current_turn'] = $this->db->get('game')->result()[0]->current_turn;

        $this->load->view('PlayerPages/complete_statistics',$data);
        $this->load->view('Etc/Footer');
    }

    public function complete_history(){

        $this->load->model('game_dynamics');
        $this->game_dynamics->login_check();
        
        $data['title'] = "Player's Complete History";
        $this->load->view('PlayerPages/complete_history',$data);   
        $this->load->view('Etc/Footer');
    }

    public function order_input(){

        $this->load->model('game_dynamics');
        $gamename = $this->session->userdata('gamename');
        $username = $this->session->userdata('username');
        $team = $this->session->userdata('team');
        $role = $this->session->userdata('role');
        $data_init = array(
            'status' => "old");
        $this->db->where('from',$username);
        $this->db->where('game_name', $gamename);
        $this->db->update('demand',$data_init);

        $this->db->where('game_name',$gamename);
        $turn = $this->db->get('game')->result()[0]->current_turn;
        $demand = $this->input->post('ordertosupplier');
        $data = array(
            'game_name'=>$gamename,
            'from' => $username,
            'turn_count'=> $turn,
            'amount' => $demand,
            'status' => "new"
            );

        $this->db->insert('demand',$data);

        $data2 = array(
            'status' => "deliver");

        $this->db->where('game_name',$gamename);
        $this->db->where('player_id', $username);
        $this->db->update('player',$data2);


        if($role === "Manufacturer"){
            $f = $team ."-Resource";
            $data_init = array(
                    'status' => "old");
            $this->db->where('from', $f);
            $this->db->where('game_name', $gamename);
            $this->db->update('supply', $data_init);

            $data_after = array(
            'game_name'=>$gamename,
            'from' => $f,
            'turn_count'=> $turn,
            'amount' => $demand,
            'status' => "new"
            );

            $this->db->insert('supply',$data_after);

        }
        redirect('player/select_diff');
    }

    public function deliver_input(){

        $gamename = $this->session->userdata('gamename');
        $username = $this->session->userdata('username');
        $team = $this->session->userdata('team');
        $role = $this->session->userdata('role');
        $supply = $this->input->post('delivertocustomer');

        $this->load->model('game_dynamics');
        $max_delivery = $this->game_dynamics->max_delivery($gamename, $username,$role,$team);
        if($supply > $max_delivery){
            return false;
        }
        else{
        $this->game_dynamics->decrease_inventory($supply);
            $data_init = array(
            'status' => "old");
        $this->db->where('from',$username);
        $this->db->where('game_name', $gamename);
        $this->db->update('supply',$data_init);

        $this->db->where('game_name',$gamename);
        $turn = $this->db->get('game')->result()[0]->current_turn;
        $data = array(
            'game_name'=>$gamename,
            'from' => $username,
            'turn_count'=> $turn,
            'amount' => $supply,
            'status' => "new"
            );

        $this->db->insert('supply',$data);

        $data2 = array(
            'status' => "delivered");

        $this->db->where('game_name',$gamename);
        $this->db->where('player_id', $username);
        $this->db->update('player',$data2);

        //BACKLOG CALCULATION & POSTING
        $customer = $this->game_dynamics->getCustomer($team,$role);
        $this->game_dynamics->calculate_backlog($gamename,$username,$supply,$customer);

        $delivered_stat = $this->game_dynamics->check_delivered($team, $gamename);
        if($delivered_stat === "ok"){
            $data3 = array('status' => "standby");
            $this->db->where('game_name',$gamename);
            $this->db->where('player_team',$team);
            $this->db->update('player',$data3);

            $data4 = array('status' => "ready");
            $this->db->where('game_name', $gamename);
            $this->db->where('team_code', $team);
            $this->db->update('team', $data4);
        } 
        }
        redirect('player/select_diff');
    }

        public function setting_page(){
            $this->load->model('game_dynamics');
            $this->game_dynamics->login_check2();
            $gamename = $this->session->userdata('gamename');
            $team = $this->session->userdata('team');
            $player_id = $this->session->userdata('username');
            $this->db->where('game_name', $gamename);
            $this->db->where('team_code', $team);
            $credit_amount =$this->db->get('team')->result()[0]->team_credit;
            $data['credit_amount'] = $credit_amount;

            $this->db->where('game_name',$gamename);
            $facilitator = $this->db->get('game')->result()[0]->made_by;

            $this->db->where('name', $facilitator);
            $f_username = $this->db->get('users')->result()[0]->username;
            
            $this->db->order_by('good_id', 'asc');
            $this->db->where('username', $f_username);
            $price = $this->db->get('avail_item')->result();
            
            $data['lt_dec_price'] = $price[0]->price;
            $data['inv_ex_price'] = $price[1]->price;
            $data['fut_for_price'] = $price[2]->price; 

            $data['lt_dec_av'] = $price[0]->availability;
            $data['inv_ex_av'] = $price[1]->availability;
            $data['fut_for_av'] = $price[2]->availability;

            $this->db->where('game_name', $gamename);
            $this->db->where('player_team',$team);
            $data['player'] = $this->db->get('player')->result();

            $this->db->where('game_name', $gamename);
            $data['mode'] = $this->db->get('game')->result()[0]->mode;

            $data['title']="Team Settings";
            $data['team']=$team;
            $this->load->view('PlayerPages/settings',$data);            
        }

        public function finish_setting(){
            
            $gamename = $this->session->userdata('gamename');
            $username = $this->session->userdata('username');
            $team = $this->session->userdata('team');
            $updates = array(
                'login' => 'yes');
            $this->db->where('game_name', $gamename);
            $this->db->where('player_id', $username);
            $this->db->update('player',$updates);

            $updates2 = array(
                'setting' => 'set');
            $this->db->where('game_name', $gamename);
            $this->db->where('team_code', $team);
            $this->db->update('team', $updates2);
            redirect('player/waitingroom');
        }

        public function buy_expansion(){
            $player_id = $this->input->post('player_id');
            $amount = $this->input->post('amount');
            $team = $this->session->userdata('team');
            $gamename = $this->session->userdata('gamename');

            $this->db->where('player_id', $player_id);
            $this->db->where('game_name', $gamename);
            $current_cap = $this->db->get('player')->result()[0]->inventory_cap;

            $after_cap = $current_cap+$amount;

            $updater = array('inventory_cap' => $after_cap);
            $this->db->where('player_id', $player_id);
            $this->db->where('game_name', $gamename);
            $this->db->update('player',$updater);

            $this->db->where('game_name',$gamename);
            $facilitator = $this->db->get('game')->result()[0]->made_by;

            $this->db->where('name', $facilitator);
            $f_username = $this->db->get('users')->result()[0]->username;
            
            $this->db->where('username', $f_username);
            $this->db->where('good_id', "G2");
            $price = $this->db->get('avail_item')->result()[0]->price;

            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $current_credit = $this->db->get('team')->result()[0]->team_credit;

            $total = $price*$amount;
            $credit_left = $current_credit - $total;

            $update = array('team_credit' => $credit_left);
            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $this->db->update('team',$update);

            redirect('player/setting_page');
        }

        public function buy_decrease_lt(){
            $player_id = $this->input->post('player_ids');
            $amount = $this->input->post('amount');
            $gamename = $this->session->userdata('gamename');
            $team = $this->session->userdata('team');

            $this->db->where('game_name',$gamename);
            $facilitator = $this->db->get('game')->result()[0]->made_by;

            $this->db->where('name', $facilitator);
            $f_username = $this->db->get('users')->result()[0]->username;

            $this->db->where('username', $f_username);
            $this->db->where('good_id', "G1");
            $price = $this->db->get('avail_item')->result()[0]->price;
            
            $total = $price*$amount;

            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $current_credit = $this->db->get('team')->result()[0]->team_credit;

            $credit_left = $current_credit - $total;
            
            $update = array('team_credit' => $credit_left);
            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $this->db->update('team',$update);

            //UPDATING LEADTIME
                $this->db->where('game_name',$gamename);
                $this->db->where('player_id', $player_id);
                $this->db->from('shipping_delay');
                $total_lt = $this->db->count_all_results();
                print_r("TOTAL LT = ".$total_lt."<br>");
            for($x=0;$x<$amount;$x++){
                $idx = $total_lt-$x;
                $this->db->where('game_name', $gamename);
                $this->db->where('player_id', $player_id);
                $this->db->where('delay_num', $idx);
                $this->db->delete('shipping_delay');
            }

            $now_lt = $total_lt-$amount;

            $updater = array('leadtime' => $now_lt);
            $this->db->where('game_name', $gamename);
            $this->db->where('player_id', $player_id);
            $this->db->update('player', $updater);

            redirect('player/setting_page');
        }

        public function buy_future_forecast(){
            $player_id = $this->input->post('player_id');
            $gamename = $this->session->userdata('gamename');
            $team = $this->session->userdata('team');

            $update = array('spability' => 'yes');
            $this->db->where('player_id', $player_id);
            $this->db->where('game_name', $gamename);
            $this->db->update('player',$update);

            $this->db->where('game_name',$gamename);
            $facilitator = $this->db->get('game')->result()[0]->made_by;

            $this->db->where('name', $facilitator);
            $f_username = $this->db->get('users')->result()[0]->username;

            $this->db->where('username', $f_username);
            $this->db->where('good_id', "G3");
            $price = $this->db->get('avail_item')->result()[0]->price;

            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $current_credit = $this->db->get('team')->result()[0]->team_credit;

            $credit_left = $current_credit - $price;

            $update = array('team_credit' => $credit_left);
            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $this->db->update('team',$update);

            redirect('player/setting_page');
        }
    
}
?>
