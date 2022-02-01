<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sales extends CI_Controller {

    public function __construct(){
        parent::__construct();
        cek_login();
        if ($this->session->userdata('id_level') != 2) {
            redirect('blocked');
        }
    }


    function validasi_rute($id)
    {
        
        if($id == ""){
            $this->form_validation->set_message('validasi_rute', 'Pilih Rute!');
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



//PROFILE
    public function profile (){
        $v_data['title'] = 'Profile';

        $v_id_username = $this->session->userdata('id_username'); 

        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_sales', $v_data);
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
            $this->load->view('templates/sidebar_sales', $v_data);
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
                redirect('sales/edit_profile');

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
                redirect('sales/profile');

            }            
        }
    }


//KERJA

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



    public function tambah_kerja(){

        $v_data['title'] = 'Tambah Kerja';

        $v_id_username = $this->session->userdata('id_username'); 

        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

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
            $this->load->view('templates/sidebar_sales', $v_data);
            $this->load->view('templates/load_template_footer');
            $this->load->view('sales/kerja/tambah_kerja',$v_data);
            $this->load->view('templates/footer');
        }
        else{
            $v_rute = $this->input->post('rute');
            $v_toko = $this->input->post('toko');
            $v_sepray = $this->input->post('sepray');
            $v_roll = $this->input->post('roll');
            $v_harga_sepray = $this->input->post('harga_sepray');
            $v_harga_roll = $this->input->post('harga_roll');
            $v_bonus_sepray = $this->input->post('bonus_sepray');
            $v_bonus_roll = $this->input->post('bonus_roll');
            
            $totsepray = $v_sepray + $v_bonus_sepray;
            $totroll = $v_roll + $v_bonus_roll;

            $this->produk_induk($totsepray,$totroll,2);


            $v_data = [
                'main_id_rute' => $v_rute,
                'main_id_status' => 1,
                'main_id_toko' => $v_toko,
                'main_id_sales' => $v_id_username,
                'main_waktu_mulai' => date("Y-m-d"),
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
           

            $data_main =  $this->M_main->create_main($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('sales/tambah_kerja');

        }

    }


//RIWAYAT
    public function riwayat (){
        $v_data['title'] = 'Riwayat';

        $v_id_username = $this->session->userdata('id_username'); 

        $v_data['data_pengguna'] = $this->M_user->get_pengguna($v_id_username);

        $this->load->view('templates/header', $v_data);
        $this->load->view('templates/topbar', $v_data);
        $this->load->view('templates/sidebar_sales', $v_data);
        $this->load->view('templates/load_template_footer');
        $this->load->view('sales/riwayat/riwayat',$v_data);
        $this->load->view('templates/footer');
    
    }


}