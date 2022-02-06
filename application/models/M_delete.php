<?php
class M_delete extends CI_model {

	public function delete_masuk($v_id) {
      $this->db->where('id_masuk', $v_id);
      $this->db->delete('tb_masuk');
    }


}