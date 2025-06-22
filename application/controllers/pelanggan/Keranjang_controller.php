<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Keranjang_model');
        $this->load->model('Keranjang_produk_model');
        $this->load->model('Produk_model');
        $this->load->model('Produk_gambar_model');
        $this->load->model('Produk_kategori_model');

        cek_pelanggan_login();
    }

    public function index() {
        $pelanggan_id = $this->session->userdata('id');
        $keranjang = $this->Keranjang_model->get_by_pelanggan($pelanggan_id);
        if (!$keranjang) {
            swal('info', 'Keranjang Kosong', 'Silahkan Tambahkan Produk ke Keranjang');
            redirect(base_url());
        }

        $keranjang_id = $keranjang[0]['id_keranjang'];
        $produk = $this->Keranjang_model->get_detail_keranjang($keranjang_id);
        $total = 0;
        foreach ($produk as $item) {
            $total += $item['harga_akhir'] * $item['jumlah'];
        }
        $data['total'] = $total;
        $data['keranjang_id'] = $keranjang[0]['id_keranjang'];
        $data['produk'] = $produk;
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/keranjang', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function tambah() {
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() === FALSE) {
            redirect(base_url());
        }

        $tambah = $this->Keranjang_model->tambah_produk_keranjang($this->session->userdata('id'),  $this->input->post('id_produk'), $this->input->post('jumlah'));

        if ($tambah['status']) {
            swal('success', 'Berhasil Menambahkan ke Keranjang', $tambah['message'], base_url('keranjang'));
            redirect(base_url('keranjang'));
        } else {
            swal('error', 'Gagal Menambahkan ke Keranjang', $tambah['message']);
            redirect(base_url());
        }
    }


    public function ubah_keranjang() {
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('id_keranjang_produk', 'ID Keranjang Produk', 'required');

        if ($this->form_validation->run() === FALSE) {
            return redirect(base_url('keranjang'));
        }

        $response = $this->Keranjang_model->ubah_produk_keranjang(
            $this->input->post('id_keranjang_produk'),
            $this->input->post('id_produk'),
            $this->input->post('jumlah')
        );

        if (!$response['status']) {
            swal('error', 'Gagal Mengubah Keranjang', $response['message']);
            return redirect(base_url('keranjang'));
        }

        swal('success', 'Berhasil Mengubah Keranjang', $response['message'], $response['redirect']);
        redirect($response['redirect']);
    }


    public function hapus_produk_keranjang() {
        $this->form_validation->set_rules('id_keranjang_produk', 'ID Keranjang Produk', 'required');
        if ($this->form_validation->run() === FALSE) {
            return redirect(base_url('keranjang'));
        }

        $hapus_keranjang = $this->Keranjang_model->hapus_produk_dari_keranjang(
            $this->input->post('id_keranjang_produk')
        );

        if (!$hapus_keranjang['status']) {
            swal('error', 'Gagal Menghapus Produk', $hapus_keranjang['message']);
            return redirect(base_url('keranjang'));
        }

        swal('success', 'Berhasil Menghapus Produk', $hapus_keranjang['message']);
        redirect(base_url('keranjang'));
    }
}
