<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_produk_model extends CI_Model
{
    private $_table = 'pesanan_produk';

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function get_by_id_pesanan($id_pesanan)
    {
        $this->db->where('pesanan_id', $id_pesanan);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    
}
