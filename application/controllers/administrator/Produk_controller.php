<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_model');
        $this->load->model('Produk_kategori_model');
        $this->load->model('Produk_gambar_model');
    }

    public function index() {
        $data['title'] = 'Gefila Store - Produk';
        $data['list_produk'] = $this->Produk_model->get_all_produk();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk() {
        $data['title'] = 'Gefila Store - Tambah Produk';
        $data['list_produk'] = $this->Produk_model->get_all();
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
            'required' => 'Nama Produk tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required', [
            'required' => 'Nama Kategori tidak boleh kosong'
        ]);
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->Produk_kategori_model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    public function __simpan_produk() {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk')),
        ];

        $id_produk = $this->Produk_model->tambah($data);
        $count = count($_FILES['gambar_produk']['name']);

        if ($count > 0) {
            $this->upload_gambar_produk($count, $id_produk);
        }
        swal('success', 'Berhasil', 'Produk berhasil ditambahkan');
        redirect('admin/produk');
    }

    private function upload_gambar_produk($count, $id_produk) {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = 'produk-' . $id_produk . '-' . time();
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data = [
                        'nama_gambar' => $filename,
                        'produk_id' => $id_produk
                    ];
                    $this->Produk_gambar_model->tambah($data);
                }
            }
        }
    }

    public function hapus_produk($id) {
        $produk = $this->Produk_model->get_by_id($id);
        if ($produk) {
            $list_gambar = $this->Produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $id_gambar = $gambar['id_gambar'];
                $nama_gambar = $gambar['nama_gambar'];
                $this->Produk_gambar_model->hapus($id_gambar);
                $path = './uploads/produk/' . $nama_gambar;
                unlink($path);
            }

            $this->Produk_model->hapus($id);
            swal('success', 'Berhasil', 'Produk berhasil dihapus');
            redirect('admin/produk');
        }
    }

    public function ubah_produk($id) {
        $produk = $this->Produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
                'required' => 'Nama Produk tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required', [
                'required' => 'Nama Kategori tidak boleh kosong'
            ]);
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Gefila Store - Ubah Produk';
                $data['produk'] = $this->Produk_model->get_by_id($id);
                $data['list_kategori'] = $this->Produk_kategori_model->get_all();
                $data['gambar_model'] = $this->Produk_gambar_model;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar', $data);
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            swal('error', 'Gagal', 'Produk tidak ditemukan');
            redirect('admin/produk');
        }
    }

    public function __ubah_produk($id) {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk')),
        ];

        $ubah = $this->Produk_model->ubah($data, $id);
        if (!empty($_FILES['gambar_produk']['name'][0])) {
            $count = count($_FILES['gambar_produk']['name']);
            $this->upload_gambar_produk($count, $id);
            $ubah = true;
        }

        $ubah_gambar = isset($_SESSION['ubah_gambar']) ? $_SESSION['ubah_gambar'] : false;
        if ($ubah || $ubah_gambar) {
            unset($_SESSION['ubah_gambar']);
            swal('success', 'Berhasil', 'Produk berhasil diubah');
        } else {
            swal('error', 'Gagal', 'Produk gagal diubah');
        }
        redirect('admin/produk');
    }

    public function ubah_gambar($id) {
        $gambar = $this->Produk_gambar_model->get_by_id($id);
        if ($gambar) {
            // Check if the form was submitted with file upload
            if (!empty($_FILES['gambar_produk']['name'])) {
                $config['upload_path'] = './uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = 'produk-' . $gambar['produk_id'] . '-' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_produk')) {
                    // Delete old image file
                    $path = './uploads/produk/' . $gambar['nama_gambar'];
                    if (file_exists($path)) {
                        unlink($path);
                    }

                    // Save new image
                    $uploadData = $this->upload->data();
                    $data = [
                        'nama_gambar' => $uploadData['file_name']
                    ];
                    $this->Produk_gambar_model->ubah($data, $id);
                    $_SESSION['ubah_gambar'] = true;
                    swal('success', 'Berhasil', 'Gambar berhasil diubah');
                } else {
                    swal('error', 'Gagal', $this->upload->display_errors('', ''));
                }
            } else {
                swal('warning', 'Perhatian', 'Silahkan pilih gambar terlebih dahulu');
            }
            redirect('admin/produk/ubah/' . $gambar['produk_id']);
        } else {
            swal('error', 'Gagal', 'Gambar tidak ditemukan');
            redirect('admin/produk');
        }
    }

    public function hapus_gambar($id) {
        $gambar = $this->Produk_gambar_model->get_by_id($id);
        if ($gambar) {
            $path = './uploads/produk/' . $gambar['nama_gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
            $this->Produk_gambar_model->hapus($id);
            $_SESSION['ubah_gambar'] = true;
            swal('success', 'Berhasil', 'Gambar berhasil dihapus');
        } else {
            swal('error', 'Gagal', 'Gambar tidak ditemukan');
        }
        redirect('admin/produk/ubah/' . $gambar['produk_id']);
    }
}
