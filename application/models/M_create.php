<?php
class M_create extends CI_model {

	public function create_masuk($v_data)
	{
	  $this->db->insert('tb_masuk', $v_data);
	  return $this->db->affected_rows();
	}


	public function create_keluar($v_data)
	{
	  $this->db->insert('tb_keluar', $v_data);
	  return $this->db->affected_rows();
	}



	public function create_pengguna($v_data)
	{
	  $this->db->insert('tb_user', $v_data);
	  return $this->db->affected_rows();
	}


	public function create_laporan($v_data)
	{
	  $this->db->insert('tb_laporan', $v_data);
	  return $this->db->affected_rows();
	}

}