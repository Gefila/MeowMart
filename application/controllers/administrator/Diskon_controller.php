<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Diskon_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Diskon_model');
        $this->load->model('Produk_Model');
    }

    public function index() {
        $data['title'] = 'Gefila Store - Diskon';
        $data['list_diskon'] = $this->Diskon_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/diskon/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_diskon() {
        $data['title'] = 'Gefila Store - Diskon';
        $this->form_validation->set_rules('nama_diskon', 'Nama Diskon', 'required', [
            'required' => 'Nama Diskon tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('persentase_diskon', 'Jumlah Diskon', 'required', [
            'required' => 'Jumlah Diskon tidak boleh kosong'
        ]);
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_diskon();
        } else {
            $data['list_produk'] = $this->Produk_Model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/diskon/tambah_diskon', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    public function __simpan_diskon() {
        $data = [
            'nama' => ucwords($this->input->post('nama_diskon')),
            'persentase' => $this->input->post('persentase_diskon'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_diskon')),
            'tanggal_mulai' => $this->input->post('tanggal_mulai_diskon'),
            'tanggal_akhir' => $this->input->post('tanggal_akhir_diskon'),
        ];
        $simpan = $this->Diskon_model->tambah($data);

        $produk = $this->input->post('produk');
        if ($produk) {
            $this->Diskon_model->tambah_produk_diskon($simpan, $produk);
        }

        if ($simpan) {
            swal('success', 'Berhasil', 'Diskon berhasil ditambahkan');
        } else {
            swal('error', 'Gagal', 'Diskon Gagal ditambahkan');
        }

        redirect('admin/diskon');
    }

    public function hapus_diskon($id) {
        $produk_diskon = $this->Diskon_model->get_by_id($id);
        if ($produk_diskon) {
            $this->Diskon_model->hapus($id);
            swal('success', 'Berhasil', 'Diskon berhasil dihapus');
            redirect('admin/diskon');
        }
    }

    public function ubah_diskon($id) {
        $data['title'] = 'Gefila Store - Ubah Diskon';
        $data['diskon'] = $this->Diskon_model->get_by_id($id);
        if (!$data['diskon']) {
            redirect('admin/diskon');
        }
        $this->form_validation->set_rules('nama_diskon', 'Nama Diskon', 'required', [
            'required' => 'Nama Diskon tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('persentase_diskon', 'Persentase Diskon', 'required', [
            'required' => 'Persentase Diskon tidak boleh kosong'
        ]);
        $data['list_produk'] = $this->Produk_Model->get_all_produk_with_diskon($id);
        if ($this->form_validation->run() !== FALSE) {
            $this->__update_diskon($id);
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/diskon/ubah_diskon', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    public function __update_diskon($id) {
        $data = [
            'nama' => ucwords($this->input->post('nama_diskon')),
            'persentase' => $this->input->post('persentase_diskon'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_diskon')),
            'tanggal_mulai' => $this->input->post('tanggal_mulai_diskon'),
            'tanggal_akhir' => $this->input->post('tanggal_akhir_diskon'),
        ];
        $produk = $this->input->post('produk');
        $update = $this->Diskon_model->ubah_produk_dan_diskon($id, $data, $produk);
        if ($update) {
            swal('success', 'Berhasil', 'Diskon Berhasil diupdate');
        } else {
            swal('error', 'Gagal', 'Diskon Gagal diupdate');
        }

        redirect('admin/diskon');
    }
}
