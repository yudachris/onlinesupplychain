<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_movement extends CI_Model{


	public function admin_movement($gamename){

		
		$this->db->where("game_name", $gamename);
		$this->db->from("team");
		$team_length = $this->db->count_all_results();
		

		for($x=1;$x<=$team_length;$x++){
			$team = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
			$this_team = $team[$x];
			
			for($y=1;$y<=4;$y++){
				$role = array(
					1 => 'Retailer',
                	2 => 'Wholesaler',
                	3 => 'Distributor',
                	4 => 'Manufacturer');
				$this_role = $role[$y];

				
				$player_id = $this_team."-".$this_role;
				
			//MAGIC STARTS HERE!

		$this->db->where('player_id', $player_id);
		$this->db->where('game_name', $gamename);
		$this->db->from('shipping_delay');
		$total_lead_time = $this->db->count_all_results();
		$current = array();
		
		for($z=1; $z<=$total_lead_time;$z++){
			$this->db->where('player_id', $player_id);
			$this->db->where('game_name', $gamename);
			$hasil = $this->db->get('shipping_delay')->result()[$total_lead_time-$z]->amount;
			array_push($current, $hasil);
		}
		
		for($z=0; $z<$total_lead_time;$z++){
			
			if($total_lead_time == 1){
				//PART 1
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$current_inventory = $this->db->get('player')->result()[0]->current_inventory;
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$inventory_cap = $this->db->get('player')->result()[0]->inventory_cap;
				$now = $current_inventory+$current[$z];
				if($now > $inventory_cap){
					$excess = $now-$inventory_cap;
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$current_excess = $this->db->get('player')->result()[0]->excess_inventory;
					$excess_now = $current_excess+$excess;
					$now = $inventory_cap;
					$data=array(
						'current_inventory'=> $now,
						'excess_inventory'=> $excess_now);
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$this->db->update('player', $data);
				}
				else{
					$data= array(
					'current_inventory' => $now);
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$this->db->update('player', $data);
				}
				//PART 2
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $total_lead_time-$z);
				$current_delay = $this->db->get('shipping_delay')->result()[0]->amount;
				
				$now = $current_delay;
				$zs = $z-1;
				$now_index = $total_lead_time-$zs;
				
				$data= array(
					'amount' => $now);
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $now_index);
				$this->db->update('shipping_delay', $data);

				if($role[$y] === "Manufacturer"){
					$supplier = $this_team."-"."Resource";
				}
				else{
					$supplier = $this_team."-".$role[$y+1];
				}
				
				$this->db->where("game_name",$gamename);
				$this->db->where("from", $supplier);
				$this->db->where("status", "new");
				$new_amount = $this->db->get('supply')->result()[0]->amount;

				$data= array(
					'amount' => $new_amount);
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $total_lead_time-$z);
				$this->db->update('shipping_delay', $data);
			}
			else if($z==0){
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$current_inventory = $this->db->get('player')->result()[0]->current_inventory;
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$inventory_cap = $this->db->get('player')->result()[0]->inventory_cap;
				$now = $current_inventory+$current[$z];
				if($now > $inventory_cap){
					$excess = $now-$inventory_cap;
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$current_excess = $this->db->get('player')->result()[0]->excess_inventory;
					$excess_now = $current_excess+$excess;
					$now = $inventory_cap;
					$data=array(
						'current_inventory'=> $now,
						'excess_inventory'=> $excess_now);
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$this->db->update('player', $data);
				}
				else{
					$data= array(
					'current_inventory' => $now);
					$this->db->where('player_id', $player_id);
					$this->db->where('game_name', $gamename);
					$this->db->update('player', $data);
				}
				
				
			}
			else if($z == $total_lead_time-1){
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $total_lead_time-$z);
				$current_delay = $this->db->get('shipping_delay')->result()[0]->amount;
				
				$now = $current_delay;
				$zs = $z-1;
				$now_index = $total_lead_time-$zs;
				
				$data= array(
					'amount' => $now);
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $now_index);
				$this->db->update('shipping_delay', $data);

				if($role[$y] === "Manufacturer"){
					$supplier = $this_team."-"."Resource";
				}
				else{
					$supplier = $this_team."-".$role[$y+1];
				}
				
				$this->db->where("game_name",$gamename);
				$this->db->where("from", $supplier);
				$this->db->where("status", "new");
				$new_amount = $this->db->get('supply')->result()[0]->amount;

				$data= array(
					'amount' => $new_amount);
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $total_lead_time-$z);
				$this->db->update('shipping_delay', $data);

			}
			else{
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $total_lead_time-$z);
				$current_delay = $this->db->get('shipping_delay')->result()[0]->amount;
				
				$now = $current_delay;
				$zs = $z-1;
				$now_index = $total_lead_time-$zs;
				
				$data= array(
					'amount' => $now);
				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$this->db->where('delay_num', $now_index);
				$this->db->update('shipping_delay', $data);
			}

			
		}

			}
		}

	}

	public function cost_calculation($gamename){

		$this->db->where('game_name', $gamename);
		$all = $this->db->get('cost')->result()[0];
		$inventory_cost = $all->inventory_cost;
		$excess_cost = $all->excess_cost;
		$backlog_cost = $all->backlog_cost;

		$this->db->where('game_name', $gamename);
        $current_turn = $this->db->get('game')->result()[0]->current_turn;

		$this->db->where("game_name", $gamename);
		$this->db->from("team");
		$team_length = $this->db->count_all_results();
		

		for($x=1;$x<=$team_length;$x++){
			$team = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
			$this_team = $team[$x];
			
			for($y=1;$y<=4;$y++){
				$role = array(
					1 => 'Retailer',
                	2 => 'Wholesaler',
                	3 => 'Distributor',
                	4 => 'Manufacturer');
				$this_role = $role[$y];

				
				$player_id = $this_team."-".$this_role;

				$this->db->where('player_id', $player_id);
				$this->db->where('game_name', $gamename);
				$players = $this->db->get('player')->result()[0];
				$current_inventory = $players->current_inventory;
				$current_excess_inventory = $players->excess_inventory;
				$current_backlog = $players->current_backlog;
				$current_inventory_cost = $current_inventory*$inventory_cost;
				$current_excess_inv_cost = $current_excess_inventory*$excess_cost;
				$current_backlog_cost = $current_backlog*$backlog_cost;
				$total_cost = $current_inventory_cost+$current_excess_inv_cost+$current_backlog_cost;

				if($this_role === "Retailer"){
					$customer = "customer";
				}
				else if($this_role === "Wholesaler"){
					$customer = $this_team."-Retailer";
				}
				else if($this_role === "Distributor"){
					$customer = $this_team."-Wholesaler";
				}
				else if($this_role === "Manufacturer"){
					$customer = $this_team."-Distributor";
				}

				$this->db->where('game_name', $gamename);
				$this->db->where('from', $customer);
				$this->db->where('turn_count',$current_turn);
				$this->db->where('status', "new");
				$current_demand = $this->db->get('demand')->result()[0]->amount;

				$this->db->where('game_name',$gamename);
				$this->db->where('from', $player_id);
				$this->db->where('turn_count', $current_turn);
				$this->db->where('status', "new");
				$current_supply = $this->db->get('supply')->result()[0]->amount;

				$updatestatistic = array(
					'game_name' => $gamename,
					'turn_count' => $current_turn,
					'player_id' => $player_id,
					'player_team' => $this_team,
					'current_backlog' => $current_backlog,
					'current_backlog_cost' => $current_backlog_cost,
					'current_inventory' => $current_inventory,
					'current_excess_inventory' => $current_excess_inventory,
					'current_inventory_cost' => $current_inventory_cost,
					'current_excess_inv_cost' => $current_excess_inv_cost,
					'current_supply' => $current_supply,
					'current_demand' => $current_demand);

				$this->db->insert('statistics',$updatestatistic);

				$this->db->where('game_name',$gamename);
				$this->db->where('player_id',$player_id);
				$this_player = $this->db->get('player')->result()[0];
				$cur_cost = $this_player->total_cost;
				$latest_cost = $cur_cost+$total_cost;
				$accum_inv = $this_player->accum_inv + $current_inventory_cost;
				$accum_ex = $this_player->accum_ex + $current_excess_inv_cost;
				$accum_back = $this_player->accum_back + $current_backlog_cost;
				$update_cost = array(
					'accum_inv'=>$accum_inv,
					'accum_ex' =>$accum_ex,
					'accum_back' => $accum_back,
					'total_cost'=>$latest_cost);
				$this->db->where('game_name', $gamename);
				$this->db->where('player_id',$player_id);
				$this->db->update('player', $update_cost);

			}
		}
	}

	public function update_team($gamename){
		$this->db->where("game_name", $gamename);
		$this->db->from("team");
		$team_length = $this->db->count_all_results();

		for($x=1;$x<=$team_length;$x++){
			$team = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D',
                5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H',
                9 => 'I', 10 => 'J', 11 => 'K',
                12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O');
			$team_code = $team[$x];
			$this->db->select_sum('total_cost');
	        $this->db->where('game_name',$gamename);
	        $this->db->where('player_team', $team_code);
	        $total_cost = $this->db->get('player')->result()[0]->total_cost;

	        $updates = array('total_cost' => $total_cost);
	        $this->db->where('game_name', $gamename);
	        $this->db->where('team_code', $team_code);
	        $this->db->update('team',$updates);
		}
		
	}
}

?>