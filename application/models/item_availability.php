<?php

class Item_availability extends CI_Model {

    function change_status() {
        $limit = $this->db->count_all('shop');

        for($x=0;$x<$limit;$x++){
            $a = $x+1;           
            $id = "G".$a;          
            $avail = $this->input->post("availability")[$x];
            $data = array('status' => $avail);
            $this->db->where('good_id', $id);
            $this->db->update('shop',$data);           
            
        }     
    }

    
    function reset(){
        $username = $this->session->userdata('username');
        $data = array(
            'availability' =>'Available'
            );
        $this->db->where('username',$username);
        $this->db->update('avail_item',$data);
        
        
    }
}

?>
