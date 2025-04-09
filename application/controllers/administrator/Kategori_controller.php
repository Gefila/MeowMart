<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_kategori_model');
    }

    public function index()
    {
        $data['title'] = 'Gefila Store - Kategori Produk';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_kategori()
    {
        $data['title'] = 'Gefila Store - Tambah Kategori Produk';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required',[
            'required' => 'Nama kategori tidak boleh kosong'
        ]);
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_kategori();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/kategori/tambah_kategori');
            $this->load->view('administrator/templates/footer');
        }
    }

    public function __simpan_kategori()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_kategori')),
            'deskripsi' => $this->input->post('deskripsi_kategori')
        ];
        $simpan = $this->Produk_kategori_model->tambah($data);

        if ($simpan) {
            $this->session->set_flashdata('message', '
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Kategori berhasil ditambahkan",
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
                    text: "Kategori gagal ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            ');
        }
        redirect('admin/kategori');
    }
}
