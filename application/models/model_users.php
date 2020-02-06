<?php


class Model_users extends CI_Model {

    public function can_log_in() {

        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('users');
        $query->result();


        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function can_log_in_p($gamename) {
        
        $this->db->where('game_name', $gamename);
        $login_permit = $this->db->get('game')->result();
        
        if($login_permit[0]->login_permit == 'allow') {
            
            $play_id = $this->input->post('team_name') . '-' . $this->input->post('role');
            $play_pass = md5($this->input->post('password'));

            $this->db->where('game_name', $gamename);
            $this->db->where('player_id', $play_id);
            $this->db->where('player_pass', md5($this->input->post('password')));          
            $query = $this->db->get('player');
            $query->result();

            $this->db->where('game_name', $gamename);
            $this->db->where('player_id', $play_id);
            $query2 = $this->db->get('player');
            $status = $query2->result();

            if($query->num_rows() == 1 && $status[0]->login === 'yes'){
                $statuslogin = 'already';
                return $statuslogin;
            }
            else if ($query->num_rows() == 1 && $status[0]->login === 'no') {

                if($this->input->post('role')==="Retailer"){
                    $statuschange = array(
                    'login' => 'set'
                    );
                    $this->db->where('game_name',$gamename);
                    $this->db->where('player_id', $play_id);
                    $this->db->update('player', $statuschange);
                    $statuslogin='ok';
                    return $statuslogin;
                }
                else{
                    $statuschange = array(
                    'login' => 'yes'
                );
                $this->db->where('game_name',$gamename);
                $this->db->where('player_id', $play_id);
                $this->db->update('player', $statuschange);
                $statuslogin='ok';
                return $statuslogin;    
                }

            }
            else if ($query->num_rows() == 1 && $status[0]->login == 'set') {

                if($this->input->post('role')==="Retailer"){
                    $statuschange = array(
                    'login' => 'set'
                    );
                    $this->db->where('game_name',$gamename);
                    $this->db->where('player_id', $play_id);
                    $this->db->update('player', $statuschange);
                    $statuslogin='ok';
                    return $statuslogin;
                }
                else{
                    $statuschange = array(
                    'login' => 'yes'
                );
                $this->db->where('game_name',$gamename);
                $this->db->where('player_id', $play_id);
                $this->db->update('player', $statuschange);
                $statuslogin='ok';
                return $statuslogin;    
                }

            }  
            else {
                return "CANNOT LOGIN";
            }
        } else {
            $statuslogin = 'restrict';
            return $statuslogin;
        }
    }

}

?>
