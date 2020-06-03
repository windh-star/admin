<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class KategoriPekerjaanController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("KategoriPekerjaanModel");
    }
    public function index(){
        $data['root_menu'] = "Master Data";
        $data['menu'] = "kategori Pekerjaan";
        $data['halaman'] = "kategoripekerjaan/index";
        $this->load->view('layout', $data);
    }
    public function getTabelKategoriPekerjaan(){
        if(
    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
	                                           'id_kategori',
	                                           'nama_proyek',
                                               'kategori',
                                               'status',
                                               'level'
	            	    		             );
		    	return $this->KategoriPekerjaanModel->getTabelKategoriPekerjaan($datatable);
    		}
    }
    public function getListKategori(){
       $response = array(
           "total_count" => $this->KategoriPekerjaanModel->getJumlahListKategori($this->input->get("q")),
           "results" => $this->KategoriPekerjaanModel->getListKategori(
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
    public function simpanKategori(){
        parse_str(file_get_contents('php://input'), $data);
        $this->KategoriPekerjaanModel->simpanKategori($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data Kategori Pekerjaan Berhasil Ditambahkan.'
            );
            
            $this->output
                 ->set_status_header(201)
                 ->set_content_type('application/json')
                 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                 ->_display();
            exit;
    }
    public function getInfoKategori($id_kategori){
        $response = $this->KategoriPekerjaanModel->getInfoKategori($id_kategori)->row();
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('appilcation/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit;
    }
    
    public function ubahKategori(){
        parse_str(file_get_contents('php://input'), $data);
        $this->KategoriPekerjaanModel->ubahKategori($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data Kategori berhasil diperbaharui.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }

    public function hapusKategori(){
     
        $this->KategoriPekerjaanModel->hapusKategoriPekerjaan($data);
       

        $this->output
        ->set_status_header(201)
        ->set_content_type('application/json')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT))
        ->_display();
   exit();
    }
}