<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class ArtikelModel extends CI_Model{
    public $tabel = "artikel";
    public $id_artikel = "id_artikel";
   

    function getTabelArtikel($datatable){
        $columns = implode(', ', $datatable['col-display']);
        $query  = "(SELECT *,IF(kategori='1','Artikel',IF(kategori='2','Berita','Even')) AS ket_kategori, IF(status='1','Publish','Pending') AS ket_status FROM {$this->tabel}) a";
  
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
  
        //filter kategori
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
  
          //filter status
          $status = $this->input->post('status');
          if ($status != '') $where .= "status = '{$status}'";
    
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
           $data[] = "<div class='btn-group'>".
           "<button type='button' class='btn btn-success btn-xs' id='ubah' data-toggle='modal' title='Ubah' data-target='#ModalUbah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
           "<button type='button' class='btn btn-danger btn-xs' id='hapus' data-toggle='modal' title='Hapus' data-target='#ModalHapus' data-id='$data[1]'><i class='fa fa-trash'></i></button>".
       "</div>";
           $option['data'][] = $data;
        }
  
        // eksekusi json
        return print_r(json_encode($option));
    }
    function getListArtikel($keyword, $page, $limit){
        return $this->db->select("judul_artikel as text")
                        ->like("judul_artikel", $keyword)
                        ->get($this->tabel, $limit, $page)->result_array();
    }
    function getJumlahListArtikel($keyword){
        return $this->db->select("judul_artikel as text")
                        ->like("judul_artikel", $keyword)
                        ->count_all_results($this->tabel);
    }

      //Rekap Jumlah Kategori Artikel, 1 = Artikel, 2 = Berita, 3 = Event
	function getRingkasanKategoriArtikel($id_artikel){
		if ($id_artikel != '0') $where = "WHERE ".$this->id_artikel."='".$id_artikel."'"; else $where = "";
		return $this->db->query("SELECT ".$this->id_artikel.",SUM(artikel) as artikel,SUM(berita) as berita,
		SUM(event) as event from (SELECT ".$this->id_artikel.",IF(kategori = '1',COUNT(*),0) AS `artikel`,
		IF(kategori = '2',COUNT(*),0) AS `berita`,IF(kategori = '3',COUNT(*),0) AS `event`
		FROM (select * from ".$this->tabel_artikel." GROUP BY ".$this->id_artikel.") a ".$where." group by kategori) b");
	}
}