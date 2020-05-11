<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerandaController extends CI_Controller {
	public function index()
	{
		$data['menu'] = '';
    	$data['halaman'] = 'beranda';
        $this->load->view('layout', $data);
	}
}
