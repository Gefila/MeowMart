<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model{
    private $_table = 'pesanan';
    public function get_all(){
        $query = $this->db->get($this->_table);
        return $query->result_array();
    } 

    public function get_by_id($id){
        $this->db->where('id_pesanan', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    public function get_by_pelanggan($pelanggan_id){
        $this->db->where('pelanggan_id', $pelanggan_id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        if($this->db->affected_rows() != 0){
            return $this->db->insert_id();
        }
        return false;
    }
}