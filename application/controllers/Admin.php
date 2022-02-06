<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        cek_login();
    }



//PENGELUARAN


public function index(){
        $v_data['is_aktif'] = 'keluar';

        $list_data = $this->M_read->get_keluar();
        $tot_masuk = $this->M_read->get_tot_masuk();

        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Tujuan Pengeluaran</th>
                    <th>Tahun Pengeluaran</th>
                    <th>Jumlah (Rp.)</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            $total_pengeluaran = 0;
            foreach($list_data->result() as $row)
            {
                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->jenis_keluar.'</td>
                        <td>'.$row->tujuan_keluar.'</td>
                        <td>'.$row->tahun_keluar.'</td>
                        <td>'.number_format($row->jumlah_keluar,2,',','.').'</td>
                        <td><button onclick="button_edit(\''."1".'\', \''.encrypt_url($row->id_keluar).'\')"><i class="fas fa-edit"></i></button></td>
                        <td><button onclick="button_hapus(\''."1".'\', \''.encrypt_url($row->id_keluar).'\')"><i class="fa fa-trash"></i></button ></td>
                    </tr>

                '; 
                $index++;
                $total_pengeluaran = $total_pengeluaran + $row->jumlah_keluar;

            }   

            $total_selisih = $tot_masuk - $total_pengeluaran;

              $v_data['isi_konten'] .= '
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: center;">Total Pengeluaran</th>
                        <th style="text-align: center;">Rp. '.number_format($total_pengeluaran,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: center;">Total Pemasukan</th>
                        <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: center;">Total Selisih</th>
                        <th style="text-align: center;">Rp. '.number_format($total_selisih,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
              ';

        }

       $v_data['isi_konten']  .= ' 
           </table>
       ';


        $this->load->view('templates/header_admin',$v_data);
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_admin');         
    }


// PEMASUKAN


    public function tambah_masuk(){
        $v_data['is_aktif'] = 'masuk';

        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('asal', 'Asal', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header_admin',$v_data);
            $this->load->view('tambah_masuk',$v_data);
            $this->load->view('templates/footer_admin');    
        }
        else{
            $v_jenis = $this->input->post('jenis');
            $v_asal = $this->input->post('asal');
            $v_tahun     = $this->input->post('tahun');
            $v_jumlah = $this->input->post('jumlah');
            
            $v_data = [
                'jenis_masuk' => $v_jenis,
                'jumlah_masuk' => $v_jumlah,
                'asal_masuk' => $v_asal,
                'tahun_masuk' => $v_tahun
            ];

            $this->M_create->create_masuk($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/masuk');

        }
    }



    public function masuk(){
        $v_data['is_aktif'] = 'masuk';

        $list_data = $this->M_read->get_masuk();
        $tot_masuk = $this->M_read->get_tot_masuk();

        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pemasukan</th>
                    <th>Asal Pemasukan</th>
                    <th>Tahun Pemasukan</th>
                    <th>Jumlah (Rp.)</th>
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
                        <td>'.number_format($row->jumlah_masuk,2,',','.').'</td>
                        <td><button onclick="button_edit(\''."1".'\', \''.encrypt_url($row->id_masuk).'\')"><i class="fas fa-edit"></i></button></td>
                        <td><button onclick="button_hapus(\''."1".'\', \''.encrypt_url($row->id_masuk).'\')"><i class="fa fa-trash"></i></button ></td>
                    </tr>

                '; 
                $index++;
            }
            $v_data['isi_konten'] .= '
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: center;">Total Pemasukan</th>
                        <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
              ';

        }

       $v_data['isi_konten']  .= ' 
           </table>
       ';



        $this->load->view('templates/header_admin',$v_data);
        $this->load->view('masuk',$v_data);
        $this->load->view('templates/footer_admin');         
    }


    public function edit_masuk($id){

        $v_id = decrypt_url($id);

        $v_data['is_aktif'] = 'masuk';

        $v_data['data_edit'] = $this->M_read->get_masuk_by_id($v_id);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('asal', 'Asal', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);


        if($this->form_validation->run() == false){
            $this->load->view('templates/header_admin',$v_data);
            $this->load->view('edit_masuk',$v_data);
            $this->load->view('templates/footer_admin');    
        }
        else{

            $v_jenis = $this->input->post('jenis');
            $v_asal = $this->input->post('asal');
            $v_tahun     = $this->input->post('tahun');
            $v_jumlah = $this->input->post('jumlah');
            
            $v_data = [
                'jenis_masuk' => $v_jenis,
                'jumlah_masuk' => $v_jumlah,
                'asal_masuk' => $v_asal,
                'tahun_masuk' => $v_tahun
            ];

            $this->M_update->edit_masuk($v_data,$v_id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('admin/masuk');

        }


    }

    public function hapus_masuk($id){
        $v_id = decrypt_url($id);
        $this->M_delete->delete_masuk($v_id);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('admin/masuk');
    }   


}