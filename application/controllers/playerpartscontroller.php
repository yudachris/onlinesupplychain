<?php
class Playerpartscontroller extends CI_Controller{
    
    public function session_selection(){

        $data['game']=$this->db->get('game')->result();
        $this->load->view('PlayerParts/session_selections',$data);
    }

    public function player_login(){
        $this->load->view('PlayerParts/player_login');
    }

    public function waiting_retailer(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id',$this->session->userdata('team'). "-Retailer");
        $query = $this->db->get('player')->result()[0]->login;
        
        if($query === 'yes'){
            $this->load->view('PlayerParts/wait_ready');
        }
        else{
            $this->load->view('PlayerParts/wait_not_ready');
        }
        
        
    }

    public function workspace(){
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $phase = $this->db->get('player')->result()[0]->status;
        if($phase == "order"){
            $this->load->view('PlayerParts/order_form');
        }
        else if($phase == "deliver"){
            $this->load->view('PlayerParts/delivery_form');
        }
        else{
            $this->load->view('PlayerParts/standby_form');
        }
    }

    public function intransits(){
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $this->db->from('shipping_delay');
        $data['length'] = $this->db->count_all_results();
        
        $this->db->order_by('delay_num','desc');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $data['intransit'] = $this->db->get('shipping_delay')->result();

        $this->db->where('game_name', $gamename);
        $data['current_turn'] = $this->db->get('game')->result()[0]->current_turn;

        $this->load->view('PlayerParts/intransits',$data);
    }

    public function backlog_panel(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name', $gamename);
        $this->db->where('player_id', $playerid);
        $data['backlog'] = $this->db->get('player')->result()[0]->current_backlog;
        $this->load->view('PlayerParts/backlog_panel',$data);
    }
    
    public function waiting_wholesaler(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id',$this->session->userdata('team'). "-Wholesaler");
        $query = $this->db->get('player')->result()[0]->login;
        
        if($query === 'yes'){
            $this->load->view('PlayerParts/wait_ready');
        }
        else{
            $this->load->view('PlayerParts/wait_not_ready');
        }
        
    }
  

    public function waiting_distributor(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id',$this->session->userdata('team'). "-Distributor");
        $query = $this->db->get('player')->result()[0]->login;
        
        if($query === 'yes'){
            $this->load->view('PlayerParts/wait_ready');
        }
        else{
            $this->load->view('PlayerParts/wait_not_ready');
        }
    }
    
    public function waiting_manufacturer(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id',$this->session->userdata('team'). "-Manufacturer");
        $query = $this->db->get('player')->result()[0]->login;
        
        if($query === 'yes'){
            $this->load->view('PlayerParts/wait_ready');
        }
        else{
            $this->load->view('PlayerParts/wait_not_ready');
        }
    }
    
    public function waiting_start(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_team',$this->session->userdata('team'));
        $this->db->where('login','yes');
        $this->db->from('player');
        
        if($this->db->count_all_results() == 4){
            $data['status']="ok";
        }
        else{
            $data['status']="no";
        }
        
        $this->load->view('PlayerParts/start_button',$data);
    }

    public function player_statistics_summary(){
        $this->load->model('playerdata');
        $this->playerdata->getStat_summary();
        $this->load->view('PlayerParts/statistics_summary');
    }

    public function incoming_demand(){
        $gamename =  $this->session->userdata('gamename');
        $team = $this->session->userdata('team');
        $role = $this->session->userdata('role');
        $team_con = $this->session->userdata('username');      
        $this->load->model('game_dynamics');        
        $data['new_demand'] = $this->game_dynamics->new_demand($team, $role,$team_con,$gamename);
        $this->load->view('PlayerParts/incoming_demand',$data);

    }

    public function cost_panel(){

        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');

        $this->db->where('game_name',$gamename);
        $data['cost_rule'] = $this->db->get('cost')->result()[0];

        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $data['cost'] = $this->db->get('player')->result()[0];   

        $this->load->view('PlayerParts/cost_panel',$data);
    }

    public function cost_detail(){
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');

        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $data['cost'] = $this->db->get('player')->result()[0];   

        $this->load->view('PlayerParts/cost_details',$data);
    }

