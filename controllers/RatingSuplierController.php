<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class RatingSuplierController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("RatingSuplierModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Rating Suplier';
        $data['halaman'] = 'ratingSuplier/index';
        $this->load->view('layout', $data);
    }

    public function getTabelRatingSuplier(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_rating',
                                            'id_suplier',
                                            'nama_pengguna',
                                            'rating',
                                            'ulasan',
                                            'tgl_dibuat',
                                            'jam_dibuat'
                                        );

            return $this->RatingSuplierModel->getTabelRatingSuplier($datatable);
        }
    }

}