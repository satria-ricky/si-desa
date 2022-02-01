<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        cek_login();
        if ($this->session->userdata('id_level') != 1) {
            redirect('blocked');
        }
    }

    public function produk_induk($sepray,$roll,$io){
        $v_id = 1;

        $data =  $this->M_produk->select_pi($v_id);
        $v_sepray = $sepray;
        $v_roll = $roll;
        if ($io == 1) {
            $v_data = [
                'pi_sepray' => $data['pi_sepray'] + $v_sepray,
                'pi_roll' => $data['pi_roll'] + $v_roll
            ];
        }else{
            $v_data = [
                'pi_sepray' => $data['pi_sepray'] - $v_sepray,
                'pi_roll' => $data['pi_roll'] - $v_roll
            ];
        }
        
    
        $this->M_produk->edit_pi($v_id,$v_data);
    }

    public function detpas_sales($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/detail_sales/'.$data);
    }

    public function editpas_sales($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/edit_sales/'.$data);
    }

    public function detpas_toko($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/detail_toko/'.$data);
    }

    public function editpas_toko($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/edit_toko/'.$data);
    }

    public function get_status(){
        echo json_encode($this->M_status->select_status());
    }

    public function get_rute(){
        echo json_encode($this->M_rute->select_rute());
    }



    function validasi_status($id_status)
    {
        
        if($id_status == ""){
            $this->form_validation->set_message('validasi_status', 'Pilih status!');
            return false;
        } else{
            return true;
        }

    }

    function validasi_rute($id_rute)
    {
        
        if($id_rute == ""){
            $this->form_validation->set_message('validasi_rute', 'Pilih rute!');
            return false;
        } else{
            return true;
        }

    }

    function validasi_toko($id)
    {
        
        if($id == ""){
            $this->form_validation->set_message('validasi_toko', 'Pilih Toko!');
            return false;
        } else{
            return true;
        }

    }

    public function get_sales(){
        $v_status = $this->input->post('id_status');
       if( strlen($v_status) != 0 ){
            $data = $this->M_user->select_by_status($v_status);  
        }else{  
            $data = $this->M_user->select_all_sales();
        }
            echo json_encode($data);
    }

    public function get_toko(){
        $v_status = $this->input->post('id_status');
       if( strlen($v_status) != 0 ){
            $data = $this->M_toko->select_by_status($v_status);  
        }else{  
            $data = $this->M_toko->select_all_toko();
        }
            echo json_encode($data);
    }


//PROFILE
    public function profile (){
        $v_data['title'] = 'Profile';

        $v_id_username = $this->session->userdata('id_username'); 

        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

       
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_profile/profile',$v_data);
            $this->load->view('templates/footer');
    }


     public function edit_profile (){
        $v_data['title'] = 'Profile';

        $v_id_username = $this->session->userdata('id_username'); 

        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);


        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama !',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Silahkan masukkan Username !'
        ]); 
       

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Silahkan masukkan Password !',
        ]);

        $this->form_validation->set_rules('kontak', 'Kontak', 'required|trim', [
            'required' => 'Silahkan masukkan Kontak !',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Silahkan masukkan Alamat !',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_profile/edit_profile',$v_data);
            $this->load->view('templates/footer');
        }else{

            $v_nama     = $this->input->post('nama');
            $username_input = $this->input->post('username');
            $v_password = $this->input->post('password');
            $v_kontak = $this->input->post('kontak');
            $v_alamat = $this->input->post('alamat');
            $upload_foto = $_FILES['foto']['name'];

            if($this->M_user->cek_username($username_input, $v_id_username)){
                $this->session->set_flashdata('error', 'Gagal mengubah! Username telah terdaftar!');
                redirect('admin/edit_profile');

            }
            else{

                if($upload_foto){
                
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']     = '5000';
                    $config['upload_path'] = './assets/foto/user/';
                        
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('foto')){
                        $v_nama_foto = $this->upload->data('file_name');
    
                        $v_foto_lama = $v_data['data_pengguna']['user_foto'];
                        
                        if($v_foto_lama != 'default.jpg'){
                            unlink(FCPATH . 'assets/foto/user/' . $v_foto_lama);
                        }
                        
                        $v_data = [
                            'user_nama' => $v_nama,
                            'user_username' => $username_input,
                            'user_password' => $v_password,
                            'user_kontak' => $v_kontak,
                            'user_alamat' => $v_alamat,
                            'user_foto' => $v_nama_foto,
                            'last_updated' => date('Y-m-d')
                        ];
                    }
                    else
                    {
                        echo $this->upload->display_errors();
                    }
    
                }else{
                    $v_data = [
                        'user_nama' => $v_nama,
                        'user_username' => $username_input,
                        'user_password' => $v_password,
                        'user_kontak' => $v_kontak,
                        'user_alamat' => $v_alamat,
                        'last_updated' => date('Y-m-d')
                    ];
                }
                $this->M_user->edit_profile($v_id_username, $v_data);
                $this->session->set_flashdata('pesan', 'Profile berhasil diubah!');
                redirect('admin/profile');

            }            
        }
    }

