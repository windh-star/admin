<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class SuplierModel extends CI_Model{
    public $tabel = "pengguna";
    public $ref1 = "wilayah";
    public $primary_key = "id_pengguna";
    public $foreign_key = "id_wilayah";
    public $foreign_key1 = "pengguna.id_wilayah";
    public $foreign_key_ref1 = "wilayah.id_wilayah";
    

    function getTabelSuplier($datatable){
        $this->input->post('pengguna');
        $join = "INNER JOIN {$this->ref1} ON {$this->foreign_key1} = {$this->foreign_key_ref1}";
        $columns = implode(', ', $datatable['col-display']);
        $sql  = "SELECT {$columns} FROM {$this->tabel} {$join} where kategori_akun='3'";
    
        $data = $this->db->query($sql);
        $total_data = $data->num_rows();
        $data->free_result();
    
        $columnd = $datatable['col-display'];
        $count_c = count($columnd);
    
        $search = $datatable['search']['value'];
        $where = '';
        //filter
        // $produk = $this->input->post('nama_produk');
        // if ($produk != '') $where = 'nama_produk = "'. $produk .'"'; 
        if($search !=''){
            if($where != ''){
              $where.= 'AND (';
                for($i=0;$i<$count_c;$i++){
                    $where .= $columnd[$i]. ' LIKE "%'. $search . '%"';
                    if($i<$count_c-1){
                        $where .= ' OR ';
                    }
                }
                $where .= ')';
        }else {
            for ($i=0; $i<$count_c; $i++){
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                if($i<$count_c-1){
                    $where .= ' OR ';
                }
            }
        }
    }
    if($where != ''){
        $sql .= " WHERE " . $where;
    }
    
        $data = $this->db->query($sql);
        $total_filter = $data->num_rows();
        $data->free_result();
        
        //group 
        $sql .= " GROUP BY ".$this->foreign_key1.",".$this->foreign_key_ref1."";
        
        ///sorting
        $sql .= " ORDER BY {$columnd[($datatable['order'][0]['column'])-1]} {$datatable['order'][0]['dir']}";
          
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
             $data[] = "<div class='btn-group'>".
					   "<button type='button' class='btn btn-success btn-sm' id='btn-ubah-pengguna' onClick='TampilUbahPengguna(".$data[1].")' title='Ubah' data-id='$data[1]'><i class='fa fa-edit'></i></button>".
					   "<button type='button' class='btn btn-primary btn-sm' id='btn-detail-pengguna' onClick='TampilDetailPengguna(".$data[1].")' title='Detail' data-id='$data[1]'><i class='fa fa-eye'></i></button>".
					   "</div>";
            $option['data'][] = $data;
        }
        return print_r(json_encode($option));
    }
    function getListPengguna($keyword, $page, $limit){
        return $this->db->select("id_pengguna as id, nama_pengguna as text")
                        ->like("nama_pengguna", $keyword)
                        ->get($this->tabel, $limit, $page)->result_array();
    }
    function getJumlahListPengguna($keyword){
        return $this->db->select("id_pengguna as id, nama_pengguna as text")
                        ->like("nama_pengguna", $keyword)
                        ->count_all_results($this->tabel);
    }
    function getInfoPengguna($id_pengguna){
        $this->db->select('*');
        $this->db->from('pengguna1');
        $this->db->join('wilayah', 'wilayah.id_wilayah = pengguna1.id_wilayah');
        $this->db->where('pengguna1.id_pengguna', $id_pengguna);
        return $this->db->get();
    }
    function getPengalaman($id_pengguna){
        $this->db->select('*');
        $this->db->from('pengguna1');
        $this->db->join('pengalaman_proyek', 'pengalaman_proyek1.id_pengguna = pengguna1.id_pengguna');
        $this->db->where('pengguna1.id_pengguna', $id_pengguna);
        return $this->db->get();
    }
    function ubahPengguna($data){
        $val = array(
            'id_pengguna' => $data['id_pengguna'],
            'nama_pengguna' => $data['nama_pengguna'],
            'profil' => $data['profil'],
            'alamat' => $data['alamat'],
            'id_wilayah' => $data['id_wilayah'],
            'perusahaan' => $data['perusahaan'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'no_wa' => $data['no_wa'],
            'website' => $data['website'],
            'harga_min' => $data['harga_min'],
            'harga_max' => $data['harga_max'],
            'nego' => $data['nego'],
            'username' => $data['username'],
            'password' => $data['password'],
            'foto' => $data['foto'],
            'kategori_akun' => $data['kategori_akun'],
            'jenis_akun' => $data['jenis_akun'],
            'status' => $data['status'],
            'kode_verifikasi' => $data['kode_verifikasi'],
            'status_verifikasi' => $data['status_verifikasi'],
            'tgl_daftar' => $data['tgl_daftar'],
            'jam_daftar' => $data['jam_daftar']
        );
     $this->db->where("id_pengguna", $data['id_pengguna'])
                 ->update($this->tabel, $val);
    } 
    function simpanPengguna($data){
         $val = array(
            'id_pengguna' => $data['id_pengguna'],
            'nama_pengguna' => $data['nama_pengguna'],
            'profil' => $data['profil'],
            'alamat' => $data['alamat'],
            'id_wilayah' => $data['id_wilayah'],
            'perusahaan' => $data['perusahaan'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'no_wa' => $data['no_wa'],
            'website' => $data['website'],
            'harga_min' => $data['harga_min'],
            'harga_max' => $data['harga_max'],
            'nego' => $data['nego'],
            'username' => $data['username'],
            'password' => $data['password'],
            'foto' => $data['foto'],
            'kategori_akun' => $data['kategori_akun'],
            'jenis_akun' => $data['jenis_akun'],
            'status' => $data['status'],
            'kode_verifikasi' => $data['kode_verifikasi'],
            'status_verifikasi' => $data['status_verifikasi'],
            'tgl_daftar' => $data['tgl_daftar'],
            'jam_daftar' => $data['jam_daftar']
        );
        $this->db->insert($this->tabel, $val);
    }
}