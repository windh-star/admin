<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class ProyekModel extends CI_model{
    public $tabel = "proyek";
    public $ref1 = "wilayah";
    public $ref2 = "pengguna";
    public $primary_key = "id_proyek";
    public $foreign_key = "id_wilayah";
    public $foreign_key1 = "proyek.id_wilayah";
    public $foreign_key2 = "id_pengguna";
    public $foreign_key_ref1 = "wilayah.id_wilayah";
    public $foreign_key_ref2 = "pengguna.id_pengguna";
    
    
    
    function getTabelProyek($datatable){
       $join = "INNER JOIN {$this->ref1} ON {$this->foreign_key1} = {$this->foreign_key_ref1}";
       $columns = implode(',', $datatable['col-display']);
       $sql = "SELECT {$columns} FROM {$this->tabel} {$join}";
       
       $data = $this->db->query($sql);
       $total_data = $data->num_rows();
       $data->free_result();
       
       $columnd = $datatable['col-display'];
       $count_c = count($columnd);
       
       $search = $datatable['search']['value'];
       $where ='';
       //filtering
       $wilayah = $this->input->post('wilayah');
       $pengguna = $this->input->post('pengguna');
       $tahun = $this->input->post('tahun');
       
       if ($wilayah != '') $where .= ($where != '' ? ' AND ' : '').$this->foreign_key1 .' = "'. $wilayah .'"';
       if ($pengguna != '') $where .= ($where != '' ? ' AND ' : '').$this->foreign_key2 .' = "'. $pengguna .'"';
       if ($tahun != '') $where .= ($where != '' ? ' AND ' : '').'tahun = "'. $tahun .'"';
       
        if ($search != '') {
              if ($where != '') $where .= ' AND ('; else $where .= ' (';
              for ($i=0; $i < $count_c ; $i++) {
                  $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                  if ($i < $count_c - 1) {
                      $where .= ' OR ';
                  }
              }
              $where .= ' )';
        }
          
        if ($where != ''){
            $sql .= " WHERE " . $where;
        }
        

           // get total filtered
        $data = $this->db->query($sql);
        $total_filter = $data->num_rows();
        $data->free_result();
         
         ///sorting
        $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])- 1]} {$datatable['order'][0]['dir']} ";
        
        ///limit
        $start = $datatable['start'];
        $length = $datatable['length'];
        $sql .= "LIMIT {$start}, {$length}";
        $data = $this->db->query($sql);
        
        $option['draw']         = $datatable['col-display'];
        $option['recordsTotal'] = $total_data;
        $option['recordsFiltered'] = $total_filter;
        $option['data']         = array();
        
        foreach($data->result() as $row){
            $data = array();
            $data[] = null;
            for($i=0; $i<$count_c; $i++){
                $data[] = $row->$columnd[$i];
            }
            $data[] = "<div class='btn-group'>".
           "<button onclick='ubahProyek(".$data[1].")' type='button' class='btn btn-success btn-xs' id='ubah' data-toggle='modal' title='Ubah' data-target='#ModalUbah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
       "</div>";

            $option['data'][] = $data;
            }
        return print_r(json_encode($option));
       }
    function getListProyek($keyword, $page, $limit){
        return $this->db->select("id_proyek as id, nama_proyek as text")
                        ->like("nama_proyek", $keyword)
                        ->get($this->tabel, $limit, $page)->result_array();
    }
    function getJumlahListProyek($keyword){
        return $this->db->select("id_proyek as id, nama_proyek as text")
                        ->like("nama_proyek", $keyword)
                        ->count_all_results($this->tabel);
    }
    function getInfoProyek($id_proyek){
        $this->db->select('*');
        $this->db->from('proyek');
        $this->db->join('wilayah', 'wilayah.id_wilayah = proyek.id_wilayah' );
        $this->db->where('proyek.id_proyek', $id_proyek);
        return $this->db->get();
    }
    function ubahProyek($data){
        $val = array(
            'id_proyek' => $data['id_proyek'],
            'id_pengguna' => $data['id_pengguna'],
            'nama_proyek' => $data['nama_proyek'],
            'id_wilayah' => $data['id_wilayah'],
            'pemilik' => $data['pemilik'],
            'tahun' => $data['tahun'],
            'jasa_kontraktor' => $data['jasa_kontraktor'],
            'pajak' => $data['pajak'],
            'keterangan_lain' => $data['keterangan_lain'],
            'status' => $data['status'],
            'foto' => $data['foto'],
            'tgl_dibuat' => $data['tgl_dibuat'],
            'jam_dibuat' => $data['jam_dibuat']
        );
        $this->db->where("id_proyek", $data['id_proyek'])
                 ->update($this->tabel, $val);
    }
    function simpanProyek($data){
        $val = array(
            'id_proyek' => $data['id_proyek'],
            'id_pengguna' => $data['id_pengguna'],
            'nama_proyek' => $data['nama_proyek'],
            'id_wilayah' => $data['id_wilayah'],
            'pemilik' => $data['pemilik'],
            'tahun' => $data['tahun'],
            'jasa_kontraktor' => $data['jasa_kontraktor'],
            'pajak' => $data['pajak'],
            'keterangan_lain' => $data['keterangan_lain'],
            'status' => $data['status'],
            'foto' => $data['foto'],
            'tgl_dibuat' => $data['tgl_dibuat'],
            'jam_dibuat' => $data['jam_dibuat']
        );
        $this->db->insert($this->tabel, $val);
    }
 
}