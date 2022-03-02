<?php
class M_read extends CI_model {

//KELUAR

  public function get_keluar(){
   $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar ORDER BY id_bidang_keluar ASC';
    return $query=$this->db->query($sql);    
  }

  public function get_keluar_charts(){
   $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar ORDER BY id_bidang_keluar ASC';
    return $query=$this->db->query($sql)->result_array();    
  }

  public function get_keluar_by_tahun($tahun){
   $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar  WHERE tahun_keluar = ? ORDER BY id_bidang_keluar ASC';
    return $query=$this->db->query($sql,$tahun);    
  }



  public function get_keluar_by_id($id){
    $sql='SELECT * FROM tb_keluar LEFT JOIN tb_bidang ON tb_bidang.id_bidang = tb_keluar.id_bidang_keluar LEFT JOIN tb_subbidang ON tb_subbidang.sub_id = tb_keluar.id_subbidang_keluar  WHERE id_keluar = ?';
   return $this->db->query($sql,$id)->row_array(); 
  }



//MASUK
    public function get_masuk(){
      $sql='SELECT * FROM tb_masuk LEFT JOIN tb_sumber_masuk ON tb_sumber_masuk.sumber_masuk_id = tb_masuk.id_sumber_masuk LEFT JOIN tb_jenis_masuk ON tb_jenis_masuk.jenis_masuk_id = tb_masuk.id_jenis_sumber_masuk ORDER BY id_sumber_masuk ASC';
      return $query=$this->db->query($sql);
    }


    public function get_masuk_by_tahun($tahun){
      $sql='SELECT * FROM tb_masuk LEFT JOIN tb_sumber_masuk ON tb_sumber_masuk.sumber_masuk_id = tb_masuk.id_sumber_masuk LEFT JOIN tb_jenis_masuk ON tb_jenis_masuk.jenis_masuk_id = tb_masuk.id_jenis_sumber_masuk WHERE tahun_masuk = ? ORDER BY id_sumber_masuk ASC';
      return $query=$this->db->query($sql,$tahun);  
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


    public function get_selisih(){
        $sql='SELECT * FROM tb_masuk';
        $query=$this->db->query($sql);
        $tot = 0;
        if ($query->num_rows() > 0) {
          foreach($query->result() as $row)
            {
              $tot = $tot + $row->jumlah_masuk; 
            }
            $simpanan_masuk = $tot;
         }
         

        $sql_keluar='SELECT * FROM tb_keluar';
        $query=$this->db->query($sql_keluar);
        $tot_keluar = 0;
        if ($query->num_rows() > 0) {
          foreach($query->result() as $row)
            {
              $tot_keluar = $tot_keluar + $row->jumlah_keluar; 
            }
           $simpanan_keluar = $tot_keluar;
         }

         return $hasil = $simpanan_masuk - $simpanan_keluar;  
    }



    public function get_selisih_by_tahun($tahun){
        $sql='SELECT * FROM tb_masuk WHERE tahun_masuk =?';
        $query=$this->db->query($sql,$tahun);
        $tot = 0;
        if ($query->num_rows() > 0) {
          foreach($query->result() as $row)
            {
              $tot = $tot + $row->jumlah_masuk; 
            }
            $simpanan_masuk = $tot;
         }
         

        $sql_keluar='SELECT * FROM tb_keluar WHERE tahun_keluar =?';
        $query=$this->db->query($sql_keluar,$tahun);
        $tot_keluar = 0;
        if ($query->num_rows() > 0) {
          foreach($query->result() as $row)
            {
              $tot_keluar = $tot_keluar + $row->jumlah_keluar; 
            }
           $simpanan_keluar = $tot_keluar;
         }

         return $hasil = $simpanan_masuk - $simpanan_keluar;  
    }


    public function get_tot_masuk_by_tahun($tahun){
        $sql='SELECT * FROM tb_masuk WHERE tahun_masuk =?';
        $query=$this->db->query($sql,$tahun);
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

public function get_tahun_masuk(){
 $sql='SELECT DISTINCT tahun_masuk FROM tb_masuk';
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



//CHARTS

public function get_tahun_keluar_charts(){
 $sql='SELECT DISTINCT tahun_keluar FROM tb_keluar ORDER BY tahun_keluar ASC';
  return $query=$this->db->query($sql)->result();    
}

public function get_jumlah_keluar_charts(){
 $sql='SELECT tahun_keluar, SUM(jumlah_keluar) as jumlah_keluar FROM tb_keluar GROUP BY tahun_keluar ORDER BY tahun_keluar ASC';
  return $query=$this->db->query($sql)->result();    
}


public function get_tahun_masuk_charts(){
 $sql='SELECT DISTINCT tahun_masuk FROM tb_masuk ORDER BY tahun_masuk ASC';
  return $query=$this->db->query($sql)->result();    
}

public function get_jumlah_masuk_charts(){
 $sql='SELECT tahun_masuk, SUM(jumlah_masuk) as jumlah_masuk FROM tb_masuk GROUP BY tahun_masuk  ORDER BY tahun_masuk ASC';
  return $query=$this->db->query($sql)->result();    
}


//CEK KODE REKENING
  public function cek_kode_rekenening_keluar($rekening,$tahun){
    $sql='SELECT * FROM tb_keluar WHERE rekening_keluar=? AND tahun_keluar=?';
    return $query=$this->db->query($sql,array($rekening,$tahun))->row_array();
  }

  public function cek_kode_rekenening_keluar_e($rekening,$tahun,$id){
    $sql='SELECT * FROM tb_keluar WHERE rekening_keluar=? AND tahun_keluar=? AND id_keluar != ?';
    return $query=$this->db->query($sql,array($rekening,$tahun,$id))->row_array();
  }


}