<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
        header('Content-Type: application/json');
    }

    // Sign-up method
    public function signup() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Only POST method is allowed.']);
            return;
        }

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('user_type', 'User type', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // Prepare data for insertion
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            //'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Hash the password
            'password' => md5($this->input->post('password')), // Hash the password
            'real_password' => $this->input->post('password'), // Store the plain password if needed (consider security implications)
            'user_type' => $this->input->post('user_type'), // Set default user type
            'status' => 'active',
            'created_by' => 1, // Change if needed
            'create_datetime' => date('Y-m-d H:i:s'),
            'update_datetime' => date('Y-m-d H:i:s')
        ];

        // Insert user data
        if ($this->UserModel->insert_user($data)) {
            echo json_encode(['status' => 'success', 'message' => 'User signed up successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to sign up user.']);
        }
    }

    // Login method
    public function login() 
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') 
        {
            echo json_encode(['status' => 'error', 'message' => 'Only POST method is allowed.']);
            return;
        }

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('user_type', 'User type', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Check user credentials
        $user = $this->UserModel->get_user_by_username($username);
        //echo 
        if ($user && md5($password) == $user->password) 
        {
            // Successfully logged in
            echo json_encode(['status' => 'success', 'message' => 'Login successful.', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
        }
    }
}
