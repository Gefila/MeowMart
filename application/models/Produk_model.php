<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model{
    private $_table = "produk";

    public function get_all(){
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id){
        $this->db->where('id_produk', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id){
        $this->db->delete($this->_table, array('id_produk' => $id));
    }

    public function ubah($data, $id){
        $this->db->where('id_produk', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_by_kategori_id($id){
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $this->db->where('produk.categori_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}