<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

    public function __construct(){
        parent::__construct();
        cek_login();
    }


function validasi_option($id)
{
    if($id == ""){
        $this->form_validation->set_message('validasi_option', 'Silahkan pilih opsi!');
        return false;
    } else{
        return true;
    }

}


function validasi_rekening_keluar()
{
    $v_kode_rekening = $this->input->post('kode_rekening');
    $v_tahun = $this->input->post('tahun');

    if (!$this->input->post('id')) {
        if ($keluar_check = $this->M_read->cek_kode_rekenening_keluar($v_kode_rekening,$v_tahun)) {
           $this->form_validation->set_message('validasi_rekening_keluar','Kode Rekening ditahun ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;
    }else{
        if ($keluar_check = $this->M_read->cek_kode_rekenening_keluar_e($v_kode_rekening,$v_tahun,$this->input->post('id'))) {
           $this->form_validation->set_message('validasi_rekening_keluar','Kode Rekening ditahun ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;
    }
    
}


function validasi_username()
{
    $v_username = $this->input->post('username');
    $v_id = $this->input->post('user_id');

    if (!$v_id) {
        if ($this->M_read->cek_username_aja($v_username)) {
            $this->form_validation->set_message('validasi_username','Username ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;
    }else {
        if ($this->M_read->cek_username($v_username,$v_id)) {
            $this->form_validation->set_message('validasi_username','Username ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;    
    }

}


function validasi_rekening_masuk()
{
    $v_kode_rekening = $this->input->post('kode_rekening');
    $v_tahun = $this->input->post('tahun');

    if (!$this->input->post('id')) {
        if ($keluar_check = $this->M_read->cek_kode_rekenening_masuk($v_kode_rekening,$v_tahun)) {
           $this->form_validation->set_message('validasi_rekening_masuk','Kode Rekening ditahun ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;
    }else{
        if ($keluar_check = $this->M_read->cek_kode_rekenening_masuk_e($v_kode_rekening,$v_tahun,$this->input->post('id'))) {
           $this->form_validation->set_message('validasi_rekening_masuk','Kode Rekening ditahun ini telah tersedia!');
            return FALSE;   
        }
        return TRUE;
    }
    
}


//PROFILE

    public function profile(){

        $v_data['is_aktif'] = 'pengaturan';
        $v_data['invisible_ttd'] = 'yes';
        $v_id = $this->session->userdata('id_user');

        $v_data['data'] = $this->M_read->get_profile($v_id);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_validasi_username', [
            'required' => 'Kolom harus diisi!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        

        if($this->form_validation->run() == false){
            $this->load->view('templates/header_adm',$v_data);
            $this->load->view('profile/profile',$v_data);
            $this->load->view('templates/footer_adm');      
        }
        else{
            $v_nama = $this->input->post('nama');
            $v_username = $this->input->post('username');
            $v_password = $this->input->post('password');
            $upload_foto = $_FILES['gambar_ttd']['name'];

            if($upload_foto){
                
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5000';
                $config['upload_path'] = './assets/foto/ttd/';
                    
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_ttd')){
                    $v_nama_foto = $this->upload->data('file_name');
                    $v_foto_lama = $v_data['data']['user_ttd'];
                    unlink(FCPATH . 'assets/foto/ttd/' . $v_foto_lama);
                    $v_data = [
                        'user_nama' => $v_nama,
                        'user_username' => $v_username,
                        'user_password' => $v_password,
                        'user_ttd' => $v_nama_foto
                    ];
                }
                else
                {
                    echo $this->upload->display_errors();
                }

            }else{
                $v_data = [
                    'user_nama' => $v_nama,
                    'user_username' => $v_username,
                    'user_password' => $v_password
                ];
            }
            $this->M_update->edit_profile($v_data,$v_id);
            $this->session->set_flashdata('pesan', 'Profile berhasil diubah!');
            redirect('adm/profile');       
        }             
    }



//BERANDA
public function index(){

        $v_data['is_aktif'] = 'beranda';
        $v_data['tahun_charts_keluar'] = $this->M_read->get_tahun_keluar_charts();
        $v_data['jumlah_charts_keluar'] = $this->M_read->get_jumlah_keluar_charts();
        $v_data['tahun_charts_masuk'] = $this->M_read->get_tahun_masuk_charts();
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_masuk_charts();

        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('beranda/beranda',$v_data);
        $this->load->view('templates/footer_adm');
        $this->load->view('templates/charts',$v_data);              
    }



//PENGELUARAN

public function keluar(){

        $v_data['is_aktif'] = 'keluar';
        $list_tahun = $this->M_read->get_tahun_masuk();
        $data_tahun = '';
        if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_masuk.'">'.$row->tahun_masuk.'</option>
                '; 
            }  
        }

        $list_bidang = $this->M_read->get_bidang();
        $data_bidang = '';
        if($list_bidang->num_rows() > 0)
        {
            foreach($list_bidang->result() as $row)
            {
                $data_bidang .= '
                    <option value="'.$row->id_bidang.'">'.$row->nama_bidang.'</option>
                '; 
            }  
        }
        $v_data['isi_card_header'] = '
          <div class="form-group">
          <select class="form-control" id="bidang_filter">
              <option value=""> -- Pilih Bidang -- </option>
              '.$data_bidang.'
            </select>

            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih Tahun -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."2".'\')">Filter Data</button>
        ';



        $list_data = $this->M_read->get_keluar();
        $tot_masuk = $this->M_read->get_tot_masuk();
        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            
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
                        <th colspan="1"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total Pemasukan</th>
                        <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                        <th colspan="1"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Sisa Pemasukan</th>
                        <th style="text-align: center;">Rp. '.number_format($total_selisih,2,',','.').'</th>
                        <th colspan="1"></th>
                    </tr>
                </tfoot>
              ';

        }

       $v_data['isi_konten']  .= ' 
           </table>
       ';


        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('keluar/keluar',$v_data);
        $this->load->view('templates/footer_adm');
        // $this->load->view('templates/charts_keluar',$v_data);         
    }


    public function tambah_keluar(){
        $v_data['is_aktif'] = 'keluar';
        $v_data['form_action'] = 'adm';

        $list_data_bidang = $this->M_read->get_bidang();
        $v_data['isi_bidang'] = '<option value=""> -- Pilih bidang -- </option>';
         if($list_data_bidang->num_rows() > 0)
        {
            foreach($list_data_bidang->result() as $row)
            {
                $v_data['isi_bidang'] .= '
                    <option value="'.$row->id_bidang.'">'.$row->nama_bidang.'</option>
                '; 
            }  
        }

        $list_tahun = $this->M_read->get_tahun_masuk();
        $v_data['data_tahun'] = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $v_data['data_tahun'] .= '
                    <option value="'.$row->tahun_masuk.'" "'.set_select('tahun',  $row->tahun_masuk).'">'.$row->tahun_masuk.'</option>
                '; 
            }  
        }

        $this->form_validation->set_rules('bidang','Bidang','required|callback_validasi_option');
        $this->form_validation->set_rules('sub_bidang','Sub_bidang','required|callback_validasi_option');
        $this->form_validation->set_rules('kode_rekening','Kode_rekening','required|callback_validasi_rekening_keluar');
        $this->form_validation->set_rules('tahun','Tahun','required|callback_validasi_option');

        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header_adm',$v_data);
            $this->load->view('keluar/tambah_keluar',$v_data);
            $this->load->view('templates/footer_adm');    
        }
        else{
            $v_bidang = $this->input->post('bidang');
            $v_sub_bidang = $this->input->post('sub_bidang');
            $v_rincian = $this->input->post('rincian');
            $v_kode_rekening = $this->input->post('kode_rekening');
            $v_tahun     = $this->input->post('tahun');

            $v_jumlah = $this->input->post('jumlah');
            $selisih = $this->M_read->get_selisih_by_tahun($v_tahun);
            if (($selisih - $v_jumlah) < 0 ) {
                $this->session->set_flashdata('error', 'Nominal jumlah pengeluaran melebihi pemasukan tahun ini!');
                redirect('adm/tambah_keluar');
            }
            else{
                $v_data = [
                    'rekening_keluar' => $v_kode_rekening,
                    'jumlah_keluar' => $v_jumlah,
                    'rincian_keluar' => $v_rincian,
                    'tahun_keluar' => $v_tahun,
                    'id_bidang_keluar' => $v_bidang,
                    'id_subbidang_keluar' => $v_sub_bidang
                ];

                $this->M_create->create_keluar($v_data);
                $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
                redirect('adm/keluar');
            }
        }
    }




    public function filter_keluar(){

        $bidang = $this->input->get('bidang');
        $tahun = $this->input->get('tahun');
       
        $v_data['is_aktif'] = 'keluar';

        // $v_data['tahun_charts'] = $this->M_read->get_tahun_keluar_charts();
        // $v_data['jumlah_charts'] = $this->M_read->get_jumlah_keluar_charts();
        $list_tahun = $this->M_read->get_tahun_masuk();
        $data_tahun = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_masuk.'">'.$row->tahun_masuk.'</option>
                '; 
            }  
        }

        $list_bidang = $this->M_read->get_bidang();
        $data_bidang = '';
        if($list_bidang->num_rows() > 0)
        {
            foreach($list_bidang->result() as $row)
            {
                $data_bidang .= '
                    <option value="'.$row->id_bidang.'">'.$row->nama_bidang.'</option>
                '; 
            }  
        }
        $v_data['isi_card_header'] = '
          <div class="form-group">
          <select class="form-control" id="bidang_filter">
              <option value=""> -- Pilih Bidang -- </option>
              '.$data_bidang.'
            </select>

            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih Tahun -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."2".'\')">Filter Data</button>
          <button class="btn btn-success" onclick="button_refresh(\''."2".'\')">Refresh Data</button>
        ';



        $list_data = $this->M_read->get_keluar_by_bidang_tahun($bidang,$tahun);
        $tot_masuk = $this->M_read->get_tot_masuk_by_tahun($tahun);
        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            
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
                        <th colspan="1"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total Pemasukan Tahun '.$tahun.'</th>
                        <th style="text-align: center;">Rp. '.number_format($tot_masuk,2,',','.').'</th>
                        <th colspan="1"></th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: center;">Sisa Pemasukan Tahun '.$tahun.'</th>
                        <th style="text-align: center;">Rp. '.number_format($total_selisih,2,',','.').'</th>
                        <th colspan="1"></th>
                    </tr>
                </tfoot>
              ';
        }

       $v_data['isi_konten']  .= ' 
           </table>
       ';


        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('keluar/keluar',$v_data);
        $this->load->view('templates/footer_adm');
        // $this->load->view('templates/charts_keluar',$v_data);         
    }




