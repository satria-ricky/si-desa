<?php
class M_auth extends CI_model {

    public function auth($v_level, $v_username, $v_password){
        $sql='SELECT * FROM tb_user WHERE user_id_level=? AND user_username=? AND user_password=?';
        return $this->db->query($sql, array($v_level,$v_username,$v_password))->row_array();
    }


}