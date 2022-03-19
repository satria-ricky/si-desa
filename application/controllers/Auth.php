<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Auth extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }

    public function cetak (){
        $v_id = decrypt_url($this->input->get('id'));

        $v_data['laporan'] = $this->M_read->get_laporan_by_id($v_id);
        $v_data['kepala'] = $this->M_read->get_user_by_id($v_data['laporan']['laporan_user_id_kepala']);
        $v_data['sekretaris'] = $this->M_read->get_user_by_id($v_data['laporan']['laporan_user_id_sekretaris']);

        $v_data['title'] = 'laporan';


        if ($v_data['laporan']['laporan_jenis'] == 1) {
            $v_data['v_jenis_beneran'] = "PEMASUKAN";
            $list_data = $this->M_read->get_masuk_by_tahun($v_data['laporan']['laporan_tahun']);
            $tot_masuk = $this->M_read->get_tot_masuk_by_tahun($v_data['laporan']['laporan_tahun']);

            $v_data['isi_konten'] = '';

            $v_data['isi_konten'] .= '
                <table id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sumber Pemasukan</th>
                        <th>Jenis Sumber Pemasukan</th>
                        <th>Rincian</th>
                        <th>Kode Rekening</th>
                        <th>Jumlah (Rp.)</th>
                        <th>Tahun Pemasukan</th>
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
                            <td>'.$row->sumber_masuk_nama.'</td>
                            <td>'.$row->jenis_nama.'</td>
                            <td>'.$row->rincian_masuk.'</td>
                            <td>'.$row->rekening_masuk.'</td>
                            <td>'.number_format($row->jumlah_masuk,2,',','.').'</td>
                            <td>'.$row->tahun_masuk.'</td>
                        </tr>

                    '; 
                    $index++;
                }
                $v_data['isi_konten'] .= '
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="5" style="text-align: center;">Total Pemasukan</th>
                            <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                            <th colspan="1"></th>
                        </tr>
                    </tfoot>
                  ';

            }

           $v_data['isi_konten']  .= ' 
               </table>
           ';
        }else {

            $v_data['v_jenis_beneran'] = "PENGELUARAN";
            $list_data = $this->M_read->get_keluar_by_tahun($v_data['laporan']['laporan_tahun']);
            $tot_masuk = $this->M_read->get_tot_masuk_by_tahun($v_data['laporan']['laporan_tahun']);
            $v_data['isi_konten'] = '';

            $v_data['isi_konten'] .= '
                
                <table id="table">
                <thead>
                    <tr>
                        <th style="text-align:center">No</th>
                        <th style="text-align:center">Bidang</th>
                        <th style="text-align:center">Sub Bidang</th>
                        <th style="text-align:center">Rincian</th>
                        <th style="text-align:center">Kode Rekening</th>
                        <th style="text-align:center">Jumlah (Rp.)</th>
                        <th style="text-align:center">Tahun</th>
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
                            <td>'.$row->nama_bidang.'</td>
                            <td>'.$row->sub_nama.'</td>
                            <td>'.$row->rincian_keluar.'</td>
                            <td>'.$row->rekening_keluar.'</td>
                            <td>'.number_format($row->jumlah_keluar,2,',','.').'</td>
                            <td>'.$row->tahun_keluar.'</td>
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
                            <th colspan="5" style="text-align: center;">Total Pengeluaran</th>
                            <th style="text-align: center;">Rp. '.number_format($total_pengeluaran,2,',','.').'</th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="text-align: center;">Total Pemasukan Tahun '.$v_data['laporan']['laporan_tahun'].'</th>
                            <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="text-align: center;">Sisa Pemasukan '.$v_data['laporan']['laporan_tahun'].'</th>
                            <th style="text-align: center;">Rp. '.number_format($total_selisih,2,',','.').'</th>
                            <th colspan="1"></th>
                        </tr>
                    </tfoot>
                  ';

            }

           $v_data['isi_konten']  .= ' 
               </table>
           ';

        }
        $ini_html = $this->load->view('laporan/cetak',$v_data, true);
    
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($ini_html);
        $mpdf->Output();

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

    public function get_kepala(){
        $v_data = $this->M_read->get_user_by_level(3)->result_array();
        $output = '<option value="">-- Pilih Kepala Desa --</option>';
        foreach ($v_data as $row){
            $output .= '<option value="'.$row['user_id'].'">'.$row['user_nama'].'</option>';
        }
        echo json_encode($output);
    }

    public function get_sekretaris(){
        $v_data = $this->M_read->get_user_by_level(4)->result_array();
        $output = '<option value="">-- Pilih Sekretaris --</option>';
        foreach ($v_data as $row){
            $output .= '<option value="'.$row['user_id'].'">'.$row['user_nama'].'</option>';
        }
        echo json_encode($output);
    }


    public function get_tahun(){
        $v_data = $this->M_read->get_tahun_charts();
        echo json_encode($v_data);
    }

    public function get_tahun_modal(){
        $jenis = $this->input->post('id');
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
                redirect('adm');
            }elseif ($this->session->userdata('level_user') == 3 || $this->session->userdata('level_user') == 4){
                redirect('dashboard');
            }
            else{
                redirect('masyarakat');
            }
        }
        // else{
        //     redirect('masyarakat');
        // }
        
        // $this->load->view('masyarakat');
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
        redirect('masyarakat');
    }


}