// PEMASUKAN


    public function tambah_masuk(){
        $v_data['is_aktif'] = 'masuk';
        $v_data['form_action'] = 'adm';
        $list_data_sumber = $this->M_read->get_sumber();
        $v_data['isi_sumber'] = '<option value=""> -- Pilih sumber -- </option>';
         if($list_data_sumber->num_rows() > 0)
        {
            foreach($list_data_sumber->result() as $row)
            {
                $v_data['isi_sumber'] .= '
                    <option value="'.$row->sumber_masuk_id.'">'.$row->sumber_masuk_nama.'</option>
                '; 
            }  
        }


        $this->form_validation->set_rules('sumber','Sumber','required|callback_validasi_option');
        $this->form_validation->set_rules('jenis','Jenis','required|callback_validasi_option');
        $this->form_validation->set_rules('kode_rekening','Kode_rekening','required|callback_validasi_rekening_masuk');
        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header_adm',$v_data);
            $this->load->view('masuk/tambah_masuk',$v_data);
            $this->load->view('templates/footer_adm');    
        }
        else{
            $v_sumber = $this->input->post('sumber');
            $v_jenis = $this->input->post('jenis');
            $v_rincian = $this->input->post('rincian');
            $v_kode_rekening = $this->input->post('kode_rekening');
            $v_tahun     = $this->input->post('tahun');
            $v_jumlah = $this->input->post('jumlah');
            
            $v_data = [
                'rekening_masuk' => $v_kode_rekening,
                'jumlah_masuk' => $v_jumlah,
                'rincian_masuk' => $v_rincian,
                'tahun_masuk' => $v_tahun,
                'id_sumber_masuk' => $v_sumber,
                'id_jenis_sumber_masuk' => $v_jenis
            ];

            $this->M_create->create_masuk($v_data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('adm/masuk');

        }
    }



    public function masuk(){
        $v_data['is_aktif'] = 'masuk';

        // $v_data['tahun_charts'] = $this->M_read->get_tahun_masuk_charts();
        // $v_data['jumlah_charts'] = $this->M_read->get_jumlah_masuk_charts();
        $list_tahun = $this->M_read->get_tahun_masuk();
        $data_tahun = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_masuk.'">'.$row->tahun_masuk.'</option>
                '; 
            }  
        }


        $list_sumber = $this->M_read->get_sumber();
        $data_sumber = '';
        if($list_sumber->num_rows() > 0)
        {
            foreach($list_sumber->result() as $row)
            {
                $data_sumber .= '
                    <option value="'.$row->sumber_masuk_id.'">'.$row->sumber_masuk_nama.'</option>
                '; 
            }  
        }
        $v_data['isi_card_header'] = '
        <div class="form-group">
          <select class="form-control" id="sumber_filter">
              <option value=""> -- Pilih Sumber -- </option>
              '.$data_sumber.'
            </select>

            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih Tahun -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."1".'\')">Filter Data</button>
        ';


        $list_data = $this->M_read->get_masuk();
        $tot_masuk = $this->M_read->get_tot_masuk();

        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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


        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('masuk/masuk',$v_data);
        $this->load->view('templates/footer_adm');
        // $this->load->view('templates/charts_masuk',$v_data);         
    }


