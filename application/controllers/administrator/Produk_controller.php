<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_model');
        $this->load->model('Produk_kategori_model');
        $this->load->model('Produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Gefila Store - Produk';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $data['list_produk'] = $this->Produk_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk()
    {
        $data['title'] = 'Gefila Store - Tambah Produk';
        $data['list_produk'] = $this->Produk_model->get_all();
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
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

    public function __simpan_produk()
    {
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
            $this->__produk_gambar_upload($count, $id_produk);
        }
        $this->session->set_flashdata('message', '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Produk berhasil ditambahkan",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ');

        redirect('admin/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
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
                $config['file_name'] = 'produk-' . $id_produk . '-' . $i;
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

    public function hapus_produk($id)
    {
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
            $this->session->set_flashdata('message', '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Produk berhasil dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    ');
            redirect('admin/produk');
        }
    }

    public function ubah_produk($id)
    {
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
                $data['admin'] = array(
                    'id' => $this->session->userdata('id'),
                    'username' => $this->session->userdata('username'),
                    'full_name' => $this->session->userdata('full_name')
                );
                $data['produk'] = $this->Produk_model->get_by_id($id);
                $data['list_kategori'] = $this->Produk_kategori_model->get_all();
                $data['gambar_model'] = $this->Produk_gambar_model;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar', $data);
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Produk tidak ditemukan",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ');
            redirect('admin/produk');
        }
    }

    public function __ubah_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk')),
        ];

        $ubah = $this->Produk_model->ubah($data, $id);
        if(!empty($_FILES['gambar_produk']['name'][0])) {
            $count = count($_FILES['gambar_produk']['name']);
            $this->__produk_gambar_upload($count, $id);
            $ubah = true;
        }

        if ($ubah) {
            $this->session->set_flashdata('message', '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Produk berhasil diubah",
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
                        text: "Produk gagal diubah",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ');
        }
        redirect('admin/produk');
    }

    public function ubah_gambar($id)
    {
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

                    $this->session->set_flashdata('message', '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Gambar berhasil diubah",
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
                            text: "' . $this->upload->display_errors('', '') . '",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                ');
                }
            } else {
                $this->session->set_flashdata('message', '
                <script>
                    Swal.fire({
                        icon: "warning",
                        title: "Perhatian",
                        text: "Silahkan pilih gambar terlebih dahulu",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            ');
            }
            redirect('admin/produk/ubah/' . $gambar['produk_id']);
        } else {
            $this->session->set_flashdata('message', '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Gambar tidak ditemukan",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        ');
            redirect('admin/produk');
        }
    }

    public function hapus_gambar($id){
        $gambar = $this->Produk_gambar_model->get_by_id($id);
        if ($gambar) {
            $path = './uploads/produk/' . $gambar['nama_gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
            $this->Produk_gambar_model->hapus($id);
            $this->session->set_flashdata('message', '
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Gambar berhasil dihapus",
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
                        text: "Gambar tidak ditemukan",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ');
        }
        redirect('admin/produk/ubah/' . $gambar['produk_id']);
    }
}
