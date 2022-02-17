<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    
private $link_header = 'dashboard';
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

        $list_tahun = $this->M_read->get_tahun_keluar();
        $data_tahun = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_keluar.'">'.$row->tahun_keluar.'</option>
                '; 
            }  
        }

        $v_data['isi_card_header'] = '
          <div class="form-group">
            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih tahun -- </option>
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
                        <th colspan="5" style="text-align: center;">Total Selisih</th>
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
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_dashboard');    		 
	}


    public function filter_keluar($tahun){

        $v_data['is_aktif'] = 'keluar';

        $list_tahun = $this->M_read->get_tahun_keluar();
        $data_tahun = '';
         if($list_tahun->num_rows() > 0)
        {
            foreach($list_tahun->result() as $row)
            {
                $data_tahun .= '
                    <option value="'.$row->tahun_keluar.'">'.$row->tahun_keluar.'</option>
                '; 
            }  
        }

        $v_data['isi_card_header'] = '
          <div class="form-group">
            <select class="form-control" id="tahun_filter">
              <option value=""> -- Pilih tahun -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."2".'\')">Filter Data</button>
          <button class="btn btn-success" onclick="button_refresh(\''."2".'\')">Refresh Data</button>
        ';


         $list_data = $this->M_read->get_keluar_by_tahun($tahun);
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
                        <th colspan="5" style="text-align: center;">Total Selisih</th>
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
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_dashboard');             
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
        $this->load->view('masuk',$v_data);
        $this->load->view('templates/footer_dashboard');         
    }


    public function login(){
        $v_data['is_aktif'] = 'login';
        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('login',$v_data);
        $this->load->view('templates/footer_dashboard');         
    }





}