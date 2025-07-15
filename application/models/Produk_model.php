<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->helper('diskon_helper');
    }

    private $_table = "produk";

    public function get_all_produk() {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produk_by_id($id) {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->where('produk.id_produk', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all() {
        $this->db->select('
            produk.id_produk,
            produk.nama AS pd_nama,
            produk.stok,
            produk.deskripsi,
            produk.harga,
            kategori.nama AS kt_nama,
            diskon_aktif.nama AS nama_diskon,
            diskon_aktif.persentase,
            diskon_aktif.id AS diskon_id,
            CASE
                WHEN diskon_aktif.persentase IS NOT NULL THEN (produk.harga - (produk.harga * diskon_aktif.persentase / 100))
                ELSE produk.harga
            END AS harga_akhir
        ');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join('(
            SELECT 
                d.id, 
                d.nama, 
                d.persentase, 
                pd.produk_id
            FROM diskon d
            JOIN produk_diskon pd ON pd.diskon_id = d.id
            WHERE CURDATE() BETWEEN d.tanggal_mulai AND d.tanggal_akhir
            AND d.persentase = (
                SELECT MAX(d2.persentase)
                FROM diskon d2
                JOIN produk_diskon pd2 ON pd2.diskon_id = d2.id
                WHERE pd2.produk_id = pd.produk_id
                AND CURDATE() BETWEEN d2.tanggal_mulai AND d2.tanggal_akhir)
        ) AS diskon_aktif', 'diskon_aktif.produk_id = produk.id_produk', 'left');

        return $this->db->get()->result_array();
    }

    public function get_by_kategori_id($id) {
        $this->db->select('
            produk.id_produk,
            produk.nama AS pd_nama,
            produk.stok,
            produk.deskripsi,
            produk.harga,
            kategori.nama AS kt_nama,
            kategori.id_kategori,
            diskon_aktif.nama AS nama_diskon,
            diskon_aktif.persentase,
            diskon_aktif.id AS diskon_id,
            CASE
                WHEN diskon_aktif.persentase IS NOT NULL THEN (produk.harga - (produk.harga * diskon_aktif.persentase / 100))
                ELSE produk.harga
            END AS harga_akhir
        ');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join('(
            SELECT 
                d.id, 
                d.nama, 
                d.persentase, 
                pd.produk_id
            FROM diskon d
            JOIN produk_diskon pd ON pd.diskon_id = d.id
            WHERE CURDATE() BETWEEN d.tanggal_mulai AND d.tanggal_akhir
            AND d.persentase = (
                SELECT MAX(d2.persentase)
                FROM diskon d2
                JOIN produk_diskon pd2 ON pd2.diskon_id = d2.id
                WHERE pd2.produk_id = pd.produk_id
                AND CURDATE() BETWEEN d2.tanggal_mulai AND d2.tanggal_akhir)
        ) AS diskon_aktif', 'diskon_aktif.produk_id = produk.id_produk', 'left');
        $this->db->where('produk.categori_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produk_by_id_with_diskon($id) {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama, diskon.id as diskon_id, diskon.nama as nama_diskon, diskon.persentase, diskon.tanggal_mulai, diskon.tanggal_akhir');
        $this->db->from($this->_table);
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('diskon', 'diskon.id = produk_diskon.diskon_id', 'left');
        $this->db->where('produk.id_produk', $id);
        $query = $this->db->get();
        $produk = $query->result_array();
        if (count($produk) === 1) {
            return $produk[0];
        } else {
            return filter_diskon_terbesar_dan_aktif($produk) ? filter_diskon_terbesar_dan_aktif($produk) : $produk[0];
        }
    }

    public function get_random_produk() {
        $this->db->select('
        produk.id_produk,
        produk.nama AS pd_nama,
        produk.stok,
        produk.deskripsi,
        produk.harga,
        produk_gambar.nama_gambar,
        kategori.nama AS kt_nama,
        diskon_aktif.nama AS nama_diskon,
        diskon_aktif.persentase,
        diskon_aktif.id AS diskon_id,
        CASE
            WHEN diskon_aktif.persentase IS NOT NULL THEN (produk.harga - (produk.harga * diskon_aktif.persentase / 100))
            ELSE produk.harga
        END AS harga_akhir
    ');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join('(
        SELECT 
            d.id, 
            d.nama, 
            d.persentase, 
            pd.produk_id
        FROM diskon d
        JOIN produk_diskon pd ON pd.diskon_id = d.id
        WHERE CURDATE() BETWEEN d.tanggal_mulai AND d.tanggal_akhir
        AND d.persentase = (
            SELECT MAX(d2.persentase)
            FROM diskon d2
            JOIN produk_diskon pd2 ON pd2.diskon_id = d2.id
            WHERE pd2.produk_id = pd.produk_id
            AND CURDATE() BETWEEN d2.tanggal_mulai AND d2.tanggal_akhir)
        ) AS diskon_aktif', 'diskon_aktif.produk_id = produk.id_produk', 'left');
        $this->db->join('(
        SELECT pg1.*
        FROM produk_gambar pg1
        INNER JOIN (
            SELECT produk_id, MIN(id_gambar) AS min_id
            FROM produk_gambar
            GROUP BY produk_id
        ) pg2 ON pg1.produk_id = pg2.produk_id AND pg1.id_gambar = pg2.min_id
        ) AS produk_gambar', 'produk_gambar.produk_id = produk.id_produk', 'left');

        $this->db->order_by('RAND()'); // ambil secara acak
        $this->db->limit(4);           // batasi 4 produk

        return $this->db->get()->result_array();
    }

    public function tambah($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        $this->db->select('
    produk.id_produk,
    produk.nama as pd_nama,
    produk.stok,
    produk.deskripsi,
    produk.harga,
    produk.categori_id,
    kategori.nama as kt_nama,
    diskon.nama as nama_diskon,
    diskon.persentase,
    diskon.tanggal_mulai,
    diskon.tanggal_akhir,
');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('diskon', 'diskon.id = produk_diskon.diskon_id', 'left');
        $this->db->where('produk.id_produk', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hapus($id) {
        $this->db->delete($this->_table, array('id_produk' => $id));
    }

    public function ubah($data, $id) {
        $this->db->where('id_produk', $id);
        $this->db->update($this->_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }



    public function get_product_without_diskon() {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, diskon.id as diskon_id');
        $this->db->from($this->_table);
        $this->db->where('produk_diskon.produk_id IS NULL', NULL, FALSE);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('diskon', 'diskon.id = produk_diskon.diskon_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_produk_stok($id) {
        $this->db->select('produk.*');
        $this->db->from($this->_table);
        $this->db->where('id_produk', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
