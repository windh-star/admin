<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class PekerjaanController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("PekerjaanModel");
    }
    public function index(){
        $data['root_menu']  = "Master Data";
        $data['menu']       = "pekerjaan";
        $data['halaman']    = "pekerjaan/index";
        $this->load->view('layout', $data);
    }
    public function getTabelpekerjaan(){
        if(
    	isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    	  ) {
	            $datatable  = $_POST;

	            $datatable['col-display'] = array(
                                               'id_pekerjaan',
		    								   'nama_proyek',
		    								   'nama_pekerjaan',
	            	    		               'satuan',
	            	    		             );
		    	return $this->PekerjaanModel->getTabelPekerjaan($datatable);
    		}
    }
}