<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_gambar_model extends CI_Model{
    private $_table = "produk_gambar";

    public function tambah($data){
        return $this->db->insert($this->_table, $data);

    }

    public function get_by_id($id){
        $this->db->where('id_gambar', $id);
        $query = $this->db->get($this->_table);
        return  $query->row_array();
    }

    public function get_by_produk_id($id){
        $this->db->where('produk_id', $id);
        $query = $this->db->get($this->_table);
        return  $query->result_array();
    }

    public function hapus($id){
        return $this->db->delete($this->_table, array('id_gambar' => $id));
    }

    public function ubah($data, $id){
        $this->db->where('id_gambar', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}