<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pesanan_produk_model');
        $this->load->model('Keranjang_model');
        $this->load->model('Pembayaran_model');
    }

    private $_table = 'pesanan';
    public function get_all() {
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function get_by_id($id) {
        $this->db->where('id_pesanan', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    public function get_by_pelanggan_id($pelanggan_id) {
        $this->db->where('pelanggan_id', $pelanggan_id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function tambah($data) {
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() != 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function proses_pesanan($id_keranjang, $pelanggan_id) {
        //check keranjang
        $keranjang = $this->Keranjang_model->getKeranjangByIdAndPelanggan($id_keranjang, $pelanggan_id);
        if (!$keranjang) {
            return ['status' => 'error', 'message' => 'Keranjang tidak ditemukan.'];
        }

        //check produk dalam keranjang
        $produk_keranjang = $this->Keranjang_produk_model->get_by_keranjang($id_keranjang);
        $total = 0;
        foreach ($produk_keranjang as $item) {
            $produk = $this->Produk_model->get_produk_by_id_with_diskon($item['produk_id']);
            if (!$produk) {
                return ['status' => 'error', 'message' => 'Produk tidak ditemukan dalam keranjang.'];
            }
            // cek stok
            if ($produk['stok'] < $item['jumlah']) {
                return ['status' => 'error', 'message' => 'Stok produk tidak mencukupi.'];
            }
            $total += hitung_diskon($produk['harga'], $produk['persentase'], $produk['tanggal_mulai'], $produk['tanggal_akhir']) * $item['jumlah'];
        }

        $this->db->trans_start();

        //insert pesanan
        $data_pesanan = [
            'pelanggan_id' => $pelanggan_id,
            'status' => 'pending',
            'tanggal_pesanan' => date('Y-m-d H:i:s'),
            'total_pesanan' => $total,
        ];

        $id_pesanan = $this->tambah($data_pesanan);
        if (!$id_pesanan) {
            return ['status' => 'error', 'message' => 'Gagal membuat pesanan.'];
        }

        //insert pesanan produk
        foreach ($produk_keranjang as $item) {
            $produk = $this->Produk_model->get_produk_by_id_with_diskon($item['produk_id']);
            if ($produk) {
                $data_produk = [
                    'pesanan_id' => $id_pesanan,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_saat_pembelian' => hitung_diskon($produk['harga'], $produk['persentase'], $produk['tanggal_mulai'], $produk['tanggal_akhir']),
                ];
                $this->Pesanan_produk_model->tambah($data_produk);
                //update stok produk
                $stok_baru = $produk['stok'] - $item['jumlah'];
                $this->Produk_model->ubah(['stok' => $stok_baru], $item['produk_id']);
            }
        }

        //hapus keranjang
        $this->Keranjang_model->hapus($id_keranjang);
        $this->Keranjang_produk_model->hapus_by_keranjang($id_keranjang);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan saat memproses pesanan.'];
        }

        return ['status' => 'success', 'id_pesanan' => $id_pesanan];
    }

    
    
    public function get_list_pesanan() {
        $this->db->select('pesanan.id_pesanan, pelanggan.nama_pelanggan, pesanan.tanggal_pesanan, pesanan.total_pesanan, pesanan.status as status_pesanan, pembayaran.status as status_pembayaran');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pesanan.pelanggan_id = pelanggan.id_pelanggan');
        $this->db->join('pembayaran', 'pesanan.id_pesanan = pembayaran.pesanan_id', 'left');
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
