<?php
class M_read extends CI_model {

	public function get_keluar(){
      $sql='SELECT * FROM tb_keluar';
      return $query=$this->db->query($sql);
    }


    public function get_masuk(){
      $sql='SELECT * FROM tb_masuk';
      return $query=$this->db->query($sql);
    }


}