public function filter_masuk(){
        $sumber = $this->input->get('sumber');
        $tahun = $this->input->get('tahun');
       
        $v_data['is_aktif'] = 'masuk';

        $list_tahun = $this->M_read->get_tahun_masuk();
        $data_tahun = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_masuk.'">'.$row->tahun_masuk.'</option>
                '; 
            }  
        }

        $list_sumber = $this->M_read->get_sumber();
        $data_sumber = '';
        if($list_sumber->num_rows() > 0)
        {
            foreach($list_sumber->result() as $row)
            {
                $data_sumber .= '
                    <option value="'.$row->sumber_masuk_id.'">'.$row->sumber_masuk_nama.'</option>
                '; 
            }  
        }
        $v_data['isi_card_header'] = '
        <div class="form-group">
          <select class="form-control" id="sumber_filter">
              <option value=""> -- Pilih Sumber -- </option>
              '.$data_sumber.'
            </select>

            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih Tahun -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."1".'\')">Filter Data</button>
          <button class="btn btn-success" onclick="button_refresh(\''."1".'\')">Refresh Data</button>
        ';


        if(strlen($sumber) != 0 && strlen($tahun) == 0  ){
            $list_data = $this->M_read->get_masuk_by_sumber($sumber);  
        }elseif(strlen($sumber) == 0 && strlen($tahun) != 0  ){
            $list_data = $this->M_read->get_masuk_by_tahun($tahun);  
        }
        else{  
            $list_data = $this->M_read->get_masuk_by_sumber_tahun($sumber,$tahun);
        }


        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
            $tot_masuk=0;
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
                $tot_masuk=$tot_masuk+$row->jumlah_masuk;
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


        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('masuk/masuk',$v_data);
        $this->load->view('templates/footer_adm');
        // $this->load->view('templates/charts_masuk',$v_data);         
    }



