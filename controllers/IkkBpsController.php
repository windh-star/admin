<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class IkkBpsController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("IkkBpsModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Ikk Bps';
        $data['halaman'] = 'ikkbps/index';
        $this->load->view('layout', $data);
    }
    public function getTabelIkkBps(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                           'wilayah',
                                           'ikk'
                                        );

            return $this->IkkBpsModel->getTabelIkkBps($datatable);
        }
    }
    public function getListikkBps(){
        $response = array(
            "total_count" => $this->IkkBpsModel->getJumlahListIkkBps( $this->input->get("q")),
            "results" => $this->IkkBpsModel->getListIkkBps(
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

    public function ubahIkkBps(){
        parse_str(file_get_contents('php://input'), $data);
        $this->IkkBpsModel->ubahIkkBps($data);
        
        $response = array(
            'Success' => true,
            'Info' => 'Data IKK BPS berhasil diperbaharui.'
        );
        
        $this->output
             ->set_status_header(201)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }


}