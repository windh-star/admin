<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class KategoriProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("KategoriProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Kategori Produk';
        $data['halaman'] = 'kategoriProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelKategoriProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_kategori',
                                            'kategori',
                                            'icon'
                                        );

            return $this->KategoriProdukModel->getTabelKategoriProduk($datatable);
        }
    }

}