<?php
class M_create extends CI_model {

	public function create_masuk($v_data)
	{
	  $this->db->insert('tb_masuk', $v_data);
	  return $this->db->affected_rows();
	}


}