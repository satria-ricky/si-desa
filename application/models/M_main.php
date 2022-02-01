<?php
class M_main extends CI_model {

    public function select_main(){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1';
      return $query=$this->db->query($sql)->result_array(); 
    }

    public function select_main_byid($id){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id = ?';
      return $query=$this->db->query($sql,$id)->row_array(); 
    }


    public function select_main_by_tanggal_saja($v_tanggal1,$v_tanggal2){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_without_rute($v_id_toko,$v_tanggal1,$v_tanggal2,$v_id_sales){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_sales = '.$v_id_sales.' AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_tanggal_dan_rute($v_tanggal1,$v_tanggal2,$v_id_rute){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_rute='.$v_id_rute.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }

//SALES
    public function select_main_by_sales($id_sales){
    	$sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_sales = ? ';
      return $query=$this->db->query($sql,$id_sales)->result_array();
    }

    public function select_main_by_tanggal($id_sales,$v_tanggal1,$v_tanggal2){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_sales = '.$id_sales.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_without_toko($id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_sales = '.$id_sales.' AND main_id_rute = '.$v_id_rute.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_all_kondisi($id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute,$v_id_toko){
    	$sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales  LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_sales = '.$id_sales.' AND main_id_rute = '.$v_id_rute.' AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


//TOKO
    public function select_main_by_toko($v_id_toko){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_toko = '.$v_id_toko.'';
      return $query=$this->db->query($sql)->result_array();
    }

    public function select_main_by_tanggal_dan_toko($v_tanggal1,$v_tanggal2,$v_id_toko){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 1 AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }
    
    


    public function create_main($v_data){
      $this->db->insert('tb_main', $v_data);
      return $this->db->affected_rows();
    }

    public function edit_main($id, $data){     
      $this->db->update('tb_main', $data, array('main_id' => $id));
    }

    public function delete($v_id) {
      $this->db->where('main_id', $v_id);
      $this->db->delete('tb_main');
    }



    //SAMPAH

    public function select_main_sampah(){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2';
      return $query=$this->db->query($sql)->result_array(); 
    }

    public function select_main_by_without_rute_sampah($v_id_toko,$v_tanggal1,$v_tanggal2,$v_id_sales){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_sales = '.$id_sales.' AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }

//SALES
    public function select_main_by_sales_sampah($id_sales){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_sales = ? ';
      return $query=$this->db->query($sql,$id_sales)->result_array();
    }

    public function select_main_by_tanggal_sampah($id_sales,$v_tanggal1,$v_tanggal2){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_sales = '.$id_sales.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_without_toko_sampah($id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_sales = '.$id_sales.' AND main_id_rute = '.$v_id_rute.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_all_kondisi_sampah($id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute,$v_id_toko){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales  LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_sales = '.$id_sales.' AND main_id_rute = '.$v_id_rute.' AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


//TOKO
    public function select_main_by_toko_sampah($v_id_toko){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_toko = '.$v_id_toko.'';
      return $query=$this->db->query($sql)->result_array();
    }

    public function select_main_by_tanggal_dan_toko_sampah($v_tanggal1,$v_tanggal2,$v_id_toko){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_id_toko = '.$v_id_toko.' AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }


    public function select_main_by_tanggal_saja_sampah($v_tanggal1,$v_tanggal2){
      $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales LEFT JOIN tb_status ON tb_status.status_id = tb_main.main_id_status WHERE main_id_status = 2 AND main_waktu_mulai BETWEEN "'.$v_tanggal1.'" AND "'.$v_tanggal2.'"';
      return $query=$this->db->query($sql)->result_array();
    }
    
}	