//PRODUK

    public function produk_masuk(){
        $v_data['title'] = 'Daftar produk masuk';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

         $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Silahkan masukkan Tanggal!',
        ]);

         $v_data['produk_induk'] =  $this->M_produk->select_pi(1);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_produk/masuk', $v_data);
            $this->load->view('templates/footer');
        }else {

            $v_tanggal = $this->input->post('tanggal');
            $v_sepray = $this->input->post('sepray');
            $v_roll = $this->input->post('roll');
            $this->produk_induk($v_sepray,$v_roll,1);

            $v_data = [
                'pm_created' => $v_tanggal,
                'pm_sepray' => $v_sepray,
                'pm_roll' => $v_roll,
                'pm_total' => $v_roll + $v_sepray
            ];
           

            $this->M_produk->create_pm($v_data);
            
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/produk_masuk');

        }
    }


    public function edit_pm(){
            $v_id = $this->input->post('id_modal');
            $v_tanggal = $this->input->post('tanggal');
            $v_sepray = $this->input->post('sepray');
            $v_roll = $this->input->post('roll');
            
            $v_data = [
                'pm_created' => $v_tanggal,
                'pm_sepray' => $v_sepray,
                'pm_roll' => $v_roll,
                'pm_total' => $v_roll + $v_sepray
            ];
           

            $this->M_produk->edit_pm($v_id,$v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('admin/produk_masuk');

    }



    public function produk_keluar(){
        $v_data['title'] = 'Daftar produk keluar';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

     
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_produk/keluar', $v_data);
            $this->load->view('templates/footer');
    }

// DAFTAR

    public function daftar_rute (){
        $v_data['title'] = 'Daftar rute';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_rute/daftar_rute', $v_data);
        $this->load->view('templates/footer');
    }


    public function daftar_toko (){
        $v_data['title'] = 'Daftar toko';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_toko/daftar_toko', $v_data);
        $this->load->view('templates/footer');
    }

    public function daftar_sales (){
        $v_data['title'] = 'Daftar sales';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_sales/daftar_sales', $v_data);
        $this->load->view('templates/footer');
    }


   


// TAMBAH

    public function tambah_toko(){
        $v_data['title'] = 'Tambah Toko';
        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

    
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama toko!',
        ]);
       
        $this->form_validation->set_rules('kontak', 'Kontak', 'required|trim', [
            'required' => 'Silahkan masukkan Kontak toko!',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Silahkan masukkan Alamat toko!',
        ]);

        $this->form_validation->set_rules('status','Status','required|callback_validasi_status');
        $this->form_validation->set_rules('rute','Rute','required|callback_validasi_rute');


        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_toko/tambah_toko', $v_data);
            $this->load->view('templates/footer');
        }
        else{
            $v_status = $this->input->post('status');
            $v_rute = $this->input->post('rute');
            $v_nama     = $this->input->post('nama');
            $v_kontak = $this->input->post('kontak');
            $v_alamat = $this->input->post('alamat');
            
            $upload_foto = $_FILES['foto']['name'];

            if($upload_foto){
                
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '15000';
                $config['upload_path'] = './assets/foto/toko/';
                    
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')){
                    $v_nama_foto = $this->upload->data('file_name');             
                    $v_data = [
                        'toko_id_rute' => $v_rute,
                        'toko_id_status' => $v_status,
                        'toko_nama' => $v_nama,
                        'toko_kontak' => $v_kontak,
                        'toko_alamat' => $v_alamat,
                        'toko_foto' => $v_nama_foto,
                        'toko_created' => date('Y-m-d')
                    ];
                }
                else
                {
                    echo $this->upload->display_errors();
                }

            }else{
                $v_data = [
                    'toko_id_rute' => $v_rute,
                    'toko_id_status' => $v_status,
                    'toko_nama' => $v_nama,
                    'toko_kontak' => $v_kontak,
                    'toko_alamat' => $v_alamat,
                    'toko_foto' => 'default.png',
                    'toko_created' => date('Y-m-d')
                ];
            }

            $this->M_toko->create_toko($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/daftar_toko');

        }
    }


    public function tambah_rute(){
        $v_data['title'] = 'Tambah rute';
        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[tb_rute.rute_nama]', [
            'required' => 'Silahkan masukkan Nama rute!',
            'is_unique' => 'Nama rute telah terdaftar!'
        ]); 

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_rute/tambah_rute', $v_data);
            $this->load->view('templates/footer');
        }
        else{
            $v_nama     = $this->input->post('nama');
            $v_data = [
                'rute_nama' => $v_nama,
                'rute_id_status' => 1,
                'rute_created' => date('Y-m-d')
            ];
            

            $this->M_rute->create_rute($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/daftar_rute');

        }
    }


    public function tambah_sales(){
        $v_data['title'] = 'Tambah Sales';
        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        
        
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama sales!',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.user_username]', [
            'required' => 'Silahkan masukkan Username sales!',
            'is_unique' => 'Username telah terdaftar!'
        ]); 
       

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Silahkan masukkan Password sales!',
        ]);

        $this->form_validation->set_rules('kontak', 'Kontak', 'required|trim', [
            'required' => 'Silahkan masukkan Kontak sales!',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Silahkan masukkan Alamat sales!',
        ]);

        $this->form_validation->set_rules('status','Status','required|callback_validasi_status');


        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_sales/tambah_sales', $v_data);
            $this->load->view('templates/footer');
        }
        else{
            $v_nama     = $this->input->post('nama');
            $v_username = $this->input->post('username');
            $v_password = $this->input->post('password');
            $v_kontak = $this->input->post('kontak');
            $v_alamat = $this->input->post('alamat');
            $v_status = $this->input->post('status');
            
            $upload_foto = $_FILES['foto']['name'];

            if($upload_foto){
                
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '15000';
                $config['upload_path'] = './assets/foto/user/';
                    
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')){
                    $v_nama_foto = $this->upload->data('file_name');             
                    $v_data = [
                        'user_id_level' => 2,
                        'user_id_status' => $v_status,
                        'user_nama' => $v_nama,
                        'user_username' => $v_username,
                        'user_password' => $v_password,
                        'user_kontak' => $v_kontak,
                        'user_alamat' => $v_alamat,
                        'user_foto' => $v_nama_foto,
                        'user_created' => date('Y-m-d')
                    ];
                }
                else
                {
                    echo $this->upload->display_errors();
                }

            }else{
                $v_data = [
                    'user_id_level' => 2,
                    'user_id_status' => $v_status,
                    'user_nama' => $v_nama,
                    'user_username' => $v_username,
                    'user_password' => $v_password,
                    'user_kontak' => $v_kontak,
                    'user_alamat' => $v_alamat,
                    'user_foto' => 'default.jpg',
                    'user_created' => date('Y-m-d')
                ];
            }

            $this->M_user->create_sales($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/daftar_sales');

        }
    }

