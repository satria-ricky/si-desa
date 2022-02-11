<?php
class M_read extends CI_model {

	public function get_keluar(){
     $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar';
      return $query=$this->db->query($sql);    
    }


  public function get_keluar_by_id($id){
    $sql='SELECT * FROM tb_keluar  WHERE id_keluar = ?';
   return $this->db->query($sql,$id)->row_array(); 
  }




    public function get_masuk(){
      $sql='SELECT * FROM tb_masuk';
      return $query=$this->db->query($sql);
    }

    public function get_tot_masuk(){
      	$sql='SELECT * FROM tb_masuk';
      	$query=$this->db->query($sql);
      	$tot = 0;
      	if ($query->num_rows() > 0) {
      		foreach($query->result() as $row)
            {
            	$tot = $tot + $row->jumlah_masuk;	
            }
	         return $tot;
	    }
	   
    }

    public function get_masuk_by_id($id){
      $sql='SELECT * FROM tb_masuk  WHERE id_masuk = ?';
     return $this->db->query($sql,$id)->row_array(); 
    }



}