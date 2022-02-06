<?php
class M_update extends CI_model {

	public function edit_masuk($data,$id){     
      $this->db->update('tb_masuk', $data, array('id_masuk' => $id));
    }


    public function edit_keluar($data,$id){     
      $this->db->update('tb_keluar', $data, array('id_keluar' => $id));
    }

}