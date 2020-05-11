<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
header("Access-Control-Allow-Origin: *");

class ImporEksporController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPExcel');
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1800);
    }

    public function impor(){
        $this->load->model('AHSModel');
        $fileName = time().'_'.$_FILES['file_ahs']['name'];
        
        $config['upload_path'] = './assets/doc/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 80000;

        $this->load->library('upload', $config);
         
        if (!$this->upload->do_upload('file_ahs')){
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $this->AHSModel->impor($filename);
            unlink('./assets/doc/'.$filename);
            $this->session->set_flashdata('msg','Data AHS berhasil diimpor.');
            redirect(base_url().'ahs');
        }
    }
    
    public function imporBUA(){
        $this->load->model('AHSModel');
        $fileName = time().'_'.$_FILES['file_bua']['name'];
        
        $config['upload_path'] = './assets/doc/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 80000;

        $this->load->library('upload', $config);
         
        if (!$this->upload->do_upload('file_bua')){
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $this->AHSModel->imporBUA($filename);
            unlink('./assets/doc/'.$filename);
            $this->session->set_flashdata('msg','Data BUA berhasil diimpor.');
            redirect(base_url().'ahs');
        }
    }

    public function eksporCSV($menu,$model,$fungsi,$id) {
        $menu = str_replace('%20',' ',$menu);
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Data ".$menu.".csv";
        $this->load->model($model);
        $result = $this->$model->$fungsi($id);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
    }

    public function eksporXML($menu,$model,$fungsi,$id) {
        $menu = str_replace('%20',' ',$menu);
        $filename = "Data ".$menu.".xml";
        $this->load->model($model);
        $result = $this->$model->$fungsi($id);
        $config = array (
            'root'          => 'root',
            'element'       => 'element',
            'newline'       => "\n",
            'tab'           => "\t"
        );
        $data = $this->dbutil->xml_from_result($result, $config);
        force_download($filename, $data);
    }

    public function imporIkkBps(){
        $this->load->model('IkkBpsModel');
        $fileName = time().'_'.$_FILES['file_ahs']['name'];
        
        $config['upload_path'] = './assets/doc/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 80000;

        $this->load->library('upload', $config);
         
        if (!$this->upload->do_upload('file_ahs')){
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            $this->AHSModel->impor($filename);
            unlink('./assets/doc/'.$filename);
            $this->session->set_flashdata('msg','Data IKK BPS berhasil diimpor.');
            redirect(base_url().'ahs');
        }
    }
    
}
