<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }

    public function index(){

        if ($this->session->userdata('id_username')) {
            // echo"<script>
            //     window.history.go(-1)
            // </script>
            // ";
            
        }


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


        $this->load->view('templates/header_dashboard',$v_data);
        $this->load->view('keluar',$v_data);
        $this->load->view('templates/footer_dashboard');    		 
	}

    public function masuk(){
        $v_data['is_aktif'] = 'masuk';
        $v_data['isi_konten'] = '
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
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