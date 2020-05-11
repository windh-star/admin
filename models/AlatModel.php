<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class AlatModel extends CI_Model {
  public $tabel = "alat";
  public $view = "alat_wilayah";
  public $lengkapi_tabel = "lengkapi_alat";
  public $tabel_rf1 = "wilayah";
  public $primary_key = "id_alat";
  public $foreign_key = "id_wilayah";
  public $foreign_key1 = "alat.id_wilayah";
  public $primary_key_rf1 = "wilayah.id_wilayah";

  function getTabelLengkapiAlat($datatable){
      $wilayah = $this->input->post('wilayah');
      $jum_data = $this->db->where("id_wilayah",$wilayah)
                           ->get($this->lengkapi_tabel)->num_rows();
      if ($jum_data == 0) $tabel_alat = "lengkapi_alat_kosong";
      else $tabel_alat = $this->lengkapi_tabel;

      $columns = implode(', ', $datatable['col-display']);
      $sql  = "SELECT {$columns} FROM {$tabel_alat}";

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

  function getTabelAlat($datatable){
      $columns = implode(', ', $datatable['col-display']);
    //   $columns = str_replace('id_wilayah', 'alat.id_wilayah', $columns);
    //   $join = "INNER JOIN {$this->tabel_rf1} ON {$this->foreign_key1} = {$this->primary_key_rf1}";
    //   $sql  = "SELECT {$columns} FROM {$this->tabel} {$join}";
      $sql  = "SELECT {$columns} FROM {$this->view}";

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
      if ($wilayah != '') $where .= $this->foreign_key .' = "'. $wilayah .'"'; else $where .= $this->foreign_key .' = ""'; 

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

    //   $sql .= " AND (harga_dasar IS NOT NULL OR harga_dasar <> '')";

      // get total filtered
      $data = $this->db->query($sql);
      $total_filter = $data->num_rows();
      $data->free_result();
      
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
             else if ($i == 7) { 
              if ($row->$columnd[$i-1] == "0") $data[] = "<span class='label label-warning'>Belum Lengkap</span>";
              else {
                if ($row->$columnd[$i] == "1") $data[] = "<span class='label label-success'>Terverifikasi</span>";
                else $data[] = "<span class='label label-danger'>Belum Terverifikasi</span>";
              }
            } else $data[] = $row->$columnd[$i];
         }
         $data[] = null;
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

  function getMaxIDAlat(){
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

  function getAlatKriteria($kriteria, $keyword){
    return $this->db->where($kriteria, $keyword)
                    ->group_by($this->foreign_key,$this->primary_key,"id_proyek")
                    ->get($this->view);
  }
  
  function getRincianAlat($id){
        return $this->db->query("SELECT id_alat as id_kategori,nama_alat as nama_kategori,satuan,sumber FROM temp_alat WHERE id_alat='".$id."'
                                 UNION SELECT id_alat as id_kategori,nama_alat as nama_kategori,satuan,sumber
                                 FROM alat WHERE id_wilayah='34.04' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND id_alat='".$id."' GROUP BY nama_alat");
  }

  function getLengkapiAlatKriteria($kriteria, $keyword){
    $jum_data = $this->db->count_all_results($this->lengkapi_tabel);
    if ($jum_data == 0) $tabel_alat = "lengkapi_alat_kosong";
    else $tabel_alat = $this->lengkapi_tabel;

    return $this->db->where($kriteria, $keyword)
                    ->get($tabel_alat);
  }
  
  function getListAlat($wilayah,$keyword,$page,$limit){
        return $this->db->query("SELECT id_alat as id,nama_alat as text FROM temp_alat WHERE nama_alat LIKE '%".$keyword."%' UNION SELECT id_alat as id,nama_alat as text
                                 FROM alat WHERE id_wilayah='".$wilayah."' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND nama_alat LIKE '%".$keyword."%'
                                 GROUP BY nama_alat ORDER BY text LIMIT ".$page.",".$limit)->result_array();
  }

  function getJumlahListAlat($wilayah,$keyword){
        return $this->db->query("SELECT id_alat as id,nama_alat as text FROM temp_alat WHERE nama_alat LIKE '%".$keyword."%' UNION SELECT id_alat as id,nama_alat as text
                                 FROM alat WHERE id_wilayah='".$wilayah."' AND id_proyek = '1' AND (sumber = '1' OR sumber = '2') AND nama_alat LIKE '%".$keyword."%'
                                 GROUP BY nama_alat")->num_rows();
  }

//   function getListAlat($wilayah,$keyword,$page,$limit){
//         return $this->db->select("nama_alat as id, nama_alat as text")
//                         ->like("nama_alat", $keyword)
//                         ->where("(sumber = '1' OR sumber = '2')", NULL, FALSE)
//                         ->where("id_wilayah", $wilayah)
//                         ->group_by("nama_alat")
//                         ->get($this->tabel, $limit, $page)->result_array();
//   }

//   function getJumlahListAlat($wilayah,$keyword){
//     return $this->db->like("nama_alat", $keyword)
//                     ->where("(sumber = '1' OR sumber = '2')", NULL, FALSE)
//                     ->where("id_wilayah", $wilayah)
//                     ->group_by("nama_alat")
//                     ->count_all_results($this->tabel);
//   }

  function simpanAlat($data){
      $val = array(
          'id_alat' => $data['id_alat'],
          'id_wilayah' => $data['id_wilayah'],
          'id_proyek' => '1',
          'id_pelaksana' => '1',
          'nama_alat' => $data['nama_alat'],
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

  function ubahAlat($data){
      $val = array(
          'id_wilayah' => $data['id_wilayah'],
          'id_proyek' => '1',
          'id_pelaksana' => '1',
          'nama_alat' => $data['nama_alat'],
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

      $this->db->where("urut",$data['urut_alat'])
               ->update($this->tabel, $val);
  }

  function verifikasiAlat($urut){
      $val = array(
          'status' =>  '1'
      );

      $this->db->where("urut",$urut)
               ->update($this->tabel, $val);
  }

  function verifikasiSemuaAlat(){
      $val = array(
          'status' =>  '1'
      );

      $this->db->update($this->tabel, $val);
  }
}