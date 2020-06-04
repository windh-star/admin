<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class UpahController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("UpahModel");
    }

	public function index()
	{
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'Upah';
    	$data['halaman'] = 'upah/form_data';
        $this->load->view('layout', $data);
	}

	public function getTabelLengkapiUpah(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'urut',
		    								   'nama_upah',
	            	    		               'satuan'
	            	    		             );

		    	return $this->UpahModel->getTabelLengkapiUpah($datatable);
    		}
  	}

  	public function getTabelUpah(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
												'id_upah',
												'id_proyek',
												'wilayah',
												'nama_upah',
												'satuan',
												'spesifikasi',
												'merk',
												'harga_dasar',
												'keterangan'
	            	    		             );

		    	return $this->UpahModel->getTabelUpah($datatable);
    		}
  	}

  	public function getRingkasanStatus($id_wilayah){
	    $response = $this->UpahModel->getRingkasanStatus($id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getMaxIDUpah(){
	    $response = $this->UpahModel->getMaxIDUpah()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestTahun($sumber,$id_wilayah){
	    $response = $this->UpahModel->getSuggestTahun($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestKeterangan($sumber,$id_wilayah){
	    $response = $this->UpahModel->getSuggestKeterangan($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getUpahKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->UpahModel->getUpahKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getRincianUpah($id){
	    $response = $this->UpahModel->getRincianUpah($id)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getLengkapiUpahKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->UpahModel->getLengkapiUpahKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getListUpah(){
	    $response = array(
	      "total_count" => $this->UpahModel->getJumlahListUpah($this->input->get("wilayah"),$this->input->get("q")),
	      "results" => $this->UpahModel->getListUpah(
	      					$this->input->get("wilayah"),
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

  	public function simpanUpah(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->UpahModel->simpanUpah($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data upah berhasil disimpan.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function ubahUpah(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->UpahModel->ubahUpah($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data upah berhasil diperbaharui.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiUpah($urut){
	    $this->UpahModel->verifikasiUpah($urut);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data upah berhasil diverifikasi.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiSemuaUpah(){
	    $this->UpahModel->verifikasiSemuaUpah();

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data upah berhasil diverifikasi semua.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getInfoUpah($id_upah){
        $response = $this->UpahModel->getInfoUpah($id_upah)->row();
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function getRingkasanSumberUpah(){
	    $response = $this->UpahModel->getRingkasanSumberUpah()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
}
