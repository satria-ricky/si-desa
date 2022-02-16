<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }



    
    public function get_filter(){
        $tahun = $this->input->post('tahun');

        $list_data = $this->M_read->get_keluar_by_tahun($tahun);
        $v_data = '';

        $v_data .= '
            
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bidang</th>
                    <th>Sub Bidang</th>
                    <th>Rincian</th>
                    <th>Kode Rekening</th>
                    <th>Jumlah (Rp.)</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
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
                $v_data .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->nama_bidang.'</td>
                        <td>'.$row->sub_nama.'</td>
                        <td>'.$row->rincian_keluar.'</td>
                        <td>'.$row->rekening_keluar.'</td>
                        <td>'.number_format($row->jumlah_keluar,2,',','.').'</td>
                        <td>'.$row->tahun_keluar.'</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="button_edit(\''."2".'\', \''.encrypt_url($row->id_keluar).'\')"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="button_hapus(\''."2".'\', \''.encrypt_url($row->id_keluar).'\')"><i class="fa fa-trash"></i> Hapus</button >
                        </td>
                    </tr>

                '; 
                $index++;
                $total_pengeluaran = $total_pengeluaran + $row->jumlah_keluar;

            }   

            $total_selisih = $tot_masuk - $total_pengeluaran;

              $v_data .= '
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total Pengeluaran</th>
                        <th style="text-align: center;">Rp. '.number_format($total_pengeluaran,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total Pemasukan</th>
                        <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total Selisih</th>
                        <th style="text-align: center;">Rp. '.number_format($total_selisih,2,',','.').'</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
              ';

        }

       $v_data  .= ' 
           </table>
       ';

        echo json_encode($tahun);
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