<?php
class Statistic_update extends CI_Model{

	public function update_statistics($gamename){
		// STATISTICS DATA INSERTION
        
        $this->db->where('game_name',$gamename);
		$turn_count = $this->get('game')->result()[0]->current_turn;

		$this->db->where('game_name',$gamename);
		$this->db->from('team');
		$g_team = $this->db->count_all_results();

        for($st=1;$st<=$g_team;$st++){

            for($sr=1;$sr<=4;$sr++){

                $teamconv = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
                $roles = array(
                1 => 'Retailer',
                2 => 'Wholesaler',
                3 => 'Distributor',
                4 => 'Manufacturer');

                $player_id = $teamconv[$st]."-".$roles[$sr];

                $begin_stat = array(
                    'game_name'=>$g_name,
                    'turn_count'=>$turn_count,
                    'player_id'=>$player_id,
                    'player_team'=>$teamconv[$st],
                    'current_backlog',
                    'current_backlog_cost',
                    'current_inventory',
                    'current_excess_inventory',
                    'current_inventory_cost',
                    'current_excess_inv_cost',
                    'current_demand',
                    );

            }            

        }
        // END OF STATISTICS DATA INSERTION
	}

}

?>