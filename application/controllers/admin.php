<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function newgamepreset(){
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $data['availability']=$this->status_check_model->check();
        $data['title']="New Game - Preset Demand";
        $this->db->select('*');
        $this->db->from('shop');
        $this->db->where('avail_item.username',$this->session->userdata('username'));
        $this->db->join('avail_item','shop.good_id=avail_item.good_id');
        $data['items'] = $this->db->get()->result();
        $this->load->view('etc/AdminHeader',$data);
        $this->load->view('AdminPages/NewGameSettingP',$data);
        $this->load->view('Etc/Footer');
    }

    public function adminhome(){
            $this->load->model('status_check_model');
            $this->status_check_model->check_login();
            $data['availability']=$this->status_check_model->check();
            
            $data['title']="Game Facilitator Module";
            $this->db->where('username', $this->session->userdata('username'));
            $data['user']= $this->db->get('users')->result()[0]->name;
            $this->load->view('etc/AdminHeader',$data);
            $this->load->view('AdminPages/AdminPage',$data);
            $this->load->view('etc/Footer',$data);
        }
        
    public function playermgmt(){
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $gamename = $this->status_check_model->current_gamename();
        $this->load->model('status_check_model');
        $data['availability']=$this->status_check_model->check();
        $this->db->where('game_name',$gamename);
        $data['players']=$this->db->get('player')->result();
        $data['title']="Player Management";
        $this->load->view('etc/AdminHeader',$data);
        $this->load->view('AdminPages/playermgmt',$data);
        $this->load->view('Etc/Footer');

        
    }
    
    public function user_management(){
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $data['availability']=$this->status_check_model->check();
        $this->db->where('username', $this->session->userdata('username'));
        $data['user']= $this->db->get('users')->result()[0]->name;

        $this->load->model('status_check_model');
        $data['previllege'] = $this->status_check_model->check_credential();
        $data['successmessage'] = "no";
        $data['title'] = "User Management";
        $this->load->view('etc/AdminHeader', $data);
        $this->load->view('AdminPages/usermgmt', $data);
        $this->load->view('Etc/Footer');

    }

    public function add_user(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required'); 
        $this->form_validation->set_rules('new_pass', 'Password', 'required'); 
        $this->form_validation->set_rules('conf_pass', 'Confirmation Password', 'required|matches[new_pass]'); 
        $this->form_validation->set_rules('previllege', 'Previllege', 'required');         
        
        if($this->form_validation->run() == TRUE){
            $username = $this->input->post('username');
            $fullname = $this->input->post('full_name');
            $password = md5($this->input->post('new_pass'));
            $status = $this->input->post('previllege');

            $insertion = array(
                'username' => $username,
                'password' => $password,
                'name'=> $fullname,
                'status' =>$status
                );
            $this->db->insert('users',$insertion);

            for($x=1;$x<=3;$x++){
                $good_id = "G".$x;
                $insertion2 = array(
                    'username' => $username,
                    'good_id' => $good_id,
                    'price' => 0,
                    'availability' => 'Available'
                    );
                $this->db->insert('avail_item',$insertion2);
            }
            redirect('admin/user_management');
        }
        else{
        $this->load->model('status_check_model');
        $data['availability']=$this->status_check_model->check();
        $this->db->where('username', $this->session->userdata('username'));
        $data['user']= $this->db->get('users')->result()[0]->name;

        $this->load->model('status_check_model');
        $data['previllege'] = $this->status_check_model->check_credential();
        $data['successmessage'] = "no";
        $data['title'] = "User Management";
        $this->load->view('etc/AdminHeader', $data);
        $this->load->view('AdminPages/usermgmt', $data);
        $this->load->view('Etc/Footer');
        }
    }

    public function change_password(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_pass', 'Old Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[conf_pass]');
        $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|matches[conf_pass]');

        if($this->form_validation->run() == TRUE){

            $username = $this->input->post('user_name');
            $oldpass = md5($this->input->post('old_pass'));
            $newpass = md5($this->input->post('new_pass'));


            $this->db->where('username',$username);
            if($this->db->get('users')->result()[0]->password === $oldpass){

                $dataupdate = array('password' => $newpass);
                $this->db->where('username', $username);
                $this->db->update('users', $dataupdate);
                $this->load->model('status_check_model');
                $data['availability']=$this->status_check_model->check();
                $this->db->where('username', $this->session->userdata('username'));

                $this->load->model('status_check_model');
                $data['previllege'] = $this->status_check_model->check_credential();
                $data['successmessage'] = "passchanged";
                $data['user']= $this->db->get('users')->result()[0]->name;
                $data['title'] = "User Management";
                $this->load->view('etc/AdminHeader', $data);
                $this->load->view('AdminPages/usermgmt', $data);
            $this->load->view('Etc/Footer');




            }
            else{

                $this->load->model('status_check_model');
                $data['availability']=$this->status_check_model->check();
                $this->db->where('username', $this->session->userdata('username'));
                $data['user']= $this->db->get('users')->result()[0]->name;

                $this->load->model('status_check_model');
                $data['previllege'] = $this->status_check_model->check_credential();
                $data['successmessage'] = "change_pass_false";
                $data['title'] = "User Management";
                $this->load->view('etc/AdminHeader', $data);
                $this->load->view('AdminPages/usermgmt', $data);
                


            }

        }
        else{

            $this->load->model('status_check_model');
            $data['availability']=$this->status_check_model->check();
            $this->db->where('username', $this->session->userdata('username'));
            $data['user']= $this->db->get('users')->result()[0]->name;

            $this->load->model('status_check_model');
            $data['previllege'] = $this->status_check_model->check_credential();
            $data['successmessage'] = "no";
            $data['title'] = "User Management";
            $this->load->view('etc/AdminHeader', $data);
            $this->load->view('AdminPages/usermgmt', $data);
            $this->load->view('Etc/Footer');

        }


    }

    
    public function game_management(){
        
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();

        $data['availability']=$this->status_check_model->check();
        
        $this->db->select('*');
        $this->db->from('shop');
        $this->db->join('avail_item','shop.good_id=avail_item.good_id');
        $this->db->where('avail_item.username',$this->session->userdata('username'));
        $data['items'] = $this->db->get()->result();
        $data['title'] = "Game Management";
        $this->load->view('Etc/AdminHeader', $data);
        $this->load->view('AdminPages/gamemgmt', $data);
        $this->load->view('Etc/Footer');

    }
    
    public function change_price(){
        $good_id = $this->input->post('good_id');
        $price = $this->input->post('good_price');
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('good_id',$good_id);
        $updates = array('price' => $price);
        $this->db->update('avail_item',$updates);
    }

    public function newgamecustom() {
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $data['availability']=$this->status_check_model->check();
        $this->load->model('item_availability');
        $this->item_availability->reset();

        $this->db->select('*');
        $this->db->from('shop');
        $this->db->where('avail_item.username',$this->session->userdata('username'));
        $this->db->join('avail_item','shop.good_id=avail_item.good_id');
        $data['items'] = $this->db->get()->result();

        $data['title'] = "New Game Settings [Custom]";
        $this->load->view('Etc/AdminHeader', $data);
        $this->load->view('AdminPages/NewGameSettingC', $data);
        $this->load->view('Etc/Footer');
        
    }

    public function setting_validation() {

        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
            $data['availability']=$this->status_check_model->check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('g_name', 'Game Name', 'required');
        $this->form_validation->set_rules('g_pass', 'Password', 'required');
        $this->form_validation->set_rules('g_turn', 'Number of Turn', 'required|integer|greater_than[1]');
        $this->form_validation->set_rules('g_credit', 'Credit', 'required|integer|greater_than[-1]');
        $this->form_validation->set_rules('g_invcost', 'Inventory Cost', 'required|integer|greater_than[-1]');
        $this->form_validation->set_rules('g_exinvcost', 'Excessive Inventory Cost', 'required|integer|greater_than[-1]');
        $this->form_validation->set_rules('g_backcost', 'Backlog Cost', 'required|integer|greater_than[-1]');
        $this->form_validation->set_rules('init_inv_cap', 'Initial Inventory Cap', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('init_inv_lev', 'Initial Inventory Level', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('lt_inv_lev', 'In-transit Inventory Level', 'required|integer|greater_than[0]');


        if ($this->form_validation->run() == TRUE) {

            $data['g_name'] = $this->input->post('g_name');
            $data['g_pass'] = $this->input->post('g_pass');
            $data['g_teams'] = $this->input->post('g_team');
            $data['g_turn'] = $this->input->post('g_turn');
            $data['g_credit'] = $this->input->post('g_credit');
            $data['g_invcost'] = $this->input->post('g_invcost');
            $data['g_excost'] = $this->input->post('g_exinvcost');
            $data['g_bcost'] = $this->input->post('g_backcost');
            $data['g_invcap'] = $this->input->post('init_inv_cap');
            $data['g_onhand'] = $this->input->post('init_inv_lev');
            $data['g_leadtime'] = $this->input->post('lead_time');
            $data['g_intransit'] = $this->input->post('lt_inv_lev');

            $this->db->where('username', $this->session->userdata('username'));
            $data['fac_name'] = $this->db->get('users')->result()[0]->name;

            $data['G1'] = $this->input->post('availabilityG1');
            $data['G2'] = $this->input->post('availabilityG2');
            
            $data['title'] = "Setting Summary";
            $this->load->view('AdminPages/SettingSummary', $data);
        } 
        
        else {

            $this->load->model('status_check_model');
            $this->status_check_model->check_login();
            $data['availability']=$this->status_check_model->check();
            $this->load->model('item_availability');
            $this->item_availability->reset();
            $this->db->empty_table('new_game_temp');

            $this->db->select('*');
            $this->db->from('shop');
            $this->db->where('avail_item.username',$this->session->userdata('username'));
            $this->db->join('avail_item','shop.good_id=avail_item.good_id');
            $data['items'] = $this->db->get()->result();

            $data['title'] = "New Game Settings [Custom]";
            $this->load->view('Etc/AdminHeader', $data);
            $this->load->view('AdminPages/NewGameSettingC', $data);
            $this->load->view('Etc/Footer');

        }
    }

    public function setting_summary(){

            $this->db->where('username',$this->session->userdata('username'));
            $made_by = $this->db->get('users')->result()[0]->name;
            
            $this->db->where('made_by',$made_by);
            $game = $this->db->get('new_game_temp')->result()[0];

            $data['game_inst'] = $game->made_by;
            $data['game_n'] = $game->game_name;
            $data['game_p'] = $game->game_pass;
            $data['game_tm'] = $game->game_team;
            $data['game_tn'] = $game->game_turn;
            $data['game_cr'] = $game->game_credit;
            $data['game_invc'] = $game->game_inv_cost;
            $data['game_exinvc'] = $game->game_ex_inv_cost;
            $data['game_blc'] = $game->game_back_cost;
            $data['game_invcap'] = $game->game_init_inv_cap;
            $data['game_invlev'] = $game->game_init_inv_lvl;
            $data['game_lt'] = $game->game_lt;
            $data['game_ltlev'] = $game->game_intransit_lvl;
            
            $this->db->select('*');
            $this->db->from('shop');
            $this->db->where('avail_item.username',$this->session->userdata('username'));
            $this->db->join('avail_item','shop.good_id=avail_item.good_id');
            $data['items'] = $this->db->get()->result();

            $data['title'] = "Setting Summary";
            $this->load->view('AdminPages/SettingSummary', $data);
         }

    public function resetting() {

        redirect('admin/newgamecustom');
    }

    public function startgame() {

        $this->load->model('startgame');
        $this->startgame->start_parameter();

        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        redirect('admin/dashboard');
    }

    public function dashboard() {
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $gamename = $this->status_check_model->current_gamename();
        $this->db->where('game_name',$gamename);
        $data['p_login'] = $this->db->get('game')->result()[0]->login_permit;
        $this->load->model('status_check_model');
        $data['availability']=$this->status_check_model->check();
        $data['title'] = "Game on Progress - Dashboard";
        $this->db->where('game_name',$gamename);
        $results = $this->db->get('game')->result()[0];
        $game_mode = $results->mode;
        if($game_mode==="auto"){
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
            $this->db->where('game_name',$gamename);
            $data['team_sum'] = $this->db->get('team')->result();
            $this->db->where('game_name',$gamename);
            $data['demands'] = $this->db->get('preset_demand')->result();
            $this->load->model('readystate');
            $data['next_btn_avail'] = $this->readystate->check_status($gamename);
            $this->load->view('Etc/AdminHeader', $data);
            $this->load->view('AdminPages/GameDashboardAT',$data);
            $this->load->view('Etc/Footer');
        }
        else if($game_mode==="manual"){
            $this->load->view('Etc/AdminHeader', $data);
            $this->load->view('AdminPages/GameDashboardMT', $data);
            $this->load->view('Etc/Footer');

        }
        
    }
    
    public function savesetting(){
        
        $this->db->where('game_name',$this->input->post('game_name'));
        $query = $this->db->get('new_game_temp')->result();
               
        $save_name = $this->input->post('save_name');
        $data = array(
            'setting_name'=>$save_name,
            'game_name'=>$query[0]->game_name,
            'game_pass'=>$query[0]->game_pass,
            'game_turn'=>$query[0]->game_turn,
            'game_credit'=>$query[0]->game_credit,
            'game_lt'=>$query[0]->game_lt,
            'game_inv_cost'=>$query[0]->game_inv_cost,
            'game_ex_inv_cost'=>$query[0]->game_ex_inv_cost,
            'game_back_cost'=>$query[0]->game_back_cost,
            'game_init_inv_cap'=>$query[0]->game_init_inv_cap,
            'game_init_inv_lvl'=>$query[0]->game_init_inv_lvl,
            'game_intransit_lvl'=>$query[0]->game_intransit_lvl
        );
        
        $this->db->insert('saved_settings',$data);
    }

    //SETTING FOR PRESET DEMAND MODE

    public function setting_validationP(){
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $data['availability']=$this->status_check_model->check();
        //FORM VALIDATION
        $this->load->library('form_validation');
        $this->form_validation->set_rules('g_name', 'Game Name', 'required');
        $this->form_validation->set_rules('g_pass', 'Password', 'required');
        $this->form_validation->set_rules('g_teams', 'Number of Teams', 'required');
        $this->form_validation->set_rules('g_turn', 'Number of Turns', 'required');
        $this->form_validation->set_rules('g_credit', 'Starting Credit', 'required');
        $this->form_validation->set_rules('g_leadtime', 'Lead Time', 'required');
        $this->form_validation->set_rules('g_invcost', 'Inventory Cost', 'required');
        $this->form_validation->set_rules('g_excost', 'Excessive Inventory Cost', 'required');
        $this->form_validation->set_rules('g_bcost', 'Backlog Cost', 'required');
        $this->form_validation->set_rules('g_invcap', 'Inventory Capacity', 'required');
        $this->form_validation->set_rules('g_onhand', 'On-hand Inventory', 'required');
        $this->form_validation->set_rules('g_intransit', 'Intransit Inventory', 'required');

        if ($this->form_validation->run() == TRUE) {

            $data['g_name'] = $this->input->post('g_name');
            $data['g_pass'] = $this->input->post('g_pass');
            $data['g_teams'] = $this->input->post('g_teams');
            $data['g_turn'] = $this->input->post('g_turn');
            $data['g_credit'] = $this->input->post('g_credit');
            $data['g_diff'] = $this->input->post('g_diff');
            $data['g_leadtime'] = $this->input->post('g_leadtime');
            $data['g_invcost'] = $this->input->post('g_invcost');
            $data['g_excost'] = $this->input->post('g_excost');
            $data['g_bcost'] = $this->input->post('g_bcost');
            $data['g_invcap'] = $this->input->post('g_invcap');
            $data['g_onhand'] = $this->input->post('g_onhand');
            $data['g_intransit'] = $this->input->post('g_intransit');

            $this->db->where('username', $this->session->userdata('username'));
            $data['fac_name'] = $this->db->get('users')->result()[0]->name;

            $data['G1'] = $this->input->post('availabilityG1');
            $data['G2'] = $this->input->post('availabilityG2');
            $data['G3'] = $this->input->post('availabilityG3');

            $this->db->where('username', $this->session->userdata('username'));
            $data['demands'] = $this->db->get('preset_demand_temp')->result();

            $data['title']="Game Setting Summary";
            $this->load->view('AdminPages/settingP_summary',$data);
            }
        else{


            }
        
    }

    public function resetP(){
        redirect('admin/newgamepreset');
    }

    public function startgameP(){
        $this->load->model('startgame_auto');
        $this->startgame_auto->start_parameter();

        redirect('admin/dashboard');
    }

    public function end_statistics(){
        $this->load->model('status_check_model');
        $this->status_check_model->check_login();
        $gamename = $this->status_check_model->current_gamename();
        $data['availability']=$this->status_check_model->check();

        $this->db->where('game_name', $gamename);
        $this->db->where('player_role',"retailer");
        $this->db->select_min('total_cost');
        $min_retailer = $this->db->get('player')->result()[0]->total_cost;

        $this->db->where('game_name', $gamename);
        $this->db->where('player_role',"wholesaler");
        $this->db->select_min('total_cost');
        $min_wholesaler = $this->db->get('player')->result()[0]->total_cost;

        $this->db->where('game_name', $gamename);
        $this->db->where('player_role',"distributor");
        $this->db->select_min('total_cost');
        $min_distributor = $this->db->get('player')->result()[0]->total_cost;

        $this->db->where('game_name', $gamename);
        $this->db->where('player_role',"manufacturer");
        $this->db->select_min('total_cost');
        $min_manufacturer = $this->db->get('player')->result()[0]->total_cost;

        $this->db->where('player_role', "Retailer");
        $this->db->where('total_cost', $min_retailer);
        $this->db->where('game_name', $gamename);
        $retailer = $this->db->get('player')->result();
        $data['best_ret'] = $retailer;
        $data['best_retailer_cost'] = $retailer[0]->total_cost;

        $this->db->where('player_role', "Wholesaler");
        $this->db->where('total_cost', $min_wholesaler);
        $this->db->where('game_name', $gamename);
        $wholesaler = $this->db->get('player')->result();
        $data['best_who'] = $wholesaler;
        $data['best_wholesaler_cost'] = $wholesaler[0]->total_cost;


        $this->db->where('player_role', "Distributor");
        $this->db->where('total_cost', $min_distributor);
        $this->db->where('game_name', $gamename);
        $distributor = $this->db->get('player')->result();
        $data['best_dis'] = $distributor;
        $data['best_distributor_cost'] = $distributor[0]->total_cost;;

        $this->db->where('player_role', "Manufacturer");
        $this->db->where('total_cost', $min_manufacturer);
        $this->db->where('game_name', $gamename);
        $manufacturer = $this->db->get('player')->result();
        $data['best_man'] = $manufacturer;
        $data['best_manufacturer_cost'] = $manufacturer[0]->total_cost;

        $this->db->where('game_name',$gamename);
        $data['team_sum'] = $this->db->get('team')->result();
        
        $this->db->order_by('total_cost','asc');
        $this->db->where('game_name',$gamename);
        $data['teams'] = $this->db->get('team')->result();
        
        $data['gamename'] = $gamename;
        $data['title']="End Game Statistics";
        $this->load->view('Etc/AdminHeader', $data);
        $this->load->view('AdminPages/EndGame', $data);
        $this->load->view('Etc/Footer');

    }

}

?>
