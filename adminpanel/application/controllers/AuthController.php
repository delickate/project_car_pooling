<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('UserModel'); // Create a model for user operations if needed
        $this->load->library('Auth');
    }

    public function login() 
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->auth->login($username, $password)) 
            {
                redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username or password';
                $this->load->view('login', $data);
            }
        } else {
            $this->load->view('login');
        }
    }

    public function logout() 
    {
        $this->auth->logout();
        redirect('authcontroller/login');
    }

    public function dashboard() 
    {  
        if (!$this->auth->is_logged_in()) 
        {
            redirect('authcontroller/login');
        }

        $this->load->view('template/header');
        $this->load->view('dashboard');
        $this->load->view('template/footer');
    }
}
