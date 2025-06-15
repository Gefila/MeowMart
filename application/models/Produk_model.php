<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";

    public function get_all()
    {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama, produk_diskon.nama as nama_diskon, produk_diskon.jumlah_diskon, (CASE WHEN produk_diskon.jumlah_diskon IS NULL THEN produk.harga ELSE (produk.harga - (produk.harga * produk_diskon.jumlah_diskon / 100)) END) as harga_akhir');
        $this->db->from($this->_table);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, produk.categori_id ,kategori.nama as kt_nama, produk_diskon.nama as nama_diskon, produk_diskon.jumlah_diskon, (CASE WHEN produk_diskon.jumlah_diskon IS NULL THEN produk.harga ELSE (produk.harga - (produk.harga * produk_diskon.jumlah_diskon / 100)) END) as harga_akhir');
        $this->db->from($this->_table);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $this->db->where('produk.id_produk', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hapus($id)
    {
        $this->db->delete($this->_table, array('id_produk' => $id));
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_produk', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_by_kategori_id($id)
    {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $this->db->where('produk.categori_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_product_without_diskon()
    {
        $this->db->select('produk.id_produk, produk.nama as pd_nama');
        $this->db->from($this->_table);
        $this->db->where('produk_diskon.produk_id IS NULL', NULL, FALSE);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
}