//LAPORAN
    public function laporan (){

        $v_data['id'] = $this->input->get('id');
        $v_data['is_aktif'] = 'laporan';

        if ($v_data['id'] == 1) {
            $v_data['judul'] = 'Data Laporan Masuk';
            $list_data = $this->M_read->get_laporan_by_jenis(1);
        }
        else if ($v_data['id'] == 2) {
             $v_data['judul'] = 'Data Laporan Keluar';
             $list_data = $this->M_read->get_laporan_by_jenis(2);
        }else{
            redirect('blocked');
        }
               
        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Tahun</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Tanggal Pengajuan</th>
                    <th colspan="2" style="vertical-align : middle;text-align:center;">Kepala Desa</th>
                    <th colspan="2" style="vertical-align : middle;text-align:center;">Sekretaris</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Aksi</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th>Status TTD</th>
                    <th>Nama</th>
                    <th>Status TTD</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            foreach($list_data->result() as $row)
            {
                if($row->laporan_status_kepala == 1) {
                     $status_kepala = '<span class="btn btn-success btn-sm">Disetujui</span>';
                }else{
                    $status_kepala = '<span class="btn btn-warning btn-sm">Menunggu</span>';
                }

                if($row->laporan_status_sekretaris == 1) {
                     $status_sekretaris = "<span class='btn btn-success btn-sm'>Disetujui</span>";
                }else{
                    $status_sekretaris = '<span class="btn btn-warning btn-sm">Menunggu</span>';
                }

                if ($row->laporan_status_kepala == 2 || $row->laporan_status_sekretaris == 2) {
                    $button_cetak = '<span class="btn btn-warning btn-sm">Menunggu</span>';
                }else {
                    $button_cetak = '<button class="btn btn-success btn-sm" onclick="button_cetak_laporan(\''.encrypt_url($row->laporan_id).'\')"><i class="fas fa-download"></i> Cetak</button>';
                }
                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->laporan_tahun.'</td>
                        <td>'.$row->laporan_created.'</td>
                        <td>'.$row->nama_kepala.'</td>
                        <td>'.$status_kepala.'</td>
                        <td>'.$row->nama_sekretaris.'</td>
                        <td>'.$status_sekretaris.'</td>
                        <td>'.$button_cetak.'</td>
                    </tr>

                '; 
                $index++;
            }   
        }

       $v_data['isi_konten']  .= ' 
            </tbody>
           </table>
       ';

        $this->load->view('templates/header_adm',$v_data);
        $this->load->view('laporan/laporan',$v_data);
        $this->load->view('templates/footer_adm',$v_data);

    }



    public function tambah_laporan(){

        $v_jenis = $this->input->post('modal_jenis_laporan');
        $v_tahun = $this->input->post('modal_tahun');
        $v_kepala = $this->input->post('modal_kepala');
        $v_sekretaris = $this->input->post('modal_sekretaris');

        $v_data = [
            'laporan_jenis' => $v_jenis,
            'laporan_tahun' => $v_tahun,
            'laporan_user_id_kepala' => $v_kepala,
            'laporan_user_id_sekretaris' => $v_sekretaris,
            'laporan_status_kepala' => 2,
            'laporan_status_sekretaris' => 2,
            'laporan_created' => date("d-m-Y")
        ];

        $this->M_create->create_laporan($v_data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
        redirect(base_url()."adm/laporan?id=".$v_jenis); 
    }





}   