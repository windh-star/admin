<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class AlatController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("AlatModel");
    }

	public function index()
	{
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'Alat';
    	$data['halaman'] = 'alat/form_data';
        $this->load->view('layout', $data);
	}

	public function getTabelLengkapiAlat(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'urut',
		    								   'nama_alat',
	            	    		               'satuan'
	            	    		             );

		    	return $this->AlatModel->getTabelLengkapiAlat($datatable);
    		}
  	}

  	public function getTabelAlat(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'urut',
		    								   'wilayah',
	            	    		               'nama_alat',
	            	    		               'satuan',
	            	    		               'spesifikasi',
	            	    		               'merk',
	            	    		               'harga_dasar',
	            	    		               'status'
	            	    		             );

		    	return $this->AlatModel->getTabelAlat($datatable);
    		}
  	}

  	public function getRingkasanStatus($id_wilayah){
	    $response = $this->AlatModel->getRingkasanStatus($id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getMaxIDAlat(){
	    $response = $this->AlatModel->getMaxIDAlat()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestTahun($sumber,$id_wilayah){
	    $response = $this->AlatModel->getSuggestTahun($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestKeterangan($sumber,$id_wilayah){
	    $response = $this->AlatModel->getSuggestKeterangan($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getAlatKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->AlatModel->getAlatKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getRincianAlat($id){
	    $response = $this->AlatModel->getRincianAlat($id)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getLengkapiAlatKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->AlatModel->getLengkapiAlatKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getListAlat(){
	    $response = array(
	      "total_count" => $this->AlatModel->getJumlahListAlat($this->input->get("wilayah"),$this->input->get("q")),
	      "results" => $this->AlatModel->getListAlat(
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

  	public function simpanAlat(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->AlatModel->simpanAlat($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data alat berhasil disimpan.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function ubahAlat(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->AlatModel->ubahAlat($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data alat berhasil diperbaharui.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiAlat($urut){
	    $this->AlatModel->verifikasiAlat($urut);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data alat berhasil diverifikasi.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiSemuaAlat(){
	    $this->AlatModel->verifikasiSemuaAlat();

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data alat berhasil diverifikasi semua.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getInfoAlat($id_alat){
        $response = $this->AlatModel->getInfoAlat($id_alat)->row();
        
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function getRingkasanSumberAlat(){
	    $response = $this->AlatModel->getRingkasanSumberAlat()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
}
