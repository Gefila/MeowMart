<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_produk_model extends CI_Model{
    private $table = 'keranjang_produk';

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function get_by_produk_keranjang($keranjang_id, $id_produk)
    {
        return $this->db->get_where($this->table, [
            'keranjang_id' => $keranjang_id,
            'produk_id' => $id_produk
        ])->row_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    public function getKeranjangProdukByIdAndPelanggan($id_keranjang, $pelanggan_id)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->where('pelanggan_id', $pelanggan_id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_keranjang_produk', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_keranjang($keranjang_id)
    {
        $this->db->where('keranjang_id', $keranjang_id);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_keranjang_produk', $id);
        $this->db->update($this->table, $data);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    public function hapus($id)
    {
        $this->db->delete($this->table, ['id_keranjang_produk' => $id]);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }
}