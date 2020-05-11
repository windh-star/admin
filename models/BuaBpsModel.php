<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class BuaBpsModel extends CI_Model{
    public $tabel = "bua_bps";
   public $primary_key = "id_wilayah";
   public $id_kategori ="id_kategori";
   public $tabel_buabps = "tabel_buabps";

    function getTabelBUABPS($datatable){
      $columns = implode(', ', $datatable['col-display']);
      $query  = "(SELECT *,IF(kategori='A','Bahan',IF(kategori='B','Upah','Alat')) AS ket_kategori FROM {$this->tabel}) a";

      $sql  = "SELECT {$columns} FROM {$query}";

      // get total data
      $data = $this->db->query($sql);
      $total_data = $data->num_rows();
      $data->free_result();

      // pengkondisian aksi seperti next, search dan limit
      $columnd = $datatable['col-display'];
      $count_c = count($columnd);

      // search
      $search = $datatable['search']['value'];
      $where = '';

      //filter
      $kategori = $this->input->post('kategori');
      if ($kategori != '') $where .= "kategori = '{$kategori}'";

      if ($search != '') {
          if ($where != '') $where .= ' AND ('; else $where .= ' (';
          for ($i=0; $i < $count_c ; $i++) {
              $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
              if ($i < $count_c - 1) {
                  $where .= ' OR ';
              }
          }
          $where .= ')';
      }
      
      if ($where != '') {
          $sql .= " WHERE " . $where;
      }

      // get total filtered
      $data = $this->db->query($sql);
      $total_filter = $data->num_rows();
      $data->free_result();
      
      // sorting
      $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])-1]} {$datatable['order'][0]['dir']}";
      
      // limit
      $start  = $datatable['start'];
      $length = $datatable['length'];
      $sql .= " LIMIT {$start}, {$length}";
      $data = $this->db->query($sql);

      $option['draw']            = $datatable['draw'];
      $option['recordsTotal']    = $total_data;
      $option['recordsFiltered'] = $total_filter;
      $option['data']            = array();

      foreach ($data->result() as $row) {
         $data = array();
         $data[] = null;
         for ($i=0; $i < $count_c; $i++) {
            $field = $columnd[$i];
            if ($i == 6) $data[] = "Rp ".number_format($row->$field, 2, ",", ".");
            else $data[] = $row->$field;
         }
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
    }

    function getListBugs($keyword, $page, $limit){
        return $this->db->select("id_pengguna as id, bugs as text")
                        ->like("nama_pengguna", $keyword)
                        ->get($this->tabel, $limit, $page)->result_array();
    }
    function getJumlahListBuaBps($keyword){
        return $this->db->select("id_pengguna as id, bugs as text")
                        ->like("nama_pengguna", $keyword)
                        ->count_all_results($this->tabel);
    }

    //Rekap Jumlah Kategori BUA BPS, A = Bahan, B = Upah, C = Alat
	function getRingkasanKategoriBuaBps($id_wilayah){
        if ($id_wilayah != '0') $where = "WHERE ".$this->primary_key."='".$id_wilayah."'"; else $where = "";
    return $this->db->query("SELECT ".$this->primary_key.",SUM(bahan) as bahan,SUM(upah) as upah,
    SUM(alat) as alat from (SELECT ".$this->primary_key.",IF(kategori = 'A',COUNT(*),0) AS `bahan`,
    IF(kategori = 'B',COUNT(*),0) AS `upah`,IF(kategori = 'C',COUNT(*),0) AS `alat`
    FROM (select * from ".$this->tabel_buabps." GROUP BY ".$this->primary_key.") a ".$where." group by kategori) b");
}


}