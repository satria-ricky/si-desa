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
        $this->load->view('templates/header_dashboard');
        $this->load->view('v_dashboard/index');
        $this->load->view('templates/footer_dashboard');		 
	}

}