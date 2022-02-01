<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    

    public function get_masuk_by_id(){
        $v_id = $this->input->get('id');

        $data = $this->M_produk->select_pm_by_id($v_id);

        echo json_encode($data);

    }

    public function get_masuk(){
        $v_tanggal1 = $this->input->post('tanggal1');
        $v_tanggal2 = $this->input->post('tanggal2');

        if(strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_produk->select_pm_by_tanggal($v_tanggal1,$v_tanggal2);  
        }else{  
            $data = $this->M_produk->select_all_pm();
        }

        echo json_encode($data);

    }


    public function get_main(){
        $v_id_sales = $this->input->post('id_sales');
        $v_tanggal1 = $this->input->post('tanggal1');
        $v_tanggal2 = $this->input->post('tanggal2');
        $v_id_rute = $this->input->post('id_rute');
        $v_id_toko = $this->input->post('id_toko');


    
        if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ){
            $data = $this->M_main->select_main();
        }
        //SALES
        else if ( strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ) {
            $data = $this->M_main->select_main_by_sales($v_id_sales);
        } 
        else if (strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0) {
            $data = $this->M_main->select_main_by_tanggal($v_id_sales,$v_tanggal1,$v_tanggal2);
        }
        else if( strlen($v_id_sales) != 0 && strlen($v_id_rute) != 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0 ){  
            $data = $this->M_main->select_main_by_without_toko($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute);
        }
        //TOKO
        else if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ) {
            $data = $this->M_main->select_main_by_toko($v_id_toko);
        }
        else if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ) {
            $data = $this->M_main->select_main_by_tanggal_dan_toko($v_tanggal1,$v_tanggal2,$v_id_toko);
        }
        else if ( strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ) {
            $data = $this->M_main->select_main_by_without_rute($v_id_toko,$v_tanggal1,$v_tanggal2,$v_id_sales);
        }
        //ALL
        else if( strlen($v_id_rute) != 0 && strlen($v_id_toko) != 0  && strlen($v_id_sales) != 0 && strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_main->select_main_by_all_kondisi($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute,$v_id_toko);  
        }
        //TANGGAL AJA
        else if( strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  && strlen($v_id_sales) == 0 && strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_main->select_main_by_tanggal_saja($v_tanggal1,$v_tanggal2);  
        }
        

        echo json_encode($data);

    }



    public function get_sampah_transaksi(){
        $v_id_sales = $this->input->post('id_sales');
        $v_tanggal1 = $this->input->post('tanggal1');
        $v_tanggal2 = $this->input->post('tanggal2');
        $v_id_rute = $this->input->post('id_rute');
        $v_id_toko = $this->input->post('id_toko');


    
        if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ){
            $data = $this->M_main->select_main_sampah();
        }
        //SALES
        else if ( strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ) {
            $data = $this->M_main->select_main_by_sales_sampah($v_id_sales);
        } 
        else if (strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0) {
            $data = $this->M_main->select_main_by_tanggal_sampah($v_id_sales,$v_tanggal1,$v_tanggal2);
        }
        else if( strlen($v_id_sales) != 0 && strlen($v_id_rute) != 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0 ){  
            $data = $this->M_main->select_main_by_without_toko_sampah($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute);
        }
        //TOKO
        else if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ) {
            $data = $this->M_main->select_main_by_toko_sampah($v_id_toko);
        }
        else if ( strlen($v_id_sales) == 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ) {
            $data = $this->M_main->select_main_by_tanggal_dan_toko_sampah($v_tanggal1,$v_tanggal2,$v_id_toko);
        }
        else if ( strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) != 0  &&  strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ) {
            $data = $this->M_main->select_main_by_without_rute_sampah($v_id_toko,$v_tanggal1,$v_tanggal2,$v_id_sales);
        }
        //ALL
        else if( strlen($v_id_rute) != 0 && strlen($v_id_toko) != 0  && strlen($v_id_sales) != 0 && strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_main->select_main_by_all_kondisi_sampah($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute,$v_id_toko);  
        }
        //TANGGAL AJA
        else if( strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  && strlen($v_id_sales) == 0 && strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_main->select_main_by_tanggal_saja_sampah($v_tanggal1,$v_tanggal2);  
        }
        

        echo json_encode($data);

    }




    public function detail_riwayat(){
        $v_id = $this->input->get('id');
         
        $data = $this->M_main->select_main_byid($v_id);
   
        echo json_encode($data);
    }


    public function get_kerja(){
        $v_id_sales = $this->input->post('id_sales');
        $v_tanggal1 = $this->input->post('tanggal1');
        $v_tanggal2 = $this->input->post('tanggal2');
        $v_id_rute = $this->input->post('id_rute');
        $v_id_toko = $this->input->post('id_toko');


        if ( strlen($v_id_sales) != 0 && strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0  &&  strlen($v_tanggal1) == 0 && strlen($v_tanggal2) == 0  ) {
            $data = $this->M_main->select_main_by_sales($v_id_sales);
        }
        else if( strlen($v_id_rute) != 0 && strlen($v_id_toko) != 0  && strlen($v_id_sales) != 0 && strlen($v_tanggal1) != 0 && strlen($v_tanggal2) != 0  ){
            $data = $this->M_main->select_main_by_all_kondisi($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute,$v_id_toko);  

        }else if (strlen($v_id_rute) == 0 && strlen($v_id_toko) == 0) {
            $data = $this->M_main->select_main_by_tanggal($v_id_sales,$v_tanggal1,$v_tanggal2);
        }
        else if( strlen($v_id_toko) == 0 ){  
            $data = $this->M_main->select_main_by_without_toko($v_id_sales,$v_tanggal1,$v_tanggal2,$v_id_rute);
        }

        echo json_encode($data);

    }



    public function get_rute(){
        $v_status = $this->input->post('id_status');
       if( strlen($v_status) != 0 ){
            $data = $this->M_rute->select_by_status($v_status);  
        }else{  
            $data = $this->M_rute->select_all_sales();
        }
            echo json_encode($data);
    }

    public function get_toko(){
        $v_id = $this->input->post('id');

        $data = $this->M_toko->select_by_rute($v_id);
        
        $output = '<option value="">-- Pilih TOKO --</option>';
        foreach ($data as $row){
            $output .= '<option value="'.$row['toko_id'].'">'.$row['toko_nama'].'</option>';
        }
        echo json_encode($output);
    }


    public function detail_user (){
        $id = $this->input->get('id');
        $data = $this->M_user->get_pengguna($id);
        
        echo json_encode($data);
    }

    public function detail_toko (){
        $id = $this->input->get('id');
        $data = $this->M_toko->get_by_id($id);
        
        echo json_encode($data);
    }

    public function detail_rute (){
        $id = $this->input->get('id');
        $data = $this->M_rute->get_rute_by($id);
        
        echo json_encode($data);
    }


    public function get_sales_by_toko(){
        $id = $this->input->get('id_toko');
        $data = $this->M_sales->select_by_toko($id);
        
        echo json_encode($data);
    }

    public function hapus_user (){

        $id = $this->input->post('id');

        $hapus_foto = $this->M_user->get_pengguna($id);
        
        if($hapus_foto['user_foto'] != 'default.jpg'){
            unlink(FCPATH . 'assets/foto/user/' . $hapus_foto['user_foto']);
        }

        
        $data = $this->M_user->delete($id);
        
        echo json_encode($data);
    }

    public function hapus_riwayat(){

        $id = $this->input->post('id');    
        $data = $this->M_main->delete($id);
        
        echo json_encode($data);
    }

    public function pindahkan_ke_sampah(){
        $v_id = $this->input->post('id');
        $v_data = [
            'main_id_status' => 2
        ];

        $data = $this->M_main->edit_main($v_id, $v_data);
        
        echo json_encode($data);
    }


    public function pulihkan(){
        $v_id = $this->input->post('id');
        $v_data = [
            'main_id_status' => 1
        ];

        $data = $this->M_main->edit_main($v_id, $v_data);
        
        echo json_encode($data);
    }


    public function hapus_toko (){

        $id = $this->input->post('id');

        $hapus_foto = $this->M_toko->get_toko($id);
        
        if($hapus_foto['toko_foto'] != 'default.png'){
            unlink(FCPATH . 'assets/foto/toko/' . $hapus_foto['toko_foto']);
        }

        
        $data = $this->M_toko->delete($id);
        
        echo json_encode($data);
    }
   
    public function hapus_pm(){

        $id = $this->input->post('id');    
        $data = $this->M_produk->delete($id);
        
        echo json_encode($data);
    }


    public function login(){

        $v_username = $this->input->post('username');
        $v_password = $this->input->post('password');

        $pengguna = $this->M_auth->auth($v_username, $v_password);

        if ($pengguna){

            if ($pengguna['user_id_status'] == 1) {

                $v_data['id_username'] = $pengguna['user_id'];
                $v_data['id_level'] = $pengguna['user_id_level'];

                $this->session->set_userdata($v_data);

                if ($pengguna['user_id_level'] == 1) {
                       
                    redirect('admin/profile');
                }else {
                    redirect('sales/profile');
                }

            }else{
                $this->session->set_flashdata('nonaktif', 'Maaf, akun Anda telah dinonaktifkan !');
                redirect('dashboard');    
            }
        }else {
            $this->session->set_flashdata('error', 'username dan password salah !');
            redirect('dashboard');
        }

    }


    public function logout(){
        $this->session->unset_userdata('id_username');
        $this->session->unset_userdata('id_level');
        $this->session->set_flashdata('logout', 'Berhasil logout !');
        redirect('dashboard');
    }

    public function blocked(){
        $this->load->view('v_blocked/index.php');
    }

    public function pas_nota(){
        $nota = encrypt_url($this->input->get('nota'));
        redirect(base_url()."auth/cetak_nota?nota=".$nota);        
    }


    public function cetak_nota(){
        $this->load->library('dompdf_gen');
        // $v_id_username = $this->session->userdata('id_username'); 
        $nota = decrypt_url($this->input->get('nota'));
        // $data['sales'] = $this->M_user->get_pengguna($v_id_username);
        
        $data['title'] = 'Nota';

        $data['data_nota'] = $this->M_main->select_main_byid($nota);

        $path = base_url('assets/foto/toko/').$data['data_nota']['toko_foto'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $filee = file_get_contents($path);
        $data['foto'] = 'data:image/' . $type . ';base64,' . base64_encode($filee);

        
        $this->load->view('laporan/nota', $data);
    
        

        $ukuran_kertas = 'A4';
        $orientation = 'Portrait';
        $customPaper = array((25),(-30),235,600);
        $html = $this->output->get_output();
        // $this->dompdf->set_paper($ukuran_kertas,$orientation);
        $this->dompdf->set_paper($customPaper);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Nota.pdf", array('Attachment' => 0));
    }



    public function pas_pdf(){

        $sales = encrypt_url($this->input->get('sales'));
        $tanggal1 = encrypt_url($this->input->get('tanggal1'));
        $tanggal2 = encrypt_url($this->input->get('tanggal2'));
        $rute = encrypt_url($this->input->get('rute'));
        $toko = encrypt_url($this->input->get('toko'));

        redirect(base_url()."auth/pdf?sales=".$sales."&tanggal1=".$tanggal1."&tanggal2=".$tanggal2."&rute=".$rute."&toko=".$toko);

    }

    public function pdf (){
        $this->load->library('dompdf_gen');
        
        $data['sales'] = decrypt_url($this->input->get('sales'));
        $data['tanggal1'] = decrypt_url($this->input->get('tanggal1'));
        $data['tanggal2'] = decrypt_url($this->input->get('tanggal2'));
        $data['rute'] = decrypt_url($this->input->get('rute'));
        $data['toko'] = decrypt_url($this->input->get('toko'));

        $data['saless'] = $this->M_user->get_pengguna($data['sales']);

        $data['title'] = 'laporan riwayat';

        if ( strlen($data['sales']) == 0 && strlen($data['rute']) == 0 && strlen($data['toko']) == 0  &&  strlen($data['tanggal1']) == 0 && strlen($data['tanggal2']) == 0  ){
            $data['data_main'] = $this->M_main->select_main();
        }
        //SALES
        else if ( strlen($data['sales']) != 0 && strlen($data['rute']) == 0 && strlen($data['toko']) == 0  &&  strlen($data['tanggal1']) == 0 && strlen($data['tanggal2']) == 0  ) {
            $data['data_main'] = $this->M_main->select_main_by_sales($data['sales']);
        } 
        else if (strlen($data['sales']) != 0 && strlen($data['rute']) == 0 && strlen($data['toko']) == 0  &&  strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0) {
            $data['data_main'] = $this->M_main->select_main_by_tanggal($data['sales'],$data['tanggal1'],$data['tanggal2']);
        }
        else if( strlen($data['sales']) != 0 && strlen($data['rute']) != 0 && strlen($data['toko']) == 0  &&  strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0 ){  
            $data['data_main'] = $this->M_main->select_main_by_without_toko($data['sales'],$data['tanggal1'],$data['tanggal2'],$data['rute']);
        }
        //TOKO
        else if ( strlen($data['sales']) == 0 && strlen($data['rute']) == 0 && strlen($data['toko']) != 0  &&  strlen($data['tanggal1']) == 0 && strlen($data['tanggal2']) == 0  ) {
            $data['data_main'] = $this->M_main->select_main_by_toko($data['toko']);
        }
        else if ( strlen($data['sales']) == 0 && strlen($data['rute']) == 0 && strlen($data['toko']) != 0  &&  strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0  ) {
            $data['data_main'] = $this->M_main->select_main_by_tanggal_dan_toko($data['tanggal1'],$data['tanggal2'],$data['toko']);
        }
        else if ( strlen($data['sales']) != 0 && strlen($data['rute']) == 0 && strlen($data['toko']) != 0  &&  strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0  ) {
            $data['data_main'] = $this->M_main->select_main_by_without_rute($data['toko'],$data['tanggal1'],$data['tanggal2'],$data['sales']);
        }
        //ALL
        else if( strlen($data['rute']) != 0 && strlen($data['toko']) != 0  && strlen($data['sales']) != 0 && strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0  ){
            $data['data_main'] = $this->M_main->select_main_by_all_kondisi($data['sales'],$data['tanggal1'],$data['tanggal2'],$data['rute'],$data['toko']);  
        }
        //TANGGAL AJA
        else if( strlen($data['rute']) == 0 && strlen($data['toko']) == 0  && strlen($data['sales']) == 0 && strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0  ){
            $data['data_main'] = $this->M_main->select_main_by_tanggal_saja($data['tanggal1'],$data['tanggal2']);  
        }
        //TANGGAL DAN RUTE
        else if( strlen($data['rute']) != 0 && strlen($data['toko']) == 0  && strlen($data['sales']) == 0 && strlen($data['tanggal1']) != 0 && strlen($data['tanggal2']) != 0  ){
            $data['data_main'] = $this->M_main->select_main_by_tanggal_dan_rute($data['tanggal1'],$data['tanggal2'],$data['rute']);  
        } 
        

        
        $this->load->view('laporan/laporan', $data);
    
        

        $ukuran_kertas = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($ukuran_kertas,$orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan_kerja.pdf", array('Attachment' => 0));
    }



}