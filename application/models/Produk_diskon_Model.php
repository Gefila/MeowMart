<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_diskon_Model extends CI_Model
{
    private $_table = "diskon";

    public function get_all()
    {
        $this->db->select('diskon.*, produk.nama, produk_diskon.produk_id');
        $this->db->from($this->_table);
        $this->db->join('produk_diskon', 'produk_diskon.diskon_id = diskon.id');
        $this->db->join('produk', 'produk.id_produk = produk_diskon.produk_id');
        $this->db->order_by('diskon.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function tambah_produk_diskon($data)
    {
        $this->db->insert('produk_diskon', $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function get_produk_diskon_by_diskon_id($id)
    {
        $this->db->select('produk_diskon.produk_id');
        $this->db->from('produk_diskon');
        $this->db->join('produk', 'produk.id_produk = produk_diskon.produk_id');
        $this->db->where('produk_diskon.diskon_id', $id);
        return $this->db->get()->result_array();
    }   

    public function hapus($id)
    {
        $this->db->delete($this->_table, array('id_diskon' => $id));
    }

    public function ubah($id, $data)
    {
        $this->db->where('id_diskon', $id);
        return $this->db->update($this->_table, $data);
    }
}
