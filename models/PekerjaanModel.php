<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class PekerjaanModel extends CI_Model{
    public $tabel = "pekerjaan";
    public $ref1 = "proyek";
    public $primary_key = "id_pekerjaan";
    public $foreign_key = "id_proyek";
    public $foreign_key1 = "pekerjaan.id_proyek";
    public $foreign_key_ref1 = "proyek.id_proyek";
    
    function getTabelPekerjaan($datatable){
        $this->input->post('pekerjaan');
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
           ///filter 
           $proyek = $this->input->post('nama_proyek');
           if($proyek != ''){ 
           $where .= $this->foreign_key1 .'=" '. $proyek .'"';
           if($search != '' ) {
               if($where != '') $where .= ' AND ('; else $where .= '(';
               for($i=0; $i<$count_c; $i++){
                   $where .= $columnd[$i] . ' LIKE "%' . $search .'%"';
                   if($i<$count_c -1 ){
                       $where .= ' OR ';
                   }
               }
               $where .= ')';
           }
           }else{
             for ($i=0; $i < $count_c ; $i++) {
                 $where .= $columnd[$i] . ' LIKE "%'. $search .'%"';
                 if ($i < $count_c - 1) {
                     $where .= ' OR ';
                   }
               }
           }
           if($where != ''){
               $sql .= " WHERE " . $where;
           }
             ///get total filtered
        $data = $this->db->query($sql);
        $total_filter = $data->num_rows();
        $data->free_result();
        
        $sql .= " GROUP BY ".$this->foreign_key1.",".$this->foreign_key_ref1."";
        
        ///sorting
        $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])- 1]} {$datatable['order'][0]['dir']} ";
        
        ///limit 
        $start = $datatable['start'];
        $length = $datatable['length'];
        $sql .= "LIMIT {$start}, {$length}";
        $data = $this->db->query($sql);
        
        $option['draw']             = $datatable['draw'];
        $option['recordsTotal']     = $total_data;
        $option['recordsFiltered']  = $total_filter;
        $option['data']             = array();
        
        foreach($data->result() as $row){
            $data = array();
            $data[] = null;
            for ($i=0; $i<$count_c; $i++){
                $data[] = $row->$columnd[$i];
            }
            $data[] = "<div class='btn-group'>".
           "<button onclick='ubahPekerjaan(".$data[1].")' type='button' class='btn btn-success btn-xs' id='ubah' data-toggle='modal' title='Ubah' data-target='#ModalUbah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
           "<button onclick='hapusPekerjaan(".$data[1].")' type='button' class='btn btn-danger btn-xs' id='hapus' data-toggle='modal' title='Hapus' data-target='#ModalHapus' data-id='$data[1]'><i class='fa fa-trash'></i></button>".
       "</div>";

            $option['data'][] = $data;
        }
        return print_r(json_encode($option));
    }

    function ubahPekerjaan($data){
        $val = array(
            'nama_pekerjaan' => $data['nama_pekerjaan'],
            'satuan' => $data['satuan']
            );
       $this->db->where("id_pekerjaan", $data['id_pekerjaan'])
                ->update($this->tabel, $val);
    }

    public function hapusPekerjaan($data){
       $this->db->where('id_pekerjaan',$data['id_pekerjaan']);
       $this->db->delete('pekerjaan',$val);
   }
  
}