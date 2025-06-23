<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {
    private $_table = 'pembayaran';

    public function __construct() {
        parent::__construct();
        $this->load->model('Pesanan_model');
    }

    public function get_by_pesanan_id($id_pesanan) {
        $this->db->where('pesanan_id', $id_pesanan);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    public function tambah($data) {
        $this->db->insert($this->_table, $data);
        return ($this->db->affected_rows() !== 1) ? false : true;
    }
}
