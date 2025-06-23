<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Pesanan_model');
        $this->load->model('Pesanan_produk_model');
        $this->load->model('Produk_model');
        $this->load->model('Produk_gambar_model');
        cek_pelanggan_login();
    }

    public function index($id_pesanan) {
        $pelanggan_id = $this->session->userdata('id');
        $pesanan = $this->Pesanan_model->get_by_id($id_pesanan);

        if (!$pesanan || $pesanan['pelanggan_id'] != $pelanggan_id) {
            swal('error', 'Pesanan tidak ditemukan', 'Pesanan yang Anda cari tidak valid atau sudah dihapus.');
            redirect('pesanan');
        }

        $pesanan_produk = $this->Pesanan_produk_model->get_by_id_pesanan($id_pesanan);
        $produk_data = [];
        foreach ($pesanan_produk as $produk_item) {
            $produk = $this->Produk_model->get_by_id($produk_item['produk_id']);
            if ($produk) {
                $gambar_produk = $this->Produk_gambar_model->get_by_produk_id($produk_item['produk_id']);
                $produk_item['harga'] = $produk['harga'];
                $produk_item['nama_produk'] = $produk['pd_nama'];
                $produk_item['gambar'] = !empty($gambar_produk) ? base_url('uploads/produk/' . $gambar_produk[0]['nama_gambar']) : null;
                $produk_data[] = $produk_item;
            }
        }
        $data['pesanan'] = $pesanan;
        $data['produk'] = $produk_data;
        $data['pembayaran'] = $this->Pembayaran_model->get_by_pesanan_id($id_pesanan);
        $this->load->view('pelanggan/templates/header');
        $this->load->view('pelanggan/pembayaran', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function bayar() {
        $this->form_validation->set_rules('id_pesanan', 'ID Pesanan', 'required');

        if ($this->form_validation->run() === FALSE) {
            swal('error', 'Validasi Gagal', 'Mohon lengkapi semua field yang diperlukan.');
            redirect('pesanan');
            return;
        }

        $id_pesanan = $this->input->post('id_pesanan');
        $pesanan = $this->Pesanan_model->get_by_id($id_pesanan);

        if (!$pesanan) {
            swal('error', 'Pesanan tidak ditemukan', 'Pesanan yang Anda cari tidak valid atau sudah dihapus.');
            redirect('pesanan');
            return;
        }

        // Konfigurasi upload
        $config['upload_path'] = './uploads/bukti-pembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'bukti_' . time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_pembayaran')) {
            swal('error', 'Upload Gagal', $this->upload->display_errors('', ''));
            redirect('pesanan/detail/' . $id_pesanan); // arahkan balik ke halaman detail
            return;
        }

        $upload_data = $this->upload->data();
        $bukti = 'uploads/bukti-pembayaran/' . $upload_data['file_name'];

        $data = [
            'pesanan_id' => $id_pesanan,
            'total_bayar' => $pesanan['total_pesanan'], // Ambil dari total pesanan
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'status' => 'pending',
            'bukti_pembayaran' => $bukti
        ];

        if ($this->Pembayaran_model->tambah($data)) {
            swal('success', 'Pembayaran Berhasil', 'Bukti pembayaran berhasil dikirim.');
        } else {
            swal('error', 'Pembayaran Gagal', 'Terjadi kesalahan saat menyimpan pembayaran.');
        }

        redirect('pesanan/detail/' . $id_pesanan);
    }
}
