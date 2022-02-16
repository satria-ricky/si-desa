<?php
class M_read extends CI_model {

//KELUAR

  public function get_keluar(){
   $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar ORDER BY id_bidang_keluar DESC';
    return $query=$this->db->query($sql);    
  }

  public function get_keluar_by_tahun($tahun){
   $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar  WHERE tahun_keluar = ? ORDER BY id_bidang_keluar DESC';
    return $query=$this->db->query($sql,$tahun);    
  }



  public function get_keluar_by_id($id){
    $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar  WHERE id_keluar = ?';
   return $this->db->query($sql,$id)->row_array(); 
  }



//MASUK
    public function get_masuk(){
      $sql='SELECT * FROM tb_masuk LEFT JOIN tb_sumber_masuk ON tb_sumber_masuk.sumber_masuk_id = tb_masuk.id_sumber_masuk LEFT JOIN tb_jenis_masuk ON tb_jenis_masuk.jenis_masuk_id = tb_masuk.id_jenis_sumber_masuk ORDER BY id_sumber_masuk';
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



//GET TAHUN
public function get_tahun_keluar(){
     $sql='SELECT DISTINCT tahun_keluar FROM tb_keluar';
      return $query=$this->db->query($sql);    
    }



//BIDANG
    public function get_bidang(){
      $sql='SELECT * FROM tb_bidang';
      return $query=$this->db->query($sql);
    }

    public function get_subbidang(){
      $sql='SELECT * FROM tb_subbidang';
      return $query=$this->db->query($sql);
    }

    public function get_subbidang_by_bidang($id){
    $sql='SELECT * FROM tb_subbidang  WHERE sub_id_bidang = ?';
   return $this->db->query($sql,$id)->result_array(); 
  }


//SUMBER PEMASUKAN
  public function get_sumber(){
    $sql='SELECT * FROM tb_sumber_masuk';
    return $query=$this->db->query($sql);
  }

  public function get_jenis_by_sumber($id){
    $sql='SELECT * FROM tb_jenis_masuk  WHERE jenis_sumber_id = ?';
   return $this->db->query($sql,$id)->result_array(); 
  }

}