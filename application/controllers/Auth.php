<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }


    public function get_user(){
        $v_data = $this->M_read->get_user_by_id(decrypt_url($this->input->post('id')));
        echo json_encode($v_data);
    }


    public function get_jabatan(){
        $output = '<option value="">-- Pilih Jabatan --</option>';
        $v_data = $this->M_read->get_jabatan()->result_array();
            foreach ($v_data as $row){
                $output .= '<option value="'.$row['level_id'].'"> '.$row['level_nama'].' </option>';
        }

        echo json_encode($output);
    }

    public function set_jabatan_edit(){
        $level = $this->input->post('id');
        $output = '<option value="">-- Pilih Jabatan --</option>';
        $v_data = $this->M_read->get_jabatan()->result_array();
            foreach ($v_data as $row){
                if ($level == $row['level_id']) {
                    $output .= '<option value="'.$row['level_id'].'" selected> '.$row['level_nama'].' </option>';
                }else {
                    $output .= '<option value="'.$row['level_id'].'"> '.$row['level_nama'].' </option>';
                }
                
        }

        echo json_encode($output);
    }

    public function get_tahun(){
        $v_data = $this->M_read->get_tahun_charts();
        echo json_encode($v_data);
    }

    public function get_tahun_modal(){
        $jenis = $this->input->post('jenis');
         $output = '<option value="">-- Pilih Tahun --</option>';
        if ($jenis == 1) {
            $v_data = $this->M_read->get_tahun_masuk()->result_array();
            foreach ($v_data as $row){
                $output .= '<option value="'.$row['tahun_masuk'].'">'.$row['tahun_masuk'].'</option>';
            }
        }else{
            $v_data = $this->M_read->get_tahun_keluar()->result_array();
            foreach ($v_data as $row){
                $output .= '<option value="'.$row['tahun_keluar'].'">'.$row['tahun_keluar'].'</option>';
            }
        }
        
        echo json_encode($output);
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


    public function index(){
        
        if ($this->session->userdata('level_user')) {
            if ($this->session->userdata('level_user') == 1) {
               redirect('admin');
            }elseif ($this->session->userdata('level_user') == 2){
                redirect('Adm');
            }else{
                redirect('dashboard');
            }
        }
        

        $this->load->view('signin/index');
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

        $v_level = $this->input->post('level_user');
        $v_username = $this->input->post('username');
        $v_password = $this->input->post('password');

        $pengguna = $this->M_auth->auth($v_level, $v_username, $v_password);

        if ($pengguna){

            $v_data['level_user'] = $pengguna['user_id_level'];
            $v_data['id_user'] = $pengguna['user_id'];
            $this->session->set_userdata($v_data);
            $this->session->set_flashdata('pesan', 'Berhasil login !');

            if ($pengguna['user_id_level'] == 1) {
                //SUPER ADMIN
                redirect('admin');
            }else if ($pengguna['user_id_level'] == 2) {
                //ADMIN
                redirect('adm');
            }else {
                //KEPALA DESA DAN SEKRETARIS
                redirect('dashboard');
            } 

        }else {
            $this->session->set_flashdata('error', 'username dan password salah !');
            redirect('auth');
        }

    }


    public function logout(){
        $array_items = array('id_user','level_user');
        $this->session->unset_userdata($array_items);
        // session_destroy();
        $this->session->set_flashdata('pesan', 'Berhasil logout !');
        redirect('auth');
    }


}