<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('LocationModel');
        $this->load->library('pagination');
        $this->load->database();
    }

    public function index() {
        // Pagination configuration
        $config['base_url'] = site_url('locationcontroller/index');
        $config['total_rows'] = $this->LocationModel->count_locations();
        $config['per_page'] = 5; // Number of records per page
        $config['uri_segment'] = 3; // URI segment for pagination
        $this->pagination->initialize($config);

        $data['locations'] = $this->LocationModel->get_all_locations($config['per_page'], $this->uri->segment(3));
        $data['pagination'] = $this->pagination->create_links();

        
        $this->load->view('template/header');
        $this->load->view('locations/index', $data);
        $this->load->view('template/footer');
    }

    public function create() {
        if ($this->input->post()) {
            $data = ['name' => $this->input->post('name')];
            $this->LocationModel->insert_location($data);
            redirect('locationcontroller/index');
        }
        $this->load->view('locations/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = ['name' => $this->input->post('name')];
            $this->LocationModel->update_location($id, $data);
            redirect('locationcontroller/index');
        }

        $data['location'] = $this->LocationModel->get_location($id);
        $this->load->view('locations/edit', $data);
    }

    public function delete($id) {
        $this->LocationModel->delete_location($id);
        redirect('locationcontroller/index');
    }
}
