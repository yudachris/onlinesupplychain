<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    

    public function index() {
        $this->home();
    }

    public function home() {
        if($this->session->userdata('is_logged_in') == 1){
            $this->db->where('game_name', $this->session->userdata('gamename'));
            $this->db->where('player_id', $this->session->userdata('username'));
            $log_stat = $this->db->get('player')->result()[0]->login;
            if($log_stat === 'set'){
                redirect('player/setting_page');
            }
            else{
                redirect('player/waitingroom');
            }
        }
        else if($this->session->userdata('is_logged_in') == 2){
            redirect('admin/adminhome');
        }
        else{
            $data['title'] = "Home";
            $this->load->view('Etc/Header', $data);
            $this->load->view('StaticPages/Home');
            $this->load->view('Etc/Footer');
        }
        
    }


    public function admin_login() {
        $data['title'] = "Administrator Login";
        $this->load->view('etc/Header', $data);
        $this->load->view('AdminPages/AdminLogin');
    }

    public function login_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_validate_credentials');

        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if ($this->form_validation->run()) {
            $this->db->where('username', $this->input->post('username'));
            $fullname = $this->db->get('users')->result()[0]->name;
            $data = array(
                'username' => $this->input->post('username'),
                'name' => $fullname,
                'status'=>'administrator',
                'is_logged_in' => 2
            );
            $this->session->set_userdata($data);
            redirect('admin/adminhome');
        }
        else {

            $data['title'] = "Administrator Login";
            $this->load->view('etc/Header', $data);
            $this->load->view('AdminPages/AdminLogin');
            
        }
    }

    public function validate_credentials() {
        $this->load->model('model_users');

        if ($this->model_users->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('main/home');
    }

    public function player_logout() {

        $logout_data = array(
            'login' => 'no'
        );
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id',$this->session->userdata('username'));
        $this->db->update('player', $logout_data);
        $this->session->sess_destroy();
        redirect('main/selectgamesession');
    }

    public function selectgamesession(){
        $data['title']="Select Game Session";
        $this->load->view('PlayerPages/selectgame',$data);
    }

    public function player_login() {
        $this->db->where('game_name', $this->input->post('gamename'));
        $this->db->group_by('player_team');
        $query = $this->db->get('player');
        $data['team_list'] = $query->result();        
        $data['title'] = "Player Login";
        $data['gamename'] = $this->input->post('gamename');
        $this->load->view('PlayerParts/player_login', $data);
        
    }

    public function login_validation_p() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('team_name', 'Team Name', 'required|trim|callback_validate_credentials2');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        $username_concate = $this->input->post('team_name') . "-" . $this->input->post('role');
        if ($this->form_validation->run()) {

            $data = array(
                'team'=>$this->input->post('team_name'),
                'role'=>$this->input->post('role'),
                'username' => $username_concate,
                'gamename'=> $this->input->post('gamename'), 
                'status'=>"player",
                'is_logged_in' => 1
            );
            if($this->input->post('role') === "Retailer"){
                $this->session->set_userdata($data);
                $this->db->where('team_code', $this->session->userdata('team'));
                $this->db->where('game_name', $this->session->userdata('gamename'));
                $setting_stat = $this->db->get('team')->result()[0]->setting;
                if($setting_stat === "set"){
                $statuschange = array(
                    'login' => 'yes'
                    );
                    $this->db->where('game_name', $this->session->userdata('gamename'));
                    $this->db->where('player_id', $this->session->userdata('username'));
                    $this->db->update('player', $statuschange);
                redirect('player/waitingroom');
                }
                else{
                redirect('player/setting_page');
                }
            }
            else{
                $this->session->set_userdata($data);
                redirect('player/waitingroom');
            }
        } 
        else {
            $data['title']="Select Game Session";
            $this->load->view('PlayerPages/selectgame',$data);
        }
    }
   
    

    public function validate_credentials2() {
        $this->load->model('model_users');
        $gamename = ($this->input->post('gamename'));
        
        if ($this->model_users->can_log_in_p($gamename)==='ok') {
            return true;
        }
        else if($this->model_users->can_log_in_p($gamename)=== 'restrict'){
            $this->form_validation->set_message('validate_credentials2', 'Login is restricted by Game Administrator');
            return false;
        }
        else if($this->model_users->can_log_in_p($gamename)=== 'already'){
            $this->form_validation->set_message('validate_credentials2', 'This ID is already logged in to the system. If you have any problem with login, please contact your facilitator.');
            return false;
        }
        else {
            $this->form_validation->set_message('validate_credentials2', 'Incorrect Team Name & Role/password.');
            return false;
        }
    }

    public function about_developer(){

        $data['title']='About the Developer';
        $this->load->view('etc/Header', $data);
        $this->load->view('StaticPages/About',$data);
        $this->load->view('etc/Footer');
    }

}

