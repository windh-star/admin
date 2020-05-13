<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class RatingProyekController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("RatingProyekModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Rating Proyek';
        $data['halaman'] = 'ratingProyek/index';
        $this->load->view('layout', $data);
    }

    public function getTabelRatingProyek(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_rating',
                                            'nama_proyek',
                                            'nama_pengguna',
                                            'rating',
                                            'tanggapan',
                                            'tgl_dibuat',
                                            'jam_dibuat'
                                        );

            return $this->RatingProyekModel->getTabelRatingProyek($datatable);
        }
    }

}