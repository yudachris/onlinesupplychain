<?php

class Adminpartscontroller extends CI_Controller{
    public function playermgmttab(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->load->model('playerdata'); 
        if($this->playerdata->getTeamlength()==0){
            $data['avail']="no";
        }
        else{
        $data['avail']="yes";
        $data['teamlength']= $this->playerdata->getTeamlength();
        $playerdata = array();
        for($x=1;$x<=$this->playerdata->getTeamlength();$x++){
            
            $teamconv = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
            
            $p_team = $teamconv[$x];
            
            $this->db->where('game_name', $gamename);
            $this->db->where('player_team',$p_team);
            
            $dataplayer = $this->db->get('player')->result(); 
            array_push($playerdata ,$dataplayer);
            
        }
        $data['bigdata']=$playerdata;
        }
            $this->load->view('AdminParts/playermgmttable',$data);
            
    }

    public function admin_home_content(){
        $this->db->where('username', $this->session->userdata('username'));
        $made_by = $this->db->get('users')->result()[0]->name;

        $this->db->where('made_by', $made_by);
        $this->db->from('game');
        $amount = $this->db->count_all_results();
        if($amount == 1){
            $data['game']="exists";
            $this->load->model('status_check_model');
            $this->db->where('game_name',$this->status_check_model->current_gamename());
            $data['team'] = $this->db->get('team')->result();
            $this->db->where('game_name',$this->status_check_model->current_gamename());
            $data['game_data']=$this->db->get('game')->result()[0];
        }
        else{
            $data['game']="no";
        }
        
        $this->load->view('AdminParts/adminhomeparts',$data);
    }
    
    public function stat_dashboard(){
        
        $this->load->model('status_check_model');
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $data['team'] = $this->db->get('team')->result();
        $this->load->view('AdminParts/realtimestatistics',$data);
    }

    public function week_panel(){
        $this->load->model('status_check_model');
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $data['maxweek'] = $this->db->get('game')->result()[0]->end_turn;
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $data['weekcount'] = $this->db->get('game')->result()[0]->current_turn;
        $this->load->view('AdminParts/weekpanel',$data);

    }

    public function next_button(){
        
        $this->load->model('status_check_model');
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $current = $this->db->get('game')->result()[0]->current_turn;
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $max = $this->db->get('game')->result()[0]->end_turn;

        if($current === $max){
            $data['next_turn']= "end";
            $this->load->view('AdminParts/next_turn_button',$data);
        }
        else{
            $this->db->where('game_name',$this->status_check_model->current_gamename());
            $this->db->where('status',"ready");
            $this->db->from('team');
            $ready = $this->db->count_all_results();
            
            $this->db->where('game_name',$this->status_check_model->current_gamename());
            $this->db->from('team');
            $all = $this->db->count_all_results();
            
            if($ready === $all){
                $stat = "ok";
                
            }
            else{
                $stat = "no";
                
            }
            
            $data['next_turn']= $stat;
            $this->load->view('AdminParts/next_turn_button',$data);
        }
             
    }

    public function demand_input(){

        $this->load->model('status_check_model');
        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $current = $this->db->get('game')->result()[0]->current_turn;

        $this->db->where('game_name',$this->status_check_model->current_gamename());
        $this->db->where('status', "new");
        $this->db->where ('from', "customer");
        if($this->db->get('demand')->result()==null){
            $data['status'] = "ok";
            $this->load->view('AdminParts/demand_input_button',$data);

        }
        else{
            $this->db->where('game_name',$this->status_check_model->current_gamename());
            $this->db->where('status', "new");
            $this->db->where ('from', "customer");
            $new_dem_turn = $this->db->get('demand')->result()[0]->turn_count;
            if($new_dem_turn == $current){
                $data['status'] = "no";
                $this->load->view('AdminParts/demand_input_button',$data);
            }
            else{
                $data['status'] = "ok";
                $this->load->view('AdminParts/demand_input_button',$data);
            }
        }
        
    }

    public function realtime_demand_tab(){

        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();

        $this->db->where('game_name', $gamename);
        $this->db->where('status', "new");
        $this->db->where('from', "customer");

        if($this->db->get('demand')->result() == null){
            $data['current_demand'] = "no";
        }
        else{
            $this->db->where('game_name', $gamename);
            $this->db->where('status', "new");
            $this->db->where('from', "customer");
            $data['current_demand'] = $this->db->get('demand')->result()[0];
        }   
        
        $this->load->view('AdminParts/realtimedemandtable',$data);

    }

    public function previous_demand_tab(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();

        $this->db->where('game_name', $gamename);
        $this->db->where('status', "old");
        $this->db->where('from', "customer");
        $data['prev_demand'] = $this->db->get('demand')->result();
        $this->load->view('AdminParts/previousdemandtable',$data);
    }

