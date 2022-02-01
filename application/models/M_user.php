<?php
class M_user extends CI_model {

	public function select_all_sales(){
      $sql='SELECT * FROM tb_user LEFT JOIN tb_status ON tb_user.user_id_status = tb_status.status_id WHERE tb_user.user_id_level=2';
      return $query=$this->db->query($sql)->result_array();
    }

   

    public function select_by_status($status){
      $sql='SELECT * FROM tb_user LEFT JOIN tb_status ON tb_user.user_id_status = tb_status.status_id WHERE tb_user.user_id_level=2 AND tb_user.user_id_status=?';
      return $query=$this->db->query($sql,$status)->result_array(); 
    }


 public function get_pengguna($id){
      $sql='SELECT * FROM tb_user LEFT JOIN tb_level ON tb_user.user_id_level = tb_level.level_id LEFT JOIN tb_status ON tb_user.user_id_status = tb_status.status_id WHERE user_id =?';
        return $query=$this->db->query($sql,$id)->row_array();  
    }

    public function get_by_id($id){
      $sql='SELECT * FROM tb_user LEFT JOIN tb_level ON tb_user.user_id_level = tb_level.level_id LEFT JOIN tb_status ON tb_user.user_id_status = tb_status.status_id WHERE user_id =?';
        return $query=$this->db->query($sql,$id)->row_array();  
    }



  public function create_sales($v_data)
  {
      $this->db->insert('tb_user', $v_data);
      return $this->db->affected_rows();
  }

  public function delete($v_id) {
    // $this->db->where('user_id', $v_id);
    // $this->db->delete('tb_user');
    $delete_user = 'DELETE FROM tb_user WHERE user_id = ?';
    $this->db->query($delete_user,$v_id);
    $delete_main = 'DELETE FROM tb_main WHERE main_id_sales = ?';
    $this->db->query($delete_main,$v_id);
  }


  public function cek_username($username, $id){
        $sql='SELECT * FROM tb_user where user_username = ? AND user_id != ?';
         return $this->db->query($sql, array($username,$id))->row_array();
    }

    public function edit_profile($id, $data){     
        $this->db->update('tb_user', $data, array('user_id' => $id));
    }

    public function edit_sales($id, $data){     
        $this->db->update('tb_user', $data, array('user_id' => $id));
    }

}