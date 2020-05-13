<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class SubkategoriProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("SubKategoriProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Sub Kategori Produk';
        $data['halaman'] = 'subKategoriProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelSubKategoriProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_sub_kategori',
                                            'kategori',
                                            'sub_kategori',
                                            'icon'
                                        );

            return $this->SubKategoriProdukModel->getTabelSubKategoriProduk($datatable);
        }
    }

}