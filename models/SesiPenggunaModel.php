<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class SesiPenggunaModel extends CI_Model{
    public $tabel = "sesi_pengguna";
    public $id_login = "id_login";
   

    function getTabelSesiPengguna($datatable){
        $columns = implode(', ', $datatable['col-display']);
        $query  = "(SELECT sesi_pengguna.id_login, sesi_pengguna.ip_address, sesi_pengguna.platform, sesi_pengguna.browser, pengguna.nama_pengguna, sesi_pengguna.foto, proyek.nama_proyek, sesi_pengguna.time FROM sesi_pengguna,pengguna,proyek where sesi_pengguna.id_pengguna=pengguna.id_pengguna and sesi_pengguna.id_proyek=proyek.id_proyek) a";
  
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
            $data[] = $row->$field;
          }
           $option['data'][] = $data;
        }
  
        // eksekusi json
        return print_r(json_encode($option));
    }
}