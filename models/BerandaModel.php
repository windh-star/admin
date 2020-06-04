<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class BerandaModel extends CI_Model {

    function getTotalEstimator(){
        return $this->db->query("SELECT id_pengguna FROM pengguna WHERE kategori_akun = 1 OR kategori_akun = 2 ");
    }

    public function totalEstimator(){
        return $this->db->select("COUNT(id_pengguna) as total")
                        ->where("kategori_akun = '1'")
                        ->or_where("kategori_akun = '2'")
                        ->get("pengguna")->result_array();
    }


    function getTotalSuplier(){
        return $this->db->query("SELECT id_pengguna FROM pengguna WHERE kategori_akun = 3");
    }

    public function totalSuplier(){
        return $this->db->select("COUNT(id_pengguna) as total")
                        ->where("kategori_akun = '1'")
                        ->get("pengguna")->result_array();
    }

    function getTotalProyek(){
        return $this->db->query("SELECT id_proyek FROM proyek");
    }

    public function totalProyek(){
        return $this->db->select("COUNT(id_proyek) as total")
                        ->get("proyek")->result_array();
    }

    function getGrafikProyek(){
       // return $this->db->query("SELECT tgl_dibuat, COUNT(id_proyek) AS total FROM proyek GROUP BY tgl_dibuat");
            
        $sql = mysqli_query("SELECT tgl_dibuat, COUNT(id_proyek) AS total FROM proyek GROUP BY tgl_dibuat");
        $data_tanggal = array();
        $data_total = array();

        while ($data = mysqli_fetch_array($sql)) {
        $data_tanggal[] = date('d-m-Y', strtotime($data['tgl_dibuat'])); // Memasukan tanggal ke dalam array
        $data_total[] = $data['total']; // Memasukan total ke dalam array
        }

    }
}