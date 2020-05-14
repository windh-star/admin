<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class VolumeController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("VolumeModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Volume';
        $data['halaman'] = 'volume/volume';
        $this->load->view('layout', $data);
    }

    public function getTabelVolume(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'id_volume',
                                           'nama_pekerjaan',
                                           'nama_proyek',
                                           'id_pelaksana',
                                           'total_volume',
                                           'tgl_dibuat',
                                           'jam_dibuat'
                                        );

            return $this->VolumeModel->getTabelVolume($datatable);
        }
    }

}