<?php

class M_produk extends CI_model {

    public function select_all_pm(){
      $sql='SELECT * FROM tb_produk_masuk';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_pm_by_tanggal($v_tanggal1,$v_tanggal2){
      $sql='SELECT * FROM tb_produk_masuk WHERE pm_created BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_pm_by_id($id){
      $sql='SELECT * FROM tb_produk_masuk WHERE pm_id = ?';
      return $query=$this->db->query($sql,$id)->row_array(); 
    }

    public function create_pm($v_data){
      $this->db->insert('tb_produk_masuk', $v_data);
      return $this->db->affected_rows();
    }

    public function edit_pm($id, $data){     
      $this->db->update('tb_produk_masuk', $data, array('pm_id' => $id));
    }

    public function delete($v_id) {
      $this->db->where('pm_id', $v_id);
      $this->db->delete('tb_produk_masuk');
    }



     public function edit_pi($id, $data){     
      $this->db->update('tb_produk_induk', $data, array('pi_id' => $id));
    }

    public function select_pi($id){
      $sql='SELECT * FROM tb_produk_induk WHERE pi_id = ?';
      return $query=$this->db->query($sql,$id)->row_array(); 
    }
}	