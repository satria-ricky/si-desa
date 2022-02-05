<?php
class M_read extends CI_model {

	public function get_keluar(){
      $sql='SELECT * FROM tb_keluar';
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



    public function get_masuk(){
      $sql='SELECT * FROM tb_masuk';
      return $query=$this->db->query($sql);
    }


}