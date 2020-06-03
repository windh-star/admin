<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class PekerjaanController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("PekerjaanModel");
    }
    public function index(){
        $data['root_menu']  = "Master Data";
        $data['menu']       = "pekerjaan";
        $data['halaman']    = "pekerjaan/index";
        $this->load->view('layout', $data);
    }
    public function getTabelpekerjaan(){
        if(
    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
                                               'id_pekerjaan',
		    								   'nama_proyek',
		    								   'nama_pekerjaan',
	            	    		               'satuan'
	            	    		             );
		    	return $this->PekerjaanModel->getTabelPekerjaan($datatable);
    		}
    }
    public function ubahPekerjaan(){
        parse_str(file_get_contents('php://input'), $data);
        $this->PekerjaanModel->ubahPekerjaan($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data Pekerjaan berhasil diperbaharui.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }

    public function hapusPekerjaan(){
     
        $this->PekerjaanModel->hapusPekerjaan($data);
      
        $this->output
        ->set_status_header(201)
        ->set_content_type('application/json')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();
   exit();
    }
}