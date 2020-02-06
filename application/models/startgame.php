<?php

class Startgame extends CI_Model {

    public function start_parameter() { 
        
        $g_name = $this->input->post('g_name');
        $g_pass = $this->input->post('g_pass');
        $g_teams = $this->input->post('g_teams');
        $g_turn = $this->input->post('g_turn');
        $g_credit = $this->input->post('g_credit');
        $g_leadtime = $this->input->post('g_leadtime');
        $g_invcost = $this->input->post('g_invcost');
        $g_excost = $this->input->post('g_excost');
        $g_bcost = $this->input->post('g_bcost');
        $g_invcap = $this->input->post('g_invcap');
        $g_onhand = $this->input->post('g_onhand');
        $g_intransit = $this->input->post('g_intransit');
        

        $this->db->where('username', $this->session->userdata('username'));
        $maker = $this->db->get('users')->result()[0]->name;

//        GAME MASTER DATA INSERTION
        $masterdata = array(
            'game_name'=>$g_name,
            'current_turn'=>1,
            'end_turn'=>$g_turn,
            'login_permit'=>'restrict',
            'made_by'=>$maker,
            'mode' => "manual"
        );
        $this->db->insert('game',$masterdata);
        
//          COST MASTER DATA INSERTION
        $costdata = array(
            'game_name' =>$g_name,
            'inventory_cost' => $g_invcost,
            'excess_cost' => $g_excost,
            'backlog_cost' => $g_bcost);
        $this->db->insert('cost',$costdata);

//        PLAYER TABLE INSERTION
        for ($x = 1; $x <= $g_teams; $x++) {

            //NUMBER TO ALPHABETH CONVERSION
            $teamconv = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
            //END OF NUMBER TO ALPHABETH CONVERSION
            //MEMBER ROLE
            $roles = array(
                1 => 'Retailer',
                2 => 'Wholesaler',
                3 => 'Distributor',
                4 => 'Manufacturer'
            );
            //END OF MEMBER ROLE

            $p_team = $teamconv[$x];
            
//            TEAM MASTER DATA INSERTION
            
            $teamdata = array(
                'team_code'=>$p_team,
                'game_name'=>$g_name,
                'total_cost'=>0,
                'team_credit'=>$g_credit,
                'status'=>'not ready',
                'setting'=>'not set'
            );
            $this->db->insert('team', $teamdata);
            
//                END OF TEAM MASTER DATA INSERTION
//                PLAYER DATA INSERTION
            for ($y = 1; $y <= 4; $y++) {

                $p_id = $p_team . '-' . $roles[$y];
                $data = array(
                    'game_name' => $g_name,
                    'player_id' => $p_id,
                    'player_pass' => md5($g_pass),
                    'player_team' => $p_team,
                    'player_role' => $roles[$y],
                    'inventory_cap' => $g_invcap,
                    'current_inventory'=>$g_onhand,
                    'excess_inventory'=>0,
                    'current_backlog'=>0,
                    'accum_inv' => 0,
                    'accum_ex' => 0,
                    'accum_back' => 0,
                    'total_cost' => 0,
                    'login' => "no",
                    'status' => "order",
                    'leadtime' => $g_leadtime,
                    'spability' =>"no"
                );
                $this->db->insert('player', $data);
            }
        }
        //  END OF PLAYER DATA INSERTION

//        LEAD TIME TABLE INSERTION
        $this->db->where('game_name', $g_name);
        $this->db->from('player');
        $num = $this->db->count_all_results();      
        
        for($var=0;$var<$num;$var++){
            
            $this->db->select('player_id');
            $this->db->where('game_name',$g_name);
            $query = $this->db->get('player');
            $player_names = $query->result();
            $player_id = $player_names[$var]->player_id;
            
            for($var2=1;$var2<=$g_leadtime;$var2++){
               
                $datadelay= array(
                    'game_name'=>$g_name,
                    'player_id'=>$player_id,
                    'delay_num'=>$var2,
                    'amount'=>$g_intransit
                );
                $this->db->insert('shipping_delay',$datadelay);
           }
        }
        
        // INSERT CUSTOMER INTO PLAYER TABLE
        $data_cust = array(
                    'game_name' => $g_name,
                    'player_id' => "customer",
                    'player_pass' => "X",
                    'player_team' => "X",
                    'player_role' => "X",
                    'inventory_cap' => 0,
                    'current_inventory'=>0,
                    'excess_inventory'=>0,
                    'current_backlog'=>0,
                    'accum_inv' => 0,
                    'accum_ex' => 0,
                    'accum_back' => 0,
                    'total_cost' => 0,
                    'login' => "yes",
                    'status' => "standby",
                    'leadtime' => 0,
                    'spability' =>"no"
                    );
        $this->db->insert('player',$data_cust);
        // END OF INSERT CUSTOMER
        
        //UPDATE AVAILABILITY
        $G1 = $this->input->post('G1');
        $G2 = $this->input->post('G2');
        $username = $this->session->userdata('username');
        
        $updates1 = array('availability' => $G1);
        $updates2 = array('availability' => $G2);
        $updates3 = array('availability' => "Unavailable");
        
        $this->db->where('good_id', "G1");
        $this->db->where('username', $username);
        $this->db->update('avail_item', $updates1);

        $this->db->where('good_id', "G2");
        $this->db->where('username', $username);
        $this->db->update('avail_item', $updates2);
        
        $this->db->where('good_id', "G3");
        $this->db->where('username', $username);
        $this->db->update('avail_item', $updates3);
    }

}

?>
