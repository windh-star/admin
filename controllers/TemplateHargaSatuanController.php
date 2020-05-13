<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class TemplateHargaSatuanController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("TemplateHargaSatuanModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Template Proyek';
        $data['halaman'] = 'templateHargaSatuan/index';
        $this->load->view('layout', $data);
    }

    public function getTabelTemplateHargaSatuan(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_harga_satuan',
                                            'id_template',
                                            'nama_pekerjaan',
                                            'satuan',
                                            'id_kategori',
                                            'level',
                                            'have_sub',
                                            'total_harga',
                                            'temp_total_harga',
                                            'sumber',
                                            'tgl_dibuat',
                                            'jam_dibuat'
                                        );

            return $this->TemplateHargaSatuanModel->getTabelTemplateHargaSatuan($datatable);
        }
    }

}