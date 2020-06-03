<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class KategoriPekerjaanModel extends CI_model{
    public $tabel = "kategori_pekerjaan";
    public $ref1 = "proyek";
    public $primary_key = "id_kategori";
    public $foreign_key = "id_proyek";
    public $foreign_key1 = "kategori_pekerjaan.id_proyek";
    public $foreign_key_ref1 = "proyek.id_proyek";

    
    function getTabelKategoriPekerjaan($datatable){
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
        $proyek = $this->input->post('proyek');
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
        
        $data = $this->db->query($sql);
        $total_filter = $data->num_rows();
        $data->free_result();
        
        //$sql .= " GROUP BY ".$this->foreign_key1.",".$this->foreign_key1."";
        
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
            "<button onclick='ubahKategoriPekerjaan(".$data[1].")' type='button' class='btn btn-success btn-xs' id='ubah' data-toggle='modal' title='Ubah' data-target='#ModalUbah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
            "<button onclick='hapusKategoriPekerjaan(".$data[1].")' type='button' class='btn btn-danger btn-xs' id='hapus' data-toggle='modal' title='Hapus' data-target='#ModalHapus' data-id='$data[1]'><i class='fa fa-trash'></i></button>".
        "</div>";
 
            $option['data'][] = $data;
        }
        return print_r(json_encode($option));
     }
     
     function getListKategori($keyword,$page,$limit){
        return $this->db->select("id_kategori as id, kategori as text, kategori")
    					->like("kategori", $keyword)
    					->get($this->tabel, $limit, $page)->result_array();
     }
     function getJumlahListKategori($keyword){
        return $this->db->select("id_kategori as id, kategori as text")
    					->like("kategori", $keyword)
						->count_all_results($this->tabel);
     }

     function getInfoKategori($id_kategori){
        $this->db->select('*');
        $this->db->from('kategori_pekerjaan');
        $this->db->join('proyek', 'proyek.id_proyek = kategori_pekerjaan.id_proyek' );
        $this->db->where('kategori_pekerjaan.id_kategori', $id_kategori);
        return $this->db->get();
     }
     function ubahKategori($data){
         $val = array(
             'level' => $data['level'],
             'kategori' => $data['kategori']
             );
        $this->db->where("id_kategori", $data['id_kategori'])
                 ->update($this->tabel, $val);
     }

     function simpanKategori($data){
         $val = array(
             'id_kategori' => $data['id_kategori'],
             'id_proyek' => $data['id_proyek'],
             'id_pelaksana' => $data['id_pelaksana'],
             'level' => $data['level'],
             'kategori' => $data['kategori']
             );
        $this->db->insert($this->tabel, $val);
     }

     public function hapusKategoriPekerjaan($data){
        $this->db->where('id_kategori',$data['id_kategori']);
        $this->db->delete('kategori_pekerjaan');
    }
}