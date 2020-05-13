<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class TemplateKategoriPekerjaanController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("TemplateKategoriPekerjaankModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Template Kategori Pekerjaan';
        $data['halaman'] = 'templateKategoriPekerjaan/index';
        $this->load->view('layout', $data);
    }

    public function getTabelTemplateKategoriPekerjaan(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_kategori',
                                            'id_template',
                                            'level',
                                            'kategori'
                                        );

            return $this->TemplateKategoriPekerjaanModel->getTabelTemplateKategoriPekerjaan($datatable);
        }
    }

}