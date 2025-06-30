<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Pesanan_model');
        $this->load->model('Pembayaran_model');
    }

    public function index() {
        $data['title'] = 'Gefila Store - Pesanan Produk';

        $data['list_pesanan'] = $this->Pesanan_model->get_list_pesanan();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/pesanan/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function detail($id_pesanan) {
        $data['title'] = 'Gefila Store - Detail Pesanan';

        $data['pesanan'] = $this->Pesanan_model->get_pesanan_by_id($id_pesanan);
        if (!$data['pesanan']) {
            show_404();
        }
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/pesanan/detail', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function update_status() {
        $status = $this->input->post('status');
        $id_pesanan = $this->input->post('id_pesanan');
        if ($this->Pesanan_model->update_status_pesanan($id_pesanan, $status)) {
            swal('success', 'Ubah Status Pesanan', 'Status pesanan berhasil diperbarui.');
        } else {
            swal('error', 'Ubah Status Pesanan', 'Gagal memperbarui status pesanan.');
        }
        redirect('admin/pesanan/detail/' . $id_pesanan);
    }

    public function update_status_pembayaran() {
        $status = $this->input->post('status');
        $id_pesanan = $this->input->post('id_pesanan');
        if ($this->Pembayaran_model->update_status_pembayaran($id_pesanan, $status)) {
            swal('success', 'Ubah Status Pembayaran', 'Status pembayaran berhasil diperbarui.');
        } else {
            swal('error', 'Ubah Status Pembayaran', 'Gagal memperbarui status pembayaran.');
        }
        redirect('admin/pesanan/detail/' . $id_pesanan);
    }

    public function cetak($id_pesanan) {
        $data['title'] = 'Gefila Store - Cetak Pesanan';
        $pesanan = $this->Pesanan_model->get_pesanan_by_id($id_pesanan);

        if (!$pesanan) {
            show_404();
        }

        $data['pesanan'] = $pesanan;

        $this->load->view('administrator/pesanan/cetak', $data);
    }
}
