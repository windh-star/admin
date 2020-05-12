<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class BugsController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("BugsModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Bugs';
        $data['halaman'] = 'bugs/index';
        $this->load->view('layout', $data);
    }
    public function getTabelBugs(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'id_pengguna',
                                           'bug',
                                           'tgl_dibuat',
                                           'jam_dibuat'
                                        );

            return $this->BugsModel->getTabelBugs($datatable);
        }
    }
    public function getListbugs(){
        $response = array(
            "total_count" => $this->BugsModel->getJumlahListBugs( $this->input->get("q")),
            "results" => $this->BugsModel->getListBugs(
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

     //Range Tanggal Bugs
	  Public function rangeBugs(){
        $min=$this->input->post('min');
        $max=$this->input->post('max');
        $data['barang']=$this->BugsModel->get_range($min,$max);
      
        $this->load->view('bugs/index');
    }

}