<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class ProyekController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("ProyekModel");
    }
    public function index(){
        $data['root_menu'] = "Master Data";
        $data['menu'] = "proyek";
        $data['halaman'] = "proyek/index";
        $this->load->view('layout', $data);
    }
    public function getTabelProyek(){
         if(
    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
	                                           'id_proyek',
		    								   'nama_proyek',
		    								   'wilayah',
	            	    		               'pemilik',
	            	    		             );
		    	return $this->ProyekModel->getTabelProyek($datatable);
    		}
    }
    public function getListProyek(){
        $response = array(
            "total_count" => $this->ProyekModel->getJumlahListProyek($this->input->get("q")),
            "results" => $this->ProyekModel->getListProyek(
                $this->input->get("q"),
                $this->input->get("page") * $this->input->get("page_limit"),
                $this->input->get("page_limit")
            )
        );
    
    $this->output
         ->set_status_header(200)
         ->set_content_type('application/json')
         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
         ->_display();
    exit;
    }
    
    public function getInfoProyek($id_proyek){
        $response = $this->ProyekModel->getInfoProyek($id_proyek)->row();
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function ubahProyek(){
        parse_str(file_get_contents('php://input'), $data);
        $this->ProyekModel->ubahProyek($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data Proyek berhasil diperbaharui.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
}