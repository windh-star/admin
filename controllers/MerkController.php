<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class MerkController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("MerkModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Merk';
        $data['halaman'] = 'merk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelMerk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_merk',
                                            'merk',
                                            'logo'
                                        );

            return $this->MerkModel->getTabelMerk($datatable);
        }
    }

}