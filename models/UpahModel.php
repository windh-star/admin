<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class UpahModel extends CI_Model {
  public $tabel = "upah";
  public $view = "upah_wilayah";
  public $lengkapi_tabel = "lengkapi_upah";
  public $tabel_rf1 = "wilayah";
  public $primary_key = "id_upah";
  public $foreign_key = "id_wilayah";
  public $foreign_key1 = "id_wilayah";
  public $foreign_key2 = "id_proyek";
  public $primary_key_rf1 = "wilayah.id_wilayah";

  function getTabelLengkapiUpah($datatable){
      $wilayah = $this->input->post('wilayah');
      $jum_data = $this->db->where("id_wilayah",$wilayah)
                           ->get($this->lengkapi_tabel)->num_rows();
      if ($jum_data == 0) $tabel_upah = "lengkapi_upah_kosong";
      else $tabel_upah = $this->lengkapi_tabel;

      $columns = implode(', ', $datatable['col-display']);
      $sql  = "SELECT {$columns} FROM {$tabel_upah}";

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
      if ($jum_data != 0) if ($wilayah != '') $where .= 'id_wilayah = "'. $wilayah .'"';

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
      // $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])-1]} {$datatable['order'][0]['dir']}";
      
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
             $data[] = $row->$columnd[$i];
         }
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
  }

  function getTabelUpah($datatable){
      $columns = implode(', ', $datatable['col-display']);
    //   $columns = str_replace('id_wilayah', 'upah.id_wilayah', $columns);
    //   $join = "INNER JOIN {$this->tabel_rf1} ON {$this->foreign_key1} = {$this->primary_key_rf1}";
    //   $sql  = "SELECT {$columns} FROM {$this->tabel} {$join}";
    $query  = "(SELECT upah.*, wilayah.wilayah from upah, wilayah where upah.id_wilayah=wilayah.id_wilayah) a";


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

      $wilayah = $this->input->post('wilayah');
      $namaproyek = $this->input->post('namaproyek');
      $sumber = $this->input->post('sumber');
      
      if ($wilayah != '') $where .= ($where != '' ? ' AND ' : '').$this->foreign_key1 .' = "'. $wilayah .'"';
      if ($namaproyek != '') $where .= ($where != '' ? ' AND ' : '').$this->foreign_key2 .' = "'. $namaproyek .'"';
      if ($sumber != '') $where .= ($where != '' ? ' AND ' : '').'sumber = "'. $sumber .'"';
      
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
       

    //   $wilayah = $this->input->post('wilayah');
    //   if ($wilayah != '') $where .= $this->foreign_key .' = "'. $wilayah .'"'; else $where .= $this->foreign_key .' = ""'; 

    //   if ($search != '') {
    //       if ($where != '') $where .= ' AND ('; else $where .= ' (';
    //       for ($i=0; $i < $count_c ; $i++) {
    //           $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
    //           if ($i < $count_c - 1) {
    //               $where .= ' OR ';
    //           }
    //       }
    //       $where .= ')';
    //   }
      
    //   if ($where != '') {
    //       $sql .= " WHERE " . $where;  
    //   }

    //   $sql .= " AND (harga_dasar IS NOT NULL OR harga_dasar <> '')";

      // get total filtered
      $data = $this->db->query($sql);
      $total_filter = $data->num_rows();
      $data->free_result(); ///dikosongkan lagi
      
      //group
      $sql .= " GROUP BY ".$this->foreign_key.",".$this->primary_key.",id_proyek";

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
             if ($i == 6) $data[] = "Rp ".number_format($row->$columnd[$i], 2, ",", ".");
             else
            $field=$columnd[$i];
             $data[] = $row->$field;
         }
         $data[] = "<div class='btn-group'>".
         "<button onclick='tampilUbahUpah(".$data[1].")' type='button' class='btn btn-success btn-xs' id='ubah' data-toggle='modal' title='Ubah' data-target='#ModalUbah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
         "<button onclick='hapusUpah(".$data[1].")' type='button' class='btn btn-danger btn-xs' id='hapus' data-toggle='modal' title='Hapus' data-target='#ModalHapus' data-id='$data[1]'><i class='fa fa-trash'></i></button>".
     "</div>";
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
  }

  function getRingkasanStatus($id_wilayah){
      if ($id_wilayah != '0') $where = "WHERE ".$this->foreign_key."='".$id_wilayah."'"; else $where = "";
      return $this->db->query("SELECT ".$this->foreign_key.",SUM(belum_lengkap) as belum_lengkap,SUM(terverifikasi) as terverifikasi,
      SUM(belum_terverifikasi) as belum_terverifikasi from (SELECT ".$this->foreign_key.",IF(harga_dasar = 0,COUNT(*),0) AS `belum_lengkap`,
      IF((harga_dasar > 0) and (STATUS = '1'),COUNT(*),0) AS `terverifikasi`,IF((harga_dasar > 0) and (STATUS = '0'),COUNT(*),0) AS `belum_terverifikasi`
      FROM (select * from ".$this->view." GROUP BY ".$this->foreign_key.",id_proyek,".$this->primary_key.") a ".$where." group by harga_dasar,STATUS) b");
  }

  function getMaxIDUpah(){
      return $this->db->select('coalesce('.$this->primary_key.',0)+1 as id')
                      ->order_by($this->primary_key,'desc')
                      ->limit('1')
                      ->get($this->tabel);
  }
  
  function getSuggestTahun($sumber,$id_wilayah){
      return $this->db->select('tahun,COUNT(*) AS jumlah')
                      ->where('id_wilayah',$id_wilayah)
                      ->where("id_proyek","1")
                      ->where("sumber",$sumber)
                      ->group_by('tahun')
                      ->order_by('jumlah','desc')
                      ->limit('1')
                      ->get($this->tabel);
  }
  
  function getSuggestKeterangan($sumber,$id_wilayah){
      return $this->db->select('keterangan,COUNT(*) AS jumlah')
                      ->where('id_wilayah',$id_wilayah)
                      ->where("id_proyek","1")
                      ->where("sumber",$sumber)
                      ->group_by('keterangan')
                      ->order_by('jumlah','desc')
                      ->limit('1')
                      ->get($this->tabel);
  }

  function getUpahKriteria($kriteria, $keyword){
    return $this->db->where($kriteria, $keyword)
                    ->group_by($this->foreign_key,$this->primary_key,"id_proyek")
                    ->get($this->view);
  }
  
  function getRincianUpah($id){
        return $this->db->query("SELECT id_upah as id_kategori,nama_upah as nama_kategori,satuan,sumber FROM temp_upah WHERE id_upah='".$id."'
                                 UNION SELECT id_upah as id_kategori,nama_upah as nama_kategori,satuan,sumber
                                 FROM upah WHERE id_wilayah='34.04' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND id_upah='".$id."' GROUP BY nama_upah");
  }

  function getLengkapiUpahKriteria($kriteria, $keyword){
    $jum_data = $this->db->count_all_results($this->lengkapi_tabel);
    if ($jum_data == 0) $tabel_upah = "lengkapi_upah_kosong";
    else $tabel_upah = $this->lengkapi_tabel;

    return $this->db->where($kriteria, $keyword)
                    ->get($tabel_upah);
  }
  
  function getListUpah($wilayah,$keyword,$page,$limit){
        return $this->db->query("SELECT id_upah as id,nama_upah as text FROM temp_upah WHERE nama_upah LIKE '%".$keyword."%' UNION SELECT id_upah as id,nama_upah as text
                                 FROM upah WHERE id_wilayah='".$wilayah."' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND nama_upah LIKE '%".$keyword."%'
                                 GROUP BY nama_upah ORDER BY text LIMIT ".$page.",".$limit)->result_array();
  }

  function getJumlahListUpah($wilayah,$keyword){
        return $this->db->query("SELECT id_upah as id,nama_upah as text FROM temp_upah WHERE nama_upah LIKE '%".$keyword."%' UNION SELECT id_upah as id,nama_upah as text
                                 FROM upah WHERE id_wilayah='".$wilayah."' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND nama_upah LIKE '%".$keyword."%'
                                 GROUP BY nama_upah")->num_rows();
  }

//   function getListUpah($wilayah,$keyword,$page,$limit){
//         return $this->db->select("nama_upah as id, nama_upah as text")
//                         ->like("nama_upah", $keyword)
//                         ->where("(sumber = '1' OR sumber = '2')", NULL, FALSE)
//                         ->where("id_wilayah", $wilayah)
//                         ->group_by("nama_upah")
//                         ->get($this->tabel, $limit, $page)->result_array();
//   }

//   function getJumlahListUpah($wilayah,$keyword){
//     return $this->db->like("nama_upah", $keyword)
//                     ->where("(sumber = '1' OR sumber = '2')", NULL, FALSE)
//                     ->where("id_wilayah", $wilayah)
//                     ->group_by("nama_upah")
//                     ->count_all_results($this->tabel);
//   }

  function simpanUpah($data){
      $val = array(
          'id_upah' => $data['id_upah'],
          'id_wilayah' => $data['id_wilayah'],
          'id_proyek' => '1',
          'id_pelaksana' => '1',
          'nama_upah' => $data['nama_upah'],
          'spesifikasi' =>  $data['spesifikasi'],
          'merk' =>  $data['merk'],
          'satuan' =>  $data['satuan'],
          'harga_dasar' =>  $data['harga_dasar'],
          'tahun' =>  $data['tahun'],
          'sumber' =>  $data['sumber'],
          'keterangan' =>  $data['keterangan'],
          'status' => '0',
          'tgl_dibuat' => date("Y-m-d"),
          'jam_dibuat' => date("H:m:s")
      );

      $this->db->insert($this->tabel, $val);
  }

  function ubahUpah($data){
      $val = array(
          'id_wilayah' => $data['id_wilayah'],
          'id_proyek' => '1',
          'id_pelaksana' => '1',
          'nama_upah' => $data['nama_upah'],
          'spesifikasi' =>  $data['spesifikasi'],
          'merk' =>  $data['merk'],
          'satuan' =>  $data['satuan'],
          'harga_dasar' =>  $data['harga_dasar'],
          'tahun' =>  $data['tahun'],
          'sumber' =>  $data['sumber'],
          'keterangan' =>  $data['keterangan'],
          'tgl_dibuat' => date("Y-m-d"),
          'jam_dibuat' => date("H:m:s")
      );

      $this->db->where("urut",$data['urut_upah'])
               ->update($this->tabel, $val);
  }

  function verifikasiUpah($urut){
      $val = array(
          'status' =>  '1'
      );

      $this->db->where("urut",$urut)
               ->update($this->tabel, $val);
  }

  function verifikasiSemuaUpah(){
      $val = array(
          'status' =>  '1'
      );

      $this->db->update($this->tabel, $val);
  }

  function getInfoUpah($id_upah){
    $this->db->select('*');
    $this->db->from('upah');
    $this->db->join('wilayah', 'wilayah.id_wilayah = upah.id_wilayah' );
    $this->db->join('proyek', 'proyek.id_proyek = upah.id_proyek' );
    $this->db->where('upah.id_upah', $id_upah);
    $query = $this->db->get();
    return $query->result();
}

// function getInfoUpah($id_upah){
//     $this->db->select('*');
//     $this->db->from('upah');
//     $this->db->join('wilayah', 'wilayah.id_wilayah = upah.id_wilayah' );
//     $this->db->join('proyek', 'proyek.id_proyek = upah.id_proyek' );
//     $this->db->where('upah.id_upah', $id_upah);
//     return $this->db->get();
// }

function getRingkasanSumberUpah(){
    return $this->db->query("SELECT id_bahan,SUM(shbj) as shbj,SUM(estimatorid) as estimatorid, SUM(survey) as survey from (SELECT id_bahan,IF(sumber = '1',COUNT(*),0) AS `shbj`, IF(sumber = '2',COUNT(*),0) AS `estimatorid`,IF(sumber = '0',COUNT(*),0) AS `survey` FROM (select * from upah GROUP BY id_upah) a group by sumber) b");
}
}