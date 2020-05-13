<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class TemplateProyekController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("TemplateProyekModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Template Proyek';
        $data['halaman'] = 'templateProyek/index';
        $this->load->view('layout', $data);
    }

    public function getTabelTemplateProyek(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_template',
                                            'nama_proyek',
                                            'jenis_proyek',
                                            'kategori_proyek',
                                            'struktur',
                                            'lantai',
                                            'dinding',
                                            'atap',
                                            'jasa_kontraktor'
                                        );

            return $this->TemplateProyekModel->getTabelTemplateProyek($datatable);
        }
    }

}