<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class WilayahProdukModel extends CI_Model{
    public $tabel = "wilayah_produk";

    function getTabelWilayahProduk($datatable){
      $columns = implode(', ', $datatable['col-display']);
      $query  = "(SELECT wilayah_produk.*,produk.nama_produk,wilayah.wilayah,a.provinsi FROM wilayah_produk,produk,wilayah,(SELECT wilayah.id_wilayah, wilayah.wilayah as provinsi from wilayah,wilayah_produk WHERE kategori='1' AND wilayah_produk.id_provinsi=wilayah.id_prov ) a where wilayah_produk.id_provinsi=wilayah.id_prov AND wilayah_produk.id_produk=produk.id_produk) a";

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
            if ($i == 5) $data[] = "Rp ".number_format($row->$field, 2, ",", ".");
            else $data[] = $row->$field;
         }
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
    }


}