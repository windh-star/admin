<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class BuaBpsController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("BuaBpsModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'BUA BPS';
        $data['halaman'] = 'buabps/index';
        $this->load->view('layout', $data);
    }

    public function getTabelBUABPS(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'ket_kategori',
                                           'id_kategori',
                                           'nama_kategori',
                                           'spesifikasi',
                                           'merk',
                                           'satuan',
                                           'harga_dasar',
                                           'keterangan'
                                        );

            return $this->BuaBpsModel->getTabelBUABPS($datatable);
        }
    }

    public function getListBuaBps(){
        $response = array(
            "total_count" => $this->BuaBpsModel->getJumlahListBuaBps( $this->input->get("q")),
            "results" => $this->BuaBpsModel->getListBuaBps(
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
	  public function getRingkasanKategoriBuaBps($id_wilayah){
	    $response = $this->BuaBpsModel->getRingkasanKategoriBuaBps($id_wilayah)->row();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

}