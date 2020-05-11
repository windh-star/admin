<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

class AdminModel extends CI_Model {
  public $tabel = "pengguna";
  public $primary_key = "id_pengguna";

  function getAdminKriteria($kriteria, $keyword){
    return $this->db->where($kriteria, $keyword)
                    ->get($this->tabel);
  }

  function loginAdmin($data){
    return $this->db->where('username', $data['username'])
                    ->where('password', hash('sha256', $data['password']))
                    ->where('kategori_akun','4')
                    ->get($this->tabel);
  }

  function getIDAdmin($data){
    return $this->db->select("id_pengguna,nama_pengguna,username")
                    ->where('username', $data['username'])
                    ->where('password', hash('sha256', $data['password']))
                    ->where('kategori_akun','4')
                    ->get($this->tabel);
  }
}