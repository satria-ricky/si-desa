<?php
class M_toko extends CI_model {


  public function get_by_id($id){
    $sql='SELECT * FROM tb_toko LEFT JOIN tb_status ON tb_toko.toko_id_status = tb_status.status_id LEFT JOIN tb_rute ON tb_toko.toko_id_rute = tb_rute.rute_id WHERE toko_id =?';
      return $query=$this->db->query($sql,$id)->row_array();  
  }

  public function select_by_rute($id){
    $sql='SELECT * FROM tb_toko LEFT JOIN tb_status ON tb_toko.toko_id_status = tb_status.status_id LEFT JOIN tb_rute ON tb_toko.toko_id_rute = tb_rute.rute_id WHERE toko_id_rute =?';
      return $query=$this->db->query($sql,$id)->result_array();  
  }

  public function create_toko($v_data)
  {
      $this->db->insert('tb_toko', $v_data);
      return $this->db->affected_rows();
  }

  public function edit_toko($id, $data){     
      $this->db->update('tb_toko', $data, array('toko_id' => $id));
  }

  public function delete($v_id) {
    // $this->db->where('toko_id', $v_id);
    // $this->db->delete('tb_toko');

    $delete_toko = 'DELETE FROM tb_toko WHERE toko_id = ?';
    $this->db->query($delete_toko,$v_id);
    $delete_main = 'DELETE FROM tb_main WHERE main_id_toko = ?';
    $this->db->query($delete_main,$v_id);

  }

  


  public function select_all_toko(){
      $sql='SELECT * FROM tb_toko LEFT JOIN tb_status ON tb_toko.toko_id_status = tb_status.status_id LEFT JOIN tb_rute ON tb_toko.toko_id_rute = tb_rute.rute_id';
      return $query=$this->db->query($sql)->result_array();
    }

   

    public function select_by_status($status){
      $sql='SELECT * FROM tb_toko LEFT JOIN tb_status ON tb_toko.toko_id_status = tb_status.status_id LEFT JOIN tb_rute ON tb_toko.toko_id_rute = tb_rute.rute_id WHERE  tb_toko.toko_id_status=?';
      return $query=$this->db->query($sql,$status)->result_array(); 
    }


    public function get_toko($id){
      $sql='SELECT * FROM tb_toko  WHERE toko_id =?';
        return $query=$this->db->query($sql,$id)->row_array();  
    }

}