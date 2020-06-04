<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class BahanTerpakaiController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("BahanTerpakaiModel");
    }

	public function index()
	{
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'Bahan';
    	$data['halaman'] = 'bahanterpakai/index';
        $this->load->view('layout', $data);
	}

	public function getTabelBahan(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'id_bahan',
											   'id_proyekbahan',
											   'id_proyekproyek',
	            	    		               'wilayah',
	            	    		               'nama_bahan',
											   'satuan',
											   'spesifikasi',
	            	    		               'merk',
											   'harga_dasar',
											   'keterangan'
	            	    		             );

		    	return $this->BahanTerpakaiModel->getTabelBahan($datatable);
    		}
  	}

  	public function getTabelBahanTerpakai(){
    	if(
    		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
		    								   'id_ahs',
		    								   'nama_pekerjaan',
	            	    		               'nama_proyek'
	            	    		             );

		    	return $this->BahanTerpakaiModel->getTabelBahanTerpakai($datatable);
    		}
  	}

  	public function getRingkasanStatus($id_wilayah){
	    $response = $this->BahanModel->getRingkasanStatus($id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getMaxIDBahan(){
	    $response = $this->BahanModel->getMaxIDBahan()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestTahun($sumber,$id_wilayah){
	    $response = $this->BahanModel->getSuggestTahun($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getSuggestKeterangan($sumber,$id_wilayah){
	    $response = $this->BahanModel->getSuggestKeterangan($sumber,$id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function getBahanKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->BahanModel->getBahanKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	
	public function getRincianBahan($id){
	    $response = $this->BahanModel->getRincianBahan($id)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getLengkapiBahanKriteria($kriteria, $keyword){
  		$keyword = str_replace('_', ' ', $keyword);
	    $response = $this->BahanModel->getLengkapiBahanKriteria($kriteria, $keyword)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getListBahan(){
	    $response = array(
	      "total_count" => $this->BahanModel->getJumlahListBahan($this->input->get("wilayah"),$this->input->get("q")),
	      "results" => $this->BahanModel->getListBahan(
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

  	public function simpanBahan(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->BahanModel->simpanBahan($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data bahan berhasil disimpan.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

  	public function ubahBahan(){
	    parse_str(file_get_contents('php://input'), $data);
	    $this->BahanModel->ubahBahan($data);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data bahan berhasil diperbaharui.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiBahan($urut){
	    $this->BahanModel->verifikasiBahan($urut);

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data bahan berhasil diverifikasi.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function verifikasiSemuaBahan(){
	    $this->BahanModel->verifikasiSemuaBahan();

	    $response = array(
	      'Success' => true,
	      'Info' => 'Data bahan berhasil diverifikasi semua.'
	    );

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
	public function getRingkasanSumberBahan(){
	    $response = $this->BahanModel->getRingkasanSumberBahan()->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getRincianBahanTerpakai($id_proyekbahan,$id_proyekproyek,$bahan){
		$response = $this->BahanTerpakaiModel->getRincianBahanTerpakai($id_proyekbahan,$id_proyekproyek,$bahan)->result();

	  $this->output
			 ->set_status_header(200)
			 ->set_content_type('application/json')
			 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
			 ->_display();
	  exit;
	}

	public function getRincianJumlahBahanTerpakai($id_proyekbahan,$id_proyekproyek,$bahan){
		$response = $this->BahanTerpakaiModel->getRincianJumlahBahanTerpakai($id_proyekbahan,$id_proyekproyek,$bahan)->result();

	  $this->output
			 ->set_status_header(200)
			 ->set_content_type('application/json')
			 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
			 ->_display();
	  exit;
	}

	

}
