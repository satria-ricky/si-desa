<?php
class M_sales extends CI_model {

    public function auth($v_username, $v_password){
        $sql='SELECT * FROM tb_sales where sales_username=? AND sales_password=?';
        return $this->db->query($sql, array($v_username,$v_password))->row_array();
    }
    


    public function get_pengguna($v_id){
        return $this->db->get_where('tb_admin',  ['admin_id' => $v_id])->row_array();
    }
    

    public function select_by_username($v_username){
        return $this->db->get_where('tb_sales',  ['sales_username' => $v_username])->row_array();
    }

    public function select_by_toko($v_toko){
       $sql='SELECT * FROM tb_main LEFT JOIN tb_rute ON tb_rute.rute_id = tb_main.main_id_rute LEFT JOIN tb_toko ON tb_toko.toko_id = tb_main.main_id_toko LEFT JOIN tb_user ON tb_user.user_id = tb_main.main_id_sales  WHERE main_id_toko = '.$v_toko.' GROUP BY main_id_sales ';
      return $query=$this->db->query($sql)->result_array();
    }




    public function edit_nota($id, $data){     
        $this->db->update('tb_nota', $data, array('nota_id' => $id));
    }

    public function create_nota($v_data)
    {
        $this->db->insert('tb_nota', $v_data);
        return $this->db->affected_rows();
    }


}