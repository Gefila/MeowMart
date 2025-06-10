<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    private $table = 'keranjang';

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    public function getKeranjangByIdAndPelanggan($id_produk, $id_pelanggan)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_pelanggan($id_pelanggan){
        $this->db->where('pelanggan_id', $id_pelanggan);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_keranjang', $id);
        $this->db->update($this->table, $data);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }

    public function hapus($id)
    {
        $this->db->delete($this->table, ['id_keranjang' => $id]);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }
}