    public function presetfield(){
        $username = $this->session->userdata('username');
        $this->db->where('username',$username);
        $this->db->delete('preset_demand_temp');
        $data['turn_quantity'] = $this->input->post('turn_quantity');
        $this->load->view('AdminParts/demand_form',$data);
    }

    public function item_table(){
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->from('shop');
        $this->db->join('avail_item','shop.good_id=avail_item.good_id');
        $data['items'] = $this->db->get()->result();
        $this->load->view('AdminParts/item_management_table',$data);
    }

    public function game_detailAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $results = $this->db->get('game')->result()[0];
        $game_mode = $results->mode;
        if($results->login_permit==="restrict"){
                    $data['permission'] = "Restricted";
            }
            else{
                    $data['permission'] = "Allowed";
            }
            $data['facilitator'] = $results->made_by;
            $data['game_mode'] = "Custom - Preset Demand";
            $data['game_name'] = $gamename;
            //FINISH THIS FIRST
            $this->load->model('readystate');
            $data['proceed_allowance'] = $this->readystate->check_status($gamename);
            $this->load->view('AdminParts/game_detail',$data);
    }

    public function weekpanelAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();

        $this->db->where('game_name', $gamename);
        $results = $this->db->get('game')->result();
        $data['this_week'] = $results[0]->current_turn;
        $data['final_week'] = $results[0]->end_turn;

        $this->load->view('AdminParts/weekpanelAT',$data);
    }

    public function stattableAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->order_by('total_cost','asc');
        $this->db->where('game_name',$gamename);
        $data['teams'] = $this->db->get('team')->result();
        $this->load->view('AdminParts/stattableAT',$data);
    }

    public function demandtableAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name', $gamename);
        $data['current_turn'] = $this->db->get('game')->result()[0]->current_turn;
        $this->db->where('game_name',$gamename);
        $data['demands'] = $this->db->get('preset_demand')->result();
        $this->load->view('AdminParts/demandtableAT',$data);
    }

    public function demandmodAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $this->db->from('preset_demand');
        $data['turns'] = $this->db->count_all_results();
        $this->db->where('game_name',$gamename);
        $data['current_turn'] = $this->db->get('game')->result()[0]->current_turn;
        $this->load->view('AdminParts/demandmodAT',$data);
    }

    public function demandactiveAT(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $this->db->where('from',"customer");
        if($this->db->get('demand')->result() == null){
            $data['active'] = "no";
        }
        else{
            $this->db->where('game_name',$gamename);
            $this->db->where('from', "customer");
            $this->db->where('status', "new");
            $data['active'] = $this->db->get('demand')->result()[0];
        }
        $this->load->view('AdminParts/demandactiveAT', $data);
    }

    public function detailed_statistic(){
        $this->load->model('status_check_model');
        $gamename = $this->status_check_model->current_gamename();
        $team_code = $this->input->post('teamname');
        $data['team_code'] = $team_code;
        $this->db->where('game_name',$gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;

        if($current_turn == 1){
            return false;
        }
        else{
            $this->db->where('game_name',$gamename);
            $this->db->where('player_team', $team_code);
            $results = $this->db->get('player')->result();
            $data['cost'] = $results;

            $this->db->select_sum('total_cost');
            $this->db->where('game_name',$gamename);
            $this->db->where('player_team', $team_code);
            $total_cost = $this->db->get('player')->result()[0]->total_cost;
            $data['total_cost'] = $total_cost;

            //PERCENTAGE
            //RETAILER
            $this->db->where('game_name',$gamename);
            $this->db->where('player_id', $team_code."-Retailer");
            $retailer_cost = $this->db->get('player')->result()[0]->total_cost;
            $data['retailer_percent'] = number_format(($retailer_cost/$total_cost)*100,2); 
            //WHOLESALER
            $this->db->where('game_name',$gamename);
            $this->db->where('player_id', $team_code."-Wholesaler");
            $wholesaler_cost = $this->db->get('player')->result()[0]->total_cost;
            $data['wholesaler_percent'] = number_format(($wholesaler_cost/$total_cost)*100,2);
            //DISTRIBUTOR
            $this->db->where('game_name',$gamename);
            $this->db->where('player_id', $team_code."-Distributor");
            $distributor_cost = $this->db->get('player')->result()[0]->total_cost;
            $data['distributor_percent'] = number_format(($distributor_cost/$total_cost)*100,2);
            //MANUFACTURER
            $this->db->where('game_name',$gamename);
            $this->db->where('player_id', $team_code."-Manufacturer");
            $manufacturer_cost = $this->db->get('player')->result()[0]->total_cost;
            $data['manufacturer_percent'] = number_format(($manufacturer_cost/$total_cost)*100,2);

            $this->load->view('AdminParts/detailed_statistic',$data);
        }
    }
}

?>
