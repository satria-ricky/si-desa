<?php
class M_rute extends CI_model {

  public function create_rute($v_data)
  {
      $this->db->insert('tb_rute', $v_data);
      return $this->db->affected_rows();
  }

  public function select_rute(){
    return $this->db->get('tb_rute')->result_array();
  }

  public function delete($v_id) {
    $this->db->where('user_id', $v_id);
    $this->db->delete('tb_user');
  }

  public function edit_sales($id, $data){     
      $this->db->update('tb_user', $data, array('user_id' => $id));
  }

  public function select_all_sales(){
      $sql='SELECT * FROM tb_rute LEFT JOIN tb_status ON tb_rute.rute_id_status = tb_status.status_id';
      return $query=$this->db->query($sql)->result_array();
    }

   

    public function select_by_status($status){
      $sql='SELECT * FROM tb_rute LEFT JOIN tb_status ON tb_rute.rute_id_status = tb_status.status_id WHERE tb_rute.rute_id_status=?';
      return $query=$this->db->query($sql,$status)->result_array(); 
    }


    public function get_rute_by($id){
      $sql='SELECT * FROM tb_rute LEFT JOIN tb_status ON tb_rute.rute_id_status = tb_status.status_id WHERE rute_id =?';
        return $query=$this->db->query($sql,$id)->row_array();  
    }

    public function cek_nama_rute($nama){
        $sql='SELECT * FROM tb_rute where rute_nama = ?';
         return $this->db->query($sql,$nama)->row_array();
    }

    public function edit_rute($id, $data){     
        $this->db->update('tb_rute', $data, array('rute_id' => $id));
    }

}