<?php
class M_status extends CI_model {


    public function select_status(){
      return $this->db->get('tb_status')->result_array();
    }

}