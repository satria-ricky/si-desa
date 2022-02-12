<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }


    public function get_subbidang(){
        $id = $this->input->post('id');
        $v_data = $this->M_read->get_subbidang_by_bidang($id);
        $output = '<option value="">-- Pilih subbidang --</option>';
        foreach ($v_data as $row){
            $output .= '<option value="'.$row['sub_id'].'">'.$row['sub_nama'].'</option>';
        }
        echo json_encode($output);
    }


    public function get_jenis(){
        $id = $this->input->post('id');
        $v_data = $this->M_read->get_jenis_by_sumber($id);
        $output = '<option value="">-- Pilih jenis --</option>';
        foreach ($v_data as $row){
            $output .= '<option value="'.$row['jenis_masuk_id'].'">'.$row['jenis_nama'].'</option>';
        }
        echo json_encode($output);
    }




    public function login(){

        $v_username = $this->input->post('username');
        $v_password = $this->input->post('password');

        $pengguna = $this->M_auth->auth($v_username, $v_password);

        if ($pengguna){

                $v_data['id_username'] = $pengguna['id_admin'];

                $this->session->set_userdata($v_data);
                 redirect('admin');

        }else {
            $this->session->set_flashdata('error', 'username dan password salah !');
            redirect('dashboard/login');
        }

    }


    public function logout(){
        $this->session->unset_userdata('id_username');
        $this->session->set_flashdata('logout', 'Berhasil logout !');
        redirect('dashboard/login');
    }


}