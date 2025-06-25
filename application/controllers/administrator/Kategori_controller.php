<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_kategori_model');
    }

    public function index() {
        $data['title'] = 'Gefila Store - Kategori Produk';
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_kategori() {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required', [
            'required' => 'Nama kategori tidak boleh kosong'
        ]);
        if ($this->form_validation->run()) {
            $data = [
                'nama' => ucwords($this->input->post('nama_kategori')),
                'deskripsi' => $this->input->post('deskripsi_kategori')
            ];
            $simpan = $this->Produk_kategori_model->tambah($data);

            if ($simpan) {
                swal('success', 'Berhasil', 'Kategori berhasil ditambahkan');
            } else {
                swal('error', 'Gagal', 'Kategori gagal ditambahkan');
            }
            redirect('admin/kategori');
        }

        $data['title'] = 'Gefila Store - Tambah Kategori Produk';
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/tambah_kategori');
        $this->load->view('administrator/templates/footer');
    }


    public function hapus_kategori($id) {
        $kategori = $this->Produk_kategori_model->get_by_id($id);
        if ($kategori) {
            $hapus = $this->Produk_kategori_model->hapus($id);
            if ($hapus) {
                swal('success', 'Berhasil', 'Kategori berhasil dihapus');
            } else {
                swal('error', 'Gagal', 'Kategori gagal dihapus');
            }
            redirect('admin/kategori');
        } else {
            swal('error', 'Gagal', 'Kategori tidak ditemukan');
            redirect('admin/kategori');
        }
    }

    public function ubah_kategori($id) {
        $kategori = $this->Produk_kategori_model->get_by_id($id);
        if ($kategori) {
            $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required', [
                'required' => 'Nama kategori tidak boleh kosong'
            ]);
            if ($this->form_validation->run()) {
                $data = [
                    'nama' => ucwords($this->input->post('nama_kategori')),
                    'deskripsi' => $this->input->post('deskripsi_kategori')
                ];
                $ubah = $this->Produk_kategori_model->ubah($data, $id);

                if ($ubah) {
                    swal('success', 'Berhasil', 'Kategori berhasil diubah');
                } else {
                    swal('error', 'Gagal', 'Kategori gagal diubah');
                }
                redirect('admin/kategori');
            }

            $data['kategori'] = $kategori;
            $data['title'] = 'Gefila Store - Ubah Kategori Produk';
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/kategori/ubah_kategori', $data);
            $this->load->view('administrator/templates/footer');
        } else {
            swal('error', 'Gagal', 'Kategori tidak ditemukan');
            redirect('admin/kategori');
        }
    }
}
