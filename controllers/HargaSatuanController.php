<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class HargaSatuanController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("HargaSatuanModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Harga Satuan';
        $data['halaman'] = 'hargaSatuan/index';
        $this->load->view('layout', $data);
    }

    public function getTabelHargaSatuan(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'id_harga_satuan',
                                           'nama_pekerjaan',
                                           'satuan',
                                           'level',
                                           'total_harga',
                                           'ket_sumber',
                                           'tgl_dibuat',
                                           'jam_dibuat'
                                        );

            return $this->HargaSatuanModel->getTabelHargaSatuan($datatable);
        }
    }

}