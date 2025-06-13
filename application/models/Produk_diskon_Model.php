<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_diskon_Model extends CI_Model{
    private $_table = "produk_diskon";

    public function get_all(){
        $this->db->select('produk_diskon.id_diskon, produk_diskon.nama, produk_diskon.jumlah_diskon, produk_diskon.deskripsi, produk_diskon.produk_id, produk.nama as pd_nama');
        $this->db->from($this->_table);
        $this->db->join('produk', 'produk.id_produk = produk_diskon.produk_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id){
        $this->db->where('id_diskon', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id){
        $this->db->delete($this->_table, array('id_diskon' => $id));
    }

    public function ubah($id, $data){
        $this->db->where('id_diskon', $id);
        return $this->db->update($this->_table, $data);
    }

}