    public function phase(){

        $gamename = $this->session->userdata('gamename');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$this->session->userdata('username'));
        $data['phase_name'] = $this->db->get('player')->result()[0]->status;
        $this->load->view('PlayerParts/phase_panel',$data);
    }

    public function week_count(){

        $this->db->where('game_name', $this->session->userdata('gamename'));
        $data['maxweek'] = $this->db->get('game')->result()[0]->end_turn;
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $data['weekcount'] = $this->db->get('game')->result()[0]->current_turn;
        $this->load->view('PlayerParts/weekpanel',$data);

    }

    public function onhand_inventory(){
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id', $this->session->userdata('username'));
        $data['max_inv'] = $this->db->get('player')->result()[0]->inventory_cap;
        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id', $this->session->userdata('username'));
        $data['current_inv'] = $this->db->get('player')->result()[0]->current_inventory;

        $this->db->where('game_name', $this->session->userdata('gamename'));
        $this->db->where('player_id', $this->session->userdata('username'));
        $data['excess'] = $this->db->get('player')->result()[0]->excess_inventory;
        $this->load->view('PlayerParts/on-hand_inventory',$data);
    }

    public function order_form(){

        $gamename = $this->session->userdata('gamename');
        $username = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$username);
        $phase = $this->db->get('player')->result()[0]->status;

        $this->db->where('game_name', $gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;

        if($current_turn == 1){
            $avail = "ok";
        }
        else{
            $this->db->where('game_name', $gamename);
            $this->db->where('from', $username);
            $this->db->where('status', "new");
            $turn_count = $this->db->get('demand')->result()[0]->turn_count;
            if($turn_count == $current_turn){
                $avail = "no";
            }
            else{
                $avail = "ok";
            }
        }

        if($phase === "order" && $avail === "ok"){
            $data['status'] = "ok";
        }
        else{
            $data['status'] = "no";
        }
       
        $this->load->view('PlayerParts/form_order',$data);

    }

    public function transits_bgn(){
        $gamename = $this->session->userdata('gamename');
        $player_id = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $this->db->from('shipping_delay');
        $data['length'] = $this->db->count_all_results();
        
        $this->db->order_by('delay_num','desc');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$player_id);
        $data['intransit'] = $this->db->get('shipping_delay')->result();

        $this->db->where('game_name', $gamename);
        $data['current_turn'] = $this->db->get('game')->result()[0]->current_turn;
        $this->load->view('PlayerParts/transits_bgn',$data);
    }

    public function deliver_form(){

        $gamename = $this->session->userdata('gamename');
        $username = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$username);
        $phase = $this->db->get('player')->result()[0]->status;

        $role = $this->session->userdata('role');
        $team = $this->session->userdata('team');
        $this->load->model('game_dynamics');
        $delivery_status = $this->game_dynamics->max_delivery($gamename, $username,$role,$team);
        if($delivery_status === "nodemand"){
            $data['max_deliver'] = 0;
            $existence = "no";
        }
        else{
            $data['max_deliver'] = $delivery_status;
            $existence = "ok";
        }

        $this->db->where('game_name', $gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;

        if($current_turn == 1){
            $avail = "ok";
        }
        else{
            $this->db->where('from', $username);
            $this->db->where('status', "new");
            $turn_count = $this->db->get('supply')->result()[0]->turn_count;
            if($turn_count == $current_turn){
                $avail = "no";
            }
            else{
                $avail = "ok";
            }
        }
        if($phase != "deliver"){
            $data['status'] = "no";
        }
        else if($existence === "no"){
            $data['status'] = "yet";
        }
        else if($phase === "deliver" && $avail === "ok"){
            $data['status'] = "ok";
        }
        else{
            $data['status'] = "no";
        }
        $this->db->where('game_name',$gamename);
        $data['diff'] = $this->db->get('game')->result()[0]->difficulty;
        $this->load->view('PlayerParts/form_deliver',$data);
    }


    public function inventory_expansion_frm(){

        $gamename = $this->session->userdata('gamename');
        $team = $this->session->userdata('team');

        $this->db->where('game_name', $gamename);
        $this->db->where('team_code', $team);
        $credit = $this->db->get('team')->result()[0]->team_credit;

        $this->db->where('game_name',$gamename);
        $facilitator = $this->db->get('game')->result()[0]->made_by;

        $this->db->where('name', $facilitator);
        $f_username = $this->db->get('users')->result()[0]->username;
        
        $this->db->where('username', $f_username);
        $this->db->where('good_id', "G2");
        $price = $this->db->get('avail_item')->result()[0]->price;

        $data['max'] = floor($credit/$price);

        $this->db->where('player_team', $team);
        $this->db->where('game_name', $gamename);
        $data['members'] = $this->db->get('player')->result();

        $this->load->view('PlayerParts/inv_expansion',$data);
    }

    public function spability_frm(){
        $gamename = $this->session->userdata('gamename');
        $team = $this->session->userdata('team');

        $this->db->where('game_name', $gamename);
        $this->db->where('team_code', $team);
        $current_credit = $this->db->get('team')->result()[0]->team_credit;

        $this->db->where('game_name',$gamename);
        $facilitator = $this->db->get('game')->result()[0]->made_by;

        $this->db->where('name', $facilitator);
        $f_username = $this->db->get('users')->result()[0]->username;
        
        $this->db->where('username', $f_username);
        $this->db->where('good_id', "G3");
        $price = $this->db->get('avail_item')->result()[0]->price;

        if($current_credit >= $price){
            $data['status'] = "ok";
        }
        else{
            $data['status'] = "no";
        }

        $this->db->where('spability', 'no');
        $this->db->where('game_name', $gamename);
        $this->db->where('player_team', $team);
        $data['members'] = $this->db->get('player')->result();

        $this->load->view('PlayerParts/sp_ability_form', $data);
    }

    public function lt_decrease_frm(){
        $gamename = $this->session->userdata('gamename');
        $team = $this->session->userdata('team');

        $this->db->where('player_team', $team);
        $this->db->where('game_name', $gamename);
        $data['members'] = $this->db->get('player')->result();

        $this->load->view('PlayerParts/leadtime_dec', $data);
    }

    public function lt_decrease_input(){
        $gamename = $this->session->userdata('gamename');
        $team = $this->session->userdata('team');
        $player_id = $this->input->post('player_id');
        $this->db->where('player_id', $player_id);
        $this->db->where('game_name', $gamename);
        $lt = $this->db->get('player')->result()[0]->leadtime;
        $maxdec = $lt-1;

            $this->db->where('game_name',$gamename);
            $facilitator = $this->db->get('game')->result()[0]->made_by;

            $this->db->where('name', $facilitator);
            $f_username = $this->db->get('users')->result()[0]->username;

            $this->db->where('username', $f_username);
            $this->db->where('good_id', "G1");
            $price = $this->db->get('avail_item')->result()[0]->price;

            $this->db->where('team_code', $team);
            $this->db->where('game_name', $gamename);
            $current_credit = $this->db->get('team')->result()[0]->team_credit;

            $maxdec2 = floor($current_credit/$price);
        if($maxdec<$maxdec2){
            $data['max'] = $maxdec;
        }
        else if($maxdec2<$maxdec){
            $data['max'] = $maxdec2;
        }
        else if($maxdec==$maxdec2){
            $data['max'] = $maxdec;

        }
        
        $this->load->view('PlayerParts/leadtime_input',$data);
    }

    public function deliveryhistory(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('from',$playerid);
        $data['history'] = $this->db->get('supply')->result();
        $this->load->view('PlayerParts/deliveryhistory',$data);
    }

    public function orderhistory(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('from',$playerid);
        $data['history'] = $this->db->get('demand')->result();
        $this->load->view('PlayerParts/orderhistory',$data);
    }

    public function backloghistory(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$playerid);
        $data['history'] = $this->db->get('backlogs')->result();
        $this->load->view('PlayerParts/backloghistory',$data);
    }

    public function costChart(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$playerid);
        $data['statistics'] = $this->db->get('statistics')->result();
        $this->load->view('PlayerParts/chart_cost', $data);
    }

    public function inventoryChart(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$playerid);
        $data['statistics'] = $this->db->get('statistics')->result();
        $this->load->view('PlayerParts/chart_inventory', $data);
    }

    public function supdemChart(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$playerid);
        $data['statistics'] = $this->db->get('statistics')->result();
        $this->load->view('PlayerParts/chart_supdem', $data);
    }

    public function posted_order(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');

        $this->db->where('game_name', $gamename);
        $this_week = $this->db->get('game')->result()[0]->current_turn;
        $data['weekcount'] = $this_week;

        $this->db->where('from', $playerid);
        $this->db->where('game_name', $gamename);
        $this->db->where('status', "new");
        $this->db->where('turn_count', $this_week);
        $orders = $this->db->get('demand')->result();
        if($orders == null){
            $data['pst_ord'] = "nodata";
        }
        else{
            $data['pst_ord'] = $orders[0]->amount;
        }
        $this->load->view('PlayerParts/posted_ord', $data);
    }

    public function posted_deliver(){
        $gamename = $this->session->userdata('gamename');
        $playerid = $this->session->userdata('username');

        $this->db->where('game_name', $gamename);
        $this_week = $this->db->get('game')->result()[0]->current_turn;
        $data['weekcount'] = $this_week;

        $this->db->where('from', $playerid);
        $this->db->where('game_name', $gamename);
        $this->db->where('status', "new");
        $this->db->where('turn_count', $this_week);
        $delivers = $this->db->get('supply')->result();
        if($delivers == null){
            $data['pst_dlv'] = "nodata";
        }
        else{
            $data['pst_dlv'] = $delivers[0]->amount;
        }
        $this->load->view('PlayerParts/posted_dlv', $data);
    }

    public function incoming_supply(){

        $gamename = $this->session->userdata('gamename');
        $this->db->where('game_name',$gamename);
        $this->db->where('player_id',$this->session->userdata('username'));
        $data['intransit'] = $this->db->get('shipping_delay')->result();
        $this->load->view('PlayerParts/incoming_supply', $data);
    }
}
?>
