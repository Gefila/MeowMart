<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_ringkasan_transaksi() {
        $this->db->select('
        pesanan.id_pesanan,
        pesanan.tanggal_pesanan,
        pesanan.status,
        pelanggan.nama_pelanggan,
        produk.nama AS nama_produk,
        produk.harga,
        pesanan_produk.jumlah,
        (produk.harga * pesanan_produk.jumlah) AS subtotal
    ');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pesanan.pelanggan_id = pelanggan.id_pelanggan');
        $this->db->join('pesanan_produk', 'pesanan.id_pesanan = pesanan_produk.pesanan_id');
        $this->db->join('produk', 'pesanan_produk.produk_id = produk.id_produk');
        $this->db->order_by('pesanan.tanggal_pesanan', 'DESC');
        $query = $this->db->get()->result_array();
        // Gabungkan data produk per pesanan
        $grouped = [];
        foreach ($query as $row) {
            $id = $row['id_pesanan'];
            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'id_pesanan' => $id,
                    'tanggal_pesanan' => $row['tanggal_pesanan'],
                    'nama_pelanggan' => $row['nama_pelanggan'],
                    'status' => $row['status'],
                    'produk' => '',
                    'harga' => '',
                    'jumlah' => '',
                    'subtotal' => '',
                    'total' => 0,
                ];
            }

            // Tambahkan setiap produk sebagai baris teks HTML
            $grouped[$id]['produk']   .= htmlspecialchars($row['nama_produk']) . ' x ' . $row['jumlah'] . '<br>';
            $grouped[$id]['harga']    .= 'Rp' . number_format($row['harga'], 0, ',', '.') . '<br>';
            $grouped[$id]['jumlah']   .= $row['jumlah'] . '<br>';
            $grouped[$id]['subtotal'] .= 'Rp' . number_format($row['subtotal'], 0, ',', '.') . '<br>';
            $grouped[$id]['total']    += $row['subtotal'];
        }
        
        return array_values($grouped);
    }

    public function get_list_transaksi(){
        $this->db->select('
            pesanan.id_pesanan,
            pesanan.tanggal_pesanan,
            pesanan.status,
            pesanan.total_pesanan,
            pelanggan.nama_pelanggan,
            produk.nama AS nama_produk,
            produk.harga AS harga_produk,
            pesanan_produk.harga_saat_pembelian,
            pesanan_produk.jumlah,
            (produk.harga * pesanan_produk.jumlah) AS subtotal
        ');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pesanan.pelanggan_id = pelanggan.id_pelanggan');
        $this->db->join('pesanan_produk', 'pesanan.id_pesanan = pesanan_produk.pesanan_id');
        $this->db->join('produk', 'pesanan_produk.produk_id = produk.id_produk');
        $query = $this->db->get()->result_array();
    }
}
