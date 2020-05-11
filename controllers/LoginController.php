<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

	public function index()
	{
		$this->load->view('login');
		delete_cookie('nama_admin');
	}

	public function loginPengguna(){
	    parse_str(file_get_contents('php://input'), $data);
	    $status = $this->AdminModel->loginAdmin($data)->num_rows();

	    if ($status > 0) {
	        $record = $this->AdminModel->getIDAdmin($data)->row();
	        set_cookie('nama_admin', $record->username, 3600*2);

		    $response = array(
		      'Success' => true,
		      'Info' => 'Administrator berhasil terautentikasi.'
		    );
		} else {
			$response = array(
		      'Success' => false,
		      'Info' => 'Administrator gagal terautentikasi. Silakan masukkan username dan password yang valid.'
		    );
		}

	    $this->output
	         ->set_status_header(201)
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response, JSON_PRETTY_PRINT))
	         ->_display();
	    exit;
	}
}
