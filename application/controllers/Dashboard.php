<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        cek_login();
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



    //PROFILE

    public function profile(){

        $v_data['is_aktif'] = 'pengaturan';
        $v_data['invisible_ttd'] = 'no';
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
            $this->load->view('templates/header_dashboard',$v_data);
            $this->load->view('profile/profile',$v_data);
            $this->load->view('templates/footer_dashboard');      
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
            redirect('dashboard/profile');       
        }             
    }

    public function index(){

        $v_data['is_aktif'] = 'beranda';
        $v_data['tahun_charts_keluar'] = $this->M_read->get_tahun_keluar_charts();
        $v_data['jumlah_charts_keluar'] = $this->M_read->get_jumlah_keluar_charts();
        $v_data['tahun_charts_masuk'] = $this->M_read->get_tahun_masuk_charts();
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_masuk_charts();

        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('beranda/beranda',$v_data);
        $this->load->view('templates/footer_dashboard');
        $this->load->view('templates/charts',$v_data);              
    }


    public function keluar(){

        $v_data['is_aktif'] = 'keluar';
        $v_data['sumber_masuk'] = $this->M_read->get_bidang_chart();
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_keluar_charts_subbidang();
        $v_data['isi_diagram'] = '
            <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                <div style="width: 1900px; height: 300px">
                  <canvas id="bar_diagram_keluar" height="300" width="0"></canvas>
                </div>
            </div>
        ';


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

        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('keluar/keluar',$v_data);
        $this->load->view('templates/footer_dashboard'); 
        $this->load->view('templates/charts_laporan_keluar',$v_data);    		 
	}


    public function filter_keluar(){

        $bidang = $this->input->get('bidang');
        $tahun = $this->input->get('tahun');
        $v_data['sumber_masuk'] = $this->M_read->get_subbidang_chart($bidang);
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_keluar_charts_subbidang_by($bidang);
        $v_data['isi_diagram'] = '
            <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                <div style="width: 2000px; height: 300px">
                  <canvas id="bar_diagram_keluar" height="300" width="0"></canvas>
                </div>
            </div>
        ';
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

        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('keluar/keluar',$v_data);
        $this->load->view('templates/footer_dashboard');
        $this->load->view('templates/charts_laporan_keluar',$v_data);             
    }



    public function masuk(){
        
        $v_data['is_aktif'] = 'masuk';
        $list_tahun = $this->M_read->get_tahun_masuk();

        $v_data['sumber_masuk'] = $this->M_read->get_sumber_chart();
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_masuk_charts_sumber_masuk();
        $v_data['isi_diagram'] = '
            <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                <div style="width: 500px; height: 300px">
                  <canvas id="bar_diagram_masuk" height="300" width="0"></canvas>
                </div>
            </div>
        ';



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


        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('masuk/masuk',$v_data);
        $this->load->view('templates/footer_dashboard');
        $this->load->view('templates/charts_laporan_masuk',$v_data);             
    }


    
    public function filter_masuk(){
        $sumber = $this->input->get('sumber');
        $tahun = $this->input->get('tahun');
       
        $v_data['is_aktif'] = 'masuk';

        $v_data['sumber_masuk'] = $this->M_read->get_jenis_chart($sumber);
        $v_data['jumlah_charts_masuk'] = $this->M_read->get_jumlah_masuk_charts_sumber_masuk_by($sumber);
        $v_data['isi_diagram'] = '
            <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                <div style="width: 1000px; height: 300px">
                  <canvas id="bar_diagram_masuk" height="300" width="0"></canvas>
                </div>
            </div>
        ';


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


        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('masuk/masuk',$v_data);
        $this->load->view('templates/footer_dashboard');
        $this->load->view('templates/charts_laporan_masuk',$v_data);   
    }


    public function laporan_masuk (){

        $v_data['is_aktif'] = 'laporan';
        $v_data['judul'] = 'Data Laporan Masuk';

        if ($this->session->userdata('level_user') == 3) {
            $list_data = $this->M_read->get_laporan_by_jenis_kepala_masuk($this->session->userdata('id_user'));
           
        }elseif ($this->session->userdata('level_user') == 4) {
            $list_data = $this->M_read->get_laporan_by_jenis_sekretaris_masuk($this->session->userdata('id_user'));
        }

        
               
        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="vertical-align : middle;text-align:center;">No</th>
                    <th style="vertical-align : middle;text-align:center;">Tahun</th>
                    <th style="vertical-align : middle;text-align:center;">Nama Laporan</th>
                    <th style="vertical-align : middle;text-align:center;">Tanggal Pengajuan</th>
                    <th style="vertical-align : middle;text-align:center;">Status Laporan</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            foreach($list_data->result() as $row)
            {   
                $button_acc ='';
                $button_acc .= '
                    <button class="btn btn-info btn-sm" onclick="button_cetak_laporan(\''.encrypt_url($row->laporan_id).'\')">Lihat laporan</button >
                ';
                    

                    if ($this->session->userdata('level_user') == 3) {
                        if($row->laporan_status_kepala == 1) {
                            $button_acc .= '
                                <span class="btn btn-success btn-sm">Disetujui</span>
                            ';
                        }else{
                            $button_acc .= '
                                <button class="btn btn-warning btn-sm" onclick="button_setujui_laporan(\''.encrypt_url($row->laporan_id).'\')">Menunggu</button >
                                ';
                        }
                    }elseif ($this->session->userdata('level_user') == 4) {
                        if($row->laporan_status_sekretaris == 1) {
                            $button_acc .= '
                                <span class="btn btn-success btn-sm">Disetujui</span>
                            ';
                        }else{
                            $button_acc .= '
                                <button class="btn btn-warning btn-sm" onclick="button_setujui_laporan(\''.encrypt_url($row->laporan_id).'\')">Menunggu</button >
                                ';
                        }
                    }

                   

                    if ($row->laporan_jenis == 1) {
                        $nama_laporan = 'Laporan Pemasukan';
                    }else {
                        $nama_laporan = 'Laporan Pengeluaran';
                    }
                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->laporan_tahun.'</td>
                        <td> Laporan Pemasukan</td>
                        <td>'.$row->laporan_created.'</td>
                        <td>'.$button_acc.'</td>
                    </tr>

                '; 
                $index++;
            }   
        }

       $v_data['isi_konten']  .= ' 
            </tbody>
           </table>
       ';

        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('laporan/laporan',$v_data);
        $this->load->view('templates/footer_dashboard',$v_data);

    }


     public function laporan_keluar (){

        $v_data['is_aktif'] = 'laporan';
        $v_data['judul'] = 'Data Laporan Keluar';

        if ($this->session->userdata('level_user') == 3) {
            $list_data = $this->M_read->get_laporan_by_jenis_kepala_keluar($this->session->userdata('id_user'));
           
        }elseif ($this->session->userdata('level_user') == 4) {
            $list_data = $this->M_read->get_laporan_by_jenis_sekretaris_keluar($this->session->userdata('id_user'));
        }

               
        $v_data['isi_konten'] = '';

        $v_data['isi_konten'] .= '
            
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="vertical-align : middle;text-align:center;">No</th>
                    <th style="vertical-align : middle;text-align:center;">Tahun</th>
                    <th style="vertical-align : middle;text-align:center;">Nama Bidang</th>
                    <th style="vertical-align : middle;text-align:center;">Tanggal Pengajuan</th>
                    <th style="vertical-align : middle;text-align:center;">Status Laporan</th>
                </tr>
            </thead>
            <tbody>
        ';
    
        if($list_data->num_rows() > 0)
        {
            $index=1;
            foreach($list_data->result() as $row)
            {   
                $button_acc ='';
                $button_acc .= '
                    <button class="btn btn-info btn-sm" onclick="button_cetak_laporan(\''.encrypt_url($row->laporan_id).'\')">Lihat laporan</button >
                ';
                               
                    if ($this->session->userdata('level_user') == 3) {
                        if($row->laporan_status_kepala == 1) {
                            $button_acc .= '
                                <span class="btn btn-success btn-sm">Disetujui</span>
                            ';
                        }else{
                            $button_acc .= '
                                <button class="btn btn-warning btn-sm" onclick="button_setujui_laporan(\''.encrypt_url($row->laporan_id).'\')">Menunggu</button >
                                ';
                        }
                    }elseif ($this->session->userdata('level_user') == 4) {
                        if($row->laporan_status_sekretaris == 1) {
                            $button_acc .= '
                                <span class="btn btn-success btn-sm">Disetujui</span>
                            ';
                        }else{
                            $button_acc .= '
                                <button class="btn btn-warning btn-sm" onclick="button_setujui_laporan(\''.encrypt_url($row->laporan_id).'\')">Menunggu</button >
                                ';
                        }
                    }


                $v_data['isi_konten'] .= '
                    <tr>
                        <td>'. $index.'</td>
                        <td>'.$row->laporan_tahun.'</td>
                        <td> Laporan Pengeluaran </td>
                        <td>'.$row->laporan_created.'</td>
                        <td>'.$button_acc.'</td>
                    </tr>

                '; 
                $index++;
            }   
        }

       $v_data['isi_konten']  .= ' 
            </tbody>
           </table>
       ';

        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('laporan/laporan',$v_data);
        $this->load->view('templates/footer_dashboard',$v_data);

    }



    public function acc_laporan(){

        $laporan = decrypt_url($this->input->get('laporan'));
        $v_jenis = $this->M_read->get_laporan_by_id($laporan);
        if ($this->session->userdata('level_user') == 3) {
            $v_data = [
                'laporan_status_kepala' => 1,
                'laporan_acc' => date("d-m-Y")
            ];
           
        }elseif ($this->session->userdata('level_user') == 4) {
            $v_data = [
                'laporan_status_sekretaris' => 1
            ];
        }


        $this->M_update->edit_laporan($v_data,$laporan);
        
        $this->session->set_flashdata('pesan', 'Laporan berhasil disetujui!');
        if ($v_jenis['laporan_jenis'] == 1) {
            redirect(base_url()."dashboard/laporan_masuk");
        }elseif($v_jenis['laporan_jenis'] == 2){
            redirect(base_url()."dashboard/laporan_keluar");
        }

               
    }             
    

}