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
        return $this->db->select("COUNT(id_pengguna) as total,id_wilayah")
                        ->where("kategori_akun = '1'")
                        ->or_where("kategori_akun = '2'")
                        ->get("pengguna");
    }


    function getTotalSuplier(){
        return $this->db->query("SELECT id_pengguna FROM pengguna WHERE kategori_akun = 3");
    }

    public function totalSuplier(){
        return $this->db->select("COUNT(id_pengguna) as total,id_wilayah")
                        ->where("kategori_akun = '1'")
                        ->get("pengguna");
    }

    function getTotalProyek(){
        return $this->db->query("SELECT id_proyek FROM proyek");
    }

    public function totalProyek(){
        return $this->db->select("COUNT(id_proyek) as total,id_wilayah")
                        ->get("proyek");
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
    
  

  //TrenEstimator
    public function TrenEstimatorAllTahun(){
        return $this->db->select("nama_pengguna as estimator, COUNT(nama_pengguna) as total")
                        ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                        ->where('kategori_akun', '1')
                        ->or_where('kategori_akun','2')
                        ->get('pengguna')->result_array();
        }
    public function TrenEstimatorPerBulan(){
        return $this->db->select('nama_pengguna as estimator, COUNT(nama_pengguna) as total')
                        ->where('MONTH(tgl_dibuat)', 'MONTH(NOW())', FALSE)
                        ->where('kategori_akun', '1')
                        ->or_where('kategori_akun','2')
                        ->get('pengguna')->result_array();
    }

    public function FilterTrenEstimatorPerBulan(){
    for($i=0; $i<=12; $i++){
        $this->db->select('COUNT(nama_pengguna) as total')
                 ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                 ->where('kategori_akun', '1')
                 ->or_where('kategori_akun','2')
                 ->where('MONTH(tgl_dibuat)', $i);
        $data[] = $this->db->get('pengguna')->row()->total;
        }
    return $data;
    }
    public function FilterEstimatorTahun(){
        return $this->db->select("nama_pengguna as estimator, COUNT(nama_pengguna) as total, YEAR(tgl_dibuat) as tahun")
                        ->group_by('YEAR(tgl_dibuat)')
                        ->where('kategori_akun', '1')
                        ->or_where('kategori_akun','2')
                        ->get('pengguna')->result_array();
    }


    //TrenSuplier
    public function TrenSuplierAllTahun(){
        return $this->db->select("nama_pengguna as suplier, COUNT(nama_pengguna) as total")
                        ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                        ->where('kategori_akun', '3')
                        ->get('pengguna')->result_array();
        }
    public function TrenSuplierPerBulan(){
        return $this->db->select('nama_pengguna as suplier, COUNT(nama_pengguna) as total')
                        ->where('MONTH(tgl_dibuat)', 'MONTH(NOW())', FALSE)
                        ->where('kategori_akun', '3')
                        ->get('pengguna')->result_array();
    }

    public function FilterTrenSuplierPerBulan(){
    for($i=0; $i<=12; $i++){
        $this->db->select('COUNT(nama_pengguna) as total')
                 ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                 ->where('MONTH(tgl_dibuat)', $i)
                 ->where('kategori_akun', '3');
        $data[] = $this->db->get('pengguna')->row()->total;
        }
    return $data;
    }
    public function FilterSuplierTahun(){
        return $this->db->select("nama_pengguna as suplier, COUNT(nama_pengguna) as total, YEAR(tgl_dibuat) as tahun")
                        ->group_by('YEAR(tgl_dibuat)')
                        ->where('kategori_akun', '3')
                        ->get('pengguna')->result_array();
    }

  //TrenProyek
  public function TrenProyekAllTahun(){
    return $this->db->select("nama_proyek as proyek, COUNT(nama_proyek) as total")
                    ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                    ->get('proyek')->result_array();
    }
public function TrenProyekPerBulan(){
    return $this->db->select('nama_proyek as proyek, COUNT(nama_proyek) as total')
                    ->where('MONTH(tgl_dibuat)', 'MONTH(NOW())', FALSE)
                    ->get('proyek')->result_array();
}

public function FilterTrenProyekPerBulan(){
for($i=0; $i<=12; $i++){
    $this->db->select('COUNT(nama_proyek) as total')
                ->where('YEAR(tgl_dibuat)', 'YEAR(NOW())', FALSE)
                ->where('MONTH(tgl_dibuat)', $i);
                $data[] = $this->db->get('proyek')->row()->total;
    }
return $data;
}
public function FilterProyekTahun(){
    return $this->db->select("nama_proyek as proyek, COUNT(nama_proyek) as total, YEAR(tgl_dibuat) as tahun")
                    ->group_by('YEAR(tgl_dibuat)')
                    ->get('proyek')->result_array();
}

    //GRAFIK BARU 

    function fetch_year()
    {
     $this->db->select('year');
     $this->db->from('view_proyek');
     $this->db->group_by('year');
     $this->db->order_by('year', 'DESC');
     return $this->db->get();
    }
   
    function fetch_chart_data($year)
    {
     $this->db->select('month, day, count(total) as total');
     $this->db->where('year =', $year);
     $this->db->group_by('month');
     $this->db->order_by('month ', 'ASC');
     return $this->db->get('view_proyek');
    }

    function fetch_chart_data_estimator($year)
    {
    $this->db->select('month, day, count(total) as total');
     $this->db->where('year =', $year);
     $this->db->where('kategori_akun', '1');
     $this->db->or_where('kategori_akun','2');
     $this->db->group_by('month');
     $this->db->order_by('month ', 'ASC');
     return $this->db->get('views_pengguna');
    }


    function fetch_chart_data_suplier($year)
    {
    $this->db->select('month, day, count(total) as total');
     $this->db->where('year =', $year);
     $this->db->where('kategori_akun', '3');
     $this->db->group_by('month');
     $this->db->order_by('month ', 'ASC');
     return $this->db->get('views_pengguna');
    }

    // function fetch_chart_data_suplier($year)
    // {
    //  $this->db->select('month, day, count(total) as total');
    //  $this->db->where('year =', $year);
    //  $this->db->where('kategori_akun =', '3');
    //  $this->db->group_by('month');
    //  $this->db->order_by('month ', 'ASC');
    //  return $this->db->get('views_pengguna');
    // }
}