<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 10000);

class AHSModel extends CI_Model {
  public $tabel = "ahs";
  public $tabel_pekerjaan = "pekerjaan";
  public $tabel_bahan = "bahan";
  public $tabel_upah = "upah";
  public $tabel_alat = "alat";
  public $primary_key = "id_proyek";
  public $fk_wilayah = "id_wilayah";

	function getTabelAHS($datatable){
      $columns = implode(', ', $datatable['col-display']);
      $sql  = "(SELECT proyek.nama_proyek,ahs.*,IF(sumber='1','PUPR',IF(sumber='2','SNI',IF(sumber='3','ESTIMATOR ID','EMPIRIS'))) AS ket_sumber FROM ahs,proyek where ahs.id_proyek=proyek.id_proyek) ";

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
            if ($i == 4) { 
              if ($row->$columnd[$i] == "PUPR") $data[] = "<span class='label label-success'>".$row->$columnd[$i]."</span>";
              else $data[] = "<span style='background-color:yellow;'>".$row->$columnd[$i]."</span>";
            } else $data[] = $row->$columnd[$i];
         }
         $option['data'][] = $data;
      }

      // eksekusi json
      return print_r(json_encode($option));
  }

  function getRingkasanSumberAHS(){
		return $this->db->query("SELECT id_ahs,SUM(PUPR) as PUPR,SUM(SNI) as SNI, SUM(ESTIMATORID) as ESTIMATORID, SUM(EMPIRIS) as EMPIRIS from (SELECT id_ahs,IF(sumber = '1',COUNT(*),0) AS `PUPR`, IF(sumber = '2',COUNT(*),0) AS `SNI`,IF(sumber = '3',COUNT(*),0) AS `ESTIMATORID`,IF(sumber = '4',COUNT(*),0) AS `EMPIRIS` FROM (select * from ahs GROUP BY id_pekerjaan) a group by sumber) b");
	}

  function getRingkasanStatus($id_wilayah){
      $this->db->query("CREATE OR REPLACE VIEW rekap_bua_ahs AS
                        SELECT id_wilayah,id_pekerjaan,'A' AS kategori_bua,id_kategori FROM ahs,bahan
                        WHERE ahs.id_proyek = '1' AND kategori = 'A' AND bahan.id_proyek = '1' AND id_kategori = id_bahan AND id_wilayah = '".$id_wilayah."'
                        UNION SELECT id_wilayah,id_pekerjaan,'B' AS kategori_bua,id_kategori FROM ahs,upah
                        WHERE ahs.id_proyek = '1' AND kategori = 'B' AND upah.id_proyek = '1' AND id_kategori = id_upah AND id_wilayah = '".$id_wilayah."'
                        UNION SELECT id_wilayah,id_pekerjaan,'C' AS kategori_bua,id_kategori FROM ahs,alat
                        WHERE ahs.id_proyek = '1' AND kategori = 'C' AND alat.id_proyek = '1' AND id_kategori = id_alat AND id_wilayah = '".$id_wilayah."'
                        ORDER BY id_pekerjaan,kategori_bua");
      
      $rekap_bua = $this->db->query("SELECT * FROM rekap_bua_ahs")->num_rows();
      if ($rekap_bua > 0) {
          $this->db->query("CREATE OR REPLACE VIEW pekerjaan_ahs AS
                            SELECT rekap_bua_ahs.id_wilayah,wilayah,rekap_jumlah_ahs.id_pekerjaan,nama_pekerjaan,satuan_pekerjaan AS satuan,sumber,
                            if(((count(rekap_bua_ahs.id_kategori) - rekap_jumlah_ahs.jumlah) <> 0),'Belum Lengkap','Lengkap') AS STATUS,uraian_pekerjaan
                            FROM rekap_bua_ahs,rekap_jumlah_ahs,wilayah WHERE rekap_bua_ahs.id_pekerjaan = rekap_jumlah_ahs.id_pekerjaan AND
                            rekap_bua_ahs.id_wilayah = wilayah.id_wilayah GROUP BY rekap_jumlah_ahs.id_pekerjaan ORDER BY id_pekerjaan");
      } else {
          $this->db->query("CREATE OR REPLACE VIEW pekerjaan_ahs AS
                            SELECT id_wilayah,wilayah,id_pekerjaan,nama_pekerjaan,satuan_pekerjaan AS satuan,sumber,'Belum Lengkap' AS STATUS,uraian_pekerjaan
                            FROM rekap_jumlah_ahs,wilayah WHERE id_wilayah = '".$id_wilayah."' GROUP BY id_pekerjaan");
      }

      return $this->db->query("SELECT SUM(lengkap) AS lengkap,SUM(belum_lengkap) AS belum_lengkap FROM
                              (SELECT IF(STATUS = 'Lengkap',COUNT(*),0) AS `lengkap`,IF(STATUS = 'Belum Lengkap',COUNT(*),0) AS `belum_lengkap` FROM pekerjaan_ahs GROUP BY STATUS) a");
  }

  function cekDuplikatPekerjaan($id) {
    return $this->db->where('id_pekerjaan', $id)
                    ->count_all_results($this->tabel_pekerjaan);
  }

  function simpanPekerjaan($data){
      if ($data['nama_pekerjaan'] != '') {
        if ($this->cekDuplikatPekerjaan($data['id_pekerjaan']) == 0) {
          $val = array(
              'id_proyek' => '1',
              'id_pelaksana' => '1',
              'id_pekerjaan' => $data['id_pekerjaan'],
              'nama_pekerjaan' => $data['nama_pekerjaan'],
              'satuan' => $data['satuan'],
              'tgl_dibuat' => date("Y-m-d"),
              'jam_dibuat' => date("H:i:s")
          );

          $this->db->insert($this->tabel_pekerjaan, $val);
        }
      }
  }

  function cekDuplikatBahan($id) {
    return $this->db->where('id_bahan', $id)
                    ->count_all_results($this->tabel_bahan);
  }

  function simpanBahan($id_bahan,$nama_bahan,$satuan,$sumber){
      if ($this->cekDuplikatBahan($id_bahan) == 0) {
        $val = array(
            'id_bahan' => $id_bahan,
            'nama_bahan' => $nama_bahan,
            'spesifikasi' => 'Standar',
            'merk' => 'Standar',
            'satuan' => $satuan,
            'sumber' => $sumber
        );

        $this->db->insert("temp_".$this->tabel_bahan, $val);
      }
  }

  function cekDuplikatUpah($id) {
    return $this->db->where('id_upah', $id)
                    ->count_all_results($this->tabel_upah);
  }

  function simpanUpah($id_upah,$nama_upah,$satuan,$sumber){
      if ($this->cekDuplikatUpah($id_upah) == 0) {
        $val = array(
            'id_upah' => $id_upah,
            'nama_upah' => $nama_upah,
            'spesifikasi' => 'Standar',
            'merk' => 'Standar',
            'satuan' => $satuan,
            'sumber' => $sumber
        );

        $this->db->insert("temp_".$this->tabel_upah, $val);
      }
  }

  function cekDuplikatAlat($id) {
    return $this->db->where('id_alat', $id)
                    ->count_all_results($this->tabel_alat);
  }

  function simpanAlat($id_alat,$nama_alat,$satuan,$sumber){
      if ($this->cekDuplikatAlat($id_alat) == 0) {
        $val = array(
            'id_alat' => $id_alat,
            'nama_alat' => $nama_alat,
            'spesifikasi' => 'Standar',
            'merk' => 'Standar',
            'satuan' => $satuan,
            'sumber' => $sumber
        );

        $this->db->insert("temp_".$this->tabel_alat, $val);
      }
  }

  function simpanAHS($data){
      $this->simpanPekerjaan($data);
      if (isset($data['nama_bahan'])) {
        $nama_bahan = $data['nama_bahan'];
        if ($nama_bahan != '') {
          foreach($nama_bahan as $key => $val) {
            if ($data['nama_bahan'][$key] != '') {
              $this->simpanBahan($data['id_bahan'][$key],$data['nama_bahan'][$key],$data['satuan_bahan'][$key],$data['sumber_bahan'][$key]);
              $value[] = array(
                'id_proyek' => '1',
                'id_pelaksana' => '1',
                'id_kategori_pekerjaan' => $data['id_kategori_pekerjaan'],
                'id_pekerjaan' => $data['id_pekerjaan'],
                'nama_kategori_pekerjaan'    => $data['nama_kategori_pekerjaan'],
                'nama_pekerjaan'    => $data['nama_pekerjaan'],
                'satuan_pekerjaan'    => $data['satuan'],
                'kategori' => $data['kategori_bahan'][$key],
                'id_kategori' => $data['id_bahan'][$key],
                'koefisien' => $data['koefisien_bahan'][$key],
                'nama_kategori'    => $data['nama_bahan'][$key],
                'satuan_kategori'    => $data['satuan_bahan'][$key],
                'spesifikasi'    => "Standar",
                'merk'    => "Standar",
                'tahun_kategori'    => "",
                'sumber_kategori'    => $data['sumber_bahan'][$key],
                'harga_dasar'    => 0,
                'tahun' => $data['tahun'],
                'sumber' => $data['sumber'],
                'keterangan' => $data['keterangan'],
                'tgl_dibuat' => date("Y-m-d"),
                'jam_dibuat' => date("H:i:s")
              );
            }
          }  
        }  
      }
      
      if (isset($data['nama_upah'])) {
        $nama_upah = $data['nama_upah'];
        if ($nama_upah != '') {
          foreach($nama_upah as $key => $val) {
            if ($data['nama_upah'][$key] != '') {
              $this->simpanUpah($data['id_upah'][$key],$data['nama_upah'][$key],$data['satuan_upah'][$key],$data['sumber_upah'][$key]);
              $value[] = array(
                'id_proyek' => '1',
                'id_pelaksana' => '1',
                'id_kategori_pekerjaan' => $data['id_kategori_pekerjaan'],
                'id_pekerjaan' => $data['id_pekerjaan'],
                'nama_kategori_pekerjaan'    => $data['nama_kategori_pekerjaan'],
                'nama_pekerjaan'    => $data['nama_pekerjaan'],
                'satuan_pekerjaan'    => $data['satuan'],
                'kategori' => $data['kategori_upah'][$key],
                'id_kategori' => $data['id_upah'][$key],
                'koefisien' => $data['koefisien_upah'][$key],
                'nama_kategori'    => $data['nama_upah'][$key],
                'satuan_kategori'    => $data['satuan_upah'][$key],
                'spesifikasi'    => "Standar",
                'merk'    => "Standar",
                'tahun_kategori'    => "",
                'sumber_kategori'    => $data['sumber_upah'][$key],
                'harga_dasar'    => 0,
                'tahun' => $data['tahun'],
                'sumber' => $data['sumber'],
                'keterangan' => $data['keterangan'],
                'tgl_dibuat' => date("Y-m-d"),
                'jam_dibuat' => date("H:i:s")
              );
            }
          }   
        } 
      }
      
      if (isset($data['nama_alat'])) {
        $nama_alat = $data['nama_alat'];
        if ($nama_alat != '') {
          foreach($nama_alat as $key => $val) {
            if ($data['nama_alat'][$key] != '') {
              $this->simpanAlat($data['id_alat'][$key],$data['nama_alat'][$key],$data['satuan_alat'][$key],$data['sumber_alat'][$key]);
              $value[] = array(
                'id_proyek' => '1',
                'id_pelaksana' => '1',
                'id_kategori_pekerjaan' => $data['id_kategori_pekerjaan'],
                'id_pekerjaan' => $data['id_pekerjaan'],
                'nama_kategori_pekerjaan'    => $data['nama_kategori_pekerjaan'],
                'nama_pekerjaan'    => $data['nama_pekerjaan'],
                'satuan_pekerjaan'    => $data['satuan'],
                'kategori' => $data['kategori_alat'][$key],
                'id_kategori' => $data['id_alat'][$key],
                'koefisien' => $data['koefisien_alat'][$key],
                'nama_kategori'    => $data['nama_alat'][$key],
                'satuan_kategori'    => $data['satuan_alat'][$key],
                'spesifikasi'    => "Standar",
                'merk'    => "Standar",
                'tahun_kategori'    => "",
                'sumber_kategori'    => $data['sumber_alat'][$key],
                'harga_dasar'    => 0,
                'tahun' => $data['tahun'],
                'sumber' => $data['sumber'],
                'keterangan' => $data['keterangan'],
                'tgl_dibuat' => date("Y-m-d"),
                'jam_dibuat' => date("H:i:s")
              );
            }
          }  
        }
      }

      $this->db->insert_batch($this->tabel, $value);
  }

  function perbaharuiAHS($sumber){
      $this->db->where($this->primary_key, '1')
               ->where("sumber", $sumber)
               ->delete($this->tabel);
  }

  function perbaharuiPekerjaan(){
      $this->db->where($this->primary_key, '1')
               ->delete($this->tabel_pekerjaan);
  }

  function perbaharuiBUA(){
      $this->db->where("sumber", '1')->delete("temp_".$this->tabel_bahan);
      $this->db->where("sumber", '1')->delete("temp_".$this->tabel_upah);
      $this->db->where("sumber", '1')->delete("temp_".$this->tabel_alat);
      
    //   $this->db->query('truncate table temp_'.$this->tabel_bahan);
    //   $this->db->query('truncate table temp_'.$this->tabel_upah);
    //   $this->db->query('truncate table temp_'.$this->tabel_alat);
  }
  
  function replaceBUA($wilayah,$sumber){
      $this->db->where($this->fk_wilayah, $wilayah)
               ->where($this->primary_key, '1')
               ->where("sumber", $sumber)
               ->delete($this->tabel_bahan);
      
      $this->db->where($this->fk_wilayah, $wilayah)
               ->where($this->primary_key, '1')
               ->where("sumber", $sumber)
               ->delete($this->tabel_upah);
      
      $this->db->where($this->fk_wilayah, $wilayah)
               ->where($this->primary_key, '1')
               ->where("sumber", $sumber)
               ->delete($this->tabel_alat);
  }

  function getBUA($kategori,$bua){
      return $this->db->where('nama_'.$kategori,$bua)
                      ->where("sumber", '1')
                      ->count_all_results('temp_'.$kategori);
  }

  function getIDBUA($kategori,$bua){
      return $this->db->select('id_'.$kategori.' as id')
                      ->where('nama_'.$kategori,$bua)
                      ->where("sumber", '1')
                      ->get('temp_'.$kategori)->row();
  }

  function getMaxIDBUA($kategori){
      return $this->db->select('coalesce(id_'.$kategori.',0)+1 as id')
                      ->where("sumber", '1')
                      ->order_by('id_'.$kategori,'desc')
                      ->limit('1')
                      ->get('temp_'.$kategori)->row();
  }
  
//   function imporBUA(){
//       $sql  = "insert into bahan select null,`sigama_db`.`temp_bahan`.`id_bahan`,`wilayah`.`id_wilayah`,'1','1',`sigama_db`.`temp_bahan`.`nama_bahan`,
//               `sigama_db`.`temp_bahan`.`spesifikasi`,`sigama_db`.`temp_bahan`.`merk`,`sigama_db`.`temp_bahan`.`satuan`,0,'','1','','0',CURRENT_DATE(),CURRENT_TIME()
//               from (`sigama_db`.`wilayah` join `sigama_db`.`temp_bahan`)";
//       $this->db->query($sql);
      
//       $sql  = "insert into upah select null,`sigama_db`.`temp_upah`.`id_upah`,`wilayah`.`id_wilayah`,'1','1',`sigama_db`.`temp_upah`.`nama_upah`,
//               `sigama_db`.`temp_upah`.`spesifikasi`,`sigama_db`.`temp_upah`.`merk`,`sigama_db`.`temp_upah`.`satuan`,0,'','1','','0',CURRENT_DATE(),CURRENT_TIME()
//               from (`sigama_db`.`wilayah` join `sigama_db`.`temp_upah`)";
//       $this->db->query($sql);
      
//       $sql  = "insert into alat select null,`sigama_db`.`temp_alat`.`id_alat`,`wilayah`.`id_wilayah`,'1','1',`sigama_db`.`temp_alat`.`nama_alat`,
//               `sigama_db`.`temp_alat`.`spesifikasi`,`sigama_db`.`temp_alat`.`merk`,`sigama_db`.`temp_alat`.`satuan`,0,'','1','','0',CURRENT_DATE(),CURRENT_TIME()
//               from (`sigama_db`.`wilayah` join `sigama_db`.`temp_alat`)";
//       $this->db->query($sql);
//   }

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
      for ($i=2; $i <= $numRows; $i++) { 
        if ($worksheet[$i]["D"] == '') break;
        if (trim($worksheet[$i]["F"]) == 'B') {
          $kategori = 'A';
          $nama_kategori = 'bahan';
        } else if (trim($worksheet[$i]["F"]) == 'U') {
          $kategori = 'B';
          $nama_kategori = 'upah';
        } else if (trim($worksheet[$i]["F"]) == 'A') {
          $kategori = 'C';
          $nama_kategori = 'alat';
        }
        
        //simpan pekerjaan
        if (trim($worksheet[$i]["B"]) == '') $id_pekerjaan = trim($worksheet[$i]["A"]);
        else if (trim($worksheet[$i]["B"]) != $id_pekerjaan) $id_pekerjaan = trim($worksheet[$i]["B"]);
        $val = array(
          "id_proyek"    => '1',
          "id_pelaksana"    => '1',
          "id_pekerjaan"    => $id_pekerjaan,
          "nama_pekerjaan"    => trim($worksheet[$i]["D"]),
          "satuan"    => trim($worksheet[$i]["E"]),
          "tgl_dibuat"    => date("Y-m-d"),
          "jam_dibuat"    => date("H:m:s")
        );

        $this->db->insert($this->tabel_pekerjaan, $val);

        //simpan temp_bua
        if (trim($worksheet[$i]["G"]) != '') {
          if ($this->getBUA($nama_kategori,trim($worksheet[$i]["G"])) == 0) {
            // $bua = $this->getMaxIDBUA($nama_kategori);
            // if ($bua == '') $id = 1; else $id = $bua->id;
            $val_bua = array(
                "id_".$nama_kategori    => trim($worksheet[$i]["C"]),
                "nama_".$nama_kategori    => trim($worksheet[$i]["G"]),
                "spesifikasi"    => trim($worksheet[$i]["H"]),
                "merk"    => trim($worksheet[$i]["I"]),
                "satuan"    => trim($worksheet[$i]["K"]),
                "sumber"    => "1"
            );

            $this->db->insert("temp_".$nama_kategori, $val_bua);
          }
        }

        //simpan ahs
        if (trim($worksheet[$i]["B"]) != '') {
          // $bua = $this->getIDBUA($nama_kategori,trim($worksheet[$i]["G"]));
          // $id_kategori = $bua->id;
          $val_ahs = array(
              "id_proyek"    => '1',
              "id_pelaksana"    => '1',
              "id_kategori_pekerjaan"    => trim($worksheet[$i]["A"]),
              "id_pekerjaan"    => trim($worksheet[$i]["B"]),
              "nama_kategori_pekerjaan"    => $kategori_pekerjaan,
              "nama_pekerjaan"    => trim($worksheet[$i]["D"]),
              "satuan_pekerjaan"    => trim($worksheet[$i]["E"]),
              "kategori"    => $kategori,
              "id_kategori"    => trim($worksheet[$i]["C"]),
              "koefisien"    => trim($worksheet[$i]["J"]),
              "nama_kategori"    => trim($worksheet[$i]["G"]),
              "satuan_kategori"    => trim($worksheet[$i]["K"]),
              "spesifikasi"    => trim($worksheet[$i]["H"]),
              "merk"    => trim($worksheet[$i]["I"]),
              "tahun_kategori"    => "",
              "sumber_kategori"    => "1",
              "harga_dasar"    => 0,
              "tahun"    => trim($worksheet[$i]["L"]),
              "sumber"    => trim($worksheet[$i]["M"]),
              "keterangan"    => trim($worksheet[$i]["N"]),
              "tgl_dibuat"    => date("Y-m-d"),
              "jam_dibuat"    => date("H:m:s")
          );

          $this->db->insert($this->tabel, $val_ahs);
        } else {
            $kategori_pekerjaan = trim($worksheet[$i]["D"]);
        }
      }
  }
  
  function imporBUA($filename){
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
      
    //   $this->replaceBUA(trim($worksheet[2]["C"]),trim($worksheet[2]["J"]));

      for ($i=2; $i <= $numRows; $i++) { 
        if ($worksheet[$i]["D"] == '') break;
        if (trim($worksheet[$i]["A"]) == 'B') $tabel = 'bahan';
        else if (trim($worksheet[$i]["A"]) == 'U') $tabel = 'upah';
        else if (trim($worksheet[$i]["A"]) == 'A') $tabel = 'alat';
        
        $val_bua = array(
          "id_".$tabel     => trim($worksheet[$i]["B"]),
          "id_wilayah"     => trim($worksheet[$i]["C"]),
          "id_proyek"      => 1,
          "id_pelaksana"   => 1,
          "nama_".$tabel   => trim($worksheet[$i]["D"]),
          "spesifikasi"    => trim($worksheet[$i]["E"]),
          "merk"           => trim($worksheet[$i]["F"]),
          "satuan"         => trim($worksheet[$i]["G"]),
          "harga_dasar"    => trim($worksheet[$i]["H"]),
          "tahun"          => trim($worksheet[$i]["I"]),
          "sumber"         => trim($worksheet[$i]["J"]),
          "keterangan"     => trim($worksheet[$i]["K"]),
          "status"         => 1,
          "tgl_dibuat"     => date("Y-m-d"),
          "jam_dibuat"     => date("H:m:s")
        );

        $this->db->insert($tabel, $val_bua);
      }
  }

  function getRincianAHS($proyek,$id_pekerjaan){
    return $this->db->query("SELECT * FROM (SELECT {$proyek} AS id_proyek,kategori AS level,id_pekerjaan,'H' AS id_kategori,kategori,nama_kategori,ROUND('0', 4) AS koefisien,'' AS spesifikasi,'' AS merk,'' AS satuan_kategori,ROUND('0', 2) AS harga_dasar,ROUND('0', 2) AS harga_satuan
                             FROM (SELECT id_pekerjaan,'A' AS kategori,'BAHAN' AS nama_kategori FROM harga_satuan WHERE id_proyek='{$proyek}' UNION SELECT id_pekerjaan,'B' AS kategori,'UPAH' AS nama_kategori FROM harga_satuan WHERE id_proyek='{$proyek}' UNION SELECT id_pekerjaan,'C' AS kategori,'ALAT' AS nama_kategori FROM harga_satuan WHERE id_proyek='{$proyek}'
                             ORDER BY id_pekerjaan,kategori) bua_pekerjaan1
                           
                             UNION SELECT {$proyek} AS id_proyek,'A.1' AS level,id_pekerjaan,id_kategori,kategori,nama_kategori,ROUND(koefisien, 4) AS koefisien,spesifikasi,merk,satuan_kategori,ROUND(harga_dasar, 2) AS harga_dasar,IF(satuan_kategori = '%',ROUND((koefisien*harga_dasar)/100,2),ROUND(koefisien*harga_dasar,2)) AS harga_satuan
                             FROM ahs WHERE id_proyek='{$proyek}' AND kategori='A'
                           
                             UNION SELECT {$proyek} AS id_proyek,'B.1' AS level,id_pekerjaan,id_kategori,kategori,nama_kategori,ROUND(koefisien, 4) AS koefisien,spesifikasi,merk,satuan_kategori,ROUND(harga_dasar, 2) AS harga_dasar,IF(satuan_kategori = '%',ROUND((koefisien*harga_dasar)/100,2),ROUND(koefisien*harga_dasar,2)) AS harga_satuan
                             FROM ahs WHERE id_proyek='{$proyek}' AND kategori='B'
                           
                             UNION SELECT {$proyek} AS id_proyek,'C.1' AS level,id_pekerjaan,id_kategori,kategori,nama_kategori,ROUND(koefisien, 4) AS koefisien,spesifikasi,merk,satuan_kategori,ROUND(harga_dasar, 2) AS harga_dasar,IF(satuan_kategori = '%',ROUND((koefisien*harga_dasar)/100,2),ROUND(koefisien*harga_dasar,2)) AS harga_satuan
                             FROM ahs WHERE id_proyek='{$proyek}' AND kategori='C'
                           
                             UNION SELECT {$proyek} AS id_proyek,CONCAT(kategori, '.2') AS level,id_pekerjaan,'F' AS id_kategori,kategori,'JUMLAH HARGA' AS nama_kategori,ROUND('0', 4) AS koefisien,'' AS spesifikasi,'' AS merk,'' AS satuan_kategori,ROUND('0', 2) AS harga_dasar,ROUND(SUM(IF(satuan_kategori = '%',(koefisien*harga_dasar)/100,koefisien*harga_dasar)),2) AS harga_satuan
                             FROM ahs WHERE id_proyek='{$proyek}' GROUP BY id_pekerjaan,kategori
                           
                             UNION SELECT {$proyek} AS id_proyek,CONCAT(kategori, '.3') AS level,id_pekerjaan,'F' AS id_kategori,kategori,CONCAT('JASA ',ROUND(jasa_kontraktor*100,2),' %') AS nama_kategori,ROUND('0', 4) AS koefisien,'' AS spesifikasi,'' AS merk,'' AS satuan_kategori,ROUND('0', 2) AS harga_dasar,ROUND(SUM(IF(satuan_kategori = '%',(koefisien*harga_dasar)/100,koefisien*harga_dasar))*jasa_kontraktor,2) AS harga_satuan
                             FROM ahs,proyek WHERE ahs.id_proyek=proyek.id_proyek AND ahs.id_proyek='{$proyek}' GROUP BY id_pekerjaan,kategori
                           
                             UNION SELECT {$proyek} AS id_proyek,CONCAT(kategori, '.4') AS level,id_pekerjaan,'F' AS id_kategori,kategori,'TOTAL HARGA' AS nama_kategori,ROUND('0', 4) AS koefisien,'' AS spesifikasi,'' AS merk,'' AS satuan_kategori,ROUND('0', 2) AS harga_dasar,ROUND(SUM(IF(satuan_kategori = '%',(koefisien*harga_dasar)/100,koefisien*harga_dasar))+(SUM(IF(satuan_kategori = '%',(koefisien*harga_dasar)/100,koefisien*harga_dasar))*jasa_kontraktor),2) AS harga_satuan
                             FROM ahs,proyek WHERE ahs.id_proyek=proyek.id_proyek AND ahs.id_proyek='{$proyek}' GROUP BY id_pekerjaan,kategori
                           
                             ORDER BY level,id_pekerjaan,kategori) a WHERE id_pekerjaan='{$id_pekerjaan}'");
   }
}