<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Keranjang_produk_model');
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

    public function get_by_pelanggan($id_pelanggan){
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

    public function get_detail_keranjang($id_keranjang){
        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($id_keranjang);
        $produk = [];
        foreach ($keranjang_produk as $item){
            $produk_item = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk_item) {
                $produk_item['jumlah'] = $item['jumlah'];
                $produk_item['harga_akhir'] = $this->hitung_diskon(
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

    public function is_diskon_aktif($tanggal_mulai, $tanggal_akhir){
        $tanggal_sekarang = date('Y-m-d');
        return ($tanggal_sekarang >= $tanggal_mulai && $tanggal_sekarang <= $tanggal_akhir);
    }
    
    public function hitung_diskon($harga, $persentase_diskon, $tanggal_mulai, $tanggal_akhir){
        if ($this->is_diskon_aktif($tanggal_mulai, $tanggal_akhir)) {
            $diskon = ($harga * $persentase_diskon) / 100;
            $harga = $harga - $diskon;
        }
        return $harga;
    }
    
    
}
