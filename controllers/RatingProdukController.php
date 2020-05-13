<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class RatingProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("RatingProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Rating Produk';
        $data['halaman'] = 'ratingProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelRatingProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_rating',
                                            'nama_produk',
                                            'nama_pengguna',
                                            'rating',
                                            'ulasan',
                                            'tgl_dibuat',
                                            'jam_dibuat'
                                        );

            return $this->RatingProdukModel->getTabelRatingProduk($datatable);
        }
    }

}