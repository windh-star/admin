<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class IkkBpsModel extends CI_Model{
    public $tabel = "ikk_bps";
   

    function getTabelIkkBps($datatable){
      $columns = implode(', ', $datatable['col-display']);
      $query  = "(SELECT ikk_bps.id_wilayah, ikk_bps.ikk, wilayah.wilayah FROM ikk_bps,wilayah WHERE ikk_bps.id_wilayah = wilayah.id_wilayah) a";

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
      $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])-2]} {$datatable['order'][0]['dir']}";
      
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
         $data[] = "<div class='btn-group'>".
         "<button type='button' class='btn btn-success btn-sm' id='btn-ubah-kategori' onclick='TampilubahKategori(".$data[1].")' title='Ubah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
     "</div>";
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
       
    }
    function getListIkkBps($keyword, $page, $limit){
        return $this->db->select("wilayah as text")
                        ->like("wilayah", $keyword)
                        ->get($this->tabel, $limit, $page)->result_array();
    }
    function getJumlahListIkkBps($keyword){
        return $this->db->select("wilayah as text")
                        ->like("wilayah", $keyword)
                        ->count_all_results($this->tabel);
    }

    function ubahIkkBps($data){
      $val = array(
          'id_wilayah' => $data['id_wilayah'],
          'ikk' => $data['ikk']
      );

      $this->db->where("id_wilayah",$data['id_wilayah'])
               ->update($this->tabel, $val);
      }

    function impor($filename){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1800);
        $inputFileName = './assets/doc/'.$filename;
  
        try {
          $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
          die('Error loading file :' . $e->getMessage());
        }
  
        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
  
      //   $this->perbaharuiAHS(trim($worksheet[2]["M"]));
      //   $this->perbaharuiPekerjaan();
      //   $this->perbaharuiBUA();
        $id_pekerjaan = '';
        
          
          //simpan pekerjaan
          if (trim($worksheet[$i]["B"]) == '') $id_pekerjaan = trim($worksheet[$i]["A"]);
          else if (trim($worksheet[$i]["B"]) != $id_pekerjaan) $id_pekerjaan = trim($worksheet[$i]["B"]);
          $val = array(
          
            "id_wilayah"    => $id_wilayag,
            "ikk"    => trim($worksheet[$i]["B"])
          
          );
  
          $this->db->insert($this->tabel, $val);
  
        }
}