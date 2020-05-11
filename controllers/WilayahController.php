	<?php

defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class WilayahController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WilayahModel');
    }

	public function index(){
        $data['root_menu'] = "Master Data";
        $data['menu'] = "Wilayah";
        $data['halaman'] = "wilayah/index";
        $this->load->view('layout', $data);
	}
	
	public function getTabelWilayah(){
		if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'id_wilayah',
                                           'wilayah',
                                           'ket_kategori',
                                           'provinsi'
                                        );

            return $this->WilayahModel->getTabelWilayah($datatable);
        }
   }

    public function getAllWilayah(){
	    $response = $this->WilayahModel->getAllWilayah()->result();

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
  	}

  	public function getWilayahKriteria($kriteria, $keyword){
	    $response = $this->WilayahModel->getWilayahKriteria($kriteria, $keyword)->result();

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
  	}

    public function getWilayahHalaman($page, $size){
	    $response = array(
	      'content' => $this->WilayahModel->getWilayahHalaman(($page - 1) * $size, $size)->result(),
	      'totalHalaman' => ceil($this->WilayahModel->getJumlahWilayah() / $size)
	    );

	    $this->output
	      	 ->set_status_header(200)
	      	 ->set_content_type('application/json')
	      	 ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	      	 ->_display();
	    exit;
  	}

  	public function getListWilayah(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListWilayah($this->input->get("q")),
	      "results" => $this->WilayahModel->getListWilayah(
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

	  //Kategori Wilayah
	  public function getListKategoriWilayah(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListKategoriWilayah($this->input->get("q")),
	      "results" => $this->WilayahModel->getListKategoriWilayah(
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
	  
	  //Provinsi Wilayah
	  public function getListProvinsi(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListProvinsi($this->input->get("q")),
	      "results" => $this->WilayahModel->getListProvinsi(
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
	  
	   //Kategori BUA BPS
	   public function getListKategoriBuaBps(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListKategoriBuaBps($this->input->get("q")),
	      "results" => $this->WilayahModel->getListKategoriBuaBps(
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

	  //Rekap Jumlah Kategori BUA BPS, A = Bahan, B = Upah, C = Alat
	  public function getRingkasanKategoriBuaBps($id_kategori){
	    $response = $this->WilayahModel->getRingkasanKategoriBuaBps($id_kategori)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	  //Range Tanggal Bugs
	  Public function rangeBugs(){
		  $min=$this->input->post('min');
		  $max=$this->input->post('max');
		  $data['barang']=$this->WilayahModel->get_range($min,$max);
		
		  $this->load->view('bugs/index');
	  }

	  //Kategori  Artikel
	  public function getListKategoriArtikel(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListKategoriArtikel($this->input->get("q")),
	      "results" => $this->WilayahModel->getListKategoriArtikel(
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

	  //Status  Artikel
	  public function getListStatusArtikel(){
	    $response = array(
	      "total_count" => $this->WilayahModel->getJumlahListStatusArtikel($this->input->get("q")),
	      "results" => $this->WilayahModel->getListStatusArtikel(
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

	   //Rekap Jumlah Kategori Artikel, 1 = Artikel, 2 = Berita, 3 = Event
	   public function getRingkasanKategoriArtikel($id_artikel){
	    $response = $this->BahanModel->getRingkasanKategoriArtikel($id_artikel)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
}
