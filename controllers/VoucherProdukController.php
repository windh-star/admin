<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class VoucherProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("VoucherProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Voucher Produk';
        $data['halaman'] = 'voucherProduk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelVoucherProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_voucher',
                                            'kode_voucher',
                                            'nama_proyek',
                                            'nama_produk',
                                            'harga_diskon',
                                            'klaim',
                                            'nama_pengguna',
                                            'tgl_klaim',
                                            'jam_klaim',
                                            'batas_tgl_klaim',
                                            'status'
                                        );

            return $this->VoucherProdukModel->getTabelVoucherProduk($datatable);
        }
    }

}