<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class AHSController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("AHSModel");
    }

	public function index()
	{
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'AHS';
    	$data['halaman'] = 'ahs/form_data';
        $this->load->view('layout', $data);
	}

	public function getTabelAHS(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'nama_proyek',
		    								   'nama_pekerjaan',
		    								   'satuan_pekerjaan',
		    								   'tahun',
											 //  'ket_sumber',
											   'keterangan',
											   'id_proyek',
											   'id_pekerjaan'
	            	    		             );

		    	return $this->AHSModel->getTabelAHS($datatable);
    		}
  	}

  	public function getRingkasanStatus($id_wilayah){
	    $response = $this->AHSModel->getRingkasanStatus($id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function simpanAHS(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->AHSModel->simpanAHS($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data AHS berhasil disimpan.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getRincianAHS($proyek,$id_pekerjaan){
		$response = $this->AHSModel->getRincianAHS($proyek,$id_pekerjaan)->result();

	  $this->output
			 ->set_status_header(200)
			 ->set_content_type('application/json')
			 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
			 ->_display();
	  exit;
	}

	public function getRingkasanSumberAHS(){
	    $response = $this->AHSModel->getRingkasanSumberAHS()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
}
