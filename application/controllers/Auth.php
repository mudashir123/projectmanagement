<?php

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->library(['session']);
    }

    public function login() {
        if ($_POST) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->getByEmail($email);
            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata('user_id', $user->id);
                redirect('dashboard');
            } else {
                $data['error'] = 'Invalid login';
            }
        }
        $this->load->view('auth/login');
    }

    public function register() {
        if ($_POST) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];
            $this->User_model->create($data);
            redirect('login');
        }
        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}