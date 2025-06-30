<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Keranjang_model');
        $this->load->model('Keranjang_produk_model');
        $this->load->model('Produk_model');
        $this->load->model('Produk_gambar_model');
        $this->load->model('Pesanan_model');
        $this->load->model('Pesanan_produk_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Produk_kategori_model');
        cek_pelanggan_login();
    }

    public function index() {
        $pelanggan_id = $this->session->userdata('id');
        $pesanan = $this->Pesanan_model->get_by_pelanggan_id($pelanggan_id);
        if (!$pesanan) {
            swal('info', 'Tidak ada pesanan', 'Anda belum memiliki pesanan.');
            redirect('produk');
            return;
        }

        $data['pesanan'] = [];
        foreach ($pesanan as $item) {
            $id_pesanan = $item['id_pesanan'];
            $pesanan_produk = $this->Pesanan_produk_model->get_by_id_pesanan($id_pesanan);
            $produk_data = [];
            foreach ($pesanan_produk as $produk_item) {
                $produk = $this->Produk_model->get_produk_by_id_with_diskon($produk_item['produk_id']);
                if ($produk) {
                    $gambar_produk = $this->Produk_gambar_model->get_by_produk_id($produk_item['produk_id']);
                    $produk_item['harga'] = $produk_item['harga_saat_pembelian'];
                    $produk_item['nama_produk'] = $produk['pd_nama'];
                    $produk_item['gambar'] = !empty($gambar_produk) ? base_url('uploads/produk/' . $gambar_produk[0]['nama_gambar']) : base_url('uploads/produk/' .'image-placeholder.jpg');
                    $produk_data[] = $produk_item;
                }
            }
            $item['produk'] = $produk_data;
            $data['pesanan'][] = $item;
        }
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/pesanan', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function tambah_pesanan() {
        $pelanggan_id = $this->session->userdata('id');
        $id_keranjang = $this->input->post('keranjang_id');

        $result = $this->Pesanan_model->proses_pesanan($id_keranjang, $pelanggan_id);

        if ($result['status'] === 'error') {
            swal('error', 'Gagal membuat pesanan', $result['message']);
            redirect('keranjang');
        } else {
            swal('success', 'Pesanan berhasil ditambahkan', 'Pesanan Anda telah berhasil dibuat. Silahkan lakukan pembayaran untuk menyelesaikan proses pembelian.');
            redirect('pesanan/detail/' . $result['id_pesanan']);
        }
    }

    public function detail($id) {
        $pelanggan_id = $this->session->userdata('id');
        $pesanan = $this->Pesanan_model->get_by_id($id);
        if (!$pesanan || $pesanan['pelanggan_id'] != $pelanggan_id) {
            $this->session->set_flashdata('message', 'Pesanan tidak ditemukan atau tidak valid.');
            redirect('pesanan');
            return;
        }

        $pesanan_produk = $this->Pesanan_produk_model->get_by_id_pesanan($id);
        $produk_data = [];

        foreach ($pesanan_produk as $item) {
            $produk = $this->Produk_model->get_produk_by_id_with_diskon($item['produk_id']);
            if ($produk) {
                $gambar_produk = $this->Produk_gambar_model->get_by_produk_id($item['produk_id']);
                $item['harga'] = $item['harga_saat_pembelian'];
                $item['nama_produk'] = $produk['pd_nama'];
                $item['gambar'] = !empty($gambar_produk) ? base_url('uploads/produk/' . $gambar_produk[0]['nama_gambar']) : base_url('uploads/produk/' . 'image-placeholder.jpg');
                $produk_data[] = $item;
            }
        }
        $data['pembayaran'] = $this->Pembayaran_model->get_by_pesanan_id($id);
        $data['pesanan'] = [
            'id_pesanan' => $pesanan['id_pesanan'],
            'tanggal_pesanan' => date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])),
            'total_pesanan' => number_format($pesanan['total_pesanan'], 0, ',', '.'),
            'status' => $pesanan['status'],
            'produk' => $produk_data,
        ];

        $data['list_kategori'] = $this->Produk_kategori_model->get_all();

        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/pesanan_detail', $data);
        $this->load->view('pelanggan/templates/footer');
    }
}
