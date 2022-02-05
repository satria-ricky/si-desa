<?php
class M_update extends CI_model {

	public function update_masuk($id, $data)
	{     
	    $this->db->update('tb_masuk', $data, array('id_masuk' => $id));
	}

}