<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_diskon_Model extends CI_Model{
    private $_table = "produk_diskon";

    public function get_all(){
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id){
        $this->db->where('id_diskon', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id){
        $this->db->delete($this->_table, array('id_diskon' => $id));
    }

    public function ubah($id, $data){
        $this->db->where('id_diskon', $id);
        return $this->db->update($this->_table, $data);
    }

}