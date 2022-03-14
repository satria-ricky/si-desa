<?php
class M_delete extends CI_model {

	public function delete_masuk($v_id) {
      $this->db->where('id_masuk', $v_id);
      $this->db->delete('tb_masuk');
    }

    public function delete_keluar($v_id) {
      $this->db->where('id_keluar', $v_id);
      $this->db->delete('tb_keluar');
    }

    public function delete_pengguna($v_id) {
      $this->db->where('user_id', $v_id);
      $this->db->delete('tb_user');
    }

    public function delete_laporan($v_id) {
      $this->db->where('laporan_id', $v_id);
      $this->db->delete('tb_laporan');
    }


}