<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);
class WilayahModel extends CI_Model {
	public $tabel = "wilayah";
	public $id_kategori ="id_kategori";
	public $tabel_buabps = "tabel_buabps";
	public $tabel_wilayah = "wilayah";

    function getTabelWilayah($datatable){
		$columns = implode(', ', $datatable['col-display']);
		$query  = "(SELECT wilayah.id_wilayah,wilayah.wilayah,kategori,IF(kategori='1','Provinsi','Kab/Kota') AS ket_kategori,a.provinsi FROM wilayah,(SELECT id_wilayah, wilayah as provinsi from wilayah WHERE kategori='1') a where wilayah.id_prov=a.id_wilayah) b";
  
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
			if ($i == 6) $data[] = "Rp ".number_format($row->$field, 2, ",", ".");
			else $data[] = $row->$field;
		 }
		   $option['data'][] = $data;
		}
  
		// eksekusi json
		return print_r(json_encode($option));
	}
	function getJumlahWilayah(){
      	return $this->db->count_all_results($this->tabel);
  	}

  	function getAllWilayah(){
		return $this->db->get($this->tabel);
	}

	function getWilayahKriteria($kriteria, $keyword){
		return $this->db->where($kriteria, $keyword)->get($this->tabel);
	}

  	function getWilayahHalaman($page, $size){
      	return $this->db->get($this->tabel, $size, $page);
    }

    function getListWilayah($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text, kategori")
    					->like("wilayah", $keyword)
    					->get($this->tabel_wilayah, $limit, $page)->result_array();
	}

	function getJumlahListWilayah($keyword){
      	return $this->db->select("id_wilayah as id, wilayah as text")
    					->like("wilayah", $keyword)
						->count_all_results($this->tabel_wilayah);
	  }
	  
	//Kategori Wilayah
	function getListKategoriWilayah($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text, kategori")
    					->like("kategori", $keyword)
    					->get($this->tabel_wilayah, $limit, $page)->result_array();
	}

	function getJumlahListKategoriWilayah($keyword){
      	return $this->db->select("id_wilayah as id, wilayah as text,kategori")
    					->like("kategori", $keyword)
						->count_all_results($this->tabel_wilayah);
	  }
	
	//Provinsi Wilayah

	function getListProvinsi($keyword,$page,$limit){
		return $this->db->select("id_wilayah as id, wilayah as text,kategori,id_prov")
		->where("kategori= 1 ")
		->like("wilayah", $keyword)
		->get($this->tabel_wilayah, $limit, $page)->result_array();
	}

	function getJumlahListProvinsi($keyword){
		return $this->db->select("id_wilayah as id, wilayah as text,kategori,id_prov")
					->where("kategori= 1 ")
					->like("wilayah", $keyword)
					->count_all_results($this->tabel_wilayah);
	  }
	  
	//Kategori BUA BPS
	function getListKategoriBuaBps($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text, kategori")
    					->like("kategori", $keyword)
    					->get($this->tabel_buabps, $limit, $page)->result_array();
	}

	function getJumlahListKategoriBuaBps($keyword){
      	return $this->db->select("id_wilayah as id, wilayah as text,kategori")
    					->like("kategori", $keyword)
						->count_all_results($this->tabel_buabps);
	  }

	//Rekap Jumlah Kategori BUA BPS, A = Bahan, B = Upah, C = Alat
	function getRingkasanKategoriBuaBps(){
		return $this->db->query("SELECT id_kategori,SUM(bahan) as bahan,SUM(upah) as upah, SUM(alat) as alat from (SELECT id_kategori,IF(kategori = 'A',COUNT(*),0) AS `bahan`, IF(kategori = 'B',COUNT(*),0) AS `upah`,IF(kategori = 'C',COUNT(*),0) AS `alat` FROM (select * from bua_bps GROUP BY id_kategori) a group by kategori) b");
	}
	
	//Range Tanggal Bugs
	function get_range($min,$max){
		$this->db->select('*')
			  	 ->from('bugs')
				 ->where('tgl_dibuat >=',$min)
				 ->where('tgl_dibuat <=',$max);
		return $this->db->get()->result();
	}

	//Kategori Artikel
	function getListKategoriArtikel($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text, kategori")
    					->like("kategori", $keyword)
    					->get($this->tabel_artikel, $limit, $page)->result_array();
	}

	function getJumlahListKategoriArtikel($keyword){
      	return $this->db->select("id_wilayah as id, wilayah as text,kategori")
    					->like("kategori", $keyword)
						->count_all_results($this->tabel_artikel);
	  }

	  //Status Artikel
	function getListStatusArtikel($keyword,$page,$limit){
    	return $this->db->select("id_wilayah as id, wilayah as text, kategori")
    					->like("status", $keyword)
    					->get($this->tabel_artikel, $limit, $page)->result_array();
	}

	function getJumlahListStatusArtikel($keyword){
      	return $this->db->select("id_wilayah as id, wilayah as text,kategori")
    					->like("status", $keyword)
						->count_all_results($this->tabel_artikel);
	  }

	   //Rekap Jumlah Kategori Artikel, 1 = Artikel, 2 = Berita, 3 = Event
	function getRingkasanKategoriArtikel(){
		return $this->db->query("SELECT id_artikel,SUM(artikel) as artikel,SUM(berita) as berita, SUM(event) as event from (SELECT id_artikel,IF(kategori = '1',COUNT(*),0) AS `artikel`, IF(kategori = '2',COUNT(*),0) AS `berita`,IF(kategori = '3',COUNT(*),0) AS `event` FROM (select * from artikel GROUP BY id_artikel) a group by kategori) b");
	}

}