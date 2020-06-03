<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class PenggunaController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("PenggunaModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'pengguna';
        $data['halaman'] = 'pengguna/form_data';
        $this->load->view('layout', $data);
    }
    public function getTabelPengguna(){
        if(
    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
	                                            'id_pengguna',
		    								   'nama_pengguna',
                                               'alamat',
                                               'wilayah',
	            	    		               'perusahaan',
	            	    		               'email',
                                               'no_telp',
                                               'status_verifikasi'
	            	    		             );
		    	return $this->PenggunaModel->getTabelPengguna($datatable);
    		}
    }
    public function getListPengguna(){
        $response = array(
            "total_count" => $this->PenggunaModel->getJumlahListPengguna( $this->input->get("q")),
            "results" => $this->PenggunaModel->getListPengguna(
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
    public function getInfoPengguna($id_pengguna){
        $response = $this->PenggunaModel->getInfoPengguna($id_pengguna)->row();
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function ubahPengguna(){
        parse_str(file_get_contents('php://input'), $data);
        $this->PenggunaModel->ubahPengguna($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data Pengguna berhasil diperbaharui.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function simpanPengguna(){
        parse_str(file_get_contents('php://input'), $data);
        $this->PenggunaModel->simpanPengguna($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data berhasil ditambahkan.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }
    public function getPengalaman($id_pengguna){
        $response = $this->PenggunaModel->getPengalaman($id_pengguna);
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
        
    }

    public function getRingkasanVerifikasi(){
	    $response = $this->PenggunaModel->getRingkasanVerifikasi()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
    }
}