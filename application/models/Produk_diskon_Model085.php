<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_diskon_Model085 extends CI_Model{
    private $_table = "prodiskon2211500085";

    public function get_all(){
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id){
        $this->db->where('id_diskon085', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function hapus($id){
        $this->db->delete($this->_table, array('id_diskon085' => $id));
    }

}