<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class FotoProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("FotoProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Foto Produk';
        $data['halaman'] = 'fotoProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelFotoProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_produk',
                                            'nama_produk',
                                            'foto'
                                        );

            return $this->FotoProdukModel->getTabelFotoProduk($datatable);
        }
    }

}