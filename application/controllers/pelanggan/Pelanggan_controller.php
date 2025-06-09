<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
    }

    public function login()
    {
        if ($this->session->has_userdata('pelanggan_login')) {
            redirect(base_url());
            die;
        }
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__login();
        } else {
            $this->load->view('pelanggan/templates/header');
            $this->load->view('pelanggan/pelanggan_login');
            $this->load->view('pelanggan/templates/footer');
        }
    }

    public function __login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $check = $this->Pelanggan_model->check_login($email, $password);
        if ($check) {
            $session_data = array(
                'id' => $check['id_pelanggan'],
                'email' => $check['email'],
                'nama' => $check['nama_pelanggan'],
                'pelanggan_login' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('message', "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: 'Email atau Password salah!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            ");
        }
        redirect('login');
    }

    public function logout()
    {
        $session_data = array('id', 'email', 'nama', 'pelanggan_login');
        $this->session->unset_userdata($session_data);
        redirect(base_url());
    }

    public function register()
    {
        if ($this->session->has_userdata('pelanggan_login')) {
            redirect(base_url());
            die;
        }
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nopon', 'No Telpon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota Tinggal', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode POS', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('email', 'Alamat Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() !== FALSE) {
            $this->__register();
        } else {
            $this->load->view('pelanggan/templates/header');
            $this->load->view('pelanggan/pelanggan_register');
            $this->load->view('pelanggan/templates/footer');
        }
    }

    public function __register()
    {
        $email = $this->input->post('email');
        if (!($this->Pelanggan_model->get_by_email($email))) {
            $data = [
                'email' => $email,
                'password' => md5($this->input->post('password')),
                'nama_pelanggan' => ucwords($this->input->post('nama')),
                'telp_pelanggan' => $this->input->post('nopon'),
                'alamat' => ucwords($this->input->post('alamat')),
                'kota' => ucwords($this->input->post('kota')),
                'kode_pos' => $this->input->post('kodepos'),
                'provinsi' => ucwords($this->input->post('provinsi')),
            ];

            $simpan = $this->Pelanggan_model->tambah($data);
            if ($simpan) {
                $this->session->set_flashdata('message', "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil',
                            text: 'Silahkan login untuk melanjutkan.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>");
            } else {
                $this->session->set_flashdata('message', "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Registrasi Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data, silahkan coba lagi.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>");
            }
        } else {
            $this->session->set_flashdata('message', "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Sudah Terdaftar',
                        text: 'Silahkan gunakan email lain.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>");
        }
        redirect('register');
    }

    public function profil()
    {
        if (!$this->session->has_userdata('pelanggan_login')) {
            redirect(base_url());
            die;
        }

        $data['data_pelanggan'] = $this->Pelanggan_model->get_by_id($this->session->userdata('id'));
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/pelanggan_profil', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function ubah_profil()
    {
        if (!$this->session->has_userdata('pelanggan_login')) {
            redirect(base_url());
            die;
        }
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nopon', 'No Telpon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota Tinggal', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode POS', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');

        if ($this->form_validation->run() !== FALSE) {
            $data = [
                'nama_pelanggan' => ucwords($this->input->post('nama')),
                'password' => $this->input->post('password') ? md5($this->input->post('password')) : $this->Pelanggan_model->get_by_id($this->session->userdata('id'))['password'],
                'telp_pelanggan' => $this->input->post('nopon'),
                'alamat' => ucwords($this->input->post('alamat')),
                'kota' => ucwords($this->input->post('kota')),
                'kode_pos' => $this->input->post('kodepos'),
                'provinsi' => ucwords($this->input->post('provinsi'))
            ];
            if (!empty($_FILES['foto_pelanggan']['name'])) {
                $config['upload_path'] = 'uploads/profil-pelanggan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'foto_' . time() . '_' . $_FILES['foto_pelanggan']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_pelanggan')) {
                    $data['foto_pelanggan'] = $this->upload->data('file_name');
                    // Hapus foto lama jika ada
                    $pelanggan = $this->Pelanggan_model->get_by_id($this->session->userdata('id'));
                    if ($pelanggan['foto_pelanggan'] && file_exists('uploads/profil-pelanggan/' . $pelanggan['foto_pelanggan'])) {
                        unlink('uploads/profil-pelanggan/' . $pelanggan['foto_pelanggan']);
                    }
                } else {
                    $this->session->set_flashdata('message', "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengunggah Foto',
                            text: '{$this->upload->display_errors()}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    ");
                    redirect('profil/ubah');
                    return;
                }
            }
            $ubah = $this->Pelanggan_model->ubah($data, $this->session->userdata('id'));
            if ($ubah) {
                $this->session->set_flashdata('message', "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Profil Berhasil Diubah',
                        text: 'Perubahan profil berhasil disimpan.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ");
            } else {
                $this->session->set_flashdata('message', "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengubah Profil',
                        text: 'Terjadi kesalahan saat menyimpan perubahan, silahkan coba lagi.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                ");
            }
            redirect('profil');
        } else {
            $data['data_pelanggan'] = $this->Pelanggan_model->get_by_id($this->session->userdata('id'));
            $this->load->view('pelanggan/templates/header', $data);
            $this->load->view('pelanggan/pelanggan_profil_ubah', $data);
            $this->load->view('pelanggan/templates/footer');
        }
    }
}
