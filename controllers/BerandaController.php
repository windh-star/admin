<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class BerandaController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model("BerandaModel");
    }

	public function index()
	{
		$data['root_menu'] = 'Master Data';
		$data['menu'] = 'Beranda';
    	$data['halaman'] = 'beranda/index';
        $this->load->view('layout', $data);
	}

	public function getTotalEstimator(){
	    $response = $this->BerandaModel->getTotalEstimator()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getTotalSuplier(){
	    $response = $this->BerandaModel->getTotalSuplier()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getTotalProyek(){
	    $response = $this->BerandaModel->getTotalProyek()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function getGrafikProyek(){
	    $response = $this->BerandaModel->getGrafikProyek()->num_rows();

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}

	public function totalEstimator(){
        $response = $this->BerandaModel->totalEstimator();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function totalSuplier(){
        $response = $this->BerandaModel->totalSuplier();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
	}
	
	public function totalProyek(){
        $response = $this->BerandaModel->totalProyek();
        $this->output
             ->set_status_header(201)
             ->set_output(json_encode($response, JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }

}
