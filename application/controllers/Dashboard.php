<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('id_username')) {
            echo"<script>
                window.history.go(-1)
            </script>
            ";
        }
    }

    public function index(){
        $v_data['is_aktif'] = 'keluar';
        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('v_dashboard/keluar',$v_data);
        $this->load->view('templates/footer_dashboard');		 
	}

    public function masuk(){
        $v_data['is_aktif'] = 'masuk';
        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('v_dashboard/masuk',$v_data);
        $this->load->view('templates/footer_dashboard');         
    }

    public function login(){
        $v_data['is_aktif'] = 'login';
        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('v_dashboard/login',$v_data);
        $this->load->view('templates/footer_dashboard');         
    }





}