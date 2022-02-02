<?php
class M_delete extends CI_model {

	public function get_keluar(){
      $sql='SELECT * FROM tb_keluar';
      return $query=$this->db->query($sql);
    }
}