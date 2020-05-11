<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class ArtikelController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("ArtikelModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Artikel';
        $data['halaman'] = 'artikel/artikel';
        $this->load->view('layout', $data);
    }
    public function getTabelArtikel(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'judul_artikel',
                                           'ket_kategori',
                                           'ket_status',
                                           'foto_cover',
                                           'tgl_dibuat',
                                           'jam_dibuat'
                                        );

            return $this->ArtikelModel->getTabelArtikel($datatable);
        }
    }
    public function getListArtikel(){
        $response = array(
            "total_count" => $this->ArtikelModel->getJumlahListArtikel( $this->input->get("q")),
            "results" => $this->ArtikelModel->getListArtikel(
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
	    $response = $this->ArtikelModel->getRingkasanKategoriArtikel($id_artikel)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

}