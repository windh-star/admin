<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class ProdukController extends CI_controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("ProdukModel");
    }
    
    public function index(){
        $data['root_menu'] = 'Master Data';
        $data['menu'] = 'Produk';
        $data['halaman'] = 'produk/index';
        $this->load->view('layout', $data);
    }

    public function getTabelProduk(){
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $datatable  = $_POST;

            $datatable['col-display'] = array(
                                            'id_produk',
                                            'nama_bahan',
                                            'nama_pengguna',
                                            'sub_kategori',
                                            'nama_produk',
                                            'deskripsi',
                                            'spesifikasi',
                                            'dimensi',
                                            'berat',
                                            'daya',
                                            'kualitas',
                                            'warna',
                                            'material',
                                            'penggunaan',
                                            'merk',
                                            'satuan',
                                            'harga_dasar',
                                            'min_order',
                                            'free_ongkir',
                                            'garansi',
                                            'status',
                                            'paket',
                                            'tgl_berlaku_paket',
                                            'foto',
                                            'tags',
                                            'tgl_dibuat',
                                            'tgl_update',
                                            'jam_dibuat',
                                            'dilihat'
                                        );

            return $this->ProdukModel->getTabelProduk($datatable);
        }
    }

}