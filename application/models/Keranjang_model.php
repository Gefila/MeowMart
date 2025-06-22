<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Keranjang_produk_model');
        $this->load->helper('diskon_helper');
    }

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

    public function getKeranjangByIdAndPelanggan($id_keranjang, $pelanggan_id)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->where('pelanggan_id', $pelanggan_id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_by_pelanggan($id_pelanggan)
    {
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

    public function get_detail_keranjang($id_keranjang)
    {
        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($id_keranjang);
        $produk = [];
        foreach ($keranjang_produk as $item) {
            $produk_item = $this->Produk_model->get_produk_by_id($item['produk_id']);
            if ($produk_item) {
                $produk_item['jumlah'] = $item['jumlah'];
                $produk_item['gambar'] = $this->Produk_gambar_model->get_by_produk_id($produk_item['id_produk']);
                $produk_item['harga_akhir'] = hitung_diskon(
                    $produk_item['harga'],
                    $produk_item['persentase'],
                    $produk_item['tanggal_mulai'],
                    $produk_item['tanggal_akhir']
                );
                $produk_item['id_keranjang_produk'] = $item['id_keranjang_produk'];
                $produk[] = $produk_item;
            }
        }
        return $produk;
    }

    public function get_or_create_by_pelanggan($pelanggan_id)
    {
        $keranjang = $this->get_by_pelanggan($pelanggan_id);

        if (!$keranjang) {
            $this->db->insert('keranjang', [
                'pelanggan_id' => $pelanggan_id,
            ]);
            $keranjang_id = $this->db->insert_id();
        } else {
            $keranjang_id = $keranjang[0]['id_keranjang'];
        }

        return $keranjang_id;
    }

    public function tambah_produk_keranjang($pelanggan_id, $produk_id, $jumlah)
    {
        $produk = $this->Produk_model->get_produk_stok($produk_id);

        if (!$produk || $produk['stok'] < $jumlah) {
            return [
                'status' => false,
                'message' => 'Stok tidak cukup'
            ]; // Stok tidak cukup
        }

        $keranjang_id = $this->get_or_create_by_pelanggan($pelanggan_id);
        $produk_keranjang = $this->Keranjang_produk_model->get_by_produk_keranjang($keranjang_id, $produk_id);

        if ($produk_keranjang) {
            $jumlah_baru = $produk_keranjang['jumlah'] + $jumlah;
            if ($jumlah_baru > $produk['stok']) {
                return [
                    'status' => false,
                    'message' => 'Stok tidak cukup'
                ]; // Stok tidak cukup
            }
            $this->Keranjang_produk_model->ubah(['jumlah' => $jumlah_baru], $produk_keranjang['id_keranjang_produk']);
        } else {
            $this->Keranjang_produk_model->tambah([
                'keranjang_id' => $keranjang_id,
                'produk_id' => $produk_id,
                'jumlah' => $jumlah
            ]);
        }

        return [
            'status' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'keranjang_id' => $keranjang_id
        ];
    }

    public function ubah_produk_keranjang($id_keranjang_produk, $id_produk, $jumlah)
    {
        $item = $this->Keranjang_produk_model->get_by_id($id_keranjang_produk);

        if (!$item) {
            return [
                'status' => false,
                'message' => 'Produk tidak ditemukan di keranjang.'
            ];
        }

        $produk = $this->Produk_model->get_produk_stok($id_produk);

        if (!$produk) {
            return [
                'status' => false,
                'message' => 'Produk tidak ditemukan.'
            ];
        }

        if ($produk['stok'] < $jumlah) {
            return [
                'status' => false,
                'message' => 'Stok produk tidak mencukupi.'
            ];
        }

        $this->Keranjang_produk_model->ubah(['jumlah' => $jumlah], $id_keranjang_produk);

        return [
            'status' => true,
            'message' => 'Produk telah berhasil diubah di keranjang.',
            'redirect' => base_url('keranjang')
        ];
    }

    public function hapus_produk_keranjang($id_keranjang_produk)
    {
        $item = $this->Keranjang_produk_model->get_by_id($id_keranjang_produk);

        if (!$item) {
            return [
                'status' => false,
                'message' => 'Produk tidak ditemukan di keranjang.'
            ];
        }

        $this->Keranjang_produk_model->hapus($id_keranjang_produk);

        $sisa_produk = $this->Keranjang_produk_model->get_by_keranjang($item['keranjang_id']);
        if (empty($sisa_produk)) {
            $this->hapus($item['keranjang_id']);
            return [
                'status' => true,
                'message' => 'Keranjang kosong, semua produk telah dihapus.',
                'redirect' => base_url('keranjang')
            ];
        }

        return [
            'status' => true,
            'message' => 'Produk telah berhasil dihapus dari keranjang.',
            'redirect' => base_url('keranjang')
        ];
    }
}
