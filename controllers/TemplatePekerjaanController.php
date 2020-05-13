<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class TemplatePekerjaanController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("TemplatePekerjaanModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Template Pekerjaan';
        $data['halaman'] = 'templatePekerjaan/index';
        $this->load->view('layout', $data);
    }

    public function getTabelTemplatePekerjaan(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_template',
                                            'nama_pekerjaan',
                                            'satuan',
                                            'tgl_dibuat',
                                            'jam_dibuat'
                                        );

            return $this->TemplatePekerjaanModel->getTabelTemplatePekerjaan($datatable);
        }
    }

}