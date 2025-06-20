<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('diskon_helper');
    }

    private $_table = "produk";

    public function get_all()
    {
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
                diskon.id, 
                diskon.nama, 
                diskon.persentase, 
                produk_diskon.produk_id
            FROM diskon
            JOIN produk_diskon ON produk_diskon.diskon_id = diskon.id
            WHERE CURDATE() BETWEEN diskon.tanggal_mulai AND diskon.tanggal_akhir
        ) AS diskon_aktif', 'diskon_aktif.produk_id = produk.id_produk', 'left');

        return $this->db->get()->result_array();
    }

    public function get_all_product($id)
    {
        $id = (int) $id; // untuk keamanan
        $subquery = '(SELECT produk_id, diskon_id FROM produk_diskon WHERE diskon_id = ' . $id . ') AS pd_diskon';

        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama, pd_diskon.diskon_id');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id', 'left');
        $this->db->join($subquery, 'pd_diskon.produk_id = produk.id_produk', 'left');

        return $this->db->get()->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
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
        $this->db->select('produk.id_produk, produk.nama as pd_nama, produk.stok, produk.deskripsi, produk.harga, kategori.nama as kt_nama, produk_diskon.nama as nama_diskon, produk_diskon.jumlah_diskon, (CASE WHEN produk_diskon.jumlah_diskon IS NULL THEN produk.harga ELSE (produk.harga - (produk.harga * produk_diskon.jumlah_diskon / 100)) END) as harga_akhir');
        $this->db->from($this->_table);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.categori_id');
        $this->db->where('produk.categori_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_product_without_diskon()
    {
        $this->db->select('produk.id_produk, produk.nama as pd_nama, diskon.id as diskon_id');
        $this->db->from($this->_table);
        $this->db->where('produk_diskon.produk_id IS NULL', NULL, FALSE);
        $this->db->join('produk_diskon', 'produk_diskon.produk_id = produk.id_produk', 'left');
        $this->db->join('diskon', 'diskon.id = produk_diskon.diskon_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produk_by_id($id)
    {
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
            foreach ($produk as $produk) {
                if (is_diskon_aktif($produk['tanggal_mulai'], $produk['tanggal_akhir'])) {
                    return $produk;
                }
            }
        }
    }
}
