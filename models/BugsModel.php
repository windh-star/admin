<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class BugsModel extends CI_Model{
    public $tabel = "bugs";
   

    function getTabelBugs(){
        $columns = implode(', ', $datatable['col-display']);
        $query  = "(SELECT * FROM {$this->tabel}) a";
  
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
    function getJumlahListBugs($keyword){
        return $this->db->select("id_pengguna as id, bugs as text")
                        ->like("nama_pengguna", $keyword)
                        ->count_all_results($this->tabel);
    }

    	//Range Tanggal Bugs
	function get_range($min,$max){
		$this->db->select('*')
			  	 ->from('bugs')
				 ->where('tgl_dibuat >=',$min)
				 ->where('tgl_dibuat <=',$max);
		return $this->db->get()->result();
	}
}