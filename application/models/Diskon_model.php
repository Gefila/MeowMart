<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon_model extends CI_Model {
    private $_table = "diskon";

    public function get_all() {
        $this->db->select('diskon.*, produk.nama as pd_nama, produk_diskon.produk_id');
        $this->db->from($this->_table);
        $this->db->join('produk_diskon', 'produk_diskon.diskon_id = diskon.id', 'left');
        $this->db->join('produk', 'produk.id_produk = produk_diskon.produk_id', 'left');
        $this->db->order_by('diskon.tanggal_mulai', 'ASC');
        $query = $this->db->get();
        $diskon = $query->result_array();

        $grouped = [];
        $dateNow = date('Y-m-d');
        foreach ($diskon as $row) {
            $id = $row['id'];
            if (!isset($grouped[$id])) {
                $isDiskonAktif = ($dateNow >= $row['tanggal_mulai'] && $dateNow <= $row['tanggal_akhir']) ? 'aktif' : 'tidak aktif';
                $grouped[$id] = [
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'persentase' => $row['persentase'],
                    'deskripsi' => $row['deskripsi'],
                    'tanggal_mulai' => $row['tanggal_mulai'],
                    'tanggal_akhir' => $row['tanggal_akhir'],
                    'status' => $isDiskonAktif,
                    'produk' => []
                ];
            }
            $grouped[$id]['produk'][] = [
                'id_produk' => $row['produk_id'],
                'nama_produk' => $row['pd_nama']
            ];
        }
        return array_values($grouped);
    }

    public function tambah($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function tambah_produk_diskon($diskon_id, $produk_id) {
        foreach ($produk_id as $id_produk) {
            $data = [
                'produk_id' => $id_produk,
                'diskon_id' => $diskon_id,
            ];
            $this->db->insert('produk_diskon', $data);
        }
        return $this->db->affected_rows() > 0;
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row_array();
    }

    public function get_produk_diskon_by_diskon_id($id) {
        $this->db->select('produk_diskon.produk_id');
        $this->db->from('produk_diskon');
        $this->db->join('produk', 'produk.id_produk = produk_diskon.produk_id');
        $this->db->where('produk_diskon.diskon_id', $id);
        return $this->db->get()->result_array();
    }

    public function hapus($id) {
        $this->db->delete($this->_table, array('id' => $id));
        return $this->db->affected_rows() > 0;
    }


    public function hapus_produk_diskon($id) {
        $this->db->delete('produk_diskon', array('produk_id' => $id));
    }

    public function ubah($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->_table, $data);
    }

    public function ubah_produk_dan_diskon($id, $data, $produk) {
        // Jika produk kosong, hapus semua produk diskon terkait
        // dan ubah diskon tanpa produk
        if (empty($produk)) {
            $produkLama = $this->get_produk_diskon_by_diskon_id($id);
            if ($produkLama) {
                foreach ($produkLama as $produkDiskon) {
                    $this->hapus_produk_diskon($produkDiskon['produk_id']);
                }
            }
            return true;
        }

        // Jika produk tidak kosong, lakukan update dan insert/delete produk diskon
        $this->db->trans_start();
        $this->ubah($id, $data);
        $produkLama = array_column($this->get_produk_diskon_by_diskon_id($id), 'produk_id');
        $insert = array_diff($produk, $produkLama);
        $delete = array_diff($produkLama, $produk);

        $this->tambah_produk_diskon($id, $insert);

        foreach ($delete as $id_produk) {
            $this->hapus_produk_diskon($id_produk);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_produk_diskon_by_produk_id($id_produk) {
        $this->db->select('diskon.*, produk_diskon.produk_id');
        $this->db->from('diskon');
        $this->db->join('produk_diskon', 'produk_diskon.diskon_id = diskon.id', 'left');
        $this->db->where('produk_diskon.produk_id', $id_produk);
        return $this->db->get()->result_array();
    }
}
