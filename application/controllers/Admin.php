<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

//PENGELUARAN



public function index(){

        $v_data['is_aktif'] = 'keluar';

        $list_data_bidang = $this->M_read->get_bidang();
        $data_bidang = '';
         if($list_data_bidang->num_rows() > 0)
        {
            foreach($list_data_bidang->result() as $row)
            {
                $data_bidang .= '
                    <option value="'.$row->id_bidang.'">'.$row->nama_bidang.'</option>
                '; 
            }  
        }


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
              <option value=""> -- Pilih tahun pemasukan -- </option>
              '.$data_tahun.'
            </select>
          </div>
          <button class="btn btn-primary" onclick="button_filter(\''."1".'\')">Filter Data</button>
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
                $v_data['isi_konten'] .= '
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

              $v_data['isi_konten'] .= '
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

       $v_data['isi_konten']  .= ' 
           </table>
       ';


        $this->load->view('templates/header_admin',$v_data);
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_admin');         
    }


    public function tambah_keluar(){
        $v_data['is_aktif'] = 'keluar';

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


        $this->form_validation->set_rules('bidang','Bidang','required|callback_validasi_option');
        $this->form_validation->set_rules('sub_bidang','Sub_bidang','required|callback_validasi_option');

        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('kode_rekening', 'Kode_rekening', 'required|trim', [
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
            $this->load->view('tambah_keluar',$v_data);
            $this->load->view('templates/footer_admin');    
        }
        else{
            $v_bidang = $this->input->post('bidang');
            $v_sub_bidang = $this->input->post('sub_bidang');
            $v_rincian = $this->input->post('rincian');
            $v_kode_rekening = $this->input->post('kode_rekening');
            $v_tahun     = $this->input->post('tahun');
            $v_jumlah = $this->input->post('jumlah');
            
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
            redirect('admin/');

        }
    }



    public function edit_keluar($id){

        $v_id = decrypt_url($id);

        $v_data['is_aktif'] = 'keluar';

        $v_data['data_edit'] = $this->M_read->get_keluar_by_id($v_id);

        $list_data_bidang = $this->M_read->get_bidang();
        $v_data['isi_bidang'] = '<option value=""> -- Pilih bidang -- </option>';
         if($list_data_bidang->num_rows() > 0)
        {
            foreach($list_data_bidang->result() as $row)
            {
                if ($row->id_bidang == $v_data['data_edit']['id_bidang_keluar']) {
                     $v_data['isi_bidang'] .= '
                        <option value="'.$row->id_bidang.'" selected>'.$row->nama_bidang.'</option>
                    '; 
                }else{
                    $v_data['isi_bidang'] .= '
                        <option value="'.$row->id_bidang.'">'.$row->nama_bidang.'</option>
                    '; 
                }
            }  
        }

        $list_data_subbidang = $this->M_read->get_subbidang_by_bidang($v_data['data_edit']['id_bidang_keluar']);
        $v_data['isi_subbidang'] = '';

        foreach ($list_data_subbidang as $row){
            if ($row['sub_id'] == $v_data['data_edit']['id_subbidang_keluar']) {
                 $v_data['isi_subbidang'] .='<option selected value="'.$row['sub_id'].'">'.$row['sub_nama'].'</option>';
            }else{
                $v_data['isi_subbidang'] .= '<option value="'.$row['sub_id'].'">'.$row['sub_nama'].'</option>';
            }
        }

        $this->form_validation->set_rules('bidang','Bidang','required|callback_validasi_option');
        $this->form_validation->set_rules('sub_bidang','Sub_bidang','required|callback_validasi_option');

        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('kode_rekening', 'Kode_rekening', 'required|trim', [
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
            $this->load->view('edit_keluar',$v_data);
            $this->load->view('templates/footer_admin');    
        }
        else{

            $v_bidang = $this->input->post('bidang');
            $v_sub_bidang = $this->input->post('sub_bidang');
            $v_rincian = $this->input->post('rincian');
            $v_kode_rekening = $this->input->post('kode_rekening');
            $v_tahun     = $this->input->post('tahun');
            $v_jumlah = $this->input->post('jumlah');
            
            $v_data = [
                'rekening_keluar' => $v_kode_rekening,
                'jumlah_keluar' => $v_jumlah,
                'rincian_keluar' => $v_rincian,
                'tahun_keluar' => $v_tahun,
                'id_bidang_keluar' => $v_bidang,
                'id_subbidang_keluar' => $v_sub_bidang
            ];

            $this->M_update->edit_keluar($v_data,$v_id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
            redirect('admin/');

        }


    }

    public function hapus_keluar($id){
        $v_id = decrypt_url($id);
        $this->M_delete->delete_keluar($v_id);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('admin/');
    }  



// PEMASUKAN


    public function tambah_masuk(){
        $v_data['is_aktif'] = 'masuk';

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

        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('kode_rekening', 'Kode_rekening', 'required|trim', [
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
                    <th>Sumber Pemasukan</th>
                    <th>Jenis Sumber Pemasukan</th>
                    <th>Rincian</th>
                    <th>Kode Rekening</th>
                    <th>Jumlah (Rp.)</th>
                    <th>Tahun Pemasukan</th>
                    <th>Aksi</th>
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
                        <td>
                            <button onclick="button_edit(\''."1".'\', \''.encrypt_url($row->id_masuk).'\')"><i class="fas fa-edit"></i>Edit</button>
                            <button onclick="button_hapus(\''."1".'\', \''.encrypt_url($row->id_masuk).'\')"><i class="fa fa-trash"></i>Hapus</button >
                        </td>
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
        $list_data_sumber = $this->M_read->get_sumber();
        $v_data['isi_sumber'] = '<option value=""> -- Pilih sumber -- </option>';
         if($list_data_sumber->num_rows() > 0)
        {
            foreach($list_data_sumber->result() as $row)
            {
                if ($row->sumber_masuk_id == $v_data['data_edit']['id_sumber_masuk']) {
                     $v_data['isi_sumber'] .= '
                        <option selected value="'.$row->sumber_masuk_id.'">'.$row->sumber_masuk_nama.'</option>
                    ';  
                }else{
                    $v_data['isi_sumber'] .= '
                        <option value="'.$row->sumber_masuk_id.'">'.$row->sumber_masuk_nama.'</option>
                    '; 
                }
            }  
        }


        $list_data_jenis = $this->M_read->get_jenis_by_sumber($v_data['data_edit']['id_sumber_masuk']);
        $v_data['isi_jenis'] = '';

        foreach ($list_data_jenis as $row){
            if ($row['jenis_masuk_id'] == $v_data['data_edit']['id_jenis_sumber_masuk']) {
                 $v_data['isi_jenis'] .='<option selected value="'.$row['jenis_masuk_id'].'">'.$row['jenis_nama'].'</option>';
            }else{
                $v_data['isi_jenis'] .= '<option value="'.$row['jenis_masuk_id'].'">'.$row['jenis_nama'].'</option>';
            }
        }


        $this->form_validation->set_rules('sumber','Sumber','required|callback_validasi_option');
        $this->form_validation->set_rules('jenis','Jenis','required|callback_validasi_option');

        $this->form_validation->set_rules('rincian', 'Rincian', 'required|trim', [
            'required' => 'Kolom harus diisi!',
        ]);
       
        $this->form_validation->set_rules('kode_rekening', 'Kode_rekening', 'required|trim', [
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