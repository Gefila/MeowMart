<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_kategori_model extends CI_Model{
    private $_table = 'kategori';

    public function get_all(){
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}