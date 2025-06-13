<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_diskon_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_diskon_Model');
    }

    public function index()
    {
        $data['title'] = 'Gefila Store - Produk Diskon';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $data['list_produk_diskon'] = $this->Produk_diskon_Model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/diskon/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk_diskon()
    {
        $data['title'] = 'Gefila Store - Produk Diskon';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $this->form_validation->set_rules('nama_produk_diskon', 'Nama Produk Diskon', 'required', [
            'required' => 'Nama Produk Diskon tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jumlah_produk_diskon', 'Jumlah Diskon', 'required', [
            'required' => 'Jumlah Diskon tidak boleh kosong'
        ]);
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk_diskon();
        } else {
            $data['list_kategori'] = $this->Produk_diskon_Model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar', $data);
            $this->load->view('administrator/diskon/tambah_diskon', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    public function __simpan_produk_diskon()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk_diskon')),
            'jumlah_diskon' => $this->input->post('jumlah_produk_diskon'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk_diskon')),
        ];

        $simpan = $this->Produk_diskon_Model->tambah($data);
        if ($simpan) {

            $this->session->set_flashdata('message', '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Produk Diskon Berhasil ditambahkan",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    ');
        } else {
            $this->session->set_flashdata('message', '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Produk Diskon Gagal ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            ');
        }

        redirect('admin/produk_diskon');
    }

    public function hapus_produk_diskon($id)
    {
        $produk_diskon = $this->Produk_diskon_Model->get_by_id($id);
        if ($produk_diskon) {
            $this->Produk_diskon_Model->hapus($id);
            $this->session->set_flashdata('message', '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Produk Diskon berhasil dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    ');
            redirect('admin/produk_diskon');
        }
    }
}
