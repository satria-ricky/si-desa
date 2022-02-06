<?php
class M_update extends CI_model {

	public function edit_masuk($data,$id){     
      $this->db->update('tb_masuk', $data, array('id_masuk' => $id));
    }


}