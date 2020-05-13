<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class FeaturedProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("FeaturedProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Featured Produk';
        $data['halaman'] = 'featuredProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelFeaturedProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_produk',
                                            'nama_produk',
                                            'status'
                                        );

            return $this->FeaturedProdukModel->getTabelFeaturedProduk($datatable);
        }
    }

}