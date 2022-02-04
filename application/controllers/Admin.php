<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        cek_login();
    }

public function index(){
        $v_data['is_aktif'] = 'keluar';

        $list_data = $this->M_read->get_keluar();

        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Tujuan Pengeluaran</th>
                    <th>Tahun Pengeluaran</th>
                    <th>Jumlah</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            foreach($list_data->result() as $row)
            {
                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->jenis_keluar.'</td>
                        <td>'.$row->tujuan_keluar.'</td>
                        <td>'.$row->tahun_keluar.'</td>
                        <td>'.$row->jumlah_keluar.'</td>
                        <td><a onclick="editB('.$row->id_keluar.')"><i class="fa fa-pencil"></i> Edit</a></td>
                        <td><a onclick="editB('.$row->id_keluar.')"><i class="fa fa-trash"></i> Hapus</a></td>
                        
                        </td>
                    </tr>

                '; 
                $index++;
            }
        }

       $v_data['isi_konten']  .= ' 
           </tbody>
           </table>
       ';


        $this->load->view('templates/header_admin',$v_data);
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_admin');         
    }



    public function masuk(){
        $v_data['is_aktif'] = 'masuk';

        $list_data = $this->M_read->get_masuk();

        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pemasukan</th>
                    <th>Asal Pemasukan</th>
                    <th>Tahun Pemasukan</th>
                    <th>Jumlah</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            foreach($list_data->result() as $row)
            {
                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->jenis_masuk.'</td>
                        <td>'.$row->asal_masuk.'</td>
                        <td>'.$row->tahun_masuk.'</td>
                        <td>'.$row->jumlah_masuk.'</td>
                        <td><a onclick="editB('.$row->id_masuk.')"><i class="fa fa-pencil"></i> Edit</a></td>
                        <td><a onclick="editB('.$row->id_masuk.')"><i class="fa fa-trash"></i> Hapus</a></td>
                        
                        </td>
                    </tr>

                '; 
                $index++;
            }
        }

       $v_data['isi_konten']  .= ' 
           </tbody>
           </table>
       ';


        $this->load->view('templates/header_admin',$v_data);
        $this->load->view('masuk',$v_data);
        $this->load->view('templates/footer_admin');         
    }


// TAMBAH

    public function tambah_masuk(){
        $v_data['is_aktif'] = 'masuk';

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
            $this->load->view('templates/header_admin',$v_data);
            $this->load->view('tambah_masuk',$v_data);
            $this->load->view('templates/footer_admin');    
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



}