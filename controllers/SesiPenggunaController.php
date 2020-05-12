<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class SesiPenggunaController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("SesiPenggunaModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Sesi Pengguna';
        $data['halaman'] = 'sesipengguna/index';
        $this->load->view('layout', $data);
    }
    public function getTabelSesiPengguna(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'id_login',
                                           'ip_address',
                                           'platform',
                                           'browser',
                                           'nama_pengguna',
                                           'foto',
                                           'nama_proyek',
                                           'time'
                                        );

            return $this->SesiPenggunaModel->getTabelSesiPengguna($datatable);
        }
    }
}