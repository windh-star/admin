<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class SuplierController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("SuplierModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Suplier';
        $data['halaman'] = 'suplier/wilayahProduk';
        $this->load->view('layout', $data);
    }

    public function getTabelSuplier(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_pengguna',
                                            'nama_pengguna',
                                            'alamat',
                                            'perusahaan',
                                            'email',
                                            'no_telp'
                                        );

            return $this->SuplierModel->getTabelSuplier($datatable);
        }
    }

}