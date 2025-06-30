<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
    }

    public function get_list_pesanan() {
        $this->db->select('pesanan.id_pesanan, pelanggan.nama_pelanggan, pesanan.tanggal_pesanan, pesanan.total_pesanan, pesanan.status');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pesanan.pelanggan_id = pelanggan.id_pelanggan');
        $this->db->order_by('pesanan.id_pesanan', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_pesanan_by_id($id_pesanan) {
        $this->db->select('pesanan.*, pelanggan.*');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pesanan.pelanggan_id = pelanggan.id_pelanggan');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $query = $this->db->get();
        $pesanan = $query->row_array();
        if ($pesanan) {
            $pesanan['list_produk'] = $this->get_pesanan_produk_by_id($id_pesanan);
            $pesanan['pembayaran'] = $this->Pembayaran_model->get_by_pesanan_id($id_pesanan);
            return $pesanan;
        }
    }

    public function get_pesanan_produk_by_id($id_pesanan) {
        $this->db->select('pesanan_produk.*, produk.nama as pd_nama');
        $this->db->from('pesanan_produk');
        $this->db->join('produk', 'pesanan_produk.produk_id = produk.id_produk');
        $this->db->where('pesanan_produk.pesanan_id', $id_pesanan);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_status_pesanan($id_pesanan, $status) {
        $data = array(
            'status' => $status
        );
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update('pesanan', $data);
    }
}
