<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth_controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Administrator_model');
    }

    public function index(){
        $data['title'] = 'Gefila Store - Admin Login';
        $this->form_validation->set_rules('inputUsername', 'Username', 'required');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required');
        if($this->form_validation->run() !== FALSE){
            $this->__login();
        }else{
            $this->load->view('administrator/login', $data);
        }
    }

    private function __login(){
        $username = $this->input->post('inputUsername');
        $password = $this->input->post('inputPassword');
        $check = $this->Administrator_model->check_login($username, md5($password));

        if($check){
            $session_data = array(
                'id' => $check['id_admin'],
                'username' => $check['username'],
                'full_name' => $check['full_name'],
                'admin_login' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('admin');
        }else{
            $this->session->set_flashdata('message',"
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Username atau Password Salah!</strong> Silahkan coba lagi.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ");
            redirect('admin/login');
        }
    }

    public function logout(){
        $session_data = array('id', 'username', 'full_name', 'admin_login');
        $this->session->unset_userdata($session_data);
        redirect('admin/login');
    }
}