//EDIT
    public function edit_rute(){
        
        $v_id = $this->input->post('id');
        $v_nama   = $this->input->post('nama');


        if($this->M_rute->cek_nama_rute($v_nama)){
                $this->session->set_flashdata('error', 'Gagal mengubah! Nama rute telah terdaftar!');
                redirect('admin/daftar_rute');
        }
        else{
        
            $v_data = [
                'rute_nama' => $v_nama,
                'rute_last_updated' => date('Y-m-d')
            ];
         

            $this->M_rute->edit_rute($v_id, $v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('admin/daftar_rute');
        }


    }



    public function edit_toko($hai){
        $v_id = decrypt_url($hai);
        $v_data['title'] = 'Edit toko';

        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);
        $v_data['data_detail'] = $this->M_toko->get_by_id($v_id);    
        $v_data['list_status'] = $this->M_status->select_status(); 
        $v_data['list_rute'] = $this->M_rute->select_rute();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama toko!',
        ]);
       
        $this->form_validation->set_rules('kontak', 'Kontak', 'required|trim', [
            'required' => 'Silahkan masukkan Kontak toko!',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Silahkan masukkan Alamat toko!',
        ]);

        $this->form_validation->set_rules('status','Status','required|callback_validasi_status');
        $this->form_validation->set_rules('rute','Rute','required|callback_validasi_rute');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_toko/edit_toko', $v_data);
            $this->load->view('templates/footer');

        }
        else{
            $v_status = $this->input->post('status');
            $v_rute = $this->input->post('rute');
            $v_nama     = $this->input->post('nama');
            $v_kontak = $this->input->post('kontak');
            $v_alamat = $this->input->post('alamat');
            
            $upload_foto = $_FILES['foto']['name'];

            if($upload_foto){
                
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '15000';
                $config['upload_path'] = './assets/foto/toko/';
                    
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')){
                    $v_nama_foto = $this->upload->data('file_name');             
                    $v_data = [
                        'toko_id_rute' => $v_rute,
                        'toko_id_status' => $v_status,
                        'toko_nama' => $v_nama,
                        'toko_kontak' => $v_kontak,
                        'toko_alamat' => $v_alamat,
                        'toko_foto' => $v_nama_foto,
                        'toko_last_updated' => date('Y-m-d')
                    ];
                }
                else
                {
                    echo $this->upload->display_errors();
                }

            }else{
                $v_data = [
                    'toko_id_rute' => $v_rute,
                    'toko_id_status' => $v_status,
                    'toko_nama' => $v_nama,
                    'toko_kontak' => $v_kontak,
                    'toko_alamat' => $v_alamat,
                    'toko_foto' => 'default.png',
                    'toko_last_updated' => date('Y-m-d')
                ];
            }

            $this->M_toko->edit_toko($v_id, $v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('admin/daftar_toko');
        }


    }

    public function editpas_riwayat_toko($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/edit_riwayat_toko/'.$data);
    }

    public function edit_riwayat_toko($hai){
        $v_id = decrypt_url($hai);
        $v_data['title'] = 'Edit riwayat toko';

        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);
        $v_data['data_detail'] = $this->M_main->select_main_byid($v_id);    

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Silahkan pilih Tanggal!',
        ]);
        $this->form_validation->set_rules('harga_sepray', 'Harga_sepray', 'required|trim', [
            'required' => 'Silahkan masukkan Harga !',
        ]);
        $this->form_validation->set_rules('harga_roll', 'Harga_roll', 'required|trim', [
            'required' => 'Silahkan masukkan Harga !',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_toko/edit_riwayat', $v_data);
            $this->load->view('templates/footer');

        }
        else{
            $v_id_toko     = $this->input->post('id_toko');
            $v_tanggal     = $this->input->post('tanggal');
            $v_sepray = $this->input->post('sepray');
            $v_roll = $this->input->post('roll');
            $v_harga_sepray = $this->input->post('harga_sepray');
            $v_harga_roll = $this->input->post('harga_roll');
            $v_bonus_sepray = $this->input->post('bonus_sepray');
            $v_bonus_roll = $this->input->post('bonus_roll');

            $v_data = [
                'main_waktu_mulai' => $v_tanggal,
                'main_stok_sepray' => $v_sepray,
                'main_stok_roll' => $v_roll,
                'main_stok_total' => $v_roll + $v_sepray,
                'main_harga_sepray' => $v_harga_sepray,
                'main_harga_roll' => $v_harga_roll,
                'main_bonus_sepray' => $v_bonus_sepray,
                'main_bonus_roll' => $v_bonus_roll,
                'main_jumlah_sepray' => $v_sepray * $v_harga_sepray,
                'main_jumlah_roll' => $v_roll * $v_harga_roll
            ];

            $this->M_main->edit_main($v_id, $v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            
            redirect('admin/detail_toko/'.encrypt_url($v_id_toko));
        }


    }

    public function edit_sales($hai){
        $v_id = decrypt_url($hai);

        $v_data['title'] = 'Edit sales';

        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);
        
        $v_data['data_detail'] = $this->M_user->get_by_id($v_id);    
        $v_data['list_status'] = $this->M_status->select_status();   
        

       $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Silahkan masukkan Nama !',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Silahkan masukkan Username !'
        ]); 
       

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Silahkan masukkan Password !',
        ]);

        $this->form_validation->set_rules('kontak', 'Kontak', 'required|trim', [
            'required' => 'Silahkan masukkan Kontak !',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Silahkan masukkan Alamat !',
        ]);

        $this->form_validation->set_rules('status','Status','required|callback_validasi_status');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_sales/edit_sales', $v_data);
            $this->load->view('templates/footer');

        }
        else{
            $v_nama     = $this->input->post('nama');
            $username_input = $this->input->post('username');
            $v_password = $this->input->post('password');
            $v_kontak = $this->input->post('kontak');
            $v_alamat = $this->input->post('alamat');
            $v_status = $this->input->post('status');
            $upload_foto = $_FILES['foto']['name'];

            if($this->M_user->cek_username($username_input, $v_id)){
                $this->session->set_flashdata('error', 'Gagal mengubah! Username telah terdaftar!');
                redirect("admin/edit_sales/".$hai);

            }
            else{

                if($upload_foto){
                
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']     = '5000';
                    $config['upload_path'] = './assets/foto/user/';
                        
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('foto')){
                        $v_nama_foto = $this->upload->data('file_name');
    
                        $v_foto_lama = $v_data['data_detail']['user_foto'];
                        
                        if($v_foto_lama != 'default.jpg'){
                            unlink(FCPATH . 'assets/foto/user/' . $v_foto_lama);
                        }
                        
                        $v_data = [
                            'user_id_status' => $v_status,
                            'user_nama' => $v_nama,
                            'user_username' => $username_input,
                            'user_password' => $v_password,
                            'user_kontak' => $v_kontak,
                            'user_alamat' => $v_alamat,
                            'user_foto' => $v_nama_foto,
                            'last_updated' => date('Y-m-d')
                        ];
                    }
                    else
                    {
                        echo $this->upload->display_errors();
                    }
    
                }else{
                    $v_data = [
                        'user_id_status' => $v_status,
                        'user_nama' => $v_nama,
                        'user_username' => $username_input,
                        'user_password' => $v_password,
                        'user_kontak' => $v_kontak,
                        'user_alamat' => $v_alamat,
                        'last_updated' => date('Y-m-d')
                    ];
                }
                $this->M_user->edit_sales($v_id, $v_data);
                $this->session->set_flashdata('pesan', 'Akun sales berhasil diubah!');
                redirect('admin/detail_sales/'.$hai);
            }  
        }


    }


    public function editpas_riwayat_sales($v_id){
        $data = encrypt_url($v_id);
        redirect(base_url().'admin/edit_riwayat_sales/'.$data);
    }

    public function edit_riwayat_sales($hai){
        $v_id = decrypt_url($hai);
        $v_data['title'] = 'Edit riwayat sales';

        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);
        $v_data['data_detail'] = $this->M_main->select_main_byid($v_id);     
        $v_data['list_rute'] = $this->M_rute->select_rute();
        $v_data['list_toko'] = $this->M_toko->select_by_rute($v_data['data_detail']['main_id_rute']);

       $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Silahkan pilih Tanggal!',
        ]);

        $this->form_validation->set_rules('rute','Rute','required|callback_validasi_rute');


        $this->form_validation->set_rules('toko','Toko','required|callback_validasi_toko');
         $this->form_validation->set_rules('harga_sepray', 'Harga_sepray', 'required|trim', [
            'required' => 'Silahkan masukkan Harga !',
        ]);
        $this->form_validation->set_rules('harga_roll', 'Harga_roll', 'required|trim', [
            'required' => 'Silahkan masukkan Harga !',
        ]);


        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $v_data);
            $this->load->view('templates/topbar', $v_data);
            $this->load->view('templates/sidebar_admin', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('v_sales/edit_riwayat', $v_data);
            $this->load->view('templates/footer');

        }
        else{
            $v_tanggal     = $this->input->post('tanggal');
            $v_id_sales     = $this->input->post('id_sales');
            $v_rute = $this->input->post('rute');
            $v_toko = $this->input->post('toko');
            $v_sepray = $this->input->post('sepray');
            $v_roll = $this->input->post('roll');
            $v_harga_sepray = $this->input->post('harga_sepray');
            $v_harga_roll = $this->input->post('harga_roll');
            $v_bonus_sepray = $this->input->post('bonus_sepray');
            $v_bonus_roll = $this->input->post('bonus_roll');
            
           
                $v_data = [
                    'main_id_rute' => $v_rute,
                    'main_id_toko' => $v_toko,
                    'main_waktu_mulai' => $v_tanggal,
                    'main_stok_sepray' => $v_sepray,
                    'main_stok_roll' => $v_roll,
                    'main_stok_total' => $v_roll + $v_sepray,
                    'main_harga_sepray' => $v_harga_sepray,
                    'main_harga_roll' => $v_harga_roll,
                    'main_bonus_sepray' => $v_bonus_sepray,
                    'main_bonus_roll' => $v_bonus_roll,
                    'main_jumlah_sepray' => $v_sepray * $v_harga_sepray,
                    'main_jumlah_roll' => $v_roll * $v_harga_roll
                ];
           

            $this->M_main->edit_main($v_id, $v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect("admin/detail_sales/".encrypt_url($v_id_sales));

        }
    }

// DETAIL

    public function detail_toko($hai){
        $v_id = decrypt_url($hai);

        $v_data['title'] = 'Detail toko';
        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);


        $v_data['data_detail'] = $this->M_toko->get_by_id($v_id);
        
        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_toko/detail_toko', $v_data);
        $this->load->view('templates/footer');


    }


    public function detail_sales($hai){
        $v_id = decrypt_url($hai);

        $v_data['title'] = 'Detail sales';
        $v_id_username = $this->session->userdata('id_username');
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);
        $v_data['data_detail'] = $this->M_user->get_pengguna($v_id);
        
        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_sales/detail_sales', $v_data);
        $this->load->view('templates/footer');
    
    }


// SAMPAH



    public function transaksi (){
        $v_data['title'] = 'Sampah';
        $v_id_username = $this->session->userdata('id_username'); 
        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_admin', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('v_sampah/transaksi', $v_data);
        $this->load->view('templates/footer');
    }

}