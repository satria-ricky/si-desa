<?php
class M_auth extends CI_model {

    public function auth($v_username, $v_password){
        $sql='SELECT * FROM tb_admin where username_admin=? AND password=?';
        return $this->db->query($sql, array($v_username,$v_password))->row_array();
    }


}