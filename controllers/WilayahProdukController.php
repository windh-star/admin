<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class WilayahProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("WilayahProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Wilayah Produk';
        $data['halaman'] = 'wilayahProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelWilayahProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_produk',
                                            'nama_produk',
                                            'wilayah',
                                            'provinsi',
                                            'harga_dasar',
                                            'utama'
                                        );

            return $this->WilayahProdukModel->getTabelWilayahProduk($datatable);
        }